<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet 
    xmlns="http://www.w3.org/1999/xhtml"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    xmlns:jmp="http://www.joshpollock.com"
    xpath-default-namespace="http://www.tei-c.org/ns/1.0"
    exclude-result-prefixes="xs jmp"
    version="2.0">

    <xsl:variable name="Polygons" select="document('polygons.xml')//jmp:polygon"/>
    <xsl:variable name="NumPages" select="max($Polygons/@page)"/>
    
    <xsl:function name="jmp:GetPolygon">
        <xsl:param name="id"/>
        <xsl:sequence select="$Polygons[@id = $id]"/>
    </xsl:function>
    
    <xsl:function name="jmp:GetPolygonPage">
        <xsl:param name="id"/>
        <xsl:sequence select="jmp:GetPolygon($id)/@page"/>
    </xsl:function>
    
    <xsl:template name="CheckPolygons">
  
        <xsl:param name="root"/>
        
        <!-- make sure all the IDs are unique -->
        <xsl:for-each-group select="$Polygons/@id" group-by=".">
            <xsl:if test="count(current-group()) &gt; 1">
                <xsl:message terminate="yes">
                    <xsl:text>Polygon id '</xsl:text><xsl:value-of select="current-grouping-key()"/><xsl:text>' used more than once&#10;</xsl:text>
                    <xsl:for-each select="current-group()">
                        <xsl:value-of select="jmp:XpathOfNode(.)"/>
                        <xsl:text>&#10;</xsl:text>
                    </xsl:for-each>
                </xsl:message>
            </xsl:if>
        </xsl:for-each-group>        

        <!-- make sure every ID mentioned in each @source attribute actually exists in polygons.xml -->
        <xsl:for-each select="$root//@source">
            <xsl:variable name="source" select="."/>
            <xsl:for-each select="tokenize(normalize-space(.), ' ')">
                <xsl:variable name="id" select='.'/>
                <xsl:if test="not(jmp:GetPolygon($id))">
                    <xsl:message terminate="yes">
                        <xsl:text>Polygon id '</xsl:text><xsl:value-of select="."/><xsl:text>' referenced, but never defined&#10;</xsl:text>
                        <xsl:value-of select="jmp:XpathOfNode($source)"/>
                    </xsl:message>
                </xsl:if>
            </xsl:for-each>
        </xsl:for-each>

        <!-- make sure every ID in polygons.xml is mentioned in a @source attribute -->
        <xsl:for-each select="$Polygons/@id">
            <xsl:variable name="id" select="."/>
            <xsl:if test="not($root//*[tokenize(@source, ' ')[. = $id]])">
                <xsl:message terminate="no">
                    <xsl:text>Polygon id '</xsl:text><xsl:value-of select="$id"/><xsl:text>' defined, but never referenced&#10;</xsl:text>
                </xsl:message>                
            </xsl:if>
        </xsl:for-each>
        
        <!-- @source only allowed on <del> and <add> -->
        <xsl:for-each select="$root//*[@source and not(self::del | self::add)]">
            <xsl:message terminate="yes">
                <xsl:text>Found @source on something other than a del or add element&#10;</xsl:text>
                <xsl:value-of select="jmp:XpathOfNode(.)"/>
            </xsl:message>
        </xsl:for-each>
    
    </xsl:template>
    
    <xsl:template name="GeneratePolygonSVG">
        
        <xsl:param name="root"/>

        <xsl:call-template name="CheckPolygons">
            <xsl:with-param name="root" select="$root"/>
        </xsl:call-template>
        
        <svg id="cellPolygons" style="width:50%; height:calc(100% - 15ex); position:absolute; left:50%; top:15ex; z-index:10; pointer-events:none; overflow:hidden">
            
            <defs>
                <pattern id="StripedPattern" patternUnits="userSpaceOnUse" x="0" y="0" width="10" height="10" viewBox="0 0 10 10" >
                    <path d="M -10 -10 L 20 20 z" stroke-width="3" stroke="#DD0000" stroke-linecap="square" stroke-linejoin="miter"/>
                    <path d="M 0 -10 L 20 10 z" stroke-width="3" stroke="#DD0000" stroke-linecap="square" stroke-linejoin="miter"/>
                    <path d="M -10 0 L 10 20 z" stroke-width="3" stroke="#DD0000" stroke-linecap="square" stroke-linejoin="miter"/>
                </pattern> 
            </defs>
            
            <g id="svg_pages">
                <xsl:for-each-group select="$Polygons" group-by="@page">
                    
                    <g id="svg_page_{current-grouping-key()}">
                        
                        <xsl:for-each select="current-group()">
                            
                            <g style="opacity:0" id="{@id}">
                                
                                <xsl:if test="normalize-space(@text) != ''">
                                    <text style="font-family:calibri; font-weight:bold; font-size:1em" text-anchor="middle" alignment-baseline="middle" x="{(@left+@right) div 2}px" y="{(@top+@bottom) div 2}px" dy="0.5ex" fill="#DD0000">
                                        <!-- removed stroke="white" stroke-width="0.1ex" -->                                        
                                        <xsl:value-of select="@text"/>
                                    </text>
                                </xsl:if>
                                <path d="{@path}" stroke="#DD0000" stroke-width="3"/>
                                
                            </g>

                        </xsl:for-each>
                    </g>
                </xsl:for-each-group>
            </g>
        </svg>
        
    </xsl:template>

    <xsl:function name="jmp:GeneratePolygonPageMap">
        var polygonPages = {
        <xsl:for-each select="$Polygons">
            <xsl:value-of select="@id"/>: 
            {
            page: <xsl:value-of select="@page"/>,
            left: <xsl:value-of select="@left"/>,
            top: <xsl:value-of select="@top"/>,
            right: <xsl:value-of select="@right"/>,
            bottom: <xsl:value-of select="@bottom"/>
            }
            <xsl:if test="position()!=last()">,</xsl:if>
        </xsl:for-each>
        };
    </xsl:function>
        
</xsl:stylesheet>