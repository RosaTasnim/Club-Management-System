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
      width: 250px;
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
    $club = $_SESSION["club"];
    $sql1 = "SELECT *, o.Name AS OCA, e.Name AS Event FROM unapproved_event e, request_event r, oca o WHERE e.Event_ID = r.Event_ID AND r.OCA_ID = o.OCA_ID AND r.Approved = 'Yes' AND r.Proposed_Club = '$club'";
    $rows1 = mysqli_query($conn, $sql1); ?>
  <div class="container">
    <div class="row mt-5 ml-2 mr-2">
      <?php while($row1 = mysqli_fetch_assoc($rows1)) {?>
        <div class="col-md-4 my-3">
          <div class="card" style="border-radius: .5rem;">
            <div class="card-body py-3">
              <center><img src="misc/logo.png"></center>
              <h6 class="card-title text-center text-dark"><?php echo $row1["Proposed_Club"]; ?></h6>
              <h4 class="card-title py-2 text-center"><?php echo $row1["Event"]; ?></h4><hr>
              <h6 class="card-text m-2 pl-4 text-dark"><b>Date : </b><?php echo date("jS M, Y", strtotime($row1["Date"])); ?></h6>
              <h6 class="card-text m-2 pl-4 text-dark"><b>Venue : </b><?php echo $row1["Venue"]; ?></h6>
              <h6 class="card-text m-2 pl-4 text-dark"><b>Entry Fee : </b><?php echo $row1["Entry_Fee"]; ?> taka</h6>
              <h6 class="card-text m-2 pl-4 text-dark"><b>Approved : </b><?php echo $row1["OCA"]; ?></h6><hr>
              <?php if (!isset($_POST["manage"]) || $_POST["manage"] != $row1["Event_ID"]) { ?>
                <form class="form-inline m-2 pl-4" action="organize.php?warn=Providing Event Details" method="POST">
                  <button class="btn btn-primary mt-2" name="manage" value="<?php echo $row1["Event_ID"]; ?>">Manage</button>
                  <button class="btn btn-danger mt-2 ml-3" formaction="process.php" name="postpone" value="<?php echo $row1["Event_ID"]; ?>">Postpone</button>
                </form>
              <?php } else { ?>
                <form action="process.php" method="POST">
                  <div class="form-group row px-4">
                    <label class="col-sm-5 col-form-label" for="inputCost"><b>Event Cost</b></label>
                    <div class="col-sm-7">
                      <input type="number" class="form-control text-center" id="inputCost" name="cost" placeholder="Event Cost" required>
                    </div>
                  </div>
                  <div class="form-group row px-4">
                    <label class="col-sm-5 col-form-label" for="inputCapacity"><b>Capacity</b></label>
                    <div class="col-sm-7">
                      <input type="number" class="form-control text-center" id="inputCapacity" name="capacity" placeholder="Capacity" required>
                    </div>
                  </div>
                  <hr>
                  <div class="form-group row px-4">
                    <div class="col-sm-10">
                      <button class="btn btn-primary mt-2" name="launch" value="<?php echo $row1["Event_ID"]; ?>">Launch</button>
                      <a class="btn btn-danger mt-2 ml-3" href="organize.php?error=Event Details Cancelled">Cancel</a>
                    </div>
                  </div>
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