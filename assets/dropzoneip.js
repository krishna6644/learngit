Dropzone.autoDiscover = false;


$(function() {
    //Dropzone class
    
    var myDropzone = new Dropzone(".dropzone", {
       url:base_url+"dropzone/dragDropUpload",
       addRemoveLinks: true,
    });
    
    myDropzone.on("sending", function(file, xhr, formData) { 

        formData.append("product_id", $('#product_id').val());  
       
       });
        
   
});
