/**
 * Created by romain on 16/04/14.
 */



    //Give onclick functionality to the cells in the calendar
$('table.availability td.checkbox').click(function(e)
{
    e.preventDefault();
    //See if the cell is already checked
    var $checkbox = $(this).find('input[type=checkbox]');
    var $is_checked = $checkbox.attr('checked');
    if ($is_checked) // uncheck it if so
    {
        $checkbox.attr('checked', false);
        $(this).removeClass('checked');
    }
    else // check it if not
    {
        $checkbox.attr('checked', true);
        $(this).addClass('checked');
    }
});




/**
 * Will toggle the short notice section of the availability lightbox
 * depending on whether the user has checked or unchecked the box
 * @param checkbox - the short notice checkbox html object
 *
 * @return none
 */
function toggle_short_notice(checkbox)
{
    if (checkbox.checked)
    {	//Display short notice info if box is checked
        $("#short_notice").css("display", "block");
        //Product wants a spacing above the .availability_duration div ONLY
        //when short notice area isn't displayed
        $(".dynamic_spacing").css("display", "none");
    }
    else
    {	//Hide short notice info if box is not checked
        $("#short_notice").css("display", "none");
        //Product wants a spacing above the .availability_duration div ONLY
        //when short notice area isn't displayed
        $(".dynamic_spacing").css("display", "block");
    }
}

/**
 * This function is called when the user submits the calendar in the availability
 * lightbox. It will check to ensure that the calendar wasn't left empty, and
 * if it was, it will warn the user to fill out the calendar.
 */
function check_avail_submit()
{
    // Validate mobile phone
    /*if (
     parseInt($('input[name="receive_job_post_sms"]:checked').val(), 10) > 0 &&
     $.trim($('#mobile_phone').val().replace(/\D+/g, '')).length != 10
     )
     {
     $("#mobile_phone_error").show();
     return false;
     }
     else
     {
     $("#mobile_phone_error").hide();
     }*/

    //Check to make sure that at least 1 box in the calendar is checked
    var count_checks = $('table.availability td.checkbox.checked').length;

    //Check to ensure that the sitter is not submitting an empty calendar
    if(0 == count_checks)
    {	/* The user has attempted to submit an empty availability calendar.
     * pop a confirm dialog prompting the sitter to confirm that they want
     * to be in an unavailable state
     */
        if ($('#warning_popup_unavailable').length)
        {
            toggleLightbox('availability_lightbox');
            toggleLightbox('warning_popup_unavailable', this, 'dark');
        }
        else
        {
            //Present the user with the confirm dialog
            var SUBMITTING_EMPTY_AVAILABILITY_CALENDAR = 1;
            confirm_unavailable_dialog(SUBMITTING_EMPTY_AVAILABILITY_CALENDAR);
        }
    }
    else
    {	//User is not submitting an empty calendar
        //Close the availability lightbox
        //toggleLightbox('availability_lightbox', this, 'dark');
        //Submit the form
        $("#availability_form").submit();
    }
}

/**
 * If the sitter takes actions that would leave them in an unavailable state,
 * we want to pop a JS confirm dialog asking them if they really want to go
 * unavailable.  There are 2 scenarios where this occurs (listed below at the
 * @param source tag). While the 2 scenarios have different wording and take
 * different action upon clicking "Cancel" I have addressed both scenarios
 * in this 1 function because they contain the same general logic and accomplish
 * the same task.
 *
 * @param source - 0 refers to clicking the "go unavailable" link
 *               - 1 refers to submitting an empty calendar in the availability lightbox
 */
function confirm_unavailable_dialog(source)
{
    var CLICKING_GO_UNAVAILABLE_BUTTON = 0;
    //Check what action sitter took to cause us to pop the confirm unavailable dialog
    if (CLICKING_GO_UNAVAILABLE_BUTTON === source)
    {	//Sitter has clicked the "go unavailable" link on mysittercity page
        message = 'By going unavailable you will not be found in search until you edit and confirm availability again at a later date. Would you like to continue?';
        var confirm_choice = confirm(message);
        //Check whether they clicked "OK" or "Cancel" in the confirm dialog box
        if (true == confirm_choice)
        {	//If they clicked "OK", mark them as unavailable
            unavailable_action();
        }alert
        //If they clicked "Cancel", do nothing
    }
    else
    {	//Sitter attempted to submit an empty availability calendar from the availabiltiy lightbox
        message = 'You will be marked as unavailable. If this is not correct, please hit cancel and indicate what times you expect to be available on the calendar.';
        var confirm_choice = confirm(message);
        //Check whether they clicked "OK" or "Cancel" in the confirm dialog box
        if (true == confirm_choice)
        {	//If they clicked "OK", submit the form. We don't want to run the
            //unavailable action because we want their calendar to be wiped clean.
            $("#availability_form").submit();
        }
        //If they clicked "Cancel", do nothing
    }
}

/**
 * This function is called when the user wants to go unavailable, or has chosen
 * to submit an empty calendar despite being given a warning.
 */
function unavailable_action()
{
    //Set the hidden input field going_unavailable to tell the controller
    //that the user is going unavailable
    $("#chosen_action").attr('value', "unavailable");
    //Submit the form for processing
    $("#availability_form").submit();
}

/**
 * This function is called when the user clicks the "One-Click Renew" button.
 * It will renew their availability according to their previously set availability.
 */
function renew_action()
{
    //Set the hidden input field going_unavailable to tell the controller
    //that the user is going unavailable
    $("#chosen_action").attr('value', "renew");
    //Submit the form for processing
    $("#availability_form").submit();
}