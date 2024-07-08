<?php include '../../templates/header_menu.php'; ?>
<?php 
    include "../../clases/conexion.php";  
    $conexion = new Conexion();
    $conn = $conexion->conectar();

    // Obtener el valor de id desde el parámetro GET y escapar para evitar SQL injection
    $id = isset($_GET['id']) ? mysqli_real_escape_string($conn, $_GET['id']) : '';
    
    $rolUsuario = $_SESSION['rol']; // Variable para almacenar el rol del usuario

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
            U.rol, U.identificacion, U.nombre1, U.apellido1, U.celular, T.idTributo, T.codEntidad, 
            T.tipoEntidad, I.codCatastral, I.ubicacion, I.tipoIBI, I.uso, P.montoPago, P.fecPago, 
            P.anioPago, P.mesPago 
        FROM USUARIOS U 
        INNER JOIN TRIBUTOS T ON U.identificacion = T.identificacion 
        LEFT JOIN IBI I ON T.codEntidad = I.codCatastral AND T.tipoEntidad = 'IBI' 
        LEFT JOIN PAGOS P ON T.idTributo = P.idTributo 
        WHERE U.identificacion = '%s' 
        AND T.tipoEntidad = 'IBI' AND T.idTributo = 
            (SELECT MAX(T2.idTributo) FROM TRIBUTOS T2
            WHERE T2.identificacion = '%s' AND T2.tipoEntidad = 'IBI' AND T2.codEntidad = T.codEntidad)",$id,$id);
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
        U.rol, U.identificacion, U.nombre1, U.apellido1, U.celular, T.idTributo, T.codEntidad, 
        T.tipoEntidad,  I.codCatastral, I.ubicacion, I.tipoIBI, I.uso, P.montoPago, P.fecPago, 
        P.anioPago, P.mesPago 
    FROM USUARIOS U INNER JOIN TRIBUTOS T ON U.identificacion = T.identificacion 
    LEFT JOIN IBI I ON (T.codEntidad = I.codCatastral AND T.tipoEntidad = 'TA') 
    LEFT JOIN pagos P ON T.idTributo = P.idTributo 
    WHERE U.identificacion = '%s' 
        AND T.tipoEntidad = 'TA' AND T.idTributo = 
            (SELECT MAX(T2.idTributo) FROM TRIBUTOS T2
            WHERE T2.identificacion = '%s' AND T2.tipoEntidad = 'TA' AND T2.codEntidad = T.codEntidad)",$id,$id);
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
        U.rol, U.identificacion, U.nombre1, U.apellido1, U.celular, T.idTributo, T.codEntidad, 
        T.tipoEntidad, L.codLote, L.cementerio, L.sector, L.categoria, P.montoPago, P.fecPago,
        P.anioPago, P.mesPago 
    FROM USUARIOS U 
    INNER JOIN TRIBUTOS T ON U.identificacion = T.identificacion 
    LEFT JOIN LOTES L ON T.codEntidad = L.codLote AND T.tipoEntidad = 'LOTE' 
    LEFT JOIN PAGOS P ON T.idTributo = P.idTributo 
    WHERE U.identificacion = '%s' 
        AND T.tipoEntidad = 'LOTE' AND T.idTributo = 
            (SELECT MAX(T2.idTributo) FROM TRIBUTOS T2
            WHERE T2.identificacion = '%s' AND T2.tipoEntidad = 'LOTE' AND T2.codEntidad = T.codEntidad)",$id,$id);
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
        U.rol, U.identificacion, U.nombre1, U.apellido1, U.celular, T.idTributo, T.codEntidad, T.tipoEntidad, 
        F.codFinca, F.comunidad,P.montoPago, P.fecPago, P.anioPago, P.mesPago 
    FROM USUARIOS U INNER JOIN TRIBUTOS T ON U.identificacion = T.identificacion 
    LEFT JOIN FIERROS F ON T.codEntidad = F.codFinca AND T.tipoEntidad = 'FIERRO' 
    LEFT JOIN pagos P ON T.idTributo = P.idTributo 
    WHERE U.identificacion = '%s' 
        AND T.tipoEntidad = 'FIERRO' AND T.idTributo = 
        (SELECT MAX(T2.idTributo) FROM TRIBUTOS T2
        WHERE T2.identificacion = '%s' AND T2.tipoEntidad = 'FIERRO' AND T2.codEntidad = T.codEntidad)",$id,$id);
    $resultado = mysqli_query($conn, $sql);
    $FIERROS = [];
    if ($resultado) {
        while ($row = mysqli_fetch_assoc($resultado)) {
            $FIERROS[] = $row;
        }
    }

    $conn->close();
?>

<style>
    .truncate {
        white-space: nowrap;
        overflow: hidden;
        text-overflow: ellipsis;
        max-width: 150px; /* Ajusta esto según tus necesidades */
    }
    
