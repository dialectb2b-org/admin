$(function() {
   
    // Search Product
    var fetchProductUrl = $('#fetch-product-url').val();
    var fetchCustomerUrl = $('#fetch-customer-url').val();
    var fetchSupplierUrl = $('#fetch-supplier-url').val();
    var token = $('meta[name="csrf-token"]').attr('content');
    $("#search-product").autocomplete({
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
                    $('#search-indicator').html('<div><span class="spinner-border spinner-border-custom-4 text-primary" role="status"></span><span class="ml-4">Please wait! Searching...</span></div>');
                },
                success: function( data ) {
                    if(data.length > 0){
                        response( data );
                    }
                    else{
                        $('#search-product').val('');
                        $('#product_id').val('');
                        $('#unit_id').val('');
                        $('#search-indicator').html('<div class="text-danger">No Data Found!</div>');
                        return false;
                    }
                }
            });
        },
        select: function (event, ui) {
            $('#search-product').val(ui.item.label);
            $('#product_id').val(ui.item.id);
            $('#unit_id').val(ui.item.unit_id);
            $('#search-indicator').html('');
            return false;
        }
    });

    $("#search-customer").autocomplete({
        source: function( request, response ) {
            $.ajax({
                url:fetchCustomerUrl,
                type: 'get',
                dataType: "json",
                data:{
                    _token: token, 
                    search:request.term
                },
                beforeSend: function() {
                    $('#search-indicator-customer').html('<div><span class="spinner-border spinner-border-custom-4 text-primary" role="status"></span><span class="ml-4">Please wait! Searching...</span></div>');
                },
                success: function( data ) {
                    console.log(data);
                    if(data.length > 0){
                        response( data );
                    }
                    else{
                        $('#search-customer').val('');
                        $('#customer_id').val('');
                        $('#search-indicator-customer').html('<div class="text-danger">No Data Found!</div>');
                        return false;
                    }
                }
            });
        },
        select: function (event, ui) {
            $('#search-customer').val(ui.item.label);
            $('#customer_id').val(ui.item.id);
            $('#search-indicator-customer').html('');
            return false;
        }
    });

    $("#search-supplier").autocomplete({
        source: function( request, response ) {
            $.ajax({
                url:fetchSupplierUrl,
                type: 'get',
                dataType: "json",
                data:{
                    _token: token, 
                    search:request.term
                },
                beforeSend: function() {
                    $('#search-indicator-supplier').html('<div><span class="spinner-border spinner-border-custom-4 text-primary" role="status"></span><span class="ml-4">Please wait! Searching...</span></div>');
                },
                success: function( data ) {
                    console.log(data);
                    if(data.length > 0){
                        response( data );
                    }
                    else{
                        $('#search-supplier').val('');
                        $('#supplier_id').val('');
                        $('#search-indicator-supplier').html('<div class="text-danger">No Data Found!</div>');
                        return false;
                    }
                }
            });
        },
        select: function (event, ui) {
            $('#search-supplier').val(ui.item.label);
            $('#supplier_id').val(ui.item.id);
            $('#search-indicator-supplier').html('');
            return false;
        }
    });


});