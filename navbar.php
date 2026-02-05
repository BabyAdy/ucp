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
                    <a href="profile.php">Go to profile</a>
                    <a href="logout.php">Logout</a>
                </div>
            </div>
        <?php else: ?>
            <a href="login.php" class="login-btn">Login</a>
        <?php endif; ?>
    </div>
</div>
