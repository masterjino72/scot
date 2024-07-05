<?php include '../../templates/header_menu.php'; ?>
<?php 
    include "../../clases/conexion.php";  
    $conexion = new Conexion();
    $conn = $conexion->conectar();

    // Obtener el valor de id desde el parámetro GET y escapar para evitar SQL injection
    $id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
    
    // Consulta para obtener los datos del contribuyente
    $sql = sprintf(
        "SELECT rol, identificacion, nombre1, apellido1, celular 
         FROM USUARIOS 
         WHERE identificacion = '%s'",$id);
    $resultado = mysqli_query($conn, $sql);
    $contribuyentes = [];
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $contribuyentes[] = $row;
        }
    }
    
    // Consulta para obtener los IBIS del contribuyente
    $sql = sprintf(
        "SELECT 
        U.rol, 
        U.identificacion, 
        U.nombre1, 
        U.apellido1, 
        U.celular, 
        T.codEntidad, 
        T.tipoEntidad, 
        I.codCatastral, 
        I.ubicacion, 
        I.tipoIBI, 
        I.uso, 
        P.idTributo, 
        P.montoPago, 
        P.fecPago, 
        P.anioPago, 
        P.mesPago 
    FROM USUARIOS U INNER JOIN TRIBUTOS T ON U.identificacion = T.identificacion 
    LEFT JOIN IBI I ON (T.codEntidad = I.codCatastral AND T.tipoEntidad = 'IBI') 
    LEFT JOIN pagos P ON T.idTributo = P.idTributo 
    WHERE U.identificacion = '%s' AND T.tipoEntidad = 'IBI'",$id);
    $resultado = mysqli_query($conn, $sql);
    $IBIS = [];
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $IBIS[] = $row;
        }
    }


    // Consulta para obtener los TA del contribuyente
    $sql = sprintf(
        "SELECT 
        U.rol, 
        U.identificacion, 
        U.nombre1, 
        U.apellido1, 
        U.celular, 
        T.codEntidad, 
        T.tipoEntidad,  
        I.codCatastral, 
        I.ubicacion, 
        I.tipoIBI, 
        I.uso, 	
        P.idTributo, 
        P.montoPago, 
        P.fecPago, 
        P.anioPago, 
        P.mesPago 
    FROM USUARIOS U INNER JOIN TRIBUTOS T ON U.identificacion = T.identificacion 
    LEFT JOIN IBI I ON (T.codEntidad = I.codCatastral AND T.tipoEntidad = 'TA') 
    LEFT JOIN pagos P ON T.idTributo = P.idTributo 
    WHERE U.identificacion = '%s' AND T.tipoEntidad = 'TA'",$id);
    $resultado = mysqli_query($conn, $sql);
    $TAS = [];
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $TAS[] = $row;
        }
    }
    

    // Consulta para obtener los LOTES del contribuyente
    $sql = sprintf(
        "SELECT 
        U.rol, 
        U.identificacion, 
        U.nombre1, 
        U.apellido1, 
        U.celular, 
        T.codEntidad, 
        T.tipoEntidad, 
        L.codLote, 
        L.cementerio, 
        L.sector, 
        L.categoria, 
        P.idTributo, 
        P.montoPago, 
        P.fecPago, 
        P.anioPago, 
        P.mesPago 
    FROM USUARIOS U INNER JOIN TRIBUTOS T ON U.identificacion = T.identificacion 
    LEFT JOIN LOTES L ON T.codEntidad = L.codLote AND T.tipoEntidad = 'LOTE' 
    LEFT JOIN pagos P ON T.idTributo = P.idTributo 
    WHERE U.identificacion = '%s' AND T.tipoEntidad = 'LOTE'",$id);
    $resultado = mysqli_query($conn, $sql);
    $LOTES = [];
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $LOTES[] = $row;
        }
    }


    // Consulta para obtener los FIERROS del contribuyente
    $sql = sprintf(
        "SELECT 
        U.rol, 
        U.identificacion, 
        U.nombre1, 
        U.apellido1, 
        U.celular, 
        T.codEntidad, 
        T.tipoEntidad, 
        F.codFinca, 
        F.comunidad,
        P.idTributo, 
        P.montoPago, 
        P.fecPago, 
        P.anioPago, 
        P.mesPago 
    FROM USUARIOS U INNER JOIN TRIBUTOS T ON U.identificacion = T.identificacion 
    LEFT JOIN FIERROS F ON T.codEntidad = F.codFinca AND T.tipoEntidad = 'FIERRO' 
    LEFT JOIN pagos P ON T.idTributo = P.idTributo 
    WHERE U.identificacion = '%s' AND T.tipoEntidad = 'FIERRO'",$id);
    $resultado = mysqli_query($conn, $sql);
    $FIERROS = [];
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $FIERROS[] = $row;
        }
    }

    $conn->close();
