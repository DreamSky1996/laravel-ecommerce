$(document).ready(function () {
    $('select.categorySelect').change(function(){

        var sel_option = $('select.categorySelect').val();
        var searchKey = $('#searchKey').val();
        product_data(searchKey, sel_option);
    });
    $('#SearchClick').click(function () {
        var searchKey = $('#searchKey').val();
        var sel_option = $('select.categorySelect').val();
        product_data(searchKey, sel_option);
    });
    function product_data(searchKey, sel_option)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url:"productFilter",
            data: {
                searchKey: searchKey,
                sel_option : sel_option
            },
            success:function(data)
            {
                console.log(data);
                $('#product_data').html(data);
            },
            error:function () {
                console.log('error');
            }
        });

    }
})
