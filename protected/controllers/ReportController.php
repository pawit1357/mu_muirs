<?php
use PhpOffice\PhpWord\TemplateProcessor;
class ReportController extends CController {
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

		//echo $startDate . ',' . $endDate;

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

		//echo $startDate . ',' . $endDate;

		ob_start ();

		$datas = AccidentInvestigation::model ()->findAll ( $criteria );
		if (isset ( $datas )) {
			$str = '';
			// HEADER
			$str .= '<br><br><table style="width: 100%">' . '<tr style="text-align: left">' . '<td>รายงานการสอบสวนอุบัติเหตุ (' . $deptName . ') ข้อมูลตั้งแต่วันที่ ' . CommonUtil::DateThai ( $startDate ) . ' ถึงวันที่ ' . CommonUtil::DateThai ( $endDate ) . '</td>' . '</tr>' . '</table>';
			$str .= '<br><br>';
			// TABLE
			$str .= '<table style="text-align:left;font-family:arial;font-size:12px;" border="1" cellpadding="1" cellspacing="1" id="cssTable">
					<thead>
							<tr>
								<th style="text-align: center;">ลำดับ</th>
								<th style="text-align: center;">ผู้รายงาน</th>
								<th style="text-align: center;">ตำแหน่ง</th>
								<th style="text-align: center;">วันที่รายงาน</th>
								<th style="text-align: center;">สถานที่เกิดเหตุ</th>
								<th style="text-align: center;">ลักษณะเหตุการณ์เกิดขึ้นได้อย่างไร</th>
							</tr>
						</thead>
							<tbody>';
			// BODY
			$order = 1;
			foreach ( $datas as $item ) {

				$str .= '<tr>';
				$str .= '<td style="text-align: center">' . $order . '</td>';
				$str .= '<td style="text-align: center">' . $item->report_name . '</td>';
				$str .= '<td style="text-align: center">' . (isset ( $item->person_position ) ? $item->person_position : '') . '</td>';
				$str .= '<td style="text-align: center">' . CommonUtil::getDateThai($item->report_date) . '</td>';
				
				$str .= '<td style="text-align: center">' . $item->accident_location . '</td>';
				$str .= '<td style="text-align: center">' . $item->accident_event_happen . '</td>';
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

		//echo $startDate . ',' . $endDate;

		ob_start ();

		$datas = Incident::model ()->findAll ( $criteria );
		if (isset ( $datas )) {
			$str = '';
			// HEADER
			$str .= '<br><br><table style="width: 100%">' . '<tr style="text-align: left">' . '<td>รายงานอุบัติการณ์ (' . $deptName . ') ข้อมูลตั้งแต่วันที่ ' . CommonUtil::DateThai ( $startDate ) . ' ถึงวันที่ ' . CommonUtil::DateThai ( $endDate ) . '</td>' . '</tr>' . '</table>';
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
	public function actionExport01Pdf() {
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

			$templateProcessor->setValue ( 'dammage_type_1_value', ! isset ( $accident->dammage_type_1_value ) ? '-' : $accident->dammage_type_1_value );
			$templateProcessor->setValue ( 'dammage_type_2_value', ! isset ( $accident->dammage_type_2_value ) ? '-' : $accident->dammage_type_2_value );
			$templateProcessor->setValue ( 'dammage_type_3_value', ! isset ( $accident->dammage_type_3_value ) ? '-' : $accident->dammage_type_3_value );
			$templateProcessor->setValue ( 'dammage_type_4_value', ! isset ( $accident->dammage_type_4_value ) ? '-' : $accident->dammage_type_4_value );
			$templateProcessor->setValue ( 'dammage_type_4_other', ! isset ( $accident->dammage_type_4_other ) ? '-' : $accident->dammage_type_4_other );
			$templateProcessor->setValue ( 'dammage_type_5_value', ! isset ( $accident->dammage_type_5_value ) ? '-' : $accident->dammage_type_5_value );
			$templateProcessor->setValue ( 'dammage_type_6_value', ! isset ( $accident->dammage_type_6_value ) ? '-' : $accident->dammage_type_6_value );

			$templateProcessor->setValue ( 'dammage_type_1', $accident->dammage_type == "1" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'dammage_type_2', $accident->dammage_type == "2" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'dammage_type_3', $accident->dammage_type == "3" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'dammage_type_4', $accident->dammage_type == "4" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'dammage_type_5', $accident->dammage_type == "5" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'dammage_type_6', $accident->dammage_type == "6" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );

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

			$fileWordName = CommonUtil::random_string ( 6 ) . ".docx";
			$report_file_doc = $path . "/" . $fileWordName;
			try {
				$templateProcessor->saveAs ( $report_file_doc );
				header ( "Content-Disposition: attachment; filename=" . $fileWordName );
				readfile ( $report_file_doc ); // or echo file_get_contents($temp_file);
				unlink ( $report_file_doc ); // remove temp file

				// echo date ( 'H:i:s' ), ' Saving the result document...', EOL;
			} catch ( Exception $e ) {
				echo 'Caught exception: ', $e->getMessage (), "\n";
			}
		} else {
			echo date ( 'H:i:s' ), ' NULL';
		}
	}
	public function actionExport02Pdf() {
		$accidentInvestigation = AccidentInvestigation::model ()->findByAttributes ( array (
				'id' => addslashes ( $_GET ['id'] )
		) );

		if (isset ( $accidentInvestigation )) {

			$accidentInvestigationImage = AccidentInvestigationImage::model ()->findByAttributes ( array (
					'accident_investigation_id' => $accidentInvestigation->id
			) );
			$accidentInvestigationPersons = AccidentInvestigationPerson::model ()->findAllByAttributes ( array (
					'accident_investigation_id' => $accidentInvestigation->id
			) );

			$path = getcwd () . "/uploads/" . date ( 'Y/m/d' );
			if (! is_dir ( $path )) {
				mkdir ( $path, 777, true );
			}

			// generate word
			$templateProcessor = new TemplateProcessor ( ConfigUtil::getTemplateAccidentInvestigationReport () );
			$templateProcessor->setValue ( 'report_name', $accidentInvestigation->report_name );
			$templateProcessor->setValue ( 'report_position', $accidentInvestigation->report_position );
			$templateProcessor->setValue ( 'report_date', CommonUtil::getDateThai ( $accidentInvestigation->report_date ) );
			// Section 1 : ข้อมูลส่วนตัวผู้ได้รับบาดเจ็บ (Personal Detail)
			$personIndex = 1;
			foreach ( $accidentInvestigationPersons as $accidentInvestigationPerson ) {
				if ($personIndex == 1) {
					$templateProcessor->setValue ( 'person_type1', $accidentInvestigationPerson->person_type == "1" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
					$templateProcessor->setValue ( 'person_type2', $accidentInvestigationPerson->person_type == "2" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
					$templateProcessor->setValue ( 'person_type3', $accidentInvestigationPerson->person_type == "3" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
					$templateProcessor->setValue ( 'person_type4', $accidentInvestigationPerson->person_type == "4" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
					$templateProcessor->setValue ( 'person_type5', $accidentInvestigationPerson->person_type == "5" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
					$templateProcessor->setValue ( 'person_type_other', ! isset ( $accidentInvestigationPerson->person_type_other ) ? '' : $accidentInvestigationPerson->person_type_other );

					$templateProcessor->setValue ( 'person_name', $accidentInvestigationPerson->person_name );
					$templateProcessor->setValue ( 'person_position', $accidentInvestigationPerson->person_position );
					$templateProcessor->setValue ( 'person_department_id', $accidentInvestigationPerson->department->name );
					$templateProcessor->setValue ( 'person_responsibility', $accidentInvestigationPerson->person_responsibility );
					$templateProcessor->setValue ( 'person_work_period', $accidentInvestigationPerson->person_work_period );
				}
				$personIndex++;
			}
			// Section 2: ข้อมูลการเกิดอุบัติเหตุ (Accident Detail)
			$templateProcessor->setValue ( 'case_date', CommonUtil::getDateThai ( $accidentInvestigation->case_date ) );
			$templateProcessor->setValue ( 'case_date_time', $accidentInvestigation->case_date_time );
			$templateProcessor->setValue ( 'accident_location', $accidentInvestigation->accident_location );
			$templateProcessor->setValue ( 'accident_mission', $accidentInvestigation->accident_mission );
			$templateProcessor->setValue ( 'count_work_person', $accidentInvestigation->count_work_person );
			$templateProcessor->setValue ( 'bodyAccident1', $accidentInvestigation->body_accident_type == "1" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'bodyAccident2', $accidentInvestigation->body_accident_type == "2" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'bodyAccident3', $accidentInvestigation->body_accident_type == "3" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'bodyAccident4', $accidentInvestigation->body_accident_type == "4" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'bodyAccident5', $accidentInvestigation->body_accident_type == "5" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'bodyAccident6', $accidentInvestigation->body_accident_type == "6" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'bodyAccident7', $accidentInvestigation->body_accident_type == "7" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'bodyAccident8', $accidentInvestigation->body_accident_type == "8" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'bodyAccident9', $accidentInvestigation->body_accident_type == "9" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'bodyAccident10', $accidentInvestigation->body_accident_type == "10" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'body_accident_type_other', $accidentInvestigation->body_accident_type_other );
			$templateProcessor->setValue ( 'treat_detail', $accidentInvestigation->treat_detail );
			$templateProcessor->setValue ( 'leave_day', $accidentInvestigation->leave_day );
			$templateProcessor->setValue ( 'eyewitnesses', $accidentInvestigation->eyewitnesses );
			$templateProcessor->setValue ( 'accident_event_happen', $accidentInvestigation->accident_event_happen );
			$templateProcessor->setValue ( 'accident_type1', $accidentInvestigation->accident_type == "1" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'accident_type2', $accidentInvestigation->accident_type == "2" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'accident_type3', $accidentInvestigation->accident_type == "3" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'accident_type4', $accidentInvestigation->accident_type == "4" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'accident_type5', $accidentInvestigation->accident_type == "5" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'accident_type6', $accidentInvestigation->accident_type == "6" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'accident_type6_other', $accidentInvestigation->accident_type6_other );
			$templateProcessor->setValue ( 'ever_happen1', $accidentInvestigation->ever_happen == "1" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'ever_happen2', $accidentInvestigation->ever_happen == "2" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'ever_happen1_other', $accidentInvestigation->ever_happen1_other );
			// Section 3 : การวิเคราะห์หาสาเหตุ (Accident Analysis)

			$templateProcessor->setValue ( 'section3', CommonUtil::getReportAI ( $accidentInvestigation->accident_cause ) );

			// Section 4 : ความเสียหายจากการเกิดอุบัติเหตุ
			$templateProcessor->setValue ( 'adt1', $accidentInvestigation->accidental_damage_type == "1" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'adt2', $accidentInvestigation->accidental_damage_type == "2" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'adt3', $accidentInvestigation->accidental_damage_type == "3" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'adt4', $accidentInvestigation->accidental_damage_type == "4" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'adt5', $accidentInvestigation->accidental_damage_type == "5" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );
			$templateProcessor->setValue ( 'adt6', $accidentInvestigation->accidental_damage_type == "6" ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED );

			$templateProcessor->setValue ( 'accidental_damage1', $accidentInvestigation->accidental_damage1 );
			$templateProcessor->setValue ( 'accidental_damage2', $accidentInvestigation->accidental_damage2 );
			$templateProcessor->setValue ( 'accidental_damage3', $accidentInvestigation->accidental_damage3 );
			$templateProcessor->setValue ( 'accidental_damage4', $accidentInvestigation->accidental_damage4 );
			$templateProcessor->setValue ( 'accidental_damage4_other', $accidentInvestigation->accidental_damage4_other );
			$templateProcessor->setValue ( 'accidental_damage5', $accidentInvestigation->accidental_damage5 );
			// รายชื่อผู้เสียชีวิต/ บาดเจ็บ
			$result ='';
			$personIndex = 1;
			foreach ( $accidentInvestigationPersons as $accidentInvestigationPerson ) {
				if ($personIndex > 1) {

					$result = $result.($accidentInvestigationPerson->person_lost_type =="1"  ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED).'     เสียชีวิต          '.($accidentInvestigationPerson->person_lost_type=="2"  ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED).'     สูญเสียอวัยวะ/ทุพพลภาพ          '.($accidentInvestigationPerson->person_lost_type=="3"  ? CommonUtil::RADIO_CHECKED : CommonUtil::RADIO_UNCHECKED).' บาดเจ็บ/เจ็บป่วย'. '<w:br />';
					$result = $result.$personIndex.'.ชื่อ – สกุล '.$accidentInvestigationPerson->person_name.'       อายุ '.$accidentInvestigationPerson->person_age.'      ปี เพศ '.$accidentInvestigationPerson->person_sex.'      ตำแหน่ง '.$accidentInvestigationPerson->person_position. '<w:br />';
					$result = $result.'(กรณีที่บาดเจ็บ) อวัยวะที่บาดเจ็บ '.$accidentInvestigationPerson->person_dammage_body.'      ลักษณะการบาดเจ็บ '.$accidentInvestigationPerson->person_dammage_body_desc. '<w:br />';
					
				}
				$personIndex++;
			}
			$templateProcessor->setValue ( 'section4', $result);
			
			// Section 5 : การดำเนินการแก้ไขและการป้องกันไม่ให้เกิดซ้ำ (Corrective and Preventive action)
			$templateProcessor->setValue ( 'accident_solve', $accidentInvestigation->accident_solve );
			$templateProcessor->setValue ( 'accident_protect', $accidentInvestigation->accident_protect );

			$path_img1 = getcwd () . $accidentInvestigationImage->path_img1;
			$path_img2 = getcwd () . $accidentInvestigationImage->path_img2;
			$path_img3 = getcwd () . $accidentInvestigationImage->path_img3;
			$path_img4 = getcwd () . $accidentInvestigationImage->path_img4;
			$path_img5 = getcwd () . $accidentInvestigationImage->path_img5;
			$path_img6 = getcwd () . $accidentInvestigationImage->path_img6;
			$path_img7 = getcwd () . $accidentInvestigationImage->path_img7;
			$path_img8 = getcwd () . $accidentInvestigationImage->path_img8;
			$path_img9 = getcwd () . $accidentInvestigationImage->path_img9;
			$path_img10 = getcwd () . $accidentInvestigationImage->path_img10;
			$path_img11 = getcwd () . $accidentInvestigationImage->path_img11;
			$path_img12 = getcwd () . $accidentInvestigationImage->path_img12;
			$path_img13 = getcwd () . $accidentInvestigationImage->path_img13;
			$path_img14 = getcwd () . $accidentInvestigationImage->path_img14;
			$path_img15 = getcwd () . $accidentInvestigationImage->path_img15;

			if (isset ( $accidentInvestigationImage->path_img1 )) {
				$templateProcessor->setImageValue ( 'path_img1', array (
						"path" => $path_img1,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img1', '' );
			}
			if (isset ( $accidentInvestigationImage->path_img2 )) {
				$templateProcessor->setImageValue ( 'path_img2', array (
						"path" => $path_img2,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img2', '' );
			}
			if (isset ( $accidentInvestigationImage->path_img3 )) {
				$templateProcessor->setImageValue ( 'path_img3', array (
						"path" => $path_img3,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img3', '' );
			}
			if (isset ( $accidentInvestigationImage->path_img4 )) {
				$templateProcessor->setImageValue ( 'path_img4', array (
						"path" => $path_img4,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img4', '' );
			}
			if (isset ( $accidentInvestigationImage->path_img5 )) {
				$templateProcessor->setImageValue ( 'path_img5', array (
						"path" => $path_img5,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img5', '' );
			}

			if (isset ( $accidentInvestigationImage->path_img6 )) {
				$templateProcessor->setImageValue ( 'path_img6', array (
						"path" => $path_img6,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img6', '' );
			}
			if (isset ( $accidentInvestigationImage->path_img7 )) {
				$templateProcessor->setImageValue ( 'path_img7', array (
						"path" => $path_img7,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img7', '' );
			}
			if (isset ( $accidentInvestigationImage->path_img8 )) {
				$templateProcessor->setImageValue ( 'path_img8', array (
						"path" => $path_img8,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img8', '' );
			}
			if (isset ( $accidentInvestigationImage->path_img9 )) {
				$templateProcessor->setImageValue ( 'path_img9', array (
						"path" => $path_img9,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img9', '' );
			}
			if (isset ( $accidentInvestigationImage->path_img10 )) {
				$templateProcessor->setImageValue ( 'path_img10', array (
						"path" => $path_img10,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img10', '' );
			}
			// /
			if (isset ( $accidentInvestigationImage->path_img11 )) {
				$templateProcessor->setImageValue ( 'path_img11', array (
						"path" => $path_img11,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img11', '' );
			}
			if (isset ( $accidentInvestigationImage->path_img12 )) {
				$templateProcessor->setImageValue ( 'path_img12', array (
						"path" => $path_img12,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img12', '' );
			}
			if (isset ( $accidentInvestigationImage->path_img13 )) {
				$templateProcessor->setImageValue ( 'path_img13', array (
						"path" => $path_img13,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img13', '' );
			}
			if (isset ( $accidentInvestigationImage->path_img14 )) {
				$templateProcessor->setImageValue ( 'path_img14', array (
						"path" => $path_img14,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img14', '' );
			}
			if (isset ( $accidentInvestigationImage->path_img15 )) {
				$templateProcessor->setImageValue ( 'path_img15', array (
						"path" => $path_img15,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img15', '' );
			}

			$fileWordName = CommonUtil::random_string ( 6 ) . ".docx";
			$report_file_doc = $path . "/" . $fileWordName;
			try {
				$templateProcessor->saveAs ( $report_file_doc );
				header ( "Content-Disposition: attachment; filename=" . $fileWordName );
				readfile ( $report_file_doc ); // or echo file_get_contents($temp_file);
				unlink ( $report_file_doc ); // remove temp file

				// echo date ( 'H:i:s' ), ' Saving the result document...', EOL;
			} catch ( Exception $e ) {
				echo 'Caught exception: ', $e->getMessage (), "\n";
			}
		} else {
			echo date ( 'H:i:s' ), ' NULL';
		}
	}
	public function actionExport03Pdf() {
		$incident = Incident::model ()->findByAttributes ( array (
				'id' => addslashes ( $_GET ['id'] )
		) );

		if (isset ( $incident )) {

			$incidentImg = IncidentImage::model ()->findByAttributes ( array (
					'incident_id' => $incident->id
			) );

			$path = getcwd () . "/uploads/" . date ( 'Y/m/d' );
			if (! is_dir ( $path )) {
				mkdir ( $path, 777, true );
			}

			// generate word
			$templateProcessor = new TemplateProcessor ( ConfigUtil::getTemplateIncidentReport () );
			$templateProcessor->setValue ( 'report_date', CommonUtil::getDateThai ( $incident->report_date ) );
			$templateProcessor->setValue ( 'accident_location', $incident->accident_location );
			$templateProcessor->setValue ( 'accident_characteristics', $incident->accident_characteristics );

			$templateProcessor->setValue ( 'accident_cause', $incident->accident_cause );

			$path_img1 = getcwd () . $incidentImg->path_img1;
			$path_img2 = getcwd () . $incidentImg->path_img2;
			$path_img3 = getcwd () . $incidentImg->path_img3;
			$path_img4 = getcwd () . $incidentImg->path_img4;
			$path_img5 = getcwd () . $incidentImg->path_img5;

			if (isset ( $incidentImg->path_img1 )) {
				$templateProcessor->setImageValue ( 'path_img1', array (
						"path" => $path_img1,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img1', '' );
			}
			if (isset ( $incidentImg->path_img2 )) {
				$templateProcessor->setImageValue ( 'path_img2', array (
						"path" => $path_img2,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img2', '' );
			}
			if (isset ( $incidentImg->path_img3 )) {
				$templateProcessor->setImageValue ( 'path_img3', array (
						"path" => $path_img3,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img3', '' );
			}
			if (isset ( $incidentImg->path_img4 )) {
				$templateProcessor->setImageValue ( 'path_img4', array (
						"path" => $path_img4,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img4', '' );
			}
			if (isset ( $incidentImg->path_img5 )) {
				$templateProcessor->setImageValue ( 'path_img5', array (
						"path" => $path_img5,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img5', '' );
			}

			if (isset ( $incidentImg->path_img6 )) {
				$templateProcessor->setImageValue ( 'path_img6', array (
						"path" => $path_img6,
						"width" => 150,
						"height" => 100
				) );
			} else {
				$templateProcessor->setValue ( 'path_img6', '' );
			}

			$fileWordName = CommonUtil::random_string ( 6 ) . ".docx";
			$report_file_doc = $path . "/" . $fileWordName;
			try {
				$templateProcessor->saveAs ( $report_file_doc );
				header ( "Content-Disposition: attachment; filename=" . $fileWordName );
				readfile ( $report_file_doc ); // or echo file_get_contents($temp_file);
				unlink ( $report_file_doc ); // remove temp file

				// echo date ( 'H:i:s' ), ' Saving the result document...', EOL;
			} catch ( Exception $e ) {
				echo 'Caught exception: ', $e->getMessage (), "\n";
			}
		} else {
			echo date ( 'H:i:s' ), ' NULL';
		}
	}
}