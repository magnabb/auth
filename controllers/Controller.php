<?php

namespace magnabb\controller;


/**
 * Class Controller
 * @package magnabb\controller
 */
class Controller
{
    /**
     * @var \Smarty
     */
    protected $templater;

    /**
     * Config smarty
     */
    public function __construct()
    {
        $this->templater = new \Smarty();
        $this->templater->setTemplateDir(__DIR__.'/../views');
        $this->templater->setCompileDir(__DIR__.'/../views/compile');

    }

    /**
     * Show main page
     */
    public function indexAction()
    {
        $this->templater->assign([
            'title' => 'Main',
            'tpl_name' => 'base'
        ]);
        $this->templater->display('index.tpl');
    }

    /**
     * Show user profile page
     */
    public function showUserAction()
    {
        $this->templater->assign([
            'title' => 'Profile',
            'tpl_name' => 'user'
        ]);
        $this->templater->display('index.tpl');
    }
}