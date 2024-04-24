<?php
include('dbconnect.php');
include('session.php');
include('navbar.php');
?>

<!doctype html>
<html lang="en">

<head>
  <title>HomePage</title>
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

    .profile {
      width: 150px;
      height: 150px;
    }

    .main-body {
      padding: 15px;
    }

    .card {
      box-shadow: 0 1px 3px 0 rgba(0, 0, 0, .1), 0 1px 2px 0 rgba(0, 0, 0, .06);
    }

    .card {
      position: relative;
      display: flex;
      flex-direction: column;
      min-width: 0;
      word-wrap: break-word;
      background-color: #fff;
      background-clip: border-box;
      border: 0 solid rgba(0, 0, 0, .125);
      border-radius: .25rem;
    }

    .card-body {
      flex: 1 1 auto;
      min-height: 1px;
      padding: 1rem;
    }

    .gutters-sm {
      margin-right: -8px;
      margin-left: -8px;
    }

    .gutters-sm>.col,
    .gutters-sm>[class*=col-] {
      padding-right: 8px;
      padding-left: 8px;
    }

    .mb-3,
    .my-3 {
      margin-bottom: 1rem !important;
    }

    .bg-gray-300 {
      background-color: #e2e8f0;
    }

    .h-100 {
      height: 100% !important;
    }

    .shadow-none {
      box-shadow: none !important;
    }
  </style>
</head>

