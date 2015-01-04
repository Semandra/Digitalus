

function highlightPolygon(on, elem, idList, action)
{

    var ids;

    if (document.renderMode != "changesMode")
        return;

    showPolyForPage(on, document.pageCtl.GetPage(), idList, action);

    if (on)
    {
        configureZoomCtl(elem, idList, action);
    }
    else
    {
        jQuery("#ZoomCtl").zoomCtl("hide");        
    }
 
}

function updatePolygonTransform(zoomData, animationComplete)
{

    var svg = jQuery("#svg_pages").get(0);

    svg.setAttribute("transform", 
        "translate(" + (-zoomData.scaledX) + ", " + (-zoomData.scaledY) + ") " +
        "scale(" + (zoomData.scaledWidth/1000.0) + ", " + (zoomData.scaledHeight/1000.0) + ")");

}


var lastZoomCode = undefined;
function zoomToPolyOnPage(zoomIn, newPage, idList)
{

    var zoomData = jQuery('#yourImageID').smoothZoom('getZoomData');

    if (!zoomIn)
    {
    
        jQuery("#yourImageID")
            .smoothZoom('focusTo',{
                   x: zoomData.centerX,
                   y: zoomData.centerY,
                   zoom: 1,
                   speed: 6
            });

        return;
    }
        
    var ids;
    if (idList.trim() == "")
        ids = [];
    else
        ids = idList.split(/ +/);

    var x;
    var y;
    var zoom;
    
    function GetZoomCode(page, idList) { return "" + page + ": " + idList; }
    var first = !(GetZoomCode(newPage, idList) == lastZoomCode);
    lastZoomCode = GetZoomCode(newPage, idList);

    var zoomLeft = Number.MAX_VALUE;
    var zoomTop = Number.MAX_VALUE;
    var zoomRight = Number.MIN_VALUE;
    var zoomBottom = Number.MIN_VALUE;

    
    var i;
    for (i=0; i<ids.length; i++)
    {

        var id = ids[i];
        var page = polygonPages[id].page;

        // skip polygons not on this page
        if (page != newPage)
            continue;

        // add it to the bounding box we're accumulating
        zoomLeft = Math.min(zoomLeft, polygonPages[id].left);        
        zoomTop = Math.min(zoomTop, polygonPages[id].top);        
        zoomRight = Math.max(zoomRight, polygonPages[id].right);        
        zoomBottom = Math.max(zoomBottom, polygonPages[id].bottom);        

    }

    var zoomWidth = zoomRight - zoomLeft;
    var zoomHeight = zoomBottom - zoomTop;
    
    // convert from 0-1000 range into actual source pixels
    function ScaleX(x) { return (x / 1000) * zoomData.normWidth; }
    function ScaleY(y) { return (y / 1000) * zoomData.normHeight; }

    // how big is the picture
    var pictureCtlWidth = jQuery('#yourImageID').width();
    var pictureCtlHeight = jQuery('#yourImageID').height();

    var zoomX = Math.floor(pictureCtlWidth*100 / ScaleX(zoomWidth));
    var zoomY = Math.floor(pictureCtlHeight*100 / ScaleY(zoomHeight));
    var zoom = Math.min(zoomX, zoomY) / 4; 

    if (!first)
        while (zoom < zoomData.ratio*100+5)
            zoom *= 2;

    x = ScaleX((zoomLeft + zoomRight) / 2);
    y = ScaleY((zoomTop + zoomBottom) / 2);

    jQuery("#yourImageID")
        .smoothZoom('focusTo',{
               x: x,
               y: y,
               zoom: zoom,
               speed: 6
        });

}

function showPolyForPage(on, newPage, idList, action)
{

    var ids;

    if (idList.trim() == "")
        ids = [];
    else
        ids = idList.split(/ +/);        

    var i;
    for (i=0; i<ids.length; i++)
    {

        var id = ids[i];
        var page = polygonPages[id].page;

        // skip polygons not on this page
        if (page != newPage)
            continue;
            
        // show the polygon
        jQuery("#" + id).animate({opacity: on ? 1 : 0}, "fast");
     
        if (action == "removed")
            jQuery("#" + id).css({fillOpacity:1.0, fill:"url(#StripedPattern)"});
            
        else if (action == "inserted")
            jQuery("#" + id)
                .css("fill", "none")
                .children("path").attr("stroke", "none");
            
        else if (action == "changed")
            jQuery("#" + id).css("fill", "none");
            
        // TODO: should have an else with an assert
                
    }
    
} // showPolyForPage

function resetPolygonHighlight()
{
    jQuery("#ZoomCtlAnchor")
        .appendTo(document.body)
        .hide();
}

function configureZoomCtl(elem, idList, action)
{

    var ids;
    if (idList.trim() == "")
        ids = [];
    else
        ids = idList.split(/ +/);

    var currPage = document.pageCtl.GetPage();
    var foundCurr = false;
    var prevPage = Number.MIN_VALUE;
    var nextPage = Number.MAX_VALUE;
    
    var i;
    for (i=0; i<ids.length; i++)
    {
    
        var page = polygonPages[ids[i]].page;
        
        if (page == currPage)
            foundCurr = true;
            
        else if (page < currPage)
            prevPage = Math.max(prevPage, page);
            
        else if (page > currPage)
            nextPage = Math.min(nextPage, page);

    } // for id

    var foundPrev = (prevPage != Number.MIN_VALUE);
    var foundNext = (nextPage != Number.MAX_VALUE);

    if (!foundPrev && !foundCurr && !foundNext)
    {
        jQuery("#ZoomCtlAnchor")
            .appendTo(document.body)
            .hide();
        return;
    }

    var fnPrev = !foundPrev ? false :
        function()
        {
            document.pageCtl.SetPage(prevPage, function () { showPolyForPage(true, prevPage, idList, action); configureZoomCtl(elem, idList, action); });
        };

    var fnZoomOut = 
        function()
        {
            zoomToPolyOnPage(false, currPage, idList);
        };

    var fnZoomIn = !foundCurr ? false :
        function()
        {
            zoomToPolyOnPage(true, currPage, idList);
        };

    var fnNext = !foundNext ? false :
        function()
        {
            document.pageCtl.SetPage(nextPage, function () { showPolyForPage(true, nextPage, idList, action); configureZoomCtl(elem, idList, action); });                    
        };

    if (elem)
    {
        jQuery("#ZoomCtlAnchor")
            .appendTo(elem)
            .show()
            .position(
                {
                    my: "left center",
                    at: "right center",
                    of: elem
                });
    }
     
    jQuery("#ZoomCtl")
        .zoomCtl(
            {
                onPrev: fnPrev,
                onZoomOut: fnZoomOut,
                onZoomIn: fnZoomIn,
                onNext: fnNext
            });

}
