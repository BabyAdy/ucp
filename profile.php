<?php
require 'config.php';
require 'functions.php';

if (!isset($_SESSION['discord_id'])) {
    header("Location: index.php");
    exit;
}

$q = $conn->prepare("SELECT * FROM users WHERE discord_id=?");
$q->bind_param("s", $_SESSION['discord_id']);
$q->execute();
$user = $q->get_result()->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="ro">
<head>
    <meta charset="UTF-8">
    <title>Profile - <?= $user['username'] ?></title>
    <link rel="stylesheet" href="assets/style.css">
</head>
<body>

<?php include 'navbar.php'; ?>

<div class="profile-container">

    <div class="profile-card">
        <img class="profile-avatar"
             src="https://cdn.discordapp.com/avatars/<?= $user['discord_id'] ?>/<?= $user['avatar'] ?>.png">

        <h2 class="profile-name"><?= $user['username'] ?></h2>

<div class="badges">

<?php
/* ADMIN */
if ($user['admin_level'] > 0) {
    $adminBadges = [
        7 => ['👑', 'Owner', 'owner'],
        6 => ['🛠', 'Developer', 'developer'],
        5 => ['🧠', 'Manager', 'manager'],
        4 => ['🛡', 'Head Staff', 'headstaff'],
        3 => ['🛡', 'Admin', 'admin'],
        2 => ['🛡', 'Moderator', 'moderator'],
        1 => ['🧪', 'Trial Admin', 'trialadmin']
    ];

    [$emoji, $text, $class] = $adminBadges[$user['admin_level']];
    echo "<span class='badge $class'>$emoji $text</span>";
}

/* HELPER */
if ($user['helper_level'] > 0) {
    $helperBadges = [
        3 => ['🧑‍🏫', 'Head Helper', 'helper'],
        2 => ['🧑‍🏫', 'Helper', 'helper'],
        1 => ['🧪', 'Trial Helper', 'helper']
    ];

    [$emoji, $text, $class] = $helperBadges[$user['helper_level']];
    echo "<span class='badge $class'>$emoji $text</span>";
}

/* FACTION LEADER */
if ($user['faction_rank'] == 7) {
    echo "<span class='badge leader'>👑 Leader of ".getFactionName($user['faction_id'])."</span>";
}
?>

</div>

    </div>

</div>

</body>
</html>
