<?php
require('fpdf/fpdf.php');

// let's make our own class to add some features to the base class
// so that we'll have nice page headings and page footers with page
// numbers in them
class employeePDF extends FPDF
{
// Page header
function Header()
{
    // Arial bold 24
    $this->SetFont('Arial','B',24);
    // Move to the right
    $this->Cell(65);
    // Title
    $this->Cell(50,10,'Employee Report',0,0,'C');
    // Line break
    $this->Ln(20);
}

// Page footer
function Footer()
{
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',7);
    // Page number
    $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}


// -------------- Here's where the real work of the program begins --------------

// start a new PDF document in memory
$pdf = new employeePDF();

// create an "{nb}" alias for number of pages
$pdf->AliasNbPages();

// set the font
$pdf->SetFont('Arial','',10);

// add the first page
$pdf->AddPage();

// set the left margin
$pdf->SetLeftMargin(30);

// "print" the column headings with borders around the cells
$pdf->Cell(40,7,"Employee Name",1);
$pdf->Cell(25,7,"Position",1);
$pdf->Cell(40,7,"Email Address",1);
$pdf->Cell(25,7,"Date of Birth",1);
$pdf->Cell(25,7,"Phone No.",1);



// move the pointer to the beginning of the next line on the page
$pdf->Ln();

// get database stuff going
session_start();

require_once("pjcheck.php");
require_once("pjdbcreds.php");



try {
    $conn = new PDO("mysql:host=$dbhost;dbname=$dbname", $dbuser, $dbpass);
    // set the PDO error mode to exception
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
	
	// retrieve some data using PDO associative arrays and the fetch() function_exists
	$stmt = $conn->query('SELECT * from employees ORDER BY empLast, empFirst');
 
	# setting the fetch mode
	$stmt->setFetchMode(PDO::FETCH_ASSOC);

	// start "printing" each row of customer data onto the PDF page
	while($row = $stmt->fetch()) {
		$empFullName = $row['empLast'] . ", " . $row['empFirst'];
		// "print" the column contents without any borders around the cells
        $pdf->Cell(40,7,$empFullName,0);
        $pdf->Cell(25,7,$row['empPosition'],0);
        $pdf->Cell(40,7,$row['empEmail'],0);
        $pdf->Cell(25,7,$row['empDOB'],0);
        $pdf->Cell(25,7,$row['empPhone'],0);

		// move the pointer to the beginning of the next line on the page
		$pdf->Ln();
	}
	
}
catch(PDOException $e)
{
    die("PDF generation error #1848 -- please contact the Help Desk.");
}

$pdf->Output();

?>