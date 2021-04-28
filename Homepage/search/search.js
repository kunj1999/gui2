// File: /Homepage/search/search.css
// E-Tutor
// Kunj Patel, UMass Lowell Computer Science, kunj_patel@student.uml.edu
// Sean Gillis, UMass Lowell Computer Science, sean_gillis1@student.uml.edu
// Copyright (c) 2021 Kunj Patel, Sean Gillis. All rights reserved.

// Last Modified: 04/26/2021

// @param: array of profile matching the users search
// @return: (none)
// purpose: function will iterate through each profile and display it on the webpage
function displaySearchResult(searchArr){

    resultLen = searchArr.length;

    // Check if at least one profile matched the keyward
    if (resultLen) {
        // Iterate through each profile
        for (i =0; i< resultLen; i++) {
            profile = searchArr[i];

            // Format the first and last name into a single name
            tutorName = profile[0] + " " + profile[1];

            // https://stackoverflow.com/questions/29206453/best-way-to-convert-military-time-to-standard-time-in-javascript/29206663
            // Display availibility
            time = profile[2] + " " + moment(profile[3], "HH:mm:ss").format("h:mm A") + " " + moment(profile[4], "HH:mm:ss").format("h:mm A");

            // Call the function that will display the tutor proifles
            createSearchResult(tutorName, profile[5], time, profile[6]);
        }
        return;
    }

    // Display sorrt message if no profile matched user search keyward
    displaySorryMessage();
}

// @param: name of the tutor, subject, availibity and tutor's username
// @return: (none)
// purpose: function will iterate through each profile and display it on the webpage
function createSearchResult(tutorName, subjects, time, username)
{
    // Generate clickable profile, which would redirect the user to tutor profie page
    var newResult = $("<a></a>");
    newResult.addClass("result");
    newResult.attr("href", "/Homepage/profile/tutorProfile.php?" + username);

    // Profile pic
    newPic = $("<i></i>");
    newPic.addClass("resultPic fas fa-user fa-7x");

    newText = $("<div></div>");
    newText.addClass("resultText ml-0 ml-sm-3");
    
    // Display tutor's full name
    newName = $("<p></p>");
    newName.addClass("resultName");
    newName.append(tutorName);

    // Display subjects
    newSubjects = $("<p></p>");
    newSubjects.addClass("resultSubjects");
    newSubjects.append("Subjects: ")
    newSubjects.append(subjects);

    // Display tutor's availibility
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

// @param: (none)
// @return: (none)
// purpose: Displays sorry message when no profiles returned from the DB
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