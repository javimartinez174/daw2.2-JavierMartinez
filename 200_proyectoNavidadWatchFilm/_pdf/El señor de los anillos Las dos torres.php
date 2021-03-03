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
$fpdf->Write(10, 'El senor de los anillos: Las dos torres');
$fpdf->Ln();

$fpdf->setFont('Arial', '', 12);
$fpdf->Write(20, 'Pelicula rodada en Nueva Zelanda  en el anio 2002');
//Saltos de linea

$fpdf->SetTextColor(173, 173, 235);

$fpdf->setFont('Arial', '', 18);
$fpdf->Write(10, 'Sinopsis de la pelicula');

$fpdf->Ln();
$fpdf->SetTextColor(0, 0, 0);
$fpdf->setFont('Arial', '', 12);
$fpdf->Ln();
$fpdf->Write(10, 'Tras la disolucion de la Compañia del Anillo, Frodo y su fiel amigo Sam se dirigen hacia Mordor para destruir el Anillo Unico y acabar con el poder de Sauron, pero les sigue un siniestro personaje llamado Gollum. Mientras, y tras la dura batalla contra los orcos donde cayo Boromir, el hombre Aragorn, el elfo Legolas y el enano Gimli intentan rescatar a los medianos Merry y Pipin, secuestrados por los orcos de Mordor. Por su parte, Sauron y el traidor Saruman continuan con sus planes en Mordor, a la espera de la guerra contra las razas libres de la Tierra Media.');
$fpdf->Ln();
$fpdf->Ln();

$fpdf->SetTextColor(0, 0, 230);
$fpdf->setFont('Arial', '', 18);

$fpdf->Ln();
$fpdf->Write(5, 'Actores principales');

$fpdf->Image('_img/_elSeñorDeLosAnillos2/Sean Astin.jpg', 10, 150, 35);
$fpdf->Image('_img/_elSeñorDeLosAnillos2/Viggo Peter Mortensen.jpg', 60, 150, 35);
$fpdf->Image('_img/_elSeñorDeLosAnillos2/Orlando Bloom.jpg', 110, 150, 35);
$fpdf->Image('_img/_elSeñorDeLosAnillos2/Dominic Monaghan.jpg', 160, 150, 35);


$fpdf->SetTextColor(0, 0, 0);

$fpdf->AddPage();

$fpdf->setFont('Arial', 'B', 16);
$fpdf->SetFillColor(255, 255, 230);
$fpdf->Cell(80, 5, 'Nombre de los actores', 1, 0, '', true);

$fpdf->SetFillColor(255, 255, 230);
$fpdf->Cell(80, 5, 'Apellidos', 1, 1, '', true);
$fpdf->Ln(0);

$fpdf->setFont('Arial', '', 12);

$fpdf->Cell(80, 5, 'Sean ', 1, 0, false);
$fpdf->Cell(80, 5, 'Astin', 1, 0, false);
$fpdf->Ln(5);
$fpdf->Cell(80, 5, 'Viggo  ', 1, 0, false);
$fpdf->Cell(80, 5, ' Peter Mortensen', 1, 0, false);
$fpdf->Ln(5);
$fpdf->Cell(80, 5, 'Orlando   ', 1, 0, false);
$fpdf->Cell(80, 5, 'Bloom', 1, 0, false);
$fpdf->Ln(5);
$fpdf->Cell(80, 5, 'Lorraine ', 1, 0, false);
$fpdf->Cell(80, 5, 'Gottfried', 1, 0, false);
$fpdf->Ln(5);
$fpdf->Cell(80, 5, 'Dominic  ', 1, 0, false);
$fpdf->Cell(80, 5, 'Monaghan ', 1, 0, false);

//$fpdf ->Footer(18,6,'Footer del pdf');
$fpdf->Output();

