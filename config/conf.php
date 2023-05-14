<?php
define('DB_SERVER', 'db5012965296.hosting-data.io');
define('DB_PORT', '3306');
define('DB_USERNAME', 'dbu5482078');
define('DB_PASSWORD', 'aquafresh2023');
define('DB_NAME', 'dbs10887854');


define('API_KEY_INDEX', 'AIzaSyA4zHL_BVdWGuaMWXwxk4iCNKlGNF-BJoU');
define('API_KEY_ADD_NEW', 'AIzaSyAtwLJf7L22miHaKQlI9StgOIpa2XdYaPk');

define('API_URL_FRONT', 'https://maps.googleapis.com/maps/api/js?key=');
define('INDEX_API_URL_BACK', '&region=UK&libraries=places&callback=Function.prototype');
define('ADD_NEW_URL_BACK', "&callback=initMap");

define('ERROR_MESSAGES', array(
    'emptyfields' => 'Please fill in all fields!',
    'invaliduid' => 'Invalid username!',
    'wrongpwd' => 'Invalid password!',
    'sqlerror' => 'SQL error!',
    'invalidemail' => 'Invalid email!',
    'passwordsdontmatch' => "Passwords don't match!",
    'useralreadyexists' => 'User already exists!',
    'usernotfound' => 'User not found!',
    'stmtfailed' => 'Statement failed!'
));