?>

<div class="container p-2 col-md-12 shadow-lg pb-3 mt-2 bg-white rounded">
    <!--Tabla para mostrar datos del contribuyente -->
    <table id="tCONTRIBUYENTE" class="mt-2 mb-2 table table-warning">
        <thead>
            <tr>
                <th>Identificacion</th> 
                <th>Nombre Completo</th>
                <th>Celular</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($contribuyentes as $contribuyente): ?>
            <tr>
                <td><?php echo htmlspecialchars($contribuyente['identificacion']); ?></td>    
                <td><?php echo htmlspecialchars($contribuyente['nombre1']); ?> <?php echo htmlspecialchars($contribuyente['apellido1']); ?></td>
                <td><?php echo htmlspecialchars($contribuyente['celular']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <!--Tabla para mostrar registros de IBIS -->
    <?php if (!empty($IBIS)): ?>
    <table id="tIBIS" class="mt-2 mb-0 table table-dark">
        <thead>
            <tr>
                <th colspan="18" class="text-white bg-success text-center">BIENES INMUEBLES REGISTRADOS AL CONTRIBUYENTE</th>
            </tr>
            <tr>
                <th class="col-1">Tributo</th>
                <th class="col-1">C.Catastral</th>
                <th class="col-3">Ubicacion</th>
                <th class="col-1">Tipo IBI</th>
                <th class="col-1">Uso</th>
                <th class="bg-secondary col-1">Monto</th>
                <th class="bg-secondary col-1">Fecha</th>
                <th class="bg-secondary col-1">Año</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($IBIS as $IBI): ?>
            <tr>
                <td class="col-1"><?php echo htmlspecialchars($IBI['tipoEntidad']); ?></td> 
                <td class="col-1"><?php echo htmlspecialchars($IBI['codEntidad']); ?></td> 
                <td class="col-3"><?php echo htmlspecialchars($IBI['ubicacion']); ?></td> 
                <td class="col-1"><?php echo htmlspecialchars($IBI['tipoIBI']); ?></td> 
                <td class="col-1"><?php echo htmlspecialchars($IBI['uso']); ?></td> 
                <td class="bg-secondary col-1"><?php echo htmlspecialchars($IBI['montoPago']); ?></td> 
                <td class="bg-secondary col-1"><?php echo htmlspecialchars($IBI['fecPago']); ?></td> 
                <td class="bg-secondary col-1"><?php echo htmlspecialchars($IBI['anioPago']); ?></td> 
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif ?>

    <!--Tabla para mostrar registros de TA -->
    <?php if (!empty($TAS)): ?>
    <table id="tTA" class="mt-2 mb-0 table table-dark">
        <thead>
            <tr>
                <th colspan="18" class="text-white bg-success text-center">TREN DE ASEO REGISTRADOS AL CONTRIBUYENTE</th>
            </tr>
            <tr>
                <th class="col-1">Tributo</th>
                <th class="col-1">C.Catastral</th>
                <th class="col-3">Ubicacion</th>
                <th class="col-1">Tipo IBI</th>
                <th class="col-1">Uso</th>
                <th class="bg-secondary col-1">Monto</th>
                <th class="bg-secondary col-1">Fecha</th>
                <th class="bg-secondary col-1">Mes</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($TAS as $TA): ?>
            <tr>
                <td class="col-1"><?php echo htmlspecialchars($TA['tipoEntidad']); ?></td> 
                <td class="col-1"><?php echo htmlspecialchars($TA['codEntidad']); ?></td> 
                <td class="col-3"><?php echo htmlspecialchars($TA['ubicacion']); ?></td> 
                <td class="col-1"><?php echo htmlspecialchars($TA['tipoIBI']); ?></td> 
                <td class="col-1"><?php echo htmlspecialchars($TA['uso']); ?></td> 
                <td class="bg-secondary col-1"><?php echo htmlspecialchars($TA['montoPago']); ?></td> 
                <td class="bg-secondary col-1"><?php echo htmlspecialchars($TA['fecPago']); ?></td> 
                <td class="bg-secondary col-1"><?php echo htmlspecialchars($TA['mesPago']); ?></td> 
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif ?>

    <!--Tabla para mostrar registros de LOTES -->
    <?php if (!empty($LOTES)): ?>
    <table id="tLOTES" class="mt-2 mb-0 table table-dark">
        <thead>
            <tr>
                <th colspan="18" class="text-white bg-success text-center">LOTES REGISTRADOS AL CONTRIBUYENTE</th>
            </tr>
            <tr>
                <th class="col-1">Tributo</th>
                <th class="col-1">C.Lote</th>
                <th class="col-3">Cementerio</th>
                <th class="col-1">Sector</th>
                <th class="col-1">Categoria</th>
                <th class="bg-secondary col-1">Monto</th>
                <th class="bg-secondary col-1">Fecha</th>
                <th class="bg-secondary col-1">Año</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($LOTES as $LOTE): ?>
            <tr>
                <td class="col-1"><?php echo htmlspecialchars($LOTE['tipoEntidad']); ?></td> 
                <td class="col-1"><?php echo htmlspecialchars($LOTE['codEntidad']); ?></td> 
                <td class="col-3"><?php echo htmlspecialchars($LOTE['cementerio']); ?></td> 
                <td class="col-1"><?php echo htmlspecialchars($LOTE['sector']); ?></td> 
                <td class="col-1"><?php echo htmlspecialchars($LOTE['categoria']); ?></td> 
                <td class="bg-secondary col-1"><?php echo htmlspecialchars($LOTE['montoPago']); ?></td> 
                <td class="bg-secondary col-1"><?php echo htmlspecialchars($LOTE['fecPago']); ?></td> 
                <td class="bg-secondary col-1"><?php echo htmlspecialchars($LOTE['anioPago']); ?></td> 
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif ?>

    <!--Tabla para mostrar registros de FIERROS -->
    <?php if (!empty($FIERROS)): ?>
    <table id="tFIERROS" class="mt-2 mb-0 table table-dark">
        <thead>
            <tr>
                <th colspan="18" class="text-white bg-success text-center">FIERROS REGISTRADOS AL CONTRIBUYENTE</th>
            </tr>
            <tr>
                <th class="col-1">Tributo</th>
                <th class="col-1">C.Finca</th>
                <th class="col-1">Comunidad</th>
                <th class="bg-secondary col-1">Monto</th>
                <th class="bg-secondary col-1">Fecha</th>
                <th class="bg-secondary col-1">Año</th>
            </tr>
        </thead>
        <tbody>
        <?php foreach ($FIERROS as $FIERRO): ?>
            <tr>
                <td class="col-1"><?php echo htmlspecialchars($FIERRO['tipoEntidad']); ?></td> 
                <td class="col-1"><?php echo htmlspecialchars($FIERRO['codEntidad']); ?></td> 
                <td class="col-1"><?php echo htmlspecialchars($FIERRO['comunidad']); ?></td> 
                <td class="bg-secondary col-1"><?php echo htmlspecialchars($LOTE['montoPago']); ?></td> 
                <td class="bg-secondary col-1"><?php echo htmlspecialchars($LOTE['fecPago']); ?></td> 
                <td class="bg-secondary col-1"><?php echo htmlspecialchars($LOTE['anioPago']); ?></td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <?php endif ?>
</div>










