
function displaySearchResult(searchArr){

    resultLen = searchArr.length;

    if (resultLen) {
        
        for (i =0; i< resultLen; i++) {
            profile = searchArr[i];
            // Formate the name of the tutor
            tutorName = profile[0] + " " + profile[1];

            // https://stackoverflow.com/questions/29206453/best-way-to-convert-military-time-to-standard-time-in-javascript/29206663
            time = profile[2] + " " + moment(profile[3], "HH:mm:ss").format("h:mm A") + " " + moment(profile[4], "HH:mm:ss").format("h:mm A");
            // Call the function that will display the tutor proifles
            createSearchResult(tutorName, profile[5], time, profile[6]);
        }
        return;
    }
    displaySorryMessage();
}


function createSearchResult(tutorName, subjects, time, username)
{
    var newResult = $("<a></a>");
    newResult.addClass("result");
    newResult.attr("href", "../../index.html");

    newPic = $("<i></i>");
    newPic.addClass("resultPic fas fa-user fa-7x");

    newText = $("<div></div>");
    newText.addClass("resultText ml-0 ml-sm-3");
    
    newName = $("<p></p>");
    newName.addClass("resultName");
    newName.append(tutorName);

    newSubjects = $("<p></p>");
    newSubjects.addClass("resultSubjects");
    newSubjects.append("Subjects: ")
    newSubjects.append(subjects);

    newTime = $("<p></p>");
    newTime.addClass("resultTime");
    newTime.append("Time: ")
    newTime.append(time);

    // We give every profile 4 start until we have the feature up and running
    // https://www.w3schools.com/howto/howto_css_star_rating.asp
    avgRating = $("<i></i>")
    avgRating.addClass("fas fa-star")
    for(i=0; i<4; i++){
        newText.append(avgRating.clone());
    }
    avgRating.removeClass("fas").addClass("far");
    newText.append(avgRating.clone());

    newText.append(newName);
    newText.append(newSubjects);
    newText.append(newTime);

    newResult.append(newPic);
    newResult.append(newText);

    $(".container").append(newResult);
}


function displaySorryMessage()
{
    var message = $("<div></div>");
    message.addClass("noResults");

    var sorry = $("<h1></h1>");
    sorry.addClass("sorry");
    sorry.append("Sorry! :(");

    var infoText = "Your search returned no results."; 

    var info = $("<p></p>");
    info.addClass("sorryInfo");
    info.append(infoText);

    message.append(sorry);
    message.append(info);

    $(".container").append(message);
}