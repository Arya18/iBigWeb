<?php
    include 'connectionDB.php';
    include 'sendEmail.php';
    $conn = getConnectionDb();
    // echo "$conn".$conn;
//Fetching Values from URL
    if(isset($_POST['BUSINESSNAME'])){
    	$businessName=$_POST['BUSINESSNAME'];
    }
    if(isset($_POST['MOBILE'])){
        $mobileNumber=$_POST['MOBILE'];
    }
    $webUrl=$_POST['WEBSITE_URL'];
    $userEmail=$_POST['EMAIL'];


    if(isset($userEmail) & !empty($userEmail)){
        $result = $conn->query("SELECT * FROM userenquiry WHERE userEmail='$userEmail'");
        if ($result->num_rows > 0) {
            //trigger_error('It exists.', E_USER_WARNING);
            $output = json_encode(array('type' => 'error', 'text' => 'User with this email id already exists.'));
            echo ($output);
        }else{
        $sql = "INSERT INTO userenquiry (businessName, webUrl, userEmail, mobileNumber)
        VALUES ('$businessName', '$webUrl', '$userEmail', $mobileNumber)";

        if ($conn->query($sql) === TRUE) {
            // $to = "aryanpra16dec@gmail.com"; //Replace with recipient email address
            // //proceed with PHP email.
            // $headers = 'From: ' . $businessName . '' . "\r\n" .
            //         'Reply-To: ' . $userEmail . '' . "\r\n" .
            //         'X-Mailer: PHP/' . phpversion();

            // $sentMail = @mail($to, $subject, $webUrl . '  -' . $username, $headers);
            // //$sentMail = true;
            $sentMail = sendEmails();
            if (!$sentMail) {
                $output = json_encode(array('type' => 'error', 'text' => 'Could not send mail! Please contact administrator.'));
                echo($output);
            } else {
                $output = json_encode(array('type' => 'success', 'text' => 'Thanks for your interest. We will be in touch with you soon.'));
                echo($output);
            }
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
            }
        }
    }

    $conn->close();

?>