$(document).ready(function() {
    $("body").on('click','.setting_remove', function (e) {
        var id = $(this).data('id');
        $('#removesetting').val(id)

    })
    $("body").on('click','.setting_edit', function (e) {
        var id = $(this).data('id');
        $.ajax({
            url: '/get-setting/'+id,
            type: 'GET',
            dataType: 'json',
            success: function(response) {
                if(response.success==1) {
                    $('#ip_server').val(response.data.ip_server)
                    $('#description').text(response.data.description)
                    $('#CtRInput').val(response.data.persent_ctr)
                    $('#setting_id').val(response.data.id)
                    if (response.data.server_mode ==1) {
                    $('#work').prop("checked", true);

                    }else if(response.data.server_mode ==2){
                        $('#walk').prop("checked", true);

                    }else if(response.data.server_mode ==3){
                        $('#new').prop("checked", true);

                    }

                    if (response.data.persent_ua_chb_chrome ==1) {
                        $('#percentChromCheckbox').prop("checked", true);

                    }
                     if (response.data.persent_ua_chb_opera) {
                        
                        $('#cbxOpera').prop("checked", true);

                    }
                     if (response.data.persent_ua_chb_andex) {
                        $('#cbxYandex').prop("checked", true);
                        
                    }
                     if (response.data.autch_mail) {
                        $('#activeAuthMail').prop("checked", true);
                        
                    }
                    if (response.data.xputh_chb) {
                        $('#xputh_chb').prop("checked", true);
                        
                    }

                    $('#persentChrome').val(response.data.persent_ua_chrome)
                    $('#persentOpera').val(response.data.persent_ua_opera)
                    $('#persentYandex').val(response.data.persent_ua_yandex)
                    $('#timeToWalk').val(response.data.time_session_vigul)
                    $('#xputh_val').val(response.data.xputh_val)
                    $('#nignht_time').val(response.data.nignht_time)
                    $('#day_time').val(response.data.day_time)

                    $('#selectBaseMailList option').each(function(){ 

                        if ($(this).val() == response.data.select_mail_base) {
                            $(this).attr('selected','selected')
                        }
                     });
                    $('#selectIpList option').each(function(){ 
                         if ($(this).val() == response.data.proxy) {
                            $(this).attr('selected','selected')
                        }
                     });
                    $('#SelectCookiesIpList option').each(function(){ 
                         if ($(this).val() == response.data.cookie_table) {
                            $(this).attr('selected','selected')
                        }


                     });
                    $('#selectSiteList option').each(function(){ 
                         if ($(this).val() == response.data.site) {
                            $(this).attr('selected','selected')
                        }
                    });

                    $('#submitsetting').text('Сохранить')
                    $('#add-setting').click()
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