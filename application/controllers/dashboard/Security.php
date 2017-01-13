    <?php


     /**
         
         * @package CodeIgniter
         * @author  Md.Rokibuzzaman
         
      */

    defined('BASEPATH') OR exit('No direct script access allowed');

     /**
         * Security Class
         *
         * Parses URIs and determines routing
         *
         * @package     CodeIgniter
         * @subpackage  Controller
         * @category    Controller
         * @author      Md.Rokibuzzaman
         *
         */

    class Security extends CI_Controller {

          /**
             * CI_Controller class object
             *
             * @var object
             */


        function __construct() {

             /**
             * Class constructor
             *
             * Runs the auth function.
             * Create a new authentication controller instance.
             * @return  void
             */
            parent::__construct();
            $this->user_session = $this->session->userdata('user_logged_in');
            if (!$this->user_session) {
                redirect('dashboard/auth/index');
            }
        }

    /**
     * Modules view page
     * Show all modules in datatable
     */

        public function modules() {
            //$this->session->set_flashdata('Success', 'Successed');
            $data["breadcrumbs"] = array(
                "Security" => "dashboard/security/modules",
                "All Modules" => '#'
            );
            $data['pageTitle'] = "Modules";
            $data["modules"] = $this->utilities->findAllFromView("ati_modules");
            $this->form_validation->set_rules('txtModuleName', 'Module Name', 'required');
            if ($this->form_validation->run() == TRUE) {
                $module = array(
                    'MODULE_NAME' => $this->input->post('txtModuleName')
                );
                $query = $this->utilities->insertData($module, 'ATI_MODULES');
                if ($query == TRUE) {
                    $this->session->set_flashdata('flashMessage', 'Module Created Successfully');
                    redirect('dashboard/security/modules', 'refresh');
                }
            }
            $data['content_view_page'] = 'security/modules';
            $this->template->display($data);
        }

    /**
     * Module Link create form
     * Show all Module Link 
     */

        public function createModuleLink() {
            $data["breadcrumbs"] = array(
                "Security" => "dashboard/security/createModuleLink",
                "All Module Links" => '#'
            );
            $data['pageTitle'] = "Module Links";
            $data['content_title'] = "Module Links";
            $data['all_modules'] = $this->utilities->moduleLinks();
            $this->form_validation->set_rules('txtmoduleId', 'Module', 'required');
            $this->form_validation->set_rules('txtLinkName', 'Module Link Name', 'required');
            $this->form_validation->set_rules('txtModLink', 'Module URL', 'required');

            if ($this->form_validation->run() == FALSE) {
                $data['content_view_page'] = 'security/module_links';
            } else {
                $pages = implode(",", $this->input->post('chkpages'));
                $page = $this->input->post('chkpages');
                $modulelink = array(
                    'MODULE_ID' => $this->input->post('txtmoduleId'),
                    'LINK_NAME' => str_replace("'", "''", $this->input->post("txtLinkName")),
                    'URL_URI' => str_replace("'", "''", $this->input->post("txtModLink")),
                    'ATI_MLINK_PAGES' => "$pages",
                    'CREATE' => (array_key_exists(0, $page)) ? 1 : 0,
                    'READ' => (array_key_exists(1, $page)) ? 1 : 0,
                    'UPDATE' => (array_key_exists(2, $page)) ? 1 : 0,
                    'DELETE' => (array_key_exists(3, $page)) ? 1 : 0,
                    'STATUS' => (array_key_exists(4, $page)) ? 1 : 0
                );
                $query = $this->utilities->insertData($modulelink, 'ATI_MODULE_LINKS');
                if ($query == TRUE) {
                    $this->session->set_flashdata('flashMessage', 'Module Link Created Successfully');
                    redirect('dashboard/security/createModuleLink', 'refresh');
                }
            }
            $this->template->display($data);
        }

    }
