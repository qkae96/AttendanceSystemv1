<?php
include 'getevent.php';
if(!isAdmin()){
	$_SESSION['msg'] = "You must log in first";
}if(isset($_GET['logout'])){
	session_destroy();
  unset($_SESSION['user']);
  header("location: ../index.php");
}
?>
<!DOCTYPE html>
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
        <a class="navbar-brand" href="/AttendanceSystemv1/admin/index.php">Attendance System v1</a>
      </div>
      <div id="navbar" class="navbar-collapse collapse">
        <ul class="nav navbar-nav navbar-right">
          <li><a href="/AttendanceSystemv1/admin/event.php">Event</a></li>
          <li><a href="/AttendanceSystemv1/admin/attendance.php">Attendance</a></li>
          <li><a href="/AttendanceSystemv1/admin/profile.php">Profile</a></li>
          <li><a href="#" data-toggle="modal" data-target="#logout-modal">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>
  <br><br><br><br>

	<!-- Logout Modal -->
	  <div class="modal fade" id="logout-modal" role="dialog">
	    <div class="modal-dialog">
	      <div class="modal-content">
	        <div class="modal-header">
	          <button type="button" class="close" data-dismiss="modal">&times;</button>
	          <h4 class="modal-title">Logout</h4>
	        </div>
	        <form class="modal-body" id="logoutform" method="post" action="/AttendanceSystemv1/admin/index.php?logout='1'">
	          <div hidden>
	            <label>Event ID: </label>
	            <input type="text" name="logout" id="logout" value="1" disabled>
	          </div>
	          <p>You are logging out?</p>
	          <div class="modal-footer">
	            <button type="submit" class="btn btn-default">Yes</button>
	            <button type="button" class="btn btn-default" data-dismiss="modal">No</button>
	          </div>
	        </form>
	      </div>
	    </div>
	  </div>

<div class="container" id="eventFormContainer">
  <form name="eventForm" id="event_form" method="post" action="addevent.php" onsubmit="return validateEventForm()" autocomplete="on">
		<div class="form-group row">
		    <label for="EventCode" class="col-sm-2">Event Code:</label>
			    <div class="col-sm-3">
			      <input type="text" class="form-control" name="EventCode" placeholder="Event Code">
			    </div>
		 </div>
		 <div class="form-group row">
		    <label for="EventName" class="col-sm-2">Event Name:</label>
			    <div class="col-sm-3">
			      <input type="text" class="form-control" name="EventName" placeholder="Event Name">
			    </div>
		 </div>
		 <div class="form-group row">
		 	<label for="EventDate" class="col-sm-2">Date:</label>
		 	<div class="col-sm-3">
		 		<input type="Date" class="form-control" name="EventDate">
		 	</div>
		 </div>
		 <div class="form-group row">
		 	<label for="Time" class="col-sm-2">Time:</label>
		 	<div class="col-sm-2">
		 		Start time:<input type="time" class="form-control" name="EventStartTime">
		 	</div>
		 	<div class="col-sm-2">
		 		End time:<input type="time" class="form-control" name="EventEndTime">
		 	</div>
		 </div>
		 <div class="form-group row">
		 	<label for="Venue" class="col-sm-2">Venue:</label>
		 	<div class="col-sm-3">
		 		<!-- <input type="text" class="form-control" name="EventVenue" id="EventVenue" placeholder="Place held" onkeyup="suggestVenue()"> -->
        <select id="json-dropdown" name="EventVenue">
          <option></option><p><p>
        </select>
		 	</div>
		 </div>
		<div class="form-group row">
      <label for="Repetition" class="col-sm-2">Repeat Event:</label>
      <input type="checkbox" class="form-check-input col-sm-1" onclick="hideRepeat()">
      <div id="Repeat" style="visibility: hidden">
        <label for="Repetition" class="col-sm-1">Repeat:</label>
        <div class="col-sm-1">
  				<select type="text" class="custom-select" required name="RepeatEvent">
  					<option>None</option>
  					<option>Weekly</option>
  					<option>Daily</option>
  					<option>Monthly</option>
  				</select>
  			</div>
        <div>
    			<label for="EndRepeat" class="col-sm-2">Repeat end at:
            <input type="Date" class="form-control" name="EndRepeat"></label>
    		</div>
      </div>
		</div>

		<div class="form-group row">
			<label for="EventClockOut" class="col-sm-2">Required to clock out?</label>
			<div class="col-sm-2">
				<select type="text" class="custom-select" name="EventClockOut">
					<option>No</option>
					<option>Yes</option>
				</select>
			</div>
		</div>
		<div class="form-group">
			<label for="EventDescription">Description:</label>
			<div>
				<textarea class="form-control" name="EventDescription" rows="3" cols="50" placeholder="Please insert description"></textarea>
			</div>
		</div>
		<div class="form-group row">
			<div class="col-sm-10">
				<button type="submit" class="btn btn-default">Save</button>
				<button type="button" class="btn btn-primary" onclick="goBack()">Discard</button>
			</div>
		</div>

<footer id="page-footer">
  <div id="footer">
    <div class="footer-bootom">
      <p>Copyright &copy; 2018 - Web Attendance System <a href="https://um.edu.my">University Malaya</a>. Designed by: <a href="https://www.linkedin.com/in/teowqinkae/">TQK</a> and <a href="https://www.linkedin.com/in/zhiyuteoh/"> TZY</p>
    </div>
  </div>
</footer>

  <script>
  let dropdown = document.getElementById('json-dropdown');
  dropdown.length = 0;
  let defaultOption = document.createElement('option');
  defaultOption.text = 'Please select';
  dropdown.add(defaultOption);
  dropdown.selectedIndex = 0;
  const url = '/AttendanceSystemv1/json/eventvenue.json';
  const request = new XMLHttpRequest();
  request.open('GET', url, true);
  request.onload = function(){
    if (request.status===200) {
      const data = JSON.parse(request.responseText);
      let option;
      for (let i = 0; i < data.length; i++) {
        option = document.createElement('option');
        option.text = data[i].name +' -- Capacity = '+data[i].capacity;
        option.value = data[i].name;
        dropdown.add(option);
      }
    }else {
      console.log("error");
    }
  }
  request.onerror = function(){
    console.console.error('An error occurred fetching the json from '+url);
  };
  request.send();

  function hideRepeat(){
    var x = document.getElementById('Repeat');
    if (x.style.visibility==="hidden") {
      x.style.visibility = "visible";
    }else {
      x.style.visibility = "hidden";
    }
  }
  </script>
</body>
</html>
