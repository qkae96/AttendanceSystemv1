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
		 		<input type="text" class="form-control" name="EventVenue" placeholder="Place held">
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
  </form>
</div>
  <script>
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
