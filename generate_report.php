<?php
require('fpdf/fpdf.php');
include 'config.php';

// Create PDF object
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 14);
$pdf->Cell(190, 10, 'Users and Houses Report', 1, 1, 'C');
$pdf->Ln(10);

// ==================== USERS SECTION ====================
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 10, 'Registered Users', 1, 1, 'C');
$pdf->Ln(5);

// Set column headers for users
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(20, 10, 'User ID', 1);
$pdf->Cell(40, 10, 'Username', 1);
$pdf->Cell(40, 10, 'Email', 1);
$pdf->Cell(30, 10, 'Province', 1);
$pdf->Cell(30, 10, 'District', 1);
$pdf->Cell(30, 10, 'Document Issued', 1);
$pdf->Ln();

// Fetch data from users
$sql_users = "SELECT user_id, username, email, province, district, document_issued FROM users";
$result_users = $conn->query($sql_users);

$pdf->SetFont('Arial', '', 10);

while ($row = $result_users->fetch_assoc()) {
    $pdf->Cell(20, 10, $row['user_id'], 1);
    $pdf->Cell(40, 10, $row['username'], 1);
    $pdf->Cell(40, 10, $row['email'], 1);
    $pdf->Cell(30, 10, $row['province'], 1);
    $pdf->Cell(30, 10, $row['district'], 1);
    $pdf->Cell(30, 10, $row['document_issued'], 1);
    $pdf->Ln();
}

$pdf->Ln(10);

// ==================== HOUSES SECTION ====================
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(190, 10, 'Registered Houses', 1, 1, 'C');
$pdf->Ln(5);

// Set column headers for houses
$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(30, 10, 'House ID', 1);
$pdf->Cell(40, 10, 'House Number', 1);
$pdf->Cell(40, 10, 'Owner Username', 1);
$pdf->Cell(40, 10, 'Owner Email', 1);
$pdf->Cell(40, 10, 'House Photo', 1);
$pdf->Ln();

// Fetch data from houses
$sql_houses = "SELECT houses.house_id, houses.house_number, houses.house_photo, users.username, users.email 
               FROM houses 
               JOIN users ON houses.user_id = users.user_id";
$result_houses = $conn->query($sql_houses);

$pdf->SetFont('Arial', '', 10);

while ($row = $result_houses->fetch_assoc()) {
    $pdf->Cell(30, 10, $row['house_id'], 1);
    $pdf->Cell(40, 10, $row['house_number'], 1);
    $pdf->Cell(40, 10, $row['username'], 1);
    $pdf->Cell(40, 10, $row['email'], 1);
    $pdf->Cell(40, 10, basename($row['house_photo']), 1);
    $pdf->Ln();
}

// Output PDF
$pdf->Output('D', 'Users_and_Houses_Report.pdf'); // 'D' forces download
?>
