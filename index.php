<?php
require 'config.php';
require 'functions.php';

$user = null;
if (isset($_SESSION['discord_id'])) {
    $q = $conn->prepare("SELECT * FROM users WHERE discord_id=?");
    $q->bind_param("s", $_SESSION['discord_id']);
    $q->execute();
    $user = $q->get_result()->fetch_assoc();
}
?>

<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="assets/style.css">
</head>
<body>

<div class="navbar">
    <div class="nav-left">
        <div class="logo">LIBERTY.MP</div>

        <div class="nav-menu">
            <a href="#">Home</a>
            <a href="#">Staff</a>
            <a href="#">Forums</a>
            <a href="#">Factions</a>
            <a href="#">Clans</a>
            <a href="#">Shop</a>
            <a href="#">Posts</a>
            <a href="#">More</a>
            <a href="#">Updates</a>
            <a href="#">Staff Applications</a>
        </div>
    </div>

    <div class="nav-right">
        <div class="search-box">
            <input type="text" placeholder="Search...">
        </div>

        <?php if ($user): ?>
            <div class="user-box">
                <img src="https://cdn.discordapp.com/avatars/<?= $user['discord_id'] ?>/<?= $user['avatar'] ?>.png">
                <span class="user-name"><?= $user['username'] ?></span>

                <div class="dropdown">
                    <a href="#">Go to profile</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        <?php else: ?>
            <a href="login.php" class="login-btn">Login</a>
        <?php endif; ?>
    </div>
</div>


<hr>

<h2>Informatii Generale</h2>

<h2>Updates</h2>

<h2>Discord</h2>
<iframe src="https://discord.com/widget?id=1328138189239746672&theme=dark"
width="350" height="500"></iframe>

<h2>Staff Logs</h2>
<?php include 'pages/staff_logs.php'; ?>

</body>
</html>
