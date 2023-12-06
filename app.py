from flask import Flask, render_template, jsonify
from flask_sqlalchemy import SQLAlchemy

app = Flask(__name__)

# Replace these with your MySQL database credentials
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+pymysql://id21627112_cs310_22:Group22@TAMU@localhost/id21627112_project_db'
db = SQLAlchemy(app)

@app.route('/fetch_users')
def fetch_users():
    # Use the existing User table in the database
    result = db.engine.execute("SELECT First_Name, M_Initial, Last_Name, Username, Email, Discord_Name FROM User")
    users = [dict(row) for row in result]
    return jsonify(users)

@app.route('/')
def index():
    return render_template('frontend/index.html')
 

if __name__ == '__main__':
    app.run(debug=True, port=8080)
