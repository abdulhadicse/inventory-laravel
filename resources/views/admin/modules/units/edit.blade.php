@extends('admin.layouts.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ __('Add Unit') }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('Units') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('Add Unit') }}</li>
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

                            <h4 class="card-title">{{ __('Add Unit') }}</h4>
                            <p class="card-title-desc">
                                {{ __('Add new units effortlessly with a streamlined form for quick integration.') }}</p>
                            <form method="POST" action="{{ route('unit.update', $unit->id) }}">
                                @csrf
                                @method('PUT')
                                <div class="row mb-3">
                                    <label for="name" class="col-sm-2 col-form-label">{{ __('Name') }}</label>
                                    <div class="col-sm-10">
                                        <input class="form-control" name="name" type="text"
                                            placeholder="Unit name" id="name" value="{{ $unit->name }}">
                                    </div>
                                </div>

                                <button class="btn btn-dark waves-effect waves-light text-uppercase"
                                    type="submit">{{ __('Update Unit') }}</button>
                            </form>
                        </div>
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- end col -->
    </div>
@endsection
