<!DOCTYPE html>
<head>
    <title>Send a message</title>
</head>

<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 2/27/17
 * Time: 6:00 PM
 */
if (!isset($_POST['submit'])) {
    generateForm();
}

//else (isset($_POST['submit'])  && (!empty($_POST['receiver']) || !empty($_POST['subject']) || !empty($_POST['msgtext']))) {
else {
    session_start();
    require "mysql.connection.php";
    $subject = $_POST['subject'];
    $msgtext = $_POST['msgtext'];
    $sender = $_SESSION['username'];
    $receiver = $_POST['receiver'];
    $status = 0; // 0 = new message

    echo $subject . " " . $msgtext . " " . $sender . " " . $receiver;


    $query = "INSERT INTO `mailbox` (subject,msgtext,sender,receiver,status)  VALUES (?,?,?,?,?)";
    $stmt = $db->init();
    $stmt = $db->prepare($query);
    $inserted = $stmt->bind_param('ssssi',$subject,$msgtext,$sender,$receiver,$status);
    $stmt->execute();
    //The following code wasn't needed because it didn't do anything
    //There were no results to bind to, dummy
//    $stmt->bind_result($result);
//    mysqli_next_result($db);

    if (!$inserted) {
        echo "Error sending mail";
        echo $stmt->error;
    }
    else {
        echo "Mail sent<br>";
        echo "<a href='mailbox.php'>My mailbox</a>";
    }

}

function generateForm() {
    echo <<<form
<h1>Create a new message</h1>

<form action='
form;

echo $_SERVER['PHP_SELF'] . "' method='post'>";

echo <<<form

<h3>Send to:</h3>
<input type="text" name="receiver" maxlength="25" placeholder="Recipient"><br>
<h3>Subject:</h3>
<input type="text" name="subject" maxlength="50" placeholder="Subject"><br>
<h3>Message body:</h3>
<textarea name="msgtext" id="msgtext" cols="30" rows="10"></textarea>

<input type="submit" name="submit">
</form>
form;

}