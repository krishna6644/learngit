$(document).ready(function() {
    $('#frm-filter-btn').on("click", function() {
        event.preventDefault();

        var table = $('#rep_news');

        $.ajax({
            url: base_url+"product/get_news_by_filters",
            dataType: 'JSON',
            method: 'POST',
            data: {
                'filter_news_title': $('#filter_title').val(),
                'cat_title': $('#parentcat').val(),
                'sub_cat_title': $('#subcat').val(),
                'price_search': $('#price_filter').val()
            },
            
            success: function(data_return) {
               

                // destroy the DataTable
                
                table.dataTable().fnDestroy();
                console.log(data_return);   
                // clear the table body
                table.find('tbody').empty();
                // reinitiate
                table.DataTable({
                    // # data source as object (JSON object array)
                    // You must use the exactly format as shown on the link below
                    // https://datatables.net/manual/data/#Objects
                    data: data_return,
                    columns: [
                        {
                            "data": "parent_cat"
                        },
                        {
                            "data": "sub_cate"
                        },
                        {
                            "data": "product_name"
                        },
                        {
                            "data": "slug"
                        },
                        {
                            "data": "price"
                        },
                        {
                            "data": "selling_price"
                        },
                        {
                            "data": "stock"
                        },
                        {
                            "data": "status"
                        },
                    ],
                   
                });
            }
        });

    });
}); // document ready ends