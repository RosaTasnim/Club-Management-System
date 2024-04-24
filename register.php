<?php
include('dbconnect.php');

//Values
$id = $_POST["id"];
$name = $_POST["name"];
$gender = $_POST["gender"];
$dob = $_POST["dob"];
$club = $_POST["club"];
$dept = $_POST["dept"];
$session = $_POST["session"];
$credit = $_POST["credit"];
$contacts = explode(', ', $_POST["contacts"]);
$email = $_POST["email"];
$password = $_POST["password"];
$confirm = $_POST["confirm"];

//Request Check
$sql1 = "SELECT * FROM unregistered_member WHERE Member_ID = $id AND Email = '$email'";
$rows1 = mysqli_query($conn, $sql1);

$sql2 = "SELECT * FROM tmember_contact WHERE Member_ID = $id";
$rows2 = mysqli_query($conn, $sql2);

if (mysqli_num_rows($rows1) != 0 || mysqli_num_rows($rows2) != 0) {
    header("Location: signup.php?warn=You've Already Sent Request");
    exit();
}

//Member Check
$sql3 = "SELECT * FROM registered_member WHERE Member_ID = $id";
$rows3 = mysqli_query($conn, $sql3);
if (mysqli_num_rows($rows3) != 0) {
    header("Location: signup.php?error=Member Already Exists");
    exit();
}

//Email Check
$tables = array('advisor', 'department', 'oca', 'registered_member', 'unregistered_member', 'verified_sponsor', 'unverified_sponsor');
foreach($tables as $table){
    $sql4 = "SELECT * FROM $table WHERE Email = '$email'";
    $rows4 = mysqli_query($conn, $sql4);
    if (mysqli_num_rows($rows4) != 0) {
        header("Location: signup.php?error=Email Already Exists");
        exit();
    }
}

//Contacts Check
$tables = array('advisor_contact', 'member_contact', 'oca_contact', 'sponsor_contact', 'tmember_contact', 'tsponsor_contact');
foreach($tables as $table){
    foreach($contacts as $contact){
        $sql5 = "SELECT * FROM $table WHERE Contact = '$contact'";
        echo $sql5."<br>";
        $rows5 = mysqli_query($conn, $sql5);
        if (mysqli_num_rows($rows5) != 0) {
            header("Location: signup.php?error=Contact Already Exists");
            exit();
        }
    }
}

//Confirm Check
if ($password != $confirm) {
    header("Location: signup.php?warn=Both Passwords Don't Match");
    exit();
}

//Insertion
$sql6 = "INSERT INTO unregistered_member Values($id, '$name', '$gender', '$dob', '$dept', '$session', $credit, '$email', $password)";
$rows6 = mysqli_query($conn, $sql6);

foreach($contacts as $contact){
    $sql7 = "INSERT INTO tmember_contact Values($id, '$contact')";
    $rows7 = mysqli_query($conn, $sql7);
}

$sql8 = "SELECT * FROM registered_member WHERE Club = '$club' AND Designation IN ('President', 'Vice President', 'General Secretary', 'Treasurer')";
$rows8 = mysqli_query($conn, $sql8);
while ($row = mysqli_fetch_assoc($rows8)) {
    $pid = $row["Member_ID"];
    $sql9 = "INSERT INTO request_membership Values($id, $pid, '$club')";
    $rows9 = mysqli_query($conn, $sql9);
}

header("Location: index.php?msg=Your Request Has Been Sent");
exit();
?>
