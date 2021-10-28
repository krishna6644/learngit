$(document).ready(function() {
 
    $(document).on("click", '.probutton', function( event ) {
       event.preventDefault();
        console.log("hello")
        var product = $(this).attr('id');
       console.log(product)
        
        $.ajax({
            url: base_url+"product/getname",
            dataType: 'JSON',
            method: 'POST',
            data: {
                _token: '{{ csrf_token() }}',
                'pro_id': product,
               
            },
            
            success: function(response) {
               console.log(response);  

               var f= $(".images_data").html(response);
              
            //    var f= $("#imgprod").attr('src',response);
            //    console.log(f);
           
            }
        });

    });
}); // document ready ends