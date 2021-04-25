<?php 

require_once("connect.php");
require_once("../accounting-class.php");

$tgl1 = "01-04-2018";
$tgl2 = "30-04-2018";

$acc = new Accounting($con);

$acc->setTglSatu($tgl1);
$acc->setTglDua($tgl2);
	
	echo "Tanggal Awal : ".$tgl1;
	echo "</br>";
	echo "Tanggal Akhir : ".$tgl2;
	echo "</br>";
	echo "</br>";
	
	echo "<table border='1'>";
	
		echo "<tr style='background-color:#99DDCC'>";
			echo "<td>No</td> <td>Tgl Trans</td> <td>Id Trans</td> <td>Uraian Jurnal</td> <td>Type Jurnal</td> <td>Id</td> <td>Kode COA</td> <td>Nama COA</td> <td>Debet</td> <td>Kredit</td>";
		echo "</tr>";
		
		$xrow = 1;
		
		$sql = "SELECT acc.tgl_trans, acc.id_trans, acc.uraian_jurnal, 
				acc.type_jurnal, acc1.id_detail, c.kd_coa, c.nama_coa, 
				acc1.debet, acc1.kredit 
				FROM jurnal acc, jurnal_d1 acc1, coa c 
				WHERE acc.tgl_trans BETWEEN '".$acc->getTglSatu()."' AND '".$acc->getTglDua()."' 
				AND acc1.id_trans = acc.id_trans AND c.kd_coa = acc1.kd_coa 
				ORDER BY acc.tgl_trans, acc.id_trans, acc.type_jurnal, 
				acc1.id_detail";
				
		$qry = mysqli_query($con,$sql);
		while ($data = mysqli_fetch_assoc($qry)){
		
			$idtr = $data['id_trans'];
			$ddd  = $data['debet'];
			$kkk  = $data['kredit'];
		
			echo "<tr>";
				echo "<td>".$xrow."</td>";
				echo "<td>".$data['tgl_trans']."</td>";
				echo "<td>".$data['id_trans']."</td>";
				echo "<td>".$data['uraian_jurnal']."</td>";
				echo "<td>".$data['type_jurnal']."</td>";
				echo "<td>".$data['id_detail']."</td>";
				echo "<td>".$data['kd_coa']."</td>";
				echo "<td>".$data['nama_coa']."</td>";
				echo "<td>".$ddd."</td>";
				echo "<td>".$kkk."</td>";
			echo "</tr>";
			$xrow++;
	  
		}
		
	echo "</table>";

?>