<?php
include('includes/dbconnection.php');
require_once('fpdf.php');

if (isset($_GET['appointment_id'])) {
    $appointment_id = intval($_GET['appointment_id']);

    // Fetch appointment details
    $appointment_query = "SELECT * FROM appointments WHERE id = ?";
    $stmt = $con->prepare($appointment_query);
    $stmt->bind_param("i", $appointment_id);
    $stmt->execute();
    $appointment_result = $stmt->get_result();

    if (!$appointment_result || $appointment_result->num_rows === 0) {
        die("Appointment not found.");
    }

    $appointment = $appointment_result->fetch_assoc();

    // Fetch services
    $service_ids = !empty($appointment['services']) ? explode(',', $appointment['services']) : [];
    $services = [];
    $total = 0;

    if (!empty($service_ids)) {
        $placeholders = implode(',', array_fill(0, count($service_ids), '?'));
        $service_query = "SELECT Title, Price FROM service WHERE id IN ($placeholders)";
        $stmt = $con->prepare($service_query);
        $type_str = str_repeat('i', count($service_ids));
        $stmt->bind_param($type_str, ...$service_ids);
        $stmt->execute();
        $service_result = $stmt->get_result();
        $services = $service_result->fetch_all(MYSQLI_ASSOC);

        foreach ($services as $service) {
            $total += $service['Price'];
        }
    }

    // Generate PDF
    $pdf = new FPDF();
    $pdf->AddPage();
    $pdf->SetFont('Arial', 'B', 12);

    $pdf->Cell(200, 10, "Invoice for Appointment #" . $appointment['id'], 0, 1, 'C');
    $pdf->Ln(10);

    $pdf->Cell(40, 10, "Name: " . $appointment['fullname']);
    $pdf->Ln(10);
    $pdf->Cell(40, 10, "Mobile: " . $appointment['contact']);
    $pdf->Ln(10);
    $pdf->Cell(40, 10, "Email: " . $appointment['email']);
    $pdf->Ln(10);
    $pdf->Cell(40, 10, "Date: " . $appointment['date']);
    $pdf->Ln(15);

    $pdf->Cell(10, 10, "#", 1);
    $pdf->Cell(100, 10, "Service", 1);
    $pdf->Cell(40, 10, "Price", 1, 1, 'R');
    foreach ($services as $index => $service) {
        $pdf->Cell(10, 10, $index + 1, 1);
        $pdf->Cell(100, 10, $service['Title'], 1);
        $pdf->Cell(40, 10, number_format($service['Price'], 2), 1, 1, 'R');
    }

    $pdf->Ln(10);
    $pdf->Cell(110, 10, "Total", 0, 0, 'R');
    $pdf->Cell(40, 10, number_format($total, 2), 1, 1, 'R');

    $pdf->Output('D', 'Invoice_' . $appointment['id'] . '.pdf');
    exit;
}
?>
