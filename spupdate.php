<?php
include("dbconnect.php");
include("session.php");

if (isset($_POST["update"])){
    $name = $_POST["update"];
    $agent = $_POST["agent"];
    $desig = $_POST["desig"];
    $fundings = $_POST["fundings"];
    $balance = $_POST["balance"];
    $contacts = explode(', ', $_POST["contacts"]);
    $email = $_POST["email"];
    $password = $_POST["password"];

    //Email Check
    $tables1 = array('advisor', 'department', 'oca', 'registered_member', 'verified_sponsor');
    foreach($tables1 as $table){
        $sql1 = "SELECT * FROM $table WHERE Email = '$email'";
        $rows1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($rows1);
        if ($row1["Name"] != $name && mysqli_num_rows($rows1) != 0) {
            header("Location: spedit.php?error=Email Already In Use&sponsor=$name");
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
            if ($row2["Sponsor"] != $name && mysqli_num_rows($rows2) != 0) {
                header("Location: spedit.php?error=Contact Already In Use&sponsor=$name");
                exit();
            }
        }
    }

    //Update Details
    $sql3 = "UPDATE verified_sponsor SET Agent = '$agent', Designation = '$desig', Fund_Balance = $balance, Fundings = $fundings, Email = '$email', Password = $password WHERE Name = '$name'";
    $rows3 = mysqli_query($conn, $sql3);

    $sql4 = "DELETE FROM sponsor_contact WHERE Sponsor = '$name'";
    $rows4 = mysqli_query($conn, $sql4);

    foreach($contacts as $contact){
        $sql5 = "INSERT INTO sponsor_contact VALUES ('$name', '$contact')";
        $rows5 = mysqli_query($conn, $sql5);
    }
    header("Location: sponsors.php?msg=Sponsor Details Updated");
    exit();

} else if(isset($_POST["delete"])){
    $name = $_POST["delete"];
    $sql6 = "DELETE FROM verified_sponsor WHERE Name = '$name'";
    $rows6 = mysqli_query($conn, $sql6);

    header("Location: sponsors.php?error=Sponsor Has Been Deleted");
    exit();
}
?>