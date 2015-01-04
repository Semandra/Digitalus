
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

    // TODO: Maybe a method on ZoomCtl?
    jQuery("#ZoomCtlAnchor")
        .appendTo(document.body)
        .hide();


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

function OnMouseHover(e, on)
{

    e.stopPropagation();
    
    var elem = jQuery(this).closest("[data-polygons]");
    var polygons = elem.attr("data-polygons");
    var empty = (elem.children().eq(1).text() == "~");
    
    var action;
    if (empty)
        action = (elem.attr("data-state") == "add") ? "polygonRemove" : "polygonInsert";
    else
        action = "polygonChange";

    if (polygons)
        highlightPolygon(on, this, polygons, action);
        
    hoverHighlight(on, this);

}


function OnClick(e)
{

    var event = e ? e : window.event;
    var elem = event.target ? event.target : event.srcElement;
    event.stopPropagation();

    hoverHighlight(true, elem);

}

function manageHighlightStyles(on, elem)
{

    var joinID = jQuery(elem).attr("data-joinid");
    var substID = jQuery(elem).attr("id");

    if (joinID == undefined || joinID == null || joinID == "")
        return false;

    var styleSheet = getStyleSheet("Highlights");

    var slider = document.getElementById("slider").slider;
    var knob = slider.knob;

    var startSession = sessions[knob.firstSelection];
    var endSession = sessions[knob.lastSelection];

    var session = elem.getAttribute("data-session");
    
    if (session >= startSession && session <= endSession)            
    {

        // TODO: now that we only highlight <add>s (not <del>s) maybe we can remove/simplify the _add suffix, the data-mode attribute, etc.
        
        addRemoveRule(on, styleSheet, 
            ".join_" + joinID + ".mode_add#" + substID,
            "color:white; background-color:#000000 !important");
//            "color:white; background-color:#000000; box-shadow:inset 0px 0px 3px 3px rgba(127, 127, 127, 1.0); !important");

        addRemoveRule(on, styleSheet, 
            ".join_" + joinID + ".mode_add",
            "color:black; background-color:#AAAAAA !important");
//            "color:black; background-color:#AAAAAA; box-shadow:inset 0px 0px 3px 3px rgba(0, 0, 0, 0.25); !important");

    } // if layer

    return true;
    
}

function hoverHighlight(on, elem)
{

    if (document.renderMode == "finalMode" || document.renderMode == "readingMode")
        return;

    while (elem)
    {
        if (manageHighlightStyles(on, elem))
            break;
        elem = elem.parentElement;
        
    } // while elem
    
}

function OnPageChange(prevPage, newPage, zoomData)
{

    jQuery("#yourImageID").smoothZoom("destroy").css("background-image", "url(../../sites/all/modules/islandora_digitalus-7.x-1.0/css/zoom_assets/preloader.gif)").smoothZoom({
        width: "100%",
        height: "100%",
        responsive: true,
        animation_SPEED_ZOOM: 0.5,
        on_ZOOM_PAN_UPDATE: updatePolygonTransform,
        on_INIT_DONE: zoomData,
        image_url: imagePagePath + "IMAGE" + newPage + "/view" //SEMANDRA - uses global set by object inline (islandora-digitalus.tpl.php)
    });
    
    showPolyPage(prevPage, false);
    showPolyPage(newPage, true);
  
}