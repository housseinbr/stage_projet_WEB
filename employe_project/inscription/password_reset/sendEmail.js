// sendEmail.js

const nodemailer = require('nodemailer');

// Configure the email transporter
const transporter = nodemailer.createTransport({
  service: 'Gmail', // Change to your email service
  auth: {
    user: 'your-email@gmail.com', // Your email address
    pass: 'your-email-password'   // Your email password (use an app-specific password for Gmail)
  }
});

function sendPasswordResetEmail(recipientEmail) {
  const mailOptions = {
    from: '"Your Company Name" <your-email@gmail.com>',
    to: recipientEmail,
    subject: 'Your Password Has Been Reset',
    html: `
      <div style="font-family: Arial, sans-serif; text-align: center;">
        <h2 style="color: #4a90e2;">Your Password Has Been Reset</h2>
        <p style="color: #333; font-size: 16px; line-height: 1.5;">
          Your password has been successfully reset. If you did not request this change, please contact support immediately.
        </p>
      </div>
    `
  };

  transporter.sendMail(mailOptions, (error, info) => {
    if (error) {
      console.error('Error sending email:', error);
    } else {
      console.log('Email sent:', info.response);
    }
  });
}

// Export the function to use it in other files
module.exports = sendPasswordResetEmail;
