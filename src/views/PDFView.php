<?php
namespace cs174\hw5\views;
use FPDF;

/**
 * Class PDFView
 * @package cs174\hw5\views
 *
 * View responsible for drawing
 * the PDF view (where users can
 * see their wishes)
 */
class PDFView extends View {

    /**
     * Renders a PDF page for viewing a PDF wish
     * @param Array $data data to render on the view
     */
    public function render($data) {
        // TODO actually render with logo and fountain image
        $pdf = new FPDF('P', 'mm', 'A4');
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',30);
        $pdf->Ln(20);
        $pdf->Cell(0,0,'          | Throw-a-Coin-In-The-Fountain');
        $pdf->Ln(20);
        $pdf->SetFont('Arial', '', 20);
        $pdf->Cell(210, 0, '                              Thanks for your wish!', 0, 0, 'c');
        $pdf->Image($data['logo-image'], 22, 23, 15);
        $pdf->Image($data['fountain-image'], 30, 73.5, 150);
        $pdf->Output();
    }
}
?>