<!DOCTYPE html>
<html>
<head>
    <title>Registering...</title>
</head>
<body>

<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 2/26/17
 * Time: 6:45 PM
 */
//Check if all required fields are set
if (empty($_POST["name"]) || empty($_POST["username"]) || empty($_POST["password"])) {
    echo "<p>You have not entered all the required information</p><br/>";
    echo "<a href='registration_view.html'>Return to registration page</a>";
}

//Handle registration
else {
    require "mysql.connection.php";

    $salt = "justinrules";
    $name = $_POST['name'];
    $username = $_POST['username'];
    $pword = $salt . $_POST['password'];

    $query = "INSERT INTO `users` SET name=?, username=?, password=md5(?)";
    $stmt = $db->init();
    $stmt = $db->prepare($query);
    $stmt->bind_param('sss',$name,$username,$pword);
    $stmt->execute();

    if ($stmt->affected_rows > 0) {
        echo "<p>Succesfully registered</p>";
        echo "<p>Please login to continue</p>";
        echo <<< form
        <form action="login.php" method="post">
        User name: <br>
        <input type="text" name="username" placeholder="Your username" maxlength="15"> <br>
        Password: <br>
        <input type="password" name="password" placeholder="Your password" maxlength="15"> <br>
        <input type="submit" name="submit">
    </form>

form;

    }
    else {
        echo "<p>An error has occurred. Please try again</p>";
        echo "<a href='registration_view.html'>Take me back</a>>";
    }
    $stmt->close();
    $db->close();
}


?>


</body>
</html>