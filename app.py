# app.py

from flask import Flask
from funcionarios import funcionarios_bp

app = Flask(__name__)

# Registrar Blueprint
app.register_blueprint(funcionarios_bp)

if __name__ == '__main__':
    app.run(debug=True)
