<?php

namespace Efont\Controller;

/**
 * Service de Usuario
 * 
 * @author Claudio
 */
class UserController extends \Useful\Controller\ControlController {
	/**
	 * Salva/Atualiza
	 * @param unknown $id
	 * @param unknown $name
	 * @param unknown $username
	 * @param unknown $password
	 * @return unknown
	 */
	public function save($id, $name, $username, $password) {
		return $this->getDbTable('\Efont\Model\UserTable')->save($id, $name, $username, $password);
	}
	/**
	 * Busca
	 */
	public function find($id) {
		return $this->getDbTable('\Efont\Model\UserTable')->find($id);
	}
	/**
	 * Remove
	 */
	public function removed($id) {
		return $this->getDbTable('\Efont\Model\UserTable')->removed($id);
	}
}

