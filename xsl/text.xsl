<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet 
    xmlns="http://www.w3.org/1999/xhtml"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    xmlns:jmp="http://www.joshpollock.com"
    xpath-default-namespace="http://www.tei-c.org/ns/1.0"
    exclude-result-prefixes="xs jmp"
    version="2.0">
    
    <xsl:variable name="NewLineChar" select="'&#10;'"/>
    <xsl:variable name="ParagraphChar" select="'&#182;'"/>
    <xsl:variable name="IllegibleChar" select="'&#8224;'"/>
    <xsl:variable name="SoftHyphenChar" select="'&#173;'"/>
    
    <!-- removes every newline character, plus all the spaces that follow it (spaces at the end of a line are preserved) -->
    <xsl:function name="jmp:RemoveTextIndent">
        <xsl:param name="Text"></xsl:param>
        <xsl:value-of select="replace($Text, '&#x0A; *', '')"/>
    </xsl:function>
    
    <!-- process all text nodes by stripping whitespac, and dealing with paragraph/illegible marks -->
    <xsl:template match="//text()" priority="1">
        
        <!-- paragraph char can only appear inside revised text -->
        <xsl:if test="contains(., $ParagraphChar) and not(ancestor::del | ancestor::add)">
            <xsl:message terminate="yes">
                <xsl:text>Cannot use </xsl:text><xsl:value-of select="$ParagraphChar"/><xsl:text> outside of del/add&#10;</xsl:text>
                <xsl:value-of select="jmp:XpathOfNode(.)"/>
            </xsl:message>                    
        </xsl:if>
        
        <xsl:for-each select="tokenize(jmp:RemoveTextIndent(.), $ParagraphChar)">

            <xsl:for-each select="tokenize(., $IllegibleChar)">

                <xsl:for-each select="tokenize(., $SoftHyphenChar)">
                    
                    <xsl:value-of select="."/>
 
                    <xsl:if test="position() != last()">
                        <span class="readingModeOff">
                            <xsl:text>-</xsl:text>
                        </span>
                    </xsl:if>
                    
                </xsl:for-each>
 
                <xsl:if test="position() != last()">
                    <span class="bracketNormal" style="display:inline">
                        <xsl:value-of select="$IllegibleChar"/>
                    </span>
                </xsl:if>
                
            </xsl:for-each>

            <xsl:if test="position() != last()">                
                <span class="allChangesModeOn bracketNormal">
                    <xsl:value-of select="$ParagraphChar"/>
                </span>
                <span class="allChangesModeOff">
                    <br/><br/>
                </span>
            </xsl:if>
            
        </xsl:for-each>
    
    </xsl:template>

</xsl:stylesheet>