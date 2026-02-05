<?php
if (!$user || ($user['admin_level'] < 2 && $user['helper_level'] < 2)) return;

$res = $conn->query("SELECT * FROM staff_logs ORDER BY id DESC LIMIT 20");

while ($log = $res->fetch_assoc()) {

    $staffRank = getAdminRank($log['staff_admin_level']);

    if ($log['type'] == 'admin') {
        echo "($staffRank) {$log['staff_name']} set {$log['target_name']} ".
             getAdminRank($log['new_level']).
             " [Reason: {$log['reason']}]<br>";
    }

    if ($log['type'] == 'helper') {
        echo "($staffRank) {$log['staff_name']} set {$log['target_name']} ".
             getHelperRank($log['new_level']).
             " [Reason: {$log['reason']}]<br>";
    }

    if ($log['type'] == 'leader') {
        echo "($staffRank) {$log['staff_name']} set {$log['target_name']} ".
             "\"Leader of ".getFactionName($log['faction_id'])."\" ".
             "(Reason: {$log['reason']})<br>";
    }
}
