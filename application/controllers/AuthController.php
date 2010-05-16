<?php

class AuthController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */

    }

    public function indexAction()
    {
        // action body
        if (isSet(Zend_Auth::getInstance()->getIdentity()->id)) {
            // we are logged in
        } else {
            $this->_redirect('/');
        }
        // end of init
    }

    public function loginAction()
    {
        $username = $this->_getParam('username');
        $password = $this->_getParam('password');
        
        if ((!isSet($username)) or (!isSet($password))) {
            $auth = new Authentication();
            $auth->logout();
        }

        $auth = new Authentication();
        if ($auth->login($username, $password)) {
            // we have a valid login
            $this->_redirect('/');
        } else {
            // not valid
            $this->_redirect('/');
        }
        //end login action
    }

    public function logoutAction()
    {
        // action body
        $auth = new Authentication();
        $auth->logout();
    }

}





