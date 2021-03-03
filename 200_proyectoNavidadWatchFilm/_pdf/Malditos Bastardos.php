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
$fpdf ->Write(10,'Malditos bastardos');
$fpdf->Ln();

$fpdf->setFont('Arial','',12);
$fpdf->Write(20,'Pelicula rodada en EEUU en el anio 2009');
//Saltos de linea

$fpdf->SetTextColor(173, 173, 235);

$fpdf->setFont('Arial','',18);
$fpdf ->Write(10,'Sinopsis de la pelicula');

$fpdf->Ln();
$fpdf->SetTextColor(0, 0, 0);
$fpdf->setFont('Arial','',12);
$fpdf->Write(10,'Segunda Guerra Mundial (1939-1945). En la Francia ocupada por los alemanes, Shosanna Dreyfus presencia la ejecucion de su familia por orden del coronel Hans Landa. Despues de huir a Paris, adopta una nueva identidad como propietaria de un cine. En otro lugar de Europa, el teniente Aldo Raine (Brad Pitt) adiestra a un grupo de soldados judios ("The Basterds") para atacar objetivos concretos. Los hombres de Raine y una actriz alemana (Diane Kruger), que trabaja para los aliados, deben llevar a cabo una mision para hacer caer a los jefes del Tercer Reich. El destino quiere que todos se encuentren bajo la marquesina de un cine donde Shosanna espera para vengarse. ');
$fpdf->Ln();
$fpdf->Ln();

$fpdf->SetTextColor(0, 204, 153);
$fpdf->setFont('Arial','',18);
$fpdf->Write(5,'Actores principales');

$fpdf->Image('_img/_malditosBastardos/William Bradley Pitt.jpg',10,130,35);
$fpdf->Image('_img/_malditosBastardos/Melanie Laurent.jpg',60,130,35);
$fpdf->Image('_img/_malditosBastardos/Christoph Waltz.jpg',110,130,35);
$fpdf->Image('_img/_malditosBastardos/Eli Roth.jpg',160,130,35);
$fpdf->Image('_img/_malditosBastardos/Michael Fassbender.jpg',70,200,35);

$fpdf->SetTextColor(0, 0, 0);

$fpdf ->AddPage();

$fpdf->setFont('Arial','B',16);
$fpdf->SetFillColor(255, 255, 230);
$fpdf ->Cell(80,5,'Nombre de los actores',1,0,'',true);

$fpdf ->SetFillColor(255, 255, 230);
$fpdf ->Cell(80,5,'Apellidos',1,1,'',true);
$fpdf->Ln(0);

$fpdf->setFont('Arial','',12);

$fpdf ->Cell(80,5,'William ',1,0,false);
$fpdf ->Cell(80,5,'Bradley Pitt',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,'Mélanie ',1,0,false);
$fpdf ->Cell(80,5,'Laurent',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,'Christoph ',1,0,false);
$fpdf ->Cell(80,5,'Waltz',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,'Eli  ',1,0,false);
$fpdf ->Cell(80,5,'Roth',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,'Michael ',1,0,false);
$fpdf ->Cell(80,5,'Fassbender',1,0,false);

//$fpdf ->Footer(18,6,'Footer del pdf');
$fpdf ->Output();

