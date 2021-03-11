$(document).ready(function()
{

    $("#yes, #no").change(function()
    {
        if(this.value == "yes")
        {
            $("#tutor-settings").show();
            $("#tutor-settings :input").prop('required', true);
        }
        else
        {
            $("#tutor-settings").hide();
            $("#tutor-settings :input").prop('required', false);
        }
    });

});