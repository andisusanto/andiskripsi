<?php include_once('Connection.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
abstract class BaseObject{
	protected $Id;
	protected $LockField;
	private $mySQLi;
	
	public function __construct($mySQLi){
		$this->mySQLi = $mySQLi;
	}
	
	public function get_mySQLi(){
		return $this->mySQLi;
	}
	
	public function get_Id(){
		return $this->Id;
	}
	
	public function get_IsNew(){
		return $this->fIsNew;
	}
	
	public function Save(){
		$this->OnSaving();
		$this->LockField = 0;
        $query = str_replace("''","NULL",$this->get_SaveQuery());
		if($this->mySQLi->query($query)){
			$this->Id = $this->mySQLi->insert_id;
			$this->OnSaved();
		}
		else
		{
			throw new InvalidQueryException;
		}
	}
	public function Update(){
		$this->OnSaving();
		$tmpSQLi = Connection::get_DefaultConnection();
		$tmpQuery = "SELECT LockField FROM ".$this->get_TableName()." WHERE Id = ".$this->Id;
		if($result = $tmpSQLi->query($tmpQuery)){
			if($row = $result->fetch_row()){
				if ($this->LockField >= $row[0]){
					$this->LockField++;
					if ($result = $this->mySQLi->query(str_replace("''","NULL",$this->get_UpdateQuery()))){
						$this->OnSaved();
					}
					else
					{
						throw new InvalidQueryException;
					}
				}
				else
				{
					throw new ObjectModifiedException;
				}
			}
			else
			{
				throw new ObjectNotFoundException;
			}
		}
		else{
			throw new InvalidQueryException;
		}
	}
	
	protected function OnSaving(){
	}
	protected function OnSaved(){
	}
	protected abstract function get_SaveQuery();
	protected abstract function get_UpdateQuery();
	protected abstract function get_TableName();
}
?>