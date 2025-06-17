# funcionarios.py

from flask import Blueprint, jsonify
from db import get_connection

funcionarios_bp = Blueprint('funcionarios', __name__)

@funcionarios_bp.route('/funcionarios', methods=['GET'])
def listar_funcionarios():
    try:
        conn = get_connection()
        with conn.cursor() as cursor:
            cursor.execute("SELECT * FROM funcionarios")
            resultados = cursor.fetchall()
        return jsonify({"status": "success", "data": resultados})
    except Exception as e:
        return jsonify({"status": "error", "message": str(e)})
    finally:
        conn.close()
