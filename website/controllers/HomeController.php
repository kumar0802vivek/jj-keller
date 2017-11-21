<?php

use Website\Controller\Action;
use Pimcore\Log\Simple;

/**
 * Description of HomeController
 *
 * @author shubhamsrivastava
 */
class HomeController extends Action {

    public function init() {
        parent::init();
    }

    public function defaultAction() {
        $this->enableLayout();
    }

    public function headerAction() {
        $this->enableLayout();
    }

    public function footerAction() {
        //$this->enableLayout();
    }

    public function homeCarouselAction() {
        
    }

    /**
     * Method for saving contact us details
     */
    public function contactUsAction() {
        $this->enableLayout();

        $response = array();
        $error = array();

        if ($this->_request->isPost()) {
            try {
		//$marketName = preg_replace("/[^a-zA-Z0-9]/", "", str_replace(" ", "", $this->_getParam('marketName')));
                $name = preg_replace("/[^a-zA-Z ]/", "", $this->_getParam('name'));
		$companyName = preg_replace("/[^a-zA-Z0-9 ]/", "", $this->_getParam('companyname'));                
		$phone = preg_replace("/[^0-9]/", "", str_replace(" ", "", $this->_getParam('phone')));
		$email = preg_replace("/[^a-zA-Z0-9@.]/", "", str_replace(" ", "", $this->_getParam('email')));      
                $comment = htmlspecialchars($this->getParam('comment'));
		
                // Validations for required fields only
                if (empty($name)) {
                    $errors[] = Zend_Registry::get('Zend_Translate')->translate('contactus.name.error.msg') . '<br>';
                }
                if (empty($email)) {
                    $errors[] = Zend_Registry::get('Zend_Translate')->translate('contactus.email.error.msg') . '<br>';
                } else {
                    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                        $errors[] = Zend_Registry::get('Zend_Translate')->translate('contactus.emailpattern.error.msg') . '<br>';
                    }
                }
                if (!empty($phone) && !is_numeric($phone)) {
                    $errors[] = Zend_Registry::get('Zend_Translate')->translate('contactus.number.error.msg') . '<br>';
                }
                if (empty($comment)) {
                    $errors[] = Zend_Registry::get('Zend_Translate')->translate('contactus.comment.error.msg');
                }

                if (count($errors) > 0) {
                    $response['status'] = 0;
                    $response['message'] = $errors;
                } else {
                    //Save the Contact Us Form Data
                    $newObject = new Object\Contactus();
                    $contact_us = Object::getById(46);
                    $parent_path = $contact_us.'/';
                    $newObject->setKey($this->getFreeObjectKey(\Pimcore\File::getValidFilename($name), $parent_path));
                    $newObject->setParentId(46);
                    $newObject->setName($name);
                    $newObject->setCompany_name($companyName);
                    $newObject->setEmail($email);
                    $newObject->setPhone($phone);
                    $newObject->setComments($comment);
                    if ($newObject->save()) {
                        //Code to send the Mail to Admin only after Object successfully created.
                        $mail = new \Pimcore\Mail();
                        $mail->setIgnoreDebugMode(true);
                        $emailDocument = Document::getById(17);

                        if ($emailDocument) {
                            $mail->setDocument($emailDocument);
                            $mail->setParams($this->getAllParams());
                            if ($mail->send()) {
                                $response['status'] = 1;
                            } else {
                                $response['status'] = 0;
                            }
                        } else {
                            $response['status'] = 0;
                        }
                    } else {
                        $response['status'] = 0;
                    }
                    $message = "<span class='success-message'>" . Zend_Registry::get('Zend_Translate')->translate('contactus.thankyou.msg') . "</span>";
                    if ($response['status'] == 0) {
                        $message = Zend_Registry::get('Zend_Translate')->translate("contactus.error.msg");
                    }
                    $response['message'] = $message;
                }

                echo json_encode($response);
                exit;
            } catch (\Exception $e) {
                Simple::log('contact-us-error', $e->getMessage());
            }
        }
    }

    /*
      Added by Vivek Kumar @17Nov2016
      Function to check the unique object key name before saving the data
     */

    private function getFreeObjectKey($key, $parent_path) {
        $base_key = $key;
        $i = 2;
        while (Object_Service::pathExists($parent_path . $key)) {
            $key = $base_key . "-" . $i;
            $i++;
        }
        return $key;
    }

}
