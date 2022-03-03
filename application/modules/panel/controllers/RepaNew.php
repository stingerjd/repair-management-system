<?php
if (!defined('BASEPATH')) {
    exit('No direct script access allowed');
}
/**
 * Customers
 *
 *
 * @package     Reparer
 * @category    Controller
 * @author      Usman Sher
*/

class RepaNew extends Auth_Controller
{
    // THE CONSTRUCTOR //
    public function __construct()
    {
        // parent::__construct();
        $this->load->model('reparation_model');
    }
      public function add_reparation_new(){
        // echo "<pre>";
        // print_r($this->input->post());
        // exit;
        // $this->repairer->checkPermissions('add', NULL, 'repair');
        $this->load->model('inventory_model');

        $custom_fields = $this->mSettings->custom_fields;
        $custom_fields = explode(',', $custom_fields);
        $cust = array();
        $array = array();
        foreach ($_POST as $key => $var) {
            if (substr($key, 0, 7) === 'custom_' ) {
                $array[(substr($key, 7))] = $var;
            }
        }
        $cust = (json_encode($array));
        $client_details = $this->reparation_model->getClientNameByID($this->input->post('client_name'));
        $model = $this->inventory_model->getModelByName($this->input->post('model'));

     
        $data = array(
            'client_id' => $this->input->post('client_name'),
            'name' => $client_details->name,
            'telephone' => $client_details->telephone,
            'defect' => $this->input->post('defect'),
            'category' => $this->input->post('category'),
            'diagnostics' => $this->input->post('diagnostics'),
            'model_id' => $model->id,
            'model_name' => $this->input->post('model'),
            'manufacturer' => $this->input->post('manufacturer'),
            'assigned_to' => 0,
            'advance' => $this->input->post('advance'),
            'date_opening' => date('y-m-d H:i:s'),
            'service_charges' => $this->input->post('service_charges'),
            'comment' => $this->input->post('comment'),
            'status' => $this->input->post('status'),
            'code' => $this->input->post('code'),
            'email' => $this->input->post('email') == 'true' ? TRUE : FALSE,
            'sms' => $this->input->post('sms') == 'true' ? TRUE : FALSE,
            'custom_field' => $cust,
            'created_by' => 0,
            'tax_id' => $this->input->post('order_tax'),
            'imei' => $this->input->post('imei'),
            'expected_close_date' => $this->input->post('expected_close_date'),
        );


        $tax_rate = $this->settings_model->getTaxRateByID($this->input->post('order_tax'));
        if ($_POST['code'] == null) {
            $data['code'] = time();
        }
        $products = array(); 
        $subtotal = 0;
        $total_tax = 0;
        $total = 0;
        $gtotal = 0;
        $invoice_tax = 0;
        if (isset($_POST['item_id']) && $_POST['item_id'] !== null) {
            $i = sizeof($_POST['item_id']);
            for ($r = 0; $r < $i; $r++) {
                $item_id = $_POST['item_id'][$r];
                $item_name = $_POST['item_name'][$r];
                $item_code = $_POST['item_code'][$r];
                $item_quantity = $_POST['item_quantity'][$r];
                $item_price = $_POST['item_price'][$r];
                $products[] = array(
                    'product_id' => $item_id,
                    'product_name' => $item_name,
                    'product_code' => $item_code,
                    'quantity' => $item_quantity,
                    'unit_price' => $item_price,
                    'subtotal' => $item_price * $item_quantity,
                );
                $subtotal += $item_price * $item_quantity;
            }
            $total += $subtotal;
            if ($tax_rate) {
                if ($tax_rate->type == 2) {
                    $invoice_tax = ($tax_rate->rate);
                }
                if ($tax_rate->type == 1) {
                    $invoice_tax = ((($total) * $tax_rate->rate) / 100);
                }
            }
            $total_tax = $invoice_tax;
        }
        $gtotal = $this->input->post('service_charges') + $total + $total_tax;
        $data['tax'] = $total_tax;
        $data['total'] = $total;
        $data['grand_total'] = $gtotal;

        $attachment_data = $this->input->post('attachment_data') ? $this->input->post('attachment_data') : NULL;
        
        $result = $this->reparation_model->add_reparation($data, $products, $attachment_data);
        echo $this->repairer->send_json($result);

    }

}