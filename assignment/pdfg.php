<?php
// Include connection and FPDF library files
include "dbconnect.php";
include 'fpdf184/fpdf.php';

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        // Logo
        $this->Image('logo/logo.png', 90, 10, 30, 20);
        $this->Ln(25);
        $this->SetFont('Arial', 'B', 13);
        // Title placeholder
        $this->Cell(0, 10, 'Conestoga College', 0, 1, 'C');
        $this->Ln(10);
    }

    // Page footer
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }
}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->SetFont('Arial', '', 12);

// Query to fetch students with their details
$students_result = mysqli_query($conn, "SELECT s.student_id, s.first_name, s.last_name, s.dob
                                         FROM Student s");

// this loop iterates over each row of the student's data and assigns it to variable.
while ($student = mysqli_fetch_assoc($students_result)) {
    $student_id = $student['student_id'];
    $student_name = $student['first_name'] . ' ' . $student['last_name'];
    $dob = $student['dob'];

    // Start a new page for each student's transcript
    $pdf->AddPage();

    // Display student name, student number, and date of birth
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(0, 10, 'Name of the student: ' . $student_name, 0, 1);
    $pdf->Cell(0, 10, 'Student Number: ' . $student_id, 0, 1);  
    $pdf->Cell(0, -10, 'Date: ' . date('Y-m-d'), 0, 1,'R');
    $pdf->Ln(20);

    // Table headers for courses and grades
    $pdf->SetFont('Arial', 'B', 10);
    $pdf->SetFillColor(186, 162, 121); 
    $pdf->Cell(40, 10, 'Course', 1, 0, 'C', true);  
    $pdf->Cell(40, 10, 'Grade', 1, 0, 'C', true); 
    $pdf->Cell(40, 10, 'Term', 1, 1, 'C', true); 

    // Query for student’s courses and grades
    // it also displays the subjects of students whose marks are entered in the database.
    $courses_result = mysqli_query($conn, "SELECT c.course_name, e.grade, t.term_name 
                                           FROM Enrollment e 
                                           JOIN Course c ON e.course_id = c.course_id 
                                           JOIN Term t ON e.term_id = t.term_id 
                                           WHERE e.student_id = $student_id AND e.grade IS NOT NULL");

    // Add each course to the transcript
    $pdf->SetFont('Arial', '', 10);
    while ($course = mysqli_fetch_assoc($courses_result)) {
        $pdf->Cell(40, 10, $course['course_name'], 1);
        $pdf->Cell(40, 10, $course['grade'], 1);
        $pdf->Cell(40, 10, $course['term_name'], 1); 
        $pdf->Ln();
    }

    $pdf->Ln(30);     
    $pdf->Cell(0, 10, 'Signature', 0, 1, 'R');
}
$pdf->Output();
?>