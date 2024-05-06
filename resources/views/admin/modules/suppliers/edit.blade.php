@extends('admin.layouts.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ __('Add Supplier') }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('Suppliers') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('Add Supplier') }}</li>
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

                            <h4 class="card-title">{{ __('Add Supplier') }}</h4>
                            <p class="card-title-desc">{{ __('Add new suppliers effortlessly with a streamlined form for quick integration.') }}</p>
                            <form method="POST" action="{{ route('supplier.update', $supplier->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name" type="text" placeholder="Supplier name"
                                            id="name" value="{{ $supplier->name }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="email" type="email" placeholder="Supplier email"
                                            id="email" value="{{ $supplier->email }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="mobile" class="col-sm-2 col-form-label">{{ __('Mobile No') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="mobile_no" type="text" placeholder="Supplier mobile number"
                                            id="mobile" value={{ $supplier->mobile_no }}>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="address" class="col-sm-2 col-form-label">{{ __('Address') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="address" type="text" placeholder="Supplier address"
                                            id="address" value="{{ $supplier->address }}">
                                    </div>
                                </div>

                                <button class="btn btn-dark waves-effect waves-light text-uppercase" type="submit">{{ __('Update Supplier') }}</button>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- end col -->
    </div>
@endsection
