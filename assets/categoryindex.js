
var table = $('#firsttable');
$(document).ready(function() {
    table.DataTable({
        processing: true, 
        serverSide: true, 
        responsive: {
            details: false
        },
        order: [], 
        
        ajax: {
            url: base_url+"category/list",
            type: "POST",
            data: function ( data ) {
                data.type = $("input[name=cate_type]").val();
                data.parent_cate = $("input[name=parent_category]").val();
            }
        },
 
        "columnDefs": [
            { 
                "targets": [ 1 ], 
                "orderable": false,
            },
            { 
                "targets": [ -1 ], 
                "orderable": false, 
            },
        ],
    });
});

// delete group
$(document).on('click','.delete-single', function () {
    event.preventDefault();
    var tag_id = $(this).attr('data-id');
    if(tag_id == ''){
        swal.fire({
            title: 'Something went wrong, try again later',
            type: 'error',
            animation: false,
            customClass: 'animated tada'
        })
        return false;
    }
    swal.fire({
        title: 'Are you sure?',
        text: "Are you sure you want to proceed ?",
        type: 'warning',
        showCancelButton: true,
        confirmButtonText: 'Yes'
    }).then(function(result) { 
        if (result.value) {
            $.ajax({
                url : base_url+'category/update_inbulk',
                type : 'POST',
                data : {id:tag_id , status:'delete'},
                dataType:'json',
                beforeSend: function() {
                    swal.fire({
                        title: 'Please Wait..!',
                        text: 'Is working..',
                        onOpen: function() {
                            swal.showLoading()
                        }
                    })
                },
                success : function(data) { 
                    swal.fire({
                        position: 'top-right',
                        type: 'success',
                        title: 'Your work has been saved',
                        showConfirmButton: false,
                        timer: 2000
                    });
                    $('.check-all').prop("checked", false).change();    
                    $('#firsttable').DataTable().ajax.reload()
                },
                complete: function() {
                    swal.hideLoading();
                },
                error: function(jqXHR, textStatus, errorThrown) {
                    swal.fire("!Opps ", "Something went wrong, try again later", "error");
                }
            });
        }
    });
});