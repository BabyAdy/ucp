<?php
require 'config.php';

$discord_url = "https://discord.com/api/oauth2/authorize?client_id="
    .DISCORD_CLIENT_ID.
    "&redirect_uri=".urlencode(DISCORD_REDIRECT_URI).
    "&response_type=code&scope=identify";

header("Location: $discord_url");
exit;
