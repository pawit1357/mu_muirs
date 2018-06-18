<?php

/**
 * SiteController is the default controller to handle user requests.
 */
class SiteController extends CController
{

    public $layout = '_login';

    private $_model;

    public function actionIndex()
    {
        // Authen Login
        // if (! UserLoginUtils::isLogin ()) {
        // $this->redirect ( Yii::app ()->createUrl ( 'Site/login' ) );
        // }
        // Render
        // $this->redirect ( Yii::app ()->createUrl ( 'DashBoard/' ) );
        $this->render('//site/stat');
    }

    /**
     * Login Page
     */
    public function actionLogin()
    {
        // if login redirect to index
        // if (UserLoginUtils::isLogin ()) {
        // $this->redirect ( Yii::app ()->createUrl ( '' ) );
        // }
        if (isset($_POST['UsersLogin']['username']) && isset($_POST['UsersLogin']['password'])) {
            
            $username = addslashes($_POST['UsersLogin']['username']);
            $password = addslashes($_POST['UsersLogin']['password']);
            
            // Authen
            if (UserLoginUtils::authen($username, $password)) {
                if (UserLoginUtils::isForceChangePassword()) {
                    $this->redirect(Yii::app()->createUrl('Site/ChangePassword/'));
                } else {
                    $this->redirect(Yii::app()->createUrl('DashBoard/'));
                }
            } else {
                $this->redirect(Yii::app()->createUrl('Site/Login'));
            }
        }
        $this->render('//site/login');
    }

    public function actionReg()
    {
        // if login redirect to index
        // if (UserLoginUtils::isLogin ()) {
        // $this->redirect ( Yii::app ()->createUrl ( '' ) );
        // }
        if (isset($_POST['UsersLogin'])) {
            $transaction = Yii::app()->db->beginTransaction();
            $rowpassword = '';
            // Add Request
            $model = new UsersLogin();
            $model->attributes = $_POST['UsersLogin'];
            $model->password = md5($model->password);
            $model->role_id = 5;
            $model->email = $model->username;
            $model->is_force_change_password = 0;
            $model->create_by = UserLoginUtils::getUsersLoginId();
            $model->create_date = date("Y-m-d H:i:s");
            $model->update_by = UserLoginUtils::getUsersLoginId();
            $model->update_date = date("Y-m-d H:i:s");
            $model->save();
            
            $mailBody = "Hello " . $model->first_name . '  ' . $model->last_name . ",<br>
You have a new account at http://myapps1357.com/muirs <br>
Account details: <br><br>
Username <br>
" . $model->email . " 
<br>
<br>
Password <br>
" . $rowpassword;
            $strSubject = "=?UTF-8?B?" . base64_encode(ConfigUtil::getEmailSubject()) . "?=";
            MailUtil::sendMail($model->username, $strSubject, $mailBody);
            
            // echo "SAVE";
            $transaction->commit();
            
            // $username = addslashes ( $_POST ['UsersLogin'] ['username'] );
            // $password = addslashes ( $_POST ['UsersLogin'] ['password'] );
            
            // Authen
            // if (UserLoginUtils::authen ( $username, $password )) {
            // if (UserLoginUtils::isForceChangePassword ()) {
            // $this->redirect ( Yii::app ()->createUrl ( 'Site/ChangePassword/' ) );
            // } else {
            // $this->redirect ( Yii::app ()->createUrl ( 'DashBoard/' ) );
            // }
            // } else {
            $this->redirect(Yii::app()->createUrl('Site/Login'));
            // }
        }
        $this->render('//site/reg');
    }

    /**
     * Logout
     */
    public function actionLogout()
    {
        UserLoginUtils::logout();
        $this->redirect(Yii::app()->createUrl('Site/Login'));
    }

    public function actionChangePassword()
    {
        
        // Authen Login
        // if (! UserLoginUtils::isLogin ()) {
        // $this->redirect ( Yii::app ()->createUrl ( 'Site/login' ) );
        // }
        if (isset($_POST['UsersLogin'])) {
            $update_model = UsersLogin::model()->findbyPk(UserLoginUtils::getUsersLoginId());
            
            $model = UsersLogin::model();
            $transaction = Yii::app()->db->beginTransaction();
            $model->attributes = $_POST['UsersLogin'];
            $update_model->password = md5($model->password);
            // $update_model->update_by = UserLoginUtils::getUsersLoginId ();
            // $update_model->update_date = date ( "Y-m-d H:i:s" );
            $update_model->is_force_change_password = 0;
            
            $update_model->update();
            $transaction->commit();
            
            $this->redirect(Yii::app()->createUrl('Site/LogOut'));
        } else {
            
            // $model = $this->loadModel ();
            $this->render('//site/change_password');
        }
    }

