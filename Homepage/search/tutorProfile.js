var sessionsPanel;
var reviewsPanel;
var addReviewButton;

$(document).ready(function()
{
    createSessionsPanel();
    createReviewsPanel();

    addReviewButton = $("<button></button>");
    addReviewButton.addClass("addReviewButton");
    addReviewButton.append("+");

    displaySessionsPanel();

    $(".sessionsTab").click(function()
    {
        if($(".sessionsTab").hasClass("clickable"))
        {
            displaySessionsPanel();
        }
    });
    
    $(".reviewsTab").click(function()
    {
        if($(".reviewsTab").hasClass("clickable"))
        {
            displayReviewsPanel();
        }
    });
});


function createSessionsPanel()
{
    sessionsPanel = $("<div></div>");
    sessionsPanel.addClass("sessionsPanel");

    for(var i = 0; i < 10; i++)
    {
        createSession("Available Session");
    }
}

function createSession(sessionText)
{
    var newSession = $("<button></button>");
    newSession.addClass("session")
    newSession.append(sessionText);

    sessionsPanel.append(newSession);
}


function createReviewsPanel()
{
    reviewsPanel = $("<div></div>");
    reviewsPanel.addClass("reviewsPanel");

    for(var i = 0; i < 10; i++)
    {
        createReview("Sean Gillis", "AAAAAAAAAAAAAAA AAAAAAAA AAAAAAAAAAAAAAAAAAAAAAAA AAAAAA A AAAAAAAAAAAAAAAAAAAAAAAAA A AAAAAAAA A ");
    }
}


function createReview(reviewerName, reviewText)
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

    newHeader.append(newPic);
    newHeader.append(newName);

    var newText = $("<p></p>");
    newText.addClass("reviewText");
    newText.append(reviewText);

    newR.append(newHeader);
    newR.append(newText);

    reviewsPanel.prepend(newR);
}


function displaySessionsPanel()
{
    $(".reviewEditor").remove();
    $(".reviewsPanel").remove();
    $(".container").append(sessionsPanel);

    $(".sessionsTab").removeClass("clickable");
    $(".reviewsTab").addClass("clickable");

    $(".addReviewButton").remove();
}


function displayReviewsPanel()
{
    $(".sessionsPanel").remove();
    $(".container").append(reviewsPanel);

    $(".reviewsTab").removeClass("clickable");
    $(".sessionsTab").addClass("clickable");

    $(".headerTabs").append(addReviewButton);
    connectAddReviewFunction();
}


function connectAddReviewFunction()
{
    addReviewButton.click(function()
    {
        if ($(".reviewEditor").length == 0)
        {
            createReviewEditor();
        }
    });
}


function createReviewEditor()
{
    var reviewEditor = $("<div></div>");
    reviewEditor.addClass("reviewEditor");

    var newHeader = $("<div></div>");
    newHeader.addClass("reviewHeader");

    var newPic = $("<i></i>");
    newPic.addClass("reviewerPic fas fa-user fa-3x");

    var newName = $("<p></p>");
    newName.addClass("reviewerName");
    newName.append("Sean Gillis");

    newHeader.append(newPic);
    newHeader.append(newName);

    var newTextEdit = $("<textarea></textarea>");
    newTextEdit.addClass("reviewTextEdit");
    newTextEdit.attr("rows", "4");

    var buttonBox = $("<div></div>");
    buttonBox.addClass("buttonBox");

    var cancelButton = $("<button></button>");
    cancelButton.addClass("cancelButton");
    cancelButton.append("Cancel");

    cancelButton.click(function()
    {
        $(".reviewEditor").remove();
    });

    var postButton = $("<button></button>");
    postButton.addClass("postButton");
    postButton.append("Post");

    postButton.click(function()
    {
        createReview("Sean Gillis", $(".reviewTextEdit").val());
        $(".reviewEditor").remove();
    });

    buttonBox.append(cancelButton);
    buttonBox.append(postButton);

    reviewEditor.append(newHeader);
    reviewEditor.append(newTextEdit);
    reviewEditor.append(buttonBox);

    reviewsPanel.prepend(reviewEditor);
}