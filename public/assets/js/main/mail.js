$(document).ready(function() {
    $("body").on('click','.mail_remove', function (e) {
        var id = $(this).data('id');
        $('#removeMail').val(id)

    })
    $("body").on('click','.mail_edit', function (e) {
        var id = $(this).data('id');
        $.ajax({
            url: '/get-mail/'+id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.success==1) {
                    $('#name').val(response.data.name)
                    $('#description').val(response.data.description)
                    $('#mail_list').text(response.data.list)
                    $('#mail_id').val(response.data.id)
                    $('#submitMail').text('Сохранить')
                    $('#add-mail').click()
                }
            },
            headers:{
                'X-CSRF-TOKEN': $('meta[name="X-CSRF-TOKEN"]').attr('content')
            },
            error: function(error) {

            }
        });
    })
    $("body").on('click','.mail_list', function (e) {
        var id = $(this).data('id');
        $.ajax({
            url: '/get-mail/'+id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.success==1) {
                    $('#mailList').text(response.data.list)
                    $('#openMailList').click()
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