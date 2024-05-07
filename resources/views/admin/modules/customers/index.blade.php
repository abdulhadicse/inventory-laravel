@extends('admin.layouts.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ __('Customers') }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('Customers') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('All Customers') }}</li>
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

                            <h4 class="card-title">{{ __('All Customers') }}</h4>
                            <p class="card-title-desc">
                                {{ __('Displaying all customers data in the table provides a comprehensive overview of supplier information, facilitating efficient management and analysis.') }}
                            </p>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>{{ __('Serial No') }}</th>
                                        <th>{{ __('Image') }}</th>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Email') }}</th>
                                        <th>{{ __('Mobile No.') }}</th>
                                        <th>{{ __('Addresses') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($customers as $key => $customer)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>
                                                @if ($customer->image)
                                                    <img class="rounded avatar-sm" src="{{ asset($customer->image) }}" alt="image">
                                                @else
                                                <span>{{ __('No Image') }}</span>
                                                @endif
                                            </td>
                                            <td>{{ $customer->name }}</td>
                                            <td>{{ $customer->email }}</td>
                                            <td>{{ $customer->mobile_no }}</td>
                                            <td>{{ $customer->address }}</td>
                                            <td>{{ $customer->status ? __('Active') : __('Inactive') }}</td>
                                            <td style="width: 100px">
                                                <a href="{{ route('customer.edit', $customer->id) }}"
                                                    class="btn btn-outline-info btn-sm edit" title="Edit">
                                                    <i class="fas fa-pencil-alt"></i>
                                                </a>
                                                <form style="display: inline-block" method="POST" action="{{ route('customer.delete', $customer->id) }}">
                                                    @csrf
                                                    @method('delete')
                                                    <a href="#" onclick="event.preventDefault();
                                                    this.closest('form').submit();"
                                                        class="btn btn-outline-danger btn-sm edit" title="Delete">
                                                        <i class="fas fas fa-times"></i>
                                                    </a>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                        </div>
                    </div>
                </div> <!-- end col -->
            </div> <!-- end row -->
        </div> <!-- end col -->
    </div> <!-- end row -->
@endsection

@push('scripts')
    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
@endpush
