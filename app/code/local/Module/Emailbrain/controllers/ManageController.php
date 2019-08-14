<?php
require_once 'Mage/Newsletter/controllers/ManageController.php';

class Module_Emailbrain_ManageController extends Mage_Newsletter_ManageController
{

    public function saveAction()
    {
        if (!$this->_validateFormKey()) {
            return $this->_redirect('customer/account/');
        }
		/**************** EMAILBRAIN CODE ******************/
		$emailbrain = Mage::getModel('customer/emailbrain');
		$data=Mage::helper('customer')->getCustomer()->getData();
		/*********************** END ************************/

        try {
            Mage::getSingleton('customer/session')->getCustomer()
            ->setStoreId(Mage::app()->getStore()->getId())
            ->setIsSubscribed((boolean)$this->getRequest()->getParam('is_subscribed', false))
            ->save();
            if ((boolean)$this->getRequest()->getParam('is_subscribed', false)) {
                Mage::getSingleton('customer/session')->addSuccess($this->__('The subscription has been saved.'));
				/**************** EMAILBRAIN CODE ******************/
				$emailbrain->subscribeEmailBrainNewsletter($data['email']);
				/*********************** END ************************/
 				
            } else {
                Mage::getSingleton('customer/session')->addSuccess($this->__('The subscription has been removed.'));
				/**************** EMAILBRAIN CODE ******************/
				$emailbrain->unSubscribeEmailBrainNewsletter($data['email']);
				/*********************** END ************************/
				
            }
        }
        catch (Exception $e) {
            Mage::getSingleton('customer/session')->addError($this->__('An error occurred while saving your subscription.'));
        }
        $this->_redirect('customer/account/');
    }
}
