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
    $id = $_SESSION["id"];
    $sql1 = "SELECT *, s.Fundings AS Sp_Fundings, e.Name AS Event, e.Fundings AS Funds FROM verified_sponsor s, give_fund g, approved_event e WHERE g.Sponsor = s.Name AND g.Event_ID = e.Event_ID AND g.OCA_ID = $id";
    $rows1 = mysqli_query($conn, $sql1); ?>
  <div class="container">
    <div class="row mt-1 ml-2 mr-2">
      <?php while($row1 = mysqli_fetch_assoc($rows1)) { ?>
        <div class="col-md-4 p-2">
          <div class="card text-light bg-dark" style="border-radius: .5rem;">
            <div class="card-body py-3">
              <center><img class="card-text" src="misc/dlogo.png"></center>
              <h6 class="card-title text-center text-secondary">Office of Co-curricular Activities</h6>
              <h4 class="card-title text-center py-2"><?php echo $row1["Sponsor"]; ?></h4><hr>
              <p class="card-text m-2 pl-2"><b>Agent : </b><?php echo $row1["Agent"]; ?></p>
              <p class="card-text m-2 pl-2"><b>Designation : </b><?php echo $row1["Designation"]; ?></p>
              <p class="card-text m-2 pl-2"><b>Email : </b><?php echo $row1["Email"]; ?></p><hr>
              <p class="card-text m-2 pl-2"><b>Event Fundings : </b><?php echo $row1["Sp_Fundings"]; ?> taka</p>
              <p class="card-text m-2 pl-2"><b>Fund Balance : </b><?php echo $row1["Fund_Balance"]; ?> taka</p><hr>
              <p class="card-text m-2 pl-2"><b>Event : </b><?php echo $row1["Event"]; ?></p>
              <p class="card-text m-2 pl-2"><b>Funds : </b><?php echo $row1["Funds"]; ?> taka</p>
              <p class="card-text m-2 pl-2"><b>Event Cost : </b><?php echo $row1["Event_Cost"]; ?> taka</p>
              <?php if($row1["Approved"] == "Yes") { ?>
                <p class="card-text m-2 pl-2"><b>Fund Received : </b><?php echo $row1["Amount"]; ?> taka</p>
              <?php } else { ?>
                <p class="card-text m-2 pl-2"><b>Fund Provided : </b><?php echo $row1["Amount"]; ?> taka</p>
              <?php } ?><hr>
              <?php if($row1["Approved"] == "Yes") { ?>
                <form class="form-inline m-2 pl-2" action="reqfunding.php" method="POST">
                  <button class="btn btn-secondary py-1" name="accept" value="<?php echo $row1["Sponsor"]; ?>" disabled>Accepted</button>
                  <button class="btn btn-outline-light py-1 ml-2" name="reject" value="<?php echo $row1["Sponsor"]; ?>">Reject</button>
                  <input type="hidden" name="event" value="<?php echo $row1["Event_ID"]; ?>">
                </form>
              <?php } else { ?>
                <form class="form-inline m-2 pl-2" action="reqfunding.php" method="POST">
                  <button class="btn btn-outline-light py-1" name="accept" value="<?php echo $row1["Sponsor"]; ?>">Accept</button>
                  <button class="btn btn-secondary py-1 ml-2" name="reject" value="<?php echo $row1["Sponsor"]; ?>">Reject</button>
                  <input type="hidden" name="event" value="<?php echo $row1["Event_ID"]; ?>">
                </form>
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