var highlightLocked = false;

function JoinHighlightReset()
{
    highlightLocked = false;
    JoinHighlight(undefined, false, false);
}

function JoinHighlight(elem, on, lock)
{

    if (highlightLocked && !lock)
        return;
        
    if (lock)
        highlightLocked = true;
    
    var styleSheet = getStyleSheet("JoinHighlights");
    var rules = getRulesFromStyleSheet(styleSheet);

    var i;
    for (i=rules.length-1; i>=0; i--)
    {
        if (styleSheet.removeRule) styleSheet.removeRule(i);
        else if (styleSheet.deleteRule) styleSheet.deleteRule(i);
    }
    
    if (on)
    {
        var id = $(elem).attr("data-joinid");
        addRule(styleSheet, ".joinMarkerID_"+id, "z-index:1; border-left-color:" + (lock ? "#000000" : "#777777") + " !important");
    }

}

function initSubstJoinHighlight()
{
    
    $(".join")
        .hover(function(event) { JoinHighlight(this, true, false); }, function() { JoinHighlight(this, false, false); })
        .click(function(event) { event.stopPropagation(); JoinHighlight(this, true, true); });

    $("body").click(JoinHighlightReset);

    createSubstJoinHighlightDivs();
    
}

function createSubstJoinHighlightDivs()
{

    var firstIndices = new Array();
    var lastIndices = new Array();
    
    var joins = $(".join").toArray();
    var i;
    
    var sessionFromId = [];
    
    for (i=0; i<joins.length; i++) 
    {
        var join = $(joins[i]);
        var id = join.attr("data-joinid");
        var session = join.attr("data-session");

        sessionFromId[id] = session;

        $("<div></div>")
            .addClass("joinMarkerType_Target")
            .addClass("joinMarkerID_" + id)
            .addClass("joinMarkerSession_" + session)
            .css("position", "absolute")
            .data("alignTopElement", join)
            .data("alignBottomElement", join)
            .appendTo("#substJoinBar");
    }

    for (i=0; i<joins.length; i++)
    {
        var id = $(joins[i]).attr("data-joinid");
        if (undefined == id)
            continue;
        if (undefined == firstIndices[id])
            firstIndices[id] = i;
    }

    for (i=joins.length; i>=0; i--)
    {
        var id = $(joins[i]).attr("data-joinid");    
        if (undefined == id)
            continue;
        if (undefined == lastIndices[id])
            lastIndices[id] = i;
    }

    for (var id in firstIndices)
    {
        var first = $(joins[firstIndices[id]]);
        var last = $(joins[lastIndices[id]]);
        var session = sessionFromId[id];
        
        $("<div></div>")
            .addClass("joinMarkerType_Span")
            .addClass("joinMarkerID_" + id)
            .addClass("joinMarkerSession_" + session)
            .css("position", "absolute")
            .data("alignTopElement", first)
            .data("alignBottomElement", last)
            .appendTo("#substJoinBar");
    }
    
    positionSubstJoinHighlightDivs();

}

var timer;
function positionSubstJoinHighlightDivs()
{

    $("#substJoinBar").children().stop().css({opacity: 0});

    if (timer)
    {
        clearTimeout(timer);
        timer = undefined;
    }
    timer = setTimeout(positionSubstJoinHighlightDivsCore, 500);
    
}

function positionSubstJoinHighlightDivsCore()
{
    
    $("#substJoinBar").children().each(function() {
    
        var top = $(this).data("alignTopElement");
        var bottom = $(this).data("alignBottomElement");

        var height = (bottom.position().top + bottom.height()) - top.position().top;
        
        $(this)
            .height(height + "px")
            .position({
                my: "left top",
                at: "left top",
                of: top,
                collision: "fit none",
                within: "#substJoinBar"
            });

    })
    .stop().animate({opacity: 1});

}
