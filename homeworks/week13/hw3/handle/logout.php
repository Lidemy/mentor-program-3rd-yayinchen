<?php
	require_once '../utils.php';

	session_start(); 
	session_destroy(); //session刪除登入資料

	header('location: ../index.php');

?>