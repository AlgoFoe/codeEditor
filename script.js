var htmlEditor = CodeMirror.fromTextArea(document.getElementById("html"), {
    mode: "xml",
    lineNumbers: true,
    htmlMode: true,
    theme: "dracula",
    extraKeys: { "Ctrl-Space": "autocomplete" },
    indentUnit: 4,
    matchBrackets: true
});

var cssEditor = CodeMirror.fromTextArea(document.getElementById("css"), {
    mode: "css",
    lineNumbers: true,
    theme: "dracula",
    extraKeys: { "Ctrl-Space": "autocomplete" },
});

var jsEditor = CodeMirror.fromTextArea(document.getElementById("js"), {
    mode: "javascript",
    lineNumbers: true,
    theme: "dracula",
    extraKeys: { "Ctrl-Space": "autocomplete" },
});

var output = document.getElementById("output");

//   htmlEditor.on("change", run);
//   cssEditor.on("change", run);
//   jsEditor.on("change", function(){
//     try{
//       run()
//     }
//     catch(e){
//     }
//   });

function run() {
    var htmlCode = htmlEditor.getValue();
    var cssCode = cssEditor.getValue();
    var jsCode = jsEditor.getValue();

    if (!output.contentDocument) {
        output.innerHTML = "Output";
    } else {
        output.contentDocument.body.innerHTML = htmlCode + "<style>" + cssCode + "</style>";
        output.contentWindow.eval(jsCode);
    }
}

function addClickEvent(id, callback) {
    document.getElementById(id).addEventListener('click', function () {
        showTab(this);
        if (callback) {
            callback();
        }
    });
}

addClickEvent("html-section", function () {
    showTab("html-code", "html-section");
});

addClickEvent("css-section", function () {
    showTab("css-code", "css-section");
});

addClickEvent("js-section", function () {
    showTab("js-code", "js-section");
});

function showTab(tabId, tabButtonId) {
    hideTabs(["html-code", "css-code", "js-code"]);
    showTabContent(tabId);
    setActiveTab(tabButtonId);
}

function hideTabs(tabIds) {
    tabIds.forEach(function (id) {
        var element = document.getElementById(id);
        if (element) {
            element.style.display = "none";
        }
    });
}

function showTabContent(tabId) {
    var element = document.getElementById(tabId);
    if (element) {
        element.style.display = "block";
    }
}

function setActiveTab(tabId) {
    var element = document.getElementById(tabId);
    if (element) {
        element.classList.add("active");
        const otherTabs = ["html-section", "css-section", "js-section"].filter(tab => tab !== tabId);
        otherTabs.forEach(function (id) {
            var otherTab = document.getElementById(id);
            if (otherTab) {
                otherTab.classList.remove("active");
            }
        });
    }
}

function setup() {
    hideTabs(["css-code", "js-code"]);
}

setup();
function run() {
    var htmlCode = htmlEditor.getValue();
    var cssCode = cssEditor.getValue();
    var jsCode = jsEditor.getValue();
    var output = document.getElementById("output");

    if (!output.contentDocument) {
        output.innerHTML = "Output";
    } else {
        output.contentDocument.body.innerHTML = htmlCode + "<style>" + cssCode + "</style>";
        output.contentWindow.eval(jsCode);
    }
}