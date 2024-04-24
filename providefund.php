<?php
include('dbconnect.php');
include('session.php');

if (isset($_POST["fund"])){
    $eid = $_POST["fund"];
    $amount = $_POST["amount"];
    $oid = $_SESSION["id"];
    
    $sql1 = "SELECT * FROM approved_event e, club c WHERE e.Club = c.Name AND e.Event_ID = $eid";
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
        if ($amount > $fund) {
            $extra = $amount - $fund;
            $sql2 = "UPDATE approved_event e, club c SET e.Fundings = e.Fundings + $fund, c.Club_Reserve = c.Club_Reserve + $extra WHERE e.Club = c.Name AND e.Event_ID = $eid";
            $rows2 = mysqli_query($conn, $sql2);
        } else {
            $sql3 = "UPDATE approved_event SET Fundings = Fundings + $amount WHERE Event_ID = $eid";
            $rows3 = mysqli_query($conn, $sql3);
        }
        $sql4 = "INSERT INTO provide_fund VALUES ($eid, $oid, $amount)";
        $rows4 = mysqli_query($conn, $sql4);

        $sql5 = "UPDATE oca SET Fundings = Fundings + $amount, Fund_Balance = Fund_Balance - $amount WHERE OCA_ID = $oid";
        $rows5 = mysqli_query($conn, $sql5);

        header("Location: events.php?msg=Fund Provided To Event");
        exit();
    }

} else if (isset($_POST["cancel"])) {
    $eid = $_POST["cancel"];
    $oid = $_SESSION["id"];

    $sql7 = "SELECT * FROM provide_fund WHERE Event_ID = $eid AND OCA_ID = $oid";
    $rows7 = mysqli_query($conn, $sql7);
    $row7 = mysqli_fetch_assoc($rows7);
    $amount = $row7["Amount"];

    $sql8 = "SELECT * FROM approved_event e, club c WHERE e.Club = c.Name AND e.Event_ID = $eid";
    $rows8 = mysqli_query($conn, $sql8);
    $row8 = mysqli_fetch_assoc($rows8);
    $fundings = $row8["Fundings"];

    if ($amount > $fundings){
        $extra = $amount - $fundings;
        $sql9 = "UPDATE approved_event e, club c SET e.Fundings = e.Fundings - $fundings, c.Club_Reserve = c.Club_Reserve - $extra WHERE e.Club = c.Name AND e.Event_ID = $eid";
        $rows9 = mysqli_query($conn, $sql9);
    } else {
        $sql10 = "UPDATE approved_event SET Fundings = Fundings - $amount WHERE Event_ID = $eid";
        $rows10 = mysqli_query($conn, $sql10);
    }

    $sql11 = "DELETE FROM provide_fund WHERE Event_ID = $eid AND OCA_ID = $oid";
    $rows11 = mysqli_query($conn, $sql11);

    $sql12 = "UPDATE oca SET Fundings = Fundings - $amount, Fund_Balance = Fund_Balance + $amount WHERE OCA_ID = $oid";
    $rows12 = mysqli_query($conn, $sql12);

    header("Location: events.php?warn=Fund Withdrawn from Event");
    exit();
}
?>