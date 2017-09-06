<?php

use Phinx\Migration\AbstractMigration;

class SystExtMigration extends AbstractMigration
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

    	$this->vCreateSystExtAcceoLazer();
    	$this->vCreateSystExtAcceoLazerDataActivite();
    	$this->vCreateSystExtAcceoLazerDataMember();
    	$this->vCreateSystExtAcceoLazerMutex();
    	$this->vCreateSystExtAcceoLazerQueue();
    	$this->vCreateSystExtAcceoLudikFamille();
    	$this->vCreateSystExtAcceoLudikVerification();
    	$this->vCreateSystExtBibliomondo();
    	$this->vCreateSystExtCale();
    	$this->vCreateSystExtGlobal();
    	$this->vCreateSystExtGoogle();
    	$this->vCreateSystExtLinkId();
    	$this->vCreateSystExtLogin();
    	$this->vCreateSystExtLudikCsvRebellion();
    	$this->vCreateSystExtMamrotListVille();
    	$this->vCreateSystExtMessage();
    	$this->vCreateSystExtNotice();
    	$this->vCreateSystExtSomum();
    }
	
	private function vCreateSystExtAcceoLazer(){
		
		$this->table('SystExtAcceoLazer', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('sToken',                       'string',       [ 'null'    => true  ] )
			->addColumn('iExpiration',                  'biginteger',   [ 'null'    => true  ] )
			/**
			 * todo Pas de bDeleted ????
			 */
			//->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			//->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			->addIndex(     'iExpiration',                  [ 'name' => 'iExpiration' ] )
			
			->create();
	}
	
	private function vCreateSystExtAcceoLazerDataActivite(){
		
		$this->table('SystExtAcceoLazerDataActivite', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iSystExtActivityId',           'biginteger',   [ 'null'    => true  ] )
			->addColumn('sJsonData',                    'string',       [ 'null'    => true,   'length' => 1073741823  ] )

			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     [   'fkiOrganisationId',
								'fkiUserId',
								'iSystExtActivityId' ],              [ 'name' => 'idx_organisation' ] )
			
			->create();
	}
	
	private function vCreateSystExtAcceoLazerDataMember(){
		
		$this->table('SystExtAcceoLazerDataMember', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('sCard',                        'string',       [ 'null'    => true  ] )
			->addColumn('jsonData',                     'string',       [ 'null'    => true,   'length' => 1073741823  ] )
			
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iSystExtActivityId',           'biginteger',   [ 'null'    => true  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     [   'fkiOrganisationId', 'sCard' ],      [ 'name' => 'uq_card_organisation' ] )
			
			->create();
	}
	
	private function vCreateSystExtAcceoLazerMutex(){
		
		$this->table('SystExtAcceoLazerMutex', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )

			->addColumn('iTimeStamp',                   'biginteger',   [ 'null'    => true  ] )

			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->create();
	}
	
	private function vCreateSystExtAcceoLazerQueue(){
		
		$this->table('SystExtAcceoLazerQueue', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )

			->addColumn('sCommand',                     'string',       [ 'null'    => true,    'length' => 255  ] )
			->addColumn('sData',                        'string',       [ 'null'    => true,    'length' => 1073741823  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
	
	private function vCreateSystExtAcceoLudikFamille(){
		
		$this->table('SystExtAcceoLudikFamille', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )

			->addColumn('sIdentifiantNumero1',          'string',       [ 'null'    => true,    'length' => 255  ] )
			->addColumn('sIdentifiantNumero2',          'string',       [ 'null'    => true,    'length' => 255  ] )
			->addColumn('iUserRelationType',            'biginteger',   [ 'null'    => true  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
	
	private function vCreateSystExtAcceoLudikVerification(){
		
		$this->table('SystExtAcceoLudikVerification', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )

			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iVerification',                'biginteger',   [ 'null'    => true  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiUserId',                    [ 'name' => 'SystExtAcceoLudikVerification_fkiUserId', 'unique' => true ] )
			
			->create();
	}
	
	private function vCreateSystExtBibliomondo(){
		
		$this->table('SystExtBibliomondo', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )

			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('sContent',                     'string',       [ 'null'    => true,    'length' => 2000  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
	
	private function vCreateSystExtCale(){
		
		$this->table('SystExtCale', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false ] )
			->addColumn('fkiParkingReservationId',      'biginteger',   [ 'null'    => false ] )
			->addColumn('sRequest',                     'string',       [ 'null'    => false,   'length' => 1073741823 ] )
			->addColumn('sCaleReferenceId',             'string',       [ 'null'    => true,    'length' => 150  ] )
			->addColumn('sCaleErrorMessage',            'string',       [ 'null'    => true,    'length' => 1073741823  ] )
			->addColumn('iStatusId',                    'biginteger',   [ 'null'    => false ] )

			->addColumn('sContent',                     'string',       [ 'null'    => true,    'length' => 2000  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			->addIndex(     'fkiParkingReservationId',      [ 'name' => 'idx_parking_reservation' ] )
			
			->create();
	}
	
	private function vCreateSystExtGlobal(){
		
		$this->table('SystExtGlobal', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => false  ] )
			->addColumn('AVSMatch',                     'string',       [ 'null'    => true,    'length' => 10  ] )
			->addColumn('CVVMatch',                     'string',       [ 'null'    => true,    'length' => 10  ] )
			->addColumn('GT_MID',                       'string',       [ 'null'    => true,    'length' => 70  ] )
			->addColumn('GT_Trans_Id',                  'string',       [ 'null'    => true,    'length' => 70  ] )
			->addColumn('GT_Val_Code',                  'string',       [ 'null'    => true,    'length' => 70  ] )
			->addColumn('amount',                       'string',       [ 'null'    => true,    'length' => 10  ] )
			->addColumn('appCode',                      'string',       [ 'null'    => true,    'length' => 70  ] )
			->addColumn('approvalCode',                 'string',       [ 'null'    => true,    'length' => 70  ] )
			->addColumn('cardBrandSelected',            'string',       [ 'null'    => true,    'length' => 20  ] )
			->addColumn('ccNumber',                     'string',       [ 'null'    => true,    'length' => 30  ] )
			->addColumn('ccType',                       'string',       [ 'null'    => true,    'length' => 20  ] )
			->addColumn('customer_email',               'string',       [ 'null'    => true,    'length' => 100 ] )
			->addColumn('customer_id',                  'string',       [ 'null'    => true,    'length' => 10  ] )
			->addColumn('expMonth',                     'string',       [ 'null'    => true,    'length' => 2   ] )
			->addColumn('expYear',                      'string',       [ 'null'    => true,    'length' => 4   ] )
			->addColumn('merchantPass',                 'string',       [ 'null'    => true,    'length' => 70  ] )
			->addColumn('name',                         'string',       [ 'null'    => true,    'length' => 100 ] )
			->addColumn('paymentType',                  'string',       [ 'null'    => true,    'length' => 10  ] )
			->addColumn('rurl',                         'string',       [ 'null'    => true,    'length' => 255 ] )
			->addColumn('sessionId',                    'string',       [ 'null'    => true,    'length' => 10  ] )
			->addColumn('status',                       'string',       [ 'null'    => true,    'length' => 10  ] )
			->addColumn('transId',                      'string',       [ 'null'    => true,    'length' => 20  ] )
			->addColumn('transactionEnd',               'string',       [ 'null'    => true,    'length' => 15  ] )
			->addColumn('transactionStart',             'string',       [ 'null'    => true,    'length' => 15  ] )
			
			->create();
	}
	
	private function vCreateSystExtGoogle(){
		
		$this->table('SystExtGoogle', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iProviderId',                  'biginteger',   [ 'null'    => true,    'default' => 1  ] )
			->addColumn('iSystExtUserId',               'string',       [ 'null'    => true  ] )
			->addColumn('sBearerToken',                 'string',       [ 'null'    => true  ] )
			->addColumn('sPartialToken',                'string',       [ 'null'    => true  ] )
			->addColumn('iBearerTokenStart',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('bAdminLogin',                  'integer',      [ 'null'    => true  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			->addIndex(     'iProviderId',                  [ 'name' => 'idx_provider' ] )
			->addIndex(     'fkiUserId',                    [ 'name' => 'idx_user' ] )
			
			->create();
	}
	
	private function vCreateSystExtLinkId(){
		
		$this->table('SystExtLinkId', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iProviderId',                  'biginteger',   [ 'null'    => true,    'default' => 1  ] )
			->addColumn('iSystExtUserId',               'string',       [ 'null'    => true,   'length' => 1073741823  ] )
			->addColumn('sBearerToken',                 'string',       [ 'null'    => true,   'length' => 1073741823  ] )
			->addColumn('sPartialToken',                'string',       [ 'null'    => true,   'length' => 1073741823  ] )
			->addColumn('iBearerTokenStart',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('bAdminLogin',                  'integer',      [ 'null'    => true,    'default' => 0  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			->addIndex(     'iProviderId',                  [ 'name' => 'idx_provider' ] )
			->addIndex(     'fkiUserId',                    [ 'name' => 'idx_user' ] )
			
			->create();
	}
	
	private function vCreateSystExtLogin(){
		
		$this->table('SystExtLogin', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => false ] )
			->addColumn('sProviderId',                  'string',       [ 'null'    => false,   'length' => 50,  'default' => '' ] )
			->addColumn('sProviderUserId',              'string',       [ 'null'    => false,   'length' => 300 ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     [   'sProviderId',
								'sProviderUserId' ],                [ 'name' => 'idx_provider_user' ] )
			
			->create();
	}
	
	private function vCreateSystExtLudikCsvRebellion(){
		
		$this->table('SystExtLudikCsvRebellion', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('NO_PERS',                          'string',       [ 'null'    => true,    'length' => 100 ] )
			->addColumn('NOM',                              'string',       [ 'null'    => true,    'length' => 100 ] )
			->addColumn('PNOM',                             'string',       [ 'null'    => true,    'length' => 100 ] )
			->addColumn('DATE_NAIS',                        'string',       [ 'null'    => true,    'length' => 100 ] )
			->addColumn('RESID',                            'string',       [ 'null'    => true,    'length' => 100 ] )
			->addColumn('DATE_MODIF',                       'string',       [ 'null'    => true,    'length' => 100 ] )
			->addColumn('DATE_DEB_VALID',                   'string',       [ 'null'    => true,    'length' => 100 ] )
			->addColumn('DATE_FIN_VALID',                   'string',       [ 'null'    => true,    'length' => 100 ] )
			->addColumn('NO_CIV',                           'string',       [ 'null'    => true,    'length' => 100 ] )
			->addColumn('APP',                              'string',       [ 'null'    => true,    'length' => 100 ] )
			->addColumn('NOM_RUE',                          'string',       [ 'null'    => true,    'length' => 100 ] )
			->addColumn('VILLE',                            'string',       [ 'null'    => true,    'length' => 100 ] )
			->addColumn('LUDIK_LUD_C_PERS_CODE_UTIL_MODIF', 'string',       [ 'null'    => true,    'length' => 100 ] )
			->addColumn('NO_CLE_ADR',                       'string',       [ 'null'    => true,    'length' => 100 ] )
			
			->create();
	}
	
	private function vCreateSystExtMamrotListVille(){
		
		$this->table('SystExtMamrotListVille', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',                'biginteger',   [ 'null'    => true ] )
			->addColumn('sCode',                            'string',       [ 'null'    => true,    'length' => 255 ] )
			->addColumn('sVille',                           'string',       [ 'null'    => true,    'length' => 255 ] )
			->addColumn('sDesignation',                     'string',       [ 'null'    => true,    'length' => 20  ] )
			->addColumn('iRegionAdminCode',                 'biginteger',   [ 'null'    => true ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'sVille',                       [ 'name' => 'idx_city_name' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )

			->create();
	}
	
	private function vCreateSystExtMessage(){
		
		$this->table('SystExtMessage', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',                'biginteger',   [ 'null'    => false  ] )
			->addColumn('fkiMessageId',                     'biginteger',   [ 'null'    => false  ] )
			->addColumn('fkiUserId',                        'biginteger',   [ 'null'    => false  ] )
			->addColumn('iProviderId',                      'biginteger',   [ 'null'    => false  ] )
			->addColumn('iActionId',                        'biginteger',   [ 'null'    => false  ] )
			->addColumn('sConfirmationId',                  'string',       [ 'null'    => true,    'length' => 150 ] )
			->addColumn('sErrorMessage',                    'string',       [ 'null'    => true   ] )
			->addColumn('iStatusId',                        'biginteger',   [ 'null'    => false  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiMessageId',                 [ 'name' => 'fkiMessageId' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			
			->create();
	}
	
	private function vCreateSystExtNotice(){
		
		$this->table('SystExtNotice', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )

			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false  ] )
			->addColumn('iProviderId',                  'biginteger',   [ 'null'    => false  ] )
			->addColumn('iActionId',                    'biginteger',   [ 'null'    => false  ] )
			->addColumn('sConfirmationId',              'string',       [ 'null'    => true,    'length' => 150 ] )
			->addColumn('sErrorMessage',                'string',       [ 'null'    => true,    'length' => 1073741823 ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiMessageId',                 [ 'name' => 'fkiMessageId' ] )
			
			->create();
	}
	
	private function vCreateSystExtSomum(){
	
	}
}
