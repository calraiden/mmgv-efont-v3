<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
/**
 * Coontroller do usuario
 * @author Claudio
 *
 */
class UserController extends AbstractActionController
{
	/**
	 * {@inheritDoc}
	 * @see \Zend\Mvc\Controller\AbstractActionController::indexAction()
	 */
    public function indexAction()
    {
    	$UserService = new \Efont\Controller\UserController($this->getServiceLocator());//Zend 2 Get Service locator, Zend 3 Service Manager
    	$UserService->save($id, $name, $username, $password);
    	
        return new ViewModel();
    }
}

