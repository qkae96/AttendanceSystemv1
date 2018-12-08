<!DOCTYPE html>
<?php include 'getevent.php'; ?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
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

  #studenttable{
    margin-left: 10%;
  }

  #studentList{
    counter-reset: rowNumber;
    width: 50%;
    border-collapse: collapse;
    margin: auto;
    text-align: center;
    table-layout: fixed;
    float: left;
  }
  #studentListAdded{
    counter-reset: rowNumber;
    width: 50%;
    border-collapse: collapse;
    margin: auto;
    text-align: center;
    table-layout: fixed;
    float: right;
  }

  #studentList, #studentListAdded tbody{
    width: auto;
    display: block;
    overflow: auto;
    height: auto;
  }

  #studentList tr > td:first-child{
    counter-increment: rowNumber;
  }

  #studentList tr td:first-child::before{
    content: counter(rowNumber);
    min-width: 1em;
    margin-right: 0.5em;
  }

  #studentListAdded tr > td:first-child{
    counter-increment: rowNumber;
  }

  #studentListAdded tr td:first-child::before{
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
    background: #D3D3D3;
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
  $EventID = $_GET["modalEventID"];
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

  <div class="container" id="searchContainer">
    <form class="form-inline" name="studentListSearch" id="addStudentForm" onsubmit="return checkSearch()" autocomplete="off" autofocus>
      <div hidden>
        <label for="eventID">Event ID:</label>
        <input type="text" class="form-control" id="EventID" name="EventID" value="<?=$EventID?>">
        <label for="startTime">Event Start Time:</label>
        <input type="time" class="form-control" id="startTime" name="startTime" value="<?=$startTime?>">
        <label for="endTime">Event End Time:</label>
        <input type="time" class="form-control" id="endTime" name="endTime" value="<?=$endTime?>">
        <label for="date">Event Date:</label>
        <input type="date" class="form-control" id="date" name="date" value="<?=$date?>">
      </div>
      <div class="form-group">
        <label for="inputLabel">Name:</label>
        <input type="text" class="form-control" name="name" id="searchinput" placeholder="Search here" onkeyup="showResult()" autofocus>
        <button type="button" class="btn btn-default" onclick="goToEvent()">Save</button>
        <button type="button" class="btn btn-danger" onclick="discardStudentList()">Cancel</button>
      </div>
    </form>
  </div>

  <br><br>

  <div class="form-group" id="studenttable">
    <?php
      $conn = connectTo();
      $sql="SELECT * FROM profile WHERE ProfileType = 'user'";

      $result = mysqli_query($conn,$sql);
      ?>
      <table class="table table-striped" id="studentList">
      <tr>
      <th hidden>ProfileID</th>
      <th>No</th>
      <th>TagID</th>
      <th>Name</th>
      <th>Matric No</th>
      <th class="Action" colspan="2">Action</th>
      </tr>
    <?php
      while($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          ?>
          <td></td>
          <?php
          echo "<td hidden>" . $row['ProfileID'] . "</td>";
          echo "<td>" . $row['TagID'] . "</td>";
          echo "<td>" . $row['Name'] . "</td>";
          echo "<td>" . $row['MatricNo'] . "</td>";
          ?>
          <td><button class="btn-success" name="addStudent" type="button" onclick="addStudent()"><span class="glyphicon glyphicon-plus"></span></button></td>
          <td><button class=btn-danger name=removeStudent type=button onclick="removeStudent()" data-toggle="modal" data-target="#removeStudent"><span class="glyphicon glyphicon-remove"></span></button></td>
          <?php
          echo "</tr>";
      }
      ?>
      </table>
    <?php
      mysqli_close($conn);
      ?>
  </div>

  <div class="form-group" id="studenttableadded">
    <?php
      $conn = connectTo();
      $sql="SELECT attendance.AttendanceID, attendance.CheckIn, attendance.TagID, profile.Name, profile.MatricNo FROM attendance LEFT JOIN profile ON attendance.TagID = profile.TagID WHERE attendance.EventID = $EventID";

      $result = mysqli_query($conn,$sql);
      ?>
      <table class="table table-striped" id="studentListAdded">
      <tr>
      <th>No</th>
      <th>TagID</th>
      <th>Name</th>
      <th>Matric No</th>
      </tr>
    <?php
      while($row = mysqli_fetch_assoc($result)) {
          echo "<tr>";
          ?>
          <td></td>
          <?php
          echo "<td>" . $row['TagID'] . "</td>";
          echo "<td>" . $row['Name'] . "</td>";
          echo "<td>" . $row['MatricNo'] . "</td>";
          echo "</tr>";
      }
      ?>
      </table>
    <?php
      mysqli_close($conn);
      ?>
  </div>



<footer id="page-footer">
  <div id="footer">
    <div class="footer-bootom">
      <!-- <p>Copyright &copy; 2018 - Web Attendance System <a href="https://um.edu.my">University Malaya</a>. Designed by: <a href="https://www.linkedin.com/in/teowqinkae/">TQK</a> and <a href="https://www.linkedin.com/in/zhiyuteoh/"> TZY</a></p> -->
    </div>
  </div>
</footer>

  <script>
function showResult() {
// Declare variables
  var input, filter, table, tr, td, i, txtValue;
  input = document.getElementById("searchinput");
  filter = input.value.toUpperCase();
  table = document.getElementById("studenttable");
  tr = table.getElementsByTagName("tr");

  // Loop through all table rows, and hide those who don't match the search query
  for (i = 0; i < tr.length; i++) {
    td = tr[i].getElementsByTagName("td")[3];
    if (td) {
      txtValue = td.textContent || td.innerText;
      if (txtValue.toUpperCase().indexOf(filter) > -1) {
        tr[i].style.display = "";
      } else {
        tr[i].style.display = "none";
      }
    }
  }
}

function addStudent(){
  var t = document.getElementById('studenttable');
  t.onclick = function(event){
    event = event||window.event;
    var target = event.target||event.srcElement;
    while(target&&target.nodeName!='TR'){
      target = target.parentElement;
    }
    var cells = target.cells;
    if (!cells.length||target.parentNode.nodeName=='thead') {
      return;
    }
    let w = cells[1].innerHTML;
    let x = cells[2].innerHTML;
    var y = document.getElementById('EventID').value;
    window.location.href = "addstudent.php?tagID="+x+"&evtID="+y+"&profileID="+w;
    alert("Done");
  }
}

function removeStudent(){
  var t = document.getElementById('studenttable');
  t.onclick = function(event){
    event = event||window.event;
    var target = event.target||event.srcElement;
    while(target&&target.nodeName!='TR'){
      target = target.parentElement;
    }
    var cells = target.cells;
    if (!cells.length||target.parentNode.nodeName=='thead') {
      return;
    }
    let x = cells[2].innerHTML;
    var y = document.getElementById('EventID').value;
    window.location.href = "removestudent.php?tagID="+x+"&evtID="+y;
    alert("Done");
  }
}

  </script>
</body>
</html>
