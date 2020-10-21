<?php

/**
 * MIT License. This file is part of the Scheman package.
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace MysqlScheman\Driver\Pdo;

class Driver implements \MysqlScheman\DriverInterface {

	private $conn;

	public function connect($hostname, $username, $password, $database)
	{
		$this->conn = new \PDO("mysql:host=$hostname;dbname=$database", $username, $password);
		$this->conn->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
	}

	public function query($sql) : array
	{
		$stmt = $this->conn->prepare($sql);
  		$stmt->execute();
  		$stmt->setFetchMode(\PDO::FETCH_ASSOC);
  		return $stmt->fetchAll();
	}
}