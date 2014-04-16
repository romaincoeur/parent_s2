/**
 * Created by romain on 27/03/14.
 */

$(function() {

    // Gestion des calendriers
    /*$(".calendar button").click(function(){
        //alert($(this).css('background-color'));
        if ($(this).css('background-color') == 'rgb(255, 255, 255)')
        {
            $(this).css('background-color','lightgreen');
        }
        else
        {
            $(this).css('background-color','#ffffff');
        }
    });*/

    $(".calendarForm").submit(function(e){
        e.preventDefault();
        var form = this;
        var calendar = '[(';
        $('.calendar button').each(function(index){
            if (index%7 == 0 && index != 0) calendar += ')(';
            if ($(this).css('background-color') == 'rgb(255, 255, 255)')
            {
                calendar += '0';
            }
            else
            {
                calendar += '1';
            }
        });
        calendar += ')]';
        //$('#pn_pnbundle_job_calendar').val(calendar);
        $('#pn_pnbundle_babysitter_calendar').val(calendar);

        form.submit(); // submit bypassing the jQuery bound event
    });

    // Gestion du formulaire d'inscription
    $('#registerForm input').on('change', function() {
        if ($('form input[type=radio]:checked').val() == 'parent')
        {
            $('#registerForm .info p').html('L\'inscription pour les parents coute 9€50 payable en une fois, valable à vie.');
            $('#pn_pnbundle_user_babysitter').css('display','none');
        }
        if ($('form input[type=radio]:checked').val() == 'nounou')
        {
            $('#registerForm .info p').html('L\'inscription est complètement gratuite pour les nounous.');
            $('#pn_pnbundle_user_babysitter').css('display','block');
        }
    });


    // Menu de la page recommandations
    $('#btn-received').click(function(){
        $('#btn-given').removeClass('selected');
        $('#btn-newRecommend').removeClass('selected');
        $(this).addClass('selected');
    })
    $('#btn-given').click(function(){
        $('#btn-received').removeClass('selected');
        $('#btn-newRecommend').removeClass('selected');
        $(this).addClass('selected');
    })
    $('#btn-newRecommend').click(function(){
        $('#btn-given').removeClass('selected');
        $('#btn-received').removeClass('selected');
        $(this).addClass('selected');
    });


    // Envoi de formulaire en AJAX
    function postForm( $form, callback1, callback2 ){

        /*
         * Get all form values
         */
        var values = {};
        $.each( $form.serializeArray(), function(i, field) {
            values[field.name] = field.value;
        });

        /*
         * Throw the form values to the server!
         */
        $.ajax({
            type        : $form.attr( 'method' ),
            url         : $form.attr( 'action' ),
            data        : values,
            success     : function(data) {
                callback1( data );
            },
            error     : function(data) {
                callback2( data );
            }
        });

    }

    // Inscription AJAX
    $( '#registerForm' ).submit( function( e ){
        e.preventDefault();

        postForm(
            $(this),
            function( response ){
                if (response.success)
                {
                    location.reload();
                }
                else
                {
                    $('#registerErrors').html(response.cause)
                }
            },
            function(error){
                $('#registerErrors').html(error)
            }
        );

        return false;
    });

    // Gestion du compte
    $( '#changePasswordForm' ).submit( function( e ){
        e.preventDefault();

        postForm(
            $(this),
            function( response ){
                if (response.success)
                {
                    $( "#account_management button.close" ).trigger( "click" );
                }
                else
                {
                    $('#changePasswordErrors').html(response.cause)
                }
            },
            function(error){
                $('#changePasswordErrors').html(error)
            }
        );

        return false;
    });

    // Affichage des conversations
    $('.message-leftMenu .btn').click(function(){
        $('.message-leftMenu .btn').removeClass('selected');
        $(this).addClass('selected');
        $('.conversation').removeClass('selected');
        $('.conversation#'+$(this).attr('id')).addClass('selected');
    })

    // Envoi d'un message
    $('.conversation form').submit(function(e){
        e.preventDefault();

        $('.conversation.selected textarea').css('background','url("../../bundles/pnpn/images/icons/ajax-loader.gif") no-repeat right white');
        $('.conversation.selected input[type="submit"]').attr('disabled', true);

        postForm(
            $('.conversation.selected form'),
            function(response){
                $('#'+$('.conversation.selected form').attr('id')+' .message').last().after('' +
                    '<div class="message to">' +
                    '   <div class="bulle">' +
                    '       <p>' + response.message + '</p>' +
                    '   </div>' +
                    '   <img class="arrow" src="/parent_s2/web/bundles/pnpn/images/icons/right-arrow.png" alt="right-arrow">' +
                    '   <img src="/parent_s2/web/bundles/pnpn/images/illus/nounou.jpg" alt="nounou" style="height: 90px;">' +
                    '</div>'
                );
                $('.conversation.selected textarea').css('background','white');
                $('.conversation.selected input[type="submit"]').attr('disabled', false);
            },
            function (error){

            }
        );
    })

})