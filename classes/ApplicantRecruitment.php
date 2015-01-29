<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php include_once('GlobalFunction.php'); ?>
<?php
class ApplicantRecruitment extends BaseObject{
   const TABLENAME = 'ApplicantRecruitment';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Applicant;
    public $Recruitment;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Applicant,Recruitment,LockField) VALUES('".$mySQLi->real_escape_string($this->Applicant)."','".$mySQLi->real_escape_string($this->Recruitment)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Applicant = '".$mySQLi->real_escape_string($this->Applicant)."', Recruitment = '".$mySQLi->real_escape_string($this->Recruitment)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_ApplicantRecruitmentCriteria($page=0,$totalitem=0){
       return ApplicantRecruitmentCriteria::LoadCollection($this->get_mySQLi(),"ApplicantRecruitment = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpApplicantRecruitment = new ApplicantRecruitment($mySQLi);
               $tmpApplicantRecruitment->Id = $row['Id'];
               $tmpApplicantRecruitment->Applicant = $row['Applicant'];
               $tmpApplicantRecruitment->Recruitment = $row['Recruitment'];

               $tmpApplicantRecruitment->LockField = $row['LockField'];
               return $tmpApplicantRecruitment;
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
           $ApplicantRecruitments = array();
           while ($row = $result->fetch_array()){
               $tmpApplicantRecruitment = new ApplicantRecruitment($mySQLi);
               $tmpApplicantRecruitment->Id = $row['Id'];
               $tmpApplicantRecruitment->LockField = $row['LockField'];
               $tmpApplicantRecruitment->Applicant = $row['Applicant'];
               $tmpApplicantRecruitment->Recruitment = $row['Recruitment'];

               $ApplicantRecruitments[] = $tmpApplicantRecruitment;
           }
           return $ApplicantRecruitments;
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