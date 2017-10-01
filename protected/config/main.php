<?php
return array (
		'name' => 'muirs',
		'defaultController' => 'site',
		'import' => array (
				'application.models.*',
				'application.components.*' 
		),
		'components' => array (
				'urlManager' => array (
						'urlFormat' => 'path',
						'showScriptName'=>true
				),
				'db' => array (
						'class' => 'CDbConnection',
						'connectionString' => 'mysql:host=localhost;dbname=muirs',
// 						'connectionString' => 'mysql:host=mdc.mahidol;dbname=radbasewww',
						'emulatePrepare' => true,
						'username' => 'root',
						'password' => 'P@ssw0rd',

// 						'username' => 'radbasewww',
// 						'password' => 'RadBase#2016#',
						'charset' => 'utf8' 
				),
				'Smtpmail' => array (
						'class' => 'application.extensions.smtpmail.PHPMailer',
// 						'Host' => "smtp.gmail.com",
						'Host' => "cpanel01wh.bkk1.cloud.z.com",
						'Username' => 'pawit1357@17100532-20161115132017.webstarterz.com',
						'Password' => 'P@ssw0rd',
						'Mailer' => 'smtp',
						'Port' => 465,
						'SMTPAuth' => true,
						'SMTPSecure' => 'ssl',
						'SMTPDebug' => 1 
				) 
		)
		 
);
?>