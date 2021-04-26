<?php 

	require_once("connect.php");
	require_once("../accounting-class.php");

	$tgl2 = "30-04-2018";

	$acc = new Accounting($con);

	$acc->setTglDua($tgl2);

	echo "Tanggal Laporan : ".$tgl2;
	echo "</br>";
	echo "</br>";
	
	$acc->NolSaldo(); 
	$acc->InsertSaldoAwal($acc->getTglDua()); 
	$acc->InsertDebetKredit($acc->getTglDua(), $acc->getTglDua()); 
	$acc->InsertDtoM(); 
	$acc->InsertMtoM(); 
	$acc->FinalCalc(); 
	$acc->CalcSaldoAkhir(); 
	
   /*
   Laporan Aktiva
   */
   
	echo "<table border='1'>";
	
		echo "<tr style='background-color:#99DDCC'>";
			echo "<td>No</td> <td>Kode COA</td> <td>M/D</td> <td>Aktiva</td> <td>Saldo</td>";
		echo "</tr>";
	
		  $nsaka = 0;
		  $xrow = 1;

	  
	  		$sql = "SELECT kd_coa, nama_coa, m_d, level_coa, 
            akt_psv, saldo_awal, saldo_debet, saldo_kredit, saldo_akhir 
            FROM coa WHERE akt_psv = '1'
            ORDER BY kd_coa";
	
		$qry = mysqli_query($con,$sql);
		while ($data = mysqli_fetch_assoc($qry)){
		
			$sak = $data['saldo_akhir'];
			
			$nnol = $sak;
			
			if ($nnol != 0){ 
			
			  if ($data['m_d'] == 'D'){ $nsaka = $nsaka + $sak; }

					echo "<tr>";
					echo "<td>".$xrow."</td>";
					echo "<td>".$data['kd_coa']."</td>";
					echo "<td>".$data['m_d']."</td>";
					echo "<td>".$data['nama_coa']."</td>";
					echo "<td>".$sak."</td>";
					echo "</tr>";

			  $xrow = $xrow + 1;
			}
		}
		
	echo "</table>";
	
	$sakt = $nsaka;
	echo "Saldo Akhir Aktiva : ".$sakt;
	echo "</br>";
	
	/*
   Laporan Passiva
   */
   
	echo "<table border='1'>";
	
		echo "<tr style='background-color:#99DDCC'>";
			echo "<td>No</td> <td>Kode COA</td> <td>M/D</td> <td>Passiva</td> <td>Saldo</td>";
		echo "</tr>";
	
		  $nsakp = 0;
		  $xrow = 1;

	  
	  		$sql = "SELECT kd_coa, nama_coa, m_d, level_coa, 
            akt_psv, saldo_awal, saldo_debet, saldo_kredit, saldo_akhir 
            FROM coa WHERE akt_psv = '2'
            ORDER BY kd_coa";
	
		$qry = mysqli_query($con,$sql);
		while ($data = mysqli_fetch_assoc($qry)){

        $sak = $data['saldo_akhir'];
		
        $nnol = $sak;
		
		if ($nnol != 0){ 
			
			  if ($data['m_d'] == 'D'){ $nsakp = $nsakp + $sak; }

					echo "<tr>";
					echo "<td>".$xrow."</td>";
					echo "<td>".$data['kd_coa']."</td>";
					echo "<td>".$data['m_d']."</td>";
					echo "<td>".$data['nama_coa']."</td>";
					echo "<td>".$sak."</td>";
					echo "</tr>";

			  $xrow = $xrow + 1;
			}
		}
		
	echo "</table>";

   $spsv = $nsakp;
   echo "Saldo Akhir Passiva : ".$spsv;	
  
?>