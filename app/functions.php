<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use PHPMailer\PHPMailer\SMTP;

require '3rdparty/phpmyailer/src/Exception.php';
require '3rdparty/phpmyailer/src/PHPMailer.php';
require '3rdparty/phpmyailer/src/SMTP.php';

function generateRandomString($length = 10) {
    $characters = '0123456789abcdefghijklmnopqrstuvwxyz';
    $charactersLength = strlen($characters);
    $randomString = '';
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[random_int(0, $charactersLength - 1)];
    }
    return $randomString;
}

function send_apicall2awx($jobID, $jsoncontent){
    include("config/config.php");
    
    $authToken = $config["awx_auth_token"];
    
    // The data to send to the API
    $postData = array(
        'extra_vars' => $jsoncontent
    );
    
    // Setup cURL
    $ch = curl_init( $config["awx_host"] . '/api/v2/workflow_job_templates/'. $jobID . '/launch/');
    curl_setopt_array($ch, array(
        CURLOPT_POST => TRUE,
        CURLOPT_RETURNTRANSFER => TRUE,
        CURLOPT_HTTPHEADER => array(
            'Authorization: Bearer '.$authToken,
            'Content-Type: application/json'
        ),
        CURLOPT_POSTFIELDS => json_encode($postData)
    ));
    # echo $ch;
    // Send the request
    $response = curl_exec($ch);
    // echo $response;
    
    // Check for errors
    if($response === FALSE){
        echo "error";
        die(curl_error($ch));
    }
    
    // Decode the response
    $responseData = json_decode($response, TRUE);
    
    // Close the cURL handler
    curl_close($ch);
    
    // Print the date from the response
    // echo $responseData['published'];
    return $responseData;
}


function sendemailto($toaddress,$mysubject, $mybody){
    include("config/config.php");
    
    $mail = new PHPMailer(true);

    try {
        //Server settings
//        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = $config["smtp_host"];                    //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = $config["smtp_username"];                    //SMTP username
        $mail->Password   = $config["smtp_password"];                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;            //Enable implicit TLS encryption
        $mail->Port       = $config["smtp_port"];                                     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom($config["smtp_from"], $config["smtp_from_name"]);
        $mail->addAddress($toaddress);     //Add a recipient
    //     $mail->addCC('cc@example.com');
    
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = $mysubject;
        $mail->Body = $mybody;
        // $mail->Body = 'This is the body in plain text for non-HTML mail clients';
    
        $mail->send();
        // echo 'Message has been sent';
    } catch (Exception $e) {
        echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
    }
}

?>
