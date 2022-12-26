<?php
defined('BASEPATH') OR exit('No direct script access allowed');
require_once APPPATH.'core/Seller_Controller.php';
class Categories extends Seller_Controller {
 	public function __construct()
	{
		parent::__construct();
		$this->load->helper('url');
		$this->load->model('categories_model');
		$this->load->library('excel');
		 
	}
	public function index()
	{
		$this->data['title'] = $this->data['config']->company_name;  
		$this->data['keywords'] = $this->data['config']->description;   
		$this->data['description'] = $this->data['config']->keywords;   
		$this->data['content'] = 'home/index';   
		$this->load->view('layouts/page',$this->data); 
	} 

	public function getCatByParentId(){
      	$response_data = array();
      	$category = $this->input->get('category');
            $category1 = $this->input->get('category1');
      	if(!empty($category) && $category1 == null){
      		$where = array("parent_id" => $category);
      	}
        if(!empty($category) && !empty($category1) && $category1 > 0){
  			$where = array("parent_id" => $category1);
      	}
      	$data = array();
      	$data = $this->categories_model->getCatByParentId($where);
      	$response_data['status'] = true;
      	$response_data['msg'] = "";
      	$response_data['data'] = $data;
      	echo json_encode($response_data);
	}
	   
	public function export()
	{
		$excel = new PHPExcel();

		$excel->getProperties()->setCreator('Blanjaque')
					->setLastModifiedBy('Blanjaque')
					->setTitle("Data Kategori")
					->setSubject("Kategori")
					->setDescription("Semua Data Kategori")
					->setKeywords("Data Kategori");

		$style_col = array(
			'font' => array('bold' => true),
			'alignment' => array(
				'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, 
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) 
			)
		);

		$style_row = array(
			'alignment' => array(
				'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER 
			),
			'borders' => array(
				'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), 
				'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),
				'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) 
			)
		);
		$excel->setActiveSheetIndex(0)->setCellValue('A1', "DATA Kategori"); 
		$excel->getActiveSheet()->mergeCells('A1:B1'); 
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); 
		$excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); 
		$excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); 
		
		$excel->setActiveSheetIndex(0)->setCellValue('A3', "Kategori"); 
		$excel->setActiveSheetIndex(0)->setCellValue('B3', "Kode"); 

		$excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
		$excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
			
		$kategori = $this->categories_model->getSubSubKategori([]);
		$numrow = 4; 
		foreach($kategori as $data){ 
			if($data->cat_id != 1){
				$excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $data->cat_name);
				$excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $data->cat_id);
				
				$excel->getActiveSheet()->getStyle('A'.$numrow)->applyFromArray($style_row);
				$excel->getActiveSheet()->getStyle('B'.$numrow)->applyFromArray($style_row);
				
				$numrow++;
			}
		}

		$excel->getActiveSheet()->getColumnDimension('A')->setWidth(25); 
		$excel->getActiveSheet()->getColumnDimension('B')->setWidth(15); 
		
		$excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
		
		$excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
		
		$excel->getActiveSheet(0)->setTitle("Data Kategori");
		$excel->setActiveSheetIndex(0);

		header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
		header('Content-Disposition: attachment; filename="Data Kategori.xlsx"');
		header('Cache-Control: max-age=0');
		$write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
		$write->save('php://output');
	}

}