    public function actionForgotPassword()
    {
        if (isset($_POST['UsersLogin'])) {
            
            $model = UsersLogin::model();
            $transaction = Yii::app()->db->beginTransaction();
            $model->attributes = $_POST['UsersLogin'];
            
            if (CommonUtil::IsNullOrEmptyString($model->email)) {
                $_SESSION['FAIL_MESSAGE'] = "โปรดป้อนอีเมล์";
                $this->render('//site/forgot_password');
            } else {
                
                $cri = new CDbCriteria();
                $cri->condition = " t.email = '" . $model->email . "'";
                $user = UsersLogin::model()->findAll($cri);
                
                if (isset($user[0])) {
                    $user[0]->password = md5('1234');
                    $user[0]->is_force_change_password = 1;
                    $user[0]->update();
                    
                    //
                    $mailBody = "Hello " . $model->first_name . '  ' . $model->last_name . ",<br>
Now the system initial your new password to 1234 <br>
Please login with initial password and change to the new one";
                    
                    $strSubject = "=?UTF-8?B?" . base64_encode(ConfigUtil::getEmailSubject()) . "?=";
                    MailUtil::sendMail($model->username, $strSubject, $mailBody);
                    
                    // $strSubject = "=?UTF-8?B?" . base64_encode ( ConfigUtil::getEmailSubject () ) . "?=";
                    // MailUtil::sendMail ( $model->email, $strSubject, self::GetForgotEmailTemplate ( '1234', $model->email ) );
                    
                    $transaction->commit();
                }
                
                // ส่งเมล์ รหัสผ่านใหม่
                $this->render('//site/sendemail_success');
            }
        } else {
            
            // $model = $this->loadModel ();
            $this->render('//site/forgot_password');
        }
    }

    public function GetForgotEmailTemplate($pwd, $email)
    {
        return '<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
	<html xmlns="http://www.w3.org/1999/xhtml">
	<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
		
	<title></title>
	<style type="text/css">
	#outlook a {
	padding: 0;
	}
	body {
		width: 100% !important;
		margin: 0;
	}
		
	body {
		-webkit-text-size-adjust: none;
	}
	body {
		margin: 0;
		padding: 0;
	}
		
	img {
		border: 0;
		height: auto;
		line-height: 100%;
		outline: none;
		text-decoration: none;
	}
		
	table td {
		border-collapse: collapse;
	}
		
