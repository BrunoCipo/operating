<?php

use Phinx\Migration\AbstractMigration;

class UserMigration extends AbstractMigration
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

    	$this->vCreateUser();
    	$this->vCreateUserAdresse();
    	$this->vCreateUserDevice();
    	$this->vCreateUserIdentifiant();
    	$this->vCreateUserNumeroTel();
    	$this->vCreateUserRelation();
    }
	
	private function vCreateUser(){
		
		$this->table('User', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                       'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('sIdentificationNumber',        'string',       [ 'null'    => true,    'length' => 150  ] )
			->addColumn('sPassword',                    'string',       [ 'null'    => true,    'length' => 128  ] )
			->addColumn('sNomPrimaire',                 'string',       [ 'null'    => true,    'length' => 70   ] )
			->addColumn('sNomSecondaire',               'string',       [ 'null'    => true,    'length' => 70   ] )
			->addColumn('iDateNaissance',               'biginteger',   [ 'null'    => true  ] )
			->addColumn('iUserSexeType',                'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiPhotoId',                   'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiPhotoIdCrop',               'biginteger',   [ 'null'    => true  ] )
			->addColumn('iUniversalAccessibilityType',  'biginteger',   [ 'null'    => true  ] )
			->addColumn('sProfession',                  'string',       [ 'null'    => true,    'length' => 250  ] )
			->addColumn('iSchoolingType',               'biginteger',   [ 'null'    => true  ] )
			->addColumn('iCommLanguageType',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('sHomeLanguage',                'string',       [ 'null'    => true,    'length' => 250  ] )
			->addColumn('aInterests',                   'string',       [ 'null'    => true,    'length' => 32   ] )
			->addColumn('iActivitySector',              'biginteger',   [ 'null'    => true  ] )
			->addColumn('sCompany',                     'string',       [ 'null'    => true,    'length' => 250  ] )
			
			
			->addColumn('bDeleted',             'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',        'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'bDeleted' ] )
			->addIndex(     'fkiPhotoId',                   [ 'name' => 'fkiPhotoId' ] )
			->addIndex(     'iCommLanguageType',            [ 'name' => 'iCommLanguageType' ] )
			->addIndex(     'iDateNaissance',               [ 'name' => 'iDateNaissance' ] )
			->addIndex(     'sNomSecondaire',               [ 'name' => 'idx_user_first_name' ] )
			->addIndex(     'sNomPrimaire',                 [ 'name' => 'idx_user_last_name' ] )
			->addIndex(     'iSchoolingType',               [ 'name' => 'iSchoolingType' ] )
			->addIndex(     'iUniversalAccessibilityType',  [ 'name' => 'iUniversalAccessibilityType' ] )
			->addIndex(     'iUserSexeType',                [ 'name' => 'iUserSexeType' ] )
			
			->create();
	}
	
	private function vCreateUserAdresse(){
		
		$this->table('UserAdresse', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                       'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iAdressSystExtId',             'biginteger',   [ 'null'    => true  ] )
			->addColumn('iUserAdressSystExtId',         'biginteger',   [ 'null'    => true  ] )
			->addColumn('sAdresseDescription',          'string',       [ 'null'    => true,    'length' => 255  ] )
			->addColumn('iUserAdresseType',             'biginteger',   [ 'null'    => true  ] )
			->addColumn('bAdresseProprietaire',         'integer',      [ 'null'    => true  ] )
			->addColumn('bAdresseCorrespondancePostale','integer',      [ 'null'    => true  ] )
			->addColumn('sAdresseNumeroCivique',        'integer',      [ 'null'    => true  ] )
			->addColumn('sAdressePorte',                'string',       [ 'null'    => true,    'length' => 10  ] )
			->addColumn('sAdresseRue',                  'string',       [ 'null'    => true,    'length' => 100 ] )
			->addColumn('sAdresseVille',                'string',       [ 'null'    => true,    'length' => 100 ] )
			->addColumn('iAdresseVille',                'biginteger',   [ 'null'    => true  ] )
			->addColumn('sAdresseProvince',             'string',       [ 'null'    => true,    'length' => 20  ] )
			->addColumn('sAdressePays',                 'string',       [ 'null'    => true,    'length' => 20  ] )
			->addColumn('sAdresseCodePostal',           'string',       [ 'null'    => true,    'length' => 15  ] )
			->addColumn('sAdresseLettre',               'string',       [ 'null'    => true,    'length' => 1   ] )

			->addColumn('bDeleted',             'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',        'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiUserId',                    [ 'name' => 'fkiUserId' ] )
			->addIndex(     'iAdresseVille',                [ 'name' => 'iAdresseVille' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			->addIndex(     'iUserAdresseType',             [ 'name' => 'iUserAdresseType' ] )
			->addIndex(     'sAdresseCodePostal',           [ 'name' => 'sAdresseCodePostal' ] )
			->addIndex(     'sAdresseNumeroCivique',        [ 'name' => 'sAdresseNumeroCivique' ] )
			->addIndex(     'sAdressePays',                 [ 'name' => 'sAdressePays' ] )
			->addIndex(     'sAdressePorte',                [ 'name' => 'sAdressePorte' ] )
			->addIndex(     'sAdresseProvince',             [ 'name' => 'sAdresseProvince' ] )
			->addIndex(     'sAdresseRue',                  [ 'name' => 'sAdresseRue' ] )
			->addIndex(     'sAdresseVille',                [ 'name' => 'sAdresseVille' ] )
			
			->create();
	}
	
	private function vCreateUserDevice(){
		
		$this->table('UserDevice', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                       'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => false  ] )
			->addColumn('sApplicationName',             'string',       [ 'null'    => false,    'length' => 30,    'default' => ''  ] )
			->addColumn('sDeviceIdentifier',            'string',       [ 'null'    => false,    'length' => 300,   'default' => '' ] )
			
			->addColumn('bDeleted',             'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',        'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'sDeviceIdentifier',            [ 'name' => 'idx_device_identifier' ] )
			->addIndex(     'fkiUserId',                    [ 'name' => 'idx_user' ] )
			
			->create();
	}
	
	private function vCreateUserIdentifiant(){
		
		$this->table('UserIdentification', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                       'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => true   ] )
			->addColumn('sIdentifiantNumero',           'string',       [ 'null'    => true ,    'length' => 50   ] )
			->addColumn('iUserIdentifiantType',         'biginteger',   [ 'null'    => true   ] )
			->addColumn('bOpen',                        'integer',      [ 'null'    => true   ] )
			->addColumn('bVerified',                    'integer',      [ 'null'    => true   ] )
			
			->addColumn('bDeleted',             'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',        'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'sIdentifiantNumero',           [ 'name' => 'sIdentifiantNumero',           'unique' => true ] )
			->addIndex(     ['fkiUserId',
							 'iUserIdentifiantType' ],               [ 'name' => 'uq_userid_identifianttype',    'unique' => true ] )
			->addIndex(     'fkiUserId',                     [ 'name' => 'fkiUserId' ] )
			->addIndex(     'iUserIdentifiantType',          [ 'name' => 'iUserIdentifiantType' ] )
			
			->create();
	}
	
	private function vCreateUserNumeroTel(){
		
		$this->table('UserNumeroTel', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                       'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiUserId',                'biginteger',   [ 'null'    => true   ] )
			->addColumn('sNumeroTel',               'string',       [ 'null'    => true ,    'length' => 50   ] )
			->addColumn('sExtensionNumber',         'string',       [ 'null'    => true ,    'length' => 50   ] )
			->addColumn('iUserNumeroTelType',       'biginteger',   [ 'null'    => true   ] )
			->addColumn('sCode',                    'string',       [ 'null'    => true ,    'length' => 6    ] )
			->addColumn('iCodeExpiration',          'biginteger',   [ 'null'    => true   ] )
			
			->addColumn('bDeleted',             'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',        'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                      [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiUserId',                     [ 'name' => 'fkiUserId' ] )
			->addIndex(     'iUserNumeroTelType',            [ 'name' => 'iUserNumeroTelType' ] )
			->addIndex(     'sNumeroTel',                    [ 'name' => 'sNumeroTel' ] )
			->addIndex(     [   'sNumeroTel',
								'fkiUserId',
								'iUserNumeroTelType' ],             [ 'name' => 'NumeroTelUser',    'unique' => true ] )

			->create();
	}
	
	private function vCreateUserRelation(){
		
		$this->table('UserRelation', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                       'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',    'biginteger',   [ 'null'    => true   ] )
			->addColumn('fkiUserId1',           'biginteger',   [ 'null'    => true   ] )
			->addColumn('fkiUserId2',           'biginteger',   [ 'null'    => true   ] )
			->addColumn('iUserRelationType',    'integer',      [ 'null'    => true   ] )
			->addColumn('iFamilyId',            'biginteger',   [ 'null'    => true   ] )
			->addColumn('iLinkType',            'biginteger',   [ 'null'    => true   ] )
			->addColumn('bVerify',              'integer',      [ 'null'    => true   ] )
			
			->addColumn('bDeleted',             'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',        'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'bVerify',                      [ 'name' => 'bVerify' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'fkiOrganisationId' ] )
			->addIndex(     'fkiUserId1',                   [ 'name' => 'fkiUserId1' ] )
			->addIndex(     'fkiUserId2',                   [ 'name' => 'fkiUserId2' ] )
			->addIndex(     'iUserRelationType',            [ 'name' => 'iUserRelationType' ] )
			->addIndex(     [   'fkiUserId1',
								'fkiUserId2',
								'fkiOrganisationId' ],              [ 'name' => 'UserRelation_RelationIntegrite',    'unique' => true ] )
			
			->create();
	}
}
