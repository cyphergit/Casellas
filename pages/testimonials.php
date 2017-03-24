<?php
$your_email = 'jose.cristito.santos@gmail.com';

session_start();
include('conf.inc.php');

$errors = '';
$name = '';
$visitor_email = '';
$user_message = '';

if (isset($_POST['submit'])) {
    $name = $_POST['name'];
    $visitor_email = $_POST['email'];
    $user_message = trim(addslashes($_POST['message']));

    if (empty($name) || empty($visitor_email)) {
        $errors .= "\n Name and E-mail Address are required fields. ";
    }

    if (IsInjected($visitor_email)) {
        $errors .= "\n Bad email value!";
    }

    if (empty($_SESSION['6_letters_code']) || strcasecmp($_SESSION['6_letters_code'], $_POST['6_letters_code']) != 0) {
        $errors .= "\n The captcha code does not match!";
    }

    if (empty($errors)) {
        $to = $your_email;
        $subject = "New form submission";
        $from = $your_email;
        $ip = isset($_SERVER['REMOTE_ADDR']) ? $_SERVER['REMOTE_ADDR'] : '';

        //$body = "A user $name submitted a testimonial:\n".
        //"Name: $name\n".
        //"Email: $visitor_email \n".
        //"Message/Testimonial: \n ".
        //"$user_message\n".
        //"IP: $ip\n";	
        //$headers = "From: $from \r\n";
        //$headers .= "Reply-To: $visitor_email \r\n";
        //mail($to, $subject, $body,$headers);

        $sql = "INSERT INTO Testimonials (CustomerEmail, CustomerName, TestimonialMsg, DateCreated) VALUES ('$visitor_email','$name','$user_message',now())";
        mysql_query($sql);

        //header('Location: index.php?pg=testimonials');
    }
}

// Function to validate against any email injection attempts
function IsInjected($str) {
    $injections = array('(\n+)',
        '(\r+)',
        '(\t+)',
        '(%0A+)',
        '(%0D+)',
        '(%08+)',
        '(%09+)'
    );
    $inject = join('|', $injections);
    $inject = "/$inject/i";
    if (preg_match($inject, $str)) {
        return true;
    } else {
        return false;
    }
}
?>

<script language="Javascript" src="scripts/gen_validatorv31.js"></script>
<script language="Javascript" type="text/javascript">
    function refreshCaptcha() {
        var img = document.images['captchaimg'];
        img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
    }
</script>

<h1>Testimonials</h1>
<p>
<?php include('includes/cypher_testimonials.php'); ?>
</p>

<div id="form-sec">
    <h1>Post A Testimonial</h1>  
<?php
if (!empty($errors)) {
    echo "<p class='err'>" . nl2br($errors) . "</p>";
}
?>
    <div id='testimonial_form_errorloc' class='err'></div>
    <form method="POST" id="testimonial_form" name="testimonial_form" action="index.php?pg=testimonials">
<?php
echo "<table>";
echo "<tr>";
echo "<td><label for='name'>Name: </label></td>";
echo "<td><input type='text' name='name'/></td>";
echo "</tr>";
echo "<tr>";
echo "<td><label for='email'>E-mail Address: </label></td>";
echo "<td><input type='text' name='email'/></td>";
echo "</tr>";
echo "<tr>";
echo "<td><label for='message'>Message/Testimonial: </label></td>";
echo "<td><textarea name='message' rows='8' cols='30'></textarea></td>";
echo "</tr>";
echo "<tr>";
echo "<td><label for='message'>Verification Code:</label></td>";
echo "<td>";
echo "<input id='6_letters_code' name='6_letters_code' type='text'/>";
echo "<img src='pages/captcha_code_file.php?rand=rand()' id='captchaimg'/>";
echo "</td>";
echo "</tr>";
echo "<tr>";
echo "<td></td>";
echo "<td><small>Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh</small></td>";
echo "</tr>";
echo "<tr>";
echo "<td></td>";
echo "<td><input type='submit' value='Submit' id='submit' name='submit'/></td>";
echo "</tr>";
echo "</table>";
?>
    </form>
    <script language="Javascript">
        var frmvalidator  = new Validator("testimonial_form");

        frmvalidator.EnableOnPageErrorDisplaySingleBox();
        frmvalidator.EnableMsgsTogether();

        frmvalidator.addValidation("name","req","Please provide your Name!");
        frmvalidator.addValidation("email","req","Please provide your E-mail Address!");
        frmvalidator.addValidation("email","email","Please enter a valid E-mail Address!");
    </script>
</div>