<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
 *  ==============================================================================
 *  Author  : Usman Sher
 *  Email   : uskhan099@gmail.com
 *  For     : PHP QR Code
 *  Web     : http://phpqrcode.sourceforge.net
 *  License : open source (LGPL)
 *  ==============================================================================
 */

use PHPQRCode\QRcode;

class Wf_qrcode
{

    public function generate($params = array()) {
        $params['data'] = (isset($params['data'])) ? $params['data'] : 'http://otsglobal.org';
        QRcode::png($params['data'], $params['savename'], 'H', 2, 0);
        return $params['savename'];
    }

}
