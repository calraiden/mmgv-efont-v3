<?php

namespace Efont\Model;

use Zend\Db\Adapter\Adapter;
use Zend\Db\TableGateway\AbstractTableGateway;
use Zend\Db\Sql\Select;

/**
 * Empresas do SISTEMA
 *
 * @author Claudio
 *        
 */
class CompanyTable extends AbstractTableGateway {
	protected $table = 'company';
	// Nome da tabela no banco
	public function __construct(Adapter $adapter) {
		$this->adapter = $adapter;
	}
	
	public function save(){
	}
}