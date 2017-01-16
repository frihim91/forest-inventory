<?php

defined('BASEPATH') OR exit('No direct script access allowed');

/*
 * @category   FrontPortal
 * @package    Portal
 * @author     Rokibuzzaman <rokibuzzaman@atilimited.net>
 * @copyright  2017 ATI Limited Development Group
 */

class Portal extends CI_Controller
{
    /*
     * @methodName index()
     * @access public
     * @param  none
     * @return Fao portal home page
     */

    public function index()
    {
        $this->template->display_portal();
    }


}
