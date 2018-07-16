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
    private function pr($data)
    {
        echo "<pre>";
        print_r($data);
        exit;
    }


    function uploadForestData()
    {
        if ($_POST) {
            ini_set('max_execution_time', 400);
            $dbName= $this->db->database;
            $sourcePath     = $_FILES['userfile']['tmp_name'];
            $tableName      = $this->input->post("table_name");
            $primaryKeyArray=$this->db->query("SELECT COLUMN_NAME FROM information_schema.`COLUMNS` C
                                          WHERE COLUMN_KEY='PRI' AND TABLE_NAME='$tableName'
                                          AND TABLE_SCHEMA='$dbName'
                                          limit 1;")->row();
            $primaryKey=$primaryKeyArray->COLUMN_NAME;
            $tableCoulmn    = $this->db->query("SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE
             TABLE_NAME = '$tableName' AND  TABLE_SCHEMA='$dbName'")->result();
            $temporary      = explode(".", $_FILES["userfile"]["name"]);
            //set_time_limit(500);
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
                    // echo '<pre>';
                    // print_r($csv_array);
                    //  exit;

                    foreach ($csv_array as $key => $row) {
                      $attr = array(
                          $primaryKey => $csv_array[$key][$primaryKey]
                      );
                      $this->utilities->deleteRowByAttribute($tableName, $attr);
                      //$this->pr($tableCoulmn);
                        $insert_data = array();
                        for ($i = 0; $i < sizeof($tableCoulmn); $i++) {
                            $col               = $tableCoulmn[$i]->COLUMN_NAME;
                            $data              = $row[$col];
                            $insert_data[$col] = $data;
                        }
                       // $this->pr($tableCoulmn);

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
         $data['all_bfizone']     = $this->db->query("SELECT * from zones zon
            order by zon.ID_Zones desc")->result();
           $data['all_bagrozone']     = $this->db->query("SELECT * from bd_aez1988 bag
            order by bag.MAJOR_AEZ desc")->result();
        $data['content_view_page'] = 'setup/species/all_species';
        $this->template->display($data);
    }



        public function groupData()
        {
            $data["breadcrumbs"]        = array(
                "Group Data" => "dashboard/ForestData/groupData"
            );
            $data['pageTitle']          = "All Group Data List";
            $data['all_group_location'] = $this->db->query("SELECT GROUP_CONCAT(l.location_name  SEPARATOR ', ') location_name,lg.group_id from group_location lg LEFT JOIN location l ON lg.location_id=l.ID_Location
                GROUP BY lg.group_id
                order by lg.group_id ASC")->result();
            $data['all_species_group']   = $this->db->query("SELECT group_concat(DISTINCT(s.Species))as Species,sg.Speciesgroup_ID from species_group sg
                LEFT JOIN species s ON sg.ID_Species=s.ID_Species 
                GROUP BY sg.Speciesgroup_ID 
                order by sg.Speciesgroup_ID ASC")->result();
            $data['content_view_page']   = 'setup/groupData/all_groupdata';
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



          public function documentList()
    {
        $data['document']           = $this->db->query("SELECT * FROM reference  r order by  r.ID_Reference desc")->result();
        $data['content_view_page'] = 'setup/documents/all_document';
        $this->template->display($data);
    }

        public function addDocuments()
    {
        if (isset($_POST['Title'])) {

            //$titles = count($this->input->post('title'));
            $Title    = $this->input->post('Title');
            $Reference    = $this->input->post('Reference');
            $Author    = $this->input->post('Author');
            $Year    = $this->input->post('Year');
            //$PDF_label    = $this->input->post('PDF_label');

            $config['upload_path']   = 'resources/pdf/';
            $config['allowed_types'] = 'jpg|jpeg|png|gif|pdf';
            $config['file_name']     = $_FILES['main_image']['name'];

            //Load upload library and initialize configuration
            $this->load->library('upload', $config);
            $this->upload->initialize($config);

            if ($this->upload->do_upload('main_image')) {
                $uploadData = $this->upload->data();
                $picture    = $uploadData['file_name'];
            } else {
                $picture = '';
            }
            $ext = explode('.',$picture);
            echo $ext[0];
            //exit;


            $data = array(
                'Title' => $Title,
                'Reference' => $Reference,
                'Author' => $Author,
                'Year' => $Year,
                'PDF_label' => $ext[0]

            );

            //$data['IMAGE_PATH'] = 'asdasdsad';

            $this->utilities->insertData($data, 'reference');
            $this->session->set_flashdata('Success', 'New Document Added Successfully.');
            redirect('dashboard/ForestData/documentList');
        }

        else {
            $data['content_view_page'] = 'setup/documents/addDocuments';
            $this->template->display($data);
        }
    }


       public function deleteDocuments($id)
    {

        $attr = array(
            "ID_Reference" => $id
        );
        //return $this->utilities->deleteRowByAttribute("family", $attr);
        if ($this->utilities->deleteRowByAttribute("reference", $attr)) {
            $this->session->set_flashdata('Error', ' Document Deleted Successfully.');
        } else {
            $this->session->set_flashdata('Error', 'Document Not Deleted Successfull.');
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


    public function deletebfiZones($id)
    {

        $attr = array(
            "ID_Zones" => $id
        );
        //return $this->utilities->deleteRowByAttribute("species", $attr);
        if ($this->utilities->deleteRowByAttribute("zones", $attr)) {
            $this->session->set_flashdata('Error', ' Zone Deleted Successfully.');
        } else {
            $this->session->set_flashdata('Error', 'Zone Not Deleted Successfull.');
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
     * @methodName createBfiZones()
     * @access public
     * @param  none
     * @return add BFI Zone page
     */
    public function createBfiZones()
    {
        $bfiZones = array(
            'Zones' => $this->input->post('bfiZones')
        );
        if ($this->utilities->insertData($bfiZones, 'zones')) {
            $this->session->set_flashdata('Success', 'New BFI Zone Added Successfully.');
            redirect('dashboard/ForestData/speciesSetup');
        }
    }



    /*
     * @methodName createBAgroZone()
     * @access public
     * @param  none
     * @return add Bangladesh Agroecological Zone page
     */
    public function createBAgroZone()
    {
        $bAgroZone = array(
            'AEZ_NAME' => $this->input->post('bAgroZone')
        );
        if ($this->utilities->insertData($bAgroZone, 'bd_aez1988')) {
            $this->session->set_flashdata('Success', 'New Bangladesh Agroecological Zone Added Successfully.');
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
     * @methodName deleteBAgroZone()
     * @access public
     * @param  $id
     * @return delete deleteBAgroZone
     */


    public function deleteBAgroZone($id)
    {

        $attr = array(
            "MAJOR_AEZ" => $id
        );
        //return $this->utilities->deleteRowByAttribute("ef", $attr);
        if ($this->utilities->deleteRowByAttribute("bd_aez1988", $attr)) {
            $this->session->set_flashdata('Error', 'Bangladesh Agroecological Zone Deleted Successfully.');
        } else {
            $this->session->set_flashdata('Error', 'Bangladesh Agroecological Zone Deleted Successfull.');
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
        $data['all_ef_data']       = $this->db->query("SELECT  e.*,eco.*,b.*,d.*,dis.*,zon.*,s.*,r.*,f.*,g.*,ip.* from ef e
             LEFT JOIN ef_ipcc ip ON e.ID_EF_IPCC=ip.ID_EF_IPCC
             LEFT JOIN species s ON e.Species=s.ID_Species
             LEFT JOIN family f ON s.ID_Family=f.ID_Family
             LEFT JOIN genus g ON f.ID_Family=g.ID_Family
             LEFT JOIN reference r ON e.Reference=r.ID_Reference
             LEFT JOIN faobiomes b ON e.FAO_biome=b.ID_FAOBiomes
             LEFT JOIN division d ON e.Division=d.ID_Division
             LEFT JOIN district dis ON e.District =dis.ID_District
             LEFT JOIN zones zon ON e.BFI_zone =zon.ID_Zones
             LEFT JOIN ecological_zones eco ON e.WWF_Eco_zone =eco.ID_1988EcoZones
             Group BY e.ID_EF desc")->result();
        $data['content_view_page'] = 'setup/forestData/all_ef_data';
        $this->template->display($data);
    }





     function ajax_get_division() {
        //$ID_Division = $_POST['Division'];
         $ID_Division = $this->input->post('Division');
         $divi             = explode(",", $ID_Division);
         $second_value_divi   = $divi[1];

        $query = $this->utilities->findAllByAttribute('district', array("DIVISION" => $second_value_divi));
        $returnVal = '<option value = "">Select one</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value = "' .$row->ID_District . ','. $row->District  . '">' . $row->District . '</option>';
            }
        }
        echo $returnVal;
    }

      function up_thana_by_dis_id() {
        $DISTNAME = $_POST['District'];
        $divi             = explode(",", $DISTNAME);
         $second_value_divi   = $divi[1];
        $query = $this->utilities->findAllByAttribute('upazilla', array("DISTNAME" => $second_value_divi));
        //var_dump($query);exit;
        $returnVal = '<option value = "">Select one</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value = "' .$row->UPZ_CODE_1. ','. $row->THANAME . '">' . $row->THANAME . '</option>';
            }
        }
        echo $returnVal;
    }


      function up_union_by_dis_id() {
        $THANAME = $_POST['THANAME'];
        $divi             = explode(",", $THANAME);
        $second_value_divi   = $divi[1];

        $query = $this->utilities->findAllByAttribute('union', array("THANAME" => $second_value_divi));
        $returnVal = '<option value = "">Select one</option>';
        if (!empty($query)) {
            foreach ($query as $row) {
                $returnVal .= '<option value = "' . $row->UNI_CODE_1 . '">' . $row->UNINAME . '</option>';
            }
        }
        echo $returnVal;
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


                $ID_Division = explode(",", $_POST['ID_Division']);
                $divi = $ID_Division[0];

                $ID_District = explode(",", $_POST['ID_District']);
                $dis = $ID_District[0];

                $UPZ_CODE_1 = explode(",", $_POST['UPZ_CODE_1']);
                $upazila = $UPZ_CODE_1[0];

                $UNI_CODE_1 = explode(",", $_POST['UNI_CODE_1']);
                $union = $UNI_CODE_1[0];




            }

            $ef = array(
                'EmissionFactor' => $this->input->post('EmissionFactor'),
                'longitude' => $this->input->post('longitude'),
                'latitude' => $this->input->post('latitude'),
                'ID_LandCover' => $this->input->post('ID_LandCover'),
                'Species' => $this->input->post('ID_Species'),
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
                'Reference' => $this->input->post('ID_Reference'),
                'Lower_Confidence_Limit' => $this->input->post('Lower_Confidence_Limit'),
                'Upper_Confidence_Limit' => $this->input->post('Upper_Confidence_Limit'),
                'Type_of_Parameter' => $this->input->post('Type_of_Parameter'),
                'Country' =>'Bangladesh',
                'Division' => $divi,
                'District' =>  $dis,
                'Upazila' =>  $upazila,
                'Union' =>  $union,
                'FAO_biome' => $this->input->post('ID_FAOBiomes'),
                'WWF_Eco_zone' => $this->input->post('ID_1988EcoZones'),
                'BFI_zone' => $this->input->post('ID_Zones')
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
