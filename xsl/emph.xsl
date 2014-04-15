<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet 
    xmlns="http://www.w3.org/1999/xhtml"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    xmlns:jmp="http://www.joshpollock.com"
    xpath-default-namespace="http://www.tei-c.org/ns/1.0"
    exclude-result-prefixes="xs jmp"
    version="2.0">
    
    <xsl:template match="emph|foreign|title">
    
            <span>
                
                <xsl:choose>

                    <xsl:when test="@rend='bold'">
                        <xsl:attribute name="class" select="'emphBold'"/>
                    </xsl:when>
                    
                    <xsl:when test="@rend='italic'">
                        <xsl:attribute name="class" select="'emphItalic'"/>
                    </xsl:when>
                    
                    <xsl:when test="@rend='underline'">
                        <xsl:attribute name="class" select="'emphUnderline'"/>
                    </xsl:when>
                    
                    <xsl:when test="@rend='singleQuote'">
                        <xsl:attribute name="class" select="'emphSingleQuote'"/>
                    </xsl:when>
                    
                    <xsl:when test="@rend='doubleQuote'">
                        <xsl:attribute name="class" select="'emphDoubleQuote'"/>
                    </xsl:when>
                    
                    <xsl:when test="@rend='smallCaps'">
                        <xsl:attribute name="class" select="'emphSmallCaps'"/>
                    </xsl:when>
    
                    <!-- ok to be missing @rend for elements other than <emph> -->
                    <xsl:when test="not(@rend) and not(self::emph)">
                        <xsl:attribute name="class" select="'emphNone'"/>
                    </xsl:when>
    
                    <xsl:otherwise>
                        <xsl:message terminate="yes">
                            <xsl:text>Invalid @rend value '</xsl:text><xsl:value-of select="@rend"/><xsl:text>' on </xsl:text><xsl:value-of select="local-name()"/><xsl:text> element&#10;</xsl:text>
                            <xsl:value-of select="jmp:XpathOfNode(@rend)"/>
                        </xsl:message>
                    </xsl:otherwise>
                    
                </xsl:choose>
                <xsl:apply-templates/>
                
            </span>
    
            
        
    </xsl:template>
    
    
</xsl:stylesheet>