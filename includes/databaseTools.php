<?php


/////////////////////////////////////////////////////////////////////////
// primero que nada se abre la base de datos para obtener un manejador
// global del objeto de base de datos
/////////////////////////////////////////////////////////////////////////

$host = 'localhost';
$database = 'iset';
$username = 'root';
$password = '';

global $db;
$db= new mysqli($host, $username, $password, $database);
if ($db->connect_error) {
    die("Connection failed: " . $db->connect_error);
}

/////////////////////////////////////////////////////////////////////////////////
// FUNCION LISTAR
//
// Parte del sistema CRUD (Create Read Update Delete - ABM)
// lista una tabla de la base de datos
// con campos determinados y
// y muestr la interface html para intereactuar
// con dicha tabla y campos
//
//   $tabla     ->  es la tabla que se quiere listar (string)
//   $campos    ->  son los campos que se van a lista (array de strings)
//   $condicion ->  una string sql con la condicione/s que debe cumpli el listado
//   $plantilla ->  es el nombre de la plantilla que se usara para mostrar el
//                  el listado y ademas el nombre que se usara para diferenciar
//                  las funciones javascript de la plantilla y algunas
//                  clases e identificadores html
//   $cantidad  ->  La cantidad de campos a listar
//   $offset    ->  el offset desde el cual se empieza a listas(para paginar)
///////////////////////////////////////////////////////////////////////////////
function listar($tabla, $campos, $plantilla, $condicion = null, $cantidad = null, $offset = null)
{

    // el manejador global de la DB abierta
    global $db;

    // se arma la string de campos para el sql
    $StringCampos = implode(", ", $campos);

    // se arma la string de condicion
    $StringCondicion = "";
    if ($condicion != null)
        $StringCondicion = " WHERE " . $condicion;


    // se establecen los limites de la consulta por si es
    // necesaria una paginacion
    $limites = "";
    if ($cantidad != null)
        $limites = " LIMIT 0, " . $cantidad;
    if ($offset != null)
        $limites = " LIMIT " . $offset . ", " . $cantidad . " ";


    // se realiza una consulta sql para ver cuantas filas son
    // devueltas y ver como se realiza la paginacion
    $querytotal = $db->query("SELECT COUNT(*) as count" . " FROM " . $tabla . $StringCondicion)->fetch_assoc();
    $cantidadFilas = $querytotal['count'];

    // se establecen a cantidad de paginas para la paginacion
    $paginas = 0;
    if ($cantidad != null && $cantidad > 0)
        $paginas = $cantidadFilas / $cantidad;

    //////////////////////////////////
    //SE ARMAR EL PAGINADOR
    $slots = array();
    if ($paginas > 1) {
        $salto = 0;
        if ($cantidad != null && $cantidad > 0)
            $paginaActiva = floor($offset / $cantidad);
        for ($i = 0; $i <= $paginas; $i++) {
            $slots[$i]["pagina"] = $i + 1;
            $slots[$i]["cantidad"] = $salto;
            $clase = "";
            if ($i == $paginaActiva)
                $clase = "activa";
            $slots[$i]["clase"] = $clase;
            $salto += $cantidad;
        }

    }


    //
    /////////////////////////////////////

    // se arma la consulta sql
    $sqlquery = "SELECT " . $StringCampos . " FROM " . $tabla . $StringCondicion . $limites;

    // se realiza la consulta sql
    $results = $db->query($sqlquery);

    // se transforma el resultado de la consulta en una array
    $datos = array();
    while ($row = $results->fetch_assoc()) {
        $datos[] = $row;
    }


    if ($offset == null)
        $offset = 0;

    // se carga la plantilla, se reaiza la fusion
    // con los datos y se muestra
    $template = "../templates/" . $plantilla . ".html";
    include_once ('../includes/tbs_class.php');
    $TBS = new clsTinyButStrong;
    $TBS->LoadTemplate($template);

    // tbs accede solo a variables globales o que
    // se hayan declarado en VarRef por eso hay que hacer esto
    $TBS->VarRef['paginas'] = $paginas;
    $TBS->VarRef['plantilla'] = $plantilla;
    $TBS->VarRef['offsetPagina'] = $offset;
    $TBS->MergeBlock('bloque1', $datos);
    $TBS->MergeBlock('bloque2', $slots);
    $TBS->Show();
}

