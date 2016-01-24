<?php 
require_once(dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR."include".DIRECTORY_SEPARATOR."Includes.php");
if( Ajax::isAjax() && CSRF::Validation($_SERVER['HTTP_X_CSRFTOKEN']) ) {

	if( isset($_POST['data']) ) {

		parse_str( $_POST['data'] , $data );

		$errCount 	= 0;
		$name 		= MySqlDataBase::EscapeSQL($data['name']);
		$mail 		= MySqlDataBase::EscapeSQL($data['mail']);
		$tel  		= MySqlDataBase::EscapeSQL($data['tel']);
		$des  		= MySqlDataBase::EscapeSQL($data['des']);
		$time 		= Time::Now();
		$ip   	   	= Network::FindIp();
		$location   = Network::UserLocation($ip);
		$sessionId 	= session_id();
		$errArray 	= array( 
			'name' => false,
			'mail' => false,
			'tel'  => false,
			'des'  => false
		);
		$errDes 	= array( 
			'name' => NULL,
			'mail' => NULL,
			'tel'  => NULL,
			'des'  => NULL
		);


		if( !Validation::String( $name,'PersianLettersSpace' , 5 , "") ){
			$errCount++;
			$errArray['name'] = true;
			$errDes['name']   = "لطفا نام خود را به صورت صحیح وارد کنید. حداقل 5 کاراکتر.";
		}

		if( !Validation::Email($mail) ){
			$errCount++;
			$errArray['mail'] = true;
			$errDes['mail']   = "پست الکترونیکی شما مورد قبول نمی باشد، لطفا پست الکترونیکی خود را صحیح وارد کنید.";
		}

		if( !Validation::String( $tel,'Numeric' , 8 , 20) ){
			$errCount++;
			$errArray['tel'] = true;
			$errDes['tel']   = "لطفا شماره تماس خود را به صورت صحیح وارد کنید. حداقل 8 کاراکتر.";
		}

		if( !Validation::String( $des,'Any' , 10 , "") ){
			$errCount++;
			$errArray['des'] = true;
			$errDes['des']   = "توضیحات باید حداقل شامل 10 کاراتر باشد.";
		}

		if( $errCount === 0 ){

			$Found = MySqlDataBase::Select("*",Support::$tableName,"WHERE CURRENT_TIMESTAMP() <= TIMESTAMP(submitat + INTERVAL 30 MINUTE) AND (ip = '{$ip}' OR session_id = '{$sessionId}')");

			if( !is_array($Found) && is_bool($Found) && $Found === false ) {

				$isinserted = MySqlDataBase::Insert(Support::$tableName , "fullname,tel,des,email,ip,location,session_id,submitat" , "'{$name}','{$tel}','{$des}','{$mail}','{$ip}','{$location}','{$sessionId}','{$time}'");

				if( $isinserted ) {

					Email::SendHtml($data['name'] , $data['mail'] ,WEBSITE_NAME , "پیام شما با موفقیت ارسال شد، تیم کامت به زودی پیام شما را مورد بررسی قرار داده و در اولین فرصت با شما تماس خواهند گرفت." , '' , '' , 'بازدید از صفحه اصلی سایت' , PUBLICFOLDER , '' ,EMAIL_SUPPORT);
					echo Ajax::JSON( array('result','hasError','errors') , array(true,false,$errArray) );
					MySqlDataBase::CloseDB();
					exit;
				}
			}else{
				echo Ajax::JSON( array('result','hasError','errors') , array('wait',false,$errArray) );
				MySqlDataBase::CloseDB();
				exit;
			}

			
		} else {
			echo Ajax::JSON( array('result','hasError','errors','errorsDes') , array(false,true,$errArray,$errDes) );
			MySqlDataBase::CloseDB();
			exit;
		}
	}
}
echo Ajax::JSON( array('result','errors') , array('fail',$errArray) );
MySqlDataBase::CloseDB();
exit;
?>