<?php include_once('UserBase.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class Admin extends UserBase{
   const TABLENAME = 'Admin';
   public function __construct($mySQLi){
       parent::__construct($mySQLi);
   }
    public $IsActive;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(UserName,IsActive,StoredPassword,LockField) VALUES('".$mySQLi->real_escape_string($this->UserName)."','".$mySQLi->real_escape_string($this->IsActive)."','".$mySQLi->real_escape_string($this->StoredPassword)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET UserName = '".$mySQLi->real_escape_string($this->UserName)."', IsActive = '".$mySQLi->real_escape_string($this->IsActive)."', StoredPassword = '".$mySQLi->real_escape_string($this->StoredPassword)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpAdmin = new Admin($mySQLi);
               $tmpAdmin->Id = $row['Id'];
               $tmpAdmin->UserName = $row['UserName'];
               $tmpAdmin->IsActive = $row['IsActive'];
               $tmpAdmin->StoredPassword = $row['StoredPassword'];

               $tmpAdmin->LockField = $row['LockField'];
               return $tmpAdmin;
           }
           else
           {
               return false;
           }
       }
       else
       {
           throw new InvalidQueryException;
       }
   }
   public static function GetObjectByUserName($mySQLi, $UserName){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE UserName = '".$mySQLi->real_escape_string($UserName)."' LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpAdmin = new Admin($mySQLi);
               $tmpAdmin->Id = $row['Id'];
               $tmpAdmin->UserName = $row['UserName'];
               $tmpAdmin->IsActive = $row['IsActive'];
               $tmpAdmin->StoredPassword = $row['StoredPassword'];

               $tmpAdmin->LockField = $row['LockField'];
               return $tmpAdmin;
           }
           else
           {
               return false;
           }
       }
       else
       {
           throw new InvalidQueryException;
       }
   }
   public static function LoadCollection($mySQLi, $Criteria = '1 = 1',$sort='',$page=0,$totalitem=0){
       $tmpQuery = "SELECT  * FROM ".self::TABLENAME." WHERE ".$mySQLi->real_escape_string($Criteria);
       if ($sort != ''){ $tmpQuery .= " "."ORDER BY ".$sort; }
       if ($page > 0 && $totalitem > 0){
           $start = ($page-1) * $totalitem;
           $tmpQuery .= " LIMIT ".$start.",".$totalitem;
       }
       if ($result = $mySQLi->query($tmpQuery)){
           $Admins = array();
           while ($row = $result->fetch_array()){
               $tmpAdmin = new Admin($mySQLi);
               $tmpAdmin->Id = $row['Id'];
               $tmpAdmin->LockField = $row['LockField'];
               $tmpAdmin->UserName = $row['UserName'];
               $tmpAdmin->IsActive = $row['IsActive'];
               $tmpAdmin->StoredPassword = $row['StoredPassword'];

               $Admins[] = $tmpAdmin;
           }
           return $Admins;
       }
       else
       {
           throw new InvalidQueryException;
       }
   }
   public static function Delete($mySQLi,$Id){
       if ($result = $mySQLi->query("DELETE FROM ".self::TABLENAME." WHERE Id=".$mySQLi->real_escape_string($Id))){
           if ($mySQLi->affected_rows == 0){
               throw new ObjectNotFoundException;
           }
       }
       else
       {
           throw new InvalidQueryException;
       }
   }
}
?>