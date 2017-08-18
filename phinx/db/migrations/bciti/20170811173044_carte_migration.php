<?php

use Phinx\Migration\AbstractMigration;

class CarteMigration extends AbstractMigration{

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

		$this->vCreateCarteTable();
		$this->vCreateCarteInjustificationTable();
		$this->vCreateCarteJustificationTable();
		$this->vCreateCarteSupportTable();
		$this->vCreateCarteUserOptionTable();
	}

	protected function vCreateCarteTable(){
		
		$this->table('Carte', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity'  => true))
			
			->addColumn('fkiOrganisationId',            'biginteger',   array('null'    => false))
			->addColumn('fkiUserId',                    'biginteger',   array('null'    => false))
			->addColumn('bValide',                      'integer',      array('null'    => true))
			->addColumn('iEmission',                    'biginteger',   array('null'    => true))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => false))
			->addColumn('iModification',                'biginteger',   array('null'    => false))
			
			->addIndex(     'bDeleted',                                          array('name' => 'idx_deleted'))
			->addIndex(     'fkiUserId',                                         array('name' => 'fkiUserId'))
			->addIndex(array(   'fkiOrganisationId',
								'fkiUserId'),                         array('name' => 'CarteOrganisationUser', 'unique' => true))

			->create();
	}

	protected function vCreateCarteInjustificationTable(){
		
		$this->table('CarteInjustification', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity'  => true))
			
			->addColumn('fkiUserId',                    'biginteger',   array('null'    => true))
			->addColumn('fkiSystExtTableId',            'biginteger',   array('null'    => true))
			->addColumn('sFournisseur',                 'string',       array('null'    => true,    'length'    => 100))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default'   => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => false))
			->addColumn('iModification',                'biginteger',   array('null'    => false))
			
			->addIndex(     'bDeleted',                                          array('name' => 'idx_deleted'))
			
			->create();
	}

	protected function vCreateCarteJustificationTable(){
		
		$this->table('CarteJustification', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity'  => true))
			
			->addColumn('fkiCarteId',                   'biginteger',   array('null'    => true))
			->addColumn('fkiUserId',                    'biginteger',   array('null'    => true))
			->addColumn('iCarteJustificationType',      'biginteger',   array('null'    => true))
			->addColumn('iCarteJustificationPreuveType','biginteger',   array('null'    => true))
			->addColumn('iVerification',                'biginteger',   array('null'    => true))
			->addColumn('iExpiration',                  'biginteger',   array('null'    => true))
			->addColumn('sCommentaire',                 'string',       array('null'    => true,    'length'    => 255))
			->addColumn('fkiSystExtTableId',            'biginteger',   array('null'    => true))
			->addColumn('sFournisseur',                 'string',       array('null'    => true,    'length'    => 100))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default'   => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => false))
			->addColumn('iModification',                'biginteger',   array('null'    => false))
			
			->addIndex(     'bDeleted',                                          array('name' => 'idx_deleted'))
			
			->create();
	}

	protected function vCreateCarteSupportTable(){
		
		$this->table('CarteSupport', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity'  => true))
			
			->addColumn('fkiCarteId',                   'biginteger',   array('null'    => true))
			->addColumn('iCarteSupportType',            'biginteger',   array('null'    => true))
			->addColumn('sCode',                        'string',       array('null'    => true,    'length'    => 255))
			->addColumn('iEmission',                    'biginteger',   array('null'    => true))
			->addColumn('iExpiration',                  'biginteger',   array('null'    => true))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default'   => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => false))
			->addColumn('iModification',                'biginteger',   array('null'    => false))
			
			->addIndex(     'bDeleted',                                          array('name' => 'idx_deleted'))
			->addIndex(     'fkiCarteId',                                        array('name' => 'fkiCarteId'))
			->addIndex(     'iCarteSupportType',                                 array('name' => 'iCarteSupportType'))
			->addIndex(     'iEmission',                                         array('name' => 'iEmission'))
			->addIndex(     'iExpiration',                                       array('name' => 'iExpiration'))
			->addIndex(     'sCode',                                             array('name' => 'sCode'))
			
			->addIndex( array(  'sCode',
								'fkiCarteId'),                         array('name' => 'uq_scode_carteid', 'unique' => true))

			->create();
	}

	protected function vCreateCarteUserOptionTable(){
		
		$this->table('CarteUserOption', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity'  => true))
			
			->addColumn('fkiUserId',                    'biginteger',   array('null'    => true))
			->addColumn('iCarteUserOptionType',         'biginteger',   array('null'    => true))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default'   => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => false))
			->addColumn('iModification',                'biginteger',   array('null'    => false))
			
			->addIndex(     'bDeleted',                                          array('name' => 'idx_deleted'))
			->addIndex(     'fkiUserId',                                         array('name' => 'fkiUserId'))
			->addIndex(     'iCarteUserOptionType',                              array('name' => 'iCarteUserOptionType'))
			
			->addIndex( array(  'fkiUserId',
								'iCarteUserOptionType'),              array('name' => 'CarteUserOption_UserCarteUserOptionType', 'unique' => true))
			
			->create();
	}
}