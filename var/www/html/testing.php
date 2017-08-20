<?php

	
    header ( "Content-Type: application/vnd.x-pdf" );
    header ( "Content-Type: application/force-download" );

    class myExtension fpdi {

		public function addContent($pdffile) {

			$this->setSourceFile($pdffile);
			$page = $this->ImportPage(1);
			$this->AddPage();
			$this->useTemplate($page);
			$this->$this->Image('my_profile.png', 150, 5, 40, 20, 'PNG');
			$this->createTextField($string, 25, 50, 40);

		}

		public function createTextField($string, $x, $y, $width, $height = 2) {

			$this->SetXY($x,$y);
			$this->Setfont("Arial","",10);
			$this->Cell($width, $height, $string, 0, 0, "");

		}

	}

	$pdf = new myExtension();
	$pdf->addContent('origpdffile.php');
	$pdf->Output('newpdffile.pdf', 'I');

?>