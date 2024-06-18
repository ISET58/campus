<?php



include "../config.php";
include "../includes/databaseTools.php";

new mysqli($host, $username, $password, $database);
$hora=time()-$duracionSesion;

$results = $db->query("SELECT * FROM inscriptosExamenes WHERE habilitado='si'");


$salidaXLS=array();


$salidaXLS["A1"]="ALUMNO";
$salidaXLS["B1"]="DNI";
$salidaXLS["C1"]="MATERIA";
$salidaXLS["D1"]="CARRERA";
$salidaXLS["E1"]="CONDICION";
$salidaXLS["F1"]="FECHA REGULARIZACION";
$salidaXLS["G1"]="MAIL";
$salidaXLS["H1"]="SE ANOTO";


$f=2;

/////////////////////////////////////////////////////////////////////////////

while ($row = $results->fetch_assoc()) {

   $userID=$row["userID"];
   $perfil=getUserProfile($userID);

   $nombre=$perfil["nombre"];
   $apellido=$perfil["apellido"];
   $dni=$perfil["dni"];
   $email=$perfil["email"];
   $carrera=getNombreCarrera($row["carreraID"]);
   $materia=getNombreMateria($row["materiaID"]);
   $condicion=$row["cursado"];
   $FechaRegular=$row["FechaRegular"];
   $fechaInscripcion=date("d/m/Y H:i",$row["epoch"]);

       
       $salidaXLS["A".$f]=$perfil["apellido"]." ".$perfil["nombre"];
       $salidaXLS["B".$f]=$dni;
       $salidaXLS["C".$f]=$materia;
       $salidaXLS["D".$f]=$carrera;
       $salidaXLS["E".$f]=$condicion;
       $salidaXLS["F".$f]=$FechaRegular;
       $salidaXLS["G".$f]=$email;
       $salidaXLS["H".$f]=$fechaInscripcion;
   
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
  //$sheet->getColumnDimension($key)->setAutoSize(true);
}


// Save the spreadsheet
$writer->save('examenes.xlsx');


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