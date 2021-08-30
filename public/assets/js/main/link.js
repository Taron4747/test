$(document).ready(function() {
    $("body").on('click','.link_remove', function (e) {
        var id = $(this).data('id');
        $('#removeLink').val(id)

    })
    $("body").on('click','.link_edit', function (e) {
        var id = $(this).data('id');
        $.ajax({
            url: '/get-link/'+id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.success==1) {
                    $('#name').val(response.data.name)
                    $('#description').val(response.data.description)
                    $('#link_list').text(response.data.list)
                    $('#link_id').val(response.data.id)
                    $('#submitProxy').text('Сохранить')
                    $('#add-link').click()
                }
            },
            headers:{
                'X-CSRF-TOKEN': $('meta[name="X-CSRF-TOKEN"]').attr('content')
            },
            error: function(error) {

            }
        });
    })
    $("body").on('click','.link_list', function (e) {
        var id = $(this).data('id');
        $.ajax({
            url: '/get-link/'+id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.success==1) {
                    $('#linkList').text(response.data.list)
                    $('#openLinkList').click()
                }
            },
            headers:{
                'X-CSRF-TOKEN': $('meta[name="X-CSRF-TOKEN"]').attr('content')
            },
            error: function(error) {

            }
        });
    })
} );