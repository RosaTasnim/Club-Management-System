<?php
include('dbconnect.php');
include('session.php');


if (isset($_POST["accept"])) {
    //storing unregistered member attributes
    $id = $_POST["accept"];
    $sql1 = "SELECT * FROM unregistered_member WHERE Member_ID = $id";
    $rows1 = mysqli_query($conn, $sql1);
    $row1 = mysqli_fetch_assoc($rows1);

    $member_id = $row1["Member_ID"];
    $name = $row1["Name"];
    $gender = $row1["Gender"];
    $dob = $row1["Birth_Date"];
    $dept = $row1["Department"];
    $admit = $row1["Admitted"];
    $credit = $row1["Credits"];
    $email = $row1["Email"];
    $password = $row1["Password"];
    $club = $_SESSION["club"];
    $joined = date("Y-m-d");
    $desig = "Member";

    //storing unregistered member contacts
    $sql2 = "SELECT Contact FROM tmember_contact WHERE Member_ID = $member_id";
    $rows2 = mysqli_query($conn, $sql2);

    $temp = array();
    while ($row2 = mysqli_fetch_assoc($rows2)) {
        array_push($temp, $row2["Contact"]);
    }
    $tcontacts = implode(", ", $temp);

    //inserting attributes into registered_member
    $sql3 = "INSERT INTO registered_member VALUES ($member_id, '$name', '$gender', '$dob', '$dept', '$admit', $credit, '$club', '$joined', '$desig', '$email', '$password')";
    $rows3 = mysqli_query($conn, $sql3);

    //inserting contacts into registered member contacts
    $contacts = explode(", ", $tcontacts);
    foreach ($contacts as $contact) {
        $sql4 = "INSERT INTO member_contact VALUES ($member_id, '$contact')";
        $rows4 = mysqli_query($conn, $sql4);
    }

    //inserting into moderate
    $sql5 = "SELECT * FROM request_membership WHERE Member_ID = $member_id";
    $rows5 = mysqli_query($conn, $sql5);
    while ($row5 = mysqli_fetch_assoc($rows5)) {
        $panel_id = $row5["Panel_ID"];
        $sql6 = "INSERT INTO moderate VALUES ($member_id, $panel_id)";
        $rows6 = mysqli_query($conn, $sql6);
    }

    //inserting into manage
    $sql7 = "SELECT * FROM oca";
    $rows7 = mysqli_query($conn, $sql7);
    while ($row7 = mysqli_fetch_assoc($rows7)) {
        $oca_id = $row7["OCA_ID"];
        $sql8 = "INSERT INTO manage VALUES ($member_id, $oca_id)";
        $rows8 = mysqli_query($conn, $sql8);
    }

    //deleting unregistered member request
    $sql9 = "DELETE FROM unregistered_member WHERE Member_ID = $member_id";
    $rows9 = mysqli_query($conn, $sql9);

    header("Location: membership.php?msg=Member Request Accepted");
    exit();

} else if (isset($_POST["reject"])) {
    //unregistered member contacts & request membership gets auto deleted by foreign key constraint
    $id = $_POST["reject"];
    $sql10 = "DELETE FROM unregistered_member WHERE Member_ID = $id";
    $rows10 = mysqli_query($conn, $sql10);

    header("Location: membership.php?error=Member Request Rejected");
    exit();
}
?>