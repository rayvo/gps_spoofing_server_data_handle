<?php
/**
 * Created by PhpStorm.
 * User: ray
 * Date: 2019-01-22
 * Time: 18:13
 */

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\IOFactory;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setCellValue('A1','#');
$sheet->setCellValue('B1','이름');
$sheet->setCellValue('C1','생일');
$sheet->setCellValue('D1','휴대폰번호');
$sheet->setCellValue('E1','주소');
$sheet->setCellValue('F1','성별');
$sheet->setCellValue('G1','등록일');


$filename = 'sample-'.time().'.xlsx';

//redirect output to client
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');
// if use IE9
header('Cache-Control: max-age=1');

$writer = IOFactory::createWriter($spreadsheet,'Xlsx');
$writer->save('php://output');