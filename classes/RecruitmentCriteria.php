<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php include_once('RecruitmentSubcriteria.php'); ?>
<?php include_once('GlobalFunction.php'); ?>
<?php
class RecruitmentCriteria extends BaseObject{
   const TABLENAME = 'RecruitmentCriteria';
   public function __construct($mySQLi){
       parent::__construct($mySQLi);
   }
    public $IndifferenceThreshold;
    public $Name;
    public $PreferenceThreshold;
    public $Weight;
    public $Recruitment;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(IndifferenceThreshold,Name,PreferenceThreshold,Weight,Recruitment,LockField) VALUES('".$mySQLi->real_escape_string($this->IndifferenceThreshold)."','".$mySQLi->real_escape_string($this->Name)."','".$mySQLi->real_escape_string($this->PreferenceThreshold)."','".$mySQLi->real_escape_string($this->Weight)."','".$mySQLi->real_escape_string($this->Recruitment)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET IndifferenceThreshold = '".$mySQLi->real_escape_string($this->IndifferenceThreshold)."', Name = '".$mySQLi->real_escape_string($this->Name)."', PreferenceThreshold = '".$mySQLi->real_escape_string($this->PreferenceThreshold)."', Weight = '".$mySQLi->real_escape_string($this->Weight)."', Recruitment = '".$mySQLi->real_escape_string($this->Recruitment)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_ApplicantRecruitmentCriteria($page=0,$totalitem=0){
       return ApplicantRecruitmentCriteria::LoadCollection($this->get_mySQLi(),"RecruitmentCriteria = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_RecruitmentSubcriteria($page=0,$totalitem=0){
       return RecruitmentSubcriteria::LoadCollection($this->get_mySQLi(),"RecruitmentCriteria = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_RecruitmentMinimalValueSubcriteria()
   {
       $RecruitmentCriterias =  RecruitmentSubcriteria::LoadCollection($this->get_mySQLi(),"RecruitmentCriteria = ".$this->Id,'Value ASC',0,1);
       if (count($RecruitmentCriterias) == 0) throw new Exception("No subcriteria found");
       return $RecruitmentCriterias[0];
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpRecruitmentCriteria = new RecruitmentCriteria($mySQLi);
               $tmpRecruitmentCriteria->Id = $row['Id'];
               $tmpRecruitmentCriteria->IndifferenceThreshold = $row['IndifferenceThreshold'];
               $tmpRecruitmentCriteria->Name = $row['Name'];
               $tmpRecruitmentCriteria->PreferenceThreshold = $row['PreferenceThreshold'];
               $tmpRecruitmentCriteria->Weight = $row['Weight'];
               $tmpRecruitmentCriteria->Recruitment = $row['Recruitment'];

               $tmpRecruitmentCriteria->LockField = $row['LockField'];
               return $tmpRecruitmentCriteria;
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
           $RecruitmentCriterias = array();
           while ($row = $result->fetch_array()){
               $tmpRecruitmentCriteria = new RecruitmentCriteria($mySQLi);
               $tmpRecruitmentCriteria->Id = $row['Id'];
               $tmpRecruitmentCriteria->LockField = $row['LockField'];
               $tmpRecruitmentCriteria->IndifferenceThreshold = $row['IndifferenceThreshold'];
               $tmpRecruitmentCriteria->Name = $row['Name'];
               $tmpRecruitmentCriteria->PreferenceThreshold = $row['PreferenceThreshold'];
               $tmpRecruitmentCriteria->Weight = $row['Weight'];
               $tmpRecruitmentCriteria->Recruitment = $row['Recruitment'];

               $RecruitmentCriterias[] = $tmpRecruitmentCriteria;
           }
           return $RecruitmentCriterias;
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