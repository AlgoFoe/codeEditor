var textarea_editor = document.getElementById("pythonCode");
textarea_editor.value = "";

// Initialize CodeMirror
var pythonEditor = CodeMirror.fromTextArea(textarea_editor, {
    mode: {
        name: "python",
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

async function executePython() {
    // Get the value from CodeMirror instance
    const pythonCode = pythonEditor.getValue();
    // Send Python code to the backend
    const response = await fetch('http://localhost:5000/execute_python', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify({ python_code: pythonCode }),
    });

    const result = await response.json();

    // Display the result in the frontend
    document.getElementById('result').innerText = result.output || result.error;
}
