<?php
if ($_GET['randomId'] != "tGAdpydtWNtYWAhohJhv5ApLIhv8SrgCm8bDtcuWfz0Zfwry5QSafxoYP3AkV1BX") {
    echo "Access Denied";
    exit();
}

// display the HTML code:
echo stripslashes($_POST['wproPreviewHTML']);

?>  
