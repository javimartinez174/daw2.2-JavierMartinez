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
$fpdf->Write(10, 'Terminator 2: El juicio final ');
$fpdf->Ln();

$fpdf->setFont('Arial', '', 12);
$fpdf->Write(20, 'Pelicula rodada en EEUU  en el anio 1991');
//Saltos de linea

$fpdf->SetTextColor(173, 173, 235);

$fpdf->setFont('Arial', '', 18);
$fpdf->Write(10, 'Sinopsis de la pelicula');

$fpdf->Ln();
$fpdf->SetTextColor(0, 0, 0);
$fpdf->setFont('Arial', '', 12);
$fpdf->Write(10, 'Sarah Connor, la madre soltera del rebelde John Connor, esta ingresada en un psiquiatrico. Algunos años antes, un viajero del tiempo le habia revelado que su hijo seria el salvador de la humanidad en un futuro dominado por las maquinas. Se convirtio entonces en una especie de guerrera y educo a su hijo John en tacticas de supervivencia. Esta es la razon por la que esta recluida en un manicomio. Cuando un nuevo androide mejorado, un T-1000, llega del futuro para asesinar a John, un viejo modelo T-800 sera enviado para protegerle. ');
$fpdf->Ln();
$fpdf->Ln();

$fpdf->SetTextColor(255, 178, 255);
$fpdf->setFont('Arial', '', 18);
$fpdf->Write(5, 'Actores principales');

$fpdf->Ln();
$fpdf->Ln();

$fpdf->Image('_img/_terminator/Arnold Alois Schwarzenegger.jpg', 10, 150, 35);
$fpdf->Image('_img/_terminator2/Linda Hamilton.jpg', 80, 150, 35);


$fpdf->SetTextColor(0, 0, 0);


$fpdf->setFont('Arial', 'B', 16);
$fpdf->SetFillColor(255, 255, 230);
$fpdf->Cell(80, 5, 'Nombre de los actores', 1, 0, '', true);

$fpdf->SetFillColor(255, 255, 230);
$fpdf->Cell(80, 5, 'Apellidos', 1, 1, '', true);
$fpdf->Ln(0);

$fpdf->setFont('Arial', '', 12);

$fpdf->Cell(80, 5, 'Arnold     ', 1, 0, false);
$fpdf->Cell(80, 5, ' Alois Schwarzenegger', 1, 0, false);
$fpdf->Ln(5);
$fpdf->Cell(80, 5, 'Linda    ', 1, 0, false);
$fpdf->Cell(80, 5, '  Hamilton', 1, 0, false);



$fpdf->Output();
