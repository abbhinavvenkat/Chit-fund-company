<?php
require 'core.inc.php';
session_destroy();
$refer = 'index.php';
header('Location: '.$refer);

?>