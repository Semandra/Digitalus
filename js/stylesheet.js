

var styleSheets =
{ 
    ShowLayer: 1,
    SessionColor: 2,
    MultiLayer: 3,
    SingleLayer: 4,
    AllChangesMode: 5,
    FinalMode: 6,
    ReadingMode: 7,
    LineBreak: 8,
    Highlights: 9,
    JoinHighlightSessions: 10,
    JoinHighlights: 11
};

function getStyleSheet(name)
{
    var styleSheet = document.styleSheets[styleSheets[name]];
    if (styleSheet == undefined || (styleSheet.id && styleSheet.id != name))
        {
            alert("Bogus stylesheet index");
            return;
        }
    return styleSheet;
}

function getRulesFromStyleSheet(styleSheet)
{
    return styleSheet.rules ? styleSheet.rules : styleSheet.cssRules;
}

function getStyleSheetRules(name)
{
    return getRulesFromStyleSheet(getStyleSheet(name));
}

function addRule(styleSheet, selector, style)
{
    if (styleSheet.addRule)
        styleSheet.addRule(selector, style);
    else
        styleSheet.insertRule(selector + "{ " + style + " }", getRulesFromStyleSheet(styleSheet).length);
}

function removeRule(styleSheet, selector)
{

    var rules = getRulesFromStyleSheet(styleSheet);

    for (i=rules.length-1; i>=0; i--)
    {
        var rule = rules[i];
        if (rule.selectorText.replace(/\"/g, "'") == selector)
        {
            if (styleSheet.removeRule) styleSheet.removeRule(i);
            else if (styleSheet.deleteRule) styleSheet.deleteRule(i);
        }
    }

}

function addRemoveRule(add, styleSheet, selector, style)
{
    if (add)
        addRule(styleSheet, selector, style);
    else
        removeRule(styleSheet, selector);
}
