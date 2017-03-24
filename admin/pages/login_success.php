<?php
session_start();
if (!session_is_registered(myusername)) { header("location:admin_login.php"); }
?>


<html>
    <body>
        <?php
        $logged = session_register("username");
        echo $logged;
        echo "test";
        echo $_SESSION['logged'];
        ?>
        Login Successful
    </body>
</html>