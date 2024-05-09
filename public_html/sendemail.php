<?php

require 'vendor/autoload.php'; // Assuming you have installed the required dependencies through Composer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

function sendFormDataOnEmail() {
    // header("Access-Control-Allow-Origin: *");
    // header("Access-Control-Allow-Methods: GET, HEAD, PUT, PATCH, POST, DELETE");
    // header("Access-Control-Allow-Headers: Content-Type");

    $to_email = 'syedaneesibrahom@gmail.com';
    $subject = ' Form Submission on traveliotours.com';

    if ($_POST['form'] == 'TOUR_BOOKING'){
        $name = $_POST['name'] ?? '';
        $email = $_POST['email'] ?? '';
        $nationality = $_POST['nationality'] ?? '';
        $countryOfResidence = $_POST['countryOfResidence'] ?? '';
        $phone = ($_POST['countryCode'] ?? '') . ' ' . ($_POST['phone'] ?? '');
        $travellers = $_POST['travellers'] ?? '';
        $travelDate = $_POST['travelDate'] ?? '';
        $tourPackage = $_POST['tourPackage'] ?? '';

        $htmlToSend = '
        <!DOCTYPE html>
        <html>
        <head>
            <meta charset="UTF-8">
            <title>Email Template</title>
            <style>
                /* Add your custom styles here */
            </style>
        </head>
        <body>
            <h1>Submission Details</h1>
            <p><strong>Selected Tour Package:</strong> '.$tourPackage.'</p>
            <p><strong>Name:</strong> '.$name.'</p>
            <p><strong>Email:</strong> '.$email.'</p>
            <p><strong>Nationality:</strong> '.$nationality.'</p>
            <p><strong>Country of Residence:</strong> '.$countryOfResidence.'</p>
            <p><strong>Phone:</strong> '.$phone.'</p>
            <p><strong>Travellers:</strong> '.$travellers.'</p>
            <p><strong>Travel Date:</strong> '.$travelDate.'</p>
        </body>
        </html>
      ';
    }

    
    try {
        $html = $htmlToSend;

        $mail = new PHPMailer(true);
        $mail->isSMTP();

        // Configure the SMTP settings
        $mail->Host = 'smtp-relay.sendinblue.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'traveliotourism@gmail.com';
        $mail->Password = 'WSHNhtz0I4jm9TZA';
        $mail->Port = 587;

        $mail->setFrom('no-reply@emails.traveliotourism.ae', 'Travelio Admin');
        $mail->addAddress($to_email);
        $mail->Subject = $subject;
        $mail->isHTML(true);
        $mail->Body = $html;

        $mail->send();

        http_response_code(200);
    } catch (Exception $e) {
        error_log('Error: ' . $e->getMessage());
        http_response_code(500);
        echo json_encode(['error' => 'Something went wrong']);
    }
}

sendFormDataOnEmail();