<?php



$db = new mysqli($host, $username, $password, $database);
$salida="apellido, nombre, dni, email, telefono, carrera".PHP_EOL;
$results = $db->query("SELECT * FROM usuarios WHERE habilitado='si'");


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
    
    $userID=$row["ID"];
    $nombre=$row["nombre"];
    $apellido=$row["apellido"];
    $email=$row["email"];
    $dni=$row["dni"];
    $telefono=$row["telefono"];

    //para evitar filas vacias
    if($apellido=="" && $email=="")continue;
 
    // se buscan las materias en las que se inscribio el usuario
    $r=$db->query("SELECT * FROM inscriptos WHERE userID='".$userID."' AND activo='si'");
    // itera por todas la materias en las que se inscribio el alumno
    while($m=$r->fetch_assoc()){
      
       $materiaID=$m["materiaID"];
       $res=$db->query("SELECT * FROM materias WHERE ID='".$materiaID."'");
       $mat=$res->fetch_assoc();
      
       $salidaXLS["A".$f]=$mat["carrera"];
       $salidaXLS["B".$f]=$mat["nombre"];
       $salidaXLS["C".$f]=$apellido;
       $salidaXLS["D".$f]=$nombre;
       $salidaXLS["E".$f]=$dni;
       $salidaXLS["F".$f]=$email;
       $salidaXLS["G".$f]=$telefono;
      
       $f++;
      
    }


   
   
    
    
}





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
$writer->save('materias-alumnos.xlsx');


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