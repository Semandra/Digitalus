<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet 
    xmlns="http://www.w3.org/1999/xhtml"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    xmlns:jmp="http://www.joshpollock.com"
    xpath-default-namespace="http://www.tei-c.org/ns/1.0"
    exclude-result-prefixes="xs jmp"
    version="2.0">

    <xsl:template name="CheckJoins">

        <xsl:variable name="Root" select="/"/>

        <xsl:for-each select="$GlobalJoins">
            
            <xsl:variable name="Join" select="."/>
            
            <xsl:variable name="TargetNodes" as="node()*">
                <xsl:for-each select="tokenize(normalize-space(@target), ' ')">
            
                    <xsl:if test="not(starts-with(., '#'))">
                        <xsl:message terminate="yes">
                            <xsl:text>ID '</xsl:text>
                            <xsl:value-of select="."/>
                            <xsl:text>' in a @target attribute does not start with #&#10;</xsl:text>
                            <xsl:value-of select="jmp:XpathOfNode($Join)"/>
                        </xsl:message>
                    </xsl:if>
                    
                    <xsl:variable name="JoinID" select="substring-after(., '#')"/>
                    <xsl:variable name="TargetNode" select="$Root//*[@xml:id = $JoinID]"/>
                    
                    <xsl:if test="not($TargetNode)">
                        <xsl:message terminate="yes">
                            <xsl:text>ID '</xsl:text>
                            <xsl:value-of select="$JoinID"/>
                            <xsl:text>' in a @target attribute refers to non-existant node&#10;</xsl:text>
                            <xsl:value-of select="jmp:XpathOfNode($Join)"/>
                        </xsl:message>                        
                    </xsl:if>
                    
                    <xsl:sequence select="$TargetNode"/>
                    
                </xsl:for-each>
            </xsl:variable> <!-- TargetNodes -->
            
            <xsl:if test="count($TargetNodes)=1">
                <xsl:message terminate="yes">
                    <xsl:text>SubstJoin that points to a single change is not meaningful&#10;</xsl:text>
                    <xsl:value-of select="jmp:XpathOfNode($Join)"/>
                </xsl:message>                                        
            </xsl:if>
            
            <xsl:for-each select="$TargetNodes">
                <xsl:if test="@change != $TargetNodes[1]/@change">
                    <xsl:message terminate="yes">
                        <xsl:text>All IDs in a substJoin must refer to adds in the same session&#10;</xsl:text>
                        <xsl:value-of select="jmp:XpathOfNode($TargetNodes[1])"/><xsl:text>&#10;</xsl:text>
                        <xsl:value-of select="jmp:XpathOfNode(.)"/>
                    </xsl:message>
                </xsl:if>
            </xsl:for-each>
            
        </xsl:for-each>
        
        <xsl:variable name="JoinIDs" as="xs:string*">
            <xsl:for-each select="$GlobalJoins">
                <xsl:sequence select="tokenize(@target, ' ')"/>
            </xsl:for-each>
        </xsl:variable>
        <xsl:for-each-group select="$JoinIDs" group-by=".">
            <xsl:if test="count(current-group()) > 1">
                <xsl:message terminate="yes">
                    <xsl:text>IDs can only be mentioned once across all substJoins</xsl:text>
                    <xsl:value-of select="concat(' (', current-grouping-key(), ')')"/><xsl:text>&#10;</xsl:text>
                    <xsl:value-of select="jmp:XpathOfNode($GlobalJoins[tokenize(@target, ' ')[. = current-grouping-key()]][1])"/><xsl:text>&#10;</xsl:text>
                    <xsl:value-of select="jmp:XpathOfNode($GlobalJoins[tokenize(@target, ' ')[. = current-grouping-key()]][2])"/>
                </xsl:message>
            </xsl:if>
        </xsl:for-each-group>
        
    </xsl:template>
    
    <xsl:function name="jmp:JoinsFromIDs" as="xs:string*">
        
        <xsl:param name="IDs"/>
        
        <xsl:for-each select="$IDs">
            <xsl:variable name="ID" select="concat('#', .)"/>
            <xsl:value-of select="generate-id($GlobalJoins[tokenize(@target, ' ')[. = $ID]])"/>
        </xsl:for-each>
        
    </xsl:function>
    
</xsl:stylesheet>