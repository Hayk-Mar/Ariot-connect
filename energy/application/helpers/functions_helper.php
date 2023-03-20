<?php
defined('BASEPATH') or exit('No direct script access allowed');

function print_pre($data, $doExit = FALSE)
{
	echo '<pre>';
	print_r($data);
	echo '</pre>';
	$doExit ? exit : null;
}

function arrayMustOnlyContain(array $arr, array $mustOnlyContain, $mustContainAllData = 0)
{
	foreach ($arr as $bin => $key) {
		if (!empty($bin) && !in_array($bin, $mustOnlyContain)) {
			unset($arr[$bin]);
		}
	}

	if($mustContainAllData) {
		foreach($mustOnlyContain as $key) {
			if(!isset($arr[$bin])) return [null, 'You have not filled in all the fields'];
		}
	}

	return [$arr, null];
}

function unsetInfo(array $arr, array $unsetInfo)
{
	foreach ($arr as $bin => $key) {
		if (!empty($bin) && in_array($bin, $unsetInfo)) {
			unset($arr[$bin]);
		}
	}

	return $arr;
}