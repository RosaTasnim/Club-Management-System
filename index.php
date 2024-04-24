<?php
include('dbconnect.php');
include('navbar.php');
?>

<!doctype html>
<html lang="en">

<head>
  <title>Welcome Page</title>
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

    html {
      overflow: scroll;
      overflow-x: hidden;
    }

    img {
      width: 75px;
      height: auto;
    }

    hr {
      border: 1px solid grey;
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
  <div class="container">
    <div class="row">
      <div class="container d-flex justify-content-center">
        <div class="col-md-6 mt-2 p-2">
          <h1 class="text-center text-white bg-dark mt-5 mb-0 pt-3 pb-0">BRAC University Clubs</h1>
          <h6 class="text-center text-light bg-dark mt-0 py-3 px-5">
            Welcome to The BRAC University Club Page<br>
            Here, You Can Find Info About The Clubs of BRAC University<br>
            Also, You Can Sponsor For Ongoing Club Events<br>
          </h6>
          <h2 class="text-center text-light bg-dark mt-5 mb-3 p-2">Ongoing Club Events</h2>
        </div>
      </div>
    </div>
    <div class="container">
      <div class="row">
        <?php
          $sql = 'SELECT * FROM approved_event';
          $rows = mysqli_query($conn, $sql); ?>

        <?php while ($row = mysqli_fetch_assoc($rows)) { ?>
          <div class="col-md-4 p-2">
            <div class="card text-light bg-dark" style="border-radius: .5rem;">
              <div class="card-body">
                <center><img class="card-text" src="misc/dlogo.png"></center>
                <h6 class="card-title text-center text-secondary"><?php echo $row["Club"]; ?></h6>
                <h4 class="card-title text-center py-2"><?php echo $row["Name"]; ?></h4><hr>
                <p class="card-text m-2 pl-2"><b>Date : </b><?php echo date("jS M, Y", strtotime($row["Date"])); ?></p>
                <p class="card-text m-2 pl-2"><b>Venue : </b><?php echo $row["Venue"]; ?></p>
                <p class="card-text m-2 pl-2"><b>Entry Fee : </b><?php echo $row["Entry_Fee"]; ?> taka</p><hr>
              </div>
            </div>
          </div>
        <?php } ?>
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