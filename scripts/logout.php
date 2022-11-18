<?php
session_start();
require "dbconnect.php";
$conn = null;
session_destroy();
echo"CLEAR";