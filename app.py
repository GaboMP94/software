# app.py
import os
from flask import Flask
from funcionarios import funcionarios_bp

app = Flask(__name__)

# Registrar Blueprint
app.register_blueprint(funcionarios_bp)

if __name__ == '__main__':
    port = int(os.environ.get("PORT", 5000))  # Render le pasa este valor automáticamente
    app.run(host='0.0.0.0', port=port)