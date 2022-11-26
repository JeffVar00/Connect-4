
<?php

 function buscar_ganador ($Conecta4) {
    }

session_start();
$Conecta4 isset ($_SESSION['Conecta4']) ? $_SESSION['Conecta4']: array 
(array (' ',' ',' ',' ',' '), array (' ',' ',' ',' ',' '), array (' ',' ',' ',' ',' '), array (' ',' ',' ',' ',' '));

$turnos isset ($_SESSION['turnos']) ? $_SESSION['turnos']: 0;
$ganador = ' ';
$mensaje = ' ';

if (!isset ($_SESSION['Conecta4']) || !isset ($_SESSION['turnos'])){

    if (mt_rand() % 2 == 1){//Es como una moneda para ver quien inicia, si inicia el cpu hace:
    //Aqui va que hace el CPU
    //$Conecta4 [] [$j] = 'FICHA AZUL';
    $turnos++;
    }
    $_SESSION['Conecta4'] = $Conecta4;

} else {

    if (isset ($_POST['columna'])) {
        $j = intval ($_POST['columna']) - 1;
        if($Conecta4 [0] [$j] == ' ' || $Conecta4 [1] [$j] == ' ' || $Conecta4 [2] [$j] == ' ' || $Conecta4 [3] [$j] == ' '){
            $mensaje = 'Ya no caben mas fichas en esta';
        } else {
            $i = 4;
            do {
                $i = $i - 1;
            } while ($Conecta4 [$i] [$j] != ' ');
            $Conecta4 [$i] [$j] = 'FICHA ROJA';
            $turnos++;
            $ganador = buscar_ganador ($Conecta4);
            if ($ganador == 'FICHA ROJA') {
                $mensaje = 'El usuario ha ganado.';
            }
            else if ($turnos == 20) {
                $mensaje = 'Empate.';
            }
            else{
                //Aqui va que hace el CPU
                //$Conecta4 [] [$j] = 'FICHA AZUL';
                $turnos++;
                $ganador = buscar_ganador ($Conecta4);
                if ($ganador == 'FICHA AZUL'){
                    $mensaje = 'El usuario ha ganado.';
                }
                else if ($turnos == 20){
                    $mensaje = 'Empate.';
                }
            }
        }
    }
    
}


?>

<!DOCTYPE html>
<html lang="es">
<head>

<meta name="viewport" content="width=device-width, initial-scale=1.0">
<meta charset="utf-8">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>



</head>
<body>

<table style="width: 100%; height: 100%; margin-left: auto; margin-right: auto; text-align: center;" border="1" cellpadding="2" cellspacing="2">
    <tbody>
        <?php
        for ($i=0; $i < count ($Conecta4); $i++){ echo '<tr>';
            for ($j=0; $j < count ($Conecta4 [$i]); $j++){
                echo '<td style="height: 33%; width: 33%;">' . ($Conecta4[$i] [$j]==' '? '&nbsp;': $Conecta4 [$i] [$j]) . '</td>';
            }
            echo '</tr>'; 
        }
        ?>
    </tbody>
</table>

<?php
 if ($ganador! = ' ' || $turnos==20) {
    unset ($_SESSION['Conecta4']);
    unset ($_SESSION['turnos']);
    } else {
    $_SESSION['Conecta4'] = $Conecta4;
    $_SESSION['turnos'] = $turnos;
    }
?>

<br>
<?php 
echo $mensaje; 
?>

</body>

</html>