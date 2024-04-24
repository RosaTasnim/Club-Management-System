<?php
include('dbconnect.php');
include('session.php');

$id = $_POST["id"];
$name = $_POST["name"];
$gender = $_POST["gender"];
$dob = $_POST["dob"];
$dept = $_POST["dept"];
$admit = $_POST["session"];
$credit = $_POST["credit"];
$contacts = explode(', ', $_POST["contacts"]);
$email = $_POST["email"];
$password = $_POST["password"];

//Email Check
$tables1 = array('advisor', 'department', 'oca', 'registered_member', 'verified_sponsor');
foreach($tables1 as $table){
    $sql1 = "SELECT * FROM $table WHERE Email = '$email'";
    $rows1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($rows1);
    if ($row1["Member_ID"] != $id && mysqli_num_rows($rows1) != 0) {
        header("Location: modedit.php?error=Email Already In Use&id=$id");
        exit();
    }
}

//Contacts Check
$tables2 = array('advisor_contact', 'oca_contact', 'member_contact', 'sponsor_contact');
foreach($tables2 as $table){
    foreach($contacts as $contact){
        $sql2 = "SELECT * FROM $table WHERE Contact = '$contact'";
        $rows2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($rows2);
        if ($row2["Member_ID"] != $id && mysqli_num_rows($rows2) != 0) {
            header("Location: modedit.php?error=Contact Already In Use&id=$id");
            exit();
        }
    }
}

//Update Details
$sql3 = "UPDATE registered_member SET Name = '$name', Gender = '$gender', Birth_Date = '$dob', Department = '$dept', Admitted = '$admit', Credits = $credit, Email = '$email', Password = $password WHERE Member_ID = $id";
$rows3 = mysqli_query($conn, $sql3);

$sql4 = "DELETE FROM member_contact WHERE Member_ID = $id";
$rows4 = mysqli_query($conn, $sql4);

foreach($contacts as $contact){
    $sql5 = "INSERT INTO member_contact VALUES ($id, '$contact')";
    $rows5 = mysqli_query($conn, $sql5);
}

header("Location: clubmembers.php?msg=Member Details Updated");
exit();
?>