<!DOCTYPE html>
<head>
    <title>My mailbox</title>
</head>
<html>
<h1>Welcome to your mailbox!!!</h1>
<body>
</form>

<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 2/26/17
 * Time: 5:37 PM
 */
require "mysql.connection.php";

session_start();
$user = $_SESSION['username'];

$query = "SELECT subject,msgtime,sender FROM mailbox WHERE receiver='$user' ORDER BY msgtime DESC";
echo "hello " . $user;
if ($result = $db->query($query)) {
    echo "<table>";
    echo "<th>Time</th><th>Subject</th><th>Sent by</th>";
    while ($row = $result->fetch_assoc()) {
        echo "<tr>";
        echo "<td>" . $row['msgtime'] . "</td>";
        echo "<td>" . $row['subject'] . "</td>";
        echo "<td>" . $row['sender'] . "</td>";
    }
    echo "</table>";
    }

?>

</body>
</html>

