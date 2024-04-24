<?php
include('dbconnect.php');
?>

<nav class="navbar py-0 sticky-top navbar-expand-lg navbar-dark bg-dark">
  <a class="navbar-brand ml-md-3 ml-sm-0" href="https://www.bracu.ac.bd/">
    <img src="misc/dlogo.png" alt="BRAC University" style="width:60px;">
  </a>
  <button class="navbar-toggler d-lg-none" type="button" data-toggle="collapse" data-target="#collapsibleNavId" aria-controls="collapsibleNavId" aria-expanded="false" aria-label="Toggle navigation"></button>
  <div class="collapse navbar-collapse" id="collapsibleNavId">
    <ul class="navbar-nav ml-auto mt-0">
      <?php if (!isset($_SESSION["view"])) { ?>
        <li class="nav-item active mx-1">
          <a class="nav-link" href="index.php">Home<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="login.php">Log In</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="signup.php">Sign Up</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="sponsor.php">Sponsor</a>
        </li>

      <?php } else if ($_SESSION["view"] == "Member") { ?>
        <li class="nav-item active mx-1">
          <a class="nav-link" href="announcement.php">Home<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="clubevents.php">ClubEvent</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="clubpanels.php">ClubPanel</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="events.php">Events</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="departments.php">Departments</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="clubs.php">Clubs</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="advisors.php">Advisors</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="profile.php">Profile</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="logout.php">Log Out</a>
        </li>

      <?php } else if ($_SESSION["view"] == "Panel") { ?>
        <li class="nav-item active mx-1">
          <a class="nav-link" href="announcement.php">Home<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="clubevents.php">ClubEvent</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="clubpanels.php">ClubPanel</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="clubmembers.php">ClubMember</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="events.php">Events</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="departments.php">Departments</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="clubs.php">Clubs</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="advisors.php">Advisors</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="membership.php">Membership</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="contacts.php">Contacts</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="request.php">Request</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="profile.php">Profile</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="logout.php">Log Out</a>
        </li>

      <?php } else if ($_SESSION["view"] == "Advisor") { ?>
        <li class="nav-item active mx-1">
          <a class="nav-link" href="announcement.php">Home<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="clubevents.php">ClubEvent</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="clubpanels.php">ClubPanel</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="clubmembers.php">ClubMember</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="events.php">Events</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="departments.php">Departments</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="clubs.php">Clubs</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="advisors.php">Advisors</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="officers.php">Officers</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="sponsors.php">Sponsors</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="organize.php">Organize</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="announce.php">Announce</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="profile.php">Profile</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="logout.php">Log Out</a>
        </li>

      <?php } else if ($_SESSION["view"] == "Oca") { ?>
        <li class="nav-item active mx-1">
          <a class="nav-link" href="announcement.php">Home<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="departments.php">Departments</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="clubs.php">Clubs</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="advisors.php">Advisors</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="panels.php">Panels</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="members.php">Members</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="officers.php">Officers</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="sponsors.php">Sponsors</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="events.php">Events</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="sponsorship.php">Sponsorship</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="funds.php">Funds</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="approval.php">Approval</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="profile.php">Profile</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="logout.php">Log Out</a>
        </li>

      <?php } else if ($_SESSION["view"] == "Department") { ?>
        <li class="nav-item active mx-1">
          <a class="nav-link" href="announcement.php">Home<span class="sr-only">(current)</span></a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="departments.php">Departments</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="clubs.php">Clubs</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="advisors.php">Advisors</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="panels.php">Panels</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="members.php">Members</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="officers.php">Officers</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="sponsors.php">Sponsors</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="events.php">Events</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="announce.php">Announce</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="profile.php">Profile</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="logout.php">Log Out</a>
        </li>

        <?php } else if ($_SESSION["view"] == "Sponsor") { ?>
        <li class="nav-item mx-1">
          <a class="nav-link" href="departments.php">Departments</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="clubs.php">Clubs</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="officers.php">Officers</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="events.php">Events</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="profile.php">Profile</a>
        </li>
        <li class="nav-item mx-1">
          <a class="nav-link" href="logout.php">Log Out</a>
        </li>
        
      <?php } ?>
    </ul>
  </div>
</nav>

<!--Alert Message-->
<?php if (isset($_GET['error'])) { ?>
  <div class="container d-flex justify-content-center">
    <div class="alert alert-danger alert-dismissible text-center" role="alert">
      <b><?php echo $_GET['error']; ?></b>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
<?php } else if (isset($_GET['warn'])) { ?>
  <div class="container d-flex justify-content-center">
    <div class="alert alert-warning alert-dismissible text-center" role="alert">
      <b><?php echo $_GET['warn']; ?></b>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
<?php } else if (isset($_GET['msg'])) { ?>
  <div class="container d-flex justify-content-center">
    <div class="alert alert-success alert-dismissible text-center" role="alert">
      <b><?php echo $_GET['msg']; ?></b>
      <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
      </button>
    </div>
  </div>
<?php } ?>