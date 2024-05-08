@extends('layouts.app')
@section("page-css")
<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f5f5f5;
    }
    .header {
        background-color: #1976D2;
        color: #fff;
        padding: 20px;
        text-align: center;
        font-size: 24px;
        font-weight: bold;
    }
    .sidebar {
        background-color: #263238;
        color: #fff;
        padding-top: 20px;
    }
    .sidebar-heading {
        padding: 10px 20px;
    }
    .logout-btn {
        color: #fff;
        border: none;
        background: none;
        font-size: 16px;
        cursor: pointer;
    }
    .logout-btn:hover {
        text-decoration: underline;
    }
    .menu-item {
        padding: 10px 20px;
        color: #fff;
        transition: background-color 0.3s ease;
    }
    .menu-item:hover {
        background-color: #37474F;
    }
    .content {
        padding: 20px;
        min-height: calc(100vh - 80px); /* Adjust for footer height */
    }
    .products, .order-details {
        background-color: #fff;
        border: 2px solid #c5e1a5;
        border-radius: 5px;
        padding: 20px;
        margin-bottom: 20px;
    }
    .product-list, .order-summary {
        list-style-type: none;
        padding: 0;
        margin: 0;
        flex-wrap: wrap;
        justify-content: space-between;
    }
    .product-list{
        display: flex;
    }
    .product-list li {
        width: calc(25% - 20px);
        margin-bottom: 20px;
        padding: 10px;
        background-color: #dcedc8;
        border-radius: 5px;
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
        cursor: pointer;
        transition: background-color 0.3s ease;
    }
    .product-list li:hover {
        background-color: #c5e1a5;
    }
    .product-info {
        display: flex;
        align-items: center;
    }
    .product-image {
        width: 60px;
        height: 60px;
        margin-right: 10px;
    }
    .product-details {
        flex-grow: 1;
    }
    .product-price {
        font-weight: bold;
    }
    .product-details div{
        font-size:10px;
    }
    .order-summary-table {
        width: 100%;
        border-collapse: collapse;
        margin-top: 20px;
    }
    .order-summary-table th,
    .order-summary-table td {
        border: 1px solid #ddd;
        padding: 8px;
        text-align: center;
    }
    .order-summary-table th {
        background-color: #f2f2f2;
    }
    .quantity-input {
        width: 90px;
        padding: 5px;
        border: 1px solid #ffd54f;
        border-radius: 3px;
        text-align:center;
    }
    .total-section p{
        margin-bottom:1px;
    }
    .footer {
        background-color: #1976D2;
        color: #fff;
        text-align: center;
        padding: 10px 0;
        position: absolute;
        bottom: 0;
        width: 100%;
    }

    /* Responsive styles for order details table */
    @media (max-width: 768px) {
        .order-summary-table {
            font-size: 14px;
        }
        .order-summary-table th,
        .order-summary-table td {
            padding: 5px;
        }
    }
