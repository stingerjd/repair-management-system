<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Migration_Update317 extends CI_Migration {

    public function up() {

        // $this->dbforge->add_column('status', array(
        //     'completed' => array('type' => 'TINYINT', 'constraint' => '1', 'null' => TRUE, 'default' => 0),
        // ));

        // $this->dbforge->add_column('settings', array(
        //     'smsgateway_device_id' => array('type' => 'VARCHAR', 'constraint' => '250', 'null' => TRUE ),
        //     'smsgateway_token' => array('type' => 'VARCHAR', 'constraint' => '250', 'null' => TRUE ),
        // ));

        // $this->dbforge->add_column('reparation', array(
        //     'custom_toggles' => array('type' => 'VARCHAR', 'constraint' => '1000', 'null' => TRUE ),
        //     'pin_code' => array('type' => 'VARCHAR', 'constraint' => '250', 'null' => TRUE ),
        //     'pattern' => array('type' => 'VARCHAR', 'constraint' => '250', 'null' => TRUE ),
            // 'warranty' => array('type' => 'VARCHAR', 'constraint' => '250', 'null' => TRUE ),
        //     
        // ));

        // $this->dbforge->add_column('settings', array(
        //     'repair_custom_toggles' => array('type' => 'VARCHAR', 'constraint' => '1000', 'null' => TRUE ),
        // ));



        // $this->dbforge->add_column('settings', array(
        //     'warranty_ribbon_color' => array('type' => 'VARCHAR', 'constraint' => '100', 'null' => TRUE ),
        // ));

        // $this->dbforge->add_column('reparation', array(
        //     'repair_sign' => array('type' => 'VARCHAR', 'constraint' => '250', 'null' => TRUE ),
        // ));


        $this->dbforge->add_column('reparation', array(
            'invoice_sign' => array('type' => 'VARCHAR', 'constraint' => '250', 'null' => TRUE ),
        ));


    }

    public function down() { }

}
