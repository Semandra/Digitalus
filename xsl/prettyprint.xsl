<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="2.0">
    
    <xsl:template match="/">
        <xsl:apply-templates>
            <xsl:with-param name="indent" tunnel="yes" select="'&#10;'"/>
        </xsl:apply-templates>
    </xsl:template>
    
    <xsl:template match="@*">
        <xsl:copy/>
    </xsl:template>
    
    <!-- |comment()|processing-instruction() -->
    
    <xsl:template match="comment()">

        <xsl:param name="indent" tunnel="yes"/>
        <xsl:variable name="indent2" select="concat($indent, '    ')"/>
        
        <xsl:value-of select="$indent2"/>
        
        <xsl:copy/>

        <xsl:if test="not(following-sibling::node()[* or normalize-space()!=''])">
            <xsl:value-of select="$indent"/>
        </xsl:if>
        
    </xsl:template>
    
    <xsl:template match="*">

        <xsl:param name="indent" tunnel="yes"/>
        <xsl:variable name="indent2" select="concat($indent, '    ')"/>
            
        <xsl:value-of select="$indent2"/>
        <xsl:copy>
            <xsl:apply-templates select="@*"/>
            <xsl:apply-templates select="*|text()|comment()">
                <xsl:with-param name="indent" tunnel="yes" select="$indent2"/>
            </xsl:apply-templates>
        </xsl:copy>
        
        <xsl:if test="not(following-sibling::node()[* or normalize-space()!=''])">
            <xsl:value-of select="$indent"/>
        </xsl:if>
        
    </xsl:template>
    
    <xsl:template match="text()">
        
        <xsl:param name="indent" tunnel="yes"/>
        <xsl:variable name="indent2" select="concat($indent, '    ')"/>

        <xsl:variable name="empty" select="string-length(normalize-space())=0"/>
        <xsl:variable name="short" select="string-length(normalize-space())&lt;5 and not(../*)"/>
        <xsl:variable name="endsWithSpace" select="substring(., string-length(.))=' '"/>

        <xsl:if test="not($empty)">
            
            <xsl:value-of select="$indent2"/>
            
            <xsl:value-of select="normalize-space()"/>
            
            <xsl:if test="$endsWithSpace">
                <xsl:text> </xsl:text>
            </xsl:if>
                
            <xsl:if test="not(following-sibling::node()[* or normalize-space()!=''])">
                <xsl:value-of select="$indent"/>
            </xsl:if>
            
        </xsl:if>

    </xsl:template>
    
</xsl:stylesheet>