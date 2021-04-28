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
	
	$npl  = 0;

	   	/* 
		
		TABEL PENDAPATAN
		
		*/
		
	echo "<table border='1'>";
	
		echo "<tr style='background-color:#99DDCC'>";
			echo "<td>No</td> <td>Kode COA</td> <td>Nama COA</td> <td>M/D</td> <td>Saldo Awal</td> <td>Saldo Debet</td> <td>Saldo Kredit</td> <td>Saldo Akhir</td>";
		echo "</tr>";
	  
      $nsaw = 0;
      $nddd = 0;
      $nkkk = 0;
      $nsak = 0;
	  $xrow = 1;
		
	$sql = "SELECT kd_coa, nama_coa, m_d, level_coa, 
            akt_psv, saldo_awal, saldo_debet, saldo_kredit, saldo_akhir 
            FROM coa WHERE akt_psv = '4'
            ORDER BY kd_coa";
	
		$qry = mysqli_query($con,$sql);
		while ($data = mysqli_fetch_assoc($qry)){
			
        $saw = $data['saldo_awal'];
        $ddd = $data['saldo_debet'];
        $kkk = $data['saldo_kredit'];
        $sak = $data['saldo_akhir'];

        $nnol = $sak;
		
        if ($nnol != 0){
      
          if ($data['m_d'] == 'D'){
			  
              $nsaw = $nsaw + $saw;
              $nddd = $nddd + $ddd;
              $nkkk = $nkkk + $kkk;
              $nsak = $nsak + $sak;
			
			} 
			
					echo "<tr>";
					echo "<td>".$xrow."</td>";
					echo "<td>".$data['kd_coa']."</td>";
					echo "<td>".$data['nama_coa']."</td>";
					echo "<td>".$data['m_d']."</td>";
					echo "<td>".$saw."</td>";
					echo "<td>".$ddd."</td>";
					echo "<td>".$kkk."</td>";
					echo "<td>".$sak."</td>";
					echo "</tr>";
					
  
          $xrow = $xrow + 1;
        }
      
		}
		
		echo "</table>";
		  
		// 4 = Pendapatan
        $npl = $npl + $nsak;

		echo "<b>TOTAL PENDAPATAN</b></br>";
		echo "Total Saldo Awal : ".$nsaw."</br>";
		echo "Total Saldo Debet : ".$nddd."</br>";
		echo "Total Saldo Kredit : ".$nkkk."</br>";
		echo "Total Saldo Akhir : ".$nsak."</br>";
		echo "<i>Profit : ".$nsak."</i><br>";	
	   
	   	/* 
		
		TABEL BIAYA
		
		*/
		
	echo "<table border='1'>";
	
		echo "<tr style='background-color:#99DDCC'>";
			echo "<td>No</td> <td>Kode COA</td> <td>Nama COA</td> <td>M/D</td> <td>Saldo Awal</td> <td>Saldo Debet</td> <td>Saldo Kredit</td> <td>Saldo Akhir</td>";
		echo "</tr>";
	  
		  $nsaw = 0;
		  $nddd = 0;
		  $nkkk = 0;
		  $nsak = 0;
		  $xrow = 1;
			
		$sql = "SELECT kd_coa, nama_coa, m_d, level_coa, 
				akt_psv, saldo_awal, saldo_debet, saldo_kredit, saldo_akhir 
				FROM coa WHERE akt_psv = '5'
				ORDER BY kd_coa";
	
		$qry = mysqli_query($con,$sql);
		while ($data = mysqli_fetch_assoc($qry)){
			
        $saw = $data['saldo_awal'];
        $ddd = $data['saldo_debet'];
        $kkk = $data['saldo_kredit'];
        $sak = $data['saldo_akhir'];

        $nnol = $sak;
		
        if ($nnol != 0){
      
          if ($data['m_d'] == 'D'){
			  
              $nsaw = $nsaw + $saw;
              $nddd = $nddd + $ddd;
              $nkkk = $nkkk + $kkk;
              $nsak = $nsak + $sak;
          } 
		  
					echo "<tr>";
					echo "<td>".$xrow."</td>";
					echo "<td>".$data['kd_coa']."</td>";
					echo "<td>".$data['nama_coa']."</td>";
					echo "<td>".$data['m_d']."</td>";
					echo "<td>".$saw."</td>";
					echo "<td>".$ddd."</td>";
					echo "<td>".$kkk."</td>";
					echo "<td>".$sak."</td>";
					echo "</tr>";
					
  
          $xrow = $xrow + 1;
        }
      
		}
		
		echo "</table>";
		  			
	  // 5 = Biaya
      $npl           = $npl - $nsak;

	  echo "<b>TOTAL BIAYA</b></br>";
	  echo "Total Saldo Awal : ".$nsaw."</br>";
	  echo "Total Saldo Debet : ".$nddd."</br>";
	  echo "Total Saldo Kredit : ".$nkkk."</br>";
	  echo "Total Saldo Akhir : ".$nsak."</br>";
	  echo "<i>Loss : ".$nsak."</i><br>";
      echo "</br>";
      echo "</br>";
	  echo "<i>Profit/Loss : ".$npl."</i><br>";
  

?>