<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet 
    xmlns="http://www.w3.org/1999/xhtml"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    xmlns:jmp="http://www.joshpollock.com"
    xpath-default-namespace="http://www.tei-c.org/ns/1.0"
    exclude-result-prefixes="xs jmp"
    version="2.0">

    <xsl:function name="jmp:NameOfNode" as="xs:string">
        <xsl:param name="Node"/>
        <xsl:variable name="Name">
            <xsl:choose>
                <xsl:when test="$Node instance of attribute()">
                    <xsl:value-of select="concat('@', name($Node))"/>
                </xsl:when>
                <xsl:when test="$Node instance of text()">
                    <xsl:value-of select="'text()'"/>                
                </xsl:when>
                <xsl:when test="$Node instance of comment()">
                    <xsl:value-of select="'comment()'"/>                
                </xsl:when>
                <xsl:otherwise>
                    <xsl:value-of select="name($Node)"/>
                </xsl:otherwise>
            </xsl:choose>
        </xsl:variable>
        <xsl:variable name="Position">
            <xsl:choose>
                <xsl:when test="$Node instance of attribute()"/>
                <xsl:when test="$Node instance of text()">
                    <xsl:value-of select="count($Node/preceding-sibling::text())+1"/>
                </xsl:when>
                <xsl:when test="$Node instance of comment()">
                    <xsl:value-of select="count($Node/preceding-sibling::comment())+1"/>
                </xsl:when>
                <xsl:otherwise>
                    <xsl:value-of select="count($Node/preceding-sibling::*[name()=name($Node)])+1"/>
                </xsl:otherwise>
            </xsl:choose>
        </xsl:variable>
        <xsl:value-of select="concat($Name, if ($Position != '') then concat('[', $Position, ']') else '')"/>
    </xsl:function>
    
    <xsl:function name="jmp:XpathOfNode">
        <xsl:param name="Node"/>
        <xsl:if test="$Node and $Node/..">
            <xsl:value-of select="concat(jmp:XpathOfNode($Node/..), '/', jmp:NameOfNode($Node))"/>
        </xsl:if>
    </xsl:function>
    
    <xsl:function name="jmp:GenerateJavascriptArray">
        <xsl:param name="Name"/>
        <xsl:param name="List"/>
        
        var <xsl:value-of select="$Name"/> = [
        <xsl:for-each select="$List">
            "<xsl:value-of select="."/>"
            <xsl:if test="position()!=last()">,</xsl:if>
        </xsl:for-each>
        ];
        
        
    </xsl:function>
    
</xsl:stylesheet>