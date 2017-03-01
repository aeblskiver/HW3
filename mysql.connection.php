<?php
/**
 * Created by PhpStorm.
 * User: justin
 * Date: 2/26/17
 * Time: 5:33 PM
 */

@$db = new mysqli('localhost','justin','shIbby23','Project3');
if (mysqli_connect_errno()) {
    echo '<p>Error: Could not connect to database</p>';
    exit;
}

