<?php 

require_once("connect.php");
require_once("../accounting-class.php");

$tgl1 = "01-04-2018";
$tgl2 = "30-04-2018";

$acc = new Accounting($con);

$acc->setTglSatu($tgl1);
$acc->setTglDua($tgl2);

/* -- Ini Hanya Contoh Nama dan Kode Akun Menggunakan Bank (10102) -> Lihat di Data COA -> M_D = M (Gak Bisa Dijurnal)
	  Opsi Lain Dapat Menggunakan Pilihan Combobox 
	  atau Menggunakan Perulangan untuk mentotal semua history transaksi akun 
	  ---- */	
	  
$nmakun   = "Bank";
$kodeakun = "10102";

	echo "Tanggal Awal : ".$tgl1;
	echo "</br>";
	echo "Tanggal Akhir : ".$tgl2;
	echo "</br>";
	echo "Nama Akun : ".$nmakun;
	echo "</br>";
	echo "Kode Akun : ".$kodeakun;
	echo "</br>";
	echo "</br>";
	
	echo "<table border='1'>";
	
		echo "<tr style='background-color:#99DDCC'>";
			echo "<td>No</td> <td>Id Trans</td> <td>Tgl Trans</td> <td>Uraian Jurnal</td> <td>Debet</td> <td>Kredit</td> <td>Saldo Akhir</td>";
		echo "</tr>";
		
		$xrow = 1;
		$ndd  = 0;
		$nkk  = 0;
  
		$sql = "SELECT COUNT(c.d_k) nnn, IF(c.d_k='D', 
				SUM(acc1.debet)-SUM(acc1.kredit), 
				SUM(acc1.kredit)-SUM(acc1.debet)) Saldo_Awal 
				FROM jurnal acc, jurnal_d1 acc1, coa c 
				WHERE acc.tgl_trans < '".$acc->getTglSatu()."' AND c.kd_coa = '".$kodeakun."' 
				AND acc1.id_trans = acc.id_trans AND c.kd_coa = acc1.kd_coa 
				GROUP BY c.kd_coa";
		
		$qry = mysqli_query($con,$sql);
		$data = mysqli_fetch_assoc($qry);
			
		$nnn  = @$data['nnn'];
		if ($nnn > 0){ $saw = $data['Saldo_Awal']; } else { $saw = 0; }

		$sak = $saw;
		$sql = "SELECT acc.id_trans, acc.no_reference, acc.tgl_trans, 
				acc.type_jurnal, acc.uraian_jurnal, acc1.debet, 
				acc1.kredit, c.d_k 
				FROM jurnal acc, jurnal_d1 acc1, coa c 
				WHERE acc.tgl_trans BETWEEN '".$acc->getTglSatu()."' AND '".$acc->getTglDua()."' AND c.kd_coa = '".$kodeakun."' 
				AND acc1.id_trans = acc.id_trans AND c.kd_coa = acc1.kd_coa 
				ORDER BY acc.tgl_trans, acc.id_trans, acc1.id_detail";
	
		$qry = mysqli_query($con,$sql);
		while ($data = mysqli_fetch_assoc($qry)){
		
			$idtr = $data['id_trans'];
			$ddd  = $data['debet'];
			$kkk  = $data['kredit'];
			$dk   = $data['d_k'];
			$ndd  = $ndd + $ddd;
			$nkk  = $nkk + $kkk;

			if ($dk == 'D'){ $sak = $sak+$ddd-$kkk; } else { $sak = $sak+$kkk-$ddd; }
		
			echo "<tr>";
				echo "<td>".$xrow."</td>";
				echo "<td>".$data['id_trans']."</td>";
				echo "<td>".$data['tgl_trans']."</td>";
				echo "<td>".$data['uraian_jurnal']."</td>";
				echo "<td>".$ddd."</td>";
				echo "<td>".$kkk."</td>";
				echo "<td>".$sak."</td>";
			echo "</tr>";
			$xrow++;               
		
		}
		
	echo "</table>";
	
	echo "</br>";
	echo "Saldo Awal : ".$saw;
	echo "</br>";
	echo "Debet : ".$ndd;
	echo "</br>";
	echo "Kredit : ".$nkk;
	echo "</br>";
	echo "Saldo Akhir : ".$sak;
	echo "</br>";
?>