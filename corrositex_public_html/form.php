<?php

# honeypot 
$honeypot = FALSE;
if (!empty($_REQUEST['are_you_human_wink']) && (bool) $_REQUEST['are_you_human_wink'] == TRUE) {
    $honeypot = TRUE;
    error_log (print_r($_REQUEST, true));
    # treat as spambot
    echo ("Hi spambot!");
	exit;
} else {
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (empty($_POST["name"])) {
        #$nameErr = "Name is required";
        header("Location: error.html");
        die();
    } else {
        $name = test_input($_POST["name"]);
       // check if name only contains letters and whitespace
    if (!preg_match("/^[a-zA-Z-' ]*$/",$name)) {
        #$nameErr = "Only letters and white space allowed";
        header("Location: error.html");
        die();
       }
    }

    if (empty($_POST["email"])) {
        $emailErr = "Email is required";
        header("Location: error.html");
        die();
    } else {
        $email = test_input($_POST["email"]);
        // check if e-mail address is well-formed
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        #$emailErr = "Invalid email format";
        header("Location: error.html");
        die();
        }
    }

    $phone = test_input($_POST["phone"]);
    $comment = test_input($_POST["comment"]);

    $mailfrom = "mbonline@mbresearch.com";
    $mailTo = "clientservices@mbresearch.com";
    $subject = "New corrositex.com Contact Form Submission ";
    $txt = "You have received a contact request from: \n\n". "Name: $name \n\n". "Email: $email \n\n". "Phone: $phone \n\n". "Name: $comment \n";
	$headers = 'From: ' . $email . "\r\n";
	$headers .='Reply-To: '. $email. "\r\n";
	$headers .='X-Mailer: PHP/' . phpversion();

    mail ($mailTo, $subject, $txt, $headers);

    /*success message
    $successMsg = "Thank you for submitting your contact form!<br>Someone from Client Services will reach out to you shortly. \n".
    "Name: $name \n".
    "Email: $email \n".
    "Phone: $phone \n>".
    "Comment: $comment \n"; */

    header("Location: success.html");

    #echo $successMsg;
}
else {
    header("Location: error.html");
    die();
}

#sanitizing text inputs
function test_input($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}
    
?>