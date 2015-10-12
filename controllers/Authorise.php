<?php

namespace magnabb\controller;


use magnabb\model\Model;

/**
 * Class Authorise
 * @package magnabb\controller
 */
class Authorise extends Controller
{

    /**
     * Show authorisation page
     * @return array
     */
    public function indexAction()
    {
        $this->templater->assign([
            'tpl_name' => 'auth'
        ]);
        $this->templater->display('index.tpl');
    }

    /**
     *
     * @param null $phone user phone number for auto auth
     * @param null $pass user password for auto auth
     */
    public function auth($phone = null, $pass = null)
    {
        if($phone === null && $pass === null) {
            $phone = trim(strip_tags($_POST['phoneNumber']));
            $pass = md5(trim(strip_tags($_POST['password'])));
        }

        // check user exists
        $user = (new Model())->getUser($phone);

        // save user data in session
        if ($user['password'] === $pass){
            $_SESSION['user']['id'] = $user['id'];
            $_SESSION['user']['phone'] = $user['phone'];
        }
    }

    /**
     * Deauth method
     */
    public function deauth()
    {
        unset($_SESSION['user']);
        setcookie(session_id(), '', time()-1);
        session_destroy();
    }
}