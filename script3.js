var textarea_editor = document.getElementById("code");
textarea_editor.value = "";

// Initialize CodeMirror
var cEditor = CodeMirror.fromTextArea(textarea_editor, {
    mode: {
        name: "text/x-csrc",
        version: 3,
        singleLineStringErrors: false
    },
    lineNumbers: true,
    theme: "dracula",
    extraKeys: { "Ctrl-Space": "autocomplete" },
    indentUnit: 4,
    matchBrackets: true
});

function cleanOutput(){
    document.getElementById('result').innerText=""
}

function runCode() {
    var code = cEditor.getValue();
    fetch('http://localhost:5000/execute_c', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ code: code }),
    })
        .then(response => response.json())  
        .then(data => {
            //display the response
            if (data.output) {
                document.getElementById('result').innerText = data.output;
            } else if (data.error) {
                document.getElementById("result").innerText = "Error: " + data.error;
            }
        })
        .catch(error => console.error('Error:', error));
    cleanOutput()
}