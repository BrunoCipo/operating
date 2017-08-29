<?php

use Phinx\Migration\AbstractMigration;

class VehiculeMigration extends AbstractMigration
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
	
    	$this->vCreateVehicule();
    	$this->vCreateVehiculeBrand();
    }
	
	private function vCreateVehicule(){
		
		$this->table('Vehicule', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                   'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',                'biginteger',   [ 'null'    => false ] )
			->addColumn('fkiUserId',                        'biginteger',   [ 'null'    => false ] )
			->addColumn('iCategoryId',                      'biginteger',   [ 'null'    => false ] )
			->addColumn('sVehicleBrand',                    'string',       [ 'null'    => false,    'length' => 100 ] )
			->addColumn('sLicencePlate',                    'string',       [ 'null'    => false,    'length' => 30  ] )
			->addColumn('sModel',                           'string',       [ 'null'    => false,    'length' => 100 ] )
			->addColumn('sModelYear',                       'string',       [ 'null'    => false,    'length' => 10  ] )
			->addColumn('fkiRegistrationCertificateFileId', 'biginteger',   [ 'null'    => true  ] )
			->addColumn('iStatusId',                        'biginteger',   [ 'null'    => false ] )
			
			->addColumn('bDeleted',             'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',        'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                  [ 'name' => 'bDeleted' ] )
			->addIndex(     'fkiOrganisationId',         [ 'name' => 'idx_organisation' ] )
			->addIndex(     'fkiUserId',                 [ 'name' => 'idx_user' ] )
			
			->create();
	}
	
	private function vCreateVehiculeBrand(){
		
		$this->table('VehiculeBrand', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                   'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('iVehicleCategoryId',   'biginteger',   [ 'null'    => false ] )
			->addColumn('sName',                'string',       [ 'null'    => false,    'length' => 100 ] )
			
			->addColumn('bDeleted',             'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',        'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                 [ 'name' => 'bDeleted' ] )
			->addIndex(     'sName',                    [ 'name' => 'idx_name' ] )
			->addIndex(     'iVehicleCategoryId',       [ 'name' => 'idx_vehicle_category' ] )
			->addIndex(     [   'iVehicleCategoryId',
								'sName'],                        [ 'name' => 'uq_name', 'unique' => true ] )
			
			->create();
	}
	
}
