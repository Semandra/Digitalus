jQuery.fn.zoomCtl = function(param)
{

    var zoomCtl = this.data("ZoomCtl");
    
    if (!zoomCtl)
    {

        var defaults = 
                {
                    onPrev: null,
                    onZoomOut: null,
                    onZoomIn: null,
                    onNext: null
                };

        this.data("ZoomCtl", zoomCtl = new ZoomCtl(this));
        $.extend(zoomCtl, defaults);
        
    }

    if (param == "show")
        zoomCtl.show();

    else if (param == "hide")
        zoomCtl.hide();

    else
    {
        // TODO: weird to $.extend directly into the object; shoudl validate contents of options first and assign manually
        $.extend(zoomCtl, param);
        zoomCtl.show();
    }
    
    zoomCtl.refreshButtonState();

    return this;
    
}
 
function ZoomCtl(container)
{

    this.container = container;
    
    // TODO: reordered buttons below; if we like it, do the corresponding reordering of code elsewhere in the file for consistency
    
    container
        .addClass("ui-widget-header ui-corner-all")
        .css({
            display: "inline-block",
            padding: "2px"
        })
        .append([
        
            $("<span style='font-weight:normal;margin-right:0.5em;margin-left:0.5em'>Zoom:</span>"),
                                    
            this.prevButton = $("<div><div>")
                .button({
                    icons: {
                        primary: "ui-icon-triangle-1-w"
                    },
                    text: false
                })
                .attr("title", "TODO: Need to write a tooltip for this"),
                            
            this.nextButton = $("<div><div>")
                .button({
                    icons: {
                        primary: "ui-icon-triangle-1-e"
                    },
                    text: false
                })
                .attr("title", "TODO: Need to write a tooltip for this"),
                
            this.zoomInButton = $("<div><div>")
                .button({
                    icons: {
                        primary: "ui-icon-zoomin"
                    },
                    text: false
                })
                .attr("title", "Zoom in on this current page's text for this change"),
                
            this.zoomOutButton = $("<div><div>")
                .button({
                    icons: {
                        primary: "ui-icon-zoomout"
                    },
                    text: false
                })
                .attr("title", "Zoom out to view the whole page")
                
        ]);
        
    this.nextButton.css("margin-right", "0.5em");
    container.children("div:last").css("margin-right", "0px");
    container.find(".ui-button .ui-button-text").css("display", "inline-block");
    container.find(".ui-button-icon-only").css("width", "1.2em");

    container.mouseenter(this.show());
    container.mouseleave(this.hide());
        
}

ZoomCtl.prototype.refreshButtonState = function()
{
    var self = this;
    this.prevButton
        .off("click")
        .click( function(event) { self.onPrev(); event.stopPropagation(); } )
        .toggle(Boolean(this.onPrev) || Boolean(this.onNext))
        .button("option", "disabled", !this.onPrev);
        
    this.zoomOutButton
        .off("click")
        .click( function(event) { self.onZoomOut(); event.stopPropagation(); } );
    
    this.zoomInButton
        .off("click")
        .click( function(event) { self.onZoomIn(); event.stopPropagation(); } )
        .button("option", "disabled", !this.onZoomIn);
    
    this.nextButton
        .off("click")
        .click( function(event) { self.onNext(); event.stopPropagation(); } )
        .toggle(Boolean(this.onPrev) || Boolean(this.onNext))
        .button("option", "disabled", !this.onNext);

}

ZoomCtl.prototype.show = function()
{
    $(this.container)
        .stop(true)
        .css({opacity: 1});    
}

ZoomCtl.prototype.hide = function()
{
    $(this.container)
        .stop(true)
        .delay(2000)
        .animate({opacity: 0.5}, "slow");    
}