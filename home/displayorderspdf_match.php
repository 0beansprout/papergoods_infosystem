<?php
require('fpdf/fpdf.php');

// let's make our own class to add some features to the base class
// so that we'll have nice page headings and page footers with page
// numbers in them
class orderPDF extends FPDF
{
// Page header
function Header()
{
    // Arial bold 24
    $this->SetFont('Arial','B',24);
    // Move to the right
    $this->Cell(65);
    // Title
    $this->Cell(50,10,'Order Report',0,0,'C');
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
$pdf = new orderPDF();

// create an "{nb}" alias for number of pages
$pdf->AliasNbPages();

// set the font
$pdf->SetFont('Arial','',8);

// add the first page
$pdf->AddPage();

// set the left margin
$pdf->SetLeftMargin(30);

// "print" the column headings with borders around the cells
$pdf->Cell(16,7,"Order No.",1);
$pdf->Cell(11,7,"CustID",1);
$pdf->Cell(30,7,"Customer Name",1);
$pdf->Cell(10,7,"ProID",1);
$pdf->Cell(21,7,"Product",1);
$pdf->Cell(28,7,"Brand",1);
$pdf->Cell(10,7,"Qty",1);
$pdf->Cell(12,7,"Cost",1);
$pdf->Cell(18,7,"Comment",1);



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
	$stmt = $conn->query('SELECT invoiceID, custID, custFname, custLname, invoiceProduct, invoiceBrand, invoiceQty, invoiceTotalCost, invoiceBalance, invoiceComment from invoice Where custID = :cidParam');
    $stmt->bindParam(':cidParam', $_POST["custID"]);
    $stmt->execute();

	# setting the fetch mode
	$stmt->setFetchMode(PDO::FETCH_ASSOC);

	// start "printing" each row of customer data onto the PDF page
	while($row = $stmt->fetch()) {
        
		$custFullName = $row['custLname'] . ", " . $row['custFname'];
		// "print" the column contents without any borders around the cells
        $pdf->Cell(16,7,$row['invoiceID'],0);
        $pdf->Cell(11,7,$row['custID'],0);
        $pdf->Cell(30,7,$custFullName,0);
        $pdf->Cell(10,7,$row['invoiceBalance'],0);
        $pdf->Cell(21,7,$row['invoiceProduct'],0);
        $pdf->Cell(28,7,$row['invoiceBrand'],0);
        $pdf->Cell(10,7,$row['invoiceQty'],0);
        $pdf->Cell(12,7,$row['invoiceTotalCost'],0);
        $pdf->Cell(18,7,$row['invoiceComment'],0);


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