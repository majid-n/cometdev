<?php 
require_once(dirname(dirname(__DIR__)).DIRECTORY_SEPARATOR."include".DIRECTORY_SEPARATOR."Includes.php");
if( Ajax::isAjax() && CSRF::Validation($_SERVER['HTTP_X_CSRFTOKEN']) ) {
	
	if( isset($_POST['page'])) {
		sleep(2);
		$page = intval(MySqlDataBase::EscapeSQL($_POST['page']));

		if( is_numeric($page) && $page > 0 ) {
			
			$Posts = Post::Pagination(POSTS_LIMIT,$page);

			if( is_array($Posts) && !is_bool($Posts) ) {

				$output = "";

				foreach($Posts as $Post) {

					$output .= "<div class=\"col-xs-12 col-sm-6 col-md-4 col-lg-4 portfolio-item\">";
					$output .= "	<div class=\"shadow\">";
					$output .= "		<a class=\"portfolio-link\" id=\"". Encryption::Base64En($Post->id)."\">";
					$output .= "			<div class=\"postimg\">";
					$output .= "				<img src=\"".htmlspecialchars( PUBLICFOLDER."img/portfolio/".$Post->thumb )."\" class=\"img-responsive transition\" alt=\"".htmlspecialchars( $Post->title )."\">";
					$output .= "			</div>";
					$output .= "    	</a>";
					$output .= "    	<div class=\"ribbon\"><span>".htmlspecialchars( $Post->type )."</span></div>";
					$output .= "    	<div class=\"portfolio-caption\">";
					$output .= "        	<div class=\"portfolio-ajaxloader\">";
					$output .= "            	<img src=\"".htmlspecialchars( PUBLICFOLDER.'img/svg/3dots.svg' )."\" width=\"45\">";
					$output .= "        	</div>";
					$output .= "        	<div class=\"portfolio-like\">";
					$output .= "            	<h4>".htmlspecialchars( $Post->title )."</h4>";
					if( intval($Post->isliked()) === 0  ) {
						$output .= "			<span id=\"".htmlspecialchars( Encryption::Base64En($Post->id) )."\" class=\"glyphicon glyphicon-heart enable transitionfast\"></span>";
					} else {
						$output .= "        	<span class=\"glyphicon glyphicon-heart disable\"></span>";
					}
					if( intval($Post->totalLikes()) > 0 ) {
						$output .= "        	<p class=\"likecount\">".htmlspecialchars( $Post->totalLikes() )."</p>";
					} else {
						$output .= "			<p class=\"likecount\"></p>";
					}
					$output .= "			</div>";
					$output .= "		</div>";
					$output .= "	</div>";
					$output .= "</div>";

				}
				echo Ajax::JSON( array('result' , 'html') , array( true , $output) );
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