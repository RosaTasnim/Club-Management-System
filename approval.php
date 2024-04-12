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
    $sql1 = "SELECT *, e.Name AS Event, p.name AS Panel FROM unapproved_event e, request_event r, registered_member p, club c WHERE r.Event_ID = e.Event_ID AND r.Member_ID = p.Member_ID AND r.Proposed_Club = c.Name AND r.OCA_ID = $id";
    $rows1 = mysqli_query($conn, $sql1); ?>
  <div class="container">
    <div class="row mt-5 ml-2 mr-2">
      <?php while($row1 = mysqli_fetch_assoc($rows1)) { ?>
        <div class="col-md-4 p-2">
          <div class="card text-light bg-dark" style="border-radius: .5rem;">
            <div class="card-body">
              <center><img class="card-text" src="misc/dlogo.png"></center>
              <h6 class="card-title text-center text-secondary"><?php echo $row1["Proposed_Club"]; ?> Request</h6>
              <h4 class="card-title text-center py-2"><?php echo $row1["Event"]; ?></h4><hr>
              <p class="card-text m-2 pl-2"><b>Date : </b><?php echo date("jS M, Y", strtotime($row1["Date"])); ?></p>
              <p class="card-text m-2 pl-2"><b>Venue : </b><?php echo $row1["Venue"]; ?></p>
              <p class="card-text m-2 pl-2"><b>Entry Fee : </b><?php echo $row1["Entry_Fee"]; ?> taka</p>
              <p class="card-text m-2 pl-2"><b>Advisor : </b><?php echo $row1["Advisor"]; ?></p><hr>
              <p class="card-text m-2 pl-2"><b>Requested : </b><?php echo $row1["Panel"]; ?></p>
              <p class="card-text m-2 pl-2"><b>Designation : </b><?php echo $row1["Designation"]; ?></p><hr>
              <?php if($row1["Approved"] == "No") { ?>
                <form class="form-inline m-2 pl-2" action="reqapproval.php" method="POST">
                  <button class="btn btn-outline-light mt-2" name="approve" value="<?php echo $row1["Event_ID"]; ?>">Approve</button>
                  <button class="btn btn-secondary mt-2 ml-3" name="decline" value="<?php echo $row1["Event_ID"]; ?>">Decline</button>
                  <input type="hidden" name="id" value="<?php echo $_SESSION["id"]; ?>">
                </form>
              <?php } else { ?>
                <form class="form-inline m-2 pl-2" action="reqapproval.php" method="POST">
                  <button class="btn btn-secondary mt-2" name="approve" value="<?php echo $row1["Event_ID"]; ?>" disabled>Approved</button>
                  <button class="btn btn-outline-light mt-2 ml-3" name="decline" value="<?php echo $row1["Event_ID"]; ?>">Decline</button>
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