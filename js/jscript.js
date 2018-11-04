
function getEventID(){
  var tbl = document.getElementById('eventTable');
  if (tbl!=null) {
    for (var i = 0; i < tbl.rows.length; i++) {
      // for (var j = 0; j<tbl.rows[i].cells.length; j++) {
        tbl.rows[i].cells[0].onclick = function(){getval(this);};
      // }
    }
    function getval(x){
      alert(x.innerHTML);
    }
  }
}

function test(){
  var evtID;
  var tbl = document.getElementById('eventTable');
  if (tbl!=null) {
    for (var i = 0; i < tbl.rows.length; i++) {
      alert(tbl.rows[i].cells[0].innerHTML);
      // tbl.rows[i].cells[0] = evtID;
      // window.location = "/AttendanceSystemv1/php/update.php?evtID="+evtID;
    }
  }
}

function addEvent(){
  window.location = "php/eventform.php";
}

function validateEventForm(){
  var x = document.forms["eventForm"]["EventCode"].value;
  if (x=="") {
    alert("Event code must be filled out");
    return false;
  }
  var x1 = document.forms["eventForm"]["EventName"].value;
  if (x1=="") {
    alert("Event name must be filled out");
    return false;
  }
  var x2 = document.forms["eventForm"]["EventDate"].value;
  if (x2=="") {
    alert("Event date must be filled out");
    return false;
  }
  var x3 = document.forms["eventForm"]["EventStartTime"].value;
  if (x3=="") {
    alert("Event start time must be filled out");
    return false;
  }
  var x4 = document.forms["eventForm"]["EventEndTime"].value;
  if (x4=="") {
    alert("Event end time must be filled out");
    return false;
  }
  var x5 = document.forms["eventForm"]["EventVenue"].value;
  if (x5=="") {
    alert("Event venue must be filled out");
    return false;
  }
  else {
    alert("Saved");
    return true;
  }
}
function goBack(){
  window.location.href = "/AttendanceSystemv1/event.php";
}

function goEvent(){
  alert("Saved");
}
