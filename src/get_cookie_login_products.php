<?php   
function getLogin()
{
	session_start();
	return $_SESSION['login'];
}
