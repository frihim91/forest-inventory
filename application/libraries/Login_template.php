<?php

class Login_template {

    protected $_ci;

    function __construct() {

        $this->_ci = &get_instance();
    }

    function display($data = null) {
        $data['pageTitle'] = (isset($data['pageTitle']) == '') ? 'Login Template' : $data['pageTitle'];
        $data['_content'] = $this->_ci->load->view((isset($data['content_view_page']) == '') ? 'login/content' : $data['content_view_page'], $data, true);
        $this->_ci->load->view('login_template.php', $data);
    }

}

?>