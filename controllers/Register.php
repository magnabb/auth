<?php

namespace magnabb\controller;


use magnabb\model\Model;

/**
 * Class Register
 * @package magnabb\controller
 */
class Register extends Controller
{
    /**
     * API string from @link sms.ru
     * @var string
     */
    private $api_id = '4693ee31-893e-2214-d143-d6ca050d120f';

    /**
     * Show registration page
     */
    public function indexAction()
    {
        $this->templater->assign([
            'title' => 'Registration',
            'tpl_name' => 'register'
        ]);
        $this->templater->display('index.tpl');
    }

    /**
     * Method check user phone number
     * @return array
     */
    public function checkAction()
    {
        // values send to template
        $values = [
            'title' => 'Check Phone',
            'tpl_name' => 'checkNumber'
        ];

        if($_SERVER['REQUEST_METHOD'] === 'POST') {

            // check identical passwords
            if ($_POST['password'] !== $_POST['repassword']) {
                return false;
            }

            // check user exists
            if( is_array( (new Model())->getUser($_POST['phoneNumber']) ) ){
                return false;
            }

            // Save data
            $_SESSION['phone'] = trim(strip_tags($_POST['phoneNumber']));
            $_SESSION['password'] = md5(trim(strip_tags($_POST['password'])));
            // Generate sms code
            $_SESSION['code'] = (string)mt_rand(1000, 9999);

            // todo: remove it when setup api
            $values['code'] = $_SESSION['code'];

            // Send sms
            $answer = file_get_contents('http://sms.ru/sms/send?api_id='.$this->api_id
                .'&to='.$_POST['phoneNumber']
                .'&text='.urlencode('Your code: '.$_SESSION['code']));


            $answer = explode('\n', $answer);

            if (in_array('100', $answer)){
                return false;
            }


        }

        $this->templater->assign($values);
        $this->templater->display('index.tpl');
    }

    /**
     * Method Check phone number
     * Write user in DB
     * And Authorise user
     * @return array
     */
    public function sendAction(){
        if($_SERVER['REQUEST_METHOD'] === 'POST'){
            if ($_POST['checkCode'] !== $_SESSION['code']) {
                return false;
            }

            // Write user in DB
            $dbUser = new Model();
            $dbUser->writeUser($_SESSION['phone'], $_SESSION['password']);

            // Authorise
            $auth = new Authorise();
            $auth->auth($_SESSION['phone'], $_SESSION['password']);

            unset($_SESSION['code'], $_SESSION['phone'], $_SESSION['password']);
        }
    }
}