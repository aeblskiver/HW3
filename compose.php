<!DOCTYPE html>
<head>
    <title>Send a message</title>
</head>
<h1>Create a new message</h1>
<form action="<?php echo $_SERVER['PHP_SELF'] ?>">
<h3>Send to:</h3>
<input type="text" name="receiver" maxlength="25" placeholder="Recipient"><br>
<h3>Subject:</h3>
<input type="text" name="subject" maxlength="50" placeholder="Subject"><br>
<h3>Message body:</h3>
<textarea name="msgtext" id="msgtext" cols="30" rows="10"></textarea>

<input type="submit" name="submit">
</form>
<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 2/27/17
 * Time: 6:00 PM
 */
if (!empty($_POST['receiver']) || !empty($_POST['subject']) || !empty($_POST['msgtext'])) {
    require "mysql.connection.php";

    $subject = $_POST['subject'];
    $msgtime = date();
    echo $msgtime;

    $query = "INSERT INTO `mailbox` SET subject=?, msgtime=?, msgtext=?, sender=?, 
      receiver=?, status=?";
    $stmt = $db->init();
    $stmt = $db->prepare($query);
    //$stmt->bind_param('sisssi',)

}