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
$fpdf->Write(10, 'Terminator 3: La rebelion de las maquinas ');
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
$fpdf->Write(10, 'Ha pasado una decada desde que John Connor -Nick Stahl- salvara a la humanidad de la destruccion. En la actualidad John tiene 25 años y vive en la clandestinidad: no hay ninguna prueba documental de su existencia. Asi evita ser rastreado por Skynet -la sofisticada corporacion de maquinas que una vez intento acabar con su vida-. Pero, ahora, desde el futuro, ha sido enviado el T-X (Kristanna Loken), la maquina destructora cyborg mas desarrollada de Skynet. Su mision es completar el trabajo que no pudo terminar su predecesor, el T-1000. El T-X es una maquina tan implacable como bello su aspecto humano. Ahora la unica esperanza de sobrevivir para Connnor es Terminator. ');
$fpdf->Ln();
$fpdf->Ln();

$fpdf->SetTextColor(255, 60, 55);
$fpdf->setFont('Arial', '', 18);
$fpdf->Write(5, 'Actores principales');

$fpdf->Ln();
$fpdf->Ln();

$fpdf->Image('_img/_terminator/Arnold Alois Schwarzenegger.jpg', 10, 160, 35);
$fpdf->Image('_img/_terminator3/David Andrews.jpg', 80, 160, 35);


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
$fpdf->Cell(80, 5, '  David     ', 1, 0, false);
$fpdf->Cell(80, 5, '  Andrews', 1, 0, false);



$fpdf->Output();