/////////////////////////////////////////////////////////////////////////////////
// FUNCION LISTARMENSAJES
/////////////////////////////////////////////////////////////////////////////////**
function listarMensajes($tabla, $campos, $plantilla, $condicion = null, $cantidad = null, $offset = null)
{

    global $db;
    // Verificar si hay errores en la conexión
    if ($db->connect_error) {
        die("Connection failed: " . $db->connect_error);
    }

    // Se arma la string de campos para el SQL
    $StringCampos = implode(", ", $campos);

    // Se arma la string de condición
    $StringCondicion = "";
    if ($condicion != null) {
        $StringCondicion = " WHERE " . $condicion;
    }

    // Se establecen los límites de la consulta por si es necesaria una paginación
    $limites = "";
    if ($cantidad != null) {
        $limites = " LIMIT 0, " . $cantidad;
    }
    if ($offset != null) {
        $limites = " LIMIT " . $offset . ", " . $cantidad . " ";
    }

    // Se realiza una consulta SQL para ver cuántas filas son devueltas y ver cómo se realiza la paginación
    $querytotal = $db->query("SELECT COUNT(*) as count FROM " . $tabla . $StringCondicion)->fetch_assoc();
    $cantidadFilas = $querytotal['count'];

    // Se establecen la cantidad de páginas para la paginación
    $paginas = 0;
    if ($cantidad != null && $cantidad > 0) {
        $paginas = ceil($cantidadFilas / $cantidad);
    }

    // SE ARMA EL PAGINADOR
    $slots = array();
    if ($paginas > 1) {
        $salto = 0;
        $paginaActiva = 0;
        if ($cantidad != null && $cantidad > 0) {
            $paginaActiva = floor($offset / $cantidad);
        }
        for ($i = 0; $i < $paginas; $i++) {
            $slots[$i]["pagina"] = $i + 1;
            $slots[$i]["cantidad"] = $salto;
            $clase = "";
            if ($i == $paginaActiva) {
                $clase = "activa";
            }
            $slots[$i]["clase"] = $clase;
            $salto += $cantidad;
        }
    }

    // Se arma la consulta SQL
    $sqlquery = "SELECT " . $StringCampos . " FROM " . $tabla . $StringCondicion . $limites;

    // Se realiza la consulta SQL
    $results = $db->query($sqlquery);

    // Se transforma el resultado de la consulta en una array
    $datos = array();
    while ($row = $results->fetch_assoc()) {
        $datos[] = $row;
    }

    if ($offset == null) {
        $offset = 0;
    }

    // Se carga la plantilla, se realiza la fusión con los datos y se muestra
    $template = "../templates/" . $plantilla . ".html";
    include_once('../includes/tbs_class.php');
    $TBS = new clsTinyButStrong;
    $TBS->LoadTemplate($template);

    // TBS accede solo a variables globales o que se hayan declarado en VarRef por eso hay que hacer esto
    $TBS->VarRef['paginas'] = $paginas;
    $TBS->VarRef['plantilla'] = $plantilla;
    $TBS->VarRef['offsetPagina'] = $offset;
    $TBS->MergeBlock('bloque1', $datos);
    $TBS->MergeBlock('bloque2', $slots);
    $TBS->Show();

    // Cerrar la conexión
    $db->close();
}





/////////////////////////////////////////////////////////////////////////////////
// FUNCION BUSCAR
//
// Parte del sistema CRUD (Create Read Update Delete - ABM)
// lista una tabla de la base de datos
// con campos determinados y
// y muestr la interface html para intereactuar
// con dicha tabla y campos
//
//   $tabla     ->  es la tabla que se quiere listar (string)
//   $campos    ->  son los campos que se van a lista (array de strings)
//   $condicion ->  una string sql con la condicione/s que debe cumpli el listado
//   $plantilla ->  es el nombre de la plantilla que se usara para mostrar el
//                  el listado y ademas el nombre que se usara para diferenciar
//                  las funciones javascript de la plantilla y algunas
//                  clases e identificadores html
//   $cantidad  ->  La cantidad de campos a listar
//   $offset    ->  el offset desde el cual se empieza a listas(para paginar)
///////////////////////////////////////////////////////////////////////////////
function buscar($tabla, $campos, $plantilla, $busqueda = null, $condicion = "")
{


    $cantidad = null;
    $offset = null;
    // el manejador global de la DB abierta
    global $db;

    // se arma la string de campos para el sql
    $StringCampos = implode(", ", $campos);

    $cantidadFilas = 0;

    // se establecen a cantidad de paginas para la paginacion
    $paginas = 0;
    if ($cantidad != null && $cantidad > 0)
        $paginas = $cantidadFilas / $cantidad;

    //////////////////////////////////
    //SE ARMAR EL PAGINADOR
    $slots = array();
    if ($paginas > 1) {
        $salto = 0;
        if ($cantidad != null && $cantidad > 0)
            $paginaActiva = floor($offset / $cantidad);
        for ($i = 0; $i <= $paginas; $i++) {
            $slots[$i]["pagina"] = $i + 1;
            $slots[$i]["cantidad"] = $salto;
            $clase = "";
            if ($i == $paginaActiva)
                $clase = "activa";
            $slots[$i]["clase"] = $clase;
            $salto += $cantidad;
        }

    }

    // busca columna por columna a traves de un like
    // y si encuentra algo lo va sumando a la salida ($datos)
    // antes de sumarlo a la salida, comprueba que ya no este
    // para evitar duplicados
    $datos = array();
    $idEncontrado = array();
    foreach ($campos as $key => $value) {

        $sqlquery = "SELECT " . $StringCampos . " FROM " . $tabla . " WHERE " . $value . " LIKE  " . "'%" . $busqueda . "%' " . $condicion;
        $results = $db->query($sqlquery);
        while ($row = $results->fetch_assoc()) {
            // ya seencontro una fila con este ID?
            // si es asi no se suma porque ya esta!!
            if (!in_array($row["ID"], $idEncontrado)) {
                $datos[] = $row;
                $idEncontrado[] = $row["ID"];
            }



        }
    }


    if ($offset == null)
        $offset = 0;

    // se carga la plantilla, se reaiza la fusion
    // con los datos y se muestra
    $template = "../templates/" . $plantilla . ".html";
    include_once ('../includes/tbs_class.php');
    $TBS = new clsTinyButStrong;
    $TBS->LoadTemplate($template);

    // tbs accede solo a variables globales o que
    // se hayan declarado en VarRef por eso hay que hacer esto
    $TBS->VarRef['paginas'] = $paginas;
    $TBS->VarRef['plantilla'] = $plantilla;
    $TBS->VarRef['offsetPagina'] = $offset;
    $TBS->MergeBlock('bloque1', $datos);
    $TBS->MergeBlock('bloque2', $slots);
    $TBS->Show();
}



