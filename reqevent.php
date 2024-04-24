<?php
include('dbconnect.php');
include('session.php');

$name = $_POST["name"];
$date = $_POST["date"];
$venue = $_POST["venue"];
$entry_fee = $_POST["entry"];
$club = $_SESSION["club"];
$pid = $_SESSION["id"];

$chksql = "SELECT * FROM approved_event WHERE Name = '$name' AND Club = '$club'";
$chkrows = mysqli_query($conn, $chksql);
if (mysqli_num_rows($chkrows) == 0) {
    if ($entry_fee >= 0) {
        $sql1 = "INSERT INTO unapproved_event VALUES (NULL, '$name', '$date', '$venue', $entry_fee)";
        $rows1 = mysqli_query($conn, $sql1);

        $sql2 = "SELECT * FROM unapproved_event WHERE Name = '$name'";
        $rows2 = mysqli_query($conn, $sql2);
        $row2 = mysqli_fetch_assoc($rows2);
        $eid = $row2["Event_ID"];

        $sql3 = "SELECT * FROM oca";
        $rows3 = mysqli_query($conn, $sql3);
        while ($row3 = mysqli_fetch_assoc($rows3)) {
            $oid = $row3["OCA_ID"];
            $sql4 = "INSERT INTO request_event VALUES ($eid, $pid, $oid, '$club', 'No')";
            $rows4 = mysqli_query($conn, $sql4);
        }
    } else {
        header("Location: request.php?error=Enter Valid Entry Fee");
        exit();
    }
} else {
    header("Location: request.php?error=Requested Event Already Exists");
    exit();
}
header("Location: request.php?msg=Event Request Has Been Sent");
exit();
?>