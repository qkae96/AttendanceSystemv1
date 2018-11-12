function viewAttendanceFromAttendance(){
  var t = document.getElementById('attendanceTable');
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
    var x = document.getElementById('viewAttendanceEventID');
    x.value = cells[0].innerHTML;
    document.getElementById('viewAttendanceEventID').disabled = false;
    window.location.href = "php/viewattendance.php?evtID=" + x.value;
  }
}

function discardAttendance(){
  window.location.href = "php/discardattendance.php";
}

function confirmDeleteAttendance(){
  document.getElementById('deleteAttendanceEventID').disabled = false;
  alert("Deleted");
}

function deleteAttendanceFromAttendance(){
  var t = document.getElementById('attendanceTable');
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
    var x = document.getElementById('deleteAttendanceEventID');
    x.value = cells[0].innerHTML;
  }
}

function takeAttendance(){
  document.getElementById('attendanceEventID').disabled = false;
  var x = document.forms["modalAttendance"]["attendanceEventID"].value;
  window.location.href = "php/takeattendance.php?evtID=" + x;
}

function viewAttendance(){
  document.getElementById('attendanceEventID').disabled = false;
  var x = document.forms["modalAttendance"]["attendanceEventID"].value;
  window.location.href = "php/viewattendance.php?evtID=" + x;
}

function attendanceModal(){
  var t = document.getElementById('eventTable');
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
    var x = document.getElementById('attendanceEventID');
    x.value = cells[0].innerHTML;

    var f = document.getElementById('attendanceEventCode');
    var f1 = document.getElementById('attendanceEventName');
    var f2 = document.getElementById('attendanceEventDate');
    var f3 = document.getElementById('attendanceStartTime');
    var f4 = document.getElementById('attendanceEndTime');
    var f5 = document.getElementById('attendanceEventVenue');

    f.value = cells[1].innerHTML;
    f1.value = cells[2].innerHTML;
    f2.value = cells[3].innerHTML;
    f3.value = cells[4].innerHTML;
    f4.value = cells[5].innerHTML;
    f5.value = cells[6].innerHTML;
  }
}

function checkInput(){
  var x = document.forms["attendanceform"]["TagID"].value;
  if (x=="") {
    alert("Please scan your card");
    return false;
  }else{
    return true;
  }
}

function confirmDeleteEvent(){
  document.getElementById('deleteEventID').disabled = false;
  alert("Deleted");
}

function deleteEvent(){
  var t = document.getElementById('eventTable');
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
    var x = document.getElementById('deleteEventID');
    x.value = cells[0].innerHTML;
  }
}

function saveUpdateEvent(){
  document.getElementById('modalEventID').disabled = false;
  alert("Updated");
}

function updateEvent(){
  var t = document.getElementById('eventTable');
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
    var x = document.getElementById('modalEventID');
    x.value = cells[0].innerHTML;

    var f = document.getElementById('modalEventCode');
    var f1 = document.getElementById('modalEventName');
    var f2 = document.getElementById('modalEventDate');
    var f3 = document.getElementById('modalStartTime');
    var f4 = document.getElementById('modalEndTime');
    var f5 = document.getElementById('modalEventVenue');

    f.value = cells[1].innerHTML;
    f1.value = cells[2].innerHTML;
    f2.value = cells[3].innerHTML;
    f3.value = cells[4].innerHTML;
    f4.value = cells[5].innerHTML;
    f5.value = cells[6].innerHTML;
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
