<?php



new mysqli($host, $username, $password, $database);
$salida="apellido, nombre, dni, email, telefono, carrera".PHP_EOL;
$results = $db->query("SELECT * FROM inscriptos WHERE  activo='si' AND id > 5957");


echo "<pre>";

$salidaXLS=array();


$salidaXLS["A1"]="CARRERA";
$salidaXLS["B1"]="MATERIA";
$salidaXLS["C1"]="APELLIDO";
$salidaXLS["D1"]="NOMBRE";
$salidaXLS["E1"]="DNI";
$salidaXLS["F1"]="EMAIL";
$salidaXLS["G1"]="TELEFONO";

$f=2;
while ($row = $results->fetch_assoc()) {


	$userID=$row["userID"];
    $carreraID=$row["carreraID"];
    $materiaID=$row["materiaID"];
    $cursado=$row["cursado"];
   
    // se busca el nombre y apellido de usuario 
    $r=$db->query("SELECT * FROM usuarios WHERE  id=".$userID);
    $usuario=$r->fetch_assoc();


    // se busca el nombre de la materia y la carrea
    $r=$db->query("SELECT * FROM materias WHERE  id=".$materiaID);
    $mat=$r->fetch_assoc();

    $salidaXLS["A".$f]=$mat["carrera"];
    $salidaXLS["B".$f]=$mat["nombre"];
    $salidaXLS["C".$f]=$usuario["apellido"];
    $salidaXLS["D".$f]=$usuario["nombre"];
    $salidaXLS["E".$f]=$usuario["dni"];
    $salidaXLS["F".$f]=$usuario["email"];
    $salidaXLS["G".$f]=$usuario["telefono"];



$f++;
}


print_r($salidaXLS);






//Including PHPExcel library and creation of its object
require('phpexcel/PHPExcel.php');
$phpExcel = new PHPExcel;
$writer = PHPExcel_IOFactory::createWriter($phpExcel, "Excel2007");

$sheet = $phpExcel ->getActiveSheet();


// Se establece el ancho de las columnas
$sheet->getColumnDimension('A')->setWidth(45);
$sheet->getColumnDimension('B')->setWidth(70);
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
$writer->save('reinscripciones.xlsx');


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