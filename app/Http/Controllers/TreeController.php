<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Services\TreeService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

/**
 * Class TreeController
 * @package App\Http\Controllers
 */
class TreeController extends Controller
{
    /**
     * @var TreeService
     */
    private $treeService;

    /**
     * TreeController constructor.
     * @param TreeService $treeService
     */
    public function __construct(TreeService $treeService)
    {
        $this->treeService = $treeService;
    }

    /**
     * @return View
     */
    public function index(): View
    {
        $tree = $this->treeService->buildTree(Tag::all()->toArray());
        return view('home.layout.index', compact('tree'));
    }

    /**
     * @param int $id
     * @return View
     */
    public function show(int $id): View
    {
        $tree = $this->treeService->buildTree(Tag::all()->toArray(), $id);
        return view('home.layout.index', compact('tree'));
    }

    /**
     * @param int $id
     * @return View
     */
    public function calculate(int $id): View
    {
        $tree = $this->treeService->buildTree(Tag::all()->toArray(), $id);
        $result = $this->treeService->calculateValueOfTree($tree);
        return view('home.layout.index', compact('tree', 'result'));
    }

    /**
     * @param int $id
     * @return View
     */
    public function move(int $id): View
    {
        $tree = $this->treeService->buildTree(Tag::all()->toArray(), $id);
        return view('home.layout.index', compact('tree'));
    }

    /**
     * @param int $id
     * @return RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function changeParent(int $id): RedirectResponse
    {
        $newParentId = request('parent_id');
        $this->validate(request(), [
            'parent_id' => 'required|numeric',
        ]);

        if (!Tag::find($newParentId)) {
            request()->session()->flash('alert-danger', 'Entered parent ID not exists');
            return redirect()->route('tree.show', $id);
        }

        Tag::where('parent_id', $id)->update(['parent_id' => $newParentId]);

        request()->session()->flash('alert-success', 'Subtree was successfully moved.');
        return redirect()->route('tree.show', $id);
    }
}
