<?php
    include('conexion.php');
    error_reporting(E_ALL ^ E_NOTICE);
    ?>
    <?php

    $codigo = $_POST['codigo_encuesta'];

    $sql="SELECT respuesta2,  respuesta2 from respuesta_encuesta WHERE id_encuestafk = 142962";
    $res=mysqli_query($con,$sql);
    $valoresY=array();
    $valoresX=array();

    while ($ver = mysqli_fetch_row($res)) {
        $valoresY[]=$ver[0];
        $valoresX[]=$ver[1];
    }

    $datosX=json_encode($valoresX);
    $datosY=json_encode($valoresY);

    
?>

<div id="graficoBarra"></div>

<script type="text/javascript">
    function crearCadenaBarras(json){
        var parsed = JSON.parse(json);
        var arr = [];
        for(var x in parsed){
            arr.push(parsed[x]);
        }
        return arr;
    }
</script>

<script type="text/javascript">

    datosX = crearCadenaBarras('<?php echo $datosX ?>');
    datosY = crearCadenaBarras('<?php echo $datosY ?>');
var data = [
  {
    x: datosX,
    y: datosY,
    type: 'bar'
  }
];

Plotly.newPlot('graficoBarra', data);
</script>