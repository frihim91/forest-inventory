<?php

    /**
     
     * @package Admin Panel
     * @author     Rokibuzzaman <rokibuzzaman@atilimited.net>
     * @copyright  2017 ATI Limited Development Group
     
    */

    if (!defined('BASEPATH')) {
        exit('No direct script access allowed');


     /**
     * Website Class
     *
     * Parses URIs and determines routing
     *
     * @package     Admin Panel
     * @subpackage  Admin Panel
     * @category    Admin Panel
     * @author      Rokibuzzaman <rokibuzzaman@atilimited.net>
     *
     */

 }

 class ForestData extends CI_Controller {

    function __construct() {
        parent::__construct();
        $this->user_session = $this->session->userdata('user_logged_in');
        if (!$this->user_session) {
            redirect('dashboard/auth/index');
        }
        $this->load->library("form_validation");
        $this->load->model('utilities');
        $this->load->model('Forestdata_model');
        $this->load->library('upload');
        $this->load->library('csvimport');
        $this->load->helper(array('html', 

        'form'));
        $this->load->model('setup_model');
    }



      function uploadForestData88() {
      $tableName =$this->input->post("table_name");
      $tableCoulmn =  $this->db->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tableName'")->result();
      $sourcePath = $_FILES['userfile']['tmp_name']; 
      $temporary = explode(".", $_FILES["userfile"]["name"]);
      $file_extension = end($temporary);
      $targetPath = "resources/uploads/".$_FILES['userfile']['name']; 
      $fileRename = $this->fileRename();
      $succes=move_uploaded_file($sourcePath, "resources/uploads/".$fileRename.".".$file_extension);
          if (!$succes) {
             $data['error'] = $this->upload->display_errors();
 
             $data['content_view_page'] = 'setup/forestData/upload_data';
            $this->template->display($data);
        } else {
            
            $filePath = "resources/uploads/".$fileRename.".".$file_extension;

            //echo $filePath; exit;
            if ($this->csvimport->get_array($filePath)) {
                $csv_array = $this->csvimport->get_array($filePath);

                /*echo '<pre>';
                print_r($csv_array); exit;*/
                foreach ($csv_array as $key =>$row) {
                    $insert_data = array();
                    for ($i=0; $i < sizeof($tableCoulmn); $i++) { 
                        $col    = $tableCoulmn[$i]->COLUMN_NAME;
                        $data   = $row[$col];
                        $insert_data[$col] =  $data ; 
                    } 
                    
                $this->Menu_model->insert_csv($insert_data, $tableName);
                }
                $this->session->set_flashdata('success', 'Csv Data Imported Succesfully');
                 redirect('dashboard/Website/uploadForestData', 'refresh');
                //echo "<pre>"; print_r($insert_data);
            } else 
                $data['error'] = "Error occured";
                $data['content_view_page'] = 'setup/forestData/upload_data';
                    $this->template->display($data);
            }
 
        } 


        function uploadForestData()
           {
          if($_POST){
          $sourcePath = $_FILES['userfile']['tmp_name']; 
          $tableName =$this->input->post("table_name");
          $tableCoulmn =  $this->db->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tableName'")->result();
          $temporary = explode(".", $_FILES["userfile"]["name"]);
          $file_extension = end($temporary);
          $targetPath = "resources/uploads/".$_FILES['userfile']['name']; 
          $fileRename = $this->fileRename();
          $succes=move_uploaded_file($sourcePath, "resources/uploads/".$fileRename.".".$file_extension);
              if (!$succes) {

                if(!$_FILES['userfile']['tmp_name']):
                $this->session->set_flashdata('Error', 'Csv Data not Imported Succesfully');
                     redirect('dashboard/ForestData/uploadForestData', 'refresh');
     
                 $data['content_view_page'] = 'setup/forestData/upload_data';
                $this->template->display($data);
                endif;
            }else{
                
                $filePath = "resources/uploads/".$fileRename.".".$file_extension;
              if ($this->csvimport->get_array($filePath)) {
                    $csv_array = $this->csvimport->get_array($filePath);

                    foreach ($csv_array as $key =>$row) {
                        $insert_data = array();
                        for ($i=0; $i < sizeof($tableCoulmn); $i++) { 
                            $col    = $tableCoulmn[$i]->COLUMN_NAME;
                            $data   = $row[$col];
                            $insert_data[$col] =  $data ; 
                        } 
                        
                      $this->Forestdata_model->insert_csv($insert_data, $tableName);
                      
                    
                    }
                     
                     $this->session->set_flashdata('Success', 'Csv Data Imported Succesfully');
                     redirect('dashboard/ForestData/uploadForestData', 'refresh');
                 }else 
                    if(!$_FILES['userfile']['tmp_name']):
                    $data['error'] = "Error occured";
                    $data['content_view_page'] = 'setup/forestData/upload_data';
                    $this->template->display($data);
                    endif;    
                }
            }else{
               $data['content_view_page'] = 'setup/forestData/upload_data';
                $this->template->display($data);
            }
     
            } 


        function fileRename(){
            $date = new DateTime();
            $name = $date->format('YmdHis');
            Return $name;
        }



     /**
      * Show all Species in datatable
      
      
     */

        public function speciesSetup() 
        {
            $data["breadcrumbs"] = array(
                "Species" => "dashboard/ForestData/speciesSetup",
                );
            $data['pageTitle'] = "All Species List";
            $data['all_family'] = $this->utilities->findAllFromView("fd_family");
            $data['all_genus'] = $this->utilities->findAllFromView("fd_genus");
            $data['all_species'] = $this->utilities->findAllFromView("fd_species_dataset");
            $data['content_view_page'] = 'setup/species/all_species';
            $this->template->display($data);
         }

 







            }
