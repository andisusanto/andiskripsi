<?php include_once('BaseObject.php'); ?>
<?php include_once('Exceptions.php'); ?>
<?php include_once('GlobalFunction.php'); ?>
<?php
class Recruitment extends BaseObject{
   const TABLENAME = 'Recruitment';
   public function __construct($mySQLi){
       parent::__construct($mySQLi);
   }
   
   const STATUS_ENTRY = 0;
   const STATUS_POSTED = 1;
   const STATUS_CLOSED = 2;
   
   public static function getStatusOptions()
   {
        return array(
            self::STATUS_ENTRY => 'Entry',
            self::STATUS_POSTED => 'Posted',
            self::STATUS_CLOSED => 'Closed',
        );
   }
   public function getStatusText()
   {
        $statusOptions = Recruitment::getStatusOptions();
        return isset($statusOptions[$this->Status]) ? $statusOptions[$this->Status] : "unknown status {$this->Status}";
   }
    public $Description;
    public $TransDate;
    public $Status;

   public function get_SaveQuery(){
       $mySQLi = $this->get_mySQLi();
       return "INSERT INTO ".self::TABLENAME."(Description,TransDate,Status,LockField) VALUES('".$mySQLi->real_escape_string($this->Description)."','".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->TransDate))."','".$mySQLi->real_escape_string($this->Status)."','".$mySQLi->real_escape_string($this->LockField)."')";}
   public function get_UpdateQuery(){
       $mySQLi = $this->get_mySQLi();
       return "UPDATE ".self::TABLENAME." SET Description = '".$mySQLi->real_escape_string($this->Description)."', TransDate = '".$mySQLi->real_escape_string(GlobalFunction::getDateQuery($this->TransDate))."', Status = '".$mySQLi->real_escape_string($this->Status)."', LockField = '".$mySQLi->real_escape_string($this->LockField)."' WHERE Id = '".$mySQLi->real_escape_string($this->Id)."'";}
   protected function get_TableName(){
       return self::TABLENAME;
   }
   public function get_ApplicantRecruitment($page=0,$totalitem=0){
       return ApplicantRecruitment::LoadCollection($this->get_mySQLi(),"Recruitment = ".$this->Id,'Id DESC',$page,$totalitem);
   }
   public function get_RecruitmentCriteria($page=0,$totalitem=0){
       return RecruitmentCriteria::LoadCollection($this->get_mySQLi(),"Recruitment = ".$this->Id,'Id DESC',$page,$totalitem);
   }

   public static function GetObjectByKey($mySQLi, $Id){
       if($result = $mySQLi->query("SELECT * FROM ".self::TABLENAME." WHERE Id = ".$mySQLi->real_escape_string($Id)." LIMIT 1")){
           if($row = $result->fetch_array()){
               $tmpRecruitment = new Recruitment($mySQLi);
               $tmpRecruitment->Id = $row['Id'];
               $tmpRecruitment->Description = $row['Description'];
               $tmpRecruitment->TransDate = strtotime($row['TransDate']);
               $tmpRecruitment->Status = $row['Status'];

               $tmpRecruitment->LockField = $row['LockField'];
               return $tmpRecruitment;
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
           $Recruitments = array();
           while ($row = $result->fetch_array()){
               $tmpRecruitment = new Recruitment($mySQLi);
               $tmpRecruitment->Id = $row['Id'];
               $tmpRecruitment->LockField = $row['LockField'];
               $tmpRecruitment->Description = $row['Description'];
               $tmpRecruitment->TransDate = strtotime($row['TransDate']);
               $tmpRecruitment->Status = $row['Status'];

               $Recruitments[] = $tmpRecruitment;
           }
           return $Recruitments;
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