<?php
class Helper
{
    const BOOL_TRUE_TEXT = 'Yes';
    const BOOL_FALSE_TEXT = 'No';
    public static function getBooleanTextValue($boolValue){
        if($boolValue){
            return self::BOOL_TRUE_TEXT;
        }else{
            return self::BOOL_FALSE_TEXT;
        }
    }
    public static function getEncryptedValue($password){
        return md5($password);
    }
}
