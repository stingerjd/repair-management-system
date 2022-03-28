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

use Zend\Barcode\Barcode;

class Wf_barcode
{
    public function __construct() {
    }

     public function __get($var)
    {
        return get_instance()->controller->$var;
    }

    public function generate($text, $bcs = 'code128', $height = 50, $drawText = true, $get_be = false, $re = false) {
        // Barcode::setBarcodeFont('my_font.ttf');
        $check = $this->prepareForChecksum($text, $bcs);
        $barcodeOptions = ['text' => $check['text'], 'barHeight' => $height, 'drawText' => $drawText, 'withChecksum' => $check['checksum'], 'withChecksumInText' => $check['checksum']]; //'fontSize' => 12, 'factor' => 1.5,
        if ($this->mSettings->barcode_img) {
            $rendererOptions = ['imageType' => 'png', 'horizontalPosition' => 'center', 'verticalPosition' => 'middle'];
            if ($re) {
                Barcode::render($bcs, 'image', $barcodeOptions, $rendererOptions);
                exit;
            }
            $imageResource = Barcode::draw($bcs, 'image', $barcodeOptions, $rendererOptions);
            ob_start();
            imagepng($imageResource);
            $imagedata = ob_get_contents();
            ob_end_clean();
            if ($get_be) {
                return 'data:image/png;base64,'.base64_encode($imagedata);
            }
            return "<img src='data:image/png;base64,".base64_encode($imagedata)."' alt='{$text}' class='bcimg' />";
        } else {
            $rendererOptions = ['renderer' => 'svg', 'horizontalPosition' => 'center', 'verticalPosition' => 'middle'];
            if ($re) {
                Barcode::render($bcs, 'svg', $barcodeOptions, $rendererOptions);
                exit;
            }
            ob_start();
            Barcode::render($bcs, 'svg', $barcodeOptions, $rendererOptions);
            $imagedata = ob_get_contents();
            ob_end_clean();
            if ($get_be) {
                return 'data:image/svg+xml;base64,'.base64_encode($imagedata);
            }
            return "<img src='data:image/svg+xml;base64,".base64_encode($imagedata)."' alt='{$text}' class='bcimg' />";
        }
        return false;
    }

    protected function prepareForChecksum($text, $bcs) {
        if ($bcs == 'code25' || $bcs == 'code39') {
            return ['text' => $text, 'checksum' => false];
        } elseif ($bcs == 'code128') {
            return ['text' => $text, 'checksum' => true];
        }
        return ['text' => substr($text, 0, -1), 'checksum' => true];
    }
}