<body>
  <div class="container mt-2">
    <div class="main-body">
      <div class="row gutters-sm">
        <div class="col-md-4">
          <!--Leftside Card-->
          <div class="card bg-dark text-light py-2 px-3 mt-5">
            <div class="card-body">
              <!--Leftside Card Picture-->
              <div class="d-flex flex-column align-items-center text-center">
                <?php if (isset($_SESSION["gender"]) && $_SESSION["gender"] == "Male") { ?>
                  <img src="misc/profileM.jpg" class="profile rounded-circle">
                <?php } else if (isset($_SESSION["gender"]) && $_SESSION["gender"] == "Female") { ?>
                  <img src="misc/profileF.jpg" class="profile rounded-circle">
                <?php } else { ?>
                  <img src="misc/profile.jpg" class="profile rounded-circle">
                <?php } ?>
                <!--Leftside Card Details-->
                <div class="mt-3">
                  <?php if ($_SESSION["view"] == "Member" || $_SESSION["view"] == "Panel") { ?>
                    <h3 class="mt-3 mb-3"><?php echo $_SESSION["name"]; ?></h3>
                    <h4 class="text-secondary"><?php echo $_SESSION["desig"]; ?></h4>
                    <h6 class="text-muted"><?php echo "Since, ".date("jS M Y", strtotime($_SESSION["joined"])); ?></h6>
                  <?php } else if ($_SESSION["view"] == "Advisor") { ?>
                    <h3 class="mt-3 mb-3"><?php echo $_SESSION["name"]; ?></h3>
                    <h4 class="text-secondary"><?php echo $_SESSION["desig"]; ?></h4>
                    <h6 class="text-muted"><?php echo "Supervisor, " . $_SESSION["club"]; ?></h6>
                  <?php } else if ($_SESSION["view"] == "Oca") { ?>
                    <h3 class="mt-3 mb-3"><?php echo $_SESSION["name"]; ?></h3>
                    <h4 class="text-secondary"><?php echo $_SESSION["desig"]; ?></h4>
                    <h6 class="text-muted">Office, Co-curricular Activities</h6>
                  <?php } else if ($_SESSION["view"] == "Department") { ?>
                    <h3 class="mt-3 mb-3"><?php echo $_SESSION["head"]; ?></h3>
                    <h4 class="text-secondary"><?php echo $_SESSION["desig"]; ?></h4>
                    <h6 class="text-muted"><?php echo "Head, " . $_SESSION["name"] . " Department"; ?></h6>
                  <?php } else { ?>
                    <h3 class="mt-3 mb-3"><?php echo $_SESSION["agent"]; ?></h3>
                    <h4 class="text-secondary"><?php echo $_SESSION["desig"]; ?></h4>
                    <h6 class="text-muted"><?php echo "Agent, " . $_SESSION["name"]; ?></h6>
                  <?php } ?>
                </div>
              </div>
            </div>
          </div>
        </div>

        <div class="col-md-8">
          <!--Rightside Card-->
          <div class="card mb-3 bg-dark text-light py-2 px-3">
            <div class="card-body">
              <!--Rightside Card Top-->
              <form action="profupdate.php" method="POST">
                <center><img src="misc/dlogo.png"></center>
                <?php if ($_SESSION["view"] == "Department") { ?>
                  <h6 class="text-center text-muted mb-4"><?php echo $_SESSION["name"] . " Department"; ?></h6>
                <?php } else if ($_SESSION["view"] == "Oca") { ?>
                  <h6 class="text-center text-muted mb-4">Co-curricular Activities</h6>
                <?php } else if ($_SESSION["view"] == "Sponsor") { ?>
                  <h6 class="text-center text-secondary mb-4"><?php echo $_SESSION["view"]; ?></h6>
                <?php } else { ?>
                  <h6 class="text-center text-muted mb-4"><?php echo $_SESSION["club"]; ?></h6>
                <?php } ?>
                <hr>
                <!--Member & Panel Card-->
                <?php if ($_SESSION["view"] == "Member" || $_SESSION["view"] == "Panel") { ?>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Student ID</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                      <input type="text" class="form-control" name="id" value="<?php echo $_SESSION["id"]; ?>" readonly>
                    </div>
                    <div class="col-sm-3">
                      <h6 class="mb-0">Department</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                      <select class="form-control" name="dept" required>
                        <option value="" selected><?php echo $_SESSION["dept"]." Department" ?></option>
                        <?php
                        $sql1 = "SELECT * FROM department";
                        $rows1 = mysqli_query($conn, $sql1);
                        ?>
                        <?php while ($row = mysqli_fetch_assoc($rows1)) { ?>
                          <option value="<?php echo $row['Name']; ?>"><?php echo $row['Name']; ?></option>
                        <?php } ?>
                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Birth Day</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                      <input type="date" class="form-control" name="dob" value="<?php echo $_SESSION["dob"]; ?>" required>
                    </div>
                    <div class="col-sm-3">
                      <h6 class="mb-0">Gender</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                      <select class="form-control" name="gender" required>
                        <option value="" selected><?php echo $_SESSION["gender"] ?></option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                      </select>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Admission Session</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                      <input type="text" class="form-control" name="session" placeholder="<?php echo $_SESSION["admit"]; ?>" required>
                    </div>
                    <div class="col-sm-3">
                      <h6 class="mb-0">Credits Completed</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                      <input type="number" class="form-control" name="credit" placeholder="<?php echo $_SESSION["credit"] . " Credits"; ?>" required>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Personal Email</h6>
                    </div>
                    <div class="col-sm-6 text-secondary font-size-sm">
                      <input type="email" class="form-control" name="email" placeholder="<?php echo $_SESSION["email"]; ?>" required>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Contact No.</h6>
                    </div>
                    <div class="col-sm-6 text-secondary font-size-sm">
                      <input type="text" class="form-control" name="contacts" placeholder="<?php echo $_SESSION["contacts"]; ?>" required>
                    </div>
                  </div>
                  <hr>
                <!--Department Card-->
                <?php } else if ($_SESSION["view"] == "Department") { ?>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Department</h6>
                    </div>
                    <div class="col-sm-3 text-secondary font-size-sm">
                      <input type="text" class="form-control" name="name" value="<?php echo $_SESSION["name"]?>" readonly> 
                    </div>
                    <div class="col-sm-3">
                      <h6 class="mb-0">Established Date</h6>
                    </div>
                    <div class="col-sm-3 text-secondary font-size-sm">
                      <input type="text" class="form-control" name="estb" value="<?php echo $_SESSION["estb"]; ?>" readonly> 
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Department Head</h6>
                    </div>
                    <div class="col-sm-3 text-secondary font-size-sm">
                      <input type="text" class="form-control" name="head" placeholder="<?php echo $_SESSION["head"]; ?>" required>
                    </div>
                    <div class="col-sm-3">
                      <h6 class="mb-0">Designation</h6>
                    </div>
                    <div class="col-sm-3 text-secondary font-size-sm">
                      <input type="text" class="form-control" name="desig" value="<?php echo $_SESSION["desig"]; ?>" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Official Email</h6>
                    </div>
                    <div class="col-sm-6 text-secondary font-size-sm">
                    <input type="email" class="form-control" name="email" placeholder="<?php echo $_SESSION["email"]; ?>" required>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Contact No.</h6>
                    </div>
                    <div class="col-sm-6 text-secondary font-size-sm">
                      <input type="text" class="form-control" name="contacts" placeholder="Not Disclosed" readonly>
                    </div>
                  </div>
                  <hr>
                <!--Advisor Card-->
                <?php } else if ($_SESSION["view"] == "Advisor") { ?>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Advisor ID</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                      <input type="text" class="form-control" name="id" value="<?php echo $_SESSION["id"]; ?>" readonly>
                    </div>
                    <div class="col-sm-3">
                      <h6 class="mb-0">Advising Club</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                      <input type="text" class="form-control" name="club" value="<?php echo $_SESSION["club"]; ?>" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Advisor Name</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                      <input type="text" class="form-control" name="name" placeholder="<?php echo $_SESSION["name"]; ?>" required>
                    </div>
                    <div class="col-sm-3">
                      <h6 class="mb-0">Designation</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                      <input type="text" class="form-control" name="desig" value="<?php echo $_SESSION["desig"]; ?>" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Contact Email</h6>
                    </div>
                    <div class="col-sm-6 text-secondary">
                      <input type="email" class="form-control" name="email" placeholder="<?php echo $_SESSION["email"]; ?>" required>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Contact No.</h6>
                    </div>
                    <div class="col-sm-6 text-secondary">
                      <input type="text" class="form-control" name="contacts" placeholder="<?php echo $_SESSION["contacts"]; ?>" required>
                    </div>
                  </div>
                  <hr>
                <!--Oca Card-->
                <?php } else if ($_SESSION["view"] == "Oca") { ?>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Officer ID</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                      <input type="text" class="form-control" name="id" value="<?php echo $_SESSION["id"]; ?>" readonly>
                    </div>
                    <div class="col-sm-2">
                      <h6 class="mb-0">Office</h6>
                    </div>
                    <div class="col-sm-4 text-secondary">
                      <input type="text" class="form-control" name="office" value="<?php echo "Co-curricular Activities"; ?>" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Officer Name</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                      <input type="text" class="form-control" name="name" placeholder="<?php echo $_SESSION["name"]; ?>" required>
                    </div>
                    <div class="col-sm-3">
                      <h6 class="mb-0">Designation</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                      <input type="text" class="form-control" name="desig" value="<?php echo $_SESSION["desig"]; ?>" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Fund Balance</h6>
                    </div>
                    <div class="col-sm-6 text-secondary">
                      <input type="text" class="form-control" name="balance" value="<?php echo $_SESSION["balance"]; ?>" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Event Fundings</h6>
                    </div>
                    <div class="col-sm-6 text-secondary">
                      <input type="text" class="form-control" name="fund" value="<?php echo $_SESSION["fund"]; ?>" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Contact Email</h6>
                    </div>
                    <div class="col-sm-6 text-secondary">
                      <input type="email" class="form-control" name="email" placeholder="<?php echo $_SESSION["email"]; ?>" required>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Contact No.</h6>
                    </div>
                    <div class="col-sm-6 text-secondary">
                      <input type="text" class="form-control" name="contacts" placeholder="<?php echo $_SESSION["contacts"]; ?>" required>
                    </div>
                  </div>
                  <hr>
                <!--Sponsor Card-->
                <?php } else { ?>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Sponsor</h6>
                    </div>
                    <div class="col-sm-9 text-secondary">
                      <input type="text" class="form-control" name="name" value="<?php echo $_SESSION["name"]; ?>" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Agent Name</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                      <input type="text" class="form-control" name="agent" placeholder="<?php echo $_SESSION["agent"]; ?>" required>
                    </div>
                    <div class="col-sm-3">
                      <h6 class="mb-0">Designation</h6>
                    </div>
                    <div class="col-sm-3 text-secondary">
                      <input type="text" class="form-control" name="desig" value="<?php echo $_SESSION["desig"]; ?>" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Fund Balance</h6>
                    </div>
                    <div class="col-sm-6 text-secondary">
                      <input type="number" class="form-control" name="balance" value="<?php echo $_SESSION["balance"]; ?>" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Event Fundings</h6>
                    </div>
                    <div class="col-sm-6 text-secondary">
                      <input type="number" class="form-control" name="fund" value="<?php echo $_SESSION["fund"]; ?>" readonly>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Contact Email</h6>
                    </div>
                    <div class="col-sm-6 text-secondary">
                      <input type="email" class="form-control" name="email" placeholder="<?php echo $_SESSION["email"]; ?>" required>
                    </div>
                  </div>
                  <hr>
                  <div class="row">
                    <div class="col-sm-3">
                      <h6 class="mb-0">Contact No.</h6>
                    </div>
                    <div class="col-sm-6 text-secondary">
                      <input type="text" class="form-control" name="contacts" placeholder="<?php echo $_SESSION["contacts"]; ?>" required>
                    </div>
                  </div>
                  <hr>
                <?php } ?>
                <?php if ($_SESSION["view"] != "Member") { ?>
                  <div class="row">
                    <div class="col-sm-12">
                      <center>
                        <button class="btn btn-outline-light mx-2">Update</button>
                        <a class="btn btn-secondary mx-2" href="profile.php?warn=Cancelled Editing Details">Cancel</a>
                      </center>
                    </div>
                  </div>
                <?php } ?>
              </form>
            </div>
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