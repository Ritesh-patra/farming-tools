<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'mailer/Exception.php';
require 'mailer/PHPMailer.php';
require 'mailer/SMTP.php';


// Get form data
$name = $_POST['customer-name'];
$phone = $_POST['customer-phone'];
$email = $_POST['customer-email'];
$quantity = $_POST['quantity'];
$requirements = $_POST['requirements'];

// Email body
$body = "
    <div style='font-family: Arial, sans-serif; color: #333; padding: 10px;'>
        <h2 style='color: #4CAF50;'>🌾 New Quote Request Received</h2>
        <p><strong>Name:</strong> {$name}</p>
        <p><strong>Phone Number:</strong> {$phone}</p>
        <p><strong>Email Address:</strong> " . (!empty($email) ? $email : 'Not Provided') . "</p>
        <p><strong>Requested Quantity:</strong> {$quantity}</p>
        <p><strong>Additional Requirements:</strong></p>
        <p style='background: #f4f4f4; padding: 10px; border-left: 4px solid #4CAF50;'>{$requirements}</p>
        <hr style='margin-top: 20px;' />
        <p style='font-size: 13px; color: #888;'>Gopal Agro Agency – Automated Quote System</p>
    </div>
";


$mail = new PHPMailer(true);

try {
    // Server settings
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'gopalagroagency@gmail.com'; // Your Gmail
    $mail->Password = 'zmkn wswy nzpp ydot';         // App Password
    $mail->SMTPSecure = 'tls';
    $mail->Port = 587;

    // Recipients
    $mail->setFrom('gopalagroagency@gmail.com', 'Quote Request Form');
    $mail->addAddress('gopalagroagency@gmail.com'); // Receiver (can be same or another email)

    // Content
    $mail->isHTML(true);
    $mail->Subject = 'New Quote Request';
    $mail->Body = $body;

    $mail->send();
    header('Location: thankyou.html');
    exit();
} catch (Exception $e) {
    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
}
?>