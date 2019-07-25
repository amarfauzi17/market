<?php 

function random_kode($kode){
	$data = '1234567890';
	$string = 'KPJ-';
	for($i=0;$i < $kode;$i++){
		$pos = rand(0,strlen($data)-1);
		$string .= $data{$pos}; 
	}
	
	return $string;
}

$kodepj = random_kode(10);


?>