///////////////////////////////////////////////
// funcion para insertar en la base de datos
///////////////////////////////////////////////
function insertar($tabla, $campos, $valores)
{
    global $db;

    // primero se verifica que haya la misma cantidad
    // de valores que de campos
    if (count($campos) != count($valores)) {
        echo "Está intentando hacer un insert en la BDD<br>";
        echo "pero la cantidad de valores y campos no coinciden<br>";
        echo "Campus DOA debug";
        exit;
    }

    // se arma la string de campos y valores para el SQL
    $StringValores = "('" . implode("', '", $valores) . "')";
    $StringCampos = "(" . implode(", ", $campos) . ")";

    $sqlquery = "INSERT INTO " . $tabla . " " . $StringCampos . " VALUES " . $StringValores . " ";
    $results = $db->query($sqlquery);

    if ($results == TRUE) {
        return $db->insert_id;  // Aquí se corrige para acceder a la propiedad insert_id
    } else {
        echo "Error: " . $sqlquery . "<br>" . $db->error;
        return false;
    }
}



///////////////////////////////////////////////
function actualizarPorID($tabla, $id, $campos, $valores)
{

    global $db;

    // primero se verifica que alla la misma cantidad
    // de valores que de campos
    if (count($campos) != count($valores)) {
        echo "Esta intentando hacer un UPDTAE el la BDD<br>";
        echo "pero la cantidad de valores y campos no coinciden<br>";
        echo "Campus DOA debug";
        exit;
    }

    $subquery = "";
    foreach ($campos as $key => $value) {

        if ($key > 0)
            $subquery .= ", ";
        $subquery .= $value . "='" . $valores[$key] . "'";


    }


    $sqlquery = "UPDATE " . $tabla . " SET " . $subquery . " WHERE ID= " . $id . " ";




    $results = $db->query($sqlquery);

    //$sqlquery="INSERT INTO circulacion (asignados, devueltos,vendidos) VALUES ('$asignados', '$devueltos', '$vendidos') " ;

}



///////////////////////////////////////////////
// funcion que busca si un valor esta en
// un campo de una tabla en la BDD
// devuelve true si esta
// false si no esta
///////////////////////////////////////////////
function estaEnlaBDD($tabla, $campo, $valor)
{

    global $db;

    $sqlquery = "SELECT 1 FROM " . $tabla . " WHERE " . $campo . "='" . $valor . "' AND estado='activo'";
    $results = $db->query($sqlquery);
    $row = $results->fetch_assoc();


    if ($row > 0)
        return true;
    return false;
}


///////////////////////////////////////////////
function login($email, $password)
{

    global $db;
    $password = 'test';//hardcodeado
    $sqlquery = "SELECT * FROM usuarios WHERE email='" . $email . "' AND password='" . $password . "' AND estado='activo'";
    $results = $db->query($sqlquery);
    $row = $results->fetch_assoc();

    if ($row > 0)
        return $row["ID"];
    return false;
}

///////////////////////////////////////////////
function getUserProfile($id)
{

    global $db;

    $sqlquery = "SELECT * FROM usuarios WHERE ID='" . $id . "' AND estado='activo'";
    $results = $db->query($sqlquery);

    // se transforma el resultado de la consulta en una array
    $datos = array();
    while ($row = $results->fetch_assoc()) {
        $datos[] = $row;
    }


    return $datos[0];
}

