<?php
include('dbconnect.php');
include('session.php');

if (isset($_POST["fund"])){
    $eid = $_POST["fund"];
    $amount = $_POST["amount"];
    $sponsor = $_SESSION["name"];
    
    $sql1 = "SELECT * FROM approved_event e, club c WHERE e.Club = c.Name AND Event_ID = $eid";
    $rows1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($rows1);

    $balance = $_SESSION["balance"];
    $cost = $row1["Event_Cost"];
    $fundings = $row1["Fundings"];
    $fund = $cost - $fundings;

    if ($amount <= 0) {
        header("Location: events.php?error=Invalid Fund Amount");
        exit();
    }

    if ($amount > $balance) {
        header("Location: events.php?error=Not Enough Fund Balance");
        exit();

    } else {
        $sql2 = "SELECT * FROM oca";
        $rows2 = mysqli_query($conn, $sql2);
        while($row2 = mysqli_fetch_assoc($rows2)){
            $oid = $row2["OCA_ID"];
            $sql3 = "INSERT INTO give_fund VALUES ($eid, $oid, '$sponsor', $amount, 'No')";
            $rows3 = mysqli_query($conn, $sql3);
        }

        header("Location: events.php?msg=Fund Provided To Event");
        exit();
    }

} else if (isset($_POST["cancel"])) {
    $eid = $_POST["cancel"];
    $sponsor = $_SESSION["name"];

    $sql6 = "SELECT * FROM give_fund WHERE Event_ID = $eid AND Sponsor = '$sponsor'";
    $rows6 = mysqli_query($conn, $sql6);
    $row6 = mysqli_fetch_assoc($rows6);
    $amount = $row6["Amount"];
    $approved = $row6["Approved"];

    $sql7 = "SELECT * FROM approved_event e, club c WHERE e.Club = c.Name AND Event_ID = $eid";
    $rows7 = mysqli_query($conn, $sql7);
    $row7 = mysqli_fetch_assoc($rows7);
    $fundings = $row7["Fundings"];

    if ($approved == "Yes") {
        if ($amount > $fundings){
            $extra = $amount - $fundings;
            $sql8 = "UPDATE approved_event e, club c SET e.Fundings = e.Fundings - $fundings, c.Club_Reserve = c.Club_Reserve - $extra WHERE e.Club = c.Name AND Event_ID = $eid";
            $rows8 = mysqli_query($conn, $sql8);
        } else {
            $sql9 = "UPDATE approved_event SET Fundings = Fundings - $amount WHERE Event_ID = $eid";
            $rows9 = mysqli_query($conn, $sql9);
        }
        $sql10 = "UPDATE verified_sponsor SET Fundings = Fundings - $amount, Fund_Balance = Fund_Balance + $amount WHERE Name = '$sponsor'";
        $rows10 = mysqli_query($conn, $sql10);
    }

    $sql11 = "DELETE FROM give_fund WHERE Event_ID = $eid AND Sponsor = '$sponsor'";
    $rows11 = mysqli_query($conn, $sql11);

    header("Location: events.php?warn=Fund Withdrawn from Event");
    exit();
}
?>