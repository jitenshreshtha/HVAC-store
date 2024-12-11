<?php
require('fpdfg/fpdf184/fpdf.php');

class PDF extends FPDF
{
    // Page header
    function Header()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, 'Himalaya Store', 0, 1, 'C');
        $this->Ln(10);
    }

    // Page footer
    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }

    // Improved table function with dynamic column widths
    function BasicTable($header, $data)
    {
        // Calculate column widths dynamically
        $colWidths = [];
        foreach ($header as $col) {
            $maxLen = strlen($col);
            foreach ($data as $row) {
                $maxLen = max($maxLen, strlen((string)$row[$col]));
            }
            $colWidths[] = min(60, max(40, $maxLen * 3)); // Set a cap for column width
        }

        // Render header
        foreach ($header as $i => $col) {
            $this->Cell($colWidths[$i], 7, $col, 1);
        }
        $this->Ln();

        // Render rows
        foreach ($data as $row) {
            foreach ($header as $i => $col) {
                $this->Cell($colWidths[$i], 6, $row[$col], 1);
            }
            $this->Ln();
        }
    }
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Retrieve and decode data from the form
    $rawData = $_POST['pdfData'] ?? '';

    // Ensure the data is not empty
    if (empty($rawData)) {
        die("Error: No data provided for PDF generation.");
    }

    // Decode the JSON data
    $decodedData = json_decode($rawData, true);

    // Error handling for JSON decoding
    if ($decodedData === null) {
        die('Error decoding JSON data: ' . json_last_error_msg());
    }

    if (!is_array($decodedData)) {
        die('Decoded JSON is not an array');
    }

    if (count($decodedData) === 0) {
        die('No data available to generate PDF.');
    }

    // Extract headers dynamically
    $header = array_keys($decodedData[0]);

    // Generate PDF
    $pdf = new PDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', '', 12);
    $pdf->BasicTable($header, $decodedData);

    // Output the PDF
    $pdf->Output();
    exit;
} else {
    echo "Invalid request method.";
}
?>