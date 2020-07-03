<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use Symfony\Component\HttpFoundation\StreamedResponse;

/**
 * Class ExportController
 * @package App\Http\Controllers
 */
class ExportController extends Controller
{
    /**
     * @return StreamedResponse
     */
    public function index(): StreamedResponse
    {
        $filename = 'tags-' . date("Y-m-d h:i:s") . '.csv';
        $headers = [
            'Content-Type' => 'application/csv',
            'Cache-Control' => 'must-revalidate, post-check=0, pre-check=0',
            'Content-Disposition' => 'attachment; filename=' . $filename,
            'Expires' => '0',
            'Pragma' => 'public',
        ];

        $tree = Tag::all();

        $response = new StreamedResponse(function () use ($tree) {
            $handle = fopen('php://output', 'w');

            fputcsv($handle, [
                'id',
                'parent_id',
                'identifier',
                'value'
            ], ',');

            foreach ($tree as $item) {
                fputcsv($handle, [
                    $item->id,
                    $item->parent_id,
                    $item->identifier,
                    $item->value
                ], ',');
            }

            fclose($handle);
            exit;
        }, 200, $headers);
        return $response->send();
    }
}
