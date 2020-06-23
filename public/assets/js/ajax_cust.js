$(document).ready(function () {
    $('.pagination').addClass('pagination-rounded pagination-md justify-content-end');


    $('.edit_user').click(function () {
        let edit_user_email = this.offsetParent.parentNode.children[3].innerText;
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: 'updateUser',
            data: {
                edit_user_email: edit_user_email
            },
            success: function (result) {
                let userResult = JSON.parse(result);
                console.log(userResult);
                $('#userId').val(userResult.id);
                $('#firstName').val(userResult.first_name);
                $('#lastName').val(userResult.last_name);
                $('#email').val(userResult.email);
                $('#phoneNumber').val(userResult.phone);
                $('#role').val(userResult.role);
                $('#lat').val(userResult.lat);
                $('#myModalUser').modal('show');

            },
            error: function (error) {
                console.log(error)
            }

        });
    });

    $(document).on('click', '.pagination a', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        var sel_option = $('select.selectpicker').val();
        fetch_data(page,sel_option);
    });


    function fetch_data(page,sel_option)
    {

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url:"admin/fetch_data",
            data: {
                page : page,
                option : sel_option
            },
            success:function(data)
            {
                $('#table_data').html(data);
                $('.pagination').addClass('pagination-rounded pagination-md justify-content-end');
            }
        });

    }


    $('select.selectpicker').change(function(){

        var page = 1;
        var sel_option = $('select.selectpicker').val();
        fetch_data(page,sel_option);

    });

    $('.edit_product').click(function () {
        let edit_product_id = this.offsetParent.parentNode.children[0].innerText;
        console.log(edit_product_id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: 'updateProduct',
            data: {
                edit_product_id: edit_product_id
            },
            success: function (result) {
                let productResult = JSON.parse(result);
                console.log(productResult);
                $('#productId').val(productResult.id);
                $('#productName').val(productResult.product_name);
                $('#productDescription').val(productResult.description);
                $('#productPrice').val(productResult.price);
                $('#category').val(productResult.product_category);
                $('#productInventory').val(productResult.inventory);
                $('#productPreview').attr('src', "https://portal.truetimber.net/product_images/"+productResult.main_image);
                $('#myModalProduct').modal('show');
            },
            error: function (error) {
                console.log(error)
            }

        });
    })

    $('.edit_category').click(function () {
        let edit_category_id = this.offsetParent.parentNode.children[0].innerText;
        console.log(edit_category_id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: 'updateCategory',
            data: {
                edit_category_id: edit_category_id
            },
            success: function (result) {
                let categoryResult = JSON.parse(result);
                console.log(categoryResult);
                $('#categoryId').val(categoryResult.id);
                $('#categoryName').val(categoryResult.category_name);
                $('#myModalCategory').modal('show');
            },
            error: function (error) {
                console.log(error)
            }

        });
    })

    $('.delete_category').click(function () {
        let delete_category_id = this.offsetParent.parentNode.children[0].innerText;
        console.log(delete_category_id);
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url: 'deleteCategory',
            data: {
                delete_category_id: delete_category_id
            },
            success: function (result) {
                console.log(result);
                history.go(0);
            },
            error: function (error) {
                console.log(error)
            }

        });
    })
})
