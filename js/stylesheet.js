var styleSheets =
{ 
    ShowLayer: 1,
    SessionColor: 2,
    MultiLayer: 3,
    SingleLayer: 4,
    ProcessMode: 5,
    ProductMode: 6,
    ReadingMode: 7,
    LineBreak: 8,
    Highlights: 9,
    JoinHighlightSessions: 10,
    JoinHighlights: 11,
    PolygonHighlights: 12
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

var normalizeSelector = [];

function addRule(styleSheet, selector, style)
{
    var i = styleSheet.insertRule(selector + "{ " + style + " }", getRulesFromStyleSheet(styleSheet).length);
    normalizeSelector[selector] = styleSheet.cssRules[i].selectorText;
}

function removeRule(styleSheet, selector)
{

    var normalizedSelector = normalizeSelector[selector];
    if (!normalizedSelector)
        normalizedSelector = selector;

    var rules = getRulesFromStyleSheet(styleSheet);

    for (i=rules.length-1; i>=0; i--)
    {
        if (rules[i].selectorText == normalizedSelector)
            styleSheet.deleteRule(i);
    }

}

function addRemoveRule(add, styleSheet, selector, style)
{
    if (add)
        addRule(styleSheet, selector, style);
    else
        removeRule(styleSheet, selector);
}
