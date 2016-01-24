<?php  
class Email extends PHPMailer{
	
	public static function SendHtml($fullName , $email , $subject , $p1 , $p2 , $Code , $button , $buttonLink , $note , $fromEmail = EMAIL_INFO){

		$mail = new parent;
		$mail->isSMTP();                                         # Set mailer to use SMTP
		$mail->SMTPAuth 	= true;                              # Enable SMTP authentication
		$mail->Host 		= SMTP_HOST;  					  	 # Specify main and backup SMTP servers
		$mail->Port 		= SMTP_PORT;                         # TCP port to connect to
		$mail->Username 	= $fromEmail;                 	 	 # SMTP username
		$mail->Password 	= SMTP_PASSWORD;                     # SMTP password
		$mail->From 		= $fromEmail;						 # Email From
		$mail->FromName 	= EMAIL_FROMNAME;					 # Name From
		$mail->SMTPDebug    = false;
		
		$mail->addAddress($email,$fullName);
		$mail->addReplyTo(EMAIL_INFO, EMAIL_FROMNAME);
		$mail->addCC($email);
		$mail->addBCC($email);
		$mail->isHTML(true);
		$mail->Subject = $subject;

		$body ="<html><body>";
		$body.="<div style=\"background:#ddd; padding:20px;\">";
		$body.="	<div style=\"border-radius:4px;overflow:hidden;background:#fff;\">";
		$body.="		<div style=\"border-bottom: 1px solid #ddd;text-align:center; padding:20px;background-color:#fff;\">";
		$body.="			<img style=\"display: block;margin:7px auto;\" src=\"".IMAGE."logo/comet_fa_black.png"."\" height=\"30\">";
		$body.="		</div>";
		$body.="		<div>";
		$body.="			<p style=\"margin:25px 7px 7px 7px;direction:rtl;font-family:tahoma;font-size: 0.9em;\"><b style=\"color:#fec503;\">".htmlspecialchars($fullName)."</b> عزیز،</p>";

		# Paragraph 1
		if( Validation::HasValue($p1) )
		$body.="			<p style=\"font-size: 0.9em;margin-left:7px; margin-right:7px;direction:rtl;font-family:tahoma;\">".htmlspecialchars($p1)."</p>";

		# Paragraph 2
		if( Validation::HasValue($p2) )
		$body.="			<p style=\"font-size: 0.9em; margin-left:7px; margin-right:7px;direction:rtl;font-family:tahoma;\">".htmlspecialchars($p2)."</p>";

		# Note And Warnings
		if( Validation::HasValue($note) )
			$body.="		<p style=\"margin-left:7px; margin-right:7px; padding:2px;direction:rtl;font-family:tahoma;font-size: 0.9em;\">".htmlspecialchars($note)."</p>";

		$body.="			<p style=\"font-size: 0.9em;margin:0px 7px 0px 7px; padding:2px;direction:rtl;font-family:tahoma;\">این ایمیل توسط دستگاه ارسال شده است، لطفا از ارسال ایمیل به این آدرس خودداری کنید.</p>";

		# Code
		if( Validation::HasValue($Code) ) {	

			$body.="		<br/>";			
			$body.="		<h1 style=\"text-align:center;direction:rtl;font-family:tahoma;\">".htmlspecialchars($Code)."</h1>";
			$body.="		<br/>";
		}

		# Buttons
		if( Validation::HasValue($button) && Validation::HasValue($buttonLink) ){
			$body.="		<div style=\"text-align:center;margin-top:35px;margin-bottom:35px;\"><a style=\"text-align:center; font-size: 1em; border-radius:4px; background:#fec503; text-decoration: none; color:#fff; padding:10px; margin-left:10px; margin-right:10px;direction:rtl;font-family:tahoma;font-size: 0.9em;\" href=\"".htmlspecialchars($buttonLink)."\">".htmlspecialchars($button)."</a></div>";
		}else{
			$body.="		<br/>";
		}
		

		$body.="		</div>";
		$body.="		<div style=\"border-top: 1px solid #ddd;text-align:center; padding:15px;\">";		
		$body.="			<p style=\"direction:rtl;font-family:tahoma;font-size: 0.9em;\">تمامی حقوق مطالب، تصاوير و طرح قالب برای کامت محفوظ است.</p>";
		$body.="		</div>";
		$body.="	</div>";
		$body.="</div>";
		$body.="</body></html>";

		$mail->Body = $body;

		return ($mail->send()) ? true : false;
	}
}
?>