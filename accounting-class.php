<?php 

/*****************************
 *
 * Accounting Class
 * 
 * simple class to create accounting report
 * adjusted from GlobalFinance.pas writed by Heri Tico [KPPDI] / @hasan99123 [Telegram] 
 * 
 * Author : Ahmad Tauhid (ahmad.tauhid.cp [at] gmail [dot] com)
 * 
 * http://www.tauhidslab.my.id
 * https://github.com/tauhidcp/accounting.git
 *  
 ******************************/
 
class Accounting{
	
	private $tgl_satu;
	private $tgl_dua;
	private $con;
	private $output;
	private $datax;

	function __construct($con){
		
		$this->con 		= $con;
		$this->output	= array();
		$this->datax	= array();
		
	}
	
	public function Hitung_SHU_Saldo_Awal(){
		
		$sql  = mysqli_query($this->con,'select acc1.kd_coa, sum(debet) debet, sum(kredit) 
									     kredit from jurnal acc, jurnal_d1 acc1 where acc.tgl_trans < "'.$this->getTglDua().'" 
									     and acc.id_trans = acc1.id_trans and (acc1.kelompok="PENDAPATAN" or acc1.kelompok="BIAYA") 
									     group by acc1.kd_coa order by acc1.kd_coa');
		while($data = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
		
			$this->datax[] = $data;
		
		}
		
		return $this->datax;
		
	}

	public function Hitung_SHU_Debet_Kredit(){
		
		$sql  = mysqli_query($this->con,'SELECT SUM(DEBET) DEBET, SUM(KREDIT) KREDIT  
									     FROM jurnal acc, jurnal_d1 acc1 
									     WHERE acc.TGL_TRANS BETWEEN "'.$this->getTglDua().'" AND "'.$this->getTglSatu().'" AND acc.ID_TRANS = acc1.ID_TRANS 
									     AND (acc1.kelompok="PENDAPATAN" OR acc1.kelompok="BIAYA") 
									     ORDER BY acc1.kd_coa');
		while($data = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
		
			$this->datax[] = $data;
		
		}
		
		return $this->datax;
		
	}
	
	public function InsertSaldoAwal(){
		
		$sql  	 = mysqli_query($this->con,'SELECT value_parameter as vparam FROM apps_setting WHERE parameter_name = "LABA_DITAHAN"');
		$data 	 = mysqli_fetch_array($sql, MYSQLI_ASSOC);
		$idcoalr = $data['vparam'];
		
		$sql  	 = mysqli_query($this->con,'SELECT acc.ID_TRANS, acc.TGL_TRANS, acc1.KD_COA, c.D_K, sum(DEBET) DEBET, sum(KREDIT) KREDIT 
											FROM jurnal acc, jurnal_d1 acc1, coa c 
											WHERE acc.TGL_TRANS < "'.$this->getTglDua().'" AND acc.ID_TRANS = acc1.ID_TRANS AND 
											acc1.KD_COA = c.KD_COA 
											GROUP BY acc1.KD_COA 
											ORDER BY acc.TGL_TRANS, acc.ID_TRANS');
 
        if (mysqli_num_rows($sql) > 0){
 
			$sawal   = 0;
			$sakhir  = 0;
			$laba    = 0;
			$biaya   = 0;
			
			while ($data = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
				
				$idcoa = $data['kd_coa'];
				$dk    = substr($idcoa,1,1);
				$dbet  = $data['debet'];
				$krdt  = $data['kredit'];
	 
				if (($dk=="1") || ($dk=="5")){
					
					$sakhir = $sawal+$dbet-$krdt;
				
				} else if (($dk=="2") || ($dk=="3") || ($dk=="4")){
					
					$sakhir = $sawal+$krdt-$dbet;
				
				}
	 
				$sakhir = str_replace(",",".",$sakhir);
				@mysqli_query($this->con,'update coa set saldo_awal = "'.$sakhir.'" where kd_coa = "'.$idcoa.'" and m_d = "D"');
				
			}
			
			//update coa detail SHU Saldo Awal
			$data = $this->Hitung_SHU_Saldo_Awal();
			
			if (count($data)>0){
			
				for($i = 0; $i < count($data); $i++) {
	
					$idcoa  = substr($data[$i]['KD_COA'],1,1);
					$dbet   = $data[$i]['DEBET'];
					$krdt   = $data[$i]['KREDIT'];
		 
					if ($idcoa == '4'){ $laba  = $laba+$krdt-$dbet; }
					if ($idcoa == '5'){ $biaya = $biaya+$dbet-$krdt; }
					
				}
			}
	 
			$shu = $laba-$biaya;
			
			$shu = str_replace(",",".",$shu);
			@mysqli_query($this->con,'update coa set saldo_awal = "'.$shu.'" where kd_coa = "'.$idcoalr.'"');
		
		}
	}
	
	public function InsertDebetKredit(){
		
		$sql  	 = mysqli_query($this->con,'SELECT value_parameter as vparam FROM apps_setting WHERE parameter_name = "LABA_DITAHAN"');
		$data 	 = mysqli_fetch_array($sql, MYSQLI_ASSOC);
		$idcoalr = $data['vparam'];
		
		$sql  	 = mysqli_query($this->con,'select acc.id_trans, acc.tgl_trans, acc1.kd_coa, c.d_k, sum(debet) debet, sum(kredit) kredit 
										    from jurnal acc, jurnal_d1 acc1, coa c 
										    where acc.tgl_trans between "'.$this->getTglDua().'" and "'.$this->getTglSatu().'" and acc.id_trans = acc1.id_trans and 
										    acc1.kd_coa = c.kd_coa 
										    group by acc1.kd_coa 
										    order by acc.tgl_trans, acc.id_trans');
 
        if (mysqli_num_rows($sql) > 0){
			
			//update coa detail account Debet & Kredit
			while ($data = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
              
				$idcoa = $data['kd_coa'];
				$ddd   = $data['debet'];
				$kkk   = $data['kredit'];
	 
				$idcoa = str_replace(",",".",$idcoa);
				$ddd   = str_replace(",",".",$ddd);
				$kkk   = str_replace(",",".",$kkk);
				  
				@mysqli_query($this->con,'update coa set saldo_debet = "'.$ddd.'", saldo_kredit = "'.$kkk.'" where kd_coa = "'.$idcoa.'" and m_d ="D"');
 
			}
 
          //update coa detail SHU Saldo Debet & Kredit
          $data = $this->Hitung_SHU_Debet_Kredit();
		  
          $ddd   = $data[0]['DEBET'];
          $kkk   = $data[0]['KREDIT'];
 
          $ddd   = str_replace(",",".",$ddd);
		  $kkk   = str_replace(",",".",$kkk);
          
		  @mysqli_query($this->con,'update coa set saldo_debet = "'.$ddd.'", saldo_kredit = "'.$ddd.'" where kd_coa = "'.$idcoalr.'"');

		}
		
	}
	
	public function InsertDtoM(){
		
		$sql  	 = mysqli_query($this->con,'SELECT MAX(level_coa) LEVEL_COA FROM coa WHERE m_d = "D"');
		$data 	 = mysqli_fetch_array($sql, MYSQLI_ASSOC);
        $xlvl 	 = $data['LEVEL_COA'];
 
        while ($xlvl > 0){
            
		$sql  	 = mysqli_query($this->con,'SELECT KD_INDUK_COA, M_D, LEVEL_COA, SUM(saldo_awal) SAW1, 
										    SUM(saldo_debet) SD1, SUM(saldo_kredit) SK1 
										    FROM coa WHERE level_coa = "'.$xlvl.'" AND m_d = "D" 
										    GROUP BY KD_INDUK_COA ORDER BY KD_COA');
		$data 	 = mysqli_fetch_array($sql, MYSQLI_ASSOC);
			
			while ($data = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
                    
				$iidk = $data['kd_induk_coa'];
                $saw  = $data['SAW1'];
                $ddd  = $data['SD1'];
                $kkk  = $data['SK1'];
	
				$saw   = str_replace(",",".",$saw);
				$kkk   = str_replace(",",".",$kkk);
				$ddd   = str_replace(",",".",$ddd);
          
				@mysqli_query($this->con,'update coa set saldo_awal = "'.$saw.'", saldo_debet = "'.$ddd.'", saldo_kredit = "'.$kkk.'" where kd_coa = "'.$iidk.'"');
		 
			}            
			
            $xlvl = $xlvl - 1;
        }
		
	}
	
	public function InsertMtoM(){
	
		$sql  	 = mysqli_query($this->con,'SELECT MAX(level_coa) LEVEL_COA FROM coa WHERE m_d = "M"');
		$data 	 = mysqli_fetch_array($sql, MYSQLI_ASSOC);
        $xlvl 	 = $data['LEVEL_COA'];
 
        while ($xlvl > 0){
			
			$sql  	 = mysqli_query($this->con,'SELECT KD_INDUK_COA, M_D, LEVEL_COA, SUM(saldo_awal) SAW1, 
											    SUM(saldo_debet) SD1, SUM(saldo_kredit) SK1 
											    FROM coa WHERE level_coa = "'.$xlvl.'" AND m_d = "M" 
											    GROUP BY KD_INDUK_COA ORDER BY KD_COA');
			$data 	 = mysqli_fetch_array($sql, MYSQLI_ASSOC);
			
			while ($data = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
				
                $iidk  = $data['kd_induk_coa'];
				
				$sql2  = mysqli_query($this->con,'select saldo_awal, saldo_debet, saldo_kredit from coa where kd_induk_coa = "'.$iidk.'"');
				$data2 = mysqli_fetch_array($sql2, MYSQLI_ASSOC);
			
                $saw  = $data2['saldo_awal'];
                $ddd  = $data2['saldo_debet'];
                $kkk  = $data2['saldo_kredit'];
				
				$saw   = str_replace(",",".",$saw);
				$kkk   = str_replace(",",".",$kkk);
				$ddd   = str_replace(",",".",$ddd);
				
				@mysqli_query($this->con,'update coa set saldo_awal = "'.$saw.'", saldo_debet = "'.$ddd.'", saldo_kredit = "'.$kkk.'" where kd_coa = "'.$iidk.'"');
				
            }
			
            $xlvl = $xlvl - 1;
        }
	
	}
	
	public function FinalCalc(){
		
		$sql  	 = mysqli_query($this->con,'SELECT SUBSTRING(KD_COA, 1,1) id_acc, SUM(saldo_awal) SAW1, 
											SUM(saldo_debet) SD1, SUM(saldo_kredit) SK1 
											FROM coa WHERE m_d = "D" 
											GROUP BY SUBSTRING(KD_COA, 1,1) 
											ORDER BY kd_coa');
		$data 	 = mysqli_fetch_array($sql, MYSQLI_ASSOC);
    
        while ($data = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
			
            $icoa = $data['id_acc'];
            $saw  = $data['SAW1'];
            $ddd  = $data['SD1'];
            $kkk  = $data['SK1'];
 
            $saw   = str_replace(",",".",$saw);
			$kkk   = str_replace(",",".",$kkk);
			$ddd   = str_replace(",",".",$ddd);
			
			@mysqli_query($this->con,'update coa set saldo_awal = "'.$saw.'", saldo_debet = "'.$ddd.'", saldo_kredit = "'.$kkk.'" where kd_coa = "'.$icoa.'"');
			
        }
		
	}
	
	//PROSES INSERT SALDO AKHIR
	public function CalcSaldoAkhir(){
		
		$sql  	 = mysqli_query($this->con,'select kd_coa, d_k, 
										    saldo_awal, saldo_debet, saldo_kredit, 
										    IF(d_k="D", saldo_awal+saldo_debet-saldo_kredit, 
										    saldo_awal+saldo_kredit-saldo_debet) saldo_akhir 
										    from coa order by kd_coa');
		$data 	 = mysqli_fetch_array($sql, MYSQLI_ASSOC);
    
        while ($data = mysqli_fetch_array($sql, MYSQLI_ASSOC)){
			
			$icoa  = $data['kd_coa'];
			$sak   = $data['saldo_akhir'];
 
            $sak   = str_replace(",",".",$sak);
			
			@mysqli_query($this->con,'update coa set saldo_akhir = "'.$sak.'" where kd_coa = "'.$icoa.'"');
			
        }
		
	}
	
	public function NolSaldo(){
	
		@mysqli_query($this->con,'UPDATE coa SET saldo_awal =0, saldo_debet =0, saldo_kredit =0, saldo_akhir =0');
	
	}
	
	/* Setter & Getter Tanggal */
	
	public function setTglSatu($tgl){
		
		$this->tgl_satu = date("Y-m-d", strtotime($tgl));
	
	}
	
	public function setTglDua($tgl){
		
		$this->tgl_dua = date("Y-m-d", strtotime($tgl));
	
	}
	
	private function getTglSatu(){
		
		return $this->tgl_satu;
		
	}
	
	private function getTglDua(){
		
		return $this->tgl_dua;
	}

}

?>