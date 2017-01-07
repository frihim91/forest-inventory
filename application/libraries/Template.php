<?php

class Template {

    protected $_ci;

    function __construct() {

        $this->_ci = &get_instance();
    }

    function display($data = null) {
        $data['pageContentTitle'] = ((isset($data['pageTitle']) == '') ? ' ' : $data['pageTitle']);
        $data['pageTitle'] = '.: FAO || Food and Agriculture Organization of the United Nations:. Login Panel:.' . ((isset($data['pageTitle']) == '') ? ' ' : ' || ' . $data['pageTitle']);
        //$data['breadcrumbs'] = ((isset($data['breadcrumbs']) == '') ? array() : $data['breadcrumbs']);
        $data['_content'] = $this->_ci->load->view((isset($data['content_view_page']) == '') ? 'template/content' : $data['content_view_page'], $data, true);
        $this->_ci->load->view('template.php', $data);
    }

}

?>