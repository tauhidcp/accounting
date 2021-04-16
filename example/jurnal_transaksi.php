<?php 

require_once("connect.php");
require_once("../accounting-class.php");

$tgl1 = "01-04-2018";
$tgl2 = "30-04-2018";

$acc = new Accounting($con);

$acc->setTglSatu($tgl1);
$acc->setTglDua($tgl2);


//print_r($hasil);

?>