<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php include_once('GlobalFunction.php'); ?>
<?php
class RecruitmentSubcriteria extends BaseObject{
   const TABLENAME = 'RecruitmentSubcriteria';
   public function __construct($mySQLi){
       parent::__contruct($mySQLi);
   }
    public $Description;
    public $RecruitmentCriteria;
    public $Value;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Description,RecruitmentCriteria,Value,LockField) VALUES('".$mySQLi->real_escape_string($this->Description)."','".$mySQLi->real_escape_string($this->RecruitmentCriteria)."','".$mySQLi->real_escape_string($this->Value)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Description = '".$mySQLi->real_escape_string($this->Description)."', RecruitmentCriteria = '".$mySQLi->real_escape_string($this->RecruitmentCriteria)."', Value = '".$mySQLi->real_escape_string($this->Value)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_RecruitmentCriteria($page=0,$totalitem=0){
       return RecruitmentCriteria::LoadCollection($this->get_mySQLi(),"RecruitmentSubcriteria = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_ApplicantRecruitmentCriteria($page=0,$totalitem=0){
       return ApplicantRecruitmentCriteria::LoadCollection($this->get_mySQLi(),"RecruitmentSubcriteria = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpRecruitmentSubcriteria = new RecruitmentSubcriteria($mySQLi);
               $tmpRecruitmentSubcriteria->Id = $row['Id'];
               $tmpRecruitmentSubcriteria->Description = $row['Description'];
               $tmpRecruitmentSubcriteria->RecruitmentCriteria = $row['RecruitmentCriteria'];
               $tmpRecruitmentSubcriteria->Value = $row['Value'];

               $tmpRecruitmentSubcriteria->LockField = $row['LockField'];
               return $tmpRecruitmentSubcriteria;
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
           $RecruitmentSubcriterias = array();
           while ($row = $result->fetch_array()){
               $tmpRecruitmentSubcriteria = new RecruitmentSubcriteria($mySQLi);
               $tmpRecruitmentSubcriteria->Id = $row['Id'];
               $tmpRecruitmentSubcriteria->LockField = $row['LockField'];
               $tmpRecruitmentSubcriteria->Description = $row['Description'];
               $tmpRecruitmentSubcriteria->RecruitmentCriteria = $row['RecruitmentCriteria'];
               $tmpRecruitmentSubcriteria->Value = $row['Value'];

               $RecruitmentSubcriterias[] = $tmpRecruitmentSubcriteria;
           }
           return $RecruitmentSubcriterias;
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