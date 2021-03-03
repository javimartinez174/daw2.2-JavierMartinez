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
$fpdf->Write(10, 'El senor de los anillos: La comunidad del anillo ');
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
$fpdf->Write(10, 'En la Tierra Media, el Señor Oscuro Sauron ordeno a los Elfos que forjaran los Grandes Anillos de Poder. Tres para los reyes Elfos, siete para los Señores Enanos, y nueve para los Hombres Mortales. Pero Sauron también forjo, en secreto, el Anillo Unico, que tiene el poder de esclavizar toda la Tierra Media. Con la ayuda de sus amigos y de valientes aliados, el joven hobbit Frodo emprende un peligroso viaje con la mision de destruir el Anillo Unico. Pero el malvado Sauron ordena la persecucion del grupo, compuesto por Frodo y sus leales amigos hobbits, un mago, un hombre, un elfo y un enano. La mision es casi suicida pero necesaria, pues si Sauron con su ejercito de orcos lograra recuperar el Anillo, seria el final de la Tierra Media.');
$fpdf->Ln();
$fpdf->Ln();

$fpdf->SetTextColor(153, 102, 255);
$fpdf->setFont('Arial', '', 18);
$fpdf->Write(5, 'Actores principales');

$fpdf->Ln();
$fpdf->Ln();

$fpdf->Image('_img/_elSeñorDeLosAnillos1/Craig Parker.jpg', 10, 160, 35);
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

$fpdf->Cell(80, 5, 'Craig ', 1, 0, false);
$fpdf->Cell(80, 5, 'Parker', 1, 0, false);
$fpdf->Ln(5);
$fpdf->Cell(80, 5, 'Elijah ', 1, 0, false);
$fpdf->Cell(80, 5, 'Wood', 1, 0, false);
$fpdf->Ln(5);
$fpdf->Cell(80, 5, ' Ian', 1, 0, false);
$fpdf->Cell(80, 5, 'McKellen', 1, 0, false);


$fpdf->Output();
