<?php

namespace App\Models;

use Exception;
use PDO;
use PDOException;
use PDOExecption;

class BaseModel
{

	protected function getConnect()
	{
		$conn = new PDO('mysql:host=127.0.0.1;dbname=php2_asm1;charset=utf8', 'root', '');
		return $conn;
	}

	public function insert($arr)
	{
		$this->queryBuilder = "insert into $this->tableName ";
		$cols = " (";
		$vals = " (";
		foreach ($arr as $key => $value) {
			$cols .= " $key,";
			$vals .= " :$key,";
		}
		$cols = rtrim($cols, ',');
		$vals = rtrim($vals, ',');
		$cols .= ") ";
		$vals .= ") ";
		$this->queryBuilder .= $cols . ' values ' . $vals;
		$connect = $this->getConnect();
		$stmt = $this->getConnect()
			->prepare($this->queryBuilder);
		foreach ($arr as $key => &$value) {
			$stmt->bindParam(":$key", $value);
		}
		$stmt->execute();
		// var_dump($this->qu)
		// $lastInsertId = $connect->lastInsertId();
		// return self::where(['id', '=', $lastInsertId])->first();
	}
	public function update($arr)
	{
		$this->queryBuilder = "update $this->tableName set ";

		foreach ($arr as $key => $value) {
			$this->queryBuilder .= " $key = :$key,";
		}
		$this->queryBuilder = rtrim($this->queryBuilder, ',');
		$this->queryBuilder .= " where id = :id";
		$stmt = $this->getConnect()
			->prepare($this->queryBuilder);
		foreach ($arr as $key => &$value) {
			$stmt->bindParam(":$key", $value);
		}
		$stmt->bindParam(":id", $this->id);
		$stmt->execute();
	}
	public static function rawQuery($sqlQuery)
	{
		$model = new static();
		$model->queryBuilder = $sqlQuery;
		return $model;
	}

	public function orderBy($col, $asc = true)
	{
		$this->queryBuilder .= " order by $col";
		$this->queryBuilder .= $asc == true ? " asc " : " desc ";
		return $this;
	}

	public static function sttOrderBy($col, $asc = true)
	{
		$model =  new static();
		$model->queryBuilder = "select * from $model->tableName order by $col";
		$model->queryBuilder .= $asc == true ? " asc " : " desc ";

		return $model;
	}

	public function limit($take, $skip = false)
	{
		$this->queryBuilder .= " limit $take";
		if ($skip != false) {
			$this->queryBuilder .= ", $skip";
		}

		return $this;
	}


	public function execute()
	{
		$stmt = $this->getConnect()->prepare($this->queryBuilder);
		return $stmt->execute();
	}
	public function insert_and_lastid($arr)
	{

		$this->queryBuilder = "insert into $this->tableName ";
		$cols = " (";
		$vals = " (";
		foreach ($arr as $key => $value) {
			$cols .= " $key,";
			$vals .= " :$key,";
		}
		$cols = rtrim($cols, ',');
		$vals = rtrim($vals, ',');
		$cols .= ") ";
		$vals .= ") ";
		$this->queryBuilder .= $cols . ' values ' . $vals;
		try {
			$stmt = $this->getConnect()
				->prepare($this->queryBuilder);
			foreach ($arr as $key => &$value) {
				$stmt->bindParam(":$key", $value);
			}
			$stmt->execute();
			$stmt->closeCursor();
			$this->queryBuilder = "SELECT max(id) as id FROM $this->tableName";
			$stmt = $this->getConnect()
				->prepare($this->queryBuilder);
			$stmt->execute();
			$id = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($this));
			if (count($id) > 0) {
				return $id[0];
			} else {
				return null;
			}
		} catch (PDOException $e) {
			$msg = $e->getMessage();
		}


		// $this->queryBuilder = "SELECT LAST_INSERT_ID()";
		// $stmt = $this->getConnect()
		// 	->prepare($this->queryBuilder);
		// $stmt->execute();
		// $id = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($this));

		// if (count($id) > 0) {
		// 	return $id[0];
		// } else {
		// 	return null;
		// }
	}
	public static function all()
	{
		$model = new static();
		$query = "select * from $model->tableName";
		$stmt = $model->getConnect()->prepare($query);
		$stmt->execute();
		return $stmt->fetchAll(PDO::FETCH_CLASS, get_class($model));
	}
	public static function where($arr)
	{
		$model = new static();
		$model->queryBuilder = "select * from $model->tableName where $arr[0] $arr[1] '$arr[2]'";
		return $model;
	}

	public static function destroy($id)
	{
		$model = new static();
		$model->queryBuilder = "delete from $model->tableName
 								where id = $id";

		return $model->execute();
	}
	public function andWhere($arr)
	{
		$this->queryBuilder .= " and $arr[0] $arr[1] '$arr[2]'";
		return $this;
	}
	public function orWhere($arr)
	{
		$this->queryBuilder .= " or $arr[0] $arr[1] '$arr[2]'";
		return $this;
	}
	public function first()
	{

		$stmt = $this->getConnect()->prepare($this->queryBuilder);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($this));
		if (count($result) > 0) {
			return $result[0];
		} else {
			return null;
		}
	}
	public function get()
	{
		$stmt = $this->getConnect()->prepare($this->queryBuilder);
		$stmt->execute();
		$result = $stmt->fetchAll(PDO::FETCH_CLASS, get_class($this));

		return $result;
	}
	public function save_file($fieldname, $target_dir)
    {
        $file_upload = $_FILES[$fieldname];
        $file_name = basename($file_upload['name']);
        $targer_path = IMAGE_DIR . $target_dir . $file_name;
        move_uploaded_file($file_upload['tmp_name'], $targer_path);
        return $file_name;
    }
}
