@extends('admin.layouts.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">

            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-sm-flex align-items-center justify-content-between">
                        <h4 class="mb-sm-0">{{ __('Add Purchase') }}</h4>

                        <div class="page-title-right">
                            <ol class="breadcrumb m-0">
                                <li class="breadcrumb-item"><a href="javascript: void(0);">{{ __('Purchases') }}</a></li>
                                <li class="breadcrumb-item active">{{ __('Add Purchase') }}</li>
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

                            <h4 class="card-title">{{ __('Add Purchase') }}</h4>
                            <p class="card-title-desc">
                                {{ __('Add new purchase effortlessly with a streamlined form for quick integration.') }}</p>
                            <div class="row purchase">
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="date" class="form-label">{{ __('Date') }}</label>
                                        <input class="form-control" name="date" type="date" id="date">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="mb-3">
                                        <label for="purchase_no" class="form-label">{{ __('Purchase no') }}</label>
                                        <input type="text" name="purchase_no" class="form-control" id="purchase_no"
                                            placeholder="Purchase no" required="">
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <label for="supplier_id" class="">{{ __('Supplier Name') }}</label>
                                    <select name="supplier_id" class="form-select select2" aria-label="Supplier" id="supplier_id">
                                        <option value="" selected="">{{ __('Open this select supplier') }}</option>
                                        @foreach ($suppliers as $supplier)
                                            <option value="{{ $supplier->id }}">{{ $supplier->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="category_id" class="col-form-label">{{ __('Category Name') }}</label>
                                    <select name="category_id" class="form-select select2" aria-label="Supplier" id="category_id">
                                        <option value="" selected="">{{ __('Open this select category') }}
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-4">
                                    <label for="product_id" class="col-form-label">{{ __('Product Name') }}</label>
                                    <select name="product_id" class="form-select select2" aria-label="Product" id="product_id">
                                        <option value="" selected="">{{ __('Open this select product') }}
                                        </option>
                                    </select>
                                </div>

                                <div class="col-md-4 purchase_add_more">
                                    <button type="button" class="btn btn-dark waves-effect waves-light addmore">
                                        <i class=" ri-add-line align-middle me-2"></i>{{ __('Add More') }}
                                    </button>
                                </div>
                            </div>
                        </div>

                        <!-- Purchase card-body -->
                        <div class="card-body">
                            <form method="post" action="{{ route('purchase.save') }}">
                                @csrf
                                <table class="table-sm table-bordered" width="100%" style="border-color: #ddd;">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Product Name') }}</th>
                                            <th>{{ __('Category') }}</th>
                                            <th>{{ __('Quantity') }}</th>
                                            <th>{{ __('Unit Price') }}</th>
                                            <th>{{ __('Description') }}</th>
                                            <th>{{ __('Total Price') }}</th>
                                            <th>{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="containerElement" class="addRow">
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5"></td>
                                            <td>
                                                <input type="text" name="estimated_amount" value="0"
                                                    id="estimated_amount" class="form-control estimated_amount" readonly
                                                    style="background-color: #ddd;">
                                            </td>
                                            <td></td>
                                        </tr>

                                    </tfoot>
                                </table>
                                <br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-dark waves-effect waves-light">
                                        <i class="ri-shopping-bag-line align-middle me-2"></i>{{ __('Purchase Store') }}
                                    </button>
                                </div>
                            </form>
                        </div> <!-- End Purchase card-body -->
                    </div>
                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div> <!-- end col -->
    </div>
@endsection

@push('scripts')
    <script>
        $(document).ready(function() {
            $('.purchase').on('click', '.addmore', function() {
                // Get values from input fields
                var date = $('#date').val().trim();
                var purchase_no = $('#purchase_no').val().trim();
                var supplier_id = parseInt($('#supplier_id').val());
                var category_id = parseInt($('#category_id').val());
                var category_name = $('#category_id').find('option:selected').text().trim();
                var product_id = parseInt($('#product_id').val());
                var product_name = $('#product_id').find('option:selected').text().trim();

                // Validate input fields
                if (!date || !purchase_no || isNaN(supplier_id) || isNaN(category_id) || isNaN(
                        product_id)) {
                    toastr.error('Please fill in all fields correctly.');
                    return;
                }

                var tr = $('<tr/>', {
                    class: 'delete_add_more_item',
                    id: 'delete_add_more_item',
                }).append(
                    $('<input/>', {
                        type: 'hidden',
                        name: 'date[]',
                        value: date,
                    }),
                    $('<input/>', {
                        type: 'hidden',
                        name: 'purchase_no[]',
                        value: purchase_no,
                    }),
                    $('<input/>', {
                        type: 'hidden',
                        name: 'supplier_id[]',
                        value: supplier_id,
                    }),
                    $('<td/>').append(
                        $('<input/>', {
                            type: 'hidden',
                            name: 'product_id[]',
                            value: product_id,
                        }),
                        product_name
                    ),
                    $('<td/>').append(
                        $('<input/>', {
                            type: 'hidden',
                            name: 'category_id[]',
                            value: category_id,
                        }),
                        category_name
                    ),
                    $('<td/>').append(
                        $('<input/>', {
                            type: 'number',
                            min: '1',
                            class: 'form-control buying_qty text-right',
                            name: 'buying_qty[]',
                            value: '',
                        })
                    ),
                    $('<td/>').append(
                        $('<input/>', {
                            type: 'number',
                            class: 'form-control unit_price text-right',
                            name: 'unit_price[]',
                            value: '',
                        })
                    ),
                    $('<td/>').append(
                        $('<input/>', {
                            type: 'text',
                            class: 'form-control',
                            name: 'description[]',
                        })
                    ),
                    $('<td/>').append(
                        $('<input/>', {
                            type: 'number',
                            class: 'form-control buying_price text-right',
                            name: 'buying_price[]',
                            value: '0',
                            readonly: true,
                        })
                    ),
                    $('<td/>').append(
                        $('<i/>', {
                            class: 'btn btn-danger btn-sm fas fa-window-close removeeventmore',
                        })
                    )
                );

                $('#containerElement').append(tr);
            });

            // Get category by supplier id.
            $(document).on('change', '#supplier_id', function() {
                var supplier_id = $(this).val();
                $.ajax({
                    url: "{{ route('purchase.category') }}",
                    type: "GET",
                    data: {
                        supplier_id: supplier_id
                    }, // Corrected: 'supplier_id' instead of 'id'
                    success: function(data) {
                        var html = '<option value="">Select Category</option>';
                        $.each(data, function(key, v) {
                            html += '<option value="' + v.category_id + '"> ' + v
                                .category.name +
                                '</option>'; // Removed space before v.category_id
                        });
                        $('#category_id').html(html);
                    }
                });
            });

            // Get product by category id.
            $(document).on('change', '#category_id', function() {
                var category_id = $(this).val();
                $.ajax({
                    url: "{{ route('purchase.product') }}",
                    type: "GET",
                    data: {
                        category_id: category_id
                    },
                    success: function(data) {
                        var html = '<option value="">Select Product</option>';
                        $.each(data, function(key, v) {
                            html += '<option value=" ' + v.id + ' "> ' + v.name +
                                '</option>';
                        });
                        $('#product_id').html(html);
                    }
                })
            });

            // Remove purchase item
            $(document).on("click", ".removeeventmore", function(event) {
                $(this).closest(".delete_add_more_item").remove();
                totalAmountPrice();
            });

            // Calculate purchase item price
            $(document).on('keyup click', '.unit_price,.buying_qty', function() {
                var unit_price = $(this).closest("tr").find("input.unit_price").val();
                var qty = $(this).closest("tr").find("input.buying_qty").val();
                var total = unit_price * qty;
                $(this).closest("tr").find("input.buying_price").val(total);
                totalAmountPrice();
            });
        });

        // Calculate sum of amout in invoice 
        function totalAmountPrice() {
            var sum = 0;
            $(".buying_price").each(function() {
                var value = $(this).val();
                if (!isNaN(value) && value.length != 0) {
                    sum += parseFloat(value);
                }
            });
            $('#estimated_amount').val(sum);
        }
    </script>
@endpush

@push('styles')
    <style>
        .purchase_add_more {
            display: flex;
            align-items: end;
        }
    </style>
@endpush
