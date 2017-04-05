<?php

/**

* @package Admin Panel
* @author     Rokibuzzaman <rokibuzzaman@atilimited.net>
* @copyright  2017 ATI Limited Development Group

*/

if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
    
    
    /**
     * ForestData Class
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

class ForestData extends CI_Controller
{
    
    function __construct()
    {
        parent::__construct();
        $this->user_session = $this->session->userdata('user_logged_in');
        if (!$this->user_session) {
            redirect('dashboard/auth/index');
        }
        $this->load->library("form_validation");
        $this->load->model('utilities');
        $this->load->model('Menu_model');
        $this->load->model('Forestdata_model');
        $this->load->library('upload');
        $this->load->library('Csvimport');
        $this->load->helper(array(
            'html',
            
            'form'
        ));
        $this->load->model('setup_model');
    }
    
    
    
    function uploadForestData88()
    {
        $tableName      = $this->input->post("table_name");
        $tableCoulmn    = $this->db->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tableName'")->result();
        $sourcePath     = $_FILES['userfile']['tmp_name'];
        $temporary      = explode(".", $_FILES["userfile"]["name"]);
        $file_extension = end($temporary);
        $targetPath     = "resources/uploads/" . $_FILES['userfile']['name'];
        $fileRename     = $this->fileRename();
        $succes         = move_uploaded_file($sourcePath, "resources/uploads/" . $fileRename . "." . $file_extension);
        if (!$succes) {
            $data['error'] = $this->upload->display_errors();
            
            $data['content_view_page'] = 'setup/forestData/upload_data';
            $this->template->display($data);
        } else {
            
            $filePath = "resources/uploads/" . $fileRename . "." . $file_extension;
            
            //echo $filePath; exit;
            if ($this->csvimport->get_array($filePath)) {
                $csv_array = $this->csvimport->get_array($filePath);
                
                /*echo '<pre>';
                print_r($csv_array); exit;*/
                foreach ($csv_array as $key => $row) {
                    $insert_data = array();
                    for ($i = 0; $i < sizeof($tableCoulmn); $i++) {
                        $col               = $tableCoulmn[$i]->COLUMN_NAME;
                        $data              = $row[$col];
                        $insert_data[$col] = $data;
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
        if ($_POST) {
            $sourcePath     = $_FILES['userfile']['tmp_name'];
            $tableName      = $this->input->post("table_name");
            $tableCoulmn    = $this->db->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE TABLE_NAME = '$tableName'")->result();
            $temporary      = explode(".", $_FILES["userfile"]["name"]);
            $file_extension = end($temporary);
            $targetPath     = "resources/uploads/" . $_FILES['userfile']['name'];
            $fileRename     = $this->fileRename();
            $succes         = move_uploaded_file($sourcePath, "resources/uploads/" . $fileRename . "." . $file_extension);
            if (!$succes) {
                
                if (!$_FILES['userfile']['tmp_name']):
                    $this->session->set_flashdata('Error', 'Csv Data not Imported Succesfully');
                    redirect('dashboard/ForestData/uploadForestData', 'refresh');
                    
                    $data['content_view_page'] = 'setup/forestData/upload_data';
                    $this->template->display($data);
                endif;
            } else {
                
                $filePath = "resources/uploads/" . $fileRename . "." . $file_extension;
                if ($this->csvimport->get_array($filePath)) {
                    $csv_array = $this->csvimport->get_array($filePath);
                    
                    foreach ($csv_array as $key => $row) {
                        $insert_data = array();
                        for ($i = 0; $i < sizeof($tableCoulmn); $i++) {
                            $col               = $tableCoulmn[$i]->COLUMN_NAME;
                            $data              = $row[$col];
                            $insert_data[$col] = $data;
                        }
                        
                        $this->Forestdata_model->insert_csv($insert_data, $tableName);
                        
                        
                    }
                    
                    $this->session->set_flashdata('Success', 'Csv Data Imported Succesfully');
                    redirect('dashboard/ForestData/uploadForestData', 'refresh');
                } else
                    if (!$_FILES['userfile']['tmp_name']):
                        $data['error']             = "Error occured";
                        $data['content_view_page'] = 'setup/forestData/upload_data';
                        $this->template->display($data);
                    endif;
            }
        } else {
            $data['content_view_page'] = 'setup/forestData/upload_data';
            $this->template->display($data);
        }
        
    }
    
    
    function fileRename()
    {
        $date = new DateTime();
        $name = $date->format('YmdHis');
        Return $name;
    }
    
    
    
    /**
     * Show all Species in datatable
     
     
     */
    
    public function speciesSetup()
    {
        $data["breadcrumbs"]       = array(
            "Species" => "dashboard/ForestData/speciesSetup"
        );
        $data['pageTitle']         = "All Species List";
        $data['all_family']        = $this->db->query("SELECT * from family f
            order by f.ID_Family desc")->result();
        $data['all_genus']         = $this->db->query("SELECT * from genus g
            order by g.ID_Genus desc")->result();
        $data['all_species']       = $this->db->query("SELECT s.*,g.*,f.* from species s
            LEFT JOIN genus g ON s.ID_Genus =g.ID_Genus
            LEFT JOIN family f ON s.ID_Family =f.ID_Family
            order by s.ID_Species desc")->result();
        $data['all_faobiomes']     = $this->db->query("SELECT * from faobiomes bio
            order by bio.ID_FAOBiomes desc")->result();
        $data['content_view_page'] = 'setup/species/all_species';
        $this->template->display($data);
    }
    
    
    
    /*
     * @methodName createFamily()
     * @access public
     * @param  none
     * @return add Family page
     */
    public function createFamily()
    {
        $family = array(
            'Family' => $this->input->post('Family')
        );
        if ($this->utilities->insertData($family, 'family')) {
            $this->session->set_flashdata('Success', 'New Family Added Successfully.');
            redirect('dashboard/ForestData/speciesSetup');
        }
    }
    
    
    /*
     * @methodName deleteFamily()
     * @access public
     * @param  $id
     * @return delete Family 
     */
    
    
    public function deleteFamily($id)
    {
        
        $attr = array(
            "ID_Family" => $id
        );
        //return $this->utilities->deleteRowByAttribute("family", $attr);
        if ($this->utilities->deleteRowByAttribute("family", $attr)) {
            $this->session->set_flashdata('Error', ' Family Deleted Successfully.');
        } else {
            $this->session->set_flashdata('Error', 'Family Not Deleted Successfull.');
        }
        
    }
    
    
    
    
    
    /*
     * @methodName createGenus()
     * @access public
     * @param  none
     * @return add Genus page
     */
    public function createGenus()
    {
        $genus = array(
            'ID_Family' => $this->input->post('ID_Family'),
            'Genus' => $this->input->post('Genus')
        );
        if ($this->utilities->insertData($genus, 'genus')) {
            $this->session->set_flashdata('Success', 'New Genus Added Successfully.');
            redirect('dashboard/ForestData/speciesSetup');
        }
    }
    
    
    
    /*
     * @methodName deleteGenus()
     * @access public
     * @param  $id
     * @return delete Genus 
     */
    
    
    public function deleteGenus($id)
    {
        
        $attr = array(
            "ID_Genus" => $id
        );
        //return $this->utilities->deleteRowByAttribute("genus", $attr);
        if ($this->utilities->deleteRowByAttribute("genus", $attr)) {
            $this->session->set_flashdata('Error', ' Genus Deleted Successfully.');
        } else {
            $this->session->set_flashdata('Error', 'Genus Not Deleted Successfull.');
        }
        
    }
    
    /*
     * @methodName createSpecies()
     * @access public
     * @param  none
     * @return add Species page
     */
    public function createSpecies()
    {
        $species = array(
            'ID_Family' => $this->input->post('ID_Family'),
            'ID_Genus' => $this->input->post('ID_Genus'),
            'Species' => $this->input->post('Species')
        );
        if ($this->utilities->insertData($species, 'species')) {
            $this->session->set_flashdata('Success', 'New Species Added Successfully.');
            redirect('dashboard/ForestData/speciesSetup');
        }
    }
    
    
    /*
     * @methodName deleteSpecies()
     * @access public
     * @param  $id
     * @return delete Species 
     */
    
    
    public function deleteSpecies($id)
    {
        
        $attr = array(
            "ID_Species" => $id
        );
        //return $this->utilities->deleteRowByAttribute("species", $attr);
        if ($this->utilities->deleteRowByAttribute("species", $attr)) {
            $this->session->set_flashdata('Error', ' Species Deleted Successfully.');
        } else {
            $this->session->set_flashdata('Error', 'Species Not Deleted Successfull.');
        }
        
    }
    
    
    /*
     * @methodName createFAOBiomes()
     * @access public
     * @param  none
     * @return add FAOBiomes page
     */
    public function createFAOBiomes()
    {
        $faobiomes = array(
            'FAOBiomes' => $this->input->post('FAOBiomes')
        );
        if ($this->utilities->insertData($faobiomes, 'faobiomes')) {
            $this->session->set_flashdata('Success', 'New FAOBiomes Added Successfully.');
            redirect('dashboard/ForestData/speciesSetup');
        }
    }
    
    
    
    /*
     * @methodName deleteFAOBiomes()
     * @access public
     * @param  $id
     * @return delete FAOBiomes 
     */
    
    
    public function deleteFAOBiomes($id)
    {
        
        $attr = array(
            "ID_FAOBiomes" => $id
        );
        //return $this->utilities->deleteRowByAttribute("ef", $attr);
        if ($this->utilities->deleteRowByAttribute("faobiomes", $attr)) {
            $this->session->set_flashdata('Error', ' FAOBiomes Deleted Successfully.');
        } else {
            $this->session->set_flashdata('Error', 'FAOBiomes Deleted Successfull.');
        }
        
    }
    
    
    
    /*
     * @methodName deleteFAOBiomes()
     * @access public
     * @param  $id
     * @return delete FAOBiomes 
     */
    
    
    public function deleteEfData($id)
    {
        
        $attr = array(
            "ID_EF" => $id
        );
        //return $this->utilities->deleteRowByAttribute("ef", $attr);
        if ($this->utilities->deleteRowByAttribute("ef", $attr)) {
            $this->session->set_flashdata('Error', ' EF Data Deleted Successfully.');
        } else {
            $this->session->set_flashdata('Error', 'EF Data Not Deleted Successfull.');
        }
        
    }
    
    /**
     * Show all EF Data in datatable
     
     
     */
    
    public function all_ef_data()
    {
        
        $data["breadcrumbs"]       = array(
            "All EF Data" => "dashboard/ForestData/all_ef_data"
        );
        $data['pageTitle']         = "All EF Data ";
        $data['all_ef_data']       = $this->db->query("SELECT  e.*,l.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.*,ip.* from ef e
             LEFT JOIN ef_ipcc ip ON e.ID_EF_IPCC=ip.ID_EF_IPCC
             LEFT JOIN species s ON e.ID_Species=s.ID_Species
             LEFT JOIN family f ON s.ID_Family=f.ID_Family
             LEFT JOIN genus g ON f.ID_Family=g.ID_Family 
             LEFT JOIN reference r ON e.ID_Reference=r.ID_Reference
             LEFT JOIN location l ON e.ID_Location=l.ID_Location
             LEFT JOIN faobiomes b ON l.ID_FAOBiomes=b.ID_FAOBiomes
             LEFT JOIN division d ON l.ID_Division=d.ID_Division
             LEFT JOIN district dis ON l.ID_District =dis.ID_District
             LEFT JOIN zones zon ON l.ID_Zones =zon.ID_Zones
             Group BY e.ID_EF desc")->result();
        $data['content_view_page'] = 'setup/ForestData/all_ef_data';
        $this->template->display($data);
    }
    
    
    
    /*
     * @methodName createEFData()
     * @access public
     * @param  none
     * @return add EF Data page
     */
    public function createEFData()
    {
        
        $this->form_validation->set_rules('ID_Species', 'Species Name', 'required');
        
        if ($this->form_validation->run() == FALSE) {
            $data["breadcrumbs"]       = array(
                "ALL EF Data" => "dashboard/ForestData/all_ef_data",
                "Create EF Data" => "#"
            );
            $data['pageTitle']         = "Add EF Data";
            $data['content_view_page'] = 'setup/modules/create_module_link';
            $this->template->display($data);
        } else {
            
            if ($_POST) {
                $ID_VolumeRange = $this->input->post('ID_VolumeRange');
                $x              = explode(",", $ID_VolumeRange);
                $first_value    = $x[0];
                $second_value   = $x[1];
                
                $ID_HeightRange           = $this->input->post('ID_HeightRange');
                $h                        = explode(",", $ID_HeightRange);
                $first_value_HeightRange  = $h[0];
                $second_value_HeightRange = $h[1];
                
                
                $ID_AgeRange           = $this->input->post('ID_AgeRange');
                $a                     = explode(",", $ID_AgeRange);
                $first_value_AgeRange  = $a[0];
                $second_value_AgeRange = $a[1];
                
                $ID_BasalRange           = $this->input->post('ID_BasalRange');
                $b                       = explode(",", $ID_BasalRange);
                $first_value_BasalRange  = $b[0];
                $second_value_BasalRange = $b[1];
                
            }
            
            $ef = array(
                'EmissionFactor' => $this->input->post('EmissionFactor'),
                'ID_LandCover' => $this->input->post('ID_LandCover'),
                'ID_Species' => $this->input->post('ID_Species'),
                'ID_Species_new' => $this->input->post('ID_Species'),
                'ID_AgeRange' => $first_value_AgeRange,
                'AgeRange' => $second_value_AgeRange,
                'ID_HeightRange' => $first_value_HeightRange,
                'HeightRange' => $second_value_HeightRange,
                'ID_VolumeRange' => $first_value,
                'VolumeRange' => $second_value,
                'ID_BasalArea' => $first_value_BasalRange,
                'BasalRange' => $second_value_BasalRange,
                'Value' => $this->input->post('Value'),
                'Unit' => $this->input->post('Unit'),
                'ID_EF_IPCC' => $this->input->post('ID_EF_IPCC'),
                'ID_Reference' => $this->input->post('ID_Reference'),
                'Lower_Confidence_Limit' => $this->input->post('Lower_Confidence_Limit'),
                'Upper_Confidence_Limit' => $this->input->post('Upper_Confidence_Limit'),
                'Type_of_Parameter' => $this->input->post('Type_of_Parameter'),
                'ID_Location' => $this->input->post('ID_Location')
            );
            if ($this->utilities->insertData($ef, 'ef')) {
                $this->session->set_flashdata('Success', 'New EF Data Added Successfully.');
                
                
            } else {
                $this->session->set_flashdata('Error', 'Sorry ! You Already Added this Link Name .');
            }
            redirect('dashboard/ForestData/all_ef_data');
        }
    }
    
    
  
    
}
