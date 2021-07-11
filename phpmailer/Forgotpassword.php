<!DOCTYPE html>
<html>
    <head>
    <title>RT PCR Test Booking Tool/forgot password/</title>
    <style>
        input[type=text], select {
          width: 100%;
          padding: 12px 20px;
          margin: 8px 0;
          display: inline-block;
          border: 1px solid #ccc;
          border-radius: 4px;
          box-sizing: border-box;
        }
        input[type=submit] {
            width: 100%;
            background-color: #4CAF50;
            color: white;
            padding: 14px 20px;
            margin: 8px 0;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
		.backbutton {
			  background-color: #ef5350;
			  border-radius: 15px;
			  color: white;
			  padding: 10px 25px;
			  text-align: center;
			  text-decoration: none;
			  display: inline-block;
			  font-size: 16px;
			  margin: 4px 2px;
			  cursor: pointer;
			}
    </style>
    </head>
    <body>

		<form name="myForm" onsubmit="return validateForm()" action="" method = "POST">
        <h2 style="color:SlateBlue" align = "center"> Check your email for your Password</h2>
        
    </form>
</div>
</body>
<a href="loginpage.html" class="backbutton">Back</a>
</html>


<?php
//Include required PHPMailer files
        	require 'includes/PHPMailer.php';
        	require 'includes/SMTP.php';
        	require 'includes/Exception.php';
//Define name spaces
        	use PHPMailer\PHPMailer\PHPMailer;
        	use PHPMailer\PHPMailer\SMTP;
        	use PHPMailer\PHPMailer\Exception;

function mail_send($recip, $messages){
        //Create instance of PHPMailer
        	$mail = new PHPMailer();
        //Set mailer to use smtp
        	$mail->isSMTP();
        //Define smtp host
        	$mail->Host = "smtp.gmail.com";
        //Enable smtp authentication
        	$mail->SMTPAuth = true;
        //Set smtp encryption type (ssl/tls)
        	$mail->SMTPSecure = "tls";
        //Port to connect smtp
        	$mail->Port = "587";
        //Set gmail username
        	$mail->Username = "csecourse02@gmail.com";
        //Set gmail password
        	$mail->Password = "MyPassword@1234";
        //Email subject
        	$mail->Subject = "Admin Password";
        //Set sender email
        	$mail->setFrom('csecourse02@gmail.com');
        //Enable HTML
        	$mail->isHTML(true);
        //Attachment
        	//$mail->addAttachment('img/attachment.png');
        //Email body
        	$mail->Body = $messages;
        //Add recipient
        	$mail->addAddress($recip);
        //Finally send email
        	if ( $mail->send() ) {
        		echo "<br>";
        	}
        	else{
        	    echo "error..";
        	}
        	
        //Closing smtp connection
        	$mail->smtpClose();
}

$messages = 'Your password is <h4>rtAdmin@1234<h4>';

mail_send('myselfkito@gmail.com', $messages);
?>