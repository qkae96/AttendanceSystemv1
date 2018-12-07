<!DOCTYPE html>
<?php include 'php/getevent.php'; ?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="css/style.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <script src="js/jscript.js"></script>
  <title>Index</title>
  <style>
  body{
    margin: auto;
    text-align: center;
  }

  #footer{
    position: fixed;
    left: 0;
    bottom: 0;
    width: 100%;
    text-align: center;
  }
  </style>
</head>
<body>
  <nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container">
      <div class="navbar-header">
        <button type="button" class="navbar-toggle collapsed" data-toggle = "collapsed" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
          <span class="icon-bar"></span>
        </button>
        <a class="navbar-brand" href="index.php">Attendance System v1</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="event.php">Event</a></li>
          <li><a href="attendance.php">Attendance</a></li>
          <li><a href="profile.php">Profile</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <br><br><br><br>

  <div class="container">
    <h2>Events</h2>
    <div id="myCarousel" class="carousel slide" data-ride="carousel">
      <!-- Indicators -->
      <ol class="carousel-indicators">
        <li data-target="#myCarousel" data-slide-to="0" class="active"></li>
        <li data-target="#myCarousel" data-slide-to="1"></li>
        <li data-target="#myCarousel" data-slide-to="2"></li>
      </ol>

      <!-- Wrapper for slides -->
      <div class="carousel-inner">
        <div class="item">
          <img src="data:image/jpeg;base64,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" alt="Cisco" style="width:100%;">
        </div>

        <div class="item active">
          <img src="http://www.fsktm.um.edu.my/images/librariesprovider19/default-album/qs-subject-slider.jpeg?sfvrsn=0" alt="Subject Ranked" style="width:100%;">
        </div>

        <div class="item">
          <img src="http://www.fsktm.um.edu.my/images/librariesprovider19/default-album/qs-slider-um-rank.jpg?sfvrsn=0" alt="QS Ranking" style="width:100%;">
        </div>
      </div>

      <!-- Left and right controls -->
      <a class="left carousel-control" href="#myCarousel" data-slide="prev">
        <span class="glyphicon.glyphicon-chevron-left"></span>
        <span class="sr-only">Previous</span>
      </a>
      <a class="right carousel-control" href="#myCarousel" data-slide="next">
        <span class="glyphicon.glyphicon-chevron-right"></span>
        <span class="sr-only">Next</span>
      </a>
    </div>
  </div>

  <footer id="page-footer">
    <div id="footer">
      <div class="footer-bootom">
        <p>Copyright &copy; 2018 - Web Attendance System <a href="https://um.edu.my">University Malaya</a>. Designed by: <a href="https://www.linkedin.com/in/teowqinkae/">TQK</a> and <a href="https://www.linkedin.com/in/zhiyuteoh/"> TZY</a></p>
      </div>
    </div>
  </footer>

</body>
</html>
