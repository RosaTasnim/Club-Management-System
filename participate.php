<?php 
include("dbconnect.php");
include("session.php");

if (isset($_POST["join"])) {
    $event_id = $_POST["join"];
    $member_id = $_SESSION["id"];

    $chksql = "SELECT * FROM approved_event WHERE Event_ID = $event_id";
    $rows = mysqli_query($conn, $chksql);
    $row = mysqli_fetch_assoc($rows);
    $capacity = $row["Capacity"];
    $participants = $row["Participants"];

    if ($participants >= 0 && $participants < $capacity) {
        $sql1 = "INSERT INTO participate VALUES ($member_id, $event_id)";
        $rows1 = mysqli_query($conn, $sql1);

        $sql2 = "UPDATE participate p, approved_event a, club c SET a.Participants = a.Participants + 1, a.Earnings = a.Earnings + a.Entry_Fee, c.Club_Reserve = c.Club_Reserve + a.Entry_Fee WHERE p.Event_ID = a.Event_ID AND a.Club = c.Name AND p.Member_ID = $member_id AND a.Event_ID = $event_id";
        $rows2 = mysqli_query($conn, $sql2);

        if(isset($_POST["clubevent"])) {
            header("Location: clubevents.php?msg=You've Joined The Event");
            exit();
        } else {
            header("Location: events.php?msg=You've Joined The Event");
            exit();
        }
    }else {
        if(isset($_POST["clubevent"])) {
            header("Location: clubevents.php?error=Can't Join Event, Capacity Full");
            exit();
        } else {
            header("Location: events.php?error=Can't Join Event, Capacity Full");
            exit();
        }
    }

} else if (isset($_POST["leave"])) {
    $event_id = $_POST["leave"];
    $member_id = $_SESSION["id"];

    $chksql = "SELECT * FROM approved_event WHERE Event_ID = $event_id";
    $rows = mysqli_query($conn, $chksql);
    $row = mysqli_fetch_assoc($rows);
    $participants = $row["Participants"];

    if ($participants > 0) {
        $sql1 = "UPDATE participate p, approved_event a, club c SET a.Participants = a.Participants - 1, a.Earnings = a.Earnings - a.Entry_Fee, c.Club_Reserve = c.Club_Reserve - a.Entry_Fee WHERE p.Event_ID = a.Event_ID AND a.Club = c.Name AND p.Member_ID = $member_id AND a.Event_ID = $event_id";
        $rows1 = mysqli_query($conn, $sql1);

        $sql2 = "DELETE FROM participate WHERE Member_ID = $member_id AND Event_ID = $event_id";
        $rows2 = mysqli_query($conn, $sql2);

        if(isset($_POST["clubevent"])) {
            header("Location: clubevents.php?warn=You've Left The Event");
            exit();
        } else {
            header("Location: events.php?warn=You've Left The Event");
            exit();
        }
    }
}
?>