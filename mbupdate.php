<?php
include("dbconnect.php");
include("session.php");

if (isset($_POST["update"])){
    $tid = $_POST["update"];
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

    //Member ID Check
    $sql0 = "SELECT * FROM registered_member WHERE Member_ID = $id";
    $rows0 = mysqli_query($conn, $sql0);
    $row0 = mysqli_fetch_assoc($rows0);
    if ($row0["Member_ID"] != $tid && mysqli_num_rows($rows0) != 0) {
        if (isset($_POST["panel"])) {
            header("Location: mbedit.php?error=Panel ID Already In Use&id=$tid&panel=");
            exit();
        } else {
            header("Location: mbedit.php?error=Member ID Already In Use&id=$tid");
            exit();
        }
    }
    
    //Email Check
    $tables1 = array('advisor', 'department', 'oca', 'registered_member', 'verified_sponsor');
    foreach($tables1 as $table){
        $sql1 = "SELECT * FROM $table WHERE Email = '$email'";
        $rows1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($rows1);
        if ($row1["Member_ID"] != $tid && mysqli_num_rows($rows1) != 0) {
            if (isset($_POST["panel"])) {
                header("Location: mbedit.php?error=Email Already In Use&id=$tid&panel=");
                exit();
            } else {
                header("Location: mbedit.php?error=Email Already In Use&id=$tid");
                exit();
            }
        }
    }
    
    //Contacts Check
    $tables2 = array('advisor_contact', 'oca_contact', 'member_contact', 'sponsor_contact');
    foreach($tables2 as $table){
        foreach($contacts as $contact){
            $sql2 = "SELECT * FROM $table WHERE Contact = '$contact'";
            $rows2 = mysqli_query($conn, $sql2);
            $row2 = mysqli_fetch_assoc($rows2);
            if ($row2["Member_ID"] != $tid && mysqli_num_rows($rows2) != 0) {
                if (isset($_POST["panel"])) {
                    header("Location: mbedit.php?error=Contact Already In Use&id=$tid&panel=");
                    exit();
                } else {
                    header("Location: mbedit.php?error=Contact Already In Use&id=$tid");
                    exit();
                }
            }
        }
    }
    
    //Update Details
    $sql3 = "UPDATE registered_member SET Member_ID = $id, Name = '$name', Gender = '$gender', Birth_Date = '$dob', Department = '$dept', Admitted = '$admit', Credits = $credit,  Email = '$email', Password = $password WHERE Member_ID = $tid";
    $rows3 = mysqli_query($conn, $sql3);
    
    $sql4 = "DELETE FROM member_contact WHERE Member_ID = $id";
    $rows4 = mysqli_query($conn, $sql4);
    
    foreach($contacts as $contact){
        $sql5 = "INSERT INTO member_contact VALUES ($id, '$contact')";
        $rows5 = mysqli_query($conn, $sql5);
    }
    if (isset($_POST["panel"])) {
        header("Location: panels.php?msg=Panel Details Updated");
        exit();
    } else {
        header("Location: members.php?msg=Member Details Updated");
        exit();
    }
  
} else if(isset($_POST["delete"])){
    $tid = $_POST["delete"];
    $sql6 = "DELETE FROM registered_member WHERE Member_ID = $tid";
    $rows6 = mysqli_query($conn, $sql6);

    header("Location: members.php?error=Member Has Been Deleted");
    exit();
}
?>