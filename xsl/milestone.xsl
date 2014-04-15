<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet 
    xmlns="http://www.w3.org/1999/xhtml"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    xmlns:jmp="http://www.joshpollock.com"
    xpath-default-namespace="http://www.tei-c.org/ns/1.0"
    exclude-result-prefixes="xs jmp"
    version="2.0">

    <!-- lb -->
    <xsl:template match="//lb" name="lineBreak">
        <span class="readingModeOff">
            <span style="color:blue">/</span>
            <br/>
        </span>
    </xsl:template>
        
    <!-- milestone -->
    <xsl:template match="milestone|lg">
        <xsl:value-of select="@rend"/>
        <div>&#160;</div>
    </xsl:template>
    
    <!-- pb -->
    <xsl:template match="pb">
        <div class="readingModeOff">
            <div class="Measure" id="{generate-id()}">
                <div class="pb"><xsl:value-of select="@rend"/></div>
            </div>
            <div id="newline_{generate-id()}">  
                <xsl:text>&#160;</xsl:text>
            </div>
        </div>
    </xsl:template>
    
</xsl:stylesheet>