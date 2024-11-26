$(function() {
    
    // Search Product
    var fetchProductUrl = $('#fetch-product-url').val();
    var fetchSOProductsUrl = $('#fetch-so-product-url').val();
    var fetchDNProductsUrl = $('#fetch-dn-product-url').val();
    var token = $('meta[name="csrf-token"]').attr('content');


    var sales_order_no = $('#sales_order_no').val();
    var delivery_note_no = $('#delivery_note_no').val();

    if(sales_order_no){
        $.ajax({
            url:fetchSOProductsUrl,
            type: 'get',
            dataType: "json",
            data:{
                _token: token, 
                sales_order_no:sales_order_no
            },
            beforeSend: function() {
                $("#so-product-fetch-indicator").html('<div><span class="spinner-border spinner-border-custom-4 text-primary" role="status"></span><span class="ml-4">Please wait! fetching products...</span></div>');
            },
            success: function( data ) {
                if(data.length > 0){
                    $.each(data, function( index, value ) {
                        var newRow = $("<tr>");
                        var cols = '';
                        cols += '<td><button class="btn btn-sm btn-danger remove" type="button">-</button></td>';
                        cols += '<td><input name="product_id[]" type="hidden"  value="'+data[index].product.id+'"/>'+data[index].product.name+'</td>';
                        cols += '<td><input name="quantity[]" type="number"  value="'+data[index].quantity+'" class="form-control quantity" step=".01"/></td>';
                        cols += '<td><input name="unit_id[]" type="hidden" class="form-control" value="'+data[index].product.baseunit.id+'" required>'+data[index].product.baseunit.symbol+'</td>';                     
                        cols += '<td><input name="unit_price[]" type="number"  value="'+data[index].unit_price+'" class="form-control unit_price" step=".01"/></td>';
                        cols += '<td><input name="tax_percentage[]" type="number"  value="'+data[index].tax_percentage+'" class="form-control tax_per" step=".01"/></td>';
                        cols += '<td><input name="tax_value[]" type="number"  value="'+data[index].tax_value+'" class="form-control tax_value" step=".01"/></td>';
                        cols += '<td><input name="discount_percentage[]" type="number"  value="'+data[index].discount_percentage+'" class="form-control discount_per" step=".01"/>(<span class="discount-value-text">'+data[index].discount_value+'</span>)</td>';
                        cols += '<td><input name="total_value[]" type="number"  value="'+data[index].total_value+'" class="form-control sub-total" step=".01"/>';
                        cols += '<input name="discount_value[]" type="hidden" class="discount-value" value="'+data[index].discount_value+'"/>';
                        cols += '<input type="hidden" class="sub-total-wo-disc" value="0.00"/>';
                        cols += '<input type="hidden" class="product-code" value="'+data[index].unit_price+'"/></td>';
                        newRow.append(cols);
                        $("table#product-list tbody").append(newRow);
                        $('#search-product-service').val('');
                        $("#so-product-fetch-indicator").html('');
                        rowindex = newRow.index();
                        calculateRowProductData(rowindex); 
                   });  
                }
                else{
                    $("#so-product-fetch-indicator").html('<div>Failed to load Products...!</div>');
                }
            }
        });
    }

    if(delivery_note_no){
        $.ajax({
            url:fetchDNProductsUrl,
            type: 'get',
            dataType: "json",
            data:{
                _token: token, 
                delivery_note_no:delivery_note_no
            },
            beforeSend: function() {
                $("#dn-product-fetch-indicator").html('<div><span class="spinner-border spinner-border-custom-4 text-primary" role="status"></span><span class="ml-4">Please wait! fetching products...</span></div>');
            },
            success: function( data ) {
                if(data.length > 0){
                    $.each(data, function( index, value ) {
                        var newRow = $("<tr>");
                        var cols = '';
                        cols += '<td><button class="btn btn-sm btn-danger remove" type="button">-</button></td>';
                        cols += '<td><input name="product_id[]" type="hidden"  value="'+data[index].product.id+'"/>'+data[index].product.name+'</td>';
                        cols += '<td><input name="quantity[]" type="number"  value="'+data[index].quantity+'" class="form-control quantity" step=".01"/></td>';
                        cols += '<td><input name="unit_id[]" type="hidden" class="form-control" value="'+data[index].product.baseunit.id+'" required>'+data[index].product.baseunit.symbol+'</td>';                     
                        cols += '<td><input name="unit_price[]" type="number"  value="'+data[index].unit_price+'" class="form-control unit_price" step=".01"/></td>';
                        cols += '<td><input name="tax_percentage[]" type="number"  value="'+data[index].tax_percentage+'" class="form-control tax_per" step=".01"/></td>';
                        cols += '<td><input name="tax_value[]" type="number"  value="'+data[index].tax_value+'" class="form-control tax_value" step=".01"/></td>';
                        cols += '<td><input name="discount_percentage[]" type="number"  value="'+data[index].discount_percentage+'" class="form-control discount_per" step=".01"/>(<span class="discount-value-text">'+data[index].discount_value+'</span>)</td>';
                        cols += '<td><input name="total_value[]" type="number"  value="'+data[index].total_value+'" class="form-control sub-total" step=".01"/>';
                        cols += '<input name="discount_value[]" type="hidden" class="discount-value" value="'+data[index].discount_value+'"/>';
                        cols += '<input type="hidden" class="sub-total-wo-disc" value="0.00"/>';
                        cols += '<input type="hidden" class="product-code" value="'+data[index].unit_price+'"/></td>';
                        newRow.append(cols);
                        $("table#product-list tbody").append(newRow);
                        $('#search-product-service').val('');
                        $("#dn-product-fetch-indicator").html('');
                        rowindex = newRow.index();
                        calculateRowProductData(rowindex); 
                   });  
                }
                else{
                    $("#dn-product-fetch-indicator").html('<div>Failed to load Products...!</div>');
                }
            }
        });
    }


    $("#search-product-service").autocomplete({
        source: function( request, response ) {
            $.ajax({
                url:fetchProductUrl,
                type: 'get',
                dataType: "json",
                data:{
                    _token: token, 
                    search:request.term
                },
                beforeSend: function() {
                    $('#search-indicator-product').text('Please Wait! Searching...');
                },
                success: function( data ) {
                    if(data.length > 0){
                        response( data );
                    }
                    else{
                        $('#search-product-service').val('');
                        $('#product_id').val('');
                        $('#search-indicator-product').text('No Data Found!');
                        return false;
                    }
                }
            });
        },
        select: function (event, ui) {
            setProduct(ui.item);
            $('#search-indicator-product').text('');
            return false;
        }
    });


    function setProduct(data){
        var rowindex;
        if(data){
            var flag = 1;
            $(".product-code").each(function(i) {
                if ($(this).val() == data.code) {
                    rowindex = i;
                    Swal.mixin({
                        toast: !0,
                        position: "top-end",
                        showConfirmButton: !1,
                        timer: 3e3,
                        timerProgressBar: !0,
                        }).fire({ icon: "warning", title: "Item already exists in the list" });
                    $('#search-product-service').val('');
                    $('#product_id').val('');    
                    flag = 0;
                }
            });
            if(flag){
                var newRow = $("<tr>");
                var cols = '';
                cols += '<td><button class="btn btn-sm btn-danger remove" type="button">-</button></td>';
                cols += '<td><input name="product_id[]" type="hidden"  value="'+data.id+'"/>'+data.value+'</td>';
                cols += '<td><input name="quantity[]" type="number"  value="1" class="form-control quantity" step=".01"/></td>';
                cols += '<td><input name="unit_id[]" type="hidden" class="form-control" value="'+data.unit_id+'" required>'+data.unit+'</td>';                     
                cols += '<td><input name="unit_price[]" type="number"  value="'+data.rate+'" class="form-control unit_price" step=".01"/></td>';
                cols += '<td><input name="tax_percentage[]" type="number"  value="'+data.tax_per+'" class="form-control tax_per" step=".01"/></td>';
                cols += '<td><input name="tax_value[]" type="number"  value="0.00" class="form-control tax_value" step=".01"/></td>';
                cols += '<td><input name="discount_percentage[]" type="number"  value="0.00" class="form-control discount_per" step=".01"/>(<span class="discount-value-text">0.00</span>)</td>';
                cols += '<td><input name="total_value[]" type="number"  value="0.00" class="form-control sub-total" step=".01"/>';
                cols += '<input name="discount_value[]" type="hidden" class="discount-value" value="0.00"/>';
                cols += '<input type="hidden" class="sub-total-wo-disc" value="0.00"/>';
                cols += '<input type="hidden" class="product-code" value="'+data.code+'"/></td>';
                newRow.append(cols);
                $("table#product-list tbody").append(newRow);
                $('#search-product-service').val('');
                $('#product_id').val('');
                rowindex = newRow.index();
                calculateRowProductData(rowindex); 
            }
        }
        else{
            $('#search-indicator-product').text('Something Went Wrong! Try Again');
        }
    }

    function calculateRowProductData(rowindex){
        
        var sales_rate_type = $('.sales_rate_type:checked').val();
        var discount_type = $('.discount_type:checked').val();
        var quantity = $('table#product-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.quantity').val();
        var unit_price = $('table#product-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.unit_price').val();
        var tax_per = $('table#product-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax_per').val();
        var discount_per = $('table#product-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.discount_per').val();
        
        if(sales_rate_type == 'Inclusive'){
            var tax_less =(parseFloat(quantity) * parseFloat(unit_price))/(1 + tax_per/100);
            var tax_value = (parseFloat(quantity) * parseFloat(unit_price)) - tax_less;
            var original_price = parseFloat(quantity) * parseFloat(unit_price);
        }
        else if(sales_rate_type == 'Exclusive'){
            var tax_value = unit_price * parseFloat(quantity)  * parseFloat(tax_per)/100;
            var original_price = parseFloat(quantity) * parseFloat(unit_price) + parseFloat(tax_value);
            
        }
        
        if(discount_type == 'Flat'){
            var discount_value = parseFloat(discount_per);
            var subtotal = parseFloat(quantity) * parseFloat(unit_price) + parseFloat(tax_value) - parseFloat(discount_value);
        }
        else if(discount_type == 'Percentage'){
            if(discount_per > 0){  discount_per = parseFloat(discount_per) / 100; }  
            var discount_value = parseFloat(original_price) * parseFloat(discount_per);
            var subtotal = parseFloat(original_price) -  parseFloat(discount_value);
        }
        
        $('table#product-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.tax_value').val(tax_value.toFixed(2));
        $('table#product-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.discount-value').val(discount_value.toFixed(2));
        $('table#product-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.discount-value-text').text(discount_value.toFixed(2));
        $('table#product-list tbody tr:nth-child(' + (rowindex + 1) + ')').find('.sub-total').val(subtotal.toFixed(2));
        calcGrandTotal();

    }

    function calcGrandTotal(){
         var paymentType = $('.payment_type:checked').val();
         var splDiscount = $('.spl-discount').val();
         var totalTaxPercentage = 0;
         var totalTaxValue = 0;
         var totalDiscountPercentage = 0;
         var totalDiscountValue = 0;
         var netTotal = 0;
         var grandTotal = 0;

         $(".tax_per").each(function() {
            totalTaxPercentage += parseFloat($(this).val());
         });

         $(".tax_value").each(function() {
            totalTaxValue += parseFloat($(this).val());
         });

         $(".discount_per").each(function() {
            totalDiscountPercentage += parseFloat($(this).val());
         });

         $(".discount-value").each(function() {
            totalDiscountValue += parseFloat($(this).val());
         });

         $(".sub-total").each(function() {
            netTotal += parseFloat($(this).val());
         });

         grandTotal = netTotal - splDiscount;
        
         $(".tax_value_total").val(totalTaxValue.toFixed(2));
         $(".discount_per_total").val(totalDiscountPercentage.toFixed(2));
         $(".discount-value-total").text(totalDiscountValue.toFixed(2));
         $(".sub-net-total").val(netTotal.toFixed(2));
         $(".sub-net-total").text(netTotal.toFixed(2));
         $(".grand-total").val(grandTotal.toFixed(2));
         $(".grand-total-text").text(grandTotal.toFixed(2));
         $(".round-up-amount").val(grandTotal.toFixed(2));
         $(".round-up-amount-text").text(grandTotal.toFixed(2));
         if(paymentType == 'Cash'){
            $('.payable-amount').val(grandTotal.toFixed(2));
         }
         else{
            $('.payable-amount').val(0.00); 
         }
    }
        
    $('.payable-amount').keyup(function(){
        $('.changeBalanceText').text('Loading...');
        var payableAmount = $(this).val();
        calcBalanceChange(payableAmount);
    });
    

    $("table#product-list").on('input', '.quantity', function() {
        var rowindex = $(this).closest('tr').index();
        calculateRowProductData(rowindex);
    });

    $("table#product-list").on('input', '.unit_price', function() {
        var rowindex = $(this).closest('tr').index();
        calculateRowProductData(rowindex);
    });

    $("table#product-list").on('input', '.tax_per', function() {
        var rowindex = $(this).closest('tr').index();
        calculateRowProductData(rowindex);
    });

    $("table#product-list").on('input', '.discount_per', function() {
        var rowindex = $(this).closest('tr').index();
        calculateRowProductData(rowindex);
    });

    $('.spl-discount').keyup(function(){
        calcGrandTotal();
    })

    $('.payment_type').click(function(){
        calcGrandTotal();
    })

    $("table#product-list tbody").on("click", ".remove", function(event) {
        rowindex = $(this).closest('tr').index();
        $(this).closest("tr").remove();
        calcGrandTotal();
    });

    function calcBalanceChange(payableAmount){
        var grandTotal = $(".grand-total").val();
        if(grandTotal > payableAmount){
            $('#changeBalanceLabel').text("Balance to be paid");
            var changeBalance = grandTotal - payableAmount;
        }
        else if(grandTotal <= payableAmount){
            $('#changeBalanceLabel').text("Change");
            var changeBalance =  payableAmount - grandTotal;
        }
        $('.changeBalanceText').text(Math.abs(changeBalance));
        $('.changeBalance').val(Math.abs(changeBalance));
    }

});