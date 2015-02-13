<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php include_once('GlobalFunction.php'); ?>
<?php
class ApplicantRecruitmentCriteria extends BaseObject{
   const TABLENAME = 'ApplicantRecruitmentCriteria';
   public function __construct($mySQLi){
       parent::__construct($mySQLi);
   }
    public $RecruitmentCriteria;
    public $RecruitmentSubcriteria;
    public $ApplicantRecruitment;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(RecruitmentCriteria,RecruitmentSubcriteria,ApplicantRecruitment,LockField) VALUES('".$mySQLi->real_escape_string($this->RecruitmentCriteria)."','".$mySQLi->real_escape_string($this->RecruitmentSubcriteria)."','".$mySQLi->real_escape_string($this->ApplicantRecruitment)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET RecruitmentCriteria = '".$mySQLi->real_escape_string($this->RecruitmentCriteria)."', RecruitmentSubcriteria = '".$mySQLi->real_escape_string($this->RecruitmentSubcriteria)."', ApplicantRecruitment = '".$mySQLi->real_escape_string($this->ApplicantRecruitment)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpApplicantRecruitmentCriteria = new ApplicantRecruitmentCriteria($mySQLi);
               $tmpApplicantRecruitmentCriteria->Id = $row['Id'];
               $tmpApplicantRecruitmentCriteria->RecruitmentCriteria = $row['RecruitmentCriteria'];
               $tmpApplicantRecruitmentCriteria->RecruitmentSubcriteria = $row['RecruitmentSubcriteria'];
               $tmpApplicantRecruitmentCriteria->ApplicantRecruitment = $row['ApplicantRecruitment'];

               $tmpApplicantRecruitmentCriteria->LockField = $row['LockField'];
               return $tmpApplicantRecruitmentCriteria;
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
   public static function GetObjectByCriteria($mySQLi, $Criteria)
   {
        $tmpQuery = "SELECT  * FROM ".self::TABLENAME." WHERE ".$Criteria." LIMIT 1";
       if($result = $mySQLi->query($tmpQuery)){
           if($row = $result->fetch_array()){
               $tmpApplicantRecruitmentCriteria = new ApplicantRecruitmentCriteria($mySQLi);
               $tmpApplicantRecruitmentCriteria->Id = $row['Id'];
               $tmpApplicantRecruitmentCriteria->RecruitmentCriteria = $row['RecruitmentCriteria'];
               $tmpApplicantRecruitmentCriteria->RecruitmentSubcriteria = $row['RecruitmentSubcriteria'];
               $tmpApplicantRecruitmentCriteria->ApplicantRecruitment = $row['ApplicantRecruitment'];

               $tmpApplicantRecruitmentCriteria->LockField = $row['LockField'];
               return $tmpApplicantRecruitmentCriteria;
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
           $ApplicantRecruitmentCriterias = array();
           while ($row = $result->fetch_array()){
               $tmpApplicantRecruitmentCriteria = new ApplicantRecruitmentCriteria($mySQLi);
               $tmpApplicantRecruitmentCriteria->Id = $row['Id'];
               $tmpApplicantRecruitmentCriteria->LockField = $row['LockField'];
               $tmpApplicantRecruitmentCriteria->RecruitmentCriteria = $row['RecruitmentCriteria'];
               $tmpApplicantRecruitmentCriteria->RecruitmentSubcriteria = $row['RecruitmentSubcriteria'];
               $tmpApplicantRecruitmentCriteria->ApplicantRecruitment = $row['ApplicantRecruitment'];

               $ApplicantRecruitmentCriterias[] = $tmpApplicantRecruitmentCriteria;
           }
           return $ApplicantRecruitmentCriterias;
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