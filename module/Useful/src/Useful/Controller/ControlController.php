<?php

namespace Useful\Controller;

/**
 * Classe Controller
 *
 * @author Claudio
 *        
 */
class ControlController {
	protected $_ServiceLocatorInterface = null;
	
	/**
	 * Constructor
	 *
	 * @param \Zend\ServiceManager\ServiceManager $ServiceLocatorInterface        	
	 */
	public function __construct(\Zend\ServiceManager\ServiceManager $ServiceLocatorInterface) {
		$this->_ServiceLocatorInterface = $ServiceLocatorInterface;
	}
	public function getServiceLocator() {
		return $this->_ServiceLocatorInterface;
	}
	/**
	 * Retorna uma tabela
	 *
	 * @param Namespace|String $DbTable        	
	 */
	public function getDbTable($DbTable) {
		if (class_exists ( $DbTable )) {
			return $this->_ServiceLocatorInterface->get ( $DbTable );
		}
		return false;
	}
}