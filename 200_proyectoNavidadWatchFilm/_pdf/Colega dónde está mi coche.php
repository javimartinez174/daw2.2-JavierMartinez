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
$fpdf ->Write(10,'Colega donde esta mi coche');
$fpdf->Ln();

$fpdf->setFont('Arial','',12);
$fpdf->Write(20,'Pelicula rodada en EEUU en el anio 2000');
//Saltos de linea

$fpdf->SetTextColor(173, 173, 235);

$fpdf->setFont('Arial','',18);
$fpdf ->Write(10,'Sinopsis de la pelicula');

$fpdf->Ln();
$fpdf->SetTextColor(0, 0, 0);
$fpdf->setFont('Arial','',12);
$fpdf->Write(10,'Tras un noche de juerga, dos amigos no recuerdan donde dejaron aparcado su coche. Su busqueda significara el comienzo de una serie de sorpresas. Todo empieza cuando los jovenes Jesse y Chester se despiertan una manana despues de una fiesta muy intensa, pero ninguno de los dos puede recordar que paso durante la noche anterior. El coche de Jesse desaparecio, y todo parece estar fuera de lugar, asi que los dos amigos comienzan la busqueda del auto y de pistas que les permita reconstruir la noche anterior, aunque a medida que profundizan en los acontecimientos de las ultimas veinticuatro horas, la situacion se convierte en una salvaje historia que parece extraida de la ciencia-ficcion
');
$fpdf->Ln();
$fpdf->Ln();

$fpdf->SetTextColor(0, 204, 153);
$fpdf->setFont('Arial','',18);
$fpdf->Write(5,'Actores principales');

$fpdf->Image('_img/_dondeEstaMiCoche/Ashton Kutcher.jpg',10,150,35);
$fpdf->Image('_img/_dondeEstaMiCoche/Charles O´Connell.jpg',60,150,35);
$fpdf->Image('_img/_dondeEstaMiCoche/David Herman.jpg',110,150,35);
$fpdf->Image('_img/_dondeEstaMiCoche/Jennifer Garner.jpg',160,150,35);
$fpdf->Image('_img/_dondeEstaMiCoche/Hal Harry Magee Sparks.jpg',10,210,35);
$fpdf->Image('_img/_dondeEstaMiCoche/Kristel Noel Swanson.jpg',60,210,35);
$fpdf->Image('_img/_dondeEstaMiCoche/Marla Lynne Sokoloff.jpg',110,210,35);
$fpdf->Image('_img/_dondeEstaMiCoche/Seann William Scott.jpg',160,210,35);

$fpdf->SetTextColor(0, 0, 0);

$fpdf ->AddPage();

$fpdf->setFont('Arial','B',16);
$fpdf->SetFillColor(255, 255, 230);
$fpdf ->Cell(80,5,'Nombre de los actores',1,0,'',true);

$fpdf ->SetFillColor(255, 255, 230);
$fpdf ->Cell(80,5,'Apellidos',1,1,'',true);
$fpdf->Ln(0);

$fpdf->setFont('Arial','',12);

$fpdf ->Cell(80,5,'Ashton',1,0,false);
$fpdf ->Cell(80,5,'Kutcher',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,'Seann',1,0,false);
$fpdf ->Cell(80,5,'William Scott',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,'Jennifer',1,0,false);
$fpdf ->Cell(80,5,'Garner',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,'Kristel ',1,0,false);
$fpdf ->Cell(80,5,'Noel Swanson',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,'David ',1,0,false);
$fpdf ->Cell(80,5,'Herman',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,' Charles',1,0,false);
$fpdf ->Cell(80,5,'O´Connell',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,' Marla',1,0,false);
$fpdf ->Cell(80,5,'O´ Lynne Sokoloff',1,0,false);
$fpdf->Ln(5);
$fpdf ->Cell(80,5,' Hal Harry ',1,0,false);
$fpdf ->Cell(80,5,'Magee Sparks',1,0,false);

//$fpdf ->Footer(18,6,'Footer del pdf');
$fpdf ->Output();

?>