<?php
include("dbconnect.php");
include("session.php");

if(isset($_POST["accept"])){
    $oid = $_SESSION["id"];
    $sponsor = $_POST["accept"];
    $eid = $_POST["event"];

    $sql1 = "SELECT * FROM give_fund WHERE Event_ID = $eid AND Sponsor = '$sponsor' AND OCA_ID = $oid";
    $rows1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($rows1);
    $amount = $row1["Amount"];

    $sql2 = "SELECT * FROM approved_event e, club c WHERE e.Club = c.Name AND Event_ID = $eid";
    $rows2 = mysqli_query($conn, $sql2);
    $row2 = mysqli_fetch_assoc($rows2);

    $cost = $row2["Event_Cost"];
    $fundings = $row2["Fundings"];
    $fund = $cost - $fundings;

    if ($amount > $fund) {
        $extra = $amount - $fund;
        $sql3 = "UPDATE approved_event e, club c SET e.Fundings = e.Fundings + $fund, c.Club_Reserve = c.Club_Reserve + $extra WHERE e.Club = c.Name AND Event_ID = $eid";
        $rows3 = mysqli_query($conn, $sql3);
    } else {
        $sql4 = "UPDATE approved_event SET Fundings = Fundings + $amount WHERE Event_ID = $eid";
        $rows4 = mysqli_query($conn, $sql4);
    }

    $sql5 = "UPDATE give_fund SET Approved = 'Yes' WHERE Event_ID = $eid AND Sponsor = '$sponsor' AND OCA_ID = $oid";
    $rows5 = mysqli_query($conn, $sql5);

    $sql6 = "DELETE FROM give_fund WHERE Event_ID = $eid AND Sponsor = '$sponsor' AND OCA_ID <> $oid";
    $rows6 = mysqli_query($conn, $sql6);

    $sql7 = "UPDATE verified_sponsor SET Fundings = Fundings + $amount, Fund_Balance = Fund_Balance - $amount WHERE Name = '$sponsor'";
    $rows7 = mysqli_query($conn, $sql7);

    header("Location: funds.php?msg=Sponsor Fund Accepted");
    exit();

} else if (isset($_POST["reject"])) {
    $oid = $_SESSION["id"];
    $sponsor = $_POST["reject"];
    $eid = $_POST["event"];

    $sql8 = "SELECT * FROM give_fund WHERE Event_ID = $eid AND Sponsor = '$sponsor' AND OCA_ID = $oid";
    $rows8 = mysqli_query($conn, $sql8);
    $row8 = mysqli_fetch_assoc($rows8);
    $amount = $row8["Amount"];
    $approved = $row8["Approved"];

    $sql9 = "SELECT * FROM approved_event e, club c WHERE e.Club = c.Name AND Event_ID = $eid";
    $rows9 = mysqli_query($conn, $sql9);
    $row9 = mysqli_fetch_assoc($rows9);
    $fundings = $row9["Fundings"];

    if ($approved == "Yes") {
        if ($amount > $fundings){
            $extra = $amount - $fundings;
            $sql10 = "UPDATE approved_event e, club c SET e.Fundings = e.Fundings - $fundings, c.Club_Reserve = c.Club_Reserve - $extra WHERE e.Club = c.Name AND Event_ID = $eid";
            $rows10 = mysqli_query($conn, $sql10);
        } else {
            $sql11 = "UPDATE approved_event SET Fundings = Fundings - $amount WHERE Event_ID = $eid";
            $rows11 = mysqli_query($conn, $sql11);
        }
        $sql12 = "UPDATE verified_sponsor SET Fundings = Fundings - $amount, Fund_Balance = Fund_Balance + $amount WHERE Name = '$sponsor'";
        $rows12 = mysqli_query($conn, $sql12);
    }

    $sql13 = "DELETE FROM give_fund WHERE Event_ID = $eid AND Sponsor = '$sponsor'";
    $rows13 = mysqli_query($conn, $sql13);

    header("Location: funds.php?error=Sponsor Fund Rejected");
    exit();
}
?>
