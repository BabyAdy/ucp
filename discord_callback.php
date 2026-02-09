<?php
require 'config.php';

/* DUPĂ ce ai primit datele de la Discord */
$discordId = $discordUser['id'];
$username  = $discordUser['username'];
$avatar    = $discordUser['avatar'];

/* INSERT sau UPDATE AUTOMAT */
$stmt = $conn->prepare("
    INSERT INTO users (discord_id, username, avatar)
    VALUES (?, ?, ?)
    ON DUPLICATE KEY UPDATE
        username = VALUES(username),
        avatar   = VALUES(avatar)
");
$stmt->bind_param("sss", $discordId, $username, $avatar);
$stmt->execute();

/* SESSION */
$_SESSION['discord_id'] = $discordId;

header("Location: profile.php");
exit;
