<?php
include("dbconnect.php");
include("session.php");

if (isset($_POST["refer"])){
    $pid = $_POST["refer"];
    $sponsor = $_POST["sponsor"];

    $sql1 = "SELECT * FROM oca";
    $rows1 = mysqli_query($conn, $sql1);
    while($row1 = mysqli_fetch_assoc($rows1)){
        $oid = $row1["OCA_ID"];
        $sql2 = "INSERT INTO request_sponsorship VALUES ('$sponsor', $pid, $oid)";
        $rows2 = mysqli_query($conn, $sql2);
    }

    $sql3 = "DELETE FROM contact WHERE Sponsor = '$sponsor'";
    $rows3 = mysqli_query($conn, $sql3);

    header("Location: contacts.php?msg=Referred Sponsorship Request");
    exit();

} else if (isset($_POST["defer"])){
    $sponsor = $_POST["sponsor"];
    $sql = "DELETE FROM unverified_sponsor WHERE Name = '$sponsor'";
    $rows = mysqli_query($conn, $sql);

    header("Location: contacts.php?error=Deferred Sponsorship Request");
    exit();
}
?>