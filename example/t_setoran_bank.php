<?php 

#Setoran Bank

#Debet 30101 (Saham Disetor)
#Kredit 10102 (Bank)

require_once("connect.php");

$sql = "select * from modul_bank";
$qry = mysqli_query($con,$sql);

echo "<h3>Setoran Bank</h3>";
?>

<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Transaksi Setoran Bank</title>
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
	<p>Pilih Bank : <select name="bank" required>
	<option value="">-Pilih-</option>
	<?php while ($data = mysqli_fetch_assoc($qry)){ ?>
	<option value="<?php echo $data['INTEGRASI_COA']."|".$data['ID']; ?>"><?php echo $data['NAME_BANK']." (".$data['AN_REKENING'].")"; ?></option>
	<?php } ?>
	</select>
	</p>
	<p>Nominal : <input type="number" name="jmlx" required></p>
	<p>Keterangan : <input type="text" name="ketx" required></p>
	<p><input type="submit" name="simpan" value="Simpan"></p>
 </form>
	
	<?php 
	
		if (isset($_POST['simpan'])){
			  
			  $idr        = rand(200,300);
			  $tgl        = date("Y-m-d", strtotime($_POST['tglx']));
			  $bank 	  = explode("|",$_POST['bank']);
			  $id_bank    = $bank[1]; 
			  $icoa_bank  = $bank[0]; // 10102 Kredit (Bank)
			  $icoa       = "30101"; // (Saham Disetor) / Debet
			  $uraian     = "[Setoran Bank] ".$_POST['ketx'];
			  $nnn        = $_POST['jmlx'];
			  $type       = 'MODUL BANK';
			  
			   // Insert Modul Bank Trans
			  $sqli = "insert modul_bank_trans (id, ID_BANK,
					  TGL_TRANS, JENIS_TRANS, NOMINAL, URAIAN) 
					  values ('".$idr."', '".$id_bank."', '".$tgl."', 'Setoran', '".$nnn."', '".$uraian."')";	  
			  $mbank = mysqli_query($con,$sqli);
			  
			  // Insert Jurnal Umum
			  $sqli = "insert into jurnal (id_trans, no_reference,
					  tgl_trans, uraian_jurnal, type_jurnal) 
					  values ('".$idr."', '".$idr."', '".$tgl."', '".$uraian."', '".$type."')";	  
			  $jurnal = mysqli_query($con,$sqli);
			  
			  // Insert Jurnal D1
			  $sqli = "insert into jurnal_d1 (ID_DETAIL, ID_TRANS, KD_COA, DEBET, KREDIT, KELOMPOK) values 
					    ('', '".$idr."', '".$icoa_bank."', '".$nnn."', '0', 'HARTA'),
						('', '".$idr."', '".$icoa."', '0', '".$nnn."', 'HARTA')";
			  $jurnald1 = mysqli_query($con,$sqli);	
			  
			   if (!$jurnal && !$jurnald1 && !$mbank){
				  
				  echo "<b>Setoran Gagal Disimpan!</b>";
			  
			  } else {
				  
				 echo "<b>Setoran Berhasil Disimpan!</b>";
				 
			  }
			
		}
	
	?>
	
	
</body>
</html>