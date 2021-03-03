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
$fpdf ->Write(10,'No respires');
$fpdf->Ln();

$fpdf->setFont('Arial','',12);
$fpdf->Write(20,'Pelicula rodada en EEUU en el anio 2016');
//Saltos de linea

$fpdf->SetTextColor(173, 173, 235);

$fpdf->setFont('Arial','',18);
$fpdf ->Write(10,'Sinopsis de la pelicula');

$fpdf->Ln();
$fpdf->SetTextColor(0, 0, 0);
$fpdf->setFont('Arial','',12);
$fpdf->Write(10,'Unos jovenes ladrones creen haber encontrado la oportunidad de cometer el robo perfecto. Su objetivo sera un ciego solitario, poseedor de miles de dolares ocultos. Pero tan pronto como entran en su casa seran conscientes de su error, pues se encontraran atrapados y luchando por sobrevivir contra un psicopata con sus propios y temibles secretos.
');
$fpdf->Ln();
$fpdf->Ln();

$fpdf->SetTextColor(26, 83, 255);
$fpdf->setFont('Arial','',18);
$fpdf->Write(5,'Actores principales');

$fpdf->Image('_img/_noRespires/Jane Levy.jpg',10,110,35);
$fpdf->Image('_img/_noRespires/Dylan Minnette.jpg',60,110,35);
$fpdf->Image('_img/_noRespires/Stephen Lang.jpg',110,110,35);
$fpdf->Image('_img/_noRespires/Daniel Zovatto.jpg',160,110,35);
$fpdf->Image('_img/_noRespires/Sergej Onopko.jpg',10,170,35);
$fpdf->Image('_img/_noRespires/Jonathon Robert Donahue.jpg',60,170,35);


$fpdf->SetTextColor(0, 0, 0);

$fpdf ->AddPage();

$fpdf->setFont('Arial','B',16);
$fpdf->SetFillColor(255, 255, 230);
$fpdf ->Cell(80,5,'Nombre de los actores',1,0,'',true);

$fpdf ->SetFillColor(255, 255, 230);
$fpdf ->Cell(80,5,'Apellidos',1,1,'',true);
$fpdf->Ln(0);

$fpdf->setFont('Arial','',12);

$fpdf ->Cell(80,5,'Jane ',1,0,false);
$fpdf ->Cell(80,5,'Levy',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,' Dylan ',1,0,false);
$fpdf ->Cell(80,5,'Minnette',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,'Stephen ',1,0,false);
$fpdf ->Cell(80,5,'Lang',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,'Daniel  ',1,0,false);
$fpdf ->Cell(80,5,'Zovatto',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,'Sergej  ',1,0,false);
$fpdf ->Cell(80,5,'Onopko',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,' Jonathon ',1,0,false);
$fpdf ->Cell(80,5,'O´Robert Donahue',1,0,false);


//$fpdf ->Footer(18,6,'Footer del pdf');
$fpdf ->Output();

?>
