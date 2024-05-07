@extends('admin.layouts.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ __('Add Category') }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('Categories') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('Add Category') }}</li>
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

                            <h4 class="card-title">{{ __('Add Category') }}</h4>
                            <p class="card-title-desc">{{ __('Add new categories effortlessly with a streamlined form for quick integration.') }}</p>
                            <form method="POST" action="{{ route('category.save') }}">
                                @csrf
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name" type="text" placeholder="Category name"
                                            id="name" value="{{ old('name') }}">
                                    </div>
                                </div> 

                                <button class="btn btn-dark waves-effect waves-light text-uppercase" type="submit">{{ __('Add Category') }}</button>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- end col -->
    </div>
@endsection