///////////////////////////////////////////////
function materiasPorCarrera($carreraID, $userID, $year)
{

    global $db;


    // se busca si esta inscripto en alguna carrera
    //se buscan los datos del usuario receptor
    $sqlquery = "SELECT DISTINCT materiaID, cursado FROM inscriptos WHERE userID='" . $userID . "'";
    $results = $db->query($sqlquery);
    $carreras = array();
    $cursado = array();
    while ($row = $results->fetch_assoc()) {
        $carreras[] = $row["materiaID"];
        $cursado[] = $row["cursado"];
    }

    ///////////////////////////////////

    $sqlquery = "SELECT * FROM materias WHERE carreraID='" . $carreraID . "' AND estado='activo' and habilitado='si' ORDER BY year ASC";

    if ($year != 0)
        $sqlquery = "SELECT * FROM materias WHERE carreraID='" . $carreraID . "' AND estado='activo' and habilitado='si' AND year='" . $year . "' ORDER BY year ASC";



    $results = $db->query($sqlquery);

    // se transforma el resultado de la consulta en una array
    $datos = array();
    $i = 1;
    $ano = 0;
    while ($row = $results->fetch_assoc()) {
        $row["numero"] = $i;

        $row["status"] = "";
        $row["bg"] = "white";
        if (in_array($row["ID"], $carreras)) {
            $row["statusCursado"] = "checked";
            $row["bg"] = "cyan";
            $row["status"] = "checked";
        }

        $row["ano"] = "";
        if ($ano != $row["year"]) {
            $ano = $row["year"];
            if ($ano == 1)
                $row["ano"] = '<h5 class="f-title">Primer año</h5>';
            if ($ano == 2)
                $row["ano"] = '<br><h5 class="f-title">Segundo año</h5>';
            if ($ano == 3)
                $row["ano"] = '<br><h5 class="f-title">Tercer año</h5>';
        }

        $datos[] = $row;
        $i++;
    }


    return $datos;
}

///////////////////////////////////////////////
function examenesPorCarrera($carreraID, $userID, $year)
{

    global $db;


    // se busca si esta inscripto en alguna carrera
    //se buscan los datos del usuario receptor
    $sqlquery = "SELECT DISTINCT materiaID, cursado, fechaRegular  FROM inscriptosExamenes WHERE userID='" . $userID . "' and habilitado='si'";
    $results = $db->query($sqlquery);
    $examenes = array();
    $cursado = array();


    /*while ($row = $results->fetch_assoc()) {
        $examenes[] = $row["materiaID"];
        $cursado[] = $row["cursado"];
        $FechaRegular[] = $row["FechaRegular"];

    }*/

    while ($row = $results->fetch_assoc()) {
        $examenes[] = $row["materiaID"];
        $cursado[] = $row["cursado"];
        
        // Verificar si existe la clave "FechaRegular" en $row antes de agregarla a $FechaRegular
        if (isset($row["FechaRegular"])) {
            $FechaRegular[] = $row["FechaRegular"];
        } else {
            $FechaRegular[] = null; // O asignar un valor por defecto
        }
    }

    ///////////////////////////////////

    $sqlquery = "SELECT * FROM materias WHERE carreraID='" . $carreraID . "' AND estado='activo' and habilitado='si' ORDER BY year ASC";

    if ($year != 0)
        $sqlquery = "SELECT * FROM materias WHERE carreraID='" . $carreraID . "' AND estado='activo' and habilitado='si' AND year='" . $year . "' ORDER BY year ASC";



    $results = $db->query($sqlquery);

    // se transforma el resultado de la consulta en una array
    $datos = array();
    $i = 1;
    $ano = 0;
    while ($row = $results->fetch_assoc()) {
        $row["numero"] = $i;

        $row["statusCursado"] = "checked";
        $row["fechaRegular"] = "";
        $row["status"] = "";
        $row["bg"] = "white";
        if (in_array($row["ID"], $examenes)) {

            $k = array_search($row["ID"], $examenes);

            if ($cursado[$k] == "libre")
                $row["statusCursado"] = "";
            $row["fechaRegular"] = $FechaRegular[$k];

            $row["bg"] = "cyan";
            $row["status"] = "checked";
        }

        $row["ano"] = "";
        if ($ano != $row["year"]) {
            $ano = $row["year"];
            if ($ano == 1)
                $row["ano"] = '<h5 class="f-title">Primer año</h5>';
            if ($ano == 2)
                $row["ano"] = '<br><h5 class="f-title">Segundo año</h5>';
            if ($ano == 3)
                $row["ano"] = '<br><h5 class="f-title">Tercer año</h5>';
        }

        $datos[] = $row;
        $i++;
    }


    return $datos;
}


///////////////////////////////////////////////////
function guardarGUID($guid, $userID)
{

    global $db;

    $epoch = time();

    $sqlquery = "INSERT INTO sesiones (epoch, guid, userID ) VALUES ('$epoch','$guid', '$userID') ";
    $results = $db->query($sqlquery);


}

///////////////////////////////////////////////////
function verificarsesion($sesionID)
{
    global $db;
    global $duracionSesion;

    $sqlquery = "SELECT * FROM sesiones WHERE guid='" . $sesionID . "'";
    $results = $db->query($sqlquery);   
    $results = $db->query($sqlquery);   
    $row = $results->fetch_assoc();

    if ($row > 0) {
        $ahora = time();
        $dif = time() - $row["epoch"];
        // si la sesion expiro, se borra y se envia false
        if ($dif > $duracionSesion) {
            $sqlquery = "DELETE FROM sesiones WHERE  guid='" . $sesionID . "'";
            $results = $db->query($sqlquery);
            return false;
        }

        return true;
    }

    return false;

}



