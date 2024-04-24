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
    $club = $_SESSION["club"];
    $sql1 = "SELECT * FROM registered_member WHERE Club = '$club' AND Designation NOT IN ('President', 'Vice President', 'General Secretary', 'Treasurer')";
    $rows1 = mysqli_query($conn, $sql1); ?>
  <div class="container-fluid mt-5">
  <?php if ($_SESSION["view"] == "Panel") { ?>
    <table class="table table-sm table-dark table-bordered table-striped table-hover text-center">
  <?php } else { ?>
    <table class="table table-dark table-bordered table-striped table-hover text-center">
  <?php } ?>
      <h5 class="text-secondary bg-dark mb-0 py-3 text-center"><center><img src="misc/dlogo.png"></center><?php echo $_SESSION["club"]; ?> Members</h5>
      <thead>
        <tr>
          <th>Member ID</th>
          <th>Name</th>
          <th>Gender</th>
          <th>BirthDay</th>
          <th>Department</th>
          <th>Session</th>
          <th>Credits</th>
          <th>Joined Date</th>
          <th>Designation</th>
          <th>Email</th>
          <th>Contacts</th>
          <?php if ($_SESSION["view"] == "Panel") { ?>
            <th>Password</th>
            <th>Edit</th>
          <?php } ?>
        </tr>
      </thead>
      <tbody>
        <?php while($row1 = mysqli_fetch_assoc($rows1)) { ?>
          <?php 
            $id = $row1["Member_ID"];
            $sql2 = "SELECT * FROM member_contact WHERE Member_ID = $id";
            $rows2 = mysqli_query($conn, $sql2); 

            $temp = array();
            while($row2 = mysqli_fetch_assoc($rows2)) {
              array_push($temp, $row2["Contact"]);
            } 
            $contacts = implode(', ', $temp)?>
          <tr>
            <td><?php echo $row1["Member_ID"]; ?></td>
            <td><?php echo $row1["Name"]; ?></td>
            <td><?php echo $row1["Gender"]; ?></td>
            <td><?php echo date("jS M, Y", strtotime($row1["Birth_Date"])); ?></td>
            <td><?php echo $row1["Department"]; ?></td>
            <td><?php echo $row1["Admitted"]; ?></td>
            <td><?php echo $row1["Credits"]; ?></td>
            <td><?php echo date("jS M, Y", strtotime($row1["Joined_Date"])); ?></td>
            <td><?php echo $row1["Designation"]; ?></td>
            <td><?php echo $row1["Email"]; ?></td>
            <td><?php echo $contacts; ?></td>
            <?php if ($_SESSION["view"] == "Panel") { ?>
              <td><?php echo $row1["Password"]; ?></td>
              <td>
                <form class="form-inline justify-content-center my-0 py-0" action="modedit.php?warn=Editing Member Details" method="GET">
                  <button class="btn btn-secondary py-1" name="id" value="<?php echo $row1["Member_ID"]; ?>">Edit</button>
                </form>
              </td>
            <?php } ?>
          </tr>
        <?php } ?>
        <tr><td colspan="13"></td></tr>
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