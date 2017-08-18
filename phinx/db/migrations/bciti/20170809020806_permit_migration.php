<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class PermitMigration extends AbstractMigration{

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

		$this->vCreatePermitTable();
		$this->vCreatePermitApplicationTable();
		$this->vCreatePermitApplicationDocumentTable();
		$this->vCreatePermitApplicationInternalStateTable();
		$this->vCreatePermitApplicationRelatedObjectTable();
		$this->vCreatePermitApplicationStateTable();
		$this->vCreatePermitCategoryTable();
		$this->vCreatePermitPermissionTable();
		$this->vCreatePermitPermissionZoneTable();
		$this->vCreatePermitSubscriptionTable();
		$this->vCreatePermitSubscriptionInternalStateTable();
		$this->vCreatePermitSubscriptionRelatedObjectTable();
		$this->vCreatePermitSubscriptionStateTable();
		$this->vCreatePermitWaitingListConfigTable();
	}

	protected function vCreatePermitTable(){
		
		$this->table('Permit', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity'  => true ))
			
			->addColumn('fkiOrganisationId',            'biginteger',   array('null'    => false   ))
			->addColumn('fkiPermitCategoryId',          'biginteger',   array('null'    => false   ))
			->addColumn('sExternalIdentifier',          'string',       array('length'  => 255,     'null'    => false))
			->addColumn('sPrefix',                      'string',       array('length'  => 50,      'null'    => false))
			->addColumn('sName',                        'string',       array('null'    => false))
			->addColumn('sDescription',                 'string',       array('null'    => false))
			->addColumn('sLongDescription',             'string',       array('null'    => false))
			->addColumn('iQuantityId',                  'biginteger',   array('null'    => false))
			->addColumn('iQuantityActualAvailability',  'integer',      array('null'    => true))
			->addColumn('iQuantityOverbooking',         'integer',      array('null'    => true))
			->addColumn('iVisibilityId',                'biginteger',   array('null'    => false))
			->addColumn('iMaxPermitPerUser',            'biginteger',   array('null'    => true))
			->addColumn('iControlId',                   'biginteger',   array('null'    => false,   'default' => 1))
			->addColumn('iStatusId',                    'biginteger',   array('null'    => false,   'default' => 1))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))

			
			->addIndex(     'bDeleted',                                          array('name' => 'idx_deleted'))
			->addIndex(     'fkiOrganisationId',                                 array('name' => 'idx_organisation'))
			->addIndex(     'fkiPermitCategoryId',                               array('name' => 'idx_permit_category'))
			->addIndex(     'iStatusId',                                         array('name' => 'idx_status'))
			->addIndex(     'iVisibilityId',                                     array('name' => 'idx_visibility'))
			
			->create();
	}

	protected function vCreatePermitApplicationTable(){
		
		$this->table('PermitApplication', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity'  => true))
			
			->addColumn('fkiOrganisationId',                'biginteger',   array('null'    => false))
			->addColumn('fkiUserId',                        'biginteger',   array('null'    => false))
			->addColumn('fkiPermitId',                      'biginteger',   array('null'    => false))
			->addColumn('fkiSubscriptionPlanId',            'biginteger',   array('null'    => false))
			->addColumn('fkiSubscriptionPlanRecurrenceId',  'biginteger',   array('null'    => false))
			->addColumn('fkiPreferredPaymentMethodId',      'biginteger',   array('null'    => false))
			->addColumn('fkiPreferredPaymentTermId',        'biginteger',   array('null'    => false))
			->addColumn('iTypeId',                          'biginteger',   array('null'    => false,   'default' => 1))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                              array('name'    => 'idx_deleted'))
			->addIndex(     'fkiOrganisationId',                                     array('name'    => 'idx_organisation'))
			->addIndex(     'fkiUserId',                                             array('name'    => 'idx_user'))
			
			->create();
			
	}

	protected function vCreatePermitApplicationDocumentTable(){
		
		$this->table('PermitApplicationDocument', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity' => true))
			
			->addColumn('fkiOrganisationId',                'biginteger',   array('null'    => false))
			->addColumn('fkiPermitApplicationId',           'biginteger',   array('null'    => false))
			->addColumn('fkiDocumentId',                    'biginteger',   array('null'    => false))
			->addColumn('fkiFichierId',                     'biginteger',   array('null'    => false))
			->addColumn('iStatusId',                        'biginteger',   array('null'    => false))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                              array('name'    => 'idx_deleted'))
			->addIndex(     'fkiOrganisationId',                                     array('name'    => 'idx_organisation'))
			->addIndex(     'fkiPermitApplicationId',                                array('name'    => 'idx_permit_application'))
			
			->create();
		
		
	}

	protected function vCreatePermitApplicationInternalStateTable(){
		
		$this->table('PermitApplicationInternalState', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity' => true))
			
			->addColumn('fkiOrganisationId',                'biginteger',   array('null'    => false))
			->addColumn('fkiPermitApplicationId',           'biginteger',   array('null'    => false))
			->addColumn('iStatusId',                        'biginteger',   array('null'    => false))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                              array('name'    => 'idx_deleted'))
			->addIndex(     'fkiOrganisationId',                                     array('name'    => 'idx_organisation'))
			->addIndex(     'fkiPermitApplicationId',                                array('name'    => 'idx_permit_application'))
			
			->create();
		
		
		
	}

	protected function vCreatePermitApplicationRelatedObjectTable(){
		
		$this->table('PermitApplicationRelatedObject', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity' => true))
			
			->addColumn('fkiOrganisationId',                'biginteger',   array('null'    => false))
			->addColumn('fkiPermitApplicationId',           'biginteger',   array('null'    => false))
			->addColumn('sRelatedObjectTypeId',             'string',       array('null'    => false,   'length'  => 50))
			->addColumn('iRelatedObjectId',                 'biginteger',   array('null'    => false))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                              array('name'    => 'idx_deleted'))
			->addIndex(     'fkiOrganisationId',                                     array('name'    => 'idx_organisation'))
			->addIndex(     'fkiPermitApplicationId',                                array('name'    => 'idx_permit_application'))
			
			->create();
		
		
	}

	protected function vCreatePermitApplicationStateTable(){
		
		$this->table('PermitApplicationState', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity' => true))
			
			->addColumn('fkiOrganisationId',                'biginteger',   array('null'    => false))
			->addColumn('fkiPermitApplicationId',           'biginteger',   array('null'    => false))
			->addColumn('iStatusId',                        'biginteger',   array('null'    => false))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                              array('name'    => 'idx_deleted'))
			->addIndex(     'fkiOrganisationId',                                     array('name'    => 'idx_organisation'))
			->addIndex(     'fkiPermitApplicationId',                                array('name'    => 'idx_permit_application'))
			
			->create();
		
	}

	protected function vCreatePermitCategoryTable(){
		
		$this->table('PermitCategory', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity' => true))
			
			->addColumn('fkiOrganisationId',                'biginteger',   array('null'    => false))
			->addColumn('iPermitTypeId',                    'biginteger',   array('null'    => false))
			->addColumn('sName',                            'string',       array('null'    => false))
			->addColumn('sDescription',                     'string',       array('null'    => false))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                              array('name'    => 'idx_deleted'))
			->addIndex(     'fkiOrganisationId',                                     array('name'    => 'idx_organisation'))
			->addIndex(     'iPermitTypeId',                                         array('name'    => 'idx_permit_type'))
			
			->create();
		
		
	}

	protected function vCreatePermitPermissionTable(){
		
		$this->table('PermitPermission', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity' => true))
			
			->addColumn('fkiOrganisationId',                'biginteger',   array('null'    => false))
			->addColumn('fkiPermitId',                      'biginteger',   array('null'    => false))
			->addColumn('fkiValidityPeriodId',              'biginteger',   array('null'    => false))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                              array('name'    => 'idx_deleted'))
			->addIndex(     'fkiOrganisationId',                                     array('name'    => 'idx_organisation'))
			->addIndex(     'fkiPermitId',                                           array('name'    => 'idx_permit'))
			
			->create();
		
	}

	protected function vCreatePermitPermissionZoneTable(){
		
		$this->table('PermitPermissionZone', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity' => true))
			
			->addColumn('fkiPermitPermissionId',            'biginteger',   array('null'    => false))
			->addColumn('fkiZoneId',                        'biginteger',   array('null'    => false))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                              array('name'    => 'idx_deleted'))
			->addIndex(     'fkiPermitPermissionId',                                 array('name'    => 'idx_permit'))
			->addIndex(     'fkiZoneId',                                             array('name'    => 'idx_zone'))
			
			->create();
		
	}

	protected function vCreatePermitSubscriptionTable(){
		
		$this->table('PermitSubscription', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity' => true))
			
			->addColumn('fkiOrganisationId',                'biginteger',   array('null'    => false))
			->addColumn('fkiUserId',                        'biginteger',   array('null'    => false))
			->addColumn('fkiPermitId',                      'biginteger',   array('null'    => false))
			->addColumn('fkiSubscriptionPlanId',            'biginteger',   array('null'    => false))
			->addColumn('fkiSubscriptionPlanRecurrenceId',  'biginteger',   array('null'    => false))
			->addColumn('fkiPermitApplicationId',           'biginteger',   array('null'    => false))
			->addColumn('sNumber',                          'string',       array('null'    => false))
			->addColumn('iStartValidityDate',               'biginteger',   array('null'    => false))
			->addColumn('iEndValidityDate',                 'biginteger',   array('null'    => false))
			->addColumn('fkiInvoiceId',                     'biginteger',   array('null'    => false))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                              array('name'    => 'idx_deleted'))
			->addIndex(     'fkiOrganisationId',                                     array('name'    => 'idx_organisation'))
			->addIndex(     'fkiPermitId',                                           array('name'    => 'idx_permit'))
			->addIndex(     'fkiUserId',                                             array('name'    => 'idx_user'))
			
			->create();
		
	}

	protected function vCreatePermitSubscriptionInternalStateTable(){
		
		$this->table('PermitSubscriptionInternalState', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity' => true))
			
			->addColumn('fkiOrganisationId',                'biginteger',   array('null'    => false))
			->addColumn('fkiPermitSubscriptionId',          'biginteger',   array('null'    => false))
			->addColumn('fkiStatusId',                      'biginteger',   array('null'    => false))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                              array('name'    => 'idx_deleted'))
			->addIndex(     'fkiOrganisationId',                                     array('name'    => 'idx_organisation'))
			->addIndex(     'fkiPermitSubscriptionId',                               array('name'    => 'idx_permit_subscription'))
			
			->create();
		
	}

	protected function vCreatePermitSubscriptionRelatedObjectTable(){

		$this->table('PermitSubscriptionRelatedObject', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity' => true))
			
			->addColumn('fkiOrganisationId',                'biginteger',   array('null'    => false))
			->addColumn('fkiPermitSubscriptionId',          'biginteger',   array('null'    => false))
			->addColumn('sRelatedObjectTypeId',             'string',       array('null'    => false,   'length'  => 50))
			->addColumn('iRelatedObjectId',                 'biginteger',   array('null'    => false))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                              array('name'    => 'idx_deleted'))
			->addIndex(     'fkiOrganisationId',                                     array('name'    => 'idx_organisation'))
			->addIndex(     'fkiPermitSubscriptionId',                               array('name'    => 'idx_permit_application'))
			
			->create();
		
	}

	protected function vCreatePermitSubscriptionStateTable(){
		
		$this->table('PermitSubscriptionState', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity' => true))
			
			->addColumn('fkiOrganisationId',                'biginteger',   array('null'    => false))
			->addColumn('fkiPermitSubscriptionId',          'biginteger',   array('null'    => false))
			->addColumn('iStatusId',                        'biginteger',   array('null'    => false))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                              array('name'    => 'idx_deleted'))
			->addIndex(     'fkiOrganisationId',                                     array('name'    => 'idx_organisation'))
			->addIndex(     'fkiPermitSubscriptionId',                               array('name'    => 'idx_permit_subscription'))
			
			->create();
		
	}

	protected function vCreatePermitWaitingListConfigTable(){
		
		$this->table('PermitWaitingListConfig', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity' => true))
			
			->addColumn('fkiOrganisationId',                'biginteger',   array('null'    => false))
			->addColumn('fkiPermitId',                      'biginteger',   array('null'    => false))
			->addColumn('iUserReplyTimeQuantity',           'biginteger',   array('null'    => true,))
			->addColumn('iUserReplyUnitTimeId',             'biginteger',   array('null'    => true,))
			->addColumn('iManagingTypeId',                  'biginteger',   array('null'    => true,))
			->addColumn('iStatusId',                        'biginteger',   array('null'    => false,   'default'   => 1))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                              array('name'    => 'idx_deleted'))
			->addIndex(     'fkiOrganisationId',                                     array('name'    => 'idx_organisation'))
			->addIndex(     'fkiPermitId',                                           array('name'    => 'idx_permit'))
			
			->create();
		
	}
}