$(function() {
    
    // Search Product
    var fetchProductUrl = $('#fetch-product-url').val();
    var token = $('meta[name="csrf-token"]').attr('content');
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
                    $('#search-indicator-product').html('<div><span class="spinner-border spinner-border-custom-4 text-primary" role="status"></span><span class="ml-4">Please wait! Searching...</span></div>');
                },
                success: function( data ) {
                    if(data.length > 0){
                        response( data );
                    }
                    else{
                        $('#search-product-service').val('');
                        $('#search-indicator-product').html('<div class="text-danger">No Data Found!</div>');
                        return false;
                    }
                }
            });
        },
        select: function (event, ui) {
            setProduct(ui.item);
            $('#search-indicator-product').html('');
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
                    flag = 0;
                }
            });
            if(flag){
                var newRow = $("<tr>");
                var cols = '';
                cols += '<td><button class="btn btn-sm btn-danger remove" type="button">-</button></td>';
                cols += '<td><input name="product_id[]" type="hidden"  value="'+data.id+'" required/>'+data.value+'</td>';
                cols += '<td><input name="quantity[]" type="number"  value="1" class="form-control quantity" step=".01" required/></td>';
                cols += '<td><input name="unit_id[]" type="hidden" class="form-control" value="'+data.unit_id+'" required>'+data.unit+'</td>';                     
                cols += '<td><input name="unit_price[]" type="number"  value="'+data.rate+'" class="form-control unit_price" step=".01" required/></td>';
                cols += '<td><input name="tax_percentage[]" type="number"  value="'+data.tax_per+'" class="form-control tax_per" step=".01" required/></td>';
                cols += '<td><input name="tax_value[]" type="number"  value="0.00" class="form-control tax_value" step=".01" required/></td>';
                cols += '<td><input name="discount_percentage[]" type="number"  value="0.00" class="form-control discount_per" step=".01" required/>(<span class="discount-value-text">0.00</span>)</td>';
                cols += '<td><input name="total_value[]" type="number"  value="0.00" class="form-control sub-total" step=".01" required/>';
                cols += '<input name="discount_value[]" type="hidden" class="discount-value" value="0.00" required/>';
                cols += '<input type="hidden" class="sub-total-wo-disc" value="0.00"/>';
                cols += '<input type="hidden" class="product-code" value="'+data.code+'" required/></td>';
                newRow.append(cols);
                $("table#product-list tbody").append(newRow);
                $('#search-product-service').val('');
                $('#product_id').val('');
                rowindex = newRow.index();
                calculateRowProductData(rowindex); 
            }
        }
        else{
            $('#search-indicator-product').html('<div class="text-danger">Something went wrong! Try again</div>');
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
    }

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

    $("table#product-list tbody").on("click", ".remove", function(event) {
        rowindex = $(this).closest('tr').index();
        $(this).closest("tr").remove();
        calcGrandTotal();
    });
    

});