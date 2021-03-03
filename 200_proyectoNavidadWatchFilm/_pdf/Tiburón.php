<?php
require('fpdf/fpdf.php');
$fpdf = new FPDF();
$fpdf ->AddPage();

class pdf extends FPDF{

    function Header() {
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
$fpdf ->Ln();
$fpdf->setFont('Arial','',18);
//Para crear lineas de texto
$fpdf ->Write(10,'Tiburon');
$fpdf->Ln();

$fpdf->setFont('Arial','',12);
$fpdf->Write(20,'Pelicula rodada en EEUU en el anio 1975');
//Saltos de linea

$fpdf->SetTextColor(173, 173, 235);

$fpdf->setFont('Arial','',18);
$fpdf ->Write(10,'Sinopsis de la pelicula');

$fpdf->Ln();
$fpdf->SetTextColor(0, 0, 0);
$fpdf->setFont('Arial','',12);
$fpdf->Ln();
$fpdf->Write(10,'En la costa de un pequeño pueblo del Este de los Estados Unidos, un enorme tiburon ataca a varias personas. Por temor a los nefastos efectos que este hecho podria tener sobre el negocio turistico, el alcalde se niega a cerrar las playas y a difundir la noticia. Pero un nuevo ataque del tiburon termina con la vida de un bañista. Cuando el terror se apodera de todos, un veterano cazador de tiburones, un oceanografo y el jefe de la policia local se unen para capturar al escualo.');
$fpdf->Ln();
$fpdf->Ln();

$fpdf->SetTextColor(204, 102, 153);
$fpdf->setFont('Arial','',18);

$fpdf->Ln();
$fpdf->Write(5,'Actores principales');

$fpdf->Image('_img/_tiburon/Richard Dreyfuss.jpg',10,130,35);
$fpdf->Image('_img/_tiburon/Robert Archibald Shaw.jpg',60,130,35);
$fpdf->Image('_img/_tiburon/Roy Richard Scheider.jpg',110,130,35);
$fpdf->Image('_img/_tiburon/Lorraine Gottfried.jpg',160,130,35);
$fpdf->Image('_img/_tiburon/Murray Hamilton.jpg',70,200,35);

$fpdf->SetTextColor(0, 0, 0);

$fpdf ->AddPage();

$fpdf->setFont('Arial','B',16);
$fpdf->SetFillColor(255, 255, 230);
$fpdf ->Cell(80,5,'Nombre de los actores',1,0,'',true);

$fpdf ->SetFillColor(255, 255, 230);
$fpdf ->Cell(80,5,'Apellidos',1,1,'',true);
$fpdf->Ln(0);

$fpdf->setFont('Arial','',12);

$fpdf ->Cell(80,5,'Richard  ',1,0,false);
$fpdf ->Cell(80,5,'Dreyfuss',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,'Robert ',1,0,false);
$fpdf ->Cell(80,5,' Archibald Shaw',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,'Roy  ',1,0,false);
$fpdf ->Cell(80,5,'Richard Scheider',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,'Lorraine ',1,0,false);
$fpdf ->Cell(80,5,'Gottfried',1,0,false);

//$fpdf ->Footer(18,6,'Footer del pdf');
$fpdf ->Output();

