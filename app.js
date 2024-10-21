const express = require('express');
const mysql = require('mysql2');
const bodyParser = require('body-parser');
const path = require('path');

const app = express();
app.use(bodyParser.urlencoded({ extended: true }));
app.use(express.static('public')); // to serve static files like CSS

// MySQL connection
const db = mysql.createConnection({
  host: 'localhost',
  user: 'root',  // replace with your MySQL username
  password: 'Changeme@123',  // replace with your MySQL password
  database: 'course_portal'
});

db.connect((err) => {
  if (err) throw err;
  console.log('Connected to MySQL');
});

// Route to serve homepage (index.html)
app.get('/', (req, res) => {
  res.sendFile(path.join(__dirname, 'views', 'index.html'));
});

// Route to serve enroll page (enroll.html)
app.get('/enroll', (req, res) => {
  res.sendFile(path.join(__dirname, 'views', 'enroll.html'));
});

// Handling the enrollment form submission
app.post('/submit-enrollment', (req, res) => {
  const { username, email, phone } = req.body;
  const sql = 'INSERT INTO enrollments (username, email, phone) VALUES (?, ?, ?)';
  
  db.query(sql, [username, email, phone], (err, result) => {
    if (err) throw err;
    res.send('Enrollment successful');
  });
});

// Start the server
app.listen(3000, () => {
  console.log('Server running on http://localhost:3000');
});