	#backgroundTable {
	height: 100% !important;
	margin: 0;
	padding: 0;
	width: 100% !important;
	}
		
	@import
	url(http://fonts.googleapis.com/css?family=Open+Sans:400,300,600,700);
		
			body, #backgroundTable {
			background-color: #FFF;
	}
		
	.TopbarLogo {
		padding: 10px;
		text-align: left;
		vertical-align: middle;
	}
		
	h1, .h1 {
		color: #444444;
		display: block;
		font-family: Open Sans;
		font-size: 35px;
		font-weight: 400;
		line-height: 100%;
		margin-top: 2%;
		margin-right: 0;
		margin-bottom: 1%;
		margin-left: 0;
		text-align: left;
	}
		
	h2, .h2 {
		color: #444444;
		display: block;
		font-family: Open Sans;
		font-size: 30px;
		font-weight: 400;
		line-height: 100%;
		margin-top: 2%;
		margin-right: 0;
		margin-bottom: 1%;
		margin-left: 0;
		text-align: left;
	}
		
	h3, .h3 {
		color: #444444;
		display: block;
		font-family: Open Sans;
		font-size: 24px;
		font-weight: 400;
		margin-top: 2%;
		margin-right: 0;
		margin-bottom: 1%;
		margin-left: 0;
		text-align: left;
	}
		
	h4, .h4 {
		color: #444444;
		display: block;
		font-family: Open Sans;
		font-size: 18px;
		font-weight: 400;
		line-height: 100%;
		margin-top: 2%;
		margin-right: 0;
		margin-bottom: 1%;
		margin-left: 0;
		text-align: left;
	}
		
	h5, .h5 {
		color: #444444;
		display: block;
		font-family: Open Sans;
		font-size: 14px;
		font-weight: 400;
		line-height: 100%;
		margin-top: 2%;
		margin-right: 0;
		margin-bottom: 1%;
		margin-left: 0;
		text-align: left;
	}
		
	.textdark {
		color: #444444;
		font-family: Open Sans;
		font-size: 13px;
		line-height: 150%;
		text-align: left;
	}
		
	.textwhite {
		color: #fff;
		font-family: Open Sans;
		font-size: 13px;
		line-height: 150%;
		text-align: left;
	}
		
	.fontwhite {
		color: #fff;
	}
		
	.btn {
		background-color: #e5e5e5;
		background-image: none;
		filter: none;
		border: 0;
		box-shadow: none;
		padding: 7px 14px;
		text-shadow: none;
		font-family: "Segoe UI", Helvetica, Arial, sans-serif;
		font-size: 14px;
		color: #333333;
		cursor: pointer;
		outline: none;
		-webkit-border-radius: 0 !important;
		-moz-border-radius: 0 !important;
		border-radius: 0 !important;
	}
		
	.btn:hover, .btn:focus, .btn:active, .btn.active, .btn[disabled], .btn.disabled
	{
		font-family: "Segoe UI", Helvetica, Arial, sans-serif;
		color: #333333;
		box-shadow: none;
		background-color: #d8d8d8;
	}
		
	.btn.red {
		color: white;
		text-shadow: none;
		background-color: #d84a38;
	}
		
	.btn.red:hover, .btn.red:focus, .btn.red:active, .btn.red.active, .btn.red[disabled],
	.btn.red.disabled {
		background-color: #bb2413 !important;
		color: #fff !important;
	}
		
	.btn.green {
		color: white;
		text-shadow: none;
		background-color: #35aa47;
	}
		
	.btn.green:hover, .btn.green:focus, .btn.green:active, .btn.green.active,
	.btn.green.disabled, .btn.green[disabled] {
		background-color: #1d943b !important;
		color: #fff !important;
	}
	</style>
		
	</head>
	<body>
	<table border="0" cellpadding="0" cellspacing="0" width="100%"
			style="background-color: #1f1f1f; height: 52px;">
			<tbody>
			<tr>
			<td align="center">
			<center>
			<table border="0" cellpadding="0" cellspacing="0" width="600px"
					style="height: 100%;">
					<tbody>
					<tr>
					<td align="left" valign="middle" style="padding-left: 20px;"><a
					href="#"> <img
					src="http://www.myapps1357.com/labbase/images/logo_main.png"
							alt="LabBase"></img>
							</a></td>
		
							</tr>
							</tbody>
							</table>
							</center>
							</td>
							</tr>
							</tbody>
							</table>
							<table border="0" cellpadding="0" cellspacing="0" width="100%">
							<tbody>
							<tr>
							<td style="padding-bottom: 20px;">
							<center>
							<table border="0" cellpadding="0" cellspacing="0" width="600px"
									style="height: 100%;">
									<tbody>
									<tr>
									<td valign="top" class="bodyContent">
									<table border="0" cellpadding="20" cellspacing="0"
											width="100%">
											<tbody>
											<tr>
											<td valign="top">
											<h3>ข้อมูลการลงทะเบียนห้องปฏิบัติการทางวิทยาศาสตร์</h3> <br></br>
											<table>
											<tr>
											<td style="text-align: right">อีเมล์ :</td>
											<td>' . $email . '</td>
																</tr>
																<tr>
																	<td style="text-align: right">รหัสผ่าน:</td>
																	<td>' . $pwd . '</td>
																</tr>
															</table>
		
														</td>
														<td></td>
													</tr>
												</tbody>
											</table>
										</td>
									</tr>
								</tbody>
							</table>
						</center>
					</td>
				</tr>
			</tbody>
		</table>
		
		
		<table border="0" cellpadding="0" cellspacing="0" width="100%"
			style="background-color: #1f1f1f;">
			<tbody>
				<tr>
					<td align="center">
						<center>
							<table border="0" cellpadding="0" cellspacing="0" width="600px"
								style="height: 100%;">
								<tbody>
									<tr>
										<td align="right" valign="middle" class="textwhite"
											style="font-size: 12px; padding: 20px;">2012 &copy;
											ศูนย์บริหารความปลอดภัยอาชีวอนามัยและสิ่งแวดล้อม
											มหาวิทยาลัยมหิดล ศาลายา</td>
									</tr>
								</tbody>
							</table>
						</center>
					</td>
				</tr>
			</tbody>
		</table>
		
	</body>
	</html>';
    }
}