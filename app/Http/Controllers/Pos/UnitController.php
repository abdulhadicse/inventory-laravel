<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Services\Unit\UnitService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class UnitController extends Controller
{
    private UnitService $unitService;

    /**
     * Constructor for UnitController.
     *
     * @param UnitService $unitService The unit service instance.
     */
    public function __construct(UnitService $unitService)
    {
        $this->unitService = $unitService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $units = $this->unitService->list();
        return view('admin.modules.units.index', compact('units'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.modules.units.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request The HTTP request.
     * @return RedirectResponse
     */
    public function store(Request $request): RedirectResponse
    {
        $this->unitService->store($request->all());

        toastr('Unit added successfully.', 'success');

        return redirect()->route('unit.list');
    }

    /**
     * Display the specified resource.
     *
     * @param string $id The ID of the unit.
     * @return void
     */
    public function show(string $id)
    {
        // Implement if needed
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param string $id The ID of the unit.
     * @return View
     */
    public function edit(string $id): View
    {
        $unit = $this->unitService->findUnit($id);
        return view('admin.modules.units.edit', compact('unit'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request The HTTP request.
     * @param string $id The ID of the unit.
     * @return RedirectResponse
     */
    public function update(Request $request, string $id): RedirectResponse
    {
        $this->unitService->update($request->all(), $id);

        toastr('Unit updated successfully.', 'success');

        return redirect()->route('unit.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param string $id The ID of the unit.
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->unitService->deleteUnit($id);

        toastr('Unit deleted successfully.', 'success');

        return redirect()->route('unit.list');
    }
}
