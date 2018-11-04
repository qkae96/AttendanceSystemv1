
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

function goBack(){
  window.location.href = "/AttendanceSystemv1/event.php";
}

function goEvent(){
  alert("Saved");
}
