<?php

use Phinx\Migration\AbstractMigration;

class ServiceMigration extends AbstractMigration
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

    	$this->vCresteServiceTable();
    	$this->vCresteServiceAbonnementTable();
    }
	
	private function vCresteServiceTable(){
		
		$this->table('Service', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',                 'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiTransactionItemIdAdhesion',      'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiTransactionItemIdRenouvellement','biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiTransactionItemIdComtoirRe',     'biginteger',   [ 'null'    => true  ] )
			->addColumn('sSystExt',                          'string',       [ 'null'    => true  ] )
			->addColumn('fkJsonOrganisationUserRoleType',    'string',       [ 'null'    => true,   'length' => 255  ] )
			->addColumn('jsonRequiresOneOfService',          'string',       [ 'null'    => true,   'length' => 255  ] )
			->addColumn('iForceSubscriptionFirstDate',       'biginteger',   [ 'null'    => true  ] )
			->addColumn('iForceSubscriptionLastDate',        'biginteger',   [ 'null'    => true  ] )
			->addColumn('iForceExpire',                      'biginteger',   [ 'null'    => true  ] )
			->addColumn('iAgeMin',                           'biginteger',   [ 'null'    => true  ] )
			->addColumn('iAgeMax',                           'biginteger',   [ 'null'    => true  ] )
			->addColumn('sCode',                             'string',       [ 'null'    => true,   'length' => 8  ] )
			->addColumn('sNom',                              'string',       [ 'null'    => true  ] )
			->addColumn('sDescription',                      'string',       [ 'null'    => true  ] )
			->addColumn('strToTimeDuree',                    'string',       [ 'null'    => true,   'length' => 255  ] )
			->addColumn('bHeritageRelation',                 'integer',      [ 'null'    => false ] )
			->addColumn('sHeritageRelationExportToSystExt',  'string',       [ 'null'    => true,   'length' => 255  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			
			->create();
	}
	
	private function vCresteServiceAbonnementTable(){
		
		$this->table('ServiceAbonnement', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiServiceId',                 'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiTransactionId',             'biginteger',   [ 'null'    => true  ] )
			->addColumn('iEmission',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iExpiration',                  'biginteger',   [ 'null'    => true  ] )
			->addColumn('bRecurrent',                   'biginteger',   [ 'null'    => true  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'bRecurrent',                   [ 'name' => 'bRecurrent' ] )
			->addIndex(     'fkiServiceId',                 [ 'name' => 'fkiServiceId' ] )
			->addIndex(     'fkiTransactionId',             [ 'name' => 'fkiTransactionId' ] )
			->addIndex(     'fkiUserId',                    [ 'name' => 'fkiUserId' ] )
			->addIndex(     'iEmission',                    [ 'name' => 'iEmission' ] )
			->addIndex(     'iExpiration',                  [ 'name' => 'iExpiration' ] )
			
			->create();
	}
	
}
