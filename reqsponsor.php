<?php
include("dbconnect.php");
include("session.php");

if (isset($_POST["approve"])){
    $sponsor = $_POST["approve"];

    //Storing Unverified Sponsor Details
    $sql1 = "SELECT * FROM unverified_sponsor WHERE Name = '$sponsor'";
    $rows1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($rows1);

    $sql2 = "SELECT * FROM tsponsor_contact WHERE Sponsor = '$sponsor'";
    $rows2 = mysqli_query($conn, $sql2); 

    $temp = array();
    while($row2 = mysqli_fetch_assoc($rows2)) {
      array_push($temp, $row2["Contact"]);
    } 
    $tcontacts = implode(', ', $temp);

    //Inserting into Verified Sponsor
    $name = $row1["Name"];
    $agent = $row1["Agent"];
    $email = $row1["Email"];
    $password = $row1["Password"];
    $contacts = explode(', ', $tcontacts);

    $sql3 = "INSERT INTO verified_sponsor VALUES ('$name', '$agent', 'Sponsor', 0, 0, '$email', '$password')";
    $rows3 = mysqli_query($conn, $sql3);

    foreach($contacts as $contact){
        $sql4 = "INSERT INTO sponsor_contact Values('$name', '$contact')";
        $rows4 = mysqli_query($conn, $sql4);
    }

    //Deleting from Unverified Sponsor
    $sql5 = "DELETE FROM unverified_sponsor WHERE Name = '$sponsor'";
    $rows5 = mysqli_query($conn, $sql5);
    
    header("Location: sponsorship.php?msg=Sponsorship Request Approved");
    exit();

} else if (isset($_POST["decline"])){
    $sponsor = $_POST["decline"];
    
    $sql6 = "DELETE FROM unverified_sponsor WHERE Name = '$sponsor'";
    $rows6 = mysqli_query($conn, $sql6);

    header("Location: sponsorship.php?error=Sponsorship Request Declined");
    exit();
}
?>