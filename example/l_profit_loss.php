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
	
  
?>