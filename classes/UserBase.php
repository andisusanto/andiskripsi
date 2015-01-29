<?php include_once('BaseObject.php'); ?>
<?php
abstract class UserBase extends BaseObject{
	public $UserName;
	protected $StoredPassword;
	public function __construct($mySQLi){
		parent::__construct($mySQLi);
	}
	public function SetPassword($Password){
		$this->StoredPassword = md5($Password);
	}
	public function ComparePassword($Password){
		return $this->StoredPassword == md5($Password);
	}
}
?>