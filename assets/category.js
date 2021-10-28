$(document).ready(function() {
    $("#parentcat").on('change', function() {
        var Cat = $(this).val();
        $("#subcat").html('');
       

        $.ajax({
             
            url: base_url+"datalog",
            type: "POST",

            data: {
                _token: '{{ csrf_token() }}',
                category_id:Cat
            },
            dataType: "json",
            success: function(response) {
                console.log(response);
                $("#subcat").html('<option value="">Select Sub Category</option>');

                $.each(response, function(key, data) {
                    $("#subcat").append('<option value="' + data.cat_id + '">' + data.category_name +
                        '</option>');
                });

            }
        });

    });
})