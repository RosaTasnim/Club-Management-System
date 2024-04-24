<?php
include("dbconnect.php");
include("session.php");

if (isset($_POST["launch"])) {
  $eid = $_POST["launch"];
  $cost = $_POST["cost"];
  $capacity = $_POST["capacity"];
  $club = $_SESSION["club"];
  $aid = $_SESSION["id"];

  $sql1 = "SELECT * FROM unapproved_event WHERE Event_ID = '$eid'";
  $rows1 = mysqli_query($conn, $sql1);
  $row1 = mysqli_fetch_assoc($rows1);

  $name = $row1["Name"];
  $date = $row1["Date"];
  $venue = $row1["Venue"];
  $entry = $row1["Entry_Fee"];

  $sql2 = "INSERT INTO approved_event VALUES (NULL, '$club', '$name', '$date', '$venue', '$entry', $aid, $capacity, $cost, 0, 0, 0)";
  $rows2 = mysqli_query($conn, $sql2);
  
  $sql3 = "DELETE FROM unapproved_event WHERE Event_ID = '$eid'";
  $rows3 = mysqli_query($conn, $sql3);

  header("Location: clubevents.php?msg=Event Launched Successfully");
  exit();

} else if (isset($_POST["postpone"])) {
  $eid = $_POST["postpone"];
  $sql4 = "DELETE FROM unapproved_event WHERE Event_ID = '$eid'";
  $rows4 = mysqli_query($conn, $sql4);

  header("Location: organize.php?error=Event Has Been Postponed");
  exit();

} else if (isset($_POST["conclude"])) {
  $eid = $_POST["conclude"];
  $sql5 = "SELECT * FROM approved_event WHERE Event_ID = '$eid'";
  $rows5 = mysqli_query($conn, $sql5);
  $row5 = mysqli_fetch_assoc($rows5);

  $club = $row5["Club"];
  $name = $row5["Name"];
  $date = $row5["Date"];
  $venue = $row5["Venue"];
  $entry = $row5["Entry_Fee"];
  $aid = $row5["Advisor_ID"];
  $capacity = $row5["Capacity"];
  $cost = $row5["Event_Cost"];
  $participants = $row5["Participants"];
  $fundings = $row5["Fundings"];
  $earnings = $row5["Earnings"];

  $sql6 = "INSERT INTO completed_event VALUES (NULL, '$club', '$name', '$date', '$venue', $entry, $aid, $capacity, $cost, $participants, $fundings, $earnings)";
  $rows6 = mysqli_query($conn, $sql6);

  $sql7 = "DELETE FROM approved_event WHERE Event_ID = '$eid'";
  $rows7 = mysqli_query($conn, $sql7);

  header("Location: clubevents.php?error=Event Has Been Concluded");
  exit();
}
?>