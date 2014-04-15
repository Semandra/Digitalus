<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet 
    xmlns="http://www.w3.org/1999/xhtml"
    xmlns:xsl="http://www.w3.org/1999/XSL/Transform"
    xmlns:xs="http://www.w3.org/2001/XMLSchema"
    xmlns:jmp="http://www.joshpollock.com"
    xpath-default-namespace="http://www.tei-c.org/ns/1.0"
    exclude-result-prefixes="xs jmp"
    version="2.0">

    <xsl:variable name="SessionColors" as="xs:string*">
        <xsl:sequence select="'#FFBFBF'"/> <!-- red --> 
        <xsl:sequence select="'#FFBF7F'"/> <!-- orange --> 
        <xsl:sequence select="'#FFFF7F'"/> <!-- yellow -->
        <xsl:sequence select="'#7FFF7F'"/> <!-- green -->
        <xsl:sequence select="'#BFBFFF'"/> <!-- blue -->
        <xsl:sequence select="'#CF8FFF'"/> <!-- purple -->
        <xsl:sequence select="'#CFCFCF'"/> <!-- gray -->
        <xsl:sequence select="'#AFAFAF'"/> <!-- gray -->
    </xsl:variable>    

    <!-- don't output anything for <listChange> -->
    <xsl:template match="listChange"/>
        
    <xsl:variable name="ImplicitFirstLayer" select="'A1'"/>
    <xsl:variable name="ImplicitFirstSession" select="jmp:GetSessionFromLayer($ImplicitFirstLayer)"/>
    
    <xsl:function name="jmp:GetSessionFromLayer" as="xs:string">
        <xsl:param name="Layer"/>
        <xsl:value-of select="substring($Layer, 1, 1)"/>
    </xsl:function>
    
    <xsl:function name="jmp:GetSessions" as="xs:string*">
        
        <xsl:param name="node"/>
        
        <!-- TODO: would be simpler to get sessions straight from //listChange/change/@id -->
        <xsl:for-each-group select="jmp:GetLayers($node)" group-by="jmp:GetSessionFromLayer(.)">
            <xsl:value-of select="current-grouping-key()"/>
        </xsl:for-each-group>
        
    </xsl:function>
    
    <xsl:function name="jmp:GetLayers" as="xs:string*">
        
        <xsl:param name="node"/>
        
        <xsl:value-of select="$ImplicitFirstLayer"/>
        <xsl:for-each-group select="$node/descendant-or-self::add" group-by="jmp:GetLayerFromAdd(.)">
            <xsl:sort select="current-grouping-key()"/>                
            <xsl:value-of select="current-grouping-key()"/>
        </xsl:for-each-group>            
        
    </xsl:function>
    
    <xsl:function name="jmp:ClassesFromLayerList" as="xs:string*">
        <xsl:param name="Layers"/>
        <xsl:for-each select="$Layers">
            <xsl:sequence select="concat('showLayer', ., if (position()!=last()) then ' ' else '')"/>
        </xsl:for-each>
    </xsl:function>
    
    <xsl:function name="jmp:GenerateLayerList" as="xs:string*">
        <xsl:param name="Layers"/>
        <xsl:param name="ThisLayer"/>
        <xsl:variable name="NextLayer" select="$Layers[. &gt; $ThisLayer][1]"/>
        <xsl:sequence select="$GlobalLayers[. &gt;= $ThisLayer and not(. &gt;= $NextLayer)]"/>
    </xsl:function>
    
    <xsl:function name="jmp:GetSessionFromAdd" as="xs:string">
        
        <xsl:param name="add"/>
        
        <!-- must have a @change attribute -->
        <xsl:if test="not($add/@change)">
            <xsl:message terminate="yes">
                <xsl:text>Add element must have @change attribute&#10;</xsl:text>
                <xsl:value-of select="jmp:XpathOfNode($add)"/>
            </xsl:message>
        </xsl:if>
        
        <!-- @change must start with # -->
        <xsl:if test="not(starts-with($add/@change, '#'))">
            <xsl:message terminate="yes">
                <xsl:text>Session ID references must begin with #&#10;</xsl:text>
                <xsl:value-of select="jmp:XpathOfNode($add/@change)"/>
            </xsl:message>
        </xsl:if>
        
        <!-- extrace the stirng after the # -->
        <xsl:variable name="session" select="substring-after($add/@change, '#')"/>

        <!-- must be a single uppercase letter in the correct range -->
        <xsl:if test="not(matches($session, '^[A-H]$'))">
            <xsl:message terminate="yes">
                <xsl:text>Session '</xsl:text><xsl:value-of select="$session"/><xsl:text>' not valid. Must be a single uppercase letter between A and H.&#10;</xsl:text>
                <xsl:value-of select="jmp:XpathOfNode($add/@change)"/>
            </xsl:message>
        </xsl:if>
        
        <!-- the regexp above assumes a max of 8 sessions; fix the regexp if you add to $SessionColors --> 
        <xsl:if test="count($SessionColors) != 8">
            <xsl:message terminate="yes">Internal XSLT error</xsl:message>
        </xsl:if>
        
        <!-- all sessions refrenced in the XML must be defined in <listChange> -->
        <xsl:if test="not(root($add)//listChange/change[@xml:id=$session])">
            <xsl:message terminate="yes">
                <xsl:text>Session '</xsl:text><xsl:value-of select="$session"/><xsl:text>' not found&#10;</xsl:text>
                <xsl:value-of select="jmp:XpathOfNode($add/@change)"/>
            </xsl:message>
        </xsl:if>
        
        <!-- TODO: It's a bit odd that we're using the xml:id as the user visible session label. Could use the @n attribute on the <change> or something. -->
        
        <xsl:value-of select="$session"/>
        
    </xsl:function>
    
    <xsl:function name="jmp:GetLayerFromAdd" as="xs:string">
        
        <xsl:param name="add"/>

        <!-- make sure <add> has @seq -->
        <xsl:if test="not($add/@seq)">
            <xsl:message terminate="yes">
                <xsl:text>Add element must have @seq attribute&#10;</xsl:text>
                <xsl:value-of select="jmp:XpathOfNode($add)"/>
            </xsl:message>
        </xsl:if>

        <!-- make sure @seq is an integer that's 1 or greater -->
        <xsl:if test="not($add/@seq castable as xs:integer) or $add/@seq &lt; 1">
            <xsl:message terminate="yes">
                <xsl:text>@seq must be a positive integer&#10;</xsl:text>
                <xsl:value-of select="jmp:XpathOfNode($add/@seq)"/>
            </xsl:message>            
        </xsl:if>                
        
        <!-- make sure the @seq for session A is 2 or greater -->
        <xsl:if test="jmp:GetSessionFromAdd($add)='A' and $add/@seq &lt; 2">
            <xsl:message terminate="yes">
                <xsl:text>Minimum allowable @seq for session A is 2&#10;</xsl:text>
                <xsl:value-of select="jmp:XpathOfNode($add/@seq)"/>
            </xsl:message>            
        </xsl:if>                
        
        <!-- TODO: consider doing away with @seq -->
        
        <xsl:value-of select="concat(jmp:GetSessionFromAdd($add), $add/@seq)"/>
        
    </xsl:function>
    
</xsl:stylesheet>