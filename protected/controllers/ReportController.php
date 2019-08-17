<?php
// use PhpOffice\PhpWord\PhpWord;
// use PhpOffice\PhpWord\IOFactory;
// use PhpOffice\PhpWord\Settings;
use PhpOffice\PhpWord\TemplateProcessor;
class ReportController extends CController {
	
	const RADIO_CHECKED = '<w:sym w:font="Wingdings" w:char="F0FE"/>';
	const RADIO_UNCHECKED = '<w:sym w:font="Wingdings" w:char="F0A8"/>';
	
	const CRLF = ""; // \r\n";
	public $layout = '_main';
	private $_model;

	/* */
	public function actionReport01() {
		// Authen Login
		if (! UserLoginUtils::isLogin ()) {
			$this->redirect ( Yii::app ()->createUrl ( 'Site/login' ) );
		}

		$criteria = new CDbCriteria ();

		if (isset ( $_POST ['Accident'] )) {

			$accident = new Accident ();
			$accident->attributes = $_POST ['Accident'];

			$startDate = CommonUtil::getDate ( $accident->report_date_from );
			$endDate = CommonUtil::getDate ( $accident->report_date_to );

			if ($accident->department_id != - 1) {
				$criteria->compare ( 'department_id', $accident->department_id, true );
			}
			if (isset ( $startDate ) && isset ( $endDate )) {
				$criteria->addBetweenCondition ( 'case_date', $startDate, $endDate, 'AND' );
			}

			$dataProvider = new CActiveDataProvider ( "Accident", array (
					'criteria' => $criteria
			) );
			$this->render ( '//report/report01', array (
					'dataProvider' => $dataProvider,
					'data' => $accident
			) );
		} else {
			$startDate = CommonUtil::getDate ( CommonUtil::getCurDate () );
			$endDate = CommonUtil::getDate ( CommonUtil::getCurDate () );
			$criteria->addBetweenCondition ( 'case_date', $startDate, $endDate, 'AND' );
			$dataProvider = new CActiveDataProvider ( "Accident", array (
					'criteria' => $criteria
			) );
			$this->render ( '//report/report01', array (
					'dataProvider' => $dataProvider
			) );
		}
	}

	/* */
	public function actionReport02() {
		// Authen Login
		if (! UserLoginUtils::isLogin ()) {
			$this->redirect ( Yii::app ()->createUrl ( 'Site/login' ) );
		}

		$criteria = new CDbCriteria ();

		if (isset ( $_POST ['AccidentInvestigation'] )) {

			$accidentInvestigation = new AccidentInvestigation ();
			$accidentInvestigation->attributes = $_POST ['AccidentInvestigation'];

			$startDate = CommonUtil::getDate ( $accidentInvestigation->report_date_from );
			$endDate = CommonUtil::getDate ( $accidentInvestigation->report_date_to );

			if ($accidentInvestigation->owner_department_id != - 1) {
				$criteria->compare ( 'owner_department_id', $accidentInvestigation->owner_department_id, true );
			}
			if (isset ( $startDate ) && isset ( $endDate )) {
				$criteria->addBetweenCondition ( 'case_date', $startDate, $endDate, 'AND' );
			}

			$dataProvider = new CActiveDataProvider ( "AccidentInvestigation", array (
					'criteria' => $criteria
			) );
			$this->render ( '//report/report02', array (
					'dataProvider' => $dataProvider,
					'data' => $accidentInvestigation
			) );
		} else {
			$startDate = CommonUtil::getDate ( CommonUtil::getCurDate () );
			$endDate = CommonUtil::getDate ( CommonUtil::getCurDate () );
			$criteria->addBetweenCondition ( 'case_date', $startDate, $endDate, 'AND' );
			$dataProvider = new CActiveDataProvider ( "AccidentInvestigation", array (
					'criteria' => $criteria
			) );
			$this->render ( '//report/report02', array (
					'dataProvider' => $dataProvider
			) );
		}
	}

