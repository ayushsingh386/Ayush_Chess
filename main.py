from flask import Flask, render_template, request, redirect, url_for
from flask_sqlalchemy import SQLAlchemy

app = Flask(__name__)
app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql://Ayush:Ayush@386@root/db' 
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
db = SQLAlchemy(app)

class Contact(db.Model):
    id = db.Column(db.Integer, primary_key=True)
    name = db.Column(db.String(100), nullable=False)
    email = db.Column(db.String(120), unique=True, nullable=False)
    message = db.Column(db.Text, nullable=False)

    def _repr_(self):
        return '<Contact %r>' % self.name

@app.route('/')
def index():
    return render_template('index.html')

@app.route('/about')
def about():
    return render_template('about.html')

@app.route('/services')
def services():
    return render_template('services.html')

@app.route('/contact', methods=['GET', 'POST'])
def contact():
    if request.method == 'POST':
        name = request.form['name']
        email = request.form['email']
        message = request.form['message']

        # Validate data
        if not name or not email or not message:
            error = 'Please fill in all fields.'
            return render_template('contact.html', error=error)

        new_contact = Contact(name=name, email=email, message=message)
        db.session.add(new_contact)
        db.session.commit()

        return redirect(url_for('success'))

    return render_template('contact.html')

@app.route('/success')
def success():
    return render_template('success.html')

@app.route('/details')
def details():
    contacts = Contact.query.all()
    return render_template('details.html', contacts=contacts)

if __name__ == '_main_':
    with app.app_context():
        db.create_all() 
    app.run(debug=True)