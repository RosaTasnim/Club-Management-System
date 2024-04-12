<?php
include('dbconnect.php');
include('session.php');
include('navbar.php');
?>

<!doctype html>
<html lang="en">

<head>
  <title>Home Page</title>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
  <style>
    body {
      background-image: url('misc/campus.jpg');
      background-repeat: no-repeat;
      background-attachment: fixed;
      background-size: cover;
    }

    img {
      width: 75px;
      height: auto;
    }

    hr {
      border: 1px solid grey;
    }

    html {
      overflow: scroll;
      overflow-x: hidden;
    }

    ::-webkit-scrollbar {
      width: 0;
      background: transparent;
    }

    ::-webkit-scrollbar-thumb {
      background: #FF0000;
    }
  </style>
</head>

<body>
  <?php
    $sql1 = "SELECT * FROM approved_event";
    $rows1 = mysqli_query($conn, $sql1); ?>
  <div class="container">
    <div class="row mt-3 ml-2 mr-2">
      <?php while($row1 = mysqli_fetch_assoc($rows1)) {?>
        <?php 
          $club = $row1["Club"];
          $sql2 = "SELECT * FROM club WHERE Name = '$club'";
          $rows2 = mysqli_query($conn, $sql2);
          $row2 = mysqli_fetch_assoc($rows2); ?>
        <div class="col-md-4 p-2">
          <div class="card text-light bg-dark" style="border-radius: .5rem;">
            <div class="card-body">
              <center><img class="card-text" src="misc/dlogo.png"></center>
              <h6 class="card-title text-center text-secondary"><?php echo $row1["Club"]; ?></h6>
              <h4 class="card-title text-center py-2"><?php echo $row1["Name"]; ?></h4><hr>
              <p class="card-text m-2 pl-2"><b>Date : </b><?php echo date("jS M, Y", strtotime($row1["Date"])); ?></p>
              <p class="card-text m-2 pl-2"><b>Venue : </b><?php echo $row1["Venue"]; ?></p>
              <p class="card-text m-2 pl-2"><b>Entry Fee : </b><?php echo $row1["Entry_Fee"]; ?> taka</p><hr>
              <?php if ($_SESSION["view"] == "Oca") {?>
                <h6 class="card-text m-2 pl-2"><b>Club Reserve : </b><?php echo $row2["Club_Reserve"]; ?> taka</h6>
                <h6 class="card-text m-2 pl-2"><b>Event Cost : </b><?php echo $row1["Event_Cost"]; ?> taka</h6>
                <h6 class="card-text m-2 pl-2"><b>Event Fundings : </b><?php echo $row1["Fundings"]; ?> taka</h6>
                <h6 class="card-text m-2 pl-2"><b>Event Earnings : </b><?php echo $row1["Earnings"]; ?> taka</h6><hr>
                <h6 class="card-text m-2 pl-2"><b>Capacity : </b><?php echo $row1["Capacity"]; ?> members</h6>
                <h6 class="card-text m-2 pl-2"><b>Participants : </b><?php echo $row1["Participants"]; ?> members</h6><hr>
              <?php } ?>
              <?php if ($_SESSION["view"] == "Member" || $_SESSION["view"] == "Panel") {
                $id = $_SESSION["id"];
                $eid = $row1["Event_ID"];

                $sql2 = "SELECT * FROM participate WHERE Event_ID = $eid AND Member_ID = $id";
                $rows2 = mysqli_query($conn, $sql2); ?>

                <?php if (mysqli_num_rows($rows2) == 0) { ?>
                  <form class="form-inline m-2 pl-2" action="participate.php" method="POST">
                    <button class="btn btn-outline-light mt-2" name="join" value="<?php echo $row1["Event_ID"]; ?>">Participate</button>
                    <button class="btn btn-secondary mt-2 ml-3" name="leave" value="<?php echo $row1["Event_ID"]; ?>" disabled>Cancel</button>
                  </form>
                <?php } else { ?>
                  <form class="form-inline m-2 pl-2" action="participate.php" method="POST">
                    <button class="btn btn-secondary mt-2" name="join" value="<?php echo $row1["Event_ID"]; ?>" disabled>Participated</button>
                    <button class="btn btn-outline-light mt-2 ml-3" name="leave" value="<?php echo $row1["Event_ID"]; ?>">Cancel</button>
                  </form>
                <?php } ?>

              <?php } else if ($_SESSION["view"] == "Oca") { 
                $id = $_SESSION["id"];
                $eid = $row1["Event_ID"];

                $sql3 = "SELECT * FROM provide_fund WHERE Event_ID = $eid AND OCA_ID = $id";
                $rows3 = mysqli_query($conn, $sql3); ?>

                <?php if (mysqli_num_rows($rows3) == 0) { ?>
                  <?php if (!isset($_POST["provide"]) || $_POST["provide"] != $row1["Event_ID"]) { ?>
                    <form class="form-inline m-2 pl-2" action="events.php?warn=Providing Event Fund" method="POST">
                      <button class="btn btn-outline-light mt-2" name="provide" value="<?php echo $row1["Event_ID"]; ?>">Provide</button>
                      <button class="btn btn-secondary mt-2 ml-3" name="cancel" value="<?php echo $row1["Event_ID"]; ?>" disabled>Cancel</button>
                    </form>
                  <?php } else { ?>
                    <form class="form-inline m-2 pl-2 pr-2" action="providefund.php" method="POST">
                      <input type="number" class="form-inline text-center py-1 mt-2" name="amount" placeholder="Amount" style="width: 100px;" required>
                      <button class="btn btn-outline-light mt-2 ml-2" name="fund" value="<?php echo $row1["Event_ID"]; ?>">Fund</button>
                      <a class="btn btn-secondary mt-2 ml-2" href="events.php?error=Event Fund Cancelled">Cancel</a>
                    </form>
                  <?php } ?>
                <?php } else { ?>
                  <form class="form-inline m-2 pl-2 pr-2" action="providefund.php" method="POST">
                    <button class="btn  btn-secondary mt-2" name="provide" value="<?php echo $row1["Event_ID"]; ?>" disabled>Provided</button>
                    <button class="btn btn-outline-light mt-2 ml-3" name="cancel" value="<?php echo $row1["Event_ID"]; ?>">Cancel</button>
                  </form>
                <?php } ?>

              <?php } else if ($_SESSION["view"] == "Sponsor") { 
                $name = $_SESSION["name"];
                $eid = $row1["Event_ID"];

                $sql4 = "SELECT * FROM give_fund WHERE Event_ID = $eid AND Sponsor = '$name'";
                $rows4 = mysqli_query($conn, $sql4); ?>
                <?php if (mysqli_num_rows($rows4) == 0) { ?>
                  <?php if (!isset($_POST["give"]) || $_POST["give"] != $row1["Event_ID"]) {?>
                    <form class="form-inline m-2 pl-2" action="events.php?warn=Providing Event Fund" method="POST">
                      <button class="btn btn-outline-light mt-2" name="give" value="<?php echo $row1["Event_ID"]; ?>">Sponsor</button>
                      <button class="btn btn-secondary mt-2 ml-3" name="cancel" value="<?php echo $row1["Event_ID"]; ?>" disabled>Cancel</button>
                    </form>
                  <?php } else { ?>
                    <form class="form-inline m-2 pl-2 pr-2" action="givefund.php" method="POST">
                      <input type="number" class="form-inline text-center py-1 mt-2" name="amount" placeholder="Amount" style="width: 100px;" required>
                      <button class="btn btn-outline-light mt-2 ml-2" name="fund" value="<?php echo $row1["Event_ID"]; ?>">Fund</button>
                      <a class="btn btn-secondary mt-2 ml-2" href="events.php?error=Event Fund Cancelled">Cancel</a>
                    </form>
                  <?php } ?>
                <?php } else { ?>
                  <?php
                    $name = $_SESSION["name"];
                    $eid = $row1["Event_ID"];

                    $sql5 = "SELECT * FROM give_fund WHERE Event_ID = $eid AND Sponsor = '$name'";
                    $rows5 = mysqli_query($conn, $sql5);
                    $row5 = mysqli_fetch_assoc($rows5); 
                    $approved = $row5["Approved"]; ?>
                  <?php if ($approved == "Yes") { ?>
                    <form class="form-inline m-2 pl-2 pr-2" action="givefund.php" method="POST">
                      <button class="btn  btn-secondary mt-2" name="give" value="<?php echo $row1["Event_ID"]; ?>" disabled>Sponsored</button>
                      <button class="btn btn-outline-light mt-2 ml-3" name="cancel" value="<?php echo $row1["Event_ID"]; ?>">Cancel</button>
                    </form>
                  <?php } else { ?>
                    <form class="form-inline m-2 pl-2 pr-2" action="givefund.php" method="POST">
                      <button class="btn  btn-secondary mt-2" name="give" value="<?php echo $row1["Event_ID"]; ?>" disabled>Pending</button>
                      <button class="btn btn-outline-light mt-2 ml-3" name="cancel" value="<?php echo $row1["Event_ID"]; ?>">Cancel</button>
                    </form>
                  <?php } ?>
                <?php } ?>
              <?php } ?>
            </div>
          </div>
        </div>
      <?php } ?>
    </div>
  </div> 
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>