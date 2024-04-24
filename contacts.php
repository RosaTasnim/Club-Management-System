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

    .profile {
      width: 150px;
      height: 150px;
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
    $pid = $_SESSION["id"];
    $sql1 = "SELECT *, s.Name AS Sponsor FROM contact c, unverified_sponsor s, approved_event e WHERE c.Sponsor = s.Name AND c.Event_ID = e.Event_ID AND c.Panel_ID = $pid";
    $rows1 = mysqli_query($conn, $sql1); ?>
  <div class="container">
    <div class="row mt-5 ml-2 mr-2">
      <?php while($row = mysqli_fetch_assoc($rows1)) {?>
        <?php 
          $sponsor = $row["Sponsor"];
          $sql2 = "SELECT * FROM tsponsor_contact WHERE Sponsor = '$sponsor'";
          $rows2 = mysqli_query($conn, $sql2); 

          $temp = array();
          while($row2 = mysqli_fetch_assoc($rows2)) {
            array_push($temp, $row2["Contact"]);
          } 
          $contacts = implode(', ', $temp); ?>
        <div class="col-md-4 my-3">
          <div class="card" style="border-radius: .5rem;">
            <div class="card-body py-3">
              <div class="d-flex flex-column align-items-center text-center">
                <img src="misc/profile.jpg" class="d-flex flex-column align-items-center profile rounded-circle">
              </div>
              <h4 class="card-title py-2 text-center"><?php echo $row["Sponsor"]; ?></h4><hr>
              <h6 class="card-text m-2 pl-4 text-dark"><b>Agent : </b><?php echo $row["Agent"]; ?></h6>
              <h6 class="card-text m-2 pl-4 text-dark"><b>Sponsor : </b><?php echo $row["Name"]; ?></h6><hr>
              <h6 class="card-text m-2 pl-4 text-dark"><b>Email : </b><?php echo $row["Email"]; ?></h6>
              <h6 class="card-text m-2 pl-4 text-dark"><b>Contacts : </b><?php echo $contacts; ?></h6><hr>
              <form class="form-inline m-2 pl-4" action="reqcontact.php" method="POST">
                <button class="btn btn-primary py-1" name="refer" value="<?php echo $pid; ?>">Refer</button>
                <button class="btn btn-danger py-1 ml-3" name="defer" value="<?php echo $pid; ?>">Defer</button>
                <input type="hidden" name="sponsor" value="<?php echo $row["Sponsor"]; ?>">
              </form>
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