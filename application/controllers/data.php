<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @category   FrontData
 * @package    data
 * @author     Md.Reazul Islam <reazul@atilimited.net>
 * @copyright  2017 ATI Limited Development Group
 */

class Data extends CI_Controller
{
    
    function __construct()
    {
      
        parent::__construct();
        //echo "<pre>"; print_r($_SESSION);exit();
        if(!isset($_SESSION['user_logged']))
        {
          redirect('/');
        }
        $this->load->model('utilities');
        $this->load->model('setup_model');
        $this->load->model('Menu_model');
        $this->load->model('Forestdata_model');
        $this->load->helper(array(
            'html',
            
            'form'
        ));
        $this->load->library('form_validation');
        $this->load->library('upload');
        $this->load->helper('url');
        $this->load->library("pagination");
    }
     
    /*
     * @methodName speciesData()
     * @access public
     * @param  none
     * @return Species List page
     */
    
    public function speciesData()
    {
        $data['family_details']    = $this->db->query("select f.ID_Family,f.Family,(SELECT COUNT(ID_Genus) from genus WHERE ID_Family=f.ID_Family) as GENUSCOUNT,(SELECT COUNT(ID_Species)
            FROM species as s WHERE s.ID_Family=f.ID_Family) as SPECIESCOUNT from family as f ORDER BY f.Family 
            ")->result();
        $data['content_view_page'] = 'portal/speciesData';
        $this->template->display_portal($data);
    }
    
    
    
    public function allometricEquationView()
    {
        
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() .  "index.php/portal/allometricEquationView";
        $total_ef           = $this->db->count_all("ae");
        
        $config["total_rows"] = $total_ef;
        // $config["total_rows"] = 800;
        
        $config["per_page"]        = 20;
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $limit                     = $config["per_page"];
        $config["uri_segment"] = 3;
        //$config["num_links"] = round($total_ef );
        //pagination style start
        $config['full_tag_open']   = '<ul class="pagination">';
        $config['full_tag_close']  = '</ul>';
        $config['prev_link']       = '&lt;';
        $config['prev_tag_open']   = '<li>';
        $config['prev_tag_close']  = '</li>';
        $config['next_link']       = '&gt;';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        $config['cur_tag_open']    = '<li class="current"><a href="#">';
        $config['cur_tag_close']   = '</a></li>';
        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';
        $config['first_link']      = 'First';
        $config['last_link']       = 'Last';
        // //pagination style end
        $this->pagination->initialize($config);
        $data['allometricEquationView'] = $this->Forestdata_model->get_allometric_equation_grid($limit,$page);
        $data["links"]                  = $this->pagination->create_links();
        $data['content_view_page']      = 'portal/allometricEquationPage';
        $this->template->display_portal($data);
    }

      /*
     * @methodName biomassExpansionFacView()
     * @access public
     * @param  none
     * @return Biomass Expension Factor Menu page
     */
    
    
    public function biomassExpansionFacView()
    {
        
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() .  "index.php/portal/biomassExpansionFacView";
        $total_ef           = $this->db->count_all("ef");
        
        $config["total_rows"] = $total_ef;
        // $config["total_rows"] = 800;
        
        $config["per_page"]        = 20;
        //$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $limit                     = $config["per_page"] = 20;
        $config["uri_segment"] = 3;
        //$config["num_links"] = round($total_ef );
        //pagination style start
        $config['full_tag_open']   = '<ul class="pagination">';
        $config['full_tag_close']  = '</ul>';
        $config['prev_link']       = '&lt;';
        $config['prev_tag_open']   = '<li>';
        $config['prev_tag_close']  = '</li>';
        $config['next_link']       = '&gt;';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        $config['cur_tag_open']    = '<li class="current"><a href="#">';
        $config['cur_tag_close']   = '</a></li>';
        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';
        $config['first_link']      = 'First';
        $config['last_link']       = 'Last';
        // //pagination style end
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        
        // ")->result();
         $data['biomassExpansionFacView'] = $this->Forestdata_model->get_biomas_expension_factor($limit,$page);
        $data["links"]                  = $this->pagination->create_links();
        $data['content_view_page']      = 'portal/biomassExpansionFacView';
        $this->template->display_portal($data);
    }
    
    /*
     * @methodName rawDataView()
     * @access public
     * @param  none
     * @return Raw Data Menu page
     */
    
    public function rawDataView()
    {
        
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() . "index.php/portal/rawDataView";
        $total_rawData      = $this->db->count_all("rd");
        
        $config["total_rows"] = $total_rawData;
        // $config["total_rows"] = 800;
        
        $config["per_page"]        = 20;
        $config["uri_segment"]     = 3;
        $limit                     = $config["per_page"] = 20;
        //pagination style start
        $config['full_tag_open']   = '<ul class="pagination">';
        $config['full_tag_close']  = '</ul>';
        $config['prev_link']       = '&lt;';
        $config['prev_tag_open']   = '<li>';
        $config['prev_tag_close']  = '</li>';
        $config['next_link']       = '&gt;';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        $config['cur_tag_open']    = '<li class="current"><a href="#">';
        $config['cur_tag_close']   = '</a></li>';
        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';
        $config['first_link']      = 'First';
        $config['last_link']       = 'Last';
        //pagination style end
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        $data['rawDataView'] = $this->Forestdata_model->get_raw_data_grid($limit,$page);
        $data["links"]             = $this->pagination->create_links();
        $data['content_view_page'] = 'portal/rawDataView';
        $this->template->display_portal($data);
    }

    /*
     * @methodName woodDensitiesView()
     * @access public
     * @param  none
     * @return wood densities Menu page
     */
    
    public function woodDensitiesView()
    {
        
        $this->load->library('pagination');
        $config             = array();
        $config["base_url"] = base_url() . "index.php/portal/woodDensitiesView";
        $total_woodDensities      = $this->db->count_all("wd");
        
        $config["total_rows"] = $total_woodDensities;
        // $config["total_rows"] = 800;
        
        $config["per_page"]        = 20;
        $config["uri_segment"]     = 3;
        $limit                     = 20;
        //pagination style start
        $config['full_tag_open']   = '<ul class="pagination">';
        $config['full_tag_close']  = '</ul>';
        $config['prev_link']       = '&lt;';
        $config['prev_tag_open']   = '<li>';
        $config['prev_tag_close']  = '</li>';
        $config['next_link']       = '&gt;';
        $config['next_tag_open']   = '<li>';
        $config['next_tag_close']  = '</li>';
        $config['cur_tag_open']    = '<li class="current"><a href="#">';
        $config['cur_tag_close']   = '</a></li>';
        $config['num_tag_open']    = '<li>';
        $config['num_tag_close']   = '</li>';
        $config['first_tag_open']  = '<li>';
        $config['first_tag_close'] = '</li>';
        $config['last_tag_open']   = '<li>';
        $config['last_tag_close']  = '</li>';
        $config['first_link']      = 'First';
        $config['last_link']       = 'Last';
        //pagination style end
        $this->pagination->initialize($config);
        $page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
     
        $data['woodDensitiesView'] = $this->Forestdata_model->get_wood_densities_grid($limit,$page);
        $data["links"]             = $this->pagination->create_links();
        $data['content_view_page'] = 'portal/woodDensitiesView';
        $this->template->display_portal($data);
    }






    
    
    
    
    
    
    
    




    
    
    
    
}
