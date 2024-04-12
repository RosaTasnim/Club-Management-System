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
  <div class="row my-5 mx-5 px-5 d-flex justify-content-center">
    <div class="col-md-4 mt-5 px-4">
      <div class="card px-2" style="border-radius: .5rem;">
        <div class="card-body pt-3 pb-1">
          <form action="reqevent.php" method="POST">
            <center><img src="misc/logo.png"></center>
            <h6 class="card-title mt-0 text-center text-dark"><?php echo $_SESSION["club"]; ?></h6>
            <h4 class="card-title p-2 text-center text-dark">Event Request</h4>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="inputName">Event Name</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="inputName" name="name" placeholder="Event Name" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="inputDate">Event Date</label>
              <div class="col-sm-8">
                <input type="date" class="form-control" id="inputDate" name="date" value="Event Date" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="inputVenue">Event Venue</label>
              <div class="col-sm-8">
                <input type="text" class="form-control" id="inputVenue" name="venue" placeholder="Enter Venue" required>
              </div>
            </div>
            <div class="form-group row">
              <label class="col-sm-4 col-form-label" for="inputFee">Entry Fee</label>
              <div class="col-sm-8">
                <input type="number" class="form-control" id="inputFee" name="entry" placeholder="Expected Entry Fee" required>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-10 mt-2">
                <button class="btn btn-primary" name="request">Submit</button>
                <a class="btn btn-danger ml-3" href="profile.php?warn=Event Request Cancelled">Cancel</a>
              </div>
            </div>
          </form>
        </div>
      </div>
    </div>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>