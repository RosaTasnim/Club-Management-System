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
    if ($_SESSION["view"] == "Member" || $_SESSION["view"] == "Panel") {
      $dept = $_SESSION["dept"];
      $club = $_SESSION["club"];
      $sql1 = "SELECT * FROM give_announcement WHERE Department = '$dept' AND Club = '$club'";
      $rows = mysqli_query($conn, $sql1);
    } else if ($_SESSION["view"] == "Advisor") {
      $club = $_SESSION["club"];
      $sql2 = "SELECT * FROM give_announcement WHERE Club = '$club' GROUP BY Post";
      $rows = mysqli_query($conn, $sql2);
    } else if ($_SESSION["view"] == "Department") {
      $dept = $_SESSION["name"];
      $sql3 = "SELECT * FROM give_announcement WHERE Department = '$dept' GROUP BY Post";
      $rows = mysqli_query($conn, $sql3); 
    } else {
      $sql4 = "SELECT * FROM give_announcement GROUP BY Post";
      $rows = mysqli_query($conn, $sql4);
    }?>
  <div class="container mt-5">
    <div class='row'>
      <?php while ($row = mysqli_fetch_assoc($rows)) { ?>
        <?php 
          $tables = array("advisor", "department");
          foreach ($tables as $table) {
            $pub = $row["Publisher"];
            $sql5 = "SELECT * FROM $table WHERE Email = '$pub'";
            $chkrows = mysqli_query($conn, $sql5);
            $chkrow = mysqli_fetch_assoc($chkrows);
            if ($chkrow) {
              break;
            }
          } 
        ?>
        <div class='col-md-6'>
          <div class="card mt-5 px-3" style="border-radius: .5rem;">
            <div class="card-body">
              <?php if ($table == "advisor") { ?>
                <h4 class='card-title text-center'>From <?php echo  $chkrow["Designation"]; ?>, <?php echo  $row["Club"]; ?></h4>
              <?php } else { ?>
                <h4 class='card-title text-center'>From <?php echo  $chkrow["Designation"]; ?>, <?php echo  $row["Department"]; ?></h4>
              <?php } ?><hr>
              <h6 class='card-text'><?php echo $row["Post"]; ?></h6>
              <p class="card-text text-muted text-right mt-3 mb-0">Posted On <?php echo date("jS M, Y", strtotime($row["Date"])); ?></p>
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