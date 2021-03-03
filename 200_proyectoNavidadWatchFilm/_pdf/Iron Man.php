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
$fpdf->Write(10, 'Ironman ');
$fpdf->Ln();

$fpdf->setFont('Arial', '', 12);
$fpdf->Write(20, 'Pelicula rodada en Japon en el anio 2013');
//Saltos de linea

$fpdf->SetTextColor(173, 173, 235);

$fpdf->setFont('Arial', '', 18);
$fpdf->Write(10, 'Sinopsis de la pelicula');

$fpdf->Ln();
$fpdf->SetTextColor(0, 0, 0);
$fpdf->setFont('Arial', '', 12);
$fpdf->Write(10, 'Dirigido por Hiroshi Hamasaki y con una historia de Brandon Auman, esta pelicula explora la confrontacion entre Iron Man y el villano Ezekiel Stane, quien desarrolla nueva biotecnologia que, al parecer, sobrepasa la de la armadura de Iron Man. Asi, Stane lanzara un ataque terrorista y hara parecer culpable a Iron Man, tras lo cual, el propio Stark tendra que evadir a los cazadores de S.H.I.E.L.D. y encontrar la manera de limpiar su nombre.');
$fpdf->Ln();
$fpdf->Ln();

$fpdf->SetTextColor(153, 255, 255);
$fpdf->setFont('Arial', '', 18);
$fpdf->Write(5, 'Actores principales');

$fpdf->Ln();
$fpdf->Ln();

$fpdf->Image('_img/_ironman/Robert John Downey.jpg', 10, 160, 35);
$fpdf->Image('_img/_ironman/Terrence Howard.jpg', 80, 160, 35);
$fpdf->Image('_img/_ironman/Jeff Bridges.jpg', 150, 160, 35);


$fpdf->SetTextColor(0, 0, 0);


$fpdf->setFont('Arial', 'B', 16);
$fpdf->SetFillColor(255, 255, 230);
$fpdf->Cell(80, 5, 'Nombre de los actores', 1, 0, '', true);

$fpdf->SetFillColor(255, 255, 230);
$fpdf->Cell(80, 5, 'Apellidos', 1, 1, '', true);
$fpdf->Ln(0);

$fpdf->setFont('Arial', '', 12);

$fpdf->Cell(80, 5, 'John  ', 1, 0, false);
$fpdf->Cell(80, 5, 'Noble', 1, 0, false);
$fpdf->Ln(5);
$fpdf->Cell(80, 5, 'Robert  ', 1, 0, false);
$fpdf->Cell(80, 5, 'Jhon Downey', 1, 0, false);
$fpdf->Ln(5);
$fpdf->Cell(80, 5, ' Terrence ', 1, 0, false);
$fpdf->Cell(80, 5, 'Howard', 1, 0, false);


$fpdf->Output();

