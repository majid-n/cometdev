<?php 
require_once(dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR."include".DIRECTORY_SEPARATOR."Includes.php");
if( Ajax::isAjax() && CSRF::Validation($_SERVER['HTTP_X_CSRFTOKEN']) ) {

	if( isset($_POST['data']) ) {
		sleep(2);
		$PID = intval( Encryption::Base64De( MySqlDataBase::EscapeSQL($_POST['data']) ) );
		if( is_numeric($PID) && $PID > 0 ) {

			$outputBody   = "";
			$outputFooter = "";
			$Post 		  = Post::FindById($PID);

			if( is_object($Post) && !is_bool($Post) ) {

				$outputBody 	.= "<div class=\"modalEl\" style=\"display:none;\">";
				$outputBody 	.= "	<div class=\"portfolio-modalimg\">";
				$outputBody 	.= "		<img src=\"".htmlspecialchars( IMAGE."portfolio/".$Post->img )."\" class=\"img-responsive\">";
				$outputBody 	.= "	<div class=\"ribbon\"><span>".htmlspecialchars( $Post->type )."</span></div>";
				$outputBody 	.= "	</div>";
				$outputBody 	.= "	<div class=\"text-center cometModalTxt\">";
				$outputBody 	.= "		<h2 class=\"hidden-xs yellow\">".htmlspecialchars( $Post->title )."</h2>";
				$outputBody 	.= "		<h4 class=\"visible-xs yellow\">".htmlspecialchars( $Post->title )."</h4>";
				$outputBody 	.= "		<p>".htmlspecialchars_decode( $Post->des )."</p>";
				$outputBody 	.= "	</div>";
				$outputBody 	.= "</div>";

				$outputFooter 	.= "<div class=\"modal-footer\" style=\"display:none;\">";
				$outputFooter 	.= "	<div>";
				if( intval($Post->isliked()) === 0 ){
					$outputFooter 	.= "	<span id=\"".htmlspecialchars( Encryption::Base64En($Post->id) )."\" class=\"glyphicon glyphicon-heart transitionfast enable\"></span>";
					$outputFooter 	.= "	<img src=\"".htmlspecialchars( IMAGE."svg/3dots.svg" )."\">";
				}else{
					$outputFooter 	.= "	<span class=\"glyphicon glyphicon-heart animated infinite pulse disable\"></span>";
				}
				if( intval($Post->totalLikes()) > 0 ){
					$outputFooter 	.= "	<p>".htmlspecialchars( $Post->TotalLikes() )."</p>";
				}else{
					$outputFooter 	.= "	<p><b class=\"hidden-xs\">لایک کنید!</b><b class=\"visible-xs\">0</b></p>";
				}
				
				$outputFooter 	.= "	</div>";
				$outputFooter 	.= "	<div>";
				$outputFooter 	.= "		<span class=\"glyphicon glyphicon-calendar\"></span>";
				$outputFooter 	.= "		<time datetime=\"".htmlspecialchars( Time::ChangeFormat($Post->time) )."\">".htmlspecialchars( Time::DateFa($Post->time) )."</time>";
				$outputFooter 	.= "	</div>";

				if( Validation::HasValue($Post->link) ){
					$outputFooter 	.= "<div>";
					$outputFooter 	.= "	<span class=\"glyphicon glyphicon-eye-open\"></span>";
					$outputFooter 	.= "	<a href=\"".htmlspecialchars( $Post->link )."\"><span class=\"hidden-xs\">مشاهده پروژه</span><span class=\"visible-xs\">مشاهده</span></a>";
					$outputFooter 	.= "</div>";
				}

				$outputFooter 	.= "<div>";

				echo Ajax::JSON( array('result' , 'modalBody' , 'modalFooter') , array( true , $outputBody , $outputFooter) );
				MySqlDataBase::CloseDB();
				exit;

			}

		}

	}

}
echo Ajax::JSON( array('result') , array(false) );
MySqlDataBase::CloseDB();
exit;
?>

