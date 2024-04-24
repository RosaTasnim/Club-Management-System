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
    $sql1 = "SELECT s.Name AS Sponsor, s.Agent AS Agent, s.Designation AS Designation, s.Fundings AS Fundings, s.Fund_Balance AS Balance, e.Event_ID AS Event_ID, e.Name AS Event, g.Amount AS Amount, g.Approved AS Approved FROM verified_sponsor s, give_fund g, approved_event e WHERE g.Sponsor = s.Name AND g.Event_ID = e.Event_ID AND g.OCA_ID = $id";
    $rows1 = mysqli_query($conn, $sql1); ?>

  <div class="container-fluid mt-5">
    <table class="table table-dark table-bordered table-striped table-hover text-center">
      <h5 class="text-secondary bg-dark mb-0 py-3 text-center"><center><img src="misc/dlogo.png"></center>Fund Requests</h5>
      <thead>
        <tr>
          <th>Sponsor</th>
          <th>Agent</th>
          <th>Designation</th>
          <th>Event Fundings</th>
          <th>Fund Balance</th>
          <th>Sponsor Event</th>
          <th>Fund Amount</th>
          <th>Accept</th>
          <th>Reject</th>
        </tr>
      </thead>
      <tbody>
        <?php while($row1 = mysqli_fetch_assoc($rows1)) { ?>
          <tr>
            <td><?php echo $row1["Sponsor"]; ?></td>
            <td><?php echo $row1["Agent"]; ?></td>
            <td><?php echo $row1["Designation"]; ?></td>
            <td><?php echo $row1["Fundings"]; ?></td>
            <td><?php echo $row1["Balance"]; ?></td>
            <td><?php echo $row1["Event"]; ?></td>
            <td><?php echo $row1["Amount"]; ?></td>
            <td>
              <?php if($row1["Approved"] == "Yes") { ?>
                <form class="form-inline justify-content-center my-0 py-0" action="reqfunding.php" method="POST">
                  <button class="btn btn-secondary py-1" name="accept" value="<?php echo $row1["Sponsor"]; ?>" disabled>Accepted</button>
                  <input type="hidden" name="event" value="<?php echo $row1["Event_ID"]; ?>">
                </form>
              <?php } else { ?>
                <form class="form-inline justify-content-center my-0 py-0" action="reqfunding.php" method="POST">
                  <button class="btn btn-secondary py-1" name="accept" value="<?php echo $row1["Sponsor"]; ?>">Accept</button>
                  <input type="hidden" name="event" value="<?php echo $row1["Event_ID"]; ?>">
                </form>
              <?php } ?>
            </td>
            <td>
              <form class="form-inline justify-content-center my-0 py-0" action="reqfunding.php" method="POST">
                <button class="btn btn-light py-1" name="reject" value="<?php echo $row1["Sponsor"]; ?>">Reject</button>
                <input type="hidden" name="event" value="<?php echo $row1["Event_ID"]; ?>">
              </form>
            </td>
          </tr>
        <?php } ?>
        <tr><td colspan="9"></td></tr>
      </tbody>
    </table>
  </div>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
</body>

</html>