///////////////////////////////////////////////
// funcion que borra un renglon de una tabla
// por la ID del renglon
//////////////////////////////////////////////
function borrarPorID($tabla, $id)
{

    global $db;

    $sqlquery = "DELETE FROM " . $tabla . " WHERE ID ='" . $id . "'";
    $results = $db->query($sqlquery);
    return true;
}
function borrarTodos()
{
    global $db;

    $sqlquery = "DELETE FROM usuarios WHERE estado = 'inactivo'";
    $results = $db->query($sqlquery);
        return true;

}



//////////////////////////////////////////////
function reciclar($id)
{
    global $db;
    $sqlquery = "UPDATE usuarios SET estado = 'activo' WHERE ID ='" . $id . "'";
    $results = $db->query($sqlquery);
    return true;
}




///////////////////////////////////////////////
// funcion que borra un usuario
// en realidad no lo borra, lo pasa a inactivo
//////////////////////////////////////////////
function borrarUsuario($id)
{
    global $db;
    $sqlquery = "UPDATE usuarios SET estado = 'inactivo' WHERE ID ='" . $id . "'";
    $results = $db->query($sqlquery);
    return true;
}

//////////////////////////////////////////////
function borrarCarrera($id)
{
    global $db;
    $sqlquery = "UPDATE carreras SET estado = 'inactivo' WHERE ID ='" . $id . "'";
    $results = $db->query($sqlquery);
    return true;
}


//////////////////////////////////////////////
function borrarInscripcion($id)
{
    global $db;
    $sqlquery = "UPDATE inscripciones SET estado = 'inactivo' WHERE ID ='" . $id . "'";
    $results = $db->query($sqlquery);
    return true;
}


//////////////////////////////////////////////
function borrarExamen($id)
{
    global $db;
    $sqlquery = "UPDATE examenes SET estado = 'inactivo' WHERE ID ='" . $id . "'";
    $results = $db->query($sqlquery);
    return true;
}



//////////////////////////////////////////////
function borrarMateria($id)
{
    global $db;
    $sqlquery = "UPDATE materias SET estado = 'inactivo' WHERE ID ='" . $id . "'";
    $results = $db->query($sqlquery);
    return true;
}




///////////////////////////////////////////////
function deshabilitarUsuario($id)
{
    global $db;
    $sqlquery = "UPDATE usuarios SET habilitado = 'no' WHERE ID ='" . $id . "'";
    $results = $db->query($sqlquery);
    return true;
}

///////////////////////////////////////////////
function deshabilitarCarrera($id)
{
    global $db;
    $sqlquery = "UPDATE carreras SET habilitado = 'no' WHERE ID ='" . $id . "'";
    $results = $db->query($sqlquery);
    return true;
}


///////////////////////////////////////////////
function deshabilitarInscripcion($id)
{
    global $db;
    $sqlquery = "UPDATE inscripciones SET habilitado = 'no' WHERE ID ='" . $id . "'";
    $results = $db->query($sqlquery);
    return true;
}


///////////////////////////////////////////////
function deshabilitarExamen($id)
{
    global $db;
    $sqlquery = "UPDATE examenes SET habilitado = 'no' WHERE ID ='" . $id . "'";
    $results = $db->query($sqlquery);
    return true;
}


///////////////////////////////////////////////
function deshabilitarMateria($id)
{
    global $db;
    $sqlquery = "UPDATE materias SET habilitado = 'no' WHERE ID ='" . $id . "'";
    $results = $db->query($sqlquery);
    return true;
}



///////////////////////////////////////////////
function habilitarInscripcion($id)
{
    global $db;
    $sqlquery = "UPDATE inscripciones SET habilitado = 'si' WHERE ID ='" . $id . "'";
    $results = $db->query($sqlquery);
    return true;
}


///////////////////////////////////////////////
function habilitarCarrera($id)
{
    global $db;
    $sqlquery = "UPDATE carreras SET habilitado = 'si' WHERE ID ='" . $id . "'";
    $results = $db->query($sqlquery);
    return true;
}



///////////////////////////////////////////////
function habilitarUsuario($id)
{
    global $db;
    $sqlquery = "UPDATE usuarios SET habilitado = 'si' WHERE ID ='" . $id . "'";
    $results = $db->query($sqlquery);
    return true;
}

///////////////////////////////////////////////
function habilitarMateria($id)
{
    global $db;
    $sqlquery = "UPDATE materias SET habilitado = 'si' WHERE ID ='" . $id . "'";
    $results = $db->query($sqlquery);
    return true;
}


///////////////////////////////////////////////
function habilitarExamen($id)
{
    global $db;
    $sqlquery = "UPDATE examenes                                             SET habilitado = 'si' WHERE ID ='" . $id . "'";
    $results = $db->query($sqlquery);
    return true;
}


