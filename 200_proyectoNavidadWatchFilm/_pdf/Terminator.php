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
$fpdf->Write(10, 'Terminator ');
$fpdf->Ln();

$fpdf->setFont('Arial', '', 12);
$fpdf->Write(20, 'Pelicula rodada en EEUU  en el anio 1984');
//Saltos de linea

$fpdf->SetTextColor(173, 173, 235);

$fpdf->setFont('Arial', '', 18);
$fpdf->Write(10, 'Sinopsis de la pelicula');

$fpdf->Ln();
$fpdf->SetTextColor(0, 0, 0);
$fpdf->setFont('Arial', '', 12);
$fpdf->Write(10, 'Los Ángeles, año 2029. Las maquinas dominan el mundo. Los rebeldes que luchan contra ellas tienen como lider a John Connor, un hombre que nacio en los años ochenta. Para acabar con la rebelion, las maquinas deciden enviar al pasado a un robot -Terminator- cuya mision sera eliminar a Sarah Connor, la madre de John, e impedir asi su nacimiento.');
$fpdf->Ln();
$fpdf->Ln();

$fpdf->SetTextColor(143, 178, 255);
$fpdf->setFont('Arial', '', 18);
$fpdf->Write(5, 'Actores principales');

$fpdf->Ln();
$fpdf->Ln();

$fpdf->Image('_img/_terminator/Arnold Alois Schwarzenegger.jpg', 10, 120, 35);
$fpdf->Image('_img/_terminator/Michael Connell Biehn.jpg', 80, 120, 35);



$fpdf->SetTextColor(0, 0, 0);


$fpdf->setFont('Arial', 'B', 16);
$fpdf->SetFillColor(255, 255, 230);
$fpdf->Cell(80, 5, 'Nombre de los actores', 1, 0, '', true);

$fpdf->SetFillColor(255, 255, 230);
$fpdf->Cell(80, 5, 'Apellidos', 1, 1, '', true);
$fpdf->Ln(0);

$fpdf->setFont('Arial', '', 12);

$fpdf->Cell(80, 5, 'Arnold  ', 1, 0, false);
$fpdf->Cell(80, 5, ' Alois Schwarzenegger', 1, 0, false);
$fpdf->Ln(5);
$fpdf->Cell(80, 5, 'Michael  ', 1, 0, false);
$fpdf->Cell(80, 5, 'Connell Biehn', 1, 0, false);



$fpdf->Output();
