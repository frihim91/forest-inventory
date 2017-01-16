<?php

class Template_Portal {

    protected $_ci;

    function __construct() {

        $this->_ci = &get_instance();
    }

    function display($data = null) {
        $data['pageContentTitle'] = ((isset($data['pageTitle']) == '') ? ' ' : $data['pageTitle']);
        $data['pageTitle'] = 'Online University Management System' . ((isset($data['pageTitle']) == '') ? ' ' : ' || ' . $data['pageTitle']);
        $data['breadcrumbs'] = ((isset($data['breadcrumbs']) == '') ? array() : $data['breadcrumbs']);
        $data['_content'] = $this->_ci->load->view((isset($data['content_view_page']) == '') ? 'portal/template/content' : $data['content_view_page'], $data, true);
        
        
        $data['_bottom_effect'] = '' . (((isset($data['bottom_effect']) == '') ? ' ' : '' . $data['bottom_effect']));
        $data['_slider'] = '' . (((isset($data['slider']) == '') ? ' ' : '' . $data['slider']));
        
        
        $this->_ci->load->view('portal/template.php', $data);
    }

}

?>