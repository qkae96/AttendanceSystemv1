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
  <title>Event</title>
  <style>
  #eventTable{
    width:90%;
    border-collapse: collapse;
    margin: auto;
    text-align: center;
  }

  th{
    text-align: center;
  }

  #addEventButton{
    float: right;
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
          <li class="active"><a href="event.php">Event</a></li>
          <li><a href="attendance.php">Attendance</a></li>
          <li><a href="profile.php">Profile</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <br><br><br><br>

  <div style="width: 8%;">
    <button type="button" class="btn btn-outline-primary" id="addEventButton" onclick="addEvent()">+</button>
  </div>

  <div>
  <table class="table table-striped" id="eventTable" style="cursor: pointer;" onclick="getEventID()">
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
    <tbody>
    <?php
      $Event = new Event;
      $conn = connectTo();
  		$sql="SELECT * FROM event";
  		$result = mysqli_query($conn,$sql);

  		while($row = mysqli_fetch_array($result)) {
          ?>
          <tr>
    		    <td><?php echo $row['EventID'] ?></td>
            <?php
    		    echo "<td>" . $row['EventCode'] . "</td>";
    		    echo "<td>" . $row['EventName'] . "</td>";
    		    echo "<td>" . $row['EventDate'] . "</td>";
    		    echo "<td>" . $row['EventStartTime'] . "</td>";
    		    echo "<td>" . $row['EventEndTime'] . "</td>";
    		    echo "<td>" . $row['EventVenue'] . "</td>";
            ?>
            <td><button class=btn-primary name=updateEvent type=button  data-toggle="modal" data-target="#updateEvent">Update</button></td>
            <td><button class=btn-success name=attendance type=button>Attendance</button></td>
            <td><button class=btn-danger name=deleteEvent type=button onclick="deleteEvent.php">Delete</button></td>
  		    </tr>
          <?php
  			}
      ?>
    </tbody>
  </table>
  </div>
  <div class="modal fade" id="updateEvent" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Event</h4>
        </div>
        <form class="modal-body" style="margin: auto;">
          <div>
            <label>Event Code: </label>
            <input type="text" id="modalEventCode">
          </div>
          <div>
            <label>Event Name: </label>
            <input type="text" id="modalEventName">
          </div>
          <div>
            <label>Event Date: </label>
            <input type="Date" id="modalEventDate">
          </div>
          <div>
            <label>Event Start Time: </label>
            <input type="time" id="modalStartTime">
          </div>
          <div>
            <label>Event End Time: </label>
            <input type="time" id="modalEndTime">
          </div>
          <div>
            <label>Event Veue: </label>
            <input type="text" id="modalEventVenue">
          </div>
        </form>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
    </div>
  </div>
  </div>
</body>
</html>
