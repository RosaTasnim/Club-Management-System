<?php
include("dbconnect.php");
include("session.php");

if (isset($_POST['approve'])) {
  $eid = $_POST['approve'];
  $id = $_SESSION["id"];

  $sql1 = "UPDATE request_event SET Approved = 'Yes' WHERE Event_ID = $eid AND OCA_ID = $id";
  $rows1 = mysqli_query($conn, $sql1);

  $sql2 = "DELETE FROM request_event WHERE Event_ID = $eid AND OCA_ID <> $id";
  $rows2 = mysqli_query($conn, $sql2);

  header("Location: approval.php?msg=Event Request Approved");
  exit();

} else if (isset($_POST['decline'])) {
  $eid = $_POST['decline'];

  $sql3 = "DELETE FROM unapproved_event WHERE Event_ID = $eid";
  $rows3 = mysqli_query($conn, $sql3);

  header("Location: approval.php?error=Event Request Declined");
  exit();
}
?>