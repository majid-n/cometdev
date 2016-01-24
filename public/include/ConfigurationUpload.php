<?php
# TimeZone Configuration
date_default_timezone_set("Asia/Tehran");

# DataBase Configuration
defined("DB_SERVER") ? NULL : define("DB_SERVER" , "localhost");
defined("DB_NAME")   ? NULL : define("DB_NAME"	 , "cometdev_comet");
defined("DB_USER")   ? NULL : define("DB_USER"	 , "cometdev_machine");
defined("DB_PASS")   ? NULL : define("DB_PASS"	 , "Com3t1010");

# WebSite Information
defined("WEBSITE_NAME") 		? NULL : define("WEBSITE_NAME" 			, "کامت");
defined("WEBSITE_ADDRESS") 		? NULL : define("WEBSITE_ADDRESS" 		, "CometDev.ir");
defined("META_LOGO_LINK") 		? NULL : define("META_LOGO_LINK" 		, "http://cometdev.ir/img/logo/banner_large.jpg");
defined("META_LOGO_LINK_SMALL") ? NULL : define("META_LOGO_LINK_SMALL" 	, "http://cometdev.ir/img/logo/banner_small.jpg");
defined("META_TWITTER_ADMIN") 	? NULL : define("META_TWITTER_ADMIN" 	, "CometDevIr");
defined("META_FACEBOOK_ADMIN") 	? NULL : define("META_FACEBOOK_ADMIN" 	, "cometdevir");

# Path Configuration
defined("DS")           ? NULL : define("DS"			, DIRECTORY_SEPARATOR);
defined("AJAX")     	? NULL : define("AJAX"			, "http://cometdev.ir/ajax/");
defined("IMAGE")     	? NULL : define("IMAGE"			, "http://cometdev.ir/img/");
defined("PUBLICFOLDER") ? NULL : define("PUBLICFOLDER"	, "http://cometdev.ir/");

# Encryption Configuration
defined("CIPHER")      ? NULL : define("CIPHER"			, MCRYPT_RIJNDAEL_256);
defined("MODE")		   ? NULL : define("MODE"			, MCRYPT_MODE_CBC);
defined("ENCRYPT_KEY") ? NULL : define("ENCRYPT_KEY"	, pack('H*', "05c04b7e103a0cd8baabaa051a0b08bc55abe029fdf10a5e1d417e2ffb2a00a3")); # Must Be 32 Char
defined("IV_SIZE")	   ? NULL : define("IV_SIZE"		, mcrypt_get_iv_size(CIPHER , MODE));
defined("IV_KEY")	   ? NULL : define("IV_KEY"			, mcrypt_create_iv( IV_SIZE , MCRYPT_RAND));

# Email Configuration
defined("SMTP_HOST")	  ? NULL : define("SMTP_HOST"		, "mail.cometdev.ir");
defined("SMTP_PORT")	  ? NULL : define("SMTP_PORT"		, 25);
defined("SMTP_PASSWORD")  ? NULL : define("SMTP_PASSWORD"	, "Com3t1010");
defined("EMAIL_FROMNAME") ? NULL : define("EMAIL_FROMNAME"	, WEBSITE_NAME);
defined("EMAIL_SUPPORT")  ? NULL : define("EMAIL_SUPPORT"	, "support@cometdev.ir");
defined("EMAIL_INFO")     ? NULL : define("EMAIL_INFO"		, "info@cometdev.ir");

# Cookie Configuration
defined("DOMAIN_NAME") ? NULL : define("DOMAIN_NAME" , "cometdev.ir");
defined("PATH")        ? NULL : define("PATH"        , "/");  

# Posts Pagination Limit
defined("POSTS_LIMIT") ? NULL : define("POSTS_LIMIT" , 8);

# Social Network Links
defined("TWITTER") 	? NULL : define("TWITTER" 	, "https://twitter.com/CometDevIr");
defined("FACEBOOK") ? NULL : define("FACEBOOK" 	, "https://www.facebook.com/cometdevir");
?>