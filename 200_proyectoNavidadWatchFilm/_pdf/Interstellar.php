<?php


require('fpdf/fpdf.php');
$fpdf = new FPDF();
$fpdf->AddPage();

class pdf extends FPDF
{

    function Header()
    {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(1, 6, 'Centro administrativo San Juan');
        // To be implemented in your own inherited class
    }

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

$fpdf->Ln();
$fpdf->setFont('Arial', '', 18);
//Para crear lineas de texto
$fpdf->Write(10, 'Interstellar ');
$fpdf->Ln();

$fpdf->setFont('Arial', '', 12);
$fpdf->Write(20, 'Pelicula rodada en EEUU  en el anio 2014');
//Saltos de linea

$fpdf->SetTextColor(173, 173, 235);

$fpdf->setFont('Arial', '', 18);
$fpdf->Write(10, 'Sinopsis de la pelicula');

$fpdf->Ln();
$fpdf->SetTextColor(0, 0, 0);
$fpdf->setFont('Arial', '', 12);
$fpdf->Write(10, 'Al ver que la vida en la Tierra esta llegando a su fin, un grupo de exploradores dirigidos por el piloto Cooper (McConaughey) y la cientifica Amelia (Hathaway) emprende una mision que puede ser la mas importante de la historia de la humanidad: viajar mas alla de nuestra galaxia para descubrir algún planeta en otra que pueda garantizar el futuro de la raza humana.');
$fpdf->Ln();
$fpdf->Ln();

$fpdf->SetTextColor(255, 178, 255);
$fpdf->setFont('Arial', '', 18);
$fpdf->Write(5, 'Actores principales');

$fpdf->Ln();
$fpdf->Ln();

$fpdf->Image('_img/_interstellar/Matthew McConaughey.jpg', 10, 120, 35);
$fpdf->Image('_img/_interstellar/Anne Jacqueline Hathaway.jpg', 80, 120, 35);


$fpdf->SetTextColor(0, 0, 0);


$fpdf->setFont('Arial', 'B', 16);
$fpdf->SetFillColor(255, 255, 230);
$fpdf->Cell(80, 5, 'Nombre de los actores', 1, 0, '', true);

$fpdf->SetFillColor(255, 255, 230);
$fpdf->Cell(80, 5, 'Apellidos', 1, 1, '', true);
$fpdf->Ln(0);

$fpdf->setFont('Arial', '', 12);

$fpdf->Cell(80, 5, 'Matthew   ', 1, 0, false);
$fpdf->Cell(80, 5, ' McConaughey', 1, 0, false);
$fpdf->Ln(5);
$fpdf->Cell(80, 5, 'Anne  ', 1, 0, false);
$fpdf->Cell(80, 5, ' Jacqueline Hathaway', 1, 0, false);



$fpdf->Output();