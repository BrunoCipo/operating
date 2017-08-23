<?php

use Phinx\Migration\AbstractMigration;

class UiMenuMigration extends AbstractMigration
{
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
    	
    	$this->vCreateUiMenu();
    	$this->vCreateUiMenuOrganisation();
    }
	
	private function vCreateUiMenu(){
		
		$this->table('UiMenu', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('sLink',                        'string',       [ 'null'    => true,    'length'  => 2000  ] )
			->addColumn('sText',                        'string',       [ 'null'    => true  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                 [ 'name' => 'bDeleted' ] )
			
			->create();
    }
	
	private function vCreateUiMenuOrganisation(){
		
		$this->table('UiMenuOrganisation', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                   'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',    'biginteger',   [ 'null'    => true  ] )
			->addColumn('sConfigMenu',          'string',       [ 'null'    => true  ] )
			
			
			->addColumn('bDeleted',             'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',        'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                  [ 'name' => 'bDeleted' ] )
			->addIndex(     'fkiOrganisationId',         [ 'name' => 'idx_organisation' ] )
			
			->create();
	}
}
