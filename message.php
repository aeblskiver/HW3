<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 3/5/17
 * Time: 1:30 PM
 */
session_start();

require "mysql.connection.php";

if (isset($_GET['messageID'])) {

    $user = $_SESSION['username'];
    $messageID = $_GET['messageID'];

    $query = "SELECT subject,msgtime,msgtext,sender,status FROM `mailbox` WHERE messageID=$messageID && receiver='$user'";

    $result = $db->query($query);

    if (empty($result)) {
        echo "No message found for this user";
    }
    else {
        $row = $result->fetch_assoc();
        if ($row['status'] == 0) {
            $query = "UPDATE `mailbox` SET status=1 WHERE messageID=$messageID";
            $result = $db->query($query);
            if (!$result) {
                echo "Failed to change status<br>";
            }
        }
        echo "<strong>Sent by: </strong>" . $row['sender'] . "<br>";
        echo "<strong>Time: </strong>" . $row['msgtime'] . "<br>";
        echo "<strong>Subject: : </strong>"  . $row['subject'] . "<br>";
        echo "<strong>Message :</strong><br>" . $row['msgtext'] . "<br>";

    }
    $db->close();
}
else {
    echo "Message not found";
}

?>

<a href="mailbox.php">Back to Mailbox</a>
