<?php
session_start();
?>

<!DOCTYPE html>
<head>
    <title>My mailbox</title>
    <style type="text/css">
        .unread {
            font-weight:bold;
        }
    </style>
</head>
<html>
<h1>Welcome to your mailbox!!!</h1>
<body>


<!-- **** Table Start **** -->
<table>
    <th>Time</th><th>Subject</th><th>Sent by</th>
<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 2/26/17
 * Time: 5:37 PM
 */
require "mysql.connection.php";

$user = $_SESSION['username'];

$query = "SELECT subject,msgtime,sender,status,messageID FROM mailbox WHERE receiver='$user' ORDER BY msgtime DESC";
echo "Hello " . $_SESSION['username'] . "!";
echo "<a href='logout.php'>Sign out?</a>";
if ($result = $db->query($query)) {
    while ($row = $result->fetch_assoc()) {
        if ($row['status'] != 2) {
            echo "<tr><td>";
            echo $row['msgtime'] . "</td>";
            echo "<td ";
            if ($row['status'] == 0) echo "class='unread'";
            echo ">" . "<a href=message.php?messageID=" . $row['messageID'] . ">" . $row['subject'] . "</a></td>";
            echo "<td>" . $row['sender'] . "</td>";
        }
    }
}

$db->close();
?>
</table>
<!-- **** Table End **** -->
</body>
</html>

