<?php

namespace App\Http\Controllers\Pos;

use App\Http\Controllers\Controller;
use App\Services\Category\CategoryService;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class CategoryController extends Controller {

	private CategoryService $categoryService;

	public function __construct( CategoryService $categoryService ) {
		$this->categoryService = $categoryService;
	}

	/**
	 * Display a listing of the resource.
	 *
	 * @return View
	 */
	public function index(): View {
		$categories = $this->categoryService->list();
		return view( 'admin.modules.categories.index', compact( 'categories' ) );
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return View
	 */
	public function create(): View {
		return view( 'admin.modules.categories.create' );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param Request $request The HTTP request.
	 * @return RedirectResponse
	 */
	public function store( Request $request ): RedirectResponse {
		$this->categoryService->store( $request->all() );

		toastr( 'Category added successfully.', 'success' );

		return redirect()->route( 'category.list' );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param string $id The ID of the unit.
	 * @return void
	 */
	public function show( string $id ) {
		// Implement if needed
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param string $id The ID of the unit.
	 * @return View
	 */
	public function edit( string $id ): View {
		$category = $this->categoryService->findCategory( $id );
		return view( 'admin.modules.categories.edit', compact( 'category' ) );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param Request $request The HTTP request.
	 * @param string  $id The ID of the unit.
	 * @return RedirectResponse
	 */
	public function update( Request $request, string $id ): RedirectResponse {
		$this->categoryService->update( $request->all(), $id );

		toastr( 'Category updated successfully.', 'success' );

		return redirect()->route( 'category.list' );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param string $id The ID of the unit.
	 * @return RedirectResponse
	 */
	public function destroy( string $id ): RedirectResponse {
		$this->categoryService->deleteCategory( $id );

		toastr( 'Category deleted successfully.', 'success' );

		return redirect()->route( 'category.list' );
	}
}
