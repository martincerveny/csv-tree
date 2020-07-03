<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

/**
 * Class ImportCsv
 * @package App\Console\Commands
 */
class ImportCsv extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import:csv';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import CSV file to database.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return void
     */
    public function handle()
    {
        $fileName = $this->ask('What is the name of the CSV file?') . ".csv";
        try {
            $csv = array_map('str_getcsv', file(base_path($fileName)));
        } catch (\Exception $e) {
           $this->error('Error: File not found');
           return;
        }

        foreach (array_slice($csv, 1) as $item) {
            $attributes = [];
            if (is_numeric($item[0])) {
                $attributes['id'] = $item[0];
                $attributes['parent_id'] = is_numeric($item[1]) ? $item[1] : null;
                $attributes['identifier'] = $item[2];
                $attributes['value'] = $item[3];
            }
            DB::table('tags')->insert($attributes);
        }

        $this->info('CSV was successfully imported.');
    }
}
