<?php

require('fpdf/fpdf.php');
$fpdf = new FPDF();
$fpdf ->AddPage();

class pdf extends FPDF{
    /*
    function Header() {
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(1, 6, 'Centro administrativo San Juan');
        // To be implemented in your own inherited class
    }*/

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
$fpdf ->Ln();
$fpdf->setFont('Arial','',18);
//Para crear lineas de texto
$fpdf ->Write(10,'El show de Truman');
$fpdf->Ln();

$fpdf->setFont('Arial','',12);
$fpdf->Write(18,'Pelicula rodada en EEUU en 1998');
//Saltos de linea

$fpdf->SetTextColor(173, 173, 235);

$fpdf->setFont('Arial','',18);
$fpdf ->Write(10,'Sinopsis de la pelicula');

$fpdf->Ln();
$fpdf->SetTextColor(0, 0, 0);
$fpdf->setFont('Arial','',12);
$fpdf->Write(10,'Truman Burbank es un hombre corriente y algo ingenuo que ha vivido toda su vida en uno de esos pueblos donde nunca pasa nada. Sin embargo, de repente, unos extranos sucesos le hacen sospechar que algo anormal esta ocurriendo. Todos sus amigos son actores, toda su ciudad es un plato, toda su vida esta siendo filmada y emitida como el reality mas ambicioso de la historia.
');
$fpdf->Ln();
$fpdf->Ln();

$fpdf->SetTextColor(153, 102, 51);
$fpdf->setFont('Arial','',18);
$fpdf->Write(5,'Actores principales');

$fpdf->Ln();
$fpdf->Ln();

$fpdf->Image('_img/_elShowDeTruman/Laura Linney.jpg',10,140,35);
$fpdf->Image('_img/_elShowDeTruman/Ed Harris.jpg',60,140,35);
$fpdf->Image('_img/_elShowDeTruman/James Eugene Carrey.jpg',110,140,35);
$fpdf->Image('_img/_elShowDeTruman/Paul Giamatti.jpg',160,140,35);

$fpdf->SetTextColor(0, 0, 0);

$fpdf->setFont('Arial','B',16);
$fpdf->SetFillColor(255, 255, 230);
$fpdf ->Cell(80,5,'Nombre de los actores',1,0,'',true);

$fpdf ->SetFillColor(255, 255, 230);
$fpdf ->Cell(80,5,'Apellidos',1,1,'',true);
$fpdf->Ln(0);

$fpdf->setFont('Arial','',12);

$fpdf ->Cell(80,5,' Laura ',1,0,false);
$fpdf ->Cell(80,5,'Linney',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,'Ed ',1,0,false);
$fpdf ->Cell(80,5,'Harris',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,'James  ',1,0,false);
$fpdf ->Cell(80,5,'Eugene Carrey',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,'Paul',1,0,false);
$fpdf ->Cell(80,5,'Giamatti',1,0,false);

$fpdf ->Output();
