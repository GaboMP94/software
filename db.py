# db.py

import pymysql

def get_connection():
    return pymysql.connect(
        host="sql200.infinityfree.com",
        user="epiz_30541411",
        password="1ljsGSAWVLuvE",
        database="epiz_30541411_software",
        charset="utf8mb4",
        cursorclass=pymysql.cursors.DictCursor
    )
