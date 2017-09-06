<?php

use Phinx\Migration\AbstractMigration;

class PublicApiMigration extends AbstractMigration
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

    	$this->vCreatePublicApiRequestTable();
    	$this->vCreatePublicApiServerKeyTable();
    }
	
	private function vCreatePublicApiRequestTable(){
		
		$this->table('PublicApiRequest', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false ] )
			->addColumn('fkiPublicApiServerKeyId',      'biginteger',   [ 'null'    => false ] )
			->addColumn('sEndpointId',                  'string',       [ 'null'    => false,   'length' => 50  ] )
			->addColumn('sRequest',                     'string',       [ 'null'    => false,   'length' => 1073741823 ] )
			->addColumn('sResponse',                    'string',       [ 'null'    => false,   'length' => 1073741823 ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'sEndpointId',                  [ 'name' => 'idx_endpoint' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			->addIndex(     'fkiPublicApiServerKeyId',      [ 'name' => 'idx_server_key' ] )
			
			->create();
	}
	
	private function vCreatePublicApiServerKeyTable(){
		
		$this->table('PublicApiServerKey', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false ] )
			->addColumn('sName',                        'string',       [ 'null'    => false,   'length' => 150 ] )
			->addColumn('sServerKey',                   'string',       [ 'null'    => false,   'length' => 300 ] )
			->addColumn('sAuthorizedEndpoint',          'string',       [ 'null'    => true,    'length' => 1073741823  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			->addIndex(     'sServerKey',                   [ 'name' => 'idx_server_key' ] )
			
			->create();
	}
}
