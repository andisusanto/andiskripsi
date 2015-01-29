<?php
class ObjectNotFoundException extends Exception{
	public function __construct(){
		$this->message = 'The object you tried to modify was not exist';
	}
}
class InvalidQueryException extends Exception{
	public function __construct(){
		$this->message = 'Error while executing query';
	}
}
class ObjectModifiedException extends Exception{
	public function __construct(){
		$this->message = 'The object you tried to save was changed by other user, please reload it';
	}
}
class FileUploadException extends Exception{
    public function __construct(){
		$this->message = 'An error occur while uploading your file';
	}
}
class FileExtensionMismatch extends Exception{
    public function __construct(){
		$this->message = 'The uploaded file\'s extension does not match allowed extension';
	}
}
class MailException extends Exception{
    public function __construct(){
		$this->message = 'An error occur while sending your email';
	}
}
class AuthenticationFailedException extends Exception{
    public function __construct(){
		$this->message = 'Authentication required in order to process this action';
	}
}
class PasswordMismatchException extends Exception{
    public function __construct(){
		$this->message = 'password does not match';
	}
}
class ValueNotFoundException extends Exception{
    public function __construct(){
		$this->message = 'Failed to find expected value';
	}
}

?>