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

<?php if (!$user): ?>
    <a href="login.php">Login cu Discord</a>
<?php else: ?>
    Salut, <?= $user['username'] ?> |
    <?= getAdminRank($user['admin_level']) ?>
    <a href="logout.php">Logout</a>
<?php endif; ?>

<hr>

<h2>Informatii Generale</h2>

<h2>Updates</h2>

<h2>Discord</h2>
<iframe src="https://discord.com/widget?id=SERVER_ID&theme=dark"
width="350" height="500"></iframe>

<h2>Staff Logs</h2>
<?php include 'pages/staff_logs.php'; ?>

</body>
</html>
    