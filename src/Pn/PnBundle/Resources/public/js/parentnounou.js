/**
 * Created by romain on 27/03/14.
 */

$(function() {

    $(".calendar button").click(function(){
        //alert($(this).css('background-color'));
        if ($(this).css('background-color') == 'rgb(255, 255, 255)')
        {
            $(this).css('background-color','lightgreen');
        }
        else
        {
            $(this).css('background-color','#ffffff');
        }
    });

    $("#createJobForm").submit(function(e){
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
        $('#pn_pnbundle_job_calendar').val(calendar);

        form.submit(); // submit bypassing the jQuery bound event
    });
})