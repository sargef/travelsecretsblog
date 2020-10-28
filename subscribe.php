<?php

require 'includes/init.php';

$email = '';
$subject = 'Subscription to Newsletter';

$sent = false;

if ($_SERVER['REQUEST_METHOD'] == "POST") {

    $email = $_POST['email'];
    $subject = $_POST['subject'];


    $errors = [];

    if (filter_var($email, FILTER_VALIDATE_EMAIL) === false) {
        $errors[] = "Please enter a valid email address";
    }

    if ($subject == '') {
        $errors[] = 'Please enter a subject';
    }

    // if ($message == '') {
    //     $errors[] = 'Please enter a message';
    // }

    if (empty($errors)) {

        
        try {
        
        $email = EMAIL;
        $subject = $subject;
        $from=$_POST["email"];

        $headers = "From: $from";
        
        
        $sent = true;
        
        
        
        } catch (Exception $e) {
            echo 'Message not sent: ' . $mail->ErrorInfo;
                }
            }
            
        }

?>

<?php require 'includes/header.php'; ?>

<h2>Contact</h2>

<?php if ($sent) : ?>
<?php mail($email,$subject,$headers);?>


<?php header("Refresh:2; url=contact.php"); 
echo "Message Sent";
?>
    
<?php else: ?>


<?php if (! empty($errors)): ?>
    <ul>
        <?php foreach ($errors as $error) : ?>
            <li><?= $error ?></li>
        <?php endforeach; ?>
    </ul>
<?php  endif; ?>
    
<form method="post" id="formContact">

<div class="form-group" id="emailForm" name="emailForm">
    <label for="email">Your email</label>
    <input class="form-control" name="email" id="email" type="email" placeholder="Your email"
    value="<?= htmlspecialchars($email) ?>">
</div>

    <button class="btn btn-primary normal-btn" name="subject" id="subject" 
    value="<?= htmlspecialchars($subject) ?>">Subscribe</button>


</form>

 <?php endif; ?>
 
<?php require 'includes/footer.php'; ?>


