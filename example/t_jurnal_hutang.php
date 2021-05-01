<?php 

require_once("connect.php");

/* 

Transaksi Hutang (Kewajiban)
Ini Hanya Contoh Sederhana, untuk melihat pemrosesan hutang
Untuk Contoh yang lebih detail bisa meniru MODUL BANK 
dengan menyimpan data transaksi biaya pada tabel terpisah. 

Kredit 20101 (Hutang Jangka Pendek)
Debit 10101 (Kas)

*/

echo "<h3>Transaksi Hutang (Kewajiban)</h3>";
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Transaksi Hutang (Kewajiban)</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.1/themes/base/jquery-ui.css">
  <link rel="stylesheet" href="/resources/demos/style.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.js"></script>
  <script>
  $( function() {
    $( "#datepicker" ).datepicker(
	{dateFormat: 'dd-mm-yy'}
	);
  } );
  </script>
</head>
<body>

<form method="post"> 
	<p>Tanggal Transaksi : <input type="text" name="tglx" id="datepicker" required></p>
	<p>Jumlah Hutang : <input type="number" name="jmlx" required></p>
	<p>Keterangan : <input type="text" name="namax" required></p>
	<p><input type="submit" name="simpan" value="Simpan"></p>
 </form>
	
	<?php 
	
		if (isset($_POST['simpan'])){
			  
			  $idr        = rand(701,800);
			  $tgl        = date("Y-m-d", strtotime($_POST['tglx']));
			  $icoa_	  = "10101"; // 10101 Debet (Kas)
			  $icoa       = "20101"; // (Hutang) / Kredit
			  $uraian     = "[Hutang] ".$_POST['namax'];
			  $nnn        = $_POST['jmlx'];
			  $type       = 'JURNAL UMUM';
			  
			  // Insert Jurnal Umum
			  $sqli = "insert into jurnal (id_trans, no_reference,
					  tgl_trans, uraian_jurnal, type_jurnal) 
					  values ('".$idr."', '".$idr."', '".$tgl."', '".$uraian."', '".$type."')";	  
			  $jurnal = mysqli_query($con,$sqli);
			  
			  // Insert Jurnal D1
			  $sqli = "insert into jurnal_d1 (ID_DETAIL, ID_TRANS, KD_COA, DEBET, KREDIT, KELOMPOK) values 
					    ('', '".$idr."', '".$icoa_."', '".$nnn."', '0', 'HARTA'),
						('', '".$idr."', '".$icoa."', '0', '".$nnn."', 'HARTA')";
			  $jurnald1 = mysqli_query($con,$sqli);	
			  
			   if (!$jurnal && !$jurnald1){
				  
				  echo "<b>Transaksi Hutang Gagal Disimpan!</b>";
			  
			  } else {
				  
				 echo "<b>Transaksi Hutang Berhasil Disimpan!</b>";
				 
			  }
			
		}
	
	?>
	
	
</body>
</html>