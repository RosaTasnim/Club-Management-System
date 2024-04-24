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
        width: 150px;
        height: auto;
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
      $id = $_GET["id"];
      $sql1 = "SELECT * FROM registered_member WHERE Member_ID = $id";
      $rows1 = mysqli_query($conn, $sql1);
      $row1 = mysqli_fetch_assoc($rows1);
      
      $sql2 = "SELECT * FROM member_contact WHERE Member_ID = $id";
      $rows2 = mysqli_query($conn, $sql2);
      
      $temp = array();
      while ($row2 = mysqli_fetch_assoc($rows2)) {
          array_push($temp, $row2["Contact"]);
      }
      $contacts = implode(", ", $temp); ?>
    <div class="row my-5 pl-5 pr-5 d-flex justify-content-center">
      <div class="col-md-4">
        <div class="card" style="border-radius: .5rem;">
          <div class="card-body pt-4 pb-1">
            <form action="mbupdate.php" method="POST">
              <center><img src="misc/logo.png"></center>
              <h6 class="card-title mt-0 text-center text-dark">Office of Co-curricular Activities</h6>
              <h4 class="card-title py-2 text-center text-dark">Member Details</h4>
              <div class="form-group row mt-3">
                <label class="col-sm-4 col-form-label" for="inputId">Member ID</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputID" name="id" placeholder="<?php echo $row1["Member_ID"]; ?>" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="inputName">Full Name</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputName" name="name" placeholder="<?php echo $row1["Name"]; ?>" required>
                </div>
              </div>
              <fieldset class="form-group">
                <div class="row">
                  <label class="col-form-label col-sm-4 pt-0">Gender</label>
                  <div class="col-sm-4">
                    <div class="form-check form-check-inline">
                      <input type="radio" class="form-check-input" id="gender1" name="gender" value="Male" required>
                      <label class="form-check-label" for="gender1">Male</label>
                    </div>
                  </div>
                  <div class="col-sm-4">
                    <div class="form-check form-check-inline">
                      <input type="radio" class="form-check-input" id="gender2" name="gender" value="Female">
                      <label class="form-check-label" for="gender2">Female</label>
                    </div>
                  </div>
                </div>
              </fieldset>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="inputDate">Birth Date</label>
                <div class="col-sm-8">
                  <input type="date" class="form-control" id="inputDate" name="dob" value="<?php echo $row1["Birth_Date"]; ?>" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="inputDept">Department</label>
                <div class="col-sm-8">
                  <select class="form-control" id="inputDept" name="dept" required>
                    <option value="" selected><?php echo $row1["Department"]." Department"; ?></option>
                    <?php
                      $sql3 = "SELECT * FROM department";
                      $rows3 = mysqli_query($conn, $sql3); ?>
                    <?php while ($row3 = mysqli_fetch_assoc($rows3)) { ?>
                      <option value="<?php echo $row3['Name']; ?>"><?php echo $row3['Name']; ?></option>
                    <?php } ?>
                  </select>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="inputAdmit">Admission</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputAdmit" name="session" placeholder="<?php echo $row1["Admitted"]; ?>" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="inputCredits">Credits</label>
                <div class="col-sm-8">
                  <input type="number" class="form-control" id="inputCredits" name="credit" placeholder="<?php echo $row1["Credits"]; ?>" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="inputClub">Club</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputClub" name="club" value="<?php echo $row1["Club"]; ?>" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="inputDesig">Designation</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputDesig" name="desig" value="<?php echo $row1["Designation"]; ?>" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="inputJoined">Joined Date</label>
                <div class="col-sm-8">
                  <input type="date" class="form-control" id="inputJoined" name="joined" value="<?php echo $row1["Joined_Date"]; ?>" readonly>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="inputContact">Contacts</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="inputContact" name="contacts" placeholder="<?php echo $contacts; ?>" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="inputEmail">Email</label>
                <div class="col-sm-8">
                  <input type="email" class="form-control" id="inputEmail" name="email" placeholder="<?php echo $row1["Email"]; ?>" required>
                </div>
              </div>
              <div class="form-group row">
                <label class="col-sm-4 col-form-label" for="inputPassword">Password</label>
                <div class="col-sm-8">
                  <input type="password" class="form-control" id="inputPassword" name="password" placeholder="<?php echo $row1["Password"]; ?>" required>
                </div>
              </div>
              <div class="form-group row">
                <div class="col-sm-10 mt-2">
                  <?php if(isset($_GET["panel"])) {?>
                    <button class="btn btn-primary" name="update" value="<?php echo $id; ?>">Update</button>
                    <a class="btn btn-danger ml-2" href="panels.php?warn=Editing Panel Details Cancelled">Cancel</a>
                    <input type="hidden" name="panel">
                  <?php } else { ?>
                    <button class="btn btn-primary" name="update" value="<?php echo $id; ?>">Update</button>
                    <a class="btn btn-danger ml-2" href="members.php?warn=Editing Member Details Cancelled">Cancel</a>
                  <?php } ?>
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