<?php
require('../../fpdf/fpdf.php');
include('getevent.php');

$conn = connectTo();

$eventid = $_POST['viewDatabaseEventID'];
echo $eventid;

class PDF extends FPDF {
	function Header(){
		$this->SetFont('Arial','B',20);
		
		//dummy cell to put logo
		//$this->Cell(12,0,'',0,0);
		//is equivalent to:
		$this->Cell(12);
		
		//put logo
		//$this->Image('../../logo/um-logo.png',10,10,10);
		
		$this->Cell(100,10,'Attendance List',0,1);

		$this->SetFont('Arial','B',15);
		
		$this->SetFillColor(180,180,255);
		$this->SetDrawColor(180,180,255);
		$this->Cell(45,9,'EventCode',1,0,'',true);
		$this->Cell(75,9,'EventName',1,0,'',true);
		$this->Cell(40,9,'EventDate',1,0,'',true);
		$this->Cell(45,9,'EventStartTime',1,0,'',true);
		$this->Cell(45,9,'EventEndTime',1,0,'',true);
		$this->Cell(20,9,'Venue',1,1,'',true);

		//dummy cell to give line spacing
		//$this->Cell(0,5,'',0,1);
		//is equivalent to:
		$this->Ln(10);
		
		$this->SetFont('Arial','B',15);
		
		$this->SetFillColor(180,180,255);
		$this->SetDrawColor(180,180,255);
		//$this->Cell(25,5,'EventCode',1,0,'',true);
		//$this->Cell(25,5,'EventName',1,0,'',true);
		//$this->Cell(25,5,'EventDate',1,0,'',true);
		//$this->Cell(40,5,'EventStartTime',1,0,'',true);
		//$this->Cell(40,5,'EventEndTime',1,0,'',true);
		//$this->Cell(40,5,'Venue',1,1,'',true);
		$this->Cell(15,9,'No.',1,0,'',true);
		$this->Cell(35,9,'CheckIn',1,0,'',true);
		$this->Cell(35,9,'CheckOut',1,0,'',true);
		$this->Cell(35,9,'TagID',1,0,'',true);
		$this->Cell(65,9,'Name',1,0,'',true);
		$this->Cell(30,9,'MatricNo',1,1,'',true);
		
	}
	function Footer(){
		//add table's bottom line
		$this->Cell(190,0,'','T',1,'',true);
		
		//Go to 1.5 cm from bottom
		$this->SetY(-15);
				
		$this->SetFont('Arial','',8);
		
		//width = 0 means the cell is extended up to the right margin
		$this->Cell(0,10,'Page '.$this->PageNo()." / {pages}",0,0,'C');
	}
}


//A4 width : 219mm
//default margin : 10mm each side
//writable horizontal : 219-(10*2)=189mm

ob_end_clean();
ob_start();
$pdf = new PDF('L','mm','A4'); //use new class

//define new alias for total page numbers
$pdf->AliasNbPages('{pages}');
$pdf->SetAutoPageBreak(true,15);
$pdf->AddPage();

$pdf->SetY(29);
$pdf->SetFont('Arial','',12);
$pdf->SetDrawColor(180,180,255);
$query2=mysqli_query($conn,"SELECT * FROM event WHERE EventID=$eventid");
while($data=mysqli_fetch_array($query2)){
	$pdf->Cell(45,5,$data['EventCode'],'LR',0);

	if($pdf->GetStringWidth($data['EventName']) > 75){
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(75,5,$data['EventName'],'LR',0);
		$pdf->SetFont('Arial','',9);
	}else{
		$pdf->Cell(75,5,$data['EventName'],'LR',0);
	}	
	$pdf->Cell(40,5,$data['EventDate'],'LR',0);
	$pdf->Cell(45,5,$data['EventStartTime'],'LR',0);
	$pdf->Cell(45,5,$data['EventEndTime'],'LR',0);
	$pdf->Cell(20,5,$data['EventVenue'],'LR',1);

}

$count=1;
$pdf->SetY(49);
$pdf->SetFont('Arial','',12);
$pdf->SetDrawColor(180,180,255);
//$Event = new Event;
//$inputEventID = $_GET['evtID'];
//$query=mysqli_query($conn,"SELECT * FROM attendance WHERE EventID=$eventid");
$query=mysqli_query($conn,"SELECT attendance.CheckIn, attendance.CheckOut, attendance.TagID, profile.Name, profile.MatricNo FROM attendance LEFT JOIN profile ON attendance.TagID = profile.TagID WHERE EventID=$eventid");
while($data=mysqli_fetch_array($query)){
	$pdf->Cell(15,5,$count,'LR',0);
	$pdf->Cell(35,5,$data['CheckIn'],'LR',0);

	$pdf->Cell(35,5,$data['CheckOut'],'LR',0);
	
	$pdf->Cell(35,5,$data['TagID'],'LR',0);

	if($pdf->GetStringWidth($data['Name']) > 65){
		$pdf->SetFont('Arial','',10);
		$pdf->Cell(65,5,$data['Name'],'LR',0);
		$pdf->SetFont('Arial','',12);
	}else{
		$pdf->Cell(65,5,$data['Name'],'LR',0);
	}	
	$pdf->Cell(30,5,$data['MatricNo'],'LR',1);
	//$pdf->Cell(40,5,$data['EventVenue'],'LR',1);
	$count++;
}
/*while($data=mysqli_fetch_array($query)){
		if($pdf->GetStringWidth($data['Name']) > 65){
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(65,5,$data['Name'],'LR',0);
		$pdf->SetFont('Arial','',9);
	}else{
		$pdf->Cell(65,5,$data['Name'],'LR',0);
	}

	$pdf->Cell(25,5,$data['MatricNo'],'LR',0);
	
	if($pdf->GetStringWidth($data['Email']) > 65){
		$pdf->SetFont('Arial','',7);
		$pdf->Cell(65,5,$data['Email'],'LR',0);
		$pdf->SetFont('Arial','',9);
	}else{
		$pdf->Cell(65,5,$data['Email'],'LR',0);
	}
	$pdf->Cell(60,5,$data['PhoneNo'],'LR',1);
}
*/

$pdf->Output();
ob_end_flush();

?>

