<?php

require('fpdf/fpdf.php');
$fpdf = new FPDF();
$fpdf ->AddPage();

class pdf extends FPDF{
    /*
    function Header() {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(1, 6, 'Centro administrativo San Juan');
        // To be implemented in your own inherited class
    }*/

    function Footer()
    {
        $this->SetFont('Arial', 'B', 12);
        $this->SetY(-15);
        $this->Write(5, 'WatchFilm', '');
        $this->SetX(-15);
        $this->Write(5, $this->PageNo());
        // To be implemented in your own inherited class
    }
}
$fpdf ->Ln();
$fpdf->setFont('Arial','',18);
//Para crear lineas de texto
$fpdf ->Write(10,'It');
$fpdf->Ln();

$fpdf->setFont('Arial','',12);
$fpdf->Write(18,'Pelicula rodada en EEUU en 2017');
//Saltos de linea

$fpdf->SetTextColor(173, 173, 235);

$fpdf->setFont('Arial','',18);
$fpdf ->Write(10,'Sinopsis de la pelicula');

$fpdf->Ln();
$fpdf->SetTextColor(0, 0, 0);
$fpdf->setFont('Arial','',12);
$fpdf->Write(10,'Cuando empiezan a desaparecer ninios en el pueblo de Derry (Maine), un pandilla de amigos lidia con sus mayores miedos al enfrentarse a un malvado payaso llamado Pennywise, cuya historia de asesinatos y violencia data de siglos.
');
$fpdf->Ln();
$fpdf->Ln();

$fpdf->SetTextColor(102, 0, 204);
$fpdf->setFont('Arial','',18);
$fpdf->Write(5,'Actores principales');

$fpdf->Ln();
$fpdf->Ln();

$fpdf->Image('_img/_it/Bill Istvan Gunther Skarsgad.jpg',10,130,35);
$fpdf->Image('_img/_it/Jackson Robert Scott.jpg',60,130,35);
$fpdf->Image('_img/_it/Sophia Lillis.jpg',110,130,35);
$fpdf->Image('_img/_it/Steven Williams.jpg',160,130,35);

$fpdf->SetTextColor(0, 0, 0);

$fpdf->setFont('Arial','B',16);
$fpdf->SetFillColor(255, 255, 230);
$fpdf ->Cell(80,5,'Nombre de los actores',1,0,'',true);

$fpdf ->SetFillColor(255, 255, 230);
$fpdf ->Cell(80,5,'Apellidos',1,1,'',true);
$fpdf->Ln(0);

$fpdf->setFont('Arial','',12);

$fpdf ->Cell(80,5,'Bill ',1,0,false);
$fpdf ->Cell(80,5,'Istvan Gunther Skarsgad',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,'Jackson',1,0,false);
$fpdf ->Cell(80,5,'Robert Scott',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,'Sophia ',1,0,false);
$fpdf ->Cell(80,5,'Lillis',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,'Steven ',1,0,false);
$fpdf ->Cell(80,5,'Williams',1,0,false);

$fpdf ->Output();
