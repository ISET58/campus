<?php



include "../config.php";
include "../includes/databaseTools.php";

new mysqli($host, $username, $password, $database);
$hora=time()-$duracionSesion;

$results = $db->query("SELECT * FROM inscriptos WHERE carrera='bancaria';");


$salidaXLS=array();


$salidaXLS["A1"]="Apellido";
$salidaXLS["B1"]="Nombre";
$salidaXLS["C1"]="DNI";
$salidaXLS["D1"]="E-mail";
$salidaXLS["E1"]="Lug. Nacimiento";
$salidaXLS["F1"]="Fecha Nacimiento";
$salidaXLS["G1"]="Nacionalidad";
$salidaXLS["H1"]="Estado Civil";
$salidaXLS["I1"]="Domicilio";
$salidaXLS["J1"]="Localidad";
$salidaXLS["K1"]="Telefono";
$salidaXLS["L1"]="Celular";
$salidaXLS["M1"]="Nivel estudios";
$salidaXLS["N1"]="Estado Estudios";
$salidaXLS["O1"]="Titulo";
$salidaXLS["P1"]="Institucion";
$salidaXLS["Q1"]="Trabaja";
$salidaXLS["R1"]="Lugar Trabajo";
$salidaXLS["S1"]="Tareas Trabajo";
$salidaXLS["T1"]="Dias TRabajo";
$salidaXLS["U1"]="Conformidad";
$salidaXLS["V1"]="Carrera";
$salidaXLS["W1"]="Fecha Pre-Inc";

$salidaXLS["X1"]="Doc Frente";
$salidaXLS["Y1"]="Doc Dorso";
$salidaXLS["Z1"]="Titulo Frente";
$salidaXLS["AA1"]="Titulo Dorso";





$f=2;

/////////////////////////////////////////////////////////////////////////////

while ($row = $results->fetch_assoc()) {

  

       
       $salidaXLS["A".$f]=$row["apellido"];
       $salidaXLS["B".$f]=$row["nombre"];
       $salidaXLS["C".$f]=$row["dni"];
       $salidaXLS["D".$f]=$row["email"];
       $salidaXLS["E".$f]=$row["lugar_nacimiento"];
       $salidaXLS["F".$f]=$row["fecha_nacimiento"];
       $salidaXLS["G".$f]=$row["nacionalidad"];
       $salidaXLS["H".$f]=$row["estado_civil"];
       $salidaXLS["I".$f]=$row["domicilio_real"];
       $salidaXLS["J".$f]=$row["localidad"];
       $salidaXLS["K".$f]=$row["telefono"];
       $salidaXLS["L".$f]=$row["Celular"];
       $salidaXLS["M".$f]=$row["nivel_estudios"];
       $salidaXLS["N".$f]=$row["estado_estudios"];
       $salidaXLS["O".$f]=$row["titulo_estudios"];
       $salidaXLS["P".$f]=$row["institucion"];
       $salidaXLS["Q".$f]=$row["trabaja"];
       $salidaXLS["R".$f]=$row["lugar_trabajo"];
       $salidaXLS["S".$f]=$row["tareas_trabajo"];
       $salidaXLS["T".$f]=$row["dias_trabajo"];
       $salidaXLS["U".$f]=$row["conformidad"];
       $salidaXLS["V".$f]="bancaria";
       $salidaXLS["W".$f]=date("d/m/Y H:i",$row["epochCreado"]);
       $salidaXLS["X".$f]='campus/preinscripcion2021/'.$row["doc1"];
	   $salidaXLS["Y".$f]='campus/preinscripcion2021/'.$row["doc2"];
       $salidaXLS["Z".$f]='campus/preinscripcion2021/'.$row["titulo1"];
       $salidaXLS["AA".$f]='campus/preinscripcion2021/'.$row["titulo2"];



   
   $f++;
   


}

////////////////////////////////////////////////////////////////////////////


//Including PHPExcel library and creation of its object
require('phpexcel/PHPExcel.php');
$phpExcel = new PHPExcel;
$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");

$sheet = $phpExcel ->getActiveSheet();


// Se establece el ancho de las columnas
$sheet->getColumnDimension('A')->setWidth(45);
$sheet->getColumnDimension('B')->setWidth(20);
$sheet->getColumnDimension('C')->setWidth(45);
$sheet->getColumnDimension('D')->setWidth(45);
$sheet->getColumnDimension('E')->setWidth(30);
$sheet->getColumnDimension('F')->setWidth(60);
$sheet->getColumnDimension('G')->setWidth(40);

$styleArray = array(
    'font'  => array(
        'bold'  => true,
        'color' => array('rgb' => '000000'),
        'size'  => 20,
        'name'  => 'Verdana'
    ));


// se le da estilo a la cabecera
$sheet->getStyle('A1')->applyFromArray($styleArray);
$sheet->getStyle('B1')->applyFromArray($styleArray);
$sheet->getStyle('C1')->applyFromArray($styleArray);
$sheet->getStyle('D1')->applyFromArray($styleArray);
$sheet->getStyle('E1')->applyFromArray($styleArray);
$sheet->getStyle('F1')->applyFromArray($styleArray);
$sheet->getStyle('G1')->applyFromArray($styleArray);



foreach ($salidaXLS as $key => $value) {

  echo $key. "-->".$value."<br>";

   $sheet ->getCell($key)->setValue($value);
  if(substr($value, 0, 7)=='http://') $sheet ->getCell($key)->getHyperlink()->setUrl($value);

  
  //$sheet->getColumnDimension($key)->setAutoSize(true);
}


// Save the spreadsheet
$writer->save('prebancaria.xlsx');


////////////////////////////////////////////////////////////
// funcion que  convierte un número en una letra 
// de columna de Excel. Pej:
// 1 -> A
// 26 -> Z
// 27 -> AA
// 28 -> AB
// 800 -> ADT
///////////////////////////////////////////////////////////
function columnaLetra($c){

    $c = intval($c);
    if ($c <= 0) return "";
    $letter = '';
    while($c!= 0){
       $p = ($c - 1) % 26;
       $c = intval(($c - $p) / 26);
       $letter = chr(65 + $p) . $letter;
    }
    
    return $letter;
        
}

?>