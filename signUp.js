$(document).ready(function() 
{

    $("#yes, #no").change(function()
    {
        if(this.value == "yes")
        {
            $("#tutor-settings").show();
        }
        else
        {
            $("#tutor-settings").hide();
        }
    });

});