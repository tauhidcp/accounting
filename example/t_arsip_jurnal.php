<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Arsip Jurnal</title>
</head>

<body>
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
	
	echo "<table class='collaptable' border='1'>";
	
		echo "<tr style='background-color:#99DDCC'>";
			echo "<td>No</td> <td>Id Transaksi</td> <td>No Bukti</td> <td>Tanggal</td> <td>Uraian</td> <td>Type Jurnal</td>";
		echo "</tr>";
		
		$xrow = 1;
		
		$sql = 'SELECT jj.id_trans as id_trans, 
				jj.no_reference as no_bukti, 
				jj.tgl_trans as tgl_trans, jj.uraian_jurnal as uraian_jurnal, 
				jj.type_jurnal as type FROM jurnal jj 
				WHERE jj.tgl_trans BETWEEN "'.$acc->getTglSatu().'" AND "'.$acc->getTglDua().'" 
				ORDER BY jj.tgl_trans, jj.id_trans';
						
		$qry = mysqli_query($con,$sql);
		while ($data = mysqli_fetch_assoc($qry)){
		
			echo "<tr data-id='".$xrow."' data-parent=''>";
				echo "<td>".$xrow."</td>";
				echo "<td>".$data['id_trans']."</td>";
				echo "<td>".$data['no_bukti']."</td>";
				echo "<td>".$data['tgl_trans']."</td>";
				echo "<td>".$data['uraian_jurnal']."</td>";
				echo "<td>".$data['type']."</td>";
			echo "</tr>";
				
				
				$sql2 = 'select acc1.id_detail Id, c.kd_coa as Id_Account,
					    c.nama_coa as Nama_Account, acc1.Debet as debet, acc1.Kredit as kredit 
					    from jurnal acc, jurnal_d1 acc1, coa c 
					    where acc1.id_trans = acc.id_trans AND 
						c.kd_coa = acc1.kd_coa AND 
						acc1.id_trans = "'.$data['id_trans'].'" order by acc1.id_detail';
						
				$no = 1;
				$qry2 = mysqli_query($con,$sql2);
				while ($data2 = mysqli_fetch_assoc($qry2)){
						
						echo "<tr data-id='".rand()."' data-parent='".$xrow."'>";
						echo "<td>".$no."</td>";
						echo "<td>".$data2['Id']."</td>";
						echo "<td>".$data2['Id_Account']."</td>";
						echo "<td>".$data2['Nama_Account']."</td>";
						echo "<td>".$data2['debet']."</td>";
						echo "<td>".$data2['kredit']."</td>";
						echo "</tr>";
						
					$no++;
					
				}
				
			$xrow++;
	  
		}
		
	echo "</table>";

?>

<script src="../js/jquery.js"></script>
<script src="../js/jquery.aCollapTable.js"></script>
<script>
$(document).ready(function(){
  $('.collaptable').aCollapTable({ 
    startCollapsed: true,
    addColumn: false, 
    plusButton: '<span class="i"><b>+</b> </span>', 
    minusButton: '<span class="i"><b>-</b> </span>' 
  });
});
</script>

</body>
</html>