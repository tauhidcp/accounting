<?php 

require_once("connect.php");

/* 

Transaksi Pembelian Barang
Ini Hanya Contoh Sederhana, untuk melihat kas keluar
Untuk Contoh yang lebih detail bisa meniru MODUL BANK 
dengan menyimpan data transaksi pembelian barang pada tabel terpisah. misal :
1. t_barang 			= tabel untuk menyimpan informasi stok barang (penambahan)
2. t_trans_pembelian 	= tabel untuk menyimpan informasi pembelian barang 

Debet 1010401 (Persediaan Barang)
Kredit 10101 (Kas)

*/

echo "<h3>Pembelian Barang</h3>";
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Transaksi Pembelian Barang</title>
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
	<p>Jumlah Bayar : <input type="number" name="jmlx" required></p>
	<p>Nama Barang : <input type="text" name="namax" required></p>
	<p><input type="submit" name="simpan" value="Simpan"></p>
 </form>
	
	<?php 
	
		if (isset($_POST['simpan'])){
			  
			  $idr        = rand(401,500);
			  $tgl        = date("Y-m-d", strtotime($_POST['tglx']));
			  $icoa_	  = "10101"; // 10101 Kredit (Kas)
			  $icoa       = "1010401"; // (Persediaan Barang) / Debet
			  $uraian     = "[Beli Barang] ".$_POST['namax'];
			  $nnn        = $_POST['jmlx'];
			  $type       = 'JURNAL UMUM';
			  
			  // Insert Jurnal Umum
			  $sqli = "insert into jurnal (id_trans, no_reference,
					  tgl_trans, uraian_jurnal, type_jurnal) 
					  values ('".$idr."', '".$idr."', '".$tgl."', '".$uraian."', '".$type."')";	  
			  $jurnal = mysqli_query($con,$sqli);
			  
			  // Insert Jurnal D1
			  $sqli = "insert into jurnal_d1 (ID_DETAIL, ID_TRANS, KD_COA, DEBET, KREDIT, KELOMPOK) values 
					    ('', '".$idr."', '".$icoa."', '".$nnn."', '0', 'HARTA'),
						('', '".$idr."', '".$icoa_."', '0', '".$nnn."', 'HARTA')";
			  $jurnald1 = mysqli_query($con,$sqli);	
			  
			   if (!$jurnal && !$jurnald1){
				  
				  echo "<b>Pembelian Barang Gagal Disimpan!</b>";
			  
			  } else {
				  
				 echo "<b>Pembelian Barang Berhasil Disimpan!</b>";
				 
			  }
			
		}
	
	?>
	
	
</body>
</html>