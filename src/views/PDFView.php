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
        $pdf = new FPDF();
        $pdf->AddPage();
        $pdf->SetFont('Arial','B',16);
        $pdf->Cell(40,10,'Hello World!');
        $pdf->Output();
    }
}
?>