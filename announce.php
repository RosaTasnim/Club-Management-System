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
    <div class="col-md-4 mt-5">
      <div class="card px-3" style="border-radius: .5rem;">
        <div class="card-body pt-3 pb-1">
          <form action="post.php" method="POST">
            <center><img src="misc/logo.png"></center>
            <?php if ($_SESSION["view"] == "Department") { ?>
              <h6 class="card-title mt-0 text-center text-dark"><?php echo $_SESSION["name"]; ?></h6>
            <?php } else { ?>
              <h6 class="card-title mt-0 text-center text-dark"><?php echo $_SESSION["club"]; ?></h6>
            <?php } ?>
            <h4 class="card-title p-2 text-center text-dark">Announcement</h4>
            <div class="form-group row">
              <div class="col-sm-12">
                <textarea class="form-control" rows="6" name="post" placeholder="Start Writing Your Post From Here" required></textarea>
              </div>
            </div>
            <div class="form-group row">
              <div class="col-sm-10 mt-3">
                <button class="btn btn-primary" name="submit">Announce</button>
                <a class="btn btn-danger ml-3" href="profile.php?warn=Announcement Cancelled">Cancel</a>
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