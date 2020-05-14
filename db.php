<?php

/**
** Класс конфигурации базы данных
*/



class DB{
	const USER = "debian-sys-maint";
	const PASS = "sOHkvVS9GgbJd9Gy";
	const HOST = "localhost";
	const DB   = "php_mvc_tasks";

	public static function connToDB() {

		$user = self::USER;
		$pass = self::PASS;
		$host = self::HOST;
		$db   = self::DB;

		$conn = new PDO("mysql:dbname=$db;host=$host", $user, $pass);
		return $conn;

	}
}