	/* */
	public function actionReport03() {
		// Authen Login
		if (! UserLoginUtils::isLogin ()) {
			$this->redirect ( Yii::app ()->createUrl ( 'Site/login' ) );
		}

		$criteria = new CDbCriteria ();

		if (isset ( $_POST ['Incident'] )) {

			$incident = new Incident ();
			$incident->attributes = $_POST ['Incident'];

			$startDate = CommonUtil::getDate ( $incident->report_date_from );
			$endDate = CommonUtil::getDate ( $incident->report_date_to );

			if ($incident->owner_department_id != - 1) {
				$criteria->compare ( 'department_id', $incident->owner_department_id, true );
			}
			if (isset ( $startDate ) && isset ( $endDate )) {
				$criteria->addBetweenCondition ( 'report_date', $startDate, $endDate, 'AND' );
			}

			$dataProvider = new CActiveDataProvider ( "Incident", array (
					'criteria' => $criteria
			) );
			$this->render ( '//report/report03', array (
					'dataProvider' => $dataProvider,
					'data' => $incident
			) );
		} else {
			$startDate = CommonUtil::getDate ( CommonUtil::getCurDate () );
			$endDate = CommonUtil::getDate ( CommonUtil::getCurDate () );
			$criteria->addBetweenCondition ( 'report_date', $startDate, $endDate, 'AND' );
			$dataProvider = new CActiveDataProvider ( "Incident", array (
					'criteria' => $criteria
			) );
			$this->render ( '//report/report03', array (
					'dataProvider' => $dataProvider
			) );
		}
	}

