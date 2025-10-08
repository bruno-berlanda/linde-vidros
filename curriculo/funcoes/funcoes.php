<?php

function caracteres($a) {
	$caracteres = array ("'", "\"");

	$stg = str_replace($caracteres, "", $a);

	return $stg;
}