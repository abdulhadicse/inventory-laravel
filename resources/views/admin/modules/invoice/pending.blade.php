@extends('admin.layouts.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">Inovice All</h4>
                    </div>
                </div>
            </div>
            <!-- end page title -->
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">Inovice All Data </h4>
                            <table id="datatable" class="table table-bordered dt-responsive nowrap"
                                style="border-collapse: collapse; border-spacing: 0; width: 100%;">
                                <thead>
                                    <tr>
                                        <th>Sl</th>
                                        <th>Customer Name</th>
                                        <th>Invoice No </th>
                                        <th>Date </th>
                                        <th>Amount</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                </thead>
                                <tbody>
                                    @foreach ($allData as $key => $item)
                                        <tr>
                                            <td> {{ $key + 1 }} </td>
                                            <td> {{ $item['payment']['customer']['name'] }} </td>
                                            <td> #{{ $item->invoice_no }} </td>
                                            <td> {{ date('d-m-Y', strtotime($item->date)) }} </td>
                                            <td> $ {{ $item['payment']['total_amount'] }} </td>
                                            <td>
                                                @if ($item->status == '0')
                                                    <span class="btn btn-warning">Pending</span>
                                                @elseif($item->status == '1')
                                                    <span class="btn btn-success">Approved</span>
                                                @endif
                                            </td>
                                            <td>
                                                @if ($item->status == '0')
                                                    <a href="{{ route('invoice.show', $item->id) }}" class="btn btn-dark sm"
                                                        title="Approved Data"> <i class="fas fa-check-circle"></i> </a>
                                                    <form style="display: inline-block" method="POST" action="{{ route('invoice.delete', $item->id) }}">
                                                        @csrf
                                                        @method('delete')
                                                        <a href="#" onclick="event.preventDefault();
                                                        this.closest('form').submit();"
                                                            class="btn btn-outline-danger btn-sm edit" title="Delete">
                                                            <i class="fas fa-trash-alt"></i>
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
        </div> <!-- container-fluid -->
    </div>
@endsection

@push('scripts')
    <!-- Required datatable js -->
    <script src="{{ asset('assets/libs/datatables.net/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('assets/libs/datatables.net-bs4/js/dataTables.bootstrap4.min.js') }}"></script>

    <!-- Datatable init js -->
    <script src="{{ asset('assets/js/pages/datatables.init.js') }}"></script>
@endpush