	/* Export */
	public function actionReport01Pdf() {
		$criteria = new CDbCriteria ();
		$deptName = 'ข้อมูลทั้งหมด';
		$department_id = $_GET ['department_id'];
		$startDate = $_GET ['report_date_from'];
		$endDate = $_GET ['report_date_to'];

		if ($department_id != - 1) {
			$criteria->compare ( 'department_id', $department_id, true );

			$dept = MDepartment::model ()->findByPk ( $department_id );
			if (isset ( $dept )) {
				$deptName = $dept->name;
			}
		}
		if (isset ( $startDate ) && isset ( $endDate )) {
			$criteria->addBetweenCondition ( 'case_date', $startDate, $endDate, 'AND' );
		}

		echo $startDate . ',' . $endDate;

		ob_start ();

		$datas = Accident::model ()->findAll ( $criteria );
		if (isset ( $datas )) {
			$str = '';
			// HEADER
			$str .= '<br><br><table style="width: 100%">' . '<tr style="text-align: left">' . '<td>รายงานอุบัติเหตุ (' . $deptName . ') ข้อมูลตั้งแต่วันที่ ' . CommonUtil::DateThai ( $startDate ) . ' ถึงวันที่ ' . CommonUtil::DateThai ( $endDate ) . '</td>' . '</tr>' . '</table>';
			$str .= '<br><br>';
			// TABLE
			$str .= '<table style="text-align:left;font-family:arial;font-size:12px;" border="1" cellpadding="1" cellspacing="1" id="cssTable">
					<thead>
							<tr>
								<th style="text-align: center;">ลำดับ</th>
								<th style="text-align: center;">ผู้รายงาน</th>
								<th style="text-align: center;">เบอร์โทรศัพท์</th>
								<th style="text-align: center;">คณะ/ส่วนงาน</th>
								<th style="text-align: center;">ลักษณะเหตุการณ์</th>
								<th style="text-align: center;">สถานที่เกิดเหตุ</th>
								<th style="text-align: center;">วัน/เดือน/ปี ที่เกิดเหตุ </th>
							</tr>
						</thead>
							<tbody>';
			// BODY
			$order = 1;
			foreach ( $datas as $item ) {

				$str .= '<tr>';
				$str .= '<td style="text-align: center">' . $order . '</td>';
				$str .= '<td style="text-align: center">' . $item->name . '</td>';
				$str .= '<td style="text-align: center">' . (isset ( $item->phone_number ) ? $item->phone_number : '') . '</td>';
				$str .= '<td style="text-align: center">' . (isset ( $item->department->name ) ? $item->department->name : '') . '</td>';

				$str .= '<td style="text-align: center">' . $item->accident_event . '</td>';
				$str .= '<td style="text-align: center">' . $item->accident_location . '</td>';
				$str .= '<td style="text-align: center">' . (isset ( $item->case_date ) ? $item->case_date : '') . '</td>';
				$str .= '</tr>';
				$order ++;
			}

			if ($order == 1) {
				$str .= '<tr>';
				$str .= '<td colspan="7" style="text-align: center">ไม่พบข้อมูลตามเงื่อนไขที่กำหนด</td>';
				$str .= '</tr>';
			}
			// END TABLE
			$str .= '</tbody></table>';

			// create new PDF document
			$pdf = new TCPDF ( PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false );
			// Set font
			$pdf->SetFont ( 'thsarabun', '', 14 );
			$pdf->AddPage ();
			// Print text using writeHTMLCell()
			$pdf->writeHTMLCell ( 0, 0, '', '', $str, 0, 1, 0, true, '', true );

			// Close and output PDF document
			$tmp_pdf_file = CommonUtil::makeRandomString ( 10 ) . '.pdf';
			$pdf->Output ( $tmp_pdf_file, 'D' );
		}
	}
	public function actionReport02Pdf() {
		$criteria = new CDbCriteria ();
		$deptName = 'ข้อมูลทั้งหมด';
		$department_id = $_GET ['owner_department_id'];
		$startDate = $_GET ['report_date_from'];
		$endDate = $_GET ['report_date_to'];

		if ($department_id != - 1) {
			$criteria->compare ( 'owner_department_id', $department_id, true );

			$dept = MDepartment::model ()->findByPk ( $department_id );
			if (isset ( $dept )) {
				$deptName = $dept->name;
			}
		}
		if (isset ( $startDate ) && isset ( $endDate )) {
			$criteria->addBetweenCondition ( 'case_date', $startDate, $endDate, 'AND' );
		}

		echo $startDate . ',' . $endDate;

		ob_start ();

		$datas = AccidentInvestigation::model ()->findAll ( $criteria );
		if (isset ( $datas )) {
			$str = '';
			// HEADER
			$str .= '<br><br><table style="width: 100%">' . '<tr style="text-align: left">' . '<td>รายงานอุบัติเหตุ (' . $deptName . ') ข้อมูลตั้งแต่วันที่ ' . CommonUtil::DateThai ( $startDate ) . ' ถึงวันที่ ' . CommonUtil::DateThai ( $endDate ) . '</td>' . '</tr>' . '</table>';
			$str .= '<br><br>';
			// TABLE
			$str .= '<table style="text-align:left;font-family:arial;font-size:12px;" border="1" cellpadding="1" cellspacing="1" id="cssTable">
					<thead>
							<tr>
								<th style="text-align: center;">ลำดับ</th>
								<th style="text-align: center;">ชื่อ-นามสุกล</th>
								<th style="text-align: center;">อายุ</th>
								<th style="text-align: center;">ตำแหน่ง/ชั้นปี</th>
								<th style="text-align: center;">คณะ/ส่วนงาน</th>
								<th style="text-align: center;">หน้าที่</th>
								<th style="text-align: center;">อวัยวะที่บาดเจ็บ</th>
							</tr>
						</thead>
							<tbody>';
			// BODY
			$order = 1;
			foreach ( $datas as $item ) {

				$str .= '<tr>';
				$str .= '<td style="text-align: center">' . $order . '</td>';
				$str .= '<td style="text-align: center">' . $item->person_name . '</td>';
				$str .= '<td style="text-align: center">' . (isset ( $item->person_age ) ? $item->person_age : '') . '</td>';
				$str .= '<td style="text-align: center">' . (isset ( $item->person_position ) ? $item->person_position : '') . '</td>';

				$str .= '<td style="text-align: center">' . $item->department->name . '</td>';
				$str .= '<td style="text-align: center">' . $item->person_responsibility . '</td>';
				$str .= '<td style="text-align: center">' . (isset ( $item->person_dammage_body ) ? $item->person_dammage_body : '') . '</td>';
				$str .= '</tr>';
				$order ++;
			}

			if ($order == 1) {
				$str .= '<tr>';
				$str .= '<td colspan="7" style="text-align: center">ไม่พบข้อมูลตามเงื่อนไขที่กำหนด</td>';
				$str .= '</tr>';
			}
			// END TABLE
			$str .= '</tbody></table>';

			// create new PDF document
			$pdf = new TCPDF ( PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false );
			// Set font
			$pdf->SetFont ( 'thsarabun', '', 14 );
			$pdf->AddPage ();
			// Print text using writeHTMLCell()
			$pdf->writeHTMLCell ( 0, 0, '', '', $str, 0, 1, 0, true, '', true );

			// Close and output PDF document
			$tmp_pdf_file = CommonUtil::makeRandomString ( 10 ) . '.pdf';
			$pdf->Output ( $tmp_pdf_file, 'D' );
		}
	}
	public function actionReport03Pdf() {
		$criteria = new CDbCriteria ();
		$deptName = 'ข้อมูลทั้งหมด';
		$department_id = $_GET ['owner_department_id'];
		$startDate = $_GET ['report_date_from'];
		$endDate = $_GET ['report_date_to'];

		if ($department_id != - 1) {
			$criteria->compare ( 'owner_department_id', $department_id, true );

			$dept = MDepartment::model ()->findByPk ( $department_id );
			if (isset ( $dept )) {
				$deptName = $dept->name;
			}
		}
		if (isset ( $startDate ) && isset ( $endDate )) {
			$criteria->addBetweenCondition ( 'report_date', $startDate, $endDate, 'AND' );
		}

		echo $startDate . ',' . $endDate;

		ob_start ();

		$datas = Incident::model ()->findAll ( $criteria );
		if (isset ( $datas )) {
			$str = '';
			// HEADER
			$str .= '<br><br><table style="width: 100%">' . '<tr style="text-align: left">' . '<td>รายงานอุบัติเหตุ (' . $deptName . ') ข้อมูลตั้งแต่วันที่ ' . CommonUtil::DateThai ( $startDate ) . ' ถึงวันที่ ' . CommonUtil::DateThai ( $endDate ) . '</td>' . '</tr>' . '</table>';
			$str .= '<br><br>';
			// TABLE
			$str .= '<table style="text-align:left;font-family:arial;font-size:12px;" border="1" cellpadding="1" cellspacing="1" id="cssTable">
					<thead>
							<tr>
								<th style="text-align: center;">ลำดับ</th>
								<th style="text-align: center;">ผู้พบเห็นเหตุการณ์</th>
								<th style="text-align: center;">คณะ/ส่วนงาน</th>
								<th style="text-align: center;">ลักษณะของเหตุการณ์</th>
								<th style="text-align: center;">วัน/เดือน/ปี ที่เกิดเหตุ </th>
							</tr>
						</thead>
							<tbody>';
			// BODY
			$order = 1;
			foreach ( $datas as $item ) {

				$str .= '<tr>';
				$str .= '<td style="text-align: center">' . $order . '</td>';
				$str .= '<td style="text-align: center">' . $item->accident_event_withness_first . '</td>';
				$str .= '<td style="text-align: center">' . (isset ( $item->department->name ) ? $item->department->name : '') . '</td>';
				$str .= '<td style="text-align: center">' . (isset ( $item->accident_cause ) ? $item->accident_cause : '') . '</td>';

				$str .= '<td style="text-align: center">' . $item->report_date . '</td>';

				$str .= '</tr>';
				$order ++;
			}

			if ($order == 1) {
				$str .= '<tr>';
				$str .= '<td colspan="7" style="text-align: center">ไม่พบข้อมูลตามเงื่อนไขที่กำหนด</td>';
				$str .= '</tr>';
			}
			// END TABLE
			$str .= '</tbody></table>';

			// create new PDF document
			$pdf = new TCPDF ( PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false );
			// Set font
			$pdf->SetFont ( 'thsarabun', '', 14 );
			$pdf->AddPage ();
			// Print text using writeHTMLCell()
			$pdf->writeHTMLCell ( 0, 0, '', '', $str, 0, 1, 0, true, '', true );

			// Close and output PDF document
			$tmp_pdf_file = CommonUtil::makeRandomString ( 10 ) . '.pdf';
			$pdf->Output ( $tmp_pdf_file, 'D' );
		}
	}

