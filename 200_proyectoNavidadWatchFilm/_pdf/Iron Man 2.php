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
$fpdf->Write(10, 'Iron Man 2 ');
$fpdf->Ln();

$fpdf->setFont('Arial', '', 12);
$fpdf->Write(20, 'Pelicula rodada en EEUU  en el anio 2010');
//Saltos de linea

$fpdf->SetTextColor(173, 173, 235);

$fpdf->setFont('Arial', '', 18);
$fpdf->Write(10, 'Sinopsis de la pelicula');

$fpdf->Ln();
$fpdf->SetTextColor(0, 0, 0);
$fpdf->setFont('Arial', '', 12);
$fpdf->Write(10, 'El mundo ya sabe que el multimillonario Tony Stark (Robert Downey Jr.) es Iron Man, el superheroe enmascarado. A pesar de las presiones del gobierno, la prensa y la opinion publica para que comparta su tecnologia con el ejercito, Tony es reacio a desvelar los secretos de la armadura de Iron Man, porque teme que esa informacion caiga en en manos de irresponsables. Con Pepper Potts (Gwyneth Paltrow) y James “Rhodey” Rhodes (Don Cheadle) a su lado, Tony forja alianzas nuevas y se enfrenta a nuevas y poderosas fuerzas.');
$fpdf->Ln();
$fpdf->Ln();

$fpdf->SetTextColor(255, 178, 255);
$fpdf->setFont('Arial', '', 18);
$fpdf->Write(5, 'Actores principales');

$fpdf->Ln();
$fpdf->Ln();

$fpdf->Image('_img/_Iron Man 2/Samuel L. Jackson.jpg', 10, 150, 35);
$fpdf->Image('_img/_Iron Man 2/John M. Slattery, Jr.jpg', 80, 150, 35);


$fpdf->SetTextColor(0, 0, 0);


$fpdf->setFont('Arial', 'B', 16);
$fpdf->SetFillColor(255, 255, 230);
$fpdf->Cell(80, 5, 'Nombre de los actores', 1, 0, '', true);

$fpdf->SetFillColor(255, 255, 230);
$fpdf->Cell(80, 5, 'Apellidos', 1, 1, '', true);
$fpdf->Ln(0);

$fpdf->setFont('Arial', '', 12);

$fpdf->Cell(80, 5, 'Samuel    ', 1, 0, false);
$fpdf->Cell(80, 5, ' L. Jackson', 1, 0, false);
$fpdf->Ln(5);
$fpdf->Cell(80, 5, 'John   ', 1, 0, false);
$fpdf->Cell(80, 5, ' M. Slattery, Jr', 1, 0, false);



$fpdf->Output();
