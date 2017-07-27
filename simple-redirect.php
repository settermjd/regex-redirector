<?php

$redirectList = [
    'admin_manual/configuration_files/' => 'admin_manual/configuration/files/'
];

$uri = 'https://doc.owncloud.org/server/10.0/admin_manual/configuration_files/files_locking_transactional.html';

var_dump(parse_url($uri));
