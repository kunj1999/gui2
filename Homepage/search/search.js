$(document).ready(function()
{
    var error = false;

    if(error == true)
    {
        displaySorryMessage("Einstein");
    }
    else
    {
        for(var i = 0; i < 20; i+= 1)
        {
            createSearchResult("Kunj Patel", "x, y, z", "Monday 2:00 - 3:00");
        }
    }

});


function createSearchResult(name, subjects, time)
{
    var newR = $("<a></a>");
    newR.addClass("result");
    newR.attr("href", "../../index.html");

    newPic = $("<i></i>");
    newPic.addClass("resultPic fas fa-user fa-5x");

    newText = $("<div></div>");
    newText.addClass("resultText");
    
    newName = $("<p></p>");
    newName.addClass("resultName");
    newName.append(name);

    newSubjects = $("<p></p>");
    newSubjects.addClass("resultSubjects");
    newSubjects.append("Subjects: ")
    newSubjects.append(subjects);

    newTime = $("<p></p>");
    newTime.addClass("resultTime");
    newTime.append("Time: ")
    newTime.append(time);

    newText.append(newName);
    newText.append(newSubjects);
    newText.append(newTime);

    newR.append(newPic);
    newR.append(newText);

    $(".container").append(newR);
}


function displaySorryMessage(search)
{
    var message = $("<div></div>");
    message.addClass("noResults");

    var sorry = $("<h1></h1>");
    sorry.addClass("sorry");
    sorry.append("Sorry! :(");

    var infoText = "Your search for\"" + search + "\" returned no results."; 

    var info = $("<p></p>");
    info.addClass("sorryInfo");
    info.append(infoText);

    message.append(sorry);
    message.append(info);

    $(".container").append(message);
}