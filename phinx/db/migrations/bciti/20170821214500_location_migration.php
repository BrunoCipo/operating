<?php

use Phinx\Migration\AbstractMigration;

class LocationMigration extends AbstractMigration
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
	
    	$this->vCreateLocationTable();
    	$this->vCreateLocationGeoPointTable();
    }
	
	private function vCreateLocationTable(){
		
		$this->table('Location', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false   ] )
			->addColumn('sCode',                        'string',       [ 'null'    => false,    'length'    => 255   ] )
			->addColumn('sName',                        'string',       [ 'null'    => false,    'length'    => 1073741823   ] )
			->addColumn('sDescription',                 'string',       [ 'null'    => false,    'length'    => 1073741823   ] )
			->addColumn('iNbAvailableSlot',             'biginteger',   [ 'null'    => false   ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     [   'fkiOrganisationId',
								'sCode' ],                           [ 'name' => 'uq_organisation_code', 'unique' => true ] )
			->addIndex(     'sCode',                        [ 'name' => 'idx_code' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			
			->create();
	}
	
	private function vCreateLocationGeoPointTable(){
		
		$this->table('LocationGeoPoint', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiLocationId',                'biginteger',   [ 'null'    => false   ] )
			->addColumn('fkiGeoPointId',                'biginteger',   [ 'null'    => false   ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiGeoPointId',                [ 'name' => 'idx_geo_point' ] )
			->addIndex(     'fkiLocationId',                [ 'name' => 'idx_location' ] )
			
			->create();
	}
}
