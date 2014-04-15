<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns="http://www.w3.org/1999/xhtml" xmlns:xsl="http://www.w3.org/1999/XSL/Transform" xmlns:xs="http://www.w3.org/2001/XMLSchema" xmlns:jmp="http://www.joshpollock.com" xpath-default-namespace="http://www.tei-c.org/ns/1.0" exclude-result-prefixes="xs jmp" version="2.0">

    <xsl:include href="sessionlayer.xsl"/>
    <xsl:include href="deladd.xsl"/>
    <xsl:include href="util.xsl"/>
    <xsl:include href="join.xsl"/>
    <xsl:include href="choice.xsl"/>
    <xsl:include href="emph.xsl"/>
    <xsl:include href="milestone.xsl"/>
    <xsl:include href="text.xsl"/>
    <xsl:include href="polygons.xsl"/>
    
    <xsl:output method="xhtml" indent="no" encoding="UTF-8"/>
    
    <!-- These variable values are parsed from the text XML document -->
    <xsl:variable name="GlobalJoins" select="//substJoin"/>
    <xsl:variable name="GlobalSessions" select="jmp:GetSessions(/)" as="xs:string*"/>
    <xsl:variable name="GlobalLayers" select="jmp:GetLayers(/)" as="xs:string*"/>
    
    <xsl:template match="//teiHeader"/>
    
    <xsl:template match="/">

        <xsl:variable name="root" select="."/>
        
        <xsl:text disable-output-escaping="yes">&lt;!DOCTYPE html&gt;</xsl:text>
            
        <xsl:call-template name="CheckJoins"/>
                
        <html>
            
            <head>

                <style type="text/css">
                    
                    html, body { height:100%; width:100%; margin:0; padding:0 }
                    
                    body                                { font-family:calibri }
                    
                    .showLayer                          { display:none }

                    .bracketNormal, .bracketCorrection  { display:none; font-weight:bold }
                    .bracketNormal                      { color:#DD0000 }
                    .bracketCorrection                  { color:#DD0000 } /* TODO: put back to #3333FF if we ever go back to brackets */
                    
                    input[type=button]                  { border:none }
                    
                    .sicText                            { cursor:default }
                    .recteText                          { color:#DD0000 }
                    
                </style>
                
                <style type="text/css" id="ShowLayer">
                    <xsl:for-each select="$GlobalLayers">
                        .showLayer<xsl:value-of select="."/> { }
                    </xsl:for-each>
                </style>
                
                <style type="text/css" id="SessionColor">
                    <xsl:for-each select="1 to count($GlobalSessions)">
                        <xsl:variable name="i" select="."/>
                        .session<xsl:value-of select="$GlobalSessions[$i]"/>Color { background-color:<xsl:value-of select="$SessionColors[$i]"/> }
                    </xsl:for-each>
                </style>
                
                <style type="text/css" id="MultiLayer">
                    .layerContainer  { display: block; margin-left:35px; spacing:0; text-indent:-35px; padding:0 }
                    .layerLabel      { display: inline-block; margin:0px; text-indent:0px; width:31px; text-align:center; color:black }
                    .layerSpacer     { display: inline; margin:0px; text-indent:0px; width:5px; text-align:center; background-color:white }
                    .layerContents   { display: inline; margin:0px; text-indent:0px }
                </style>
                
                <style type="text/css" id="SingleLayer">
                    .layerContainer  { display: inline }
                    .layerLabel      { display: none }
                    .layerSpacer     { display: none }
                    .layerContents   { display: inline }
                    #substJoinBar    { display: none }                    
                </style>

                <style type="text/css" id="AllChangesMode">
                    
                    .emphBold         { font-weight:bold }
                    .emphItalic       { font-style:italic }
                    .emphUnderline    { text-decoration:underline }
                    .emphSingleQuote:before { content:"&#x2018;" }
                    .emphSingleQuote:after { content:"&#x2019;" }                    
                    .emphDoubleQuote:before { content:"&#x201C;" }
                    .emphDoubleQuote:after { content:"&#x201D;" }                    
                    .emphSmallCaps    { font-variant:small-caps }

                    .allChangesModeOn { display:inline }
                    .allChangesModeOff { display:none }
                    .finalModeOn { display:none }
                    .finalModeOff { display:inline }
                    .readingModeOn { display:none }
                    .readingModeOff { display:inline }

                    .pb { width:300px; color:#3333FF; border-top:solid 1px #3333FF; margin-top:2ex }
                    
                </style>
                
                <style type="text/css" id="FinalMode">
                    
                    .emphBold         { font-weight:bold }
                    .emphItalic       { font-style:italic }
                    .emphUnderline    { text-decoration:underline }
                    .emphSingleQuote:before { content:"&#x2018;" }
                    .emphSingleQuote:after { content:"&#x2019;" }                    
                    .emphDoubleQuote:before { content:"&#x201C;" }
                    .emphDoubleQuote:after { content:"&#x201D;" }                    
                    .emphSmallCaps    { font-variant:small-caps }
                    
                    .allChangesModeOn { display:none }
                    .allChangesModeOff { display:inline }
                    .finalModeOn { display:inline }
                    .finalModeOff { display:none }
                    .readingModeOn { display:none }
                    .readingModeOff { display:inline }

                    .pb { width:200px; color:#3333FF; border-top:solid 1px #3333FF; }

                </style>
                
                <style type="text/css" id="ReadingMode">
                    
                    .emphNone, .emphBold, .emphItalic, .emphUnderline, .emphSingleQuote, .emphDoubleQuote, .emphSmallCaps { font-style:italic }

                    .allChangesModeOn { display:none }
                    .allChangesModeOff { display:inline }
                    .finalModeOn { display:none }
                    .finalModeOff { display:inline }
                    .readingModeOn { display:inline }
                    .readingModeOff { display:none }
                    
                </style>
                                
                <style type="text/css" id="LineBreak">
                    div.lineBreak { display:inline }
                </style>
                                
                <style type="text/css" id="Highlights"/>
                
                <style type="text/css" id="JoinHighlightSessions">
                    <xsl:for-each select="$GlobalSessions">
                        .joinMarkerSession_<xsl:value-of select="."/> { }
                    </xsl:for-each>
                </style>
                
                <style type="text/css" id="JoinHighlights">
                        
                </style>
                
                <!-- jquery -->
                <script src="jquery/js/jquery-1.9.1.js"/>
                <script src="jquery/js/jquery-ui-1.10.3.custom.js"/>
                <link rel="stylesheet" href="jquery\css\smoothness\jquery-ui-1.10.3.custom.css"/>
                <style>
                    .ui-widget {
                    font-family: calibri;
                    font-size: 1em;
                    }
                </style>
                
                <!-- main js file -->
                <script type="text/javascript" src="tei.js"/>
                <script type="text/javascript" src="stylesheet.js"/>
                <script type="text/javascript" src="polygons.js"/>
                
                <!-- image viewer control -->
                <script src="zoom_assets/jquery.smoothZoom.js"/>
                <link rel="stylesheet" href="imagectl.css"/>
                
                <!-- page control -->
                <script src="pagectl.js"/>
                <link rel="stylesheet" href="pagectl.css"/>

                <!-- slider control -->
                <script type="text/javascript" src="slider.js"/>
                <link rel="stylesheet" href="slider.css"/>                        

                <!-- zoom control -->
                <script type="text/javascript" src="zoomctl.js"/>

                <!-- substJoin highlighting -->
                <script src="join.js"/>
                <link rel="stylesheet" href="join.css"/>                        
                
                <!-- misc data we need from js -->
                <script>
                    <xsl:value-of select="jmp:GenerateJavascriptArray('layers', $GlobalLayers)"/>
                    <xsl:value-of select="jmp:GenerateJavascriptArray('sessions', $GlobalSessions)"/>
                    <xsl:value-of select="jmp:GenerateJavascriptArray('joins', $GlobalJoins)"/>
                    <xsl:value-of select="jmp:GeneratePolygonPageMap()"/>
                </script>
                
                <script>
                    
                    $(document).ready(function() {
                                        
                        <xsl:text>var sliderData = [ </xsl:text> 
                        <xsl:for-each select="1 to count($GlobalSessions)">
                            <xsl:variable name="i" select="."/>
                            <xsl:text>{label:'</xsl:text>
                            <xsl:value-of select="$GlobalSessions[$i]"/>
                            <xsl:text>', color:'</xsl:text>
                            <xsl:value-of select="$SessionColors[$i]"/>
                            <xsl:text>', description:'</xsl:text>
                            <xsl:value-of select="normalize-space($root//listChange/change[$i])"/>
                            <xsl:text>'}</xsl:text>
                            <xsl:if test="position()!=last()">,</xsl:if>
                        </xsl:for-each>
                        <xsl:text>];</xsl:text>

                        $("#slider").Slider(sliderData);                    
                        
                        document.pageCtl = $("#MyPageCtl").PageCtl(<xsl:value-of select="$NumPages"/>, OnPageChange);                    
                        $("#PageCtlAnchor").hide();
                        
                        document.zoomCtl = $("#ZoomCtl").zoomCtl();
                        $("#ZoomCtlAnchor").hide();
                        
                        changeRenderMode.call(document.getElementById('changesMode'));
                    
                        $(document.body)
                            .css("height", "100%")
                            .css("width", "100%")
                            .keydown(OnKeyDown);
                            
                        $("[data-polygons]")
                            .hover(OnMouseOver, OnMouseOut);
        
                        $(".sicText")
                            .tooltip({
                                track: true,
                                content:
                                    function ()
                                    {
                                        var recte = $(this).attr("title").trim();
                                        if (recte == "")
                                            return '<span class="recteText">~</span>';
                                        else
                                            return recte;
                                    }
                            });
                            
                        $(window).resize(positionSubstJoinHighlightDivs);

                        $("#changesMode, #finalMode, #readingMode").click(changeRenderMode);
                    
                        initSubstJoinHighlight();
        
                        
                    });
                    
                </script>
                
            </head>
            <body>
				<!-- =====================  Reading Navigation      ================================ -->
                <div id="cellSlider" style="width:calc(100% - 2ex); height:13ex; padding:1ex; left:0; top:0; position:absolute">

                    <br/>
                    <div id="slider"/>
                    <br/>
                    <input type="button" id="changesMode" value="Process" style="padding:5px; width:130px"/>
                    <input type="button" id="finalMode" value="Product" style="padding:5px; width:130px"/>
                    <input type="button" id="readingMode" value="Reading Text" style="padding:5px; width:130px"/>

                    <span id="ZoomCtlAnchor" style="display:inline-block; position:absolute">
                        <span style="width:0.5em; display:inline-block"/>
                        <div id="ZoomCtl"/>
                    </span>
                    
                </div>
                                            
                <!-- =====================  Text Display Window    ================================ -->
                <div id="cellContent" style="width:calc(50% - 2ex); height:calc(100% - 17ex); left:0; top:15ex; position:absolute; overflow:auto; padding:1ex">

                    <table border="0" cellspacing="0" cellpadding="0">
                        <tr>
                            <td style="width:15px" valign="top" id="substJoinBar">
                            </td>
                            <td>
                                <xsl:apply-templates/>
                            </td>
                        </tr>
                    </table>

                </div>
				<!-- =====================  Page Picture Display Window    ================================ -->
                <div id="cellImage" style="width:50%; height:calc(100% - 15ex); position:absolute; left:50%; top:15ex">
                    <div id="yourImageID" style="width:100%; height:100%"/>
                </div>
				
                <!-- =====================  Picture Page Controls   ======================================= --> 
                        <span id="MyPageCtl" style="bottom:10px; left:calc(50% + 15px); position:absolute; z-index:20"/>
                
                <!-- =============  Image Markup Areas (red box overlays)  SVG  =========================== --> 
                        <xsl:call-template name="GeneratePolygonSVG">
                            <xsl:with-param name="root" select="/"/>
                        </xsl:call-template>

                
                
            </body>
        </html>
    </xsl:template>

    <!-- l -->
    <xsl:template match="//l">
        <xsl:apply-templates/>
        <br/>
    </xsl:template>
    
    <!-- lg -->
    <xsl:template match="//lg">
        <xsl:apply-templates/><br/>
    </xsl:template>
    
    <!-- p and head -->
    <xsl:template match="p|head">
        
        <div class="Measure" id="{generate-id()}">
            <xsl:apply-templates/>
        </div>
        <div id="newline_{generate-id()}">                        
            <xsl:text>&#160;</xsl:text>
        </div>
        
    </xsl:template>
    
    <xsl:template match="note">
        <span style="color:#DD0000" class="readingModeOff"> <!-- TODO: move into stylesheet instead of inline -->
            <xsl:text>{</xsl:text>
            <xsl:apply-templates/>
            <xsl:text>}</xsl:text>
        </span>
    </xsl:template>

</xsl:stylesheet>