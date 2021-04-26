var sessionsPanel;
var reviewsPanel;
var addReviewButton;

function start(reviews, sessions)
{
    $("#profileTabs").tabs();

    $("#postReview").hide();
    writeReview();
    displayReviews(reviews);
    displaySessions(sessions);
    ReviewAjax();

    var options = {
        max_value: 5,
        step_size: 1,
    };

    $.getScript('https://cdn.jsdelivr.net/npm/starrr@2.0.4/dist/starrr.js', function() {
        $(".starRating").starrr({
            change: function(e, value){
                $("#fiveRating").val(value);
            }
        });
    });
}

function ReviewAjax(){
    $("#reviewForm").submit(function (event) {
        var formdata = {
            username: $("#tutorUsername").val(),
            comment: $('#comment').val(),
            fiveRating: $('#fiveRating').val().toString(),
        };

        $.ajax({
            type: "POST",
            url: "/Homepage/profile/review.php",
            data: formdata,
        }).done(function (data) {
            console.log(data);
        });
    

        $("#reviewPanel").prepend($('<hr/>'));
        $("#reviewPanel").prepend(createReview("anonymous", $('#comment').val(), parseInt($('#fiveRating').val())));

        $('#comment').val("");
        $('#postReview').hide();

        return false;
    });
}

function writeReview(){
    $("#newReview").click(function(){
        $("#postReview").show();
    });

    $("#cancel").click(function(){
        $("#postReview").hide();
        return false;
    });
}

function displayReviews(reviews) {


    for (var i = 0; i < reviews.length; i++) {
        $('#reviewPanel').prepend($('<hr/>'));
        $("#reviewPanel").prepend(createReview("anonymous", reviews[i].comments, parseInt(reviews[i].rating)));
    }

}

function createReview(reviewerName, reviewText, rating)
{
    var newR = $("<div></div>");
    newR.addClass("review");

    var newHeader = $("<div></div>");
    newHeader.addClass("reviewHeader");

    var newPic = $("<i></i>");
    newPic.addClass("reviewerPic fas fa-user fa-3x");

    var newName = $("<p></p>");
    newName.addClass("reviewerName");
    newName.append(reviewerName);

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