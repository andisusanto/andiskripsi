<?php include_once('UserBase.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php
class Applicant extends UserBase{
   const TABLENAME = 'Applicant';
   public function __construct($mySQLi){
       parent::__construct($mySQLi);
   }
    public $Address;
    public $IsActive;
    public $DateOfBirth;
    public $Name;
    public $PlaceOfBirth;
    public $PhoneNumber;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Address,IsActive,DateOfBirth,Name,PlaceOfBirth,UserName,StoredPassword,PhoneNumber,LockField) VALUES('".$mySQLi->real_escape_string($this->Address)."','".$mySQLi->real_escape_string($this->IsActive)."','".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->DateOfBirth))."','".$mySQLi->real_escape_string($this->Name)."','".$mySQLi->real_escape_string($this->PlaceOfBirth)."','".$mySQLi->real_escape_string($this->UserName)."','".$mySQLi->real_escape_string($this->StoredPassword)."','".$mySQLi->real_escape_string($this->PhoneNumber)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Address = '".$mySQLi->real_escape_string($this->Address)."', IsActive = '".$mySQLi->real_escape_string($this->IsActive)."', DateOfBirth = '".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->DateOfBirth))."', Name = '".$mySQLi->real_escape_string($this->Name)."', PlaceOfBirth = '".$mySQLi->real_escape_string($this->PlaceOfBirth)."', UserName = '".$mySQLi->real_escape_string($this->UserName)."', StoredPassword = '".$mySQLi->real_escape_string($this->StoredPassword)."', PhoneNumber = '".$mySQLi->real_escape_string($this->PhoneNumber)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_ApplicantRecruitment($page=0,$totalitem=0){
       return ApplicantRecruitment::LoadCollection($this->get_mySQLi(),"Applicant = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpApplicant = new Applicant($mySQLi);
               $tmpApplicant->Id = $row['Id'];
               $tmpApplicant->Address = $row['Address'];
               $tmpApplicant->IsActive = $row['IsActive'];
               $tmpApplicant->DateOfBirth = strtotime($row['DateOfBirth']);
               $tmpApplicant->Name = $row['Name'];
               $tmpApplicant->PlaceOfBirth = $row['PlaceOfBirth'];
               $tmpApplicant->UserName = $row['UserName'];
               $tmpApplicant->StoredPassword = $row['StoredPassword'];
               $tmpApplicant->PhoneNumber = $row['PhoneNumber'];

               $tmpApplicant->LockField = $row['LockField'];
               return $tmpApplicant;
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
           $Applicants = array();
           while ($row = $result->fetch_array()){
               $tmpApplicant = new Applicant($mySQLi);
               $tmpApplicant->Id = $row['Id'];
               $tmpApplicant->LockField = $row['LockField'];
               $tmpApplicant->Address = $row['Address'];
               $tmpApplicant->IsActive = $row['IsActive'];
               $tmpApplicant->DateOfBirth = strtotime($row['DateOfBirth']);
               $tmpApplicant->Name = $row['Name'];
               $tmpApplicant->PlaceOfBirth = $row['PlaceOfBirth'];
               $tmpApplicant->UserName = $row['UserName'];
               $tmpApplicant->StoredPassword = $row['StoredPassword'];
               $tmpApplicant->PhoneNumber = $row['PhoneNumber'];

               $Applicants[] = $tmpApplicant;
           }
           return $Applicants;
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