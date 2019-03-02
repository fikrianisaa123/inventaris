<?php
defined('BASEPATH') OR exit('No direct script access allowed');

// Load library phpspreadsheet
require('./excel/vendor/autoload.php');

use PhpOffice\PhpSpreadsheet\Helper\Sample;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
// End load library phpspreadsheet

class Excel extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model(
			array(
				'profile_model',
				'inventory_model',
				'categories_model',
				'locations_model',
				'status_model',
				'color_model',
                'logs_model',
                'excel_model',
			)
        );
        $this->load->library('Pdf');
    }

    public function index()
    {
        echo "a";
    }

    public function pdf()
    {
        $data1 = $this->excel_model->data_inventory();
        $data = array(
            'inventaris' => $data1,
        );
        $this->load->view('test/pdf', $data);
    }

    public function testpdf()
    {
        $data1 = $this->excel_model->data_inventory();
        $data = array(
            'inventaris' => $data1,
        );
        print_r($data['inventaris']);
    }

    // Export ke excel
    public function export()
    {
        $inventaris = $this->excel_model->data_inventory();
        // MEMANGGIL FUNGSI SPREADSHEET (CONSTRUCTOR)
        $spreadsheet = new Spreadsheet();

        // PROPERTIES DOKUMEN
        $spreadsheet->getProperties()->setCreator('BPBD')
        ->setLastModifiedBy('BPBD')
        ->setTitle('Office XLSX Test Document')
        ->setSubject('Office XLSX Test Document')
        ->setDescription('Test document for Office XLSX, generated using PHP classes.')
        ->setKeywords('office openxml php')
        ->setCategory('Test result file');

        // MEMBUAT HEADER ATAS/BARIS ATAS
        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A1', 'Kode')
        ->setCellValue('B1', 'Kategori')
        ->setCellValue('C1', 'Jenis Peralatan');

        // MEMBUAT ISI BARIS
        $i=2; foreach($inventaris as $inventaris) {

        $spreadsheet->setActiveSheetIndex(0)
        ->setCellValue('A'.$i, $inventaris['kode'])
        ->setCellValue('B'.$i, $inventaris['kategori'])
        ->setCellValue('C'.$i, $inventaris['jenis_peralatan']);
        $i++;
        }

        // PENGATURAN LAINNYA
        $spreadsheet->setActiveSheetIndex(0);
        $spreadsheet->getSheetByName('Sheet 1');
        $spreadsheet->getActiveSheet()->mergeCells('A2:A4');
        $spreadsheet->getActiveSheet()->getStyle('A2:A4')->getAlignment()->setWrapText(true);

        // Redirect output to a client’s web browser (Xlsx)
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="Laporan Inventaris.xlsx"');
        header('Cache-Control: max-age=0');
        // If you're serving to IE 9, then the following may be needed
        header('Cache-Control: max-age=1');

        // If you're serving to IE over SSL, then the following may be needed
        // header('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
        header('Last-Modified: ' . gmdate('D, d M Y H:i:s') . ' GMT'); // always modified
        header('Cache-Control: cache, must-revalidate'); // HTTP/1.1
        header('Pragma: public'); // HTTP/1.0

        $writer = IOFactory::createWriter($spreadsheet, 'Xlsx');
        $writer->save('php://output');
        exit;
    }
}