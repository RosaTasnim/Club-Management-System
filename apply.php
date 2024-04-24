<?php
include('dbconnect.php');

//Values
$name = $_POST["name"];
$agent = $_POST["agent"];
$event = $_POST["event"];
$contacts = explode(', ', $_POST["contacts"]);
$email = $_POST["email"];
$password = $_POST["password"];
$confirm = $_POST["confirm"];

//Request Check
$sql1 = "SELECT * FROM unverified_sponsor WHERE Name = '$name' AND Email = '$email'";
$rows1 = mysqli_query($conn, $sql1);

$sql2 = "SELECT * FROM tsponsor_contact WHERE Sponsor = '$name'";
$rows2 = mysqli_query($conn, $sql2);

if (mysqli_num_rows($rows1) != 0 || mysqli_num_rows($rows2) != 0) {
    header("Location: sponsor.php?warn=You've Already Sent Request");
    exit();
}

//Sponsor Check
$sql3 = "SELECT * FROM verified_sponsor WHERE Name = '$name'";
$rows3 = mysqli_query($conn, $sql3);
if (mysqli_num_rows($rows3) != 0) {
    header('Location: sponsor.php?error=Sponsor Already Exists');
    exit();
}

//Email Check
$tables = array('advisor', 'department', 'oca', 'registered_member', 'unregistered_member', 'unverified_sponsor', 'verified_sponsor');
foreach($tables as $table){
    $sql4 = "SELECT * FROM $table WHERE Email = '$email'";
    $rows4 = mysqli_query($conn, $sql4);
    if (mysqli_num_rows($rows4) != 0) {
        header('Location: sponsor.php?error=Email Already Exists');
        exit();
    }
}

//Contacts Check
$tables = array('advisor_contact', 'member_contact', 'oca_contact', 'sponsor_contact', 'tmember_contact', 'tsponsor_contact');
foreach($tables as $table){
    foreach($contacts as $contact){
        $sql5 = "SELECT * FROM $table WHERE Contact = '$contact'";
        $rows5 = mysqli_query($conn, $sql5);
        if (mysqli_num_rows($rows5) != 0) {
            header('Location: sponsor.php?error=Contact Already Exists');
            exit();
        }
    }
}

//Confirm Check
if ($password != $confirm) {
    header("Location: sponsor.php?warn=Both Passwords Don't Match");
    exit();
}

//Insertion
$sql6 = "INSERT INTO unverified_sponsor Values('$name', '$agent', '$email', $password)";
$rows6 = mysqli_query($conn, $sql6);

foreach($contacts as $contact){
    $sql7 = "INSERT INTO tsponsor_contact Values('$name', '$contact')";
    $rows7 = mysqli_query($conn, $sql7);
}

$sql8 = "SELECT * FROM approved_event e, registered_member p WHERE e.Club = p.Club AND e.Event_ID = $event AND p.Designation IN ('President', 'Vice President', 'General Secretary', 'Treasurer')";
$rows8 = mysqli_query($conn, $sql8);
while ($row = mysqli_fetch_assoc($rows8)) {
    $pid = $row['Member_ID'];
    $eid = $row['Event_ID'];

    $sql9 = "INSERT INTO contact Values('$name', $pid, $eid)";
    $rows9 = mysqli_query($conn, $sql9);
}

header("Location: index.php?msg=Your Request Has Been Sent");
exit();
?>
