<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 3/5/17
 * Time: 2:45 PM
 */
session_start();
session_unset();
echo "You have logged out. Hope to see you again!<br>";
echo "<a href='registration_view.html'>Home</a>";