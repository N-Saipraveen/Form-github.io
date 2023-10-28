<?php
if (
    empty($_POST['name']) ||
    empty($_POST['email']) ||
    empty($_POST['message'])
) {
    $error = array("message" => "All form fields are required.");
    header('Content-Type: application/json');
    http_response_code(400); // Bad Request
    echo json_encode($error);
    exit;
}

$name = $_POST['name'];
$email = $_POST['email'];
$message = $_POST['message'];
$optin = isset($_POST['optin']) ? $_POST['optin'] : '';

// Create Message
$to = 'receiver@yoursite.com';
$email_subject = "Message from a Blocs website.";
$email_body = "You have received a new message. \n\nName: $name \nEmail: $email \nMessage: $message \nOptin: $optin \n";
$headers = "MIME-Version: 1.0\r\nContent-type: text/plain; charset=UTF-8\r\n";
$headers .= "From: contact@yoursite.com\r\n";
$headers .= "Reply-To: $email";

// Post Message
if (function_exists('mail')) {
    $result = mail($to, $email_subject, $email_body, $headers);
    if ($result) {
        echo "Mail sent successfully";
    } else {
        $error = array("message" => "Error sending mail.");
        header('Content-Type: application/json');
        http_response_code(500);
        echo json_encode($error);
    }
} else {
    $error = array("message" => "The php mail() function is not available on this server.");
    header('Content-Type: application/json');
    http_response_code(500);
    echo json_encode($error);
}
?>
