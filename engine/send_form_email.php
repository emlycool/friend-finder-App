<?php
if(isset($_GET['email'])) {
  $email = $_GET['email'];
  $name = $_GET['name'];
  $email_from = "joshua.moshood@gmail.com";

    // EDIT THE 2 LINES BELOW AS REQUIRED
    $email_to = $email;
    $email_subject = "Friend Finder Account Verification";
 
    function died($error) {
        // your error code can go here
        echo "We are very sorry, but there were error(s) found with the form you submitted. ";
        echo "These errors appear below.<br /><br />";
        echo $error."<br /><br />";
        echo "Please go back and fix these errors.<br /><br />";
        die();
    }
 
 
    // validation expected data exists


 
    $error_message = "";
    
 
    $message ="Thank you,"." ".$name."<br>"."Click the link below to verify your account.";
     echo $email_message;
    function clean_string($string) {
      $bad = array("content-type","bcc:","to:","cc:","href");
      return str_replace($bad,"",$string);
    }
 
     
 
    $email_message .= "First Name: ".clean_string($message)."\n";
   
 
// create email headers
$headers = 'From: '.$email_from."\r\n".
'Reply-To: '.$email_from."\r\n" .
'X-Mailer: PHP/' . phpversion();
@mail($email_to, $email_subject, $email_message, $headers);  
?>
 
<!-- include your own success html here -->
 
Thank you for contacting us. We will be in touch with you very soon.
 
<?php
header("location:../index.php?message=verify your account on your mail."); 
}

?>