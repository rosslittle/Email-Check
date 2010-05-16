<?php

class Authentication {

    private $authAdapter;

    public function  __construct() {
        $this->authAdapter = new Zend_Auth_Adapter_DbTable(Zend_Db_Table::getDefaultAdapter());
        $this->authAdapter->setTableName('users')
                          ->setIdentityColumn('username')
                          ->setCredentialColumn('password');
    }

    public function login($username, $password) {
        $this->authAdapter->setIdentity($username);
        $this->authAdapter->setCredential($password);
        $results = $this->authAdapter->authenticate();

        if ($results->isValid()) {
            $auth = Zend_Auth::getInstance();
            $storage = $auth->getStorage();
            $storage->write($this->authAdapter->getResultRowObject(null, array('password', 'passwordSalt')));
            return true;
        } else {
            return false;
        }
    }

    public function logout() {
        $auth = Zend_Auth::getInstance();
        $auth->clearIdentity();
        $storage = $auth->getStorage();
        $storage->clear();
        $controller = new Zend_Controller_Action_Helper_Redirector();
        $controller->gotoSimple('index');
    }

    public function changePassword() {

    }

    public function check() {
        if (isSet(Zend_Auth::getInstance()->getIdentity()->id)) {
            return true;
        } else {
            return false;
        }
    }
}