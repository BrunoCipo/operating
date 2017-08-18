<?php

use Phinx\Migration\AbstractMigration;

class ApiMigration extends AbstractMigration{

	/**
	 * Change Method.
	 *
	 * Write your reversible migrations using this method.
	 *
	 * More information on writing migrations is available here:
	 * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
	 *
	 * The following commands can be used in this method and Phinx will
	 * automatically reverse them when rolling back:
	 *
	 *    createTable
	 *    renameTable
	 *    addColumn
	 *    renameColumn
	 *    addIndex
	 *    addForeignKey
	 *
	 * Remember to call "create()" or "update()" and NOT "save()" when working
	 * with the Table class.
	 */
	public function change(){

		$this->vCreateApiDocTable();
		$this->vCreateApiEndPointTable();
		$this->vCreateApiVersionTable();
	}

	protected function vCreateApiDocTable(){
		
		$this->table('ApiDoc', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                   'biginteger',   array('identity'  => true))

			->addColumn('sRessource',           'string',       array('length'  => 255,      'null'      => true))
			->addColumn('sMethod',              'string',       array('length'  => 20,       'null'      => true))
			->addColumn('iVersion',             'biginteger',   array('null'    => true))
			->addColumn('sDescription',         'string',       array('null'    => true))
			->addColumn('sAutoTestUrl',         'string',       array('null'    => true))
			->addColumn('sInfo',                'string',       array('null'    => true))
			->addColumn('sDataToServerExample', 'string',       array('null'    => true))
			->addColumn('sResponseExample',     'string',       array('null'    => true))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                  array('name'    => 'idx_deleted'))
			
			->create();
		
	}

	protected function vCreateApiEndPointTable(){
		
		$this->table('ApiEndPoint', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                   'biginteger',   array('identity'  => true))

			->addColumn('fkiApiVersion',        'biginteger',   array('null'    => false))
			->addColumn('sTitle',               'string',       array('length'  => 100,      'null'   => true))
			->addColumn('sResponseExemple',     'string',       array('null'    => true))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                  array('name' => 'idx_deleted'))
			
			->create();
		
		
	}

	protected function vCreateApiVersionTable(){
		
		$this->table('ApiVersion', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                   'biginteger',   array('identity'  => true))
			
			->addColumn('fkiApidoc',            'biginteger',   array('null'   => false))
			->addColumn('sVersion',             'string',       array('length' => 100,      'null'      => false))
			->addColumn('iUserId',              'biginteger',   array('null'   => true))
			->addColumn('sDescription',         'string',       array('null'   => true))
			->addColumn('sAutoTestUrl',         'string',       array('null'   => true))
			->addColumn('sInfo',                'string',       array('null'   => true))
			->addColumn('sDataToServerExample', 'string',       array('null'   => true))
			->addColumn('aPossibleHttp',        'string',       array('null'   => true))
			->addColumn('aGetParams',           'string',       array('null'   => true))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                  array('name' => 'idx_deleted'))
			
			->create();
		

	}
}