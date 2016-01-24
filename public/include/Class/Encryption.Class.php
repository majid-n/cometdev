<?php
class Encryption {
	
	public static function Base64En($String){
	  	return rtrim(strtr(base64_encode(base64_encode($String)) , '+/' , '-_') , '=');
	}
	
	public static function Base64De($String){
		return base64_decode(base64_decode(str_pad(strtr($String , '-_' , '+/') , strlen($String) % 4 , '=' , STR_PAD_RIGHT)));
	}
	
	public static function Encrypt($String , $Key = ENCRYPT_KEY , $IVKEY = IV_KEY){
		return self::Base64En(mcrypt_encrypt (CIPHER , $Key , $String , MODE , $IVKEY)."ALiShF89".self::Base64En($IVKEY));
	}
	
	public static function Decrypt($EncryptedString , $Key = ENCRYPT_KEY){
		$escapeBase64 = self::Base64De($EncryptedString);
		$escapeBase64 = explode("ALiShF89" , $escapeBase64);
		$IVKEY 		  = self::Base64De($escapeBase64[1]);
		return rtrim(mcrypt_decrypt (CIPHER , $Key , $escapeBase64[0] , MODE , $IVKEY));
	}
}
?>