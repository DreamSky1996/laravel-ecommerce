$(document).ready(function () {
    $('.pagination').addClass('pagination-rounded pagination-md justify-content-end');

    $(document).on('click', '.pagination a', function(event){
        event.preventDefault();
        var page = $(this).attr('href').split('page=')[1];
        fetch_data(page);
    });


    function fetch_data(page)
    {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: "POST",
            url:"order_data",
            data: {
                page : page,
            },
            success:function(data)
            {
                $('#table_data').html(data);
                $('.pagination').addClass('pagination-rounded pagination-md justify-content-end');
            }
        });

    }


})
