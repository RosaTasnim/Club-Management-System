<?php
session_start();
include('dbconnect.php');

if ($_SESSION["view"] == "Member" || $_SESSION["view"] == "Panel") {
    $sql1 = "SELECT * FROM registered_member WHERE Email = '" . $_SESSION["email"] . "'";
    $rows1 = mysqli_query($conn, $sql1);
    $row = mysqli_fetch_assoc($rows1);
    $_SESSION["id"] = $row["Member_ID"];
    $_SESSION["name"] = $row["Name"];
    $_SESSION["gender"] = $row["Gender"];
    $_SESSION["dob"] = $row["Birth_Date"];
    $_SESSION["dobf"] = date("jS M, Y", strtotime($_SESSION["dob"]));
    $_SESSION["dept"] = $row["Department"];
    $_SESSION["admit"] = $row["Admitted"];
    $_SESSION["credit"] = $row["Credits"];
    $_SESSION["club"] = $row["Club"];
    $_SESSION["joined"] = $row["Joined_Date"];
    $_SESSION["joinedf"] = date("jS M, Y", strtotime($_SESSION["joined"]));
    $_SESSION["desig"] = $row["Designation"];
    $_SESSION["email"] = $row["Email"];
    $_SESSION["password"] = $row["Password"];

    $sql2 = "SELECT * FROM member_contact WHERE Member_ID = " . $_SESSION["id"] . "";
    $rows2 = mysqli_query($conn, $sql2);

    $temp = array();
    while ($row = mysqli_fetch_assoc($rows2)) {
        array_push($temp, $row["Contact"]);
    }
    $contacts = implode(", ", $temp);
    $_SESSION["contacts"] = $contacts;

} else if ($_SESSION["view"] == "Advisor") {
    $sql3 = "SELECT * FROM advisor WHERE Email = '" . $_SESSION["email"] . "'";
    $rows3 = mysqli_query($conn, $sql3);
    $row = mysqli_fetch_assoc($rows3);
    $_SESSION["id"] = $row["Advisor_ID"];
    $_SESSION["name"] = $row["Name"];
    $_SESSION["desig"] = $row["Designation"];
    $_SESSION["email"] = $row["Email"];
    $_SESSION["password"] = $row["Password"];
    
    $sql4 = "SELECT * FROM club WHERE Advisor_ID = " . $_SESSION["id"] . "";
    $rows4 = mysqli_query($conn, $sql4);
    $row = mysqli_fetch_assoc($rows4);
    $_SESSION["club"] = $row["Name"];

    $sql5 = "SELECT * FROM advisor_contact WHERE Advisor_ID = " . $_SESSION["id"] . "";
    $rows5 = mysqli_query($conn, $sql5);

    $temp = array();
    while ($row = mysqli_fetch_assoc($rows5)) {
        array_push($temp, $row["Contact"]);
    }
    $contacts = implode(", ", $temp);
    $_SESSION["contacts"] = $contacts;

} else if ($_SESSION["view"] == "Oca") {
    $sql6 = "SELECT * FROM oca WHERE Email = '" . $_SESSION["email"] . "'";
    $rows6 = mysqli_query($conn, $sql6);
    $row = mysqli_fetch_assoc($rows6);
    $_SESSION["id"] = $row["OCA_ID"];
    $_SESSION["name"] = $row["Name"];
    $_SESSION["desig"] = $row["Designation"];
    $_SESSION["balance"] = $row["Fund_Balance"];
    $_SESSION["fund"] = $row["Fundings"];
    $_SESSION["email"] = $row["Email"];
    $_SESSION["password"] = $row["Password"];
    
    $sql7 = "SELECT * FROM oca_contact WHERE OCA_ID = " . $_SESSION["id"] . "";
    $rows7 = mysqli_query($conn, $sql7);

    $temp = array();
    while ($row = mysqli_fetch_assoc($rows7)) {
        array_push($temp, $row["Contact"]);
    }
    $contacts = implode(", ", $temp);
    $_SESSION["contacts"] = $contacts;

} else if ($_SESSION["view"] == 'Department') {
    $sql10 = "SELECT * FROM department WHERE Email = '" . $_SESSION["email"] . "'";
    $rows10 = mysqli_query($conn, $sql10);
    $row = mysqli_fetch_assoc($rows10);
    $_SESSION["name"] = $row["Name"];
    $_SESSION["head"] = $row["Head"];
    $_SESSION["desig"] = $row["Designation"];
    $_SESSION["email"] = $row["Email"];
    $_SESSION["password"] = $row["Password"];
    $_SESSION["estb"] = $row["Established"];
    $_SESSION["estbf"] = date("jS M, Y", strtotime($_SESSION["estb"]));

} else if ($_SESSION["view"] == 'Sponsor') {
    $sql8 = "SELECT * FROM verified_sponsor WHERE Email = '" . $_SESSION["email"] . "'";
    $rows8 = mysqli_query($conn, $sql8);
    $row = mysqli_fetch_assoc($rows8);
    $_SESSION["name"] = $row["Name"];
    $_SESSION["agent"] = $row["Agent"];
    $_SESSION["desig"] = $row["Designation"];
    $_SESSION["balance"] = $row["Fund_Balance"];
    $_SESSION["fund"] = $row["Fundings"];
    $_SESSION["email"] = $row["Email"];
    $_SESSION["password"] = $row["Password"];

    $sql9 = "SELECT * FROM sponsor_contact WHERE Sponsor = '" . $_SESSION["name"] . "'";
    $rows9 = mysqli_query($conn, $sql9);

    $temp = array();
    while ($row = mysqli_fetch_assoc($rows9)) {
        array_push($temp, $row["Contact"]);
    }
    $contacts = implode(", ", $temp);
    $_SESSION["contacts"] = $contacts;
}
