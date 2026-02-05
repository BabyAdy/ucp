<?php

function getAdminRank($level) {
    return match($level) {
        7 => 'Owner',
        6 => 'Developer',
        5 => 'Manager',
        4 => 'Head Staff',
        3 => 'Admin',
        2 => 'Moderator',
        1 => 'Trial Admin',
        default => 'None'
    };
}

function getHelperRank($level) {
    return match($level) {
        3 => 'Head Helper',
        2 => 'Helper',
        1 => 'Trial Helper',
        default => 'None'
    };
}

function getFactionName($id) {
    return match($id) {
        1 => 'Los Santos Police Department',
        2 => 'Sheriff Department',
        3 => 'Paramedic & Fire Department',
        4 => 'Hitman Agency',
        5 => 'Grove Street Families',
        6 => 'Ballas',
        7 => 'Los Santos Vagos',
        8 => 'Varrios Los Aztecas',
        default => 'None'
    };
}
