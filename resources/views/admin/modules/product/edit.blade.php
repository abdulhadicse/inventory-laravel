@extends('admin.layouts.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ __('Edit Product') }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('Products') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('Edit Products') }}</li>
                            </ol>
                        </div>

                    </div>
                </div>
            </div>
            <!-- end page title -->

            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">

                            <h4 class="card-title">{{ __('Edit Supplier') }}</h4>
                            <p class="card-title-desc">{{ __('Edit a products effortlessly with a streamlined form for quick integration.') }}</p>
                            <form method="POST" action="{{ route('product.update', $product->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name" type="text" placeholder="Product name"
                                            id="name" value="{{ $product->name }}">
                                    </div>
                                </div>

                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">{{ __('Supplier Name') }}</label>
                                    <div class="col-sm-10">
                                        <select name="supplier_id" class="form-select" aria-label="Supplier">
                                            <option selected="">{{ __('Open this select supplier') }}</option>
                                            @foreach ( $suppliers as $supplier )
                                                <option value="{{ $supplier->id }}" @selected($supplier->id == $product->supplier_id)>{{ $supplier->name }}</option>
                                            @endforeach
                                            </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">{{ __('Unit Name') }}</label>
                                    <div class="col-sm-10">
                                        <select name="unit_id" class="form-select" aria-label="Unit">
                                            <option selected="">{{ __('Open this select unit') }}</option>
                                            @foreach ( $units as $unit )
                                                <option value="{{ $unit->id }}" @selected($unit->id == $product->unit_id)>{{ $unit->name }}</option>
                                            @endforeach
                                            </select>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label class="col-sm-2 col-form-label">{{ __('Category Name') }}</label>
                                    <div class="col-sm-10">
                                        <select name="category_id" class="form-select" aria-label="Category">
                                            <option selected="">{{ __('Open this select category') }}</option>
                                            @foreach ( $categories as $category )
                                                <option value="{{ $category->id }}" @selected($category->id == $product->category_id)>{{ $category->name }}</option>
                                            @endforeach
                                            </select>
                                    </div>
                                </div>

                                <button class="btn btn-dark waves-effect waves-light text-uppercase" type="submit">{{ __('Update Product') }}</button>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- end col -->
    </div>
@endsection
