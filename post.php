<?php
include("dbconnect.php");
include("session.php");

if ($_SESSION["view"] == "Advisor") {
    $sql1 = "SELECT * FROM department";
    $rows1 = mysqli_query($conn, $sql1);
    while ($row1 = mysqli_fetch_assoc($rows1)) {
        $dept = $row1["Name"];
        $club = $_SESSION["club"];
        $post = $_POST["post"];
        $pub = $_SESSION["email"];
        $date = date("Y-m-d");

        $sql2 = "INSERT INTO give_announcement VALUES('$dept', '$club', '$post', '$pub', '$date')";
        $rows2 = mysqli_query($conn, $sql2);
    }
} else {
    $sql3 = "SELECT * FROM club";
    $rows3 = mysqli_query($conn, $sql3);
    while ($row3 = mysqli_fetch_assoc($rows3)) {
        $club = $row3["Name"];
        $dept = $_SESSION["name"];
        $post = $_POST["post"];
        $pub = $_SESSION["email"];
        $date = date("Y-m-d");

        $sql4 = "INSERT INTO give_announcement VALUES('$dept', '$club', '$post', '$pub', '$date')";
        $rows4 = mysqli_query($conn, $sql4);
    }
}

header("Location: announce.php?msg=Posted Announcement");

?>