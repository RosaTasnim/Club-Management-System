<?php
session_start(); 
include('dbconnect.php');

session_unset(); 
session_destroy(); 
header("Location: index.php?warn=You've Been Logged Out");
exit();
?> 