///////////////////////////////////////////////
function getCarreras()
{
    global $db;
    $sqlquery = "SELECT ID, nombre FROM carreras WHERE estado='activo' AND habilitado='si'";
    $results = $db->query($sqlquery);
    // se transforma el resultado de la consulta en una array
    $datos = array();
    while ($row = $results->fetch_assoc()) {
        $datos[] = $row;
    }

    return $datos;
}


/////////////////////////////////////////////////
function usuarioPorID($id)
{

    global $db;

    $sqlquery = "SELECT * FROM usuarios WHERE ID='" . $id . "'";
    $results = $db->query($sqlquery);
    $row = $results->fetch_assoc();
    return $row;
}

/////////////////////////////////////////////////
function usuarioPorEMAIL($email)
{

    global $db;

    $sqlquery = "SELECT * FROM usuarios WHERE email='" . $email . "'";
    $results = $db->query($sqlquery);
    $row = $results->fetch_assoc();
    return $row;
}



///////////////////////////////////////////////
function usuarioPorUID($uid)
{

    global $db;

    $sqlquery = "SELECT * FROM usuarios WHERE verificado='" . $uid . "'";
    $results = $db->query($sqlquery);
    $row = $results->fetch_assoc();
    return $row;
}




///////////////////////////////////////////////
function listarDatos()
{
    global $db;
    
    $salida = array();

    // Alumnos habilitados
    $columnas = $db->query("SELECT COUNT(*) as count FROM usuarios WHERE tipo='alumno' AND estado='activo' AND habilitado='si' ");
    $cantidadCol = $columnas->fetch_assoc();
    $numRows = $cantidadCol['count'];
    $salida["habilitados"] = $numRows;

    // Alumnos no habilitados
    $columnas = $db->query("SELECT COUNT(*) as count FROM usuarios WHERE tipo='alumno' AND estado='activo' AND habilitado='no' ");
    $cantidadCol = $columnas->fetch_assoc();
    $numRows = $cantidadCol['count'];
    $salida["deshabilitados"] = $numRows;


    // profesores habilitados
    $columnas = $db->query("SELECT COUNT(*) as count FROM usuarios WHERE tipo='profesor' AND estado='activo' AND habilitado='si' ");
    $cantidadCol = $columnas->fetch_assoc();
    $numRows = $cantidadCol['count'];
    $salida["profesores"] = $numRows;



    // profesores no habilitados
    $columnas = $db->query("SELECT COUNT(*) as count FROM usuarios WHERE tipo='profesor' AND estado='activo' AND habilitado='no' ");
    $cantidadCol = $columnas->fetch_assoc();
    $numRows = $cantidadCol['count'];
    $salida["profesdeshabilitados"] = $numRows;



    return $salida;




}


///////////////////////////////////////////////


function mensaje($user_id, $tipo = null, $texto = null, $imagen = null, $url = null, $group_id = null, $emisor_id = null, $formato = null)
{


    $host = 'localhost';
    $database = 'iset';
    $username = 'root';
    $password = '';

    $dbmensajes = new mysqli($host, $username, $password, $database);


    global $db;


    $epoch = time();

    //se buscan los datos del usuario receptor
    $sqlquery = "SELECT * FROM usuarios WHERE ID='" . $user_id . "'";
    $results = $db->query($sqlquery);
    $row = $results->fetch_assoc();

    $nombre = "";
    $apellido = "";
    $email = "";


    if (isset($row["email"]))
        $email = $row["email"];
    if (isset($row["nombre"]))
        $nombre = $row["nombre"];
    if (isset($row["apellido"]))
        $apellido = $row["apellido"];

    //se buscan los datos del usuario emisor
    $sqlquery = "SELECT 1 FROM usuarios WHERE ID='" . $emisor_id . "'";
    $results = $db->query($sqlquery);
    $row = $results->fetch_assoc();

    $emisor = $nombre . " " . $apellido;

    if ($emisor_id == -1) {
        global $institucion;
        global $institucion_id;
        $emisor = $institucion;
        $emisor_id = $institucion_id;
    }



    // se arma la string de campos y valores para el sql
    $StringValores = "('" . $user_id . "','" . $tipo . "', '" . $texto . "', '" . $imagen . "', '" . $url . "', '" . $group_id . "', '" . $emisor . "', '" . $epoch . "', '" . $emisor_id . "','" . $nombre . "', '" . $apellido . "', '" . $email . "', '" . $formato . "')";
    $StringCampos = "(user_id, tipo, texto, imagen, url, group_id, emisor, epoch, emisor_id, nombre, apellido, email, formato)";

    $sqlquery = "INSERT INTO mensajes " . $StringCampos . " VALUES " . $StringValores . " ";
    $results = $dbmensajes->query($sqlquery);

    //$sqlquery="INSERT INTO circulacion (asignados, devueltos,vendidos) VALUES ('$asignados', '$devueltos', '$vendidos') " ;

}

///////////////////////////////////////////////

