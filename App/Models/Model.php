<?php

namespace App\Models;

use App\Classes\Bind;
use App\Models\Database\TypeDatabase\TypePdoDatabase;
use App\Models\Database\TypeDatabase\TypeMysqliDatabase;
use App\Models\Database\TypeDatabase\TypeDatabase;
use App\Traits\Paginate;
use App\Traits\PaginateModel;

abstract class Model {

	use Paginate, PaginateModel;

	public $typeDatabase;

	public function __construct(){

		$database = new TypeDatabase(new TypePdoDatabase);
		$this->typeDatabase = $database->getDatabase();

	}

	public function fetchAll($paginate=null){

		$sql = "SELECT * FROM {$this->table}";
		$this->typeDatabase->prepare($sql);
		$this->typeDatabase->execute();

		Bind::bind('bind', $this->typeDatabase->getBind());

		if(!is_null($paginate)){
			return $this;
		}

		return $this->typeDatabase->fetchAll();

	}

	public function find($field, $value, $fetch=null){

		$sql = "SELECT * FROM {$this->table} WHERE {$field} = ?";
		$this->typeDatabase->prepare($sql);
		$this->typeDatabase->bindValue(1, $value);
		$this->typeDatabase->execute();

		return ($fetch == null) ? $this->typeDatabase->fetch() : $this->typeDatabase->fetchAll() ;

	}

	public function delete($field, $value){

		$sql = "DELETE FROM {$this->table} WHERE {$field} = ?";
		$this->typeDatabase->prepare($sql);
		$this->typeDatabase->bindValue(1, $value);

		return $this->typeDatabase->execute();

	}

}
