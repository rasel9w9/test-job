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
    .form-container {
        margin: 20px auto;
        max-width: 550px;
        padding: 20px;
        background-color: #fff;
        border: 1px solid #ccc;
        border-radius: 5px;
    }
    .form-group {
        margin-bottom: 20px;
    }
    .variant-table th,
    .variant-table td {
        padding: 8px;
        border-bottom: 1px solid #dee2e6;
    }
    .variant-table th {
        background-color: #f2f2f2;
    }
    .remove-variant {
        cursor: pointer;
        color: #dc3545;
    }
    .preview-image {
        max-width: 150px;
        max-height: 150px;
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
@section("content-header") Product Entry @endsection
@section('main-content')
<div class="form-container">
    <form id="productEntryForm" method="post" action="{{route('saveProduct')}}" enctype="multipart/form-data" >
        @csrf
        <div class="form-group">
            <label for="productName">Product Name:</label>
            <input type="text" name="name" class="form-control" id="productName" required>
        </div>
        <div class="form-group">
            <label for="productSku">SKU:</label>
            <input type="text" name="sku" class="form-control" id="productSku" required>
        </div>
        <div class="form-group">
            <label for="productUnit">Unit:</label>
            <input type="text" name="unit" class="form-control" placeholder="kg,ltr,peece" id="productUnit" required>
        </div>
        <div class="form-group">
            <label for="productUnitValue">Unit Value:</label>
            <input type="number" name="unit_value" class="form-control" id="productUnitValue" min="1" required >
        </div>
        <div class="form-group">
            <label for="productSellingPrice">Selling Price:</label>
            <input type="number" name="selling_price" class="form-control" min="1" id="productSellingPrice" required>
        </div>
        <div class="form-group">
            <label for="productPurchasePrice">Purchase Price:</label>
            <input type="number" name="purchase_price" class="form-control" min="1" id="productPurchasePrice" required>
        </div>
        <div class="form-group">
            <label for="productDiscount">Discount(%):</label>
            <input type="number" name="discount" class="form-control" min="0" id="productDiscount" required step="0.01">
        </div>
        <div class="form-group">
            <label for="productTax">Tax(%):</label>
            <input type="number" name="tax" class="form-control" min="0" id="productTax" required step="0.01">
        </div>
        <div class="form-group">
            <label for="productImage">Product Image:</label>
            <input type="file" name="image" name="image" class="form-control-file" id="productImage" accept="image/*" required>
        </div>
        <div class="form-group">
            <input type="checkbox" id="hasVariants" class="form-check-input" name="has_variants">
            <label for="hasVariants" class="form-check-label">Has Variants</label>
        </div>
        <div id="variantSection" style="display: none;">
            <div class="table-responsive">
                <small style="color:red">Please first variant price must be same with selling price.</small>
                <table class="table variant-table">
                    <thead>
                        <tr>
                            <th>Color</th>
                            <th>Size</th>
                            <th>Price</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody id="variantInputs">
                        <tr class="variant-input">
                            <td>
                                <select class="form-control variant-color" name="variant_color[]">
                                    <option value="">Select Color</option>
                                    <option value="Red">Red</option>
                                    <option value="Blue">Blue</option>
                                    <option value="Green">Green</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </td>
                            <td>
                                <select class="form-control variant-size" name="variant_size[]">
                                    <option value="">Select Size</option>
                                    <option value="XS">XS</option>
                                    <option value="S">S</option>
                                    <option value="M">M</option>
                                    <option value="L">L</option>
                                    <option value="XL">XL</option>
                                    <!-- Add more options as needed -->
                                </select>
                            </td>
                            <td><input type="number" class="form-control" name="variant_price[]" min="1" ></td>
                            <td><i class="fas fa-times remove-variant"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="text-right">
                <span class="btn btn-sm btn-primary add-variant">+ Add Variant</span>
            </div>
        </div>
        <button type="submit" class="btn btn-primary">Add Product</button>
    </form>
</div>
@endsection
@section("page-js")
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $(document).ready(function() {
        $('#hasVariants').change(function() {
            if ($(this).is(':checked')) {
                $('#variantSection').show();
                $('.variant-color').attr('required', 'required');
                $('.variant-size').attr('required', 'required');
            } else {
                $('#variantSection').hide();
                $('.variant-color').removeAttr('required');
                $('.variant-size').removeAttr('required');
            }
        });

        // Add variant input fields
        $('.add-variant').click(function() {
            $('#variantInputs').append(`
                <tr class="variant-input">
                    <td>
                        <select class="form-control variant-color" name="variantColor[]" required>
                            <option value="">Select Color</option>
                            <option value="Red">Red</option>
                            <option value="Blue">Blue</option>
                            <option value="Green">Green</option>
                            <!-- Add more options as needed -->
                        </select>
                    </td>
                    <td>
                        <select class="form-control variant-size" name="variantSize[]" required>
                            <option value="">Select Size</option>
                            <option value="Small">Small</option>
                            <option value="Medium">Medium</option>
                            <option value="Large">Large</option>
                            <!-- Add more options as needed -->
                        </select>
                    </td>
                    <td><input type="number" class="form-control" name="productPrice[]" required step="0.01"></td>
                    <td><i class="fas fa-times remove-variant"></i></td>
                </tr>
            `);
        });

        // Remove variant input row
        $('body').on('click', '.remove-variant', function() {
            $(this).closest('tr').remove();
        });

        // Product Entry Form Submission
        $('#productEntryForm').on('submit', function(event) {
            const hasVariants = $("#hasVariants").is(":checked");
            if(hasVariants){
                const variantColors = $('select.variant-color').map(function(){return $(this).val();}).get();
                const variantSizes = $('select.variant-size').map(function(){return $(this).val();}).get();
                const firstVariantPrices = Number($("input[name='variant_price[]']").val());
                const sellingPrice = Number($("#productSellingPrice").val());
                if(firstVariantPrices != sellingPrice){
                    event.preventDefault();
                    alert('First Variant Price Must be same with Selling Price.');
                    return;
                }

                const combinedVariants = [];
                variantColors.forEach(function(item,index){
                    var combinedValue = item+"-"+variantSizes[index];
                    combinedVariants.push(combinedValue);
                })
                const duplicates = hasDuplicates(combinedVariants);
                if (duplicates) {
                    event.preventDefault();
                    alert('Duplicate variants are not allowed.');
                    return;
                }
            }
        });

        function hasDuplicates(arr) {
            return arr.some( function(item) {
                return arr.indexOf(item) !== arr.lastIndexOf(item);
            });
        }
    });
</script>
@endsection