<?php
session_start();
// include Yii bootstrap file
require_once(dirname(__FILE__).'/framework/yii.php');
$config=dirname(__FILE__).'/protected/config/main.php';

// include custom class
require_once dirname(__FILE__).'/protected/utilities/UserLoginUtils.php';
require_once dirname(__FILE__).'/protected/utilities/ConfigUtil.php';
require_once dirname(__FILE__).'/protected/utilities/MenuUtil.php';
require_once dirname(__FILE__).'/protected/utilities/CommonUtil.php';
require_once dirname(__FILE__).'/protected/utilities/MailUtil.php';
require_once dirname(__FILE__).'/protected/utilities/InformationUtil.php';


require_once dirname(__FILE__).'/protected/extensions/vendor/autoload.php';

//save pdf
// require_once dirname(__FILE__).'/protected/extensions/vendor/fpdi/fpdf.php';
// require_once dirname(__FILE__).'/protected/extensions/vendor/fpdi/fpdfhtml.php';
// require_once dirname(__FILE__).'/protected/extensions/vendor/fpdi/fpdi.php';
// require_once dirname(__FILE__).'/protected/extensions/vendor/fpdi/fpdf_tpl.php';
// require_once dirname(__FILE__).'/protected/extensions/vendor/fpdi/fpdi_bridge.php';
// require_once dirname(__FILE__).'/protected/extensions/vendor/fpdi/fpdi_pdf_parser.php';
// require_once dirname(__FILE__).'/protected/extensions/vendor/fpdi/pdf_context.php';
// require_once dirname(__FILE__).'/protected/extensions/vendor/fpdi/pdf_parser.php';
require_once dirname(__FILE__).'/protected/extensions/vendor/tcpdf/tcpdf.php';


//phpword
// create a Web application instance and run
$app = Yii::createWebApplication($config);
Yii::app()->setTimeZone('Asia/Bangkok');
$app->run();