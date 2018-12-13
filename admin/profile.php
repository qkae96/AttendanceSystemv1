<?php
include '../admin/php/getevent.php';
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
  <link rel="stylesheet" href="/AttendanceSystemv1/css/style.css">
	<link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap-glyphicons.css" rel="stylesheet">
  <link rel="stylesheet" href="/AttendanceSystemv1/css/bootstrap.min.css">
  <link rel="stylesheet" href="/AttendanceSystemv1/css/bootstrap-theme.min.css">
  <script src="/AttendanceSystemv1/js/jquery.min.js"></script>
  <script src="/AttendanceSystemv1/js/bootstrap.min.js"></script>
  <script src="/AttendanceSystemv1/js/jscript.js"></script>
  <title>Profile</title>
  <style>
  body{
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
  button[name=click_btn] {
        background: #003366;
    }
    button[name=logout_btn] {
            background: #FF6347;
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
          <li class="active"><a href="/AttendanceSystemv1/admin/profile.php">Profile</a></li>
          <li><a href="#" data-toggle="modal" data-target="#logout-modal">Logout</a></li>
        </ul>
      </div>
    </div>
  </nav>

  <br><br><br><br>
        <div class="container" id="searchContainer">
            <div style="width: 30%;">
            <button type="button" class="btn btn-outline-primary" onclick="window.location.href='../admin/php/import_data.php'">+</button>
            <p>Add User</p>
        <!--<h2>Admin - Search User</h2>-->
        </div>
        <div class="form-group" id="studenttable">
          <label for="inputLabel">Name:</label>
        <input type="text" class="form-control" name="name" id="searchinput" placeholder="Search here" onkeyup="showResult()" autofocus>
        <button type="button" class="btn btn-default" onclick="myFunction()">Print!</button>
        <button type="button" class="btn btn-danger" onclick="goToEvent()">Reset</button>
      </div>
  <div class="form-group" id="studenttable">
    <?php
      //$Profile = new Profile;
      $conn = connectTo();
      $sql="SELECT * FROM profile WHERE ProfileType = 'user'OR ProfileType = 'lecturer'";

      $result = mysqli_query($conn,$sql);
      ?>
      <table class="table table-striped" id="studentList">
      <tr>
      <th class="ProfileID" hidden>ProfileID</th>
      <th class="No">No</th>
      <th class="TagID">TagID</th>
      <th class="Name">Name</th>
      <th class="MatricNo">Matric No</th>
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
          <td><button class="btn-success" name="updateStudent" type="button" onclick="updateStudent()" data-toggle="modal" data-target="#updateStudent"><span class="glyphicon glyphicon-pencil"></span></button></td>
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

<!-- Update Modal -->
  <div class="modal fade" id="updateStudent" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Update Student</h4>
        </div>
        <form class="modal-body" id="modalUpdateStudent" method="post" action="php/updateStudent.php" onsubmit="return validateStudentForm()" autocomplete="off">
          <div hidden>
            <label>Profile ID: </label>
            <input type="text" name="modalProfileID" id="modalProfileID">
          </div>
          <div>
            <label>Name: </label>
            <input type="text" name="modalName" id="modalName">
          </div>
          <div>
            <label>Matric Number: </label>
            <input type="text" name="modalMatricNo" id="modalMatricNo">
          </div>
          <div>
            <label>Tag ID: </label>
            <input type="text" name="modalTagID" id="modalTagID">
          </div>
          <div>
            <label>Profile Type: </label>
                  <select name="modalProfileType" id="modalProfileType" >
                    <option value=""></option>
                    <option value="lecturer">Lecturer</option>
                    <option value="user">User</option>
                  </select>
          </div>
          <div>
            <label>Email: </label>
            <input type="email" name="modalEmail" id="modalEmail">
          </div>
          <div>
            <label>PhoneNo: </label>
            <input type="text" name="modalPhoneNo" id="modalPhoneNo">
          </div>
          <div>
            <label>Username: </label>
            <input type="text" name="modalUsername" id="modalUsername">
          </div>
          <div>
            <label>Password: </label>
            <input type="text" name="modalPassword" id="modalPassword">
          </div>
          <div class="modal-footer">
            <!--<button type="submit" class="btn btn-info" formaction="../profile.php" formmethod="get">Add Students</button>-->
            <button type="submit" class="btn btn-default" onclick="saveUpdateStudent()">Save</button>
            <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
          </div>
        </form>
      </div>
    </div>
  </div>
  <!--<div class="form-group" id="studenttableadded">
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
  </div>-->



<footer id="page-footer">
  <div id="footer">
    <div class="footer-bootom">
      <!-- <p>Copyright &copy; 2018 - Web Attendance System <a href="https://um.edu.my">University Malaya</a>. Designed by: <a href="https://www.linkedin.com/in/teowqinkae/">TQK</a> and <a href="https://www.linkedin.com/in/zhiyuteoh/"> TZY</a></p> -->
    </div>
  </div>
</footer>

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


  <footer id="page-footer">
    <div id="footer">
      <div class="footer-bootom">
        <p>Copyright &copy; 2018 - Web Attendance System <a href="https://um.edu.my">University Malaya</a>. Designed by: <a href="https://www.linkedin.com/in/teowqinkae/">TQK</a> and <a href="https://www.linkedin.com/in/zhiyuteoh/">TZY</a></p>
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

function goToEvent(){
  window.location.href = "../admin/profile.php";
}
function myFunction() {
  window.print();
}
  </script>

</body>
</html>
