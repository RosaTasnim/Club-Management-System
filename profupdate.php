<?php
include('dbconnect.php');
include('session.php');

if (isset($_POST["fund"]) && $_POST["amount"]>0) {
    if ($_SESSION["view"] == 'Oca'){
      $amount = $_POST["amount"];
      $id = $_SESSION["id"];
  
      $sql1 = "UPDATE oca SET Fund_Balance = Fund_Balance + $amount WHERE OCA_ID = $id";
      $rows1 = mysqli_query($conn, $sql1);
    
    }else{
      $amount = $_POST["amount"];
      $name = $_SESSION["name"];
  
      $sql = "UPDATE verified_sponsor SET Fund_Balance = Fund_Balance + $amount WHERE Name = '$name'";
      $rows = mysqli_query($conn, $sql);
    }
    header("Location: profile.php?msg=Fund Has Been Added");
    exit();

} else {
    if ($_SESSION["view"] == "Panel") {
    $id = $_POST["id"];
    $dept = $_POST["dept"];
    $dob = $_POST["dob"];
    $gender = $_POST["gender"];
    $admit = $_POST["session"];
    $credit = $_POST["credit"];
    $email = $_POST["email"];
    $contacts = explode(', ', $_POST["contacts"]);

    //Email Check
    $tables1 = array('advisor', 'department', 'oca', 'registered_member', 'verified_sponsor');
    foreach($tables1 as $table){
        $sql1 = "SELECT * FROM $table WHERE Email = '$email'";
        $rows1 = mysqli_query($conn, $sql1);
        $row1 = mysqli_fetch_assoc($rows1);
        if ($row1["Member_ID"] != $id && mysqli_num_rows($rows1) != 0) {
            header("Location: profedit.php?error=Email Already In Use");
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
                header("Location: profedit.php?error=Contact Already In Use");
                exit();
            }
        }
    }

    //Update Details
    $_SESSION["dept"] = $dept;
    $_SESSION["dob"] = $dob;
    $_SESSION["gender"] = $gender;
    $_SESSION["admit"] = $admit;
    $_SESSION["credit"] = $credit;
    $_SESSION["email"] = $email;
    $_SESSION["contacts"] = implode(", ", $contacts);

    $sql3 = "UPDATE registered_member SET Department = '$dept', Birth_Date = '$dob', Gender = '$gender', Admitted = '$admit', Credits = $credit, Email = '$email' WHERE Member_ID = $id";
    $rows3 = mysqli_query($conn, $sql3);
    
    $sql4 = "DELETE FROM member_contact WHERE Member_ID = $id";
    $rows4 = mysqli_query($conn, $sql4);

    foreach($contacts as $contact){
        $sql5 = "INSERT INTO member_contact VALUES ($id, '$contact')";
        $rows5 = mysqli_query($conn, $sql5);
    }

    }else if($_SESSION["view"] == "Advisor"){
        $id = $_POST["id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $contacts = explode(', ', $_POST["contacts"]);

        //Email Check
        $tables1 = array('advisor', 'department', 'oca', 'registered_member', 'verified_sponsor');
        foreach($tables1 as $table){
            $sql1 = "SELECT * FROM $table WHERE Email = '$email'";
            $rows1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($rows1);
            if ($row1["Advisor_ID"] != $id && mysqli_num_rows($rows1) != 0) {
                header("Location: profedit.php?error=Email Already In Use");
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
                if ($row2["Advisor_ID"] != $id && mysqli_num_rows($rows2) != 0) {
                    header("Location: profedit.php?error=Contact Already In Use");
                    exit();
                }
            }
        }

        //Update Details
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
        $_SESSION["contacts"] = implode(", ", $contacts);

        $sql3 = "UPDATE advisor SET Name = '$name', Email = '$email' WHERE Advisor_ID = $id";
        $rows3 = mysqli_query($conn, $sql3);
        
        $sql4 = "DELETE FROM advisor_contact WHERE Advisor_ID = $id";
        $rows4 = mysqli_query($conn, $sql4);

        foreach($contacts as $contact){
            $sql5 = "INSERT INTO advisor_contact VALUES ($id, '$contact')";
            $rows5 = mysqli_query($conn, $sql5);
        }

    }else if($_SESSION["view"] == "Oca"){
        $id = $_POST["id"];
        $name = $_POST["name"];
        $email = $_POST["email"];
        $contacts = explode(', ', $_POST["contacts"]);

        //Email Check
        $tables1 = array('advisor', 'department', 'oca', 'registered_member', 'verified_sponsor');
        foreach($tables1 as $table){
            $sql1 = "SELECT * FROM $table WHERE Email = '$email'";
            $rows1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($rows1);
            if ($row1["OCA_ID"] != $id && mysqli_num_rows($rows1) != 0) {
                header("Location: profedit.php?error=Email Already In Use");
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
                if ($row2["OCA_ID"] != $id && mysqli_num_rows($rows2) != 0) {
                    header("Location: profedit.php?error=Contact Already In Use");
                    exit();
                }
            }
        }

        //Update Details
        $_SESSION["name"] = $name;
        $_SESSION["email"] = $email;
        $_SESSION["contacts"] = implode(", ", $contacts);

        $sql3 = "UPDATE oca SET Name = '$name', Email = '$email' WHERE OCA_ID = $id";
        $rows3 = mysqli_query($conn, $sql3);
        
        $sql4 = "DELETE FROM oca_contact WHERE OCA_ID = $id";
        $rows4 = mysqli_query($conn, $sql4);

        foreach($contacts as $contact){
            $sql5 = "INSERT INTO oca_contact VALUES ($id, '$contact')";
            $rows5 = mysqli_query($conn, $sql5);
        }

    } else if($_SESSION["view"] == "Department"){
        $name = $_POST["name"];
        $head = $_POST["head"];
        $email = $_POST["email"];

        //Email Check
        $tables1 = array('advisor', 'department', 'oca', 'registered_member', 'verified_sponsor');
        foreach($tables1 as $table){
            $sql1 = "SELECT * FROM $table WHERE Email = '$email'";
            $rows1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($rows1);
            if ($row1["Name"] != $name && mysqli_num_rows($rows1) != 0) {
                header("Location: profedit.php?error=Email Already In Use");
                exit();
            }
        }

        //Update Details
        $_SESSION["head"] = $head;
        $_SESSION["email"] = $email;

        $sql2 = "UPDATE department SET Head = '$head', Email = '$email' WHERE Name = '$name'";
        $rows2 = mysqli_query($conn, $sql2);

    } else {
        $name = $_POST["name"];
        $agent = $_POST["agent"];
        $email = $_POST["email"];
        $contacts = explode(', ', $_POST["contacts"]);

        //Email Check
        $tables1 = array('advisor', 'department', 'oca', 'registered_member', 'verified_sponsor');
        foreach($tables1 as $table){
            $sql1 = "SELECT * FROM $table WHERE Email = '$email'";
            $rows1 = mysqli_query($conn, $sql1);
            $row1 = mysqli_fetch_assoc($rows1);
            if ($row1["Name"] != $name && mysqli_num_rows($rows1) != 0) {
                header("Location: profedit.php?error=Email Already In Use");
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
                    header("Location: profedit.php?error=Contact Already In Use");
                    exit();
                }
            }
        }

        //Update Details
        $_SESSION["agent"] = $agent;
        $_SESSION["email"] = $email;
        $_SESSION["contacts"] = implode(", ", $contacts);
        
        $sql3 = "UPDATE verified_sponsor SET Agent = '$agent', Email = '$email' WHERE Name = '$name'";
        $rows3 = mysqli_query($conn, $sql3);

        $sql4 = "DELETE FROM sponsor_contact WHERE Sponsor = '$name'";
        $rows4 = mysqli_query($conn, $sql4);

        foreach($contacts as $contact){
            $sql5 = "INSERT INTO sponsor_contact VALUES ('$name', '$contact')";
            $rows5 = mysqli_query($conn, $sql5);
        }

    }

    header("Location: profile.php?msg=You've Updated Your Profile");
    exit();
}
?>