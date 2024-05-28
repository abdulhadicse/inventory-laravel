<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Http\Requests\Supplier\SupplierStoreRequest;
use App\Services\Supplier\SupplierService;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class SupplierController extends Controller
{

    private SupplierService $supplierService;

    /**
     * Constructor for SupplierController.
     *
     * @param  SupplierService  $supplierService
     */
    public function __construct(SupplierService $supplierService)
    {
        $this->supplierService = $supplierService;
    }

    /**
     * Display a listing of the resource.
     *
     * @return View
     */
    public function index(): View
    {
        $suppliers = $this->supplierService->list();
        return view('admin.modules.suppliers.index', compact('suppliers'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return View
     */
    public function create(): View
    {
        return view('admin.modules.suppliers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  SupplierStoreRequest  $request
     * @return RedirectResponse
     */
    public function store(SupplierStoreRequest $request): RedirectResponse
    {
        $this->supplierService->store($request->validated());

        toastr('Supplier added successfully.', 'success');

        return redirect()->route('supplier.list');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  string  $id
     * @return View
     */
    public function edit(string $id): View
    {
        $supplier = $this->supplierService->findSupplier($id);
        return view('admin.modules.suppliers.edit', compact('supplier'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  SupplierStoreRequest  $request
     * @param  string  $id
     * @return RedirectResponse
     */
    public function update(SupplierStoreRequest $request, string $id): RedirectResponse
    {
        $this->supplierService->update($id, $request->validated());

        toastr('Supplier updated successfully.', 'success');

        return redirect()->route('supplier.list');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  string  $id
     * @return RedirectResponse
     */
    public function destroy(string $id): RedirectResponse
    {
        $this->supplierService->deleteSupplier($id);

        toastr('Supplier deleted successfully.', 'success');

        return redirect()->route('supplier.list');
    }
}
