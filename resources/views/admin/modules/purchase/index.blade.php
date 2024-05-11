@extends('admin.layouts.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ __('Purchases') }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('Purchases') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('All Purchases') }}</li>
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

                            <h4 class="card-title">{{ __('All Purchases') }}</h4>
                            <p class="card-title-desc">
                                {{ __('Displaying all purchases data in the table provides a comprehensive overview of supplier information, facilitating efficient management and analysis.') }}
                            </p>

                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>{{ __('Serial No') }}</th>
                                        <th>{{ __('Purchase No') }}</th>
                                        <th>{{ __('Date') }}</th>
                                        <th>{{ __('Product Name') }}</th>
                                        <th>{{ __('Supplier') }}</th>
                                        <th>{{ __('Category') }}</th>
                                        <th>{{ __('Quantity') }}</th>
                                        <th>{{ __('Status') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @foreach ($purchases as $key => $purchase)
                                        <tr>
                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $purchase->purchase_no }}</td>
                                            <td>{{ $purchase->date }}</td>
                                            <td>{{ $purchase->product->name }}</td>
                                            <td>{{ $purchase->supplier->name }}</td>
                                            <td>{{ $purchase->category->name }}</td>
                                            <td>{{ $purchase->buying_qty }}</td>
                                            <td>
                                                <button type="button" class="btn btn-{{ $purchase->status ? 'success' :'warning' }} waves-effect waves-light">{{ $purchase->status ? __('Approved') : __('Pending') }}</button>
                                            </td>
                                            <td style="width: 100px">
                                                @if (! $purchase->status)
                                                    <form style="display: inline-block" method="POST" action="{{ route('purchase.delete', $purchase->id) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="#" onclick="event.preventDefault();
                                                        this.closest('form').submit();"
                                                            class="btn btn-outline-danger btn-sm edit" title="Delete">
                                                            <i class="fas fa-trash"></i>
                                                        </a>
                                                    </form>
                                                @endif
                                                
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
