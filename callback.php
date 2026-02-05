<?php
require 'config.php';

if (!isset($_GET['code'])) exit;

$data = [
    'client_id' => DISCORD_CLIENT_ID,
    'client_secret' => DISCORD_CLIENT_SECRET,
    'grant_type' => 'authorization_code',
    'code' => $_GET['code'],
    'redirect_uri' => DISCORD_REDIRECT_URI
];

$options = [
    'http' => [
        'header'  => "Content-Type: application/x-www-form-urlencoded",
        'method'  => 'POST',
        'content' => http_build_query($data),
    ]
];

$context = stream_context_create($options);
$response = json_decode(file_get_contents('https://discord.com/api/oauth2/token', false, $context), true);

$token = $response['access_token'];

$user = json_decode(file_get_contents(
    'https://discord.com/api/users/@me',
    false,
    stream_context_create([
        'http' => ['header' => "Authorization: Bearer $token"]
    ])
), true);

$discord_id = $user['id'];
$username   = $user['username'];
$avatar     = $user['avatar'];

$q = $conn->prepare("SELECT id FROM users WHERE discord_id=?");
$q->bind_param("s", $discord_id);
$q->execute();
$res = $q->get_result();

if ($res->num_rows == 0) {
    $ins = $conn->prepare("INSERT INTO users (discord_id, username, avatar) VALUES (?,?,?)");
    $ins->bind_param("sss", $discord_id, $username, $avatar);
    $ins->execute();
}

$_SESSION['discord_id'] = $discord_id;
header("Location: index.php");
