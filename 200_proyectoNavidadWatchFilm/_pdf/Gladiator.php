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
$fpdf->Write(10, 'Gladiator');
$fpdf->Ln();

$fpdf->setFont('Arial', '', 12);
$fpdf->Write(20, 'Pelicula rodada en EEUU en el anio 2000');
//Saltos de linea

$fpdf->SetTextColor(173, 173, 235);

$fpdf->setFont('Arial', '', 18);
$fpdf->Write(10, 'Sinopsis de la pelicula');

$fpdf->Ln();
$fpdf->SetTextColor(0, 0, 0);
$fpdf->setFont('Arial', '', 12);
$fpdf->Write(10, 'En el anio 180, el Imperio Romano domina todo el mundo conocido. Tras una gran victoria sobre los barbaros del norte, el anciano emperador Marco Aurelio (Richard Harris) decide transferir el poder a Maximo (Russell Crowe), bravo general de sus ejercitos y hombre de inquebrantable lealtad al imperio. Pero su hijo Comodo (Joaquin Phoenix), que aspiraba al trono, no lo acepta y trata de asesinar a Maximo.
');
$fpdf->Ln();
$fpdf->Ln();

$fpdf->SetTextColor(51, 102, 0);
$fpdf->setFont('Arial', '', 18);
$fpdf->Write(5, 'Actores principales');

$fpdf->Ln();
$fpdf->Ln();

$fpdf->Image('_img/_gladiator/Russell Crowe.jpg', 10, 150, 35);
$fpdf->Image('_img/_gladiator/Joaquin Phoenix.jpg', 80, 150, 35);
$fpdf->Image('_img/_gladiator/Djimon Hounsou.jpg', 150, 150, 35);



$fpdf->SetTextColor(0, 0, 0);



$fpdf->setFont('Arial', 'B', 16);
$fpdf->SetFillColor(255, 255, 230);
$fpdf->Cell(80, 5, 'Nombre de los actores', 1, 0, '', true);

$fpdf->SetFillColor(255, 255, 230);
$fpdf->Cell(80, 5, 'Apellidos', 1, 1, '', true);
$fpdf->Ln(0);

$fpdf->setFont('Arial', '', 12);

$fpdf->Cell(80, 5, 'Russell  ', 1, 0, false);
$fpdf->Cell(80, 5, 'Crowe', 1, 0, false);
$fpdf->Ln(5);
$fpdf->Cell(80, 5, 'Joaquin  ', 1, 0, false);
$fpdf->Cell(80, 5, 'Phoenix', 1, 0, false);
$fpdf->Ln(5);
$fpdf->Cell(80, 5, 'Djimon  ', 1, 0, false);
$fpdf->Cell(80, 5, 'Hounsou', 1, 0, false);


$fpdf->Output();
