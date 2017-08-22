<?php

use Phinx\Migration\AbstractMigration;

class OrganisationMigration extends AbstractMigration
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
	
    	$this->vCreateOrganisationTable();
    	$this->vCreateOrganisationAdresseTable();
    	$this->vCreateOrganisationConfigurationTable();
    	$this->vCreateOrganisationNumeroTelTable();
    	$this->vCreateOrganisationRelationTable();
    	$this->vCreateOrganisationUserRoleTable();
    	
    }
	
	private function vCreateOrganisationTable(){
		
		$this->table('Organisation', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('iOrganisationNatureType',      'biginteger',   [ 'null'    => true ] )
			->addColumn('iOrganisationDomaineType',     'biginteger',   [ 'null'    => true ] )
			->addColumn('sNom',                         'string',       [ 'null'    => true,    'length' => 250 ] )
			->addColumn('sUrl',                         'string',       [ 'null'    => true ] )
			->addColumn('sLogo',                        'string',       [ 'null'    => true ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'sNom',                         [ 'name' => 'Organisation_Nom', 'unique' => true ] )
			
			->create();
	}
	
	private function vCreateOrganisationAdresseTable(){
		
		$this->table('OrganisationAdresse', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true ] )
			->addColumn('sAdresseDescription',          'string',       [ 'null'    => true,    'length' => 255 ] )
			->addColumn('sAdresseNumeroCivique',        'string',       [ 'null'    => true,    'length' => 15  ] )
			->addColumn('sAdressePorte',                'string',       [ 'null'    => true,    'length' => 10  ] )
			->addColumn('sAdresseRue',                  'string',       [ 'null'    => true,    'length' => 100 ] )
			->addColumn('sAdresseVille',                'string',       [ 'null'    => true,    'length' => 100 ] )
			->addColumn('sAdresseProvince',             'string',       [ 'null'    => true,    'length' => 20  ] )
			->addColumn('sAdressePays',                 'string',       [ 'null'    => true,    'length' => 20  ] )
			->addColumn('sAdresseCodePostal',           'string',       [ 'null'    => true,    'length' => 15  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     [   'fkiOrganisationId',
								'sAdresseDescription',
								'sAdresseNumeroCivique',
								'sAdressePorte',
								'sAdresseRue',
								'sAdresseVille',
								'sAdresseProvince',
								'sAdressePays',
								'sAdresseCodePostal' ],              [ 'name' => 'OrganisationAdresse_clOrganisationAdresse' ] )

			->create();
	}
	
	private function vCreateOrganisationConfigurationTable(){
		
		$this->table('OrganisationConfiguration', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false ] )
			->addColumn('sKey',                         'biginteger',   [ 'null'    => false,   'length' => 100 ] )
			->addColumn('sValue',                       'biginteger',   [ 'null'    => true,  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     [   'fkiOrganisationId',
								'sKey' ],                            [ 'name' => 'OrganisationConfiguration_uq_key_per_organisation', 'unique' => true ] )
			
			->create();
	}
	
	private function vCreateOrganisationNumeroTelTable(){
		
		$this->table('OrganisationNumeroTel', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true ] )
			->addColumn('sNumeroTel',                   'string',       [ 'null'    => true,    'length' => 10  ] )
			->addColumn('iOrganisationNumeroTelType',   'biginteger',   [ 'null'    => true ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     [ 'fkiOrganisationId', 'sNumeroTel' ],                     [ 'name' => 'OrganisationNumeroTel_OrganisationNumeroTel', 'unique' => true ] )
			
			->create();
	}
	
	private function vCreateOrganisationRelationTable(){
		
		$this->table('OrganisationRelation', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationA',             'biginteger',   [ 'null'    => true ] )
			->addColumn('fkiOrganisationB',             'biginteger',   [ 'null'    => true ] )
			->addColumn('bIsASupersetOfB',              'biginteger',   [ 'null'    => true ] )
			->addColumn('iOrganisationRelationType',    'biginteger',   [ 'null'    => true ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     [ 'fkiOrganisationA', 'fkiOrganisationB' ],   [ 'name' => 'OrganisationRelation_RelationOrgAOrgB', 'unique' => true ] )
			
			->create();
	}
	
	private function vCreateOrganisationUserRoleTable(){
		
		$this->table('OrganisationUserRole', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true ] )
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iOrganisationUserRoleType',    'biginteger',   [ 'null'    => true ] )
			->addColumn('sAccessbits',                  'string',       [ 'null'    => true,    'length' => 100 ] )
			->addColumn('iValidDate',                   'biginteger',   [ 'null'    => true ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_OrganisationUserRole_Organisation' ] )
			->addIndex(     'fkiUserId',                    [ 'name' => 'idx_OrganisationUserRole_User' ] )
			->addIndex(     'iOrganisationUserRoleType',    [ 'name' => 'idx_OrganisationUserRole_UserRoleType' ] )
			->addIndex(     [ 'fkiOrganisationId',
				              'fkiUserId',
				              'iOrganisationUserRoleType' ],   [ 'name' => 'OrganisationUserRole_OrganisationUserRole', 'unique' => true ] )
			
			->create();
	}

}
