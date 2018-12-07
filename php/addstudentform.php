<!DOCTYPE html>
<?php include 'getevent.php'; ?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="/AttendanceSystemv1/css/bootstrap.min.css">
  <link rel="stylesheet" href="/AttendanceSystemv1/css/bootstrap-theme.min.css">
  <link rel="stylesheet" href="/AttendanceSystemv1/css/style.css">
  <script src="/AttendanceSystemv1/js/jquery.min.js"></script>
  <script src="/AttendanceSystemv1/js/bootstrap.min.js"></script>
  <script src="/AttendanceSystemv1/js/jscript.js"></script>
  <title>Add New Event</title>
  <style>
  #singleEvent{
    width:70%;
    border-collapse: collapse;
    margin: auto;
    text-align: center;
  }

  th{
    text-align: center;
  }

  #studentList{
    counter-reset: rowNumber;
    width: 50%;
    border-collapse: collapse;
    margin: auto;
    text-align: center;
  }

  #studentList tr > td:first-child{
    counter-increment: rowNumber;
  }

  #studentList tr td:first-child::before{
    content: counter(rowNumber);
    min-width: 1em;
    margin-right: 0.5em;
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
        <a class="navbar-brand" href="/AttendanceSystemv1/index.php">Attendance System v1</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li class="active"><a href="/AttendanceSystemv1/event.php">Event</a></li>
          <li><a href="/AttendanceSystemv1/attendance.php">Attendance</a></li>
          <li><a href="/AttendanceSystemv1/profile.php">Profile</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <br><br><br><br>

  <?php
  $EventID = $_POST["modalEventID"];
   ?>

  <div>
  <table class="table table-striped" id="singleEvent" style="cursor: pointer;">
    <thead>
      <tr>
        <th class="EventID" hidden>Event ID</th>
        <th class="EventCode">Event Code</th>
        <th class="EventName">Event Name</th>
        <th class="EventDate">Event Date</th>
        <th class="EventStartTime">Event Start Time</th>
        <th class="EventEndTime">Event End Time</th>
        <th class="EventVenue">Venue</th>
      </tr>
    </thead>
    <tbody>
    <?php
      $Event = new Event;
      $conn = connectTo();
  		$sql="SELECT * FROM event WHERE EventID = $EventID";
  		$result = mysqli_query($conn,$sql);

  		while($row = mysqli_fetch_array($result)) {
          ?>
          <tr>
    		    <td id="tableEventID" hidden><?php echo $row['EventID'] ?></td>
            <?php
    		    echo "<td>" . $row['EventCode'] . "</td>";
    		    echo "<td>" . $row['EventName'] . "</td>";
    		    echo "<td>" . $row['EventDate'] . "</td>";
    		    echo "<td>" . $row['EventStartTime'] . "</td>";
    		    echo "<td>" . $row['EventEndTime'] . "</td>";
    		    echo "<td>" . $row['EventVenue'] . "</td>";
            ?>
  		    </tr>
          <?php
  			}
      ?>
    </tbody>
  </table>
  </div>

  <br>

  <div class="container" id="inputContainer">
    <form class="form-inline" name="attendanceform" id="addStudentForm" onsubmit="return checkInput()" method="post" action="/AttendanceSystemv1/php/addstudent.php" autocomplete="off" autofocus>
      <div hidden>
        <label for="eventID">Event ID:</label>
        <input type="text" class="form-control" id="EventID" name="EventID" value="<?=$inputEventID?>">
        <label for="startTime">Event Start Time:</label>
        <input type="time" class="form-control" id="startTime" name="startTime" value="<?=$startTime?>">
        <label for="endTime">Event End Time:</label>
        <input type="time" class="form-control" id="endTime" name="endTime" value="<?=$endTime?>">
        <label for="date">Event Date:</label>
        <input type="date" class="form-control" id="date" name="date" value="<?=$date?>">
      </div>
      <div class="form-group" id="livesearch">
        <label for="inputLabel">Name:</label>
        <input type="text" class="form-control" name="TagID" id="tagID" placeholder="Search here" onkeyup="showResult(this.value)" autofocus>
        <button type="submit" class="btn btn-default">Add</button>
        <button type="button" class="btn btn-danger" onclick="discardAttendance()">Cancel</button>
      </div>
    </form>
  </div>

  <br>

  <?php
    $conn = connectTo();
    $sql="SELECT attendance.AttendanceID, attendance.CheckIn, attendance.TagID, profile.Name, profile.MatricNo FROM attendance LEFT JOIN profile ON attendance.TagID = profile.TagID WHERE attendance.EventID = $EventID";

    $result = mysqli_query($conn,$sql);
    ?>
    <table class="table table-striped" id="studentList">
    <tr>
    <th>No</th>
    <th hidden>AttendanceID</th>
    <th>TagID</th>
    <th>Name</th>
    <th>Matric No</th>
    <th class="Action" colspan="1">Action</th>
    </tr>
  <?php
    while($row = mysqli_fetch_assoc($result)) {
        echo "<tr>";
        ?>
        <td></td>
        <?php
        echo "<td hidden>" . $row['AttendanceID'] . "</td>";
        echo "<td>" . $row['TagID'] . "</td>";
        echo "<td>" . $row['Name'] . "</td>";
        echo "<td>" . $row['MatricNo'] . "</td>";
        echo "</tr>";
        ?>
        <td><button class=btn-danger name=deleteStudent type=button onclick="deleteStudent()" data-toggle="modal" data-target="#deleteStudent"> Delete </button></td>
        <?php
    }
    ?>
    </table>
  <?php
    mysqli_close($conn);
    ?>

<footer id="page-footer">
  <div id="footer">
    <div class="footer-bootom">
      <p>Copyright &copy; 2018 - Web Attendance System <a href="https://um.edu.my">University Malaya</a>. Designed by: <a href="https://www.linkedin.com/in/teowqinkae/">TQK</a> and <a href="https://www.linkedin.com/in/zhiyuteoh/"> TZY</p>
    </div>
  </div>
</footer>

  <script>
  function showResult(str) {
    if (str.length==0) {
      document.getElementById("livesearch").innerHTML="";
      document.getElementById("livesearch").style.border="0px";
      return;
    }
    if (window.XMLHttpRequest) {
      // code for IE7+, Firefox, Chrome, Opera, Safari
      xmlhttp=new XMLHttpRequest();
    } else {  // code for IE6, IE5
      xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
    }
    xmlhttp.onreadystatechange=function() {
      if (this.readyState==4 && this.status==200) {
        document.getElementById("livesearch").innerHTML=this.responseText;
        document.getElementById("livesearch").style.border="1px solid #A5ACB2";
      }
    }
    xmlhttp.open("GET","livesearch.php?q="+str,true);
    xmlhttp.send();
  }
  </script>
</body>
</html>
