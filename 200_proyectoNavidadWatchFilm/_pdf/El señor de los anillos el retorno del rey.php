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
$fpdf->Write(10, 'El senor de los anillos: El retorno del rey ');
$fpdf->Ln();

$fpdf->setFont('Arial', '', 12);
$fpdf->Write(20, 'Pelicula rodada en Nueva Zelanda en el anio 2001');
//Saltos de linea

$fpdf->SetTextColor(173, 173, 235);

$fpdf->setFont('Arial', '', 18);
$fpdf->Write(10, 'Sinopsis de la pelicula');

$fpdf->Ln();
$fpdf->SetTextColor(0, 0, 0);
$fpdf->setFont('Arial', '', 12);
$fpdf->Write(10, 'Las fuerzas de Saruman han sido destruidas, y su fortaleza sitiada. Ha llegado el momento de decidir el destino de la Tierra Media, y, por primera vez, parece que hay una pequeña esperanza. El interes del señor oscuro Sauron se centra ahora en Gondor, el ultimo reducto de los hombres, cuyo trono sera reclamado por Aragorn. Sauron se dispone a lanzar un ataque decisivo contra Gondor. Mientras tanto, Frodo y Sam continuan su camino hacia Mordor, con la esperanza de llegar al Monte del Destino.');
$fpdf->Ln();
$fpdf->Ln();

$fpdf->SetTextColor(153, 102, 255);
$fpdf->setFont('Arial', '', 18);
$fpdf->Write(5, 'Actores principales');

$fpdf->Ln();
$fpdf->Ln();

$fpdf->Image('_img/_elSeñorDeLosAnillos3/John Noble.jpg', 10, 160, 35);
$fpdf->Image('_img/_elSeñorDeLosAnillos1/Elijah Wood.jpg', 80, 160, 35);
$fpdf->Image('_img/_elSeñorDeLosAnillos1/Ian McKellen.jpg', 150, 160, 35);


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
$fpdf->Cell(80, 5, 'Elijah ', 1, 0, false);
$fpdf->Cell(80, 5, 'Wood', 1, 0, false);
$fpdf->Ln(5);
$fpdf->Cell(80, 5, ' Ian', 1, 0, false);
$fpdf->Cell(80, 5, 'McKellen', 1, 0, false);


$fpdf->Output();
