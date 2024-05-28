@extends('admin.layouts.master')
@section('content')
    <div class="page-content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="card-title">{{ __('Add Invoice') }}</h4><br><br>
                            <div class="row">
                                <div class="col-md-3">
                                    <div class="md-3">
                                        <label for="invoice_no" class="form-label">{{ __('Invoice No') }}</label>
                                        <input class="form-control example-date-input" name="invoice_no" type="text"
                                            value="{{ date('Ymd') . uniqid() }}" id="invoice_no" readonly
                                            style="background-color:#ddd">
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="md-3">
                                        <label for="example-text-input" class="form-label">{{ __('Date') }}</label>
                                        <input class="form-control example-date-input" value="{{ date('Y-m-d') }}"
                                            name="date" type="date" id="date">
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-3">
                                        <label for="category_id" class="form-label">{{ __('Category Name') }}</label>
                                        <select name="category_id" id="category_id" class="form-select select2"
                                            aria-label="Category name">
                                            <option selected="">{{ __('Open this select category') }}</option>
                                            @foreach ($categories as $category)
                                                <option value="{{ $category->id }}">{{ $category->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="md-3">
                                        <label for="product_id" class="form-label">{{ __('Product Name') }}</label>
                                        <select name="product_id" id="product_id" class="form-select select2"
                                            aria-label="Product Name">
                                            <option selected="">{{ __('Open this select product') }}</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-1">
                                    <div class="md-3">
                                        <label for="current_stock_qty" class="form-label">{{ __('Stock') }}</label>
                                        <input class="form-control example-date-input" name="current_stock_qty"
                                            type="text" id="current_stock_qty" readonly style="background-color:#ddd">
                                    </div>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-2 invoice_add_more">
                                    <button type="button" class="btn btn-dark waves-effect waves-light addmore">
                                        <i class=" ri-add-line align-middle me-2"></i>{{ __('Add More') }}
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <form method="post" action="{{ route('invoice.save') }}">
                                @csrf
                                <table class="table-sm table-bordered" width="100%" style="border-color: #ddd;">
                                    <thead>
                                        <tr>
                                            <th>{{ __('Category') }}</th>
                                            <th>{{ __('Product Name') }}</th>
                                            <th width="7%">{{ __('Quantity') }}</th>
                                            <th width="10%">{{ __('Unit Price') }}</th>
                                            <th width="15%">{{ __('Total Price') }}</th>
                                            <th width="7%">{{ __('Action') }}</th>
                                        </tr>
                                    </thead>
                                    <tbody id="containerElement" class="addRow">
                                    </tbody>
                                    <tbody>
                                        <tr>
                                            <td colspan="4">{{ __('Discount') }}</td>
                                            <td>
                                                <input type="text" name="discount_amount" id="discount_amount"
                                                    class="form-control estimated_amount" placeholder="Discount Amount">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="4">{{ __('Grand Total') }}</td>
                                            <td>
                                                <input type="text" name="estimated_amount" value="0"
                                                    id="estimated_amount" class="form-control estimated_amount" readonly
                                                    style="background-color: #ddd;">
                                            </td>
                                            <td></td>
                                        </tr>
                                    </tbody>
                                </table><br>
                                <div class="form-row">
                                    <div class="form-group col-md-12">
                                        <textarea name="description" class="form-control" id="description" placeholder="Write Description Here"></textarea>
                                    </div>
                                </div><br>
                                <div class="row">
                                    <div class="form-group col-md-3">
                                        <label>{{ __('Paid Status') }} </label>
                                        <select name="paid_status" id="paid_status" class="form-select">
                                            <option value="">{{ __('Select Status') }}</option>
                                            <option value="full_paid">{{ __('Full Paid') }}</option>
                                            <option value="full_due">{{ __('Full Due') }}</option>
                                            <option value="partial_paid">{{ __('Partial Paid ') }}</option>
                                        </select>
                                        <input type="text" name="paid_amount" class="form-control paid_amount"
                                            placeholder="Enter Paid Amount" style="display:none;">
                                    </div>
                                    <div class="form-group col-md-9">
                                        <label>{{ __('Customer Name') }}</label>
                                        <select name="customer_id" id="customer_id" class="form-select">
                                            <option value="">{{ __('Select Customer') }} </option>
                                            @foreach ($customers as $customer)
                                                <option value="{{ $customer->id }}">{{ $customer->name }} -
                                                    {{ $customer->mobile_no }}</option>
                                            @endforeach
                                            <option value="0">{{ __('New Customer') }}</option>
                                        </select>
                                    </div>
                                </div> <br>
                                <!-- Hide Add Customer Form -->
                                <div class="row new_customer" style="display:none">
                                    <div class="form-group col-md-4">
                                        <input type="text" name="name" id="name" class="form-control"
                                            placeholder="Write Customer Name">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="text" name="mobile_no" id="mobile_no" class="form-control"
                                            placeholder="Write Customer Mobile No">
                                    </div>

                                    <div class="form-group col-md-4">
                                        <input type="email" name="email" id="email" class="form-control"
                                            placeholder="Write Customer Email">
                                    </div>
                                </div>
                                <!-- End Hide Add Customer Form -->
                                <br>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-dark waves-effect waves-light">
                                        <i class="ri-shopping-bag-line align-middle me-2"></i>{{ __('Invoice Store') }}
                                    </button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        $(document).ready(function() {

            $('.invoice_add_more').on('click', '.addmore', function() {
                // Get values from input fields
                var date = $('#date').val();
                var invoice_no = $('#invoice_no').val();
                var category_id = parseInt($('#category_id').val());
                var category_name = $('#category_id').find('option:selected').text();
                var product_id = parseInt($('#product_id').val());
                var product_name = $('#product_id').find('option:selected').text();

                // Validate input fields
                if (!date || !invoice_no || isNaN(category_id) || isNaN(product_id)) {
                    toastr.error('Please fill in all fields correctly.');
                    return;
                }

                var tr = $('<tr/>', {
                    class: 'delete_add_more_item',
                    id: 'delete_add_more_item',
                }).append(
                    $('<input/>', {
                        type: 'hidden',
                        name: 'date',
                        value: date,
                    }),
                    $('<input/>', {
                        type: 'hidden',
                        name: 'invoice_no',
                        value: invoice_no,
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
                            class: 'form-control selling_qty text-right',
                            name: 'selling_qty[]',
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
                            type: 'number',
                            class: 'form-control selling_price text-right',
                            name: 'selling_price[]',
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

            $(document).on("click", ".removeeventmore", function(event) {
                $(this).closest(".delete_add_more_item").remove();
                totalAmountPrice();
            });

            $(document).on('keyup click', '.unit_price,.selling_qty', function() {
                var unit_price = $(this).closest("tr").find("input.unit_price").val();
                var qty = $(this).closest("tr").find("input.selling_qty").val();
                var total = unit_price * qty;
                $(this).closest("tr").find("input.selling_price").val(total);
                $('#discount_amount').trigger('keyup');
            });

            $(document).on('keyup', '#discount_amount', function() {
                totalAmountPrice();
            });

            $(document).on('change', '#paid_status', function() {
                var paid_status = $(this).val();
                if (paid_status == 'partial_paid') {
                    $('.paid_amount').show();
                } else {
                    $('.paid_amount').hide();
                }
            });

            $(document).on('change', '#customer_id', function() {
                var customer_id = $(this).val();
                if (customer_id == '0') {
                    $('.new_customer').show();
                } else {
                    $('.new_customer').hide();
                }
            });

            // Calculate sum of amout in invoice 
            function totalAmountPrice() {
                var sum = 0;
                $(".selling_price").each(function() {
                    var value = $(this).val();
                    if (!isNaN(value) && value.length != 0) {
                        sum += parseFloat(value);
                    }
                });

                var discount_amount = parseFloat($('#discount_amount').val());
                if (!isNaN(discount_amount) && discount_amount.length != 0) {
                    sum -= parseFloat(discount_amount);
                }

                $('#estimated_amount').val(sum);
            }

        });

        // Get quantity by product id.
        $(document).on('change', '#product_id', function() {
            var product_id = $(this).val();
            $.ajax({
                url: "{{ route('product.stock') }}",
                type: "GET",
                data: {
                    product_id: product_id
                },
                success: function(data) {
                    $('#current_stock_qty').val(data);
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
                        html += '<option value="' + v.id + '"> ' + v.name +
                            '</option>';
                    });
                    $('#product_id').html(html);
                }
            })
        });
    </script>
@endpush
@push('styles')
    <style>
        .invoice_add_more {
            display: flex;
            align-items: end;
        }
    </style>
@endpush
