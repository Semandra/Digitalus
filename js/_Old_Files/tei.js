


function sessionFromLayer(layer)
{
    if (layer == undefined)
        return undefined;
    else
        return layer.substring(0,1);
}

function applySessionFilter(startSessionIndex, endSessionIndex)
{

    var rules = getStyleSheetRules("ShowLayer");
    var startSession = sessions[startSessionIndex];
    var endSession = sessions[endSessionIndex];
    
    var fAllChangesMode = (document.renderMode == "changesMode"); 
    var fFinalMode = (document.renderMode == "finalMode");
    var fReadingMode = (document.renderMode == "readingMode");
    var fSingleLayer = (fFinalMode || fReadingMode);
    
    for (layerIndex=0; layerIndex<layers.length; layerIndex++)
    {
        var rule = rules[layerIndex];
        var layer = layers[layerIndex];
        var session = sessionFromLayer(layer);
        
        var showThisLayer = (session >= startSession && session <= endSession);
        if (fSingleLayer && sessionFromLayer(layers[layerIndex+1]) == session)
            showThisLayer = false;
        
        rule.style.display = showThisLayer ? "inline" : "";
    }

    //TODO: clean this up (inefficient getStyleSheetRules within loop, etc.) maybe move to join.js
    for (sessionIndex=0; sessionIndex<sessions.length; sessionIndex++)
    {
        var rules = getStyleSheetRules("JoinHighlightSessions");
        var rule = rules[sessionIndex];
        var showThisSession = (sessionIndex >= startSessionIndex && sessionIndex <= endSessionIndex);
        rule.style.display = (showThisSession ? "" : "none");
    }

    getStyleSheet("MultiLayer").disabled = fSingleLayer;
    getStyleSheet("SingleLayer").disabled = !fSingleLayer;
    
    getStyleSheet("SessionColor").disabled = fSingleLayer; 
    getStyleSheet("LineBreak").disabled = !fSingleLayer;

    getStyleSheet("AllChangesMode").disabled = !fAllChangesMode;
    getStyleSheet("FinalMode").disabled = !fFinalMode;
    getStyleSheet("ReadingMode").disabled = !fReadingMode;

    if (fFinalMode || fReadingMode)
    {
        var styleSheet = getStyleSheet("Highlights");
        var rules = getRulesFromStyleSheet(styleSheet);
        for (i=0; i<rules.length; i++)
        {
            var rule = rules[i];
            if (styleSheet.removeRule) styleSheet.removeRule(i);
            else if (styleSheet.deleteRule) styleSheet.deleteRule(i);
        }
    }

    setNewLineVisibility();

    if (!fSingleLayer)
        positionSubstJoinHighlightDivs();
    
}

function setNewLineVisibility()
{
    var spans = document.getElementsByClassName("Measure");
    for (i=0; i<spans.length; i++)
    {
        var span = spans[i];
        document.getElementById("newline_"+span.id).style.display = (span.offsetHeight>0 && span.offsetWidth>0) ? "block" : "none"         
    }
    
}

function changeRenderMode()
{

    var buttonClicked = this;
    var slider = document.getElementById("slider").slider;
    var knob = slider.knob;

    var buttons = 
        [ 
            document.getElementById("changesMode"),
            document.getElementById("finalMode"),
            document.getElementById("readingMode")
        ];

    for (i=0; i<buttons.length; i++)
    {
        var button = buttons[i];
        button.style.backgroundColor = (button == buttonClicked) ? "#BFBFBF" : "#DFDFDF"; 
    }
    
    document.renderMode = buttonClicked.id;

    var showOneLayer = (document.renderMode != "changesMode");
    knob.SetSingleSelectMode(showOneLayer);

}

function OnMouseOver(e)
{

    e.stopPropagation();
    
    var elem = jQuery(this).closest("[data-polygons]");
    var polygons = elem.attr("data-polygons");
    var empty = (elem.children().eq(1).text() == "~");
    
    var action;
    if (empty)
        action = (elem.attr("data-state") == "add") ? "removed" : "inserted";
    else
        action = "changed";
    
    highlightPolygon(true, this, polygons, action);
    hoverHighlight(true, this);

}

function OnMouseOut(e)
{
    e.stopPropagation();

    var elem = jQuery(this).closest("[data-polygons]");
    var polygons = elem.attr("data-polygons");

    highlightPolygon(false, this, polygons, "changed");
    hoverHighlight(false, this);
}

function OnClick(e)
{

    var event = e ? e : window.event;
    var elem = event.target ? event.target : event.srcElement;
    event.stopPropagation();

    hoverHighlight(true, elem);

}

function manageHighlightStyles(on, elem, id)
{

    var styleSheet = getStyleSheet("Highlights");

    var slider = document.getElementById("slider").slider;
    var knob = slider.knob;

    var startSession = sessions[knob.firstSelection];
    var endSession = sessions[knob.lastSelection];

    var session = elem.getAttribute("data-session");
    
    if (session >= startSession && session <= endSession)            
    {

        addRemoveRule(on, styleSheet, 
            "#" + id + "_del",
            "color:white; background-color:#999999 !important");

        addRemoveRule(on, styleSheet, 
            "#" + id + "_add",
            "color:white; background-color:#000000 !important");

    } // if layer

}

function hoverHighlight(on, elem)
{

    if (document.renderMode == "finalMode" || document.renderMode == "readingMode")
        return;

    while (elem)
    {
        
        var id = elem.id.substring(0, elem.id.indexOf("_"))
        
        if (id != undefined && id != null && id != "")
        {
        
            manageHighlightStyles(on, elem, id);   
            break;

        } // if id
        
        elem = elem.parentElement;
        
    } // while elem
    
}

function OnPageChange(prevPage, newPage, zoomData) 
{

    jQuery("#yourImageID").smoothZoom("destroy").css("background-image", "url(sites/all/modules/islandora_digitalus-7.x-1.0/css/zoom_assets/preloader.gif)").smoothZoom({
        width: "100%",
        height: "100%",
        responsive: true,
        animation_SPEED_ZOOM: 0.5,
        on_ZOOM_PAN_UPDATE: updatePolygonTransform,
        on_INIT_DONE: zoomData,
        // image_url: "images/image" + newPage + ".jpg"
		image_url: imagePagePath + "IMAGE" + newPage + "/view" //SEMANDRA - uses global set by object inline (islandora-digitalus.tpl.php)
		
    });
	
    jQuery("#svg_page_" + prevPage).children().css({"opacity": 0});
    
}

