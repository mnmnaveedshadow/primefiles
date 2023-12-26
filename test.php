<?php
require_once 'dompdf/dompdf/autoload.inc.php'; // Use autoload.inc.php

use Dompdf\Dompdf;
use Dompdf\Options; // Import the Options class

// Load the HTML content
$html = file_get_contents('calculated_quote.php');

$options = new Options(); // Create an Options instance
$options->set('isRemoteEnabled', true);

$dompdf = new Dompdf($options); // Pass the options to Dompdf

// Load the HTML content into the Dompdf object
$dompdf->loadHtml($html);

// Render the HTML as PDF
$dompdf->render();

// Save the PDF file to the server
$dompdf->stream('quotation.pdf');
 ?>
