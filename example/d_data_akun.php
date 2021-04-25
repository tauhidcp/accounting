<?php 
require_once("connect.php");
$sql = "select * from coa";
$qry = mysqli_query($con,$sql);
echo "<table border='1'>";
echo "<tr style='background-color:#99DDCC'>";
echo "<td>KD_COA</td> <td>NAMA_COA</td> <td>KD_INDUK_COA</td> <td>KELOMPOK</td> <td>M_D</td> <td>D_K</td> <td>LEVEL_COA</td> <td>SALDO_AWAL</td> <td>SALDO_DEBET</td> <td>SALDO_KREDIT</td> <td>SALDO_AKHIR</td>";
echo "</tr>";
while ($data = mysqli_fetch_assoc($qry)){
echo "<tr>";
echo "<td>".$data['KD_COA']."</td>";
echo "<td>".$data['NAMA_COA']."</td>";
echo "<td>".$data['KD_INDUK_COA']."</td>";
echo "<td>".$data['KELOMPOK']."</td>";
echo "<td>".$data['M_D']."</td>";
echo "<td>".$data['D_K']."</td>";
echo "<td>".$data['LEVEL_COA']."</td>";
echo "<td>".$data['SALDO_AWAL']."</td>";
echo "<td>".$data['SALDO_DEBET']."</td>";
echo "<td>".$data['SALDO_KREDIT']."</td>";
echo "<td>".$data['SALDO_AKHIR']."</td>";
echo "</tr>";
}

echo "</table>";
?>