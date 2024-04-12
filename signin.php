<?php
session_start();
include('dbconnect.php');

$_SESSION["email"] = $_POST["email"];
$_SESSION["password"] = $_POST["password"];

if (isset($_POST["email"]) && isset($_POST["password"])) {
    $email = $_SESSION["email"];
    $password = $_SESSION["password"];

    $tables = array('advisor', 'department', 'oca', 'verified_sponsor', 'registered_member');
    foreach ($tables as $table) {
        $sql = "SELECT * FROM $table WHERE Email = '$email' AND Password = $password";
        $rows = mysqli_query($conn, $sql);

        if ($row = mysqli_fetch_assoc($rows)) {
            if ($table == 'advisor') {
                $_SESSION["view"] = "Advisor";
            } else if ($table == 'department') {
                $_SESSION["view"] = "Department";
            } else if ($table == 'oca') {
                $_SESSION["view"] = "Oca";
            } else if ($table == 'verified_sponsor') {
                $_SESSION["view"] = "Sponsor";
            } else {
                if ($row["Designation"] == 'President' || $row["Designation"] == 'Vice President' || $row["Designation"] == 'General Secretary' || $row["Designation"] == 'Treasurer') {
                    $_SESSION["view"] = "Panel";
                } else {
                    $_SESSION["view"] = "Member";
                }
            }
            header("Location: profile.php?msg=You've Logged In Successfully");
            exit();
        }

    }
    header("Location: login.php?error=Invalid Email Or Password");
    exit();
}
