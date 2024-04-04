from flask import Flask, request, jsonify
from flask_cors import CORS
from contextlib import redirect_stdout
import io
import subprocess
import os
import sys
import traceback
import tempfile
import uuid #filename ke liye universally unique identifier 

app = Flask(__name__)
CORS(app)  

@app.route('/execute_python', methods=['POST'])
def execute_python():
    try:
        python_code = request.json['python_code']
        # Create an execution environment with builtins
        exec_env = {"__builtins__": __builtins__}
        with io.StringIO() as buf:
            # Redirect stdout to capture print statements
            old_stdout = sys.stdout
            sys.stdout = buf
            try:
                # Execute the provided code within the exec_env environment
                exec(python_code, exec_env)
            finally:
                # Restore original stdout
                sys.stdout = old_stdout
            output = buf.getvalue().strip()
        return jsonify({'output': output})
    except Exception as e:
        # Return traceback for debugging purposes. In a production environment, you might want to limit this information.
        error_traceback = traceback.format_exc()
        return jsonify({'error': str(e), 'traceback': error_traceback})


@app.route('/execute_c', methods=['POST'])
def execute_code():
    request_data = request.get_json()
    if request_data and 'code' in request_data:
        code = request_data['code']
        output, error = execute_code_helper(code)
        if error:
            return jsonify({'error': error}), 400
        else:
            return jsonify({'output': output}), 200
    else:
        return jsonify({'error': 'No code provided'}), 400

def execute_code_helper(code):
    with tempfile.TemporaryDirectory() as temp_dir:
        filename = os.path.join(temp_dir, f"{uuid.uuid4()}.c")
        executable = os.path.join(temp_dir, "executable")
        try:
            with open(filename, 'w') as file:
                file.write(code)
            #compile the C code
            compile_process = subprocess.run(['gcc', '-o', executable, filename], capture_output=True, text=True)
            if compile_process.returncode != 0:
                #return any compilation errors
                return None, compile_process.stderr
            #execute the compiled program
            execution_process = subprocess.run([executable], capture_output=True, text=True)
            return execution_process.stdout, None
        except Exception as e:
            return None, str(e)

@app.route('/execute_cpp', methods=['POST'])
def execute_code_cpp():
    request_data = request.get_json()
    if request_data and 'code' in request_data:
        code = request_data['code']
        output, error = execute_code_cpp_helper(code)
        if error:
            return jsonify({'error': error}), 400
        else:
            return jsonify({'output': output}), 200
    else:
        return jsonify({'error': 'No code provided'}), 400

def execute_code_cpp_helper(code):
    with tempfile.TemporaryDirectory() as temp_dir:
        filename = os.path.join(temp_dir, f"{uuid.uuid4()}.cpp")
        executable = os.path.join(temp_dir, "executable")
        try:
            with open(filename, 'w') as file:
                file.write(code)
            
            #compile the C++ code
            compile_process = subprocess.run(['g++', '-o', executable, filename], capture_output=True, text=True)
            if compile_process.returncode != 0:
                #return any compilation errors
                return None, compile_process.stderr
            #execute the compiled program
            execution_process = subprocess.run([executable], capture_output=True, text=True)
            return execution_process.stdout, None
        except Exception as e:
            return None, str(e)

@app.route('/execute_java', methods=['POST'])
def execute_java():
    request_data = request.get_json()
    if request_data and 'code' in request_data:
        code = request_data['code']
        output, error = execute_java_helper(code)
        if error:
            return jsonify({'error': error}), 400
        else:
            return jsonify({'output': output}), 200
    else:
        return jsonify({'error': 'No code provided'}), 400

def execute_java_helper(code):
    with tempfile.TemporaryDirectory() as temp_dir:
        java_filename = os.path.join(temp_dir, "Main.java")
        class_filename = os.path.join(temp_dir, "Main.class")
        try:
            with open(java_filename, 'w') as file:
                file.write(code)
            
            #Java file was successfully written or not
            if not os.path.exists(java_filename):
                return None, "Failed to write Java code to file."
            
            #compile the Java code
            compile_process = subprocess.run(['javac', java_filename], capture_output=True, text=True)
            if compile_process.returncode != 0:
                #return any compilation errors
                return None, compile_process.stderr
            
            #class file exists after compilation or not
            if not os.path.exists(class_filename):
                return None, "Compilation failed. No class file generated."
            
            #run the compiled Java program
            run_process = subprocess.run(['java', '-classpath', temp_dir, 'Main'], capture_output=True, text=True)
            return run_process.stdout, None
        except Exception as e:
            return None, str(e)

if __name__ == '__main__':
    app.run(debug=True)
