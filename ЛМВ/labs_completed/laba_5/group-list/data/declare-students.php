<?php 
	$nameTpl = '/^student-\d\d.txt\z/';
	$path = __DIR__ . "/group";
	$conts = scandir($path);

	$i = 0;
	foreach ($conts as $node) {
		if (preg_match($nameTpl, $node)) {
			$data['students'][$i] = require __DIR__ . '/declare-student.php';
			$i++;
		}
	}
?>