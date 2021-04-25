<?php 
require_once("connect.php");

$sql = "select * from modul_bank";
$qry = mysqli_query($con,$sql);

echo "<table border='1'>";
	
	echo "<tr style='background-color:#99DDCC'>";
		echo "<td>ID</td> <td>NAME_BANK</td> <td>NO_REKENING</td> <td>AN_REKENING</td> <td>INTEGRASI_COA</td> <td>SALDO_BANK</td>";
	echo "</tr>";
	
	while ($data = mysqli_fetch_assoc($qry)){
		
		echo "<tr>";
			echo "<td>".$data['ID']."</td>";
			echo "<td>".$data['NAME_BANK']."</td>";
			echo "<td>".$data['NO_REKENING']."</td>";
			echo "<td>".$data['AN_REKENING']."</td>";
			echo "<td>".$data['INTEGRASI_COA']."</td>";
			echo "<td>".$data['SALDO_BANK']."</td>";
		echo "</tr>";
		
	}

echo "</table>";

?>