<?php  

class Module_Emailbrain_Block_Adminhtml_Emailbrainbackend extends Mage_Adminhtml_Block_Template {

    public function __construct() {  
        parent::__construct(); 
        $this->setTemplate('Emailbrain/emailbrainbackend.phtml');  
        //$this->setFormAction(Mage::getUrl('*/*/save/index/key'));  
    } 
}
?>