	/* PDF */
	public function actionExportPdf() {
		
		$accident = Accident::model ()->findByAttributes ( array (
				'id' => addslashes ( $_GET ['id'] )
		) );

		if (isset ( $accident )) {

			$accidentImg = AccidentImage::model ()->findByAttributes ( array (
					'accident_id' => $accident->id
			) );

			$path = getcwd () . "/uploads/" . date ( 'Y/m/d' );
			if (! is_dir ( $path )) {
				mkdir ( $path, 777, true );
			}

			// generate word
			$templateProcessor = new TemplateProcessor ( ConfigUtil::getTemplateAccident () );
			$templateProcessor->setValue ( 'name', $accident->name );
			$templateProcessor->setValue ( 'position_or_level', $accident->position_or_level );
			$templateProcessor->setValue ( 'department_id', $accident->department->name );
			$templateProcessor->setValue ( 'phone_number', $accident->phone_number );
			$templateProcessor->setValue ( 'email', $accident->email );
			$templateProcessor->setValue ( 'report_date', CommonUtil::getDateThai ( $accident->report_date ) );
			$templateProcessor->setValue ( 'name2', $accident->name2 );
			$templateProcessor->setValue ( 'belong_to', $accident->belong_to );
			//
			$templateProcessor->setValue ( 'case_date', CommonUtil::getDateThai ( $accident->case_date ) );
			$templateProcessor->setValue ( 'case_date_time', $accident->case_date_time );
			$templateProcessor->setValue ( 'accident_location', $accident->accident_location );
			$templateProcessor->setValue ( 'accident_chronology', $accident->accident_chronology );
			$templateProcessor->setValue ( 'accident_event', $accident->accident_event );
			//
			$templateProcessor->setValue ( 'accident_cause', $accident->accident_cause );
			$templateProcessor->setValue ( 'accident_solve', $accident->accident_solve );

			$templateProcessor->setValue ( 'dammage_type_1_value', !isset($accident->dammage_type_1_value)? '-' : $accident->dammage_type_1_value );
			$templateProcessor->setValue ( 'dammage_type_2_value', !isset($accident->dammage_type_2_value)? '-' : $accident->dammage_type_2_value );
			$templateProcessor->setValue ( 'dammage_type_3_value', !isset($accident->dammage_type_3_value)? '-' : $accident->dammage_type_3_value );
			$templateProcessor->setValue ( 'dammage_type_4_value', !isset($accident->dammage_type_4_value)? '-' : $accident->dammage_type_4_value );
			$templateProcessor->setValue ( 'dammage_type_4_other', !isset($accident->dammage_type_4_other)? '-' : $accident->dammage_type_4_other );
			$templateProcessor->setValue ( 'dammage_type_5_value', !isset($accident->dammage_type_5_value)? '-' : $accident->dammage_type_5_value );
			$templateProcessor->setValue ( 'dammage_type_6_value', !isset($accident->dammage_type_6_value)? '-' : $accident->dammage_type_6_value );

			
			$templateProcessor->setValue('dammage_type_1',$accident->dammage_type=="1"? self::RADIO_CHECKED:self::RADIO_UNCHECKED);
			$templateProcessor->setValue('dammage_type_2',$accident->dammage_type=="2"? self::RADIO_CHECKED:self::RADIO_UNCHECKED);
			$templateProcessor->setValue('dammage_type_3',$accident->dammage_type=="3"? self::RADIO_CHECKED:self::RADIO_UNCHECKED);
			$templateProcessor->setValue('dammage_type_4',$accident->dammage_type=="4"? self::RADIO_CHECKED:self::RADIO_UNCHECKED);
			$templateProcessor->setValue('dammage_type_5',$accident->dammage_type=="5"? self::RADIO_CHECKED:self::RADIO_UNCHECKED);
			$templateProcessor->setValue('dammage_type_6',$accident->dammage_type=="6"? self::RADIO_CHECKED:self::RADIO_UNCHECKED);
			
			$path_img1 = getcwd () . $accidentImg->path_img1;
			$path_img2 = getcwd () . $accidentImg->path_img2;
			$path_img3 = getcwd () . $accidentImg->path_img3;
			$path_img4 = getcwd () . $accidentImg->path_img4;
			$path_img5 = getcwd () . $accidentImg->path_img5;
			$path_img6 = getcwd () . $accidentImg->path_img6;
			$path_img7 = getcwd () . $accidentImg->path_img7;
			$path_img8 = getcwd () . $accidentImg->path_img8;
			$path_img9 = getcwd () . $accidentImg->path_img9;
			$path_img10 = getcwd () . $accidentImg->path_img10;

			if (isset ( $accidentImg->path_img1 )) {
				$templateProcessor->setImageValue ( 'path_img1', array (
						"path" => $path_img1,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img1', '' );
			}
			if (isset ( $accidentImg->path_img2 )) {
				$templateProcessor->setImageValue ( 'path_img2', array (
						"path" => $path_img2,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img2', '' );
			}
			if (isset ( $accidentImg->path_img3 )) {
				$templateProcessor->setImageValue ( 'path_img3', array (
						"path" => $path_img3,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img3', '' );
			}
			if (isset ( $accidentImg->path_img4 )) {
				$templateProcessor->setImageValue ( 'path_img4', array (
						"path" => $path_img4,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img4', '' );
			}
			if (isset ( $accidentImg->path_img5 )) {
				$templateProcessor->setImageValue ( 'path_img5', array (
						"path" => $path_img5,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img5', '' );
			}

			if (isset ( $accidentImg->path_img6 )) {
				$templateProcessor->setImageValue ( 'path_img6', array (
						"path" => $path_img6,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img6', '' );
			}
			if (isset ( $accidentImg->path_img7 )) {
				$templateProcessor->setImageValue ( 'path_img7', array (
						"path" => $path_img7,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img7', '' );
			}
			if (isset ( $accidentImg->path_img8 )) {
				$templateProcessor->setImageValue ( 'path_img8', array (
						"path" => $path_img8,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img8', '' );
			}
			if (isset ( $accidentImg->path_img9 )) {
				$templateProcessor->setImageValue ( 'path_img9', array (
						"path" => $path_img9,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img9', '' );
			}
			if (isset ( $accidentImg->path_img10 )) {
				$templateProcessor->setImageValue ( 'path_img10', array (
						"path" => $path_img10,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img10', '' );
			}

			$report_file_doc = $path . "/" . CommonUtil::random_string ( 6 ) . ".docx";
			try {
				$templateProcessor->saveAs ( $report_file_doc );

				echo date ( 'H:i:s' ), ' Saving the result document...', EOL;
			} catch ( Exception $e ) {
				echo 'Caught exception: ', $e->getMessage (), "\n";
			}
		} else {
			echo date ( 'H:i:s' ), ' NULL';
		}
	}
}