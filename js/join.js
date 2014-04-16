

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
        var id = jQuery(elem).attr("data-joinid");
        addRule(styleSheet, ".joinMarkerID_"+id, "z-index:1; border-left-color:" + (lock ? "#000000" : "#777777") + " !important");
    }

}
function initSubstJoinHighlight()
{
    jQuery(".join")
        .hover(function(event) { JoinHighlight(this, true, false); }, function() { JoinHighlight(this, false, false); })
        .click(function(event) { event.stopPropagation(); JoinHighlight(this, true, true); });

    jQuery("body").click(JoinHighlightReset);

   createSubstJoinHighlightDivs();
    
}

function createSubstJoinHighlightDivs()
{
    var firstIndices = new Array();
    var lastIndices = new Array();
    
    var joins = jQuery(".join").toArray();
    var i;
	//console.log (joins); // SEMANDRA - 
    
    var sessionFromId = [];
    
    for (i=0; i<joins.length; i++) 
    {
        var join = jQuery(joins[i]);
		
        var id = join.attr("data-joinid");
        var session = join.attr("data-session");

        sessionFromId[id] = session;

	//	console.log ("this is the id: " + id );
		
        jQuery("<div></div>")  //add the div tags to #substJoinBar... seems to be working 
            .addClass("joinMarkerType_Target")
            .addClass("joinMarkerID_" + id)
            .addClass("joinMarkerSession_" + session)
            .css("position", "absolute")  //add style="position:absolute"
            .data("alignTopElement", join)
           .data("alignBottomElement", join)
            .appendTo("#substJoinBar");
    }

/*

debugger;
There is a problem. At this point it seems that the drupal version can not see the parent TD tag and is not getting the top, bottom and height dimensions. My guess is that there is an error before this point.

*/


    for (i=0; i<joins.length; i++)
    {
        var id = jQuery(joins[i]).attr("data-joinid");
        if (undefined == id)
            continue;
        if (undefined == firstIndices[id])
            firstIndices[id] = i;
    }

    for (i=joins.length; i>=0; i--)
    {
        var id = jQuery(joins[i]).attr("data-joinid");    
        if (undefined == id)
            continue;
        if (undefined == lastIndices[id])
            lastIndices[id] = i;
    }

    for (var id in firstIndices)
    {
        var first = jQuery(joins[firstIndices[id]]);
        var last = jQuery(joins[lastIndices[id]]);
        var session = sessionFromId[id];
        
        jQuery("<div></div>")
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

   // $("#substJoinBar").children().stop().css({opacity: 0});
	jQuery("#substJoinBar").children().stop().css({opacity: 0});

    if (timer)
    {
        clearTimeout(timer);
        timer = undefined;
    }
    timer = setTimeout(positionSubstJoinHighlightDivsCore, 500);
    
} 

function positionSubstJoinHighlightDivsCore()
{
    
	//$("#substJoinBar").children().each(function() {
    jQuery("#substJoinBar").children().each(function() {
    
        var top = jQuery(this).data("alignTopElement");   //"this" looks okay
        var bottom = jQuery(this).data("alignBottomElement");
		
/*		console.log ("Element");
		console.log (this);
		console.log (top);
		
		
		console.log (bottom.position().top);
		console.log (bottom.height());
	console.log (top.position().top);
*/
        var height = (bottom.position().top + bottom.height()) - top.position().top; 
        
        jQuery(this)
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

