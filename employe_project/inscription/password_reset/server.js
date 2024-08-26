// server.js

const express = require('express');
const sendPasswordResetEmail = require('./sendEmail');
const app = express();

// Middleware to parse JSON requests
app.use(express.json());

app.post('/send-email', (req, res) => {
  const email = req.body.email;

  if (email) {
    sendPasswordResetEmail(email);
    res.send('Email sent successfully!');
  } else {
    res.status(400).send('Email is required');
  }
});

const PORT = 3000; // Or any port you prefer

app.listen(PORT, () => {
  console.log(`Server is running on port ${PORT}`);
});
