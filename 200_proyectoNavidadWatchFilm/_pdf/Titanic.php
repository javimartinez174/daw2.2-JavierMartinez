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
$fpdf->Write(10, 'Titanic');
$fpdf->Ln();

$fpdf->setFont('Arial', '', 12);
$fpdf->Write(20, 'Pelicula rodada en EEUU en el anio 1997');
//Saltos de linea

$fpdf->SetTextColor(173, 173, 235);

$fpdf->setFont('Arial', '', 18);
$fpdf->Write(10, 'Sinopsis de la pelicula');

$fpdf->Ln();
$fpdf->SetTextColor(0, 0, 0);
$fpdf->setFont('Arial', '', 12);
$fpdf->Write(10, 'Jack, un joven artista, gana en una partida de cartas un pasaje para viajar a America en el Titanic, el transatlantico mas grande y seguro jamas construido. A bordo conoce a Rose (Kate Winslet), una joven de una buena familia venida a menos que va a contraer un matrimonio de conveniencia con Cal (Billy Zane), un millonario engreido a quien solo interesa el prestigioso apellido de su prometida. Jack y Rose se enamoran, pero el prometido y la madre de ella ponen todo tipo de trabas a su relacion. Mientras, el gigantesco y lujoso transatlantico se aproxima hacia un inmenso iceberg.
');
$fpdf->Ln();
$fpdf->Ln();

$fpdf->SetTextColor(255, 255, 0);
$fpdf->setFont('Arial', '', 18);
$fpdf->Write(5, 'Actores principales');

$fpdf->Image('_img/_titanic/Leonardo Wihelm DiCaprio.jpg', 10, 140, 35);
$fpdf->Image('_img/_titanic/Kate Elizabeth Winslet.jpg', 60, 140, 35);
$fpdf->Image('_img/_titanic/Billy Zane.jpg', 110, 140, 35);
$fpdf->Image('_img/_titanic/Kathy Bates.jpg', 160, 140, 35);
$fpdf->Image('_img/_titanic/Frances Fisher.jpg', 90, 200, 35);


$fpdf->SetTextColor(0, 0, 0);

$fpdf->AddPage();

$fpdf->setFont('Arial', 'B', 16);
$fpdf->SetFillColor(255, 255, 230);
$fpdf->Cell(80, 5, 'Nombre de los actores', 1, 0, '', true);

$fpdf->SetFillColor(255, 255, 230);
$fpdf->Cell(80, 5, 'Apellidos', 1, 1, '', true);
$fpdf->Ln(0);

$fpdf->setFont('Arial', '', 12);

$fpdf->Cell(80, 5, 'Leonardo ', 1, 0, false);
$fpdf->Cell(80, 5, 'Wihelm DiCaprio', 1, 0, false);
$fpdf->Ln(5);
$fpdf->Cell(80, 5, 'Kate ', 1, 0, false);
$fpdf->Cell(80, 5, 'Elizabeth Winslet', 1, 0, false);
$fpdf->Ln(5);
$fpdf->Cell(80, 5, 'Billy ', 1, 0, false);
$fpdf->Cell(80, 5, 'Zane', 1, 0, false);
$fpdf->Ln(5);
$fpdf->Cell(80, 5, 'Kathy  ', 1, 0, false);
$fpdf->Cell(80, 5, 'Bates', 1, 0, false);
$fpdf->Ln(5);
$fpdf->Cell(80, 5, 'Frances  ', 1, 0, false);
$fpdf->Cell(80, 5, 'Fisher', 1, 0, false);

$fpdf->Output();

