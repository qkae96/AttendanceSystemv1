<!DOCTYPE html>
<?php include 'php/getevent.php'; ?>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="stylesheet" href="css/bootstrap.min.css">
  <link rel="stylesheet" href="css/bootstrap-theme.min.css">
  <link rel="stylesheet" type="text/css" href="css/style.css">
  <script src="js/jquery.min.js"></script>
  <script src="js/bootstrap.min.js"></script>
  <title>Event</title>
	<style>
		table{
			width:90%;
			border-collapse: collapse;
      margin: auto;
		}
		/* table, td, th{
			border: 1px solid black;
			padding: 5px;
      text-align: center;
		} */
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
          <li class="active"><a href="event.php">Event</a></li>
          <li><a href="attendance.php">Attendance</a></li>
          <li><a href="profile.php">Profile</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <br><br><br><br>

  <table class="table table-striped">
    <thead>
      <tr>
        <th class="EventID">Event ID</th>
        <th class="EventCode">Event Code</th>
        <th class="EventName">Event Name</th>
        <th class="EventDate">Event Date</th>
        <th class="EventStartTime">Event Start Time</th>
        <th class="EventEndTime">Event End Time</th>
        <th class="EventVenue">Venue</th>
        <th class="Action" colspan="3">Action</th>
      </tr>
    </thead>
    <tbody class="eventTable">
    <?php
      $Event = new Event;
      $conn = connectTo();
  		$sql="SELECT * FROM event";
  		$result = mysqli_query($conn,$sql);

  		while($row = mysqli_fetch_array($result)) {
  		    // echo "<tr>";
    		  //   echo "<td>" . $row['EventID'] . "</td>";
    		  //   echo "<td>" . $row['EventCode'] . "</td>";
    		  //   echo "<td>" . $row['EventName'] . "</td>";
    		  //   echo "<td>" . $row['EventDate'] . "</td>";
    		  //   echo "<td>" . $row['EventStartTime'] . "</td>";
    		  //   echo "<td>" . $row['EventEndTime'] . "</td>";
    		  //   echo "<td>" . $row['EventVenue'] . "</td>";
          //   echo "<td><button class=btn-primary name=updateEvent type=button value=updateEvent()>Update</button></td><td><button class=btn-success name=attendance type=button value=attendance()>Attendance</button></td><td><button class=btn-danger name=deleteEvent type=button value=deleteEvent()>Delete</button></td>";
  		    // echo "</tr>";
          ?>
          <tr class="row-eventTable">
    		    <td id="EventID"><?php echo $row['EventID'] ?></td>
            <?php
    		    echo "<td>" . $row['EventCode'] . "</td>";
    		    echo "<td>" . $row['EventName'] . "</td>";
    		    echo "<td>" . $row['EventDate'] . "</td>";
    		    echo "<td>" . $row['EventStartTime'] . "</td>";
    		    echo "<td>" . $row['EventEndTime'] . "</td>";
    		    echo "<td>" . $row['EventVenue'] . "</td>";
            ?>
            <td><button class=btn-primary name=updateEvent type=button onclick="updateEvent(this)">Update</button></td>
            <td><button class=btn-success name=attendance type=button onclick="attendance(this)">Attendance</button></td>
            <td><button class=btn-danger name=deleteEvent type=button onclick="deleteEvent(this)">Delete</button></td>
  		    </tr>
          <?php
  			}
      ?>
    </tbody>
  </table>
    <div>
        <a href="php/eventform.php">Create new event</a>
    </div>
    <div>
        <a href="DeleteEvent.php">Delete existing event</a>
    </div>
    </body>
    <script>
    function updateEvent(x){
      alert("Row index is: " + x.rowIndex);
      location.href('php/updateEvent.php');
    }

    function attendance(){
      location.href('php/attendance.php');
    }

    function deleteEvent(){
      location.href('php/deleteEvent.php');
    }
    // var table = document.getElementsByTagName('table')[0];
    // var tbody = table.getElementsByTagName('tbody')[0];
    // tbody.onclick = function(e){
    //   e = e || window.event;
    //   var data = [];
    //   var target = e.srcElement || e.target;
    //   while (target&&target.nodeName!=="TD") {
    //     target = target.parentNode;
    //   }
    //   if (target) {
    //     var cells = target.getElementsByTagName('EventID');
    //     for (var i = 0; i < cells.length; i++) {
    //       data.push(cells[i].innerHTML);
    //     }
    //   }
    //   alert(data);
    // }

    function alertInnerHTML(e){
      e = e || window.event;//IE
      alert(this.innerHTML);
    }
    var theTbl = document.getElementById('table');
    for(var i=0;i<table.length;i++){
      for(var j=0;j<table.rows[i].cells.length;j++){
        table.rows[i].cells[j].onclick = alertInnerHTML;
      }
    }
    </script>
</html>
