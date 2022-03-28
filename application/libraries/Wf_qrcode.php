<?php defined('BASEPATH') OR exit('No direct script access allowed');

/*
| ----------------------------------------------------------------------------
| PRODUCT NAME:  CELL PHONE & COMPUTER REPAIRING SHOP MANAGEMENT SYSTEM 
| ----------------------------------------------------------------------------
| AUTHOR:        SJ EMPOWERS (PVT) LTD
| ----------------------------------------------------------------------------
| EMAIL:         info@sjempowers.com
| ----------------------------------------------------------------------------
| COPYRIGHT:     RESERVED BY SJ EMPOWERS (PVT) LTD
| ----------------------------------------------------------------------------
| WEBSITE:       https://sjempowers.com
| ----------------------------------------------------------------------------
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