</style>
@endsection
@section("content-header") Point of Sale @endsection
@section('main-content')
<div class="row">
    <div class="col-lg-8">
        <div class="products">
            <div class="form-group">
                <input type="text" class="form-control" id="productSearch" placeholder="Search for products">
            </div>
            <h2 style="margin-bottom: 20px;">Products List</h2>
            @php
            @endphp
            <ul class="product-list">
                @foreach($products as $product)
                    @if($product->variants->count() > 0)
                        @foreach($product->variants as $productVariant)
                            @php
                                $realPrice = $productVariant->price; 
                                $discountPrice = $realPrice-(($product->discount/100)*$realPrice);
                            @endphp
                            <li data-id = "{{$product->id}}" data-variant-id="{{$productVariant->id}}" data-name="{{$product->name}}" data-color="{{$productVariant->color}}" data-size="{{$productVariant->size}}" data-price="{{$discountPrice}}" data-tax="{{$product->tax}}" data-discount="{{$product->discount}}">
                                <div class="product-info">
                                    <img src="{{asset('storage')}}/{{$product->image}}" alt="Product 1" class="product-image">
                                    <div class="product-details">
                                        <div class="product-name">
                                            {{$product->name}}({{$productVariant->color}}-{{$productVariant->size}})
                                        </div>
                                        <div class="product-price">
                                            <span>TK {{ceil($discountPrice)}}</span>
                                            @if($realPrice > $discountPrice) 
                                                <span style="text-decoration: line-through;">{{$realPrice}}</span>
                                            @endif
                                        </div>
                                    </div> 
                                </div>
                            </li>
                        @endforeach
                    @else
                        @php
                            $realPrice = $product->selling_price; 
                            $discountPrice = $realPrice-(($product->discount/100)*$realPrice);
                        @endphp
                        <li data-id = "{{$product->id}}" data-variant-id="" data-name="{{$product->name}}" data-color="" data-size="" data-price="{{$discountPrice}}" data-tax="{{$product->tax}}" data-discount="{{$product->discount}}">
                            <div class="product-info">
                                <img src="{{asset('storage')}}/{{$product->image}}" alt="Product 1" class="product-image">
                                <div class="product-details">
                                    <div class="product-name">{{$product->name}}</div>
                                    <div class="product-price">
                                        <span>TK {{ceil($discountPrice)}}</span>
                                        @if($realPrice > $discountPrice) 
                                        <span style="text-decoration: line-through;">{{$realPrice}}</span>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
            <div>
                {{$products->links()}}
            </div>
        </div>
    </div>
    <div class="col-lg-4">
        <div class="order-details">
            <h2 style="margin-bottom: 20px;">Order Details</h2>
            <div class="table-responsive"> <!-- Added container for responsiveness -->
                <table class="order-summary-table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th> <!-- Added column for Remove button -->
                        </tr>
                    </thead>
                    <tbody class="order-summary">
                        <!-- Order summary rows will be dynamically added here -->
                    </tbody>
                </table>
            </div>
            <div class="total-section">
                <p>Total Items: <span id="total-items">0</span></p>
                <p>Subtotal: $<span id="subtotal">0.00</span></p>
                <p>Tax: $<span id="tax">0.00</span></p>
                <p>Total: $<span id="total">0.00</span></p>
            </div>
            <button id="saveOrderBtn" class="btn btn-primary">Save Order</button>
        </div>
    </div>
