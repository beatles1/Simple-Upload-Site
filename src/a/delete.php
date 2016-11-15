<?php
session_start();
if ($_SESSION['loggedIn']) {
	if (isset($_GET['f'])) {
		unlink('../' . $_GET['f']);
	}
	header('location: ./');
} else {
	die();
}