function cargarMensajes($userID)
{

    $host = 'localhost';
    $database = 'iset';
    $username = 'root';
    $password = '';


    $dbmensajes = new mysqli($host, $username, $password, $database);


    global $db;

    //se buscan los datos del usuario receptor
    $sqlquery = "SELECT * FROM mensajes WHERE user_id='" . $userID . "' OR tipo='broadcast' ORDER BY epoch DESC;";
    $results = $dbmensajes->query($sqlquery);
    // se transforma el resultado de la consulta en una array

    $datos = array();
    while ($row = $results->fetch_assoc()) {

        // se busca el avatar del emisor
        $emisor_id = $row["emisor_id"];
        if ($emisor_id == -1) {
            global $avatar_Institucion;
            $row["avatar_Emisor"] = $avatar_Institucion;
            $row["redondear"] = "border-radius: 0px;";
        } else {
            $sqlquery = "SELECT * FROM usuarios WHERE ID='" . $emisor_id . "'";
            $r = $db->query($sqlquery);
            $m = $r->fetch_assoc();
            $row["avatar_Emisor"] = $m["foto"];
            if ($row["avatar_Emisor"] == "")
                $row["avatar_Emisor"] = "avatares/propios/general.png";
            $row["redondear"] = "border-radius: 100%;";
        }

        $row["borrar"] = "inline-block";
        if ($row["tipo"] == 'broadcast')
            $row["borrar"] = "none";

        $row["fecha"] = ' el ' . date("d/m/y", $row["epoch"]) . ' a las ' . date("H:i:s", $row["epoch"]);



        $datos[] = $row;
    }

    return $datos;



}

///////////////////////////////////////////////

function cargarReInscripciones($userID)
{
    global $db;


    // se busca si esta inscripto en alguna carrera
    //se buscan los datos del usuario receptor
    $sqlquery = "SELECT DISTINCT carreraID FROM inscriptos WHERE userID='" . $userID . "'";
    $results = $db->query($sqlquery);
    $carreras = array();
    while ($row = $results->fetch_assoc()) {
        $carreras[] = $row["carreraID"];
    }


    //se buscan los datos del usuario receptor
    $sqlquery = "SELECT * FROM inscripciones WHERE tipo='reinscripcion' AND habilitado='si' AND estado='activo'";
    $results = $db->query($sqlquery);
    // se transforma el resultado de la consulta en una array
    $datos = array();
    while ($row = $results->fetch_assoc()) {

        $row["color"] = "#088DCD";
        $row["status"] = "no inscripto";
        if (in_array($row["carreraID"], $carreras)) {
            $row["color"] = "#02941f";
            $row["status"] = "inscripto";

        }


        $datos[] = $row;
    }

    return $datos;



}

///////////////////////////////////////////////

function cargarExamenes($userID)
{
    global $db;


    // se busca si ya se anoto en alguna examen de materia
    $sqlquery = "SELECT DISTINCT carreraID FROM inscriptosExamenes WHERE userID='" . $userID . "'";
    $results = $db->query($sqlquery);
    $carreras = array();
    while ($row = $results->fetch_assoc()) {
        $carreras[] = $row["carreraID"];
    }


    //se buscan los datos del usuario receptor
    $sqlquery = "SELECT * FROM examenes WHERE  habilitado='si' AND estado='activo'";
    $results = $db->query($sqlquery);
    // se transforma el resultado de la consulta en una array
    $datos = array();
    while ($row = $results->fetch_assoc()) {

        $row["color"] = "#E44526";
        $row["status"] = "no inscripto";
        if (in_array($row["carreraID"], $carreras)) {
            $row["color"] = "#02941f";
            $row["status"] = "inscripto";

        }


        $datos[] = $row;
    }


    return $datos;



}

///////////////////////////////////////////////

function cargarInscripciones($userID)
{
    global $db;


    // se busca si esta inscripto en alguna carrera
    //se buscan los datos del usuario receptor
    $sqlquery = "SELECT DISTINCT carreraID FROM inscriptos WHERE userID='" . $userID . "'";
    $results = $db->query($sqlquery);
    $carreras = array();
    while ($row = $results->fetch_assoc()) {
        $carreras[] = $row["carreraID"];
    }


    //se buscan los datos del usuario receptor
    $sqlquery = "SELECT * FROM inscripciones WHERE tipo='ingresante' AND habilitado='si' AND estado='activo'";
    $results = $db->query($sqlquery);
    // se transforma el resultado de la consulta en una array
    $datos = array();
    while ($row = $results->fetch_assoc()) {

        $row["color"] = "#088DCD";
        $row["status"] = "no inscripto";
        if (in_array($row["carreraID"], $carreras)) {
            $row["color"] = "#02941f";
            $row["status"] = "inscripto";

        }


        $datos[] = $row;
    }

    return $datos;



}


