<?php

use Phinx\Migration\AbstractMigration;

class GeoMigration extends AbstractMigration
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

    	$this->CreateGeoObjectTable();
    	$this->CreateGeoObjectGeoPointTable();
    	$this->CreateGeoPointTable();
    }
	
	protected function CreateGeoObjectTable(){
		
		$this->table('GeoObject', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false  ] )
			->addColumn('sExternalIdentifier',          'string',       [ 'null'    => false,     'length' => 200 ] )
			->addColumn('iTypeId',                      'biginteger',   [ 'null'    => false  ] )
			->addColumn('sName',                        'string',       [ 'null'    => false ] )
			->addColumn('sMetaData',                    'string',       [ 'null'    => false ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'sExternalIdentifier',          [ 'name' => 'idx_external_identifier' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			
			->create();
	}
	
	protected function CreateGeoObjectGeoPointTable(){
		
		$this->table('GeoObjectGeoPoint', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiGeoObjectId',               'biginteger',   [ 'null'    => false  ] )
			->addColumn('fkiGeoPointId',                'biginteger',   [ 'null'    => false  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiGeoObjectId',               [ 'name' => 'idx_geo_object' ] )
			->addIndex(     'fkiGeoPointId',                [ 'name' => 'idx_geo_point' ] )
			
			->create();
	}
	
	protected function CreateGeoPointTable(){
		
		$this->table('GeoPoint', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false  ] )
			->addColumn('dLatitude',                    'decimal',      [ 'null'    => false  , 'precision' => 16, 'scale' => 13 ] )
			->addColumn('dLongitude',                   'decimal',      [ 'null'    => false  , 'precision' => 16, 'scale' => 13 ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			
			->create();
	}
}
