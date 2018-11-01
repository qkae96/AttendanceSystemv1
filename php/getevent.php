<?php
require_once('defines.php');

/**
 *
 */
class Event
{
  private $EventID;
  private $EventName;
  private $EventDate;
  private $EventStartTime;
  private $EventEndTime;
  private $EventVenue;
  private $EventClockOut;
  private $EventDescription;
  private $RepeatEvent;
  private $EndRepeat;
  private $ProfileID;
  private $EventCode;

  public function displayEvent(){
		// $conn = connectTo();
		// $sql="SELECT * FROM event";
		// $result = mysqli_query($conn,$sql);
    //
		// while($row = mysqli_fetch_array($result)) {
		//     echo "<tr>";
  	// 	    echo "<td>" . $row['EventID'] . "</td>";
  	// 	    echo "<td>" . $row['EventCode'] . "</td>";
  	// 	    echo "<td>" . $row['EventName'] . "</td>";
  	// 	    echo "<td>" . $row['EventDate'] . "</td>";
  	// 	    echo "<td>" . $row['EventStartTime'] . "</td>";
  	// 	    echo "<td>" . $row['EventEndTime'] . "</td>";
  	// 	    echo "<td>" . $row['EventVenue'] . "</td>";
    //       echo "<td><button name=updateEvent type=button value=updateEvent()>Update</button></td><td><button name=attendance type=button value=attendance()>Attendance</button></td><td><button name=deleteEvent type=button value=deleteEvent()>Delete</button></td>";
		//     echo "</tr>";
		// 	}
		mysqli_close($conn);
	}

  public function updateEvent(){
    echo "update";
  }

  public function attendance(){
    echo attendance;
  }

  public function deleteEvent(){
    $conn = connectTo();
    echo delete;
  }
  public function getEventID() {
    return $this->EventID;
  }
}

 ?>
