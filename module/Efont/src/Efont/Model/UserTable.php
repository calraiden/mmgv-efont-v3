<?php

namespace Efont\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;

/**
 * Usuários do SISTEMA
 *
 * @author Claudio
 *        
 */
class UserTable extends AbstractTableGateway {
	protected $table = 'user';
	// Nome da tabela no banco
	public function __construct(Adapter $adapter) {
		$this->adapter = $adapter;
	}
	
	/**
	 * Salva/Atualiza
	 * 
	 * @param unknown $id        	
	 * @param unknown $name        	
	 * @param unknown $password        	
	 * @return boolean|number
	 */
	public function save($id, $name, $organization_id, $password) {
		$data = array (
				'name' => addslashes ( $name ),
				'username' => $username,
				'removed' => 0,
				'organization_id' => ( int ) $organization_id,
				'update_dt' => date ( 'Y-m-d H:i:s' ) 
		);
		
		$id = ( int ) $id;
		if ($id == 0) {
			unset ( $data ['id'] );
			$data ['edit_dt'] = $data ['create_dt'] = $data ['update_dt'];
			$data ['password'] = md5 ( $password );
			//$data ['uuid'] = new \Zend\Db\Sql\Expression ( 'UUID()' );
			// Inserindo
			if (! $this->insert ( $data )) {
				return false;
			}
			return $this->getLastInsertValue ();
		} else {
			if (strlen ( $password ) > 7) {
				$data ['password'] = md5 ( $password );
			}
			// Atualizando
			if (! $this->update ( $data, array (
					'id' => $id 
			) )) {
				return false;
			}
		}
		return $id;
	}
	/**
	 * Busca por IDs
	 *
	 * @param unknown $id        	
	 * @param unknown $organization_id        	
	 */
	public function find($id, $organization_id) {
		$select = new Select ();
		// FROM
		$select->from ( $this->table );
		// WHERE
		$select->where ( "id='{$id}'" );
		if (! is_null ( $organization_id ) && $organization_id >= 0) {
			$select->where ( "organization_id='{$organization_id}'" );
		}
		// LIMIT
		$select->limit ( 1 );
		$resultSet = $this->selectWith ( $select );
		if (! $resultSet) {
			return false;
		}
		$row = $resultSet->current ();
		if (! $row) {
			return false;
		}
		
		return $row;
	}
	/**
	 * Consulta Customizada
	 *
	 * @param unknown $name        	
	 * @param unknown $user_privilege_id        	
	 * @param unknown $organization_id        	
	 * @param unknown $count        	
	 * @param unknown $offset        	
	 * @return \Zend\Paginator\Paginator
	 */
	public function filter($name, $user_privilege_id, $organization_id, $count, $offset, $user_id = null) {
		// SELECT
		$select = new Select ();
		// COLS
		$select->columns ( array (
				'id',
				'name',
				'email',
				'username',
				'phone' 
		) );
		// JOIN
		$select->join ( "organization", "organization.id={$this->table}.organization_id", array (
				"organization_name" => "name" 
		), 'inner' );
		// FROM
		$select->from ( $this->table );
		// WHERE
		if (! is_null ( $name ) && strlen ( $name ) > 1) {
			$name = addslashes ( $name );
			$select->where ( "({$this->table}.name LIKE '%$name%' OR {$this->table}.username LIKE '%$name%' OR {$this->table}.email LIKE '%$name%')" );
		}
		
		if (! is_null ( $organization_id ) && $organization_id >= 0) {
			$select->where ( "{$this->table}.organization_id='{$organization_id}'" );
		}
		
		if (! is_null ( $user_privilege_id ) && $user_privilege_id >= 0) {
			$select->where ( "{$this->table}.user_privilege_id='{$user_privilege_id}'" );
		}
		
		if (! is_null ( $user_id ) && $user_id >= 0) {
			$select->where ( "{$this->table}.id='{$user_id}'" );
		}
		
		$select->where ( "({$this->table}.removed='0' OR {$this->table}.removed IS NULL)" );
		// ORDER
		$select->order ( "{$this->table}.name ASC" );
		// Executando
		$adapter = new \Zend\Paginator\Adapter\DbSelect ( $select, $this->adapter, $this->resultSetPrototype );
		$paginator = new \Zend\Paginator\Paginator ( $adapter );
		$paginator->setItemCountPerPage ( $count );
		$paginator->setCurrentPageNumber ( $offset );
		
		return $paginator;
	}
	
	/**
	 * Atualiza um item
	 *
	 * @param unknown $id        	
	 * @param unknown $data        	
	 * @param unknown $organization_id        	
	 * @return boolean|unknown
	 */
	public function updated($id, $data, $organization_id) {
		$data ['update_dt'] = date ( 'Y-m-d H:i:s' );
		
		$where = array (
				'id' => $id 
		);
		if ($organization_id != null && $organization_id > 0) {
			$where ['organization_id'] = $organization_id;
		}
		// Atualizando
		if (! $this->update ( $data, $where )) {
			return false;
		}
		return $id;
	}
	/**
	 * Remocao/Hide
	 *
	 * @param unknown $id        	
	 * @param unknown $organization_id        	
	 * @return boolean|unknown
	 */
	public function removed($id, $organization_id) {
		$where = array (
				'id' => $id 
		);
		if ($organization_id != null && $organization_id > 0) {
			$where ['organization_id'] = $organization_id;
		}
		// Atualizando
		if (! $this->update ( array (
				'edit_dt' => date ( 'Y-m-d H:i:s' ),
				'update_dt' => date ( 'Y-m-d H:i:s' ),
				'removed' => 1 
		), $where )) {
			return false;
		}
		return $id;
	}
}