</div>
@endsection
@section("page-js")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#productSearch').on('input', function() {
            const searchText = $(this).val().toLowerCase();
            $('.product-list li').each(function() {
                const productName = $(this).data('name').toLowerCase();
                if (productName.includes(searchText)) {
                    $(this).show();
                } else {
                    $(this).hide();
                }
            });
        });
        const productList = $('.product-list li');
        const orderSummary = $('.order-summary');
        const totalItems = $('#total-items');
        const subtotal = $('#subtotal');
        const tax = $('#tax');
        const total = $('#total');

        let items = JSON.parse(sessionStorage.getItem("orderItems"));
        if(!items){
            items = {};
        }
        let taxRate = 0.1; // 10% tax rate

        // Add event listeners to each product for ordering
        productList.on('click', function() {
            const id = $(this).data('id');
            const variant_id = $(this).data('variant-id');
            const name = $(this).data('name');
            const price = parseFloat($(this).data('price'));
            const tax = parseFloat($(this).data('tax'));
            const color = $(this).data('color');
            const size = $(this).data('size');
            const discount = parseFloat($(this).data('discount'));
            const variantName = `${name} (${color}, ${size})`;
            if (!items[variantName]) {
                items[variantName] = {
                    id: id,
                    variant_id: variant_id,
                    price: price,
                    tax: tax,
                    quantity: 1,
                    discount: discount
                };
            } else {
                items[variantName].quantity++;
            }
            sessionStorage.setItem("orderItems",JSON.stringify(items));
            updateOrderSummary();
        });

        // Update order summary
        function updateOrderSummary() {
            let totalItemsCount = 0;
            let subtotalAmount = 0;

            // Clear existing order summary
            orderSummary.empty();

            // Calculate totals
            let items = JSON.parse(sessionStorage.getItem("orderItems"));
            if(!items){ return false;}
            Object.keys(items).forEach(key => {
                const { id, variant_id, price, tax, quantity, discount } = items[key];
                const total = (price - discount) * quantity;

                subtotalAmount += total;
                totalItemsCount += quantity;

                // Add row to order summary with remove icon and quantity input
                const row = `
                    <tr>
                        <td data-id='${id}' data-variant-id='${variant_id}' data-tax='${tax}'>${key}</td>
                        <td>$${price.toFixed(2)}</td>
                        <td><input type="number" class="quantity-input" value="${quantity}" min="1"></td>
                        <td>$${total.toFixed(2)}</td>
                        <td><i class="fas fa-trash-alt remove-item" data-name="${key}" style="cursor: pointer;"></i></td>
                    </tr>
                `;
                orderSummary.append(row);
            });

            // Calculate tax and total
            const taxAmount = subtotalAmount * taxRate;
            const totalAmount = subtotalAmount + taxAmount;

            // Update order summary display
            totalItems.text(totalItemsCount);
            subtotal.text(subtotalAmount.toFixed(2));
            tax.text(taxAmount.toFixed(2));
            total.text(totalAmount.toFixed(2));

            // Add event listeners to remove icons
            $('.remove-item').on('click', function() {
                const itemName = $(this).data('name');
                removeItem(itemName);
            });

            // Add event listeners to quantity inputs
            $('.quantity-input').on('change', function() {
                const itemName = $(this).closest('tr').find('td:first').text();
                const newQuantity = parseInt($(this).val());

                if (!isNaN(newQuantity) && newQuantity >= 1) {
                    items[itemName].quantity = newQuantity;
                    sessionStorage.setItem("orderItems",JSON.stringify(items));
                    updateOrderSummary();
                } else {
                    $(this).val(items[itemName].quantity);
                }
            });
        }

        // Function to remove item from the order
        function removeItem(name) {
            if (items[name]) {
                delete items[name];
                sessionStorage.setItem("orderItems",JSON.stringify(items));
                updateOrderSummary();
            }
        }

        $.ajaxSetup({
           headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
           }
        });

        $('#saveOrderBtn').on('click', function() {
            const orderItems = [];
            let totalItemsCount = 0;
            let subtotalAmount = 0;
            let itemTr = $('.order-summary-table tbody tr');
            if(itemTr.length < 1){
                alert("Please Select At least One item to Order");return false;
            }

            let isConfirm = confirm("Are You Sure To Place The Order?");
            if(!isConfirm){return false;}

            itemTr.each(function() {
                const productId = $(this).find('td:eq(0)').data('id');
                const productVariantId = $(this).find('td:eq(0)').data('variant-id');
                const tax = parseFloat($(this).find('td:eq(0)').data('tax'));
                const quantity = parseInt($(this).find('td:eq(2) input').val());
                const price = parseFloat($(this).find('td:eq(1)').text().replace('$', ''));
                const total = parseFloat($(this).find('td:eq(3)').text().replace('$', ''));

                // Add the item details to the orderItems array
                orderItems.push({
                    product_id: productId,
                    variant_id: productVariantId,
                    quantity: quantity,
                    price: price,
                    tax: tax,
                    total: total
                });

                // Update total items count and subtotal amount
                totalItemsCount += quantity;
                subtotalAmount += total;
            });
            // Calculate tax and total
            const taxRate = 0.1; // Example tax rate
            const taxAmount = subtotalAmount * taxRate;
            const totalAmount = subtotalAmount + taxAmount;
            $.ajax({
                type: 'POST',
                url: "{{route('saveOrder')}}",
                data: {
                    order_items: orderItems,
                    total_items: totalItemsCount,
                    subtotal: subtotalAmount.toFixed(2),
                    tax: taxAmount.toFixed(2),
                    total: totalAmount.toFixed(2)
                },
                success: function(response) {
                    if(response.success){
                        alert(response.msg);
                        items = {};
                        updateOrderSummary();
                    }
                },
                error: function(error) {
                    console.error('There is an error,Please Try Again');
                }
            });
        });

        updateOrderSummary();
    });
</script>
@endsection