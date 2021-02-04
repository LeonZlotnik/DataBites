<?php 

require_once('../z_connect.php');

$sql = "SELECT *, (costo*cantidad) AS subtotal, ((costo*cantidad)*0.16) AS iva, ((costo*cantidad)*0.02) AS fee, ((costo*cantidad)/1.18) AS total FROM comandas WHERE status ='Cuenta'";

$result = mysqli_query($conn,$sql);

$html = "<table>
<tr>
    <th scope='col'>Usuario</th>
    <th scope='col'>No. Mesa</th>
    <th scope='col'>Plato</th>
    <th scope='col'>Costo</th>
    <th scope='col'>Cantidad</th>
    <th scope='col'>Subtotal</th>
    <th scope='col'>IVA</th>
    <th scope='col'>Fee</th>
    <th scope='col'>Ingreso</th>
    <th scope='col'>Especificaciones</th>
    <th scope='col'>Tamaño</th>
    <th scope='col'>Registro</th>
</tr>
        ";

while($row = mysqli_fetch_assoc($result)){
    $html .= "<tr>
                <th scope='row' class='user'>".$row["usuario"]."</th>
                <td>#".$row["mesa"]."</td>
                <td>".$row["platillo"]."</td>
                <td>$".$row["costo"]."</td>
                <td>".$row["cantidad"]."</td>
                <td>$".$row["subtotal"]."</td>
                <td>$".$row["iva"]."</td>
                <td>$".$row["fee"]."</td>
                <td>$".$row["total"]."</td>
                <td>".$row["specs"]."</td>
                <td>".$row["size"]."</td>
                <td>".$row["registro"]."</td>
             </tr>";
     $htmil .= "</table>";
}
header('Content-Type:application/xls');
header('Content-Disposition:attachment;filename=Reporte_Ventas_Hijas_de_la_tostada(DataBites).xls');

echo $html;

?>