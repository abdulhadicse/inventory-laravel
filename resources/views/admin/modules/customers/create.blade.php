@extends('admin.layouts.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ __('Add Customer') }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('Customers') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('Add Customer') }}</li>
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

                            <h4 class="card-title">{{ __('Add Customer') }}</h4>
                            <p class="card-title-desc">{{ __('Add new customer effortlessly with a streamlined form for quick integration.') }}</p>
                            <form method="POST" action="{{ route('customer.save') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name" type="text" placeholder="Customer name"
                                            id="name" value="{{ old('name') }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="email" class="col-sm-2 col-form-label">{{ __('Email') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="email" type="email" placeholder="Customer email"
                                            id="email" value="{{ old('email') }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="mobile" class="col-sm-2 col-form-label">{{ __('Mobile No') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="mobile_no" type="text" placeholder="Customer mobile number"
                                            id="mobile">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="address" class="col-sm-2 col-form-label">{{ __('Address') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="address" type="text" placeholder="Customer address"
                                            id="address" value="{{ old('address') }}">
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="image" class="col-sm-2 col-form-label">{{ __('Image') }}</label>
                                    <div class="col-sm-10">
                                        <input type="file" name="image" class="form-control" id="image">
                                    </div>
                                </div>

                                <button class="btn btn-dark waves-effect waves-light text-uppercase" type="submit">{{ __('Add Customer') }}</button>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- end col -->
    </div>
@endsection
