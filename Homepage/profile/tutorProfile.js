
// File: /Homepage/profile/tutorProfile.js
// E-Tutor
// Kunj Patel, UMass Lowell Computer Science, kunj_patel@student.uml.edu
// Sean Gillis, UMass Lowell Computer Science, sean_gillis1@student.uml.edu
// Copyright (c) 2021 Kunj Patel, Sean Gillis. All rights reserved.

// Last Modified: 04/26/2021


var sessionsPanel;
var reviewsPanel;
var addReviewButton;

// @param: array of reviews, array of sessions offered by tutor
// @return: (none)
// purpose: Function will intialize all tabs
function start(reviews, sessions)
{
    // Initialize tabs
    $("#profileTabs").tabs();

    // Hide adding new review interface
    $("#postReview").hide();

    writeReview();
    displayReviews(reviews);
    displaySessions(sessions);
    ReviewAjax();

    // Add five start input functionality
    $.getScript('https://cdn.jsdelivr.net/npm/starrr@2.0.4/dist/starrr.js', function() {
        $(".starRating").starrr({
            change: function(e, value){
                $("#fiveRating").val(value);
            }
        });
    });
}

// @param: (none)
// @return: (none)
// purpose: Function will attach callback function when adding review form is submitted
function ReviewAjax(){
    $("#reviewForm").submit(function (event) {

        // assemble formdata with tutor's username, comment and five start rating
        var formdata = {
            username: $("#tutorUsername").val(),
            comment: $('#comment').val(),
            fiveRating: $('#fiveRating').val().toString(),
        };

        // Send out post request with formdata using AJAX functionality
        $.ajax({
            type: "POST",
            url: "/Homepage/profile/review.php",
            data: formdata,
        }).done(function (data) {
            console.log(data);
        });
    
        // Show recently added review on reviewPanel
        $("#reviewPanel").prepend($('<hr/>'));
        $("#reviewPanel").prepend(createReview("anonymous", $('#comment').val(), parseInt($('#fiveRating').val())));

        // Reset the text area and hide the interface
        $('#comment').val("");
        $('#postReview').hide();

        return false;
    });
}

// @param: (none)
// @return: (none)
// purpose: Function will toggle write review interface
function writeReview(){

    // when the newReview button is clicked, show write review interface
    $("#newReview").click(function(){
        $("#postReview").show();
    });

    // Hide write review interface on cancel
    $("#cancel").click(function(){
        $("#postReview").hide();
        return false;
    });
}

// @param: array of reviews
// @return: (none)
// purpose: Function will display reviews stored on DB
function displayReviews(reviews) {

    // Iterate through each review in the array and display it to the user
    for (var i = 0; i < reviews.length; i++) {
        $('#reviewPanel').prepend($('<hr/>'));
        $("#reviewPanel").prepend(createReview("anonymous", reviews[i].comments, parseInt(reviews[i].rating)));
    }

}

// @param: name of the reviewer, comment, five star rating
// @return: return html code for displaying the review
// purpose: Function will create html code for displying individual review
function createReview(reviewerName, reviewText, rating)
{
    var newR = $("<div></div>");
    newR.addClass("review");

    var newHeader = $("<div></div>");
    newHeader.addClass("reviewHeader");

    // reviewer's profile pic
    var newPic = $("<i></i>");
    newPic.addClass("reviewerPic fas fa-user fa-3x");

    // reviewer's name
    var newName = $("<p></p>");
    newName.addClass("reviewerName");
    newName.append(reviewerName);

    // five star rating
    var ratingdiv = $('<div></div>');
    ratingdiv.addClass("float-right")

    ratingStar = $("<i></i>")
    ratingStar.addClass("fas fa-star")
    var i =0;
    for(i=0; i<rating; i++){
        ratingdiv.append(ratingStar.clone());
    }
    for(;i<5;i++) {
        ratingStar.removeClass("fas").addClass("far");
        ratingdiv.append(ratingStar.clone());
    }

    newHeader.append(newPic);
    newHeader.append(newName);
    newHeader.append(ratingdiv);

    // Comment left by the user
    var newText = $("<p></p>");
    newText.addClass("reviewText");
    newText.append(reviewText);

    newR.append(newHeader);
    newR.append(newText);

    return newR;
}

function displaySessions(sessions){
    for (i = 0; i<sessions.length; i++){
        $('#sessionsBody').append(session_row(parse_sessionTime(sessions[i])));
    }
}

function parse_sessionTime(oneSession){
    var subject = oneSession[3];

    var startDate = moment(oneSession[0]).format('L');
    var endDate = moment(oneSession[1]).format('L');
    
    if (startDate == endDate){
        var date = startDate
    } else {
        var date = startDate + "-" + endDate;
    }

    var start = moment(oneSession[0]).format('LT');
    var end = moment(oneSession[1]).format('LT');

    return {subj: subject, dt: date, tm: start + '-' + end, zm: oneSession[2]};
}

function session_row(data) {
    var row = $('<tr></tr>');
    var subject = $('<td></td>');
    subject.append(data['subj']);

    var dateTime = $('<td></td>');
    var date = $('<div></div>').append(data['dt']);
    var time = $('<div></div>').addClass('text-secondary');
    time.append(data['tm']);
    dateTime.append(date);
    dateTime.append(time);

    var addtocalendar = $('<td></td>')
    var btn = $('<button></button>').addClass('btn-primary addCalendar');
    btn.attr('onclick', 'AddtoCalendar_Ajax(this)');
    btn.attr('data-zoom', data['zm']);
    btn.append('Add to Calendar');
    addtocalendar.append(btn);

    row.append(subject);
    row.append(dateTime);
    row.append(addtocalendar);

    return row;

}

function AddtoCalendar_Ajax(ele){
    console.log(ele);

    var zoom = ele.attributes[2].value;

    var event_row = ele.parentNode.parentNode;

    var event_date = event_row.children[1].children[0].innerText;
    var event_time = event_row.children[1].children[1].innerText;

    event_time = event_time.split('-');

    var formdata = {
        username: window.location.search.substring(1),
        startTime: event_date + " " + event_time[0],
        endTime: event_date + " " + event_time[1],
        zoomLink: zoom,
    };

    $.ajax({
        type: "POST",
        url: "/Homepage/profile/session.php",
        data: formdata,
    }).done(function (data) {
        console.log(data);
    });
    
    ele.innerHTML = "Added";
    ele.classList.remove("btn-primary");
    ele.disabled = true;
    return false;
}