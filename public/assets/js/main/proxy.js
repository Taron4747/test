$(document).ready(function() {
    $("body").on('click','.proxy_remove', function (e) {
        var id = $(this).data('id');
        $('#removeProxy').val(id)

    })
    $("body").on('click','.proxy_edit', function (e) {
        var id = $(this).data('id');
        $.ajax({
            url: '/get-proxy/'+id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.success==1) {
                    $('#name').val(response.data.name)
                    $('#description').val(response.data.description)
                    $('#proxy_list').text(response.data.list)
                    $('#proxy_id').val(response.data.id)
                    $('#submitProxy').text('Сохранить')
                    $('#add-proxy').click()
                }
            },
            headers:{
                'X-CSRF-TOKEN': $('meta[name="X-CSRF-TOKEN"]').attr('content')
            },
            error: function(error) {

            }
        });
    })
    $("body").on('click','.proxy_list', function (e) {
        var id = $(this).data('id');
        $.ajax({
            url: '/get-proxy/'+id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.success==1) {
                    $('#proxyList').text(response.data.list)
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