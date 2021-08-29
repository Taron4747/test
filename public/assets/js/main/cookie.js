$(document).ready(function() {
    $("body").on('click','.cookie_remove', function (e) {
        var id = $(this).data('id');
        $('#removeCookie').val(id)

    })
    $("body").on('click','.cookie_edit', function (e) {
        var id = $(this).data('id');
        $.ajax({
            url: '/get-cookie/'+id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.success==1) {
                    $('#name').val(response.data.name)
                    $('#ip').val(response.data.ip)
                    $('#description').val(response.data.description)
                    $('#cookie_id').val(response.data.id)
                    $('#submitCookie').text('Сохранить')
                    $('#add-cookie').click()
                }
            },
            headers:{
                'X-CSRF-TOKEN': $('meta[name="X-CSRF-TOKEN"]').attr('content')
            },
            error: function(error) {

            }
        });
    })
    $("body").on('click','.cookie_list', function (e) {
        var id = $(this).data('id');
        $.ajax({
            url: '/get-cookie/'+id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.success==1) {
                    $('#cookieList').text(response.data.list)
                    $('#openProxyList').click()
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