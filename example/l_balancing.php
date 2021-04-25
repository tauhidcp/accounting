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
	$acc->Hitung_SHU_Saldo_Awal($acc->getTglDua()); 
	$acc->Hitung_SHU_Debet_Kredit($acc->getTglDua(), $acc->getTglDua()); 
	$acc->InsertSaldoAwal($acc->getTglDua(), $acc->getTglDua()); 
	$acc->InsertDebetKredit($acc->getTglDua(), $acc->getTglDua()); 
	$acc->InsertDtoM(); 
	$acc->InsertMtoM(); 
	$acc->FinalCalc(); 
	$acc->CalcSaldoAkhir(); 

  	echo "<table border='1'>";
	
		echo "<tr style='background-color:#99DDCC'>";
			echo "<td>No</td> <td>Kode COA</td> <td>M/D</td> <td>Aktiva</td> <td>Saldo</td>"; // <td>|</td> <td>Kode COA</td> <td>M/D</td> <td>Passiva</td> <td>Saldo</td>";
		echo "</tr>";
		
		$nrow = 0;
		$Ycol = 1;

		$sql  = 'SELECT count(kd_coa) iii FROM coa where akt_psv = 1';
		$qry  = mysqli_query($con,$sql);
		$data = mysqli_fetch_assoc($qry);
		$nnn  = $data['iii'];
		
		
		
		$sql  = 'SELECT count(kd_coa) iii FROM coa where akt_psv = 1';
		$qry  = mysqli_query($con,$sql);
		$data = mysqli_fetch_assoc($qry);
	
	
		if ($nnn < $data['iii']){ $nnn = $data['iii']; }
		
		//echo $nnn;
		
   // Grid1.RowCount := nnn + 1;
   // EdRow.Text     := IntToStr(Grid1.RowCount-1);

    for ($akpv=1; $akpv<=2; $akpv++){ 
	
      $nsak = 0;
      $xrow = 1;

	  
	  		$sql = "SELECT kd_coa, nama_coa, m_d, level_coa, 
            akt_psv, saldo_awal, saldo_debet, saldo_kredit, saldo_akhir 
            FROM coa WHERE akt_psv = '".$akpv."'
            ORDER BY kd_coa";
	
		$qry = mysqli_query($con,$sql);
		while ($data = mysqli_fetch_assoc($qry)){
			
        $sps = '';
        $lvl = $data['level_coa'];
        $sak = $data['saldo_akhir'];
		
        $nnol = $sak;
			if ($nnol != 0){ 
			
			  if ($data['m_d'] == 'D'){ $nsak = $nsak + $sak; }
			  
			  for ($iii=0; $iii<=$lvl; $iii++){

				  $sps = $sps.' ';

			  }

					echo "<tr>";
					echo "<td>".$xrow."</td>";
					echo "<td>".$data['kd_coa']."</td>";
					echo "<td>".$data['m_d']."</td>";
					echo "<td>".$sps."".$data['nama_coa']."</td>";
					echo "<td>".$sak."</td>";
					echo "</tr>";

			  $xrow = $xrow + 1;
			}
		}
		
      if ($nrow < $xrow){ $nrow = $xrow; }
      
	  $Ycol = $Ycol + 4;
    } 

    $sakt = $nsak;
    //Grid1.Cells[3, nrow+1]          := 'SALDO AKTIVA ';
    //Grid1.Cells[4, nrow+1]          := FormatFloat(',0.00;(,0.00);',sakt);
    $spsv = $nsak;
    //Grid1.Cells[7, nrow+1]          := 'SALDO PASSIVA ';
    //Grid1.Cells[8, nrow+1]          := FormatFloat(',0.00;(,0.00);',spsv);

   // Grid1.RowCount := nrow+2;
   // RowReport      := Grid1.RowCount-1;
   // EdRow.Text     := IntToStr(Grid1.RowCount-1);
  //end;  
  
  echo "</table>";
?>