/////////////////////////////////////////////////////////
function imagenUsuario($user_id)
{

    global $db;


    if ($user_id == -1) {
        $foto = "images/interface/perfil_iset.png";
        return $foto;
    }

    //se buscan los datos del usuario receptor
    $sqlquery = "SELECT * FROM usuarios WHERE ID='" . $user_id . "'";
    $results = $db->query($sqlquery);
    $row = $results->fetch_assoc();
    $foto = $row["foto"];
    if ($row["foto"] == null)
        $foto = "images/interface/perfil.png";
    return $foto;


}

////////////////////////////////////////////////////////////
function getNombreMateria($idMteria)
{
    global $db;

    //se buscan los datos del usuario receptor
    $sqlquery = "SELECT nombre FROM materias WHERE ID='" . $idMteria . "' AND habilitado='si' AND estado='activo'";
    $results = $db->query($sqlquery);
    $row = $results->fetch_assoc();
    return $row["nombre"];

}


////////////////////////////////////////////////////////////
function getYearMateria($idMteria)
{
    global $db;

    //se buscan los datos del usuario receptor
    $sqlquery = "SELECT year FROM materias WHERE ID='" . $idMteria . "' AND habilitado='si' AND estado='activo'";
    $results = $db->query($sqlquery);
    $row = $results->fetch_assoc();
    return $row["year"];

}


////////////////////////////////////////////////////////////
function getNombreCarrera($id)
{
    global $db;


    $sqlquery = "SELECT nombre FROM carreras WHERE ID='" . $id . "' AND habilitado='si' AND estado='activo'";
    $results = $db->query($sqlquery);
    $row = $results->fetch_assoc();
    return $row["nombre"];

}

////////////////////////////////////////////////////////////////////
function borrarIncripciones($userID, $carreraID)
{

    global $db;
    $sqlquery = "DELETE FROM inscriptos WHERE userID='" . $userID . "' AND carreraID='" . $carreraID . "'";


    $results = $db->query($sqlquery);


}


////////////////////////////////////////////////////////////////////
function borrarIncripcionesExamenes($userID, $carreraID)
{

    global $db;
    $sqlquery = "DELETE FROM inscriptosExamenes WHERE userID='" . $userID . "' AND carreraID='" . $carreraID . "'";


    $results = $db->query($sqlquery);


}




////////////////////////////////////////////////////////////////////
function borrarMensaje($mensajeID)
{

    $host = 'localhost';
    $database = 'iset';
    $username = 'root';
    $password = '';


    
    $sqlquery = "DELETE FROM mensajes WHERE ID='" . $mensajeID . "'";
    $db = new mysqli($host, $username, $password, $database);
    $results = $db->query($sqlquery);

    echo $mensajeID;


}

//////////////////////////////////////////////////////////////////////////

function getMateriaExamenes($examenID)
{

    global $db;

    $sqlquery = "SELECT * FROM materiasExamenes WHERE examenID='" . $examenID . "' AND estado='activo'";
    $results = $db->query($sqlquery);

    // se transforma el resultado de la consulta en una array
    $datos = array();
    while ($row = $results->fetch_assoc()) {
        $datos[] = $row;
    }


    return $datos;
}


//////////////////////////////////////////////////////////////////////////

function getCarreraExamen($examenID)
{

    global $db;

    $sqlquery = "SELECT * FROM examenes WHERE ID='" . $examenID . "' AND estado='activo'";
    $results = $db->query($sqlquery);

    $row = $results->fetch_assoc();


    return $row["carreraID"];
}

///////////////////////////////////////////////
function listarMateriasPorCarrera($carreraID)
{

    global $db;


    $sqlquery = "SELECT * FROM materias WHERE carreraID='" . $carreraID . "' AND estado='activo' and habilitado='si' ORDER BY year ASC";



    $results = $db->query($sqlquery);

    // se transforma el resultado de la consulta en una array
    $datos = array();
    while ($row = $results->fetch_assoc()) {
        $datos[] = $row;

    }


    return $datos;
}


//////////////////////////////////////////////
function borrarMateriasExamen($examenID)
{

    global $db;

    $sqlquery = "DELETE FROM materiasExamenes WHERE examenID ='" . $examenID . "'";
    $results = $db->query($sqlquery);
    return true;
}


///////////////////////////////////////////////
function listarMateriasExamen($examenID)
{

    global $db;


    $sqlquery = "SELECT * FROM materiasExamenes WHERE examenID='" . $examenID . "' AND estado='activo'";



    $results = $db->query($sqlquery);

    // se transforma el resultado de la consulta en una array
    $datos = array();
    while ($row = $results->fetch_assoc()) {
        $datos[] = $row;

    }


    return $datos;
}


//////////////////////////////////////////////////////////////////////////

function getFechaExamen($IDmateria)
{

    global $db;

    $sqlquery = "SELECT * FROM materiasExamenes WHERE materiaID='" . $IDmateria . "' AND estado='activo'";
    $results = $db->query($sqlquery);

    $row = $results->fetch_assoc();


    $date = date_create($row["fecha"]);
    $f = date_format($date, "d/m/Y");


    return " el " . $f . " a las " . $row["hora"] . " horas";
}

?>