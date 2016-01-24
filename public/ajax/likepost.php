<?php 
if( Request::Ajax() ) {

	if( isset($_POST['data']) ) {
		sleep(2);
		$Post     = new Post();
		$Post->id = intval( Encryption::Base64De( MySqlDataBase::EscapeSQL($_POST['data']) ) );

		if( is_numeric($Post->id) && $Post->id !== 0 ) {
			if( $Post->Like() ) {
				$totalPostLikes = $Post->TotalLikes();
				$totalLikes 	= Like::TotalRow();
				echo Ajax::JSON( array('result' , 'totalPostLikes', 'totalLikes') , array(true , $totalPostLikes, $totalLikes) );
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