<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

$user = null;

if (isset($_SESSION['discord_id'])) {
    $stmt = $conn->prepare("SELECT username, discord_id, avatar FROM users WHERE discord_id=?");
    $stmt->bind_param("s", $_SESSION['discord_id']);
    $stmt->execute();
    $user = $stmt->get_result()->fetch_assoc();
}
?>

<div class="navbar">
    <div class="nav-left">
        <div class="logo">LIBERTY.MP</div>

        <div class="nav-menu">
            <a href="index.php">Home</a>
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
                <img src="https://cdn.discordapp.com/avatars/<?= $user['discord_id'] ?>/<?= $user['avatar'] ?>.png?size=64">
                <span class="user-name"><?= htmlspecialchars($user['username']) ?></span>

                <div class="dropdown">
                    <a href="profile.php">Go to profile</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        <?php else: ?>
            <a href="login.php" class="login-btn">Login</a>
        <?php endif; ?>
    </div>
</div>
