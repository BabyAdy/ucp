<?php
require 'config.php';
require 'functions.php';

if (!isset($_SESSION['discord_id'])) {
    header("Location: index.php");
    exit;
}

/* FETCH USER */
$q = $conn->prepare("SELECT * FROM users WHERE discord_id=?");
$q->bind_param("s", $_SESSION['discord_id']);
$q->execute();
$user = $q->get_result()->fetch_assoc();

/* ======================
   MANAGE ACTIONS
====================== */

if ($_SERVER['REQUEST_METHOD'] === 'POST' && $user['admin_level'] >= 4) {

    $action = $_POST['action'] ?? '';
    $reason = trim($_POST['reason'] ?? '');

    if ($reason === '') {
        header("Location: profile.php");
        exit;
    }

    $staffName  = $user['username'];
    $staffLevel = $user['admin_level'];
    $targetId   = $user['id'];
    $targetName = $user['username'];

    /* MAKE LEADER (NO STAFF LOG) */
    if ($action === 'make_leader') {
        $faction = (int)$_POST['faction_id'];

        $conn->query("
            UPDATE users 
            SET faction_id=$faction, faction_rank=7 
            WHERE id=$targetId
        ");
    }

    /* UNINVITE LEADER (NO STAFF LOG) */
    if ($action === 'uninvite') {
        $conn->query("
            UPDATE users 
            SET faction_id=0, faction_rank=0 
            WHERE id=$targetId
        ");
    }

    /* MAKE HELPER */
    if ($action === 'make_helper' && $staffLevel >= 5) {
        $lvl = (int)$_POST['helper_level'];

        $conn->query("UPDATE users SET helper_level=$lvl WHERE id=$targetId");

        $conn->query("
            INSERT INTO staff_logs
            (staff_name, staff_admin_level, target_name, type, new_level, reason)
            VALUES
            ('$staffName', $staffLevel, '$targetName', 'helper', $lvl, '$reason')
        ");
    }

    /* MAKE ADMIN */
    if ($action === 'make_admin' && $staffLevel >= 5) {
        $lvl = (int)$_POST['admin_level'];

        if ($staffLevel == 5 && $lvl > 2) {
            header("Location: profile.php");
            exit;
        }

        $conn->query("UPDATE users SET admin_level=$lvl WHERE id=$targetId");

        $conn->query("
            INSERT INTO staff_logs
            (staff_name, staff_admin_level, target_name, type, new_level, reason)
            VALUES
            ('$staffName', $staffLevel, '$targetName', 'admin', $lvl, '$reason')
        ");
    }

    header("Location: profile.php");
    exit;
}
?>
