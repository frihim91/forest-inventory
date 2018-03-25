<?php
defined('BASEPATH') OR exit('No direct script access allowed');
class LanguageLoader
{
    public function initialize() {
        $this->CI = & get_instance();
        
        if (!isset($this->CI->session)) {           //Check if session lib is loaded or not
            $this->CI->load->library('session');    //If not loaded, then load it here
        }
        $site_lang = $this->CI->session->userdata('site_lang');

        switch ($site_lang) {
            case "bangla":
                $this->CI->lang->load('bn_admin', $site_lang);
                break;
            case "english":
                $this->CI->lang->load('en_admin', 'english');
                break;
            default:
                $this->CI->lang->load('en_admin', 'english');
        }


    }

}