</style>


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
        <div class="container">
        <div class="row">
            <!-- Tabla de Bienes Inmuebles -->
            <div class="col-md-8">
                <table id="tIBIS" class="mt-2 mb-0 table table-dark">
                    <thead>
                        <tr>
                            <th colspan="6" class="text-white bg-success text-center">BIENES INMUEBLES REGISTRADOS AL CONTRIBUYENTE</th>
                        </tr>
                        <tr>
                            <th>Tributo</th>
                            <th>Id.Tributo</th>
                            <th>C.Catastral</th>
                            <th>Ubicacion</th>
                            <th>Tipo IBI</th>
                            <th>Uso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($IBIS as $IBI): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($IBI['tipoEntidad']); ?></td> 
                                <td><?php echo htmlspecialchars($IBI['idTributo']); ?></td> 
                                <td><?php echo htmlspecialchars($IBI['codEntidad']); ?></td> 
                                <td class="truncate"><?php echo htmlspecialchars($IBI['ubicacion']); ?></td> 
                                <td><?php echo htmlspecialchars($IBI['tipoIBI']); ?></td> 
                                <td class="truncate"><?php echo htmlspecialchars($IBI['uso']); ?></td> 
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Tabla de Últimos Pagos -->
            <div class="col-md-4">
            <table id="tPagosIBI" class="mt-2 mb-0 table table-dark">
                <thead>
                    <tr>
                        <th colspan="4" class="text-white bg-success text-center">ULTIMOS PAGOS</th>
                    </tr>
                    <tr>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Año</th>
                        <?php if ($rolUsuario === 'REGISTRO'): ?>
                            <th>Pagar</th> 
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($IBIS as $IBI): ?>
                        <?php if ($rolUsuario !== 'REGISTRO' && empty($IBI['montoPago'])): ?>
                            <tr>
                                <td colspan="4" class="text-center">Sin pagos</td>
                            </tr>
                        <?php elseif ($rolUsuario === 'REGISTRO'): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($IBI['montoPago']); ?></td> 
                                <td><?php echo htmlspecialchars($IBI['fecPago']); ?></td> 
                                <td><?php echo htmlspecialchars($IBI['anioPago']); ?></td> 
                                <td><a href="#idTributo=<?php echo htmlspecialchars($IBI['idTributo']); ?>">Pagar</a></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td><?php echo htmlspecialchars($IBI['montoPago']); ?></td> 
                                <td><?php echo htmlspecialchars($IBI['fecPago']); ?></td> 
                                <td><?php echo htmlspecialchars($IBI['anioPago']); ?></td> 
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <?php endif ?>

    <!--Tabla para mostrar registros de TA -->
    <?php if (!empty($TAS)): ?>
        <div class="container">
        <div class="row">
            <!-- Tabla de Tren de Aseo -->
            <div class="col-md-8">
                <table id="tTAS" class="mt-2 mb-0 table table-dark">
                    <thead>
                        <tr>
                            <th colspan="6" class="text-white bg-success text-center">TREN DE ASEO REGISTRADOS AL CONTRIBUYENTE</th>
                        </tr>
                        <tr>
                            <th>Id.Tributo</th>
                            <th>C.Catastral</th>
                            <th>Ubicacion</th>
                            <th>Tipo IBI</th>
                            <th>Uso</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($TAS as $TA): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($TA['idTributo']); ?></td> 
                                <td><?php echo htmlspecialchars($TA['codEntidad']); ?></td> 
                                <td class="truncate"><?php echo htmlspecialchars($TA['ubicacion']); ?></td> 
                                <td><?php echo htmlspecialchars($TA['tipoIBI']); ?></td> 
                                <td class="truncate"><?php echo htmlspecialchars($TA['uso']); ?></td> 
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Tabla de Últimos Pagos -->
            <div class="col-md-4">
            <table id="tPagosTA" class="mt-2 mb-0 table table-dark">
                <thead>
                    <tr>
                        <th colspan="4" class="text-white bg-success text-center">ULTIMOS PAGOS</th>
                    </tr>
                    <tr>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Año</th>
                        <?php if ($rolUsuario === 'REGISTRO'): ?>
                            <th>Pagar</th> 
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($TAS as $TA): ?>
                        <?php if ($rolUsuario !== 'REGISTRO' && empty($TA['montoPago'])): ?>
                            <tr>
                                <td colspan="4" class="text-center">Sin pagos</td>
                            </tr>
                        <?php elseif ($rolUsuario === 'REGISTRO'): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($TA['montoPago']); ?></td> 
                                <td><?php echo htmlspecialchars($TA['fecPago']); ?></td> 
                                <td><?php echo htmlspecialchars($TA['anioPago']); ?></td> 
                                <td><a href="#idTributo=<?php echo htmlspecialchars($TA['idTributo']); ?>">Pagar</a></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td><?php echo htmlspecialchars($TA['montoPago']); ?></td> 
                                <td><?php echo htmlspecialchars($TA['fecPago']); ?></td> 
                                <td><?php echo htmlspecialchars($TA['anioPago']); ?></td> 
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <?php endif ?>


    <!--Tabla para mostrar registros de LOTES -->
    <?php if (!empty($LOTES)): ?>
        <div class="container">
        <div class="row">
            <!-- Tabla de Lotes -->
            <div class="col-md-8">
                <table id="tLotes" class="mt-2 mb-0 table table-dark">
                    <thead>
                        <tr>
                            <th colspan="6" class="text-white bg-success text-center">LOTES REGISTRADOS AL CONTRIBUYENTE</th>
                        </tr>
                        <tr>
                            <th>Id.Tributo</th>
                            <th>C.Lote</th>
                            <th>Cementerio</th>
                            <th>Sector</th>
                            <th>Categoria</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($LOTES as $LOTE): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($LOTE['idTributo']); ?></td> 
                                <td><?php echo htmlspecialchars($LOTE['codEntidad']); ?></td> 
                                <td><?php echo htmlspecialchars($LOTE['cementerio']); ?></td> 
                                <td><?php echo htmlspecialchars($LOTE['sector']); ?></td> 
                                <td><?php echo htmlspecialchars($LOTE['categoria']); ?></td> 
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Tabla de Últimos Pagos -->
            <div class="col-md-4">
            <table id="tPagosLOTE" class="mt-2 mb-0 table table-dark">
                <thead>
                    <tr>
                        <th colspan="4" class="text-white bg-success text-center">ULTIMOS PAGOS</th>
                    </tr>
                    <tr>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Año</th>
                        <?php if ($rolUsuario === 'REGISTRO'): ?>
                            <th>Pagar</th> 
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($LOTES as $LOTE): ?>
                        <?php if ($rolUsuario !== 'REGISTRO' && empty($LOTE['montoPago'])): ?>
                            <tr>
                                <td colspan="4" class="text-center">Sin pagos</td>
                            </tr>
                        <?php elseif ($rolUsuario === 'REGISTRO'): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($LOTE['montoPago']); ?></td> 
                                <td><?php echo htmlspecialchars($LOTE['fecPago']); ?></td> 
                                <td><?php echo htmlspecialchars($LOTE['anioPago']); ?></td> 
                                <td><a href="#idTributo=<?php echo htmlspecialchars($LOTE['idTributo']); ?>">Pagar</a></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td><?php echo htmlspecialchars($LOTE['montoPago']); ?></td> 
                                <td><?php echo htmlspecialchars($LOTE['fecPago']); ?></td> 
                                <td><?php echo htmlspecialchars($LOTE['anioPago']); ?></td> 
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <?php endif ?>

    

    <!--Tabla para mostrar registros de FIERROS -->
    <?php if (!empty($FIERROS)): ?>
        <div class="container">
        <div class="row">
            <!-- Tabla de Lotes -->
            <div class="col-md-8">
                <table id="tFierros" class="mt-2 mb-0 table table-dark">
                    <thead>
                        <tr>
                            <th colspan="6" class="text-white bg-success text-center">FIERROS REGISTRADOS AL CONTRIBUYENTE</th>
                        </tr>
                        <tr>
                            <th>Id.Tributo</th>
                            <th>C.Finca</th>
                            <th>Comunidad</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($FIERROS as $FIERRO): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($FIERRO['idTributo']); ?></td> 
                                <td><?php echo htmlspecialchars($FIERRO['codEntidad']); ?></td> 
                                <td><?php echo htmlspecialchars($FIERRO['comunidad']); ?></td> 
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
            <!-- Tabla de Últimos Pagos -->
            <div class="col-md-4">
            <table id="tPagosFIERRO" class="mt-2 mb-0 table table-dark">
                <thead>
                    <tr>
                        <th colspan="4" class="text-white bg-success text-center">ULTIMOS PAGOS</th>
                    </tr>
                    <tr>
                        <th>Monto</th>
                        <th>Fecha</th>
                        <th>Año</th>
                        <?php if ($rolUsuario === 'REGISTRO'): ?>
                            <th>Pagar</th> 
                        <?php endif; ?>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($FIERROS as $FIERRO): ?>
                        <?php if ($rolUsuario !== 'REGISTRO' && empty($FIERRO['montoPago'])): ?>
                            <tr>
                                <td colspan="4" class="text-center">Sin pagos</td>
                            </tr>
                        <?php elseif ($rolUsuario === 'REGISTRO'): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($FIERRO['montoPago']); ?></td> 
                                <td><?php echo htmlspecialchars($FIERRO['fecPago']); ?></td> 
                                <td><?php echo htmlspecialchars($FIERRO['anioPago']); ?></td> 
                                <td><a href="#idTributo=<?php echo htmlspecialchars($FIERRO['idTributo']); ?>">Pagar</a></td>
                            </tr>
                        <?php else: ?>
                            <tr>
                                <td><?php echo htmlspecialchars($FIERRO['montoPago']); ?></td> 
                                <td><?php echo htmlspecialchars($FIERRO['fecPago']); ?></td> 
                                <td><?php echo htmlspecialchars($FIERRO['anioPago']); ?></td> 
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
            </div>
        </div>
    </div>
    <?php endif ?>
</div>










