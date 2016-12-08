<?php
// start engine
session_start();
// Set the default timezone.
date_default_timezone_set('Europe/Stockholm');
// Set the encoding to UTF-8.
mb_internal_encoding('UTF-8');
// Include database
require __DIR__.'/app/database.php';
// Include functions
require __DIR__.'/app/functions.php';
