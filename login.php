<?php
session_start();
?>

<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 2/26/17
 * Time: 7:56 PM
 */
if (empty($_POST['username']) || empty($_POST['password'])) {
    echo "<p>Username and password required</p>";
    ?>
    <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
    User name: <br>
    <input type="text" name="username" placeholder="Your username" maxlength="15"> <br>
    Password: <br>
    <input type="password" name="password" placeholder="Your password" maxlength="15"> <br>
    <input type="submit" name="submit">
    </form>

<?php
}
else {
        if (isset($_POST['username'])) {
            $username = $_POST['username'];
            $pwd = $_POST['password'];
            $pwd = md5("justinrules".$pwd);

            require "mysql.connection.php";

            $query = "SELECT username FROM `users` WHERE username=? && password=?";
            $stmt = $db->init();
            $stmt = $db->prepare($query);
            $stmt->bind_param('ss',$username, $pwd);
            $stmt->execute();
            $stmt->bind_result($result);
            $stmt->fetch();

            echo $result;
            if (empty($result)) {
                echo "<p>Error, please try again</p>>";
            }
            else {
                $_SESSION['username'] = $username;
            }
            $stmt->close();
            $db->close();
        }
    echo "Welcome " . $_SESSION['username'] . "<br>";
    echo <<<link
<a href="compose.php">Send a message!</a><br>
<a href="mailbox.php">Go to mailbox!</a><br>
link;


}