<?php
session_start();

$host = "localhost";
$user = "root";
$pass = "";
$db   = "ucp";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("DB Error");
}

/* Discord OAuth */
define('DISCORD_CLIENT_ID', '1468827442440568844');
define('DISCORD_CLIENT_SECRET', 'g4Ytv0uhRqQoumMrCYIgyCNM14ZtKoaL');
define('DISCORD_REDIRECT_URI', 'http://localhost/ucp/callback.php');
?>
