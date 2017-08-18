<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class ParkingMigration extends AbstractMigration{

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

		$this->vCreateParkingAreaTable();
		$this->vCreateParkingAreaPeriodTable();
		$this->vCreateParkingAreaRateTable();
		$this->vCreateParkingAreaZoneTable();
		$this->vCreateParkingBankPlanTable();
		$this->vCreateParkingBankTransactionTable();
		$this->vCreateParkingReservationTable();
	}

	protected function vCreateParkingAreaTable(){
		
		$this->table('ParkingArea', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity'  => true))
			
			->addColumn('fkiOrganisationId',            'biginteger',   array('null'    => false))
			->addColumn('sName',                        'string',       array('null'    => false))
			->addColumn('sDescription',                 'string',       array('null'    => false))
			->addColumn('iStatusId',                    'biginteger',   array('null'    => false))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => false))
			->addColumn('iModification',                'biginteger',   array('null'    => false))
			
			->addIndex(     'bDeleted',                                          array('name' => 'idx_deleted'))
			->addIndex(     'fkiOrganisationId',                                 array('name' => 'idx_organisation'))
			->addIndex(     'iStatusId',                                         array('name' => 'idx_status'))
			
			->create();
	}

	protected function vCreateParkingAreaPeriodTable(){
		
		$this->table('ParkingAreaPeriod', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity'  => true))
			
			->addColumn('fkiOrganisationId',                'biginteger',   array('null'    => false))
			->addColumn('fkiParkingAreaId',                 'biginteger',   array('null'    => false))
			->addColumn('fkiPeriodId',                      'biginteger',   array('null'    => false))
			->addColumn('sName',                            'string',       array('null'    => false))
			->addColumn('sDescription',                     'string',       array('null'    => false))
			->addColumn('iMaxParkingTimeInSeconds',         'biginteger',   array('null'    => false))
			->addColumn('bEnablePrepaymentForNextPeriod',   'integer',      array('null'    => false))
			->addColumn('iStatusId',                        'biginteger',   array('null'    => false))

			->addColumn('bDeleted',                         'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                        'biginteger',   array('null'    => false))
			->addColumn('iModification',                    'biginteger',   array('null'    => false))
			
			->addIndex(     'bDeleted',                                              array('name' => 'idx_deleted'))
			->addIndex(     'fkiOrganisationId',                                     array('name' => 'idx_organisation'))
			->addIndex(     'fkiPeriodId',                                           array('name' => 'idx_period'))
			->addIndex(     'iStatusId',                                             array('name' => 'idx_status'))
			
			->create();
	}

	protected function vCreateParkingAreaRateTable(){
		
		$this->table('ParkingAreaRate', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity'  => true))
			
			->addColumn('fkiOrganisationId',                'biginteger',   array('null'    => false))
			->addColumn('fkiParkingAreaPeriodId',           'biginteger',   array('null'    => false))
			->addColumn('sName',                            'string',       array('null'    => false))
			->addColumn('sDescription',                     'string',       array('null'    => false))
			->addColumn('dPriceTaxExcluded',                'decimal',      array('null'    => false,   'precision' => 20, 'scale' => 8))
			->addColumn('dPriceTaxAmount',                  'decimal',      array('null'    => false,   'precision' => 20, 'scale' => 8))
			->addColumn('dPriceTaxIncluded',                'decimal',      array('null'    => false,   'precision' => 20, 'scale' => 8))
			->addColumn('sPriceTaxList',                    'string',       array('null'    => false))
			->addColumn('iTimeQuantityPerUnitTime',         'biginteger',   array('null'    => false))
			->addColumn('iUnitTimeId',                      'biginteger',   array('null'    => false))
			->addColumn('iDurationInSeconds',               'biginteger',   array('null'    => false))
			->addColumn('iStatusId',                        'biginteger',   array('null'    => false))

			->addColumn('bDeleted',                         'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                        'biginteger',   array('null'    => false))
			->addColumn('iModification',                    'biginteger',   array('null'    => false))
			
			->addIndex(     'bDeleted',                                              array('name' => 'idx_deleted'))
			->addIndex(     'fkiOrganisationId',                                     array('name' => 'idx_organisation'))
			->addIndex(     'fkiParkingAreaPeriodId',                                array('name' => 'idx_parking_area_period'))
			->addIndex(     'iStatusId',                                             array('name' => 'idx_status'))
			
			->create();
	}

	protected function vCreateParkingAreaZoneTable(){
		
		$this->table('ParkingAreaZone', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity'  => true))
			
			->addColumn('fkiParkingAreaId',                 'biginteger',   array('null'    => false))
			->addColumn('fkiZoneId',                        'biginteger',   array('null'    => false))
			
			->addColumn('bDeleted',                         'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                        'biginteger',   array('null'    => false))
			->addColumn('iModification',                    'biginteger',   array('null'    => false))
			
			->addIndex(     'bDeleted',                                              array('name' => 'idx_deleted'))
			->addIndex(     'fkiParkingAreaId',                                      array('name' => 'idx_parking_area'))
			->addIndex(     'fkiZoneId',                                             array('name' => 'idx_zone'))
			
			->create();
	}

	protected function vCreateParkingBankPlanTable(){
		
		$this->table('ParkingBankPlan', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity'  => true))
			
			->addColumn('fkiOrganisationId',                'biginteger',   array('null'    => false))
			->addColumn('sName',                            'string',       array('null'    => false))
			->addColumn('sDescription',                     'string',       array('null'    => false))
			->addColumn('dAmount',                          'decimal',      array('null'    => false,   'precision' => 20, 'scale' => 8))
			->addColumn('dPriceTaxExcluded',                'decimal',      array('null'    => false,   'precision' => 20, 'scale' => 8))
			->addColumn('dPriceTaxAmount',                  'decimal',      array('null'    => false,   'precision' => 20, 'scale' => 8))
			->addColumn('dPriceTaxIncluded',                'decimal',      array('null'    => false,   'precision' => 20, 'scale' => 8))
			->addColumn('dFeeTaxExcluded',                  'decimal',      array('null'    => false,   'precision' => 20, 'scale' => 8))
			->addColumn('dFeeTaxAmount',                    'decimal',      array('null'    => false,   'precision' => 20, 'scale' => 8))
			->addColumn('dFeeTaxIncluded',                  'decimal',      array('null'    => false,   'precision' => 20, 'scale' => 8))
			->addColumn('sTaxList',                         'string',       array('null'    => false))
			->addColumn('dBcitiFeeTaxExcluded',             'decimal',      array('null'    => false,   'precision' => 20, 'scale' => 8))
			->addColumn('dBcitiFeeTaxAmount',               'decimal',      array('null'    => false,   'precision' => 20, 'scale' => 8))
			->addColumn('dBcitiFeeTaxIncluded',             'decimal',      array('null'    => false,   'precision' => 20, 'scale' => 8))
			->addColumn('iStatusId',                        'biginteger',   array('null'    => false))
			
			->addColumn('bDeleted',                         'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                        'biginteger',   array('null'    => false))
			->addColumn('iModification',                    'biginteger',   array('null'    => false))
			
			->addIndex(     'bDeleted',                                              array('name' => 'idx_deleted'))
			->addIndex(     'fkiOrganisationId',                                     array('name' => 'idx_organisation'))
			->addIndex(     'iStatusId',                                             array('name' => 'idx_status'))
			
			->create();
	}

	protected function vCreateParkingBankTransactionTable(){
		
		$this->table('ParkingBankTransaction', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity'  => true))
			
			->addColumn('fkiOrganisationId',                'biginteger',   array('null'    => false))
			->addColumn('fkiMakerUserId',                   'biginteger',   array('null'    => false))
			->addColumn('fkiOwnerUserId',                   'biginteger',   array('null'    => false))
			->addColumn('fkiParkingReservationId',          'biginteger',   array('null'    => true))
			->addColumn('fkiParkingBankPlanId',             'biginteger',   array('null'    => true))
			->addColumn('fkiInvoiceId',                     'biginteger',   array('null'    => true))
			->addColumn('iTypeId',                          'biginteger',   array('null'    => false))
			->addColumn('dAmount',                          'decimal',      array('null'    => false,   'precision' => 20, 'scale' => 8))
			->addColumn('iReasonId',                        'biginteger',   array('null'    => false))
			->addColumn('sUserNote',                        'string',       array('null'    => false))
			
			->addColumn('bDeleted',                         'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                        'biginteger',   array('null'    => false))
			->addColumn('iModification',                    'biginteger',   array('null'    => false))
			
			->addIndex(     'bDeleted',                                              array('name' => 'idx_deleted'))
			->addIndex(     'fkiInvoiceId',                                          array('name' => 'idx_invoice'))
			->addIndex(     'fkiOrganisationId',                                     array('name' => 'idx_organisation'))
			->addIndex(     'fkiParkingBankPlanId',                                  array('name' => 'idx_parking_bank_plan'))
			->addIndex(     'fkiParkingReservationId',                               array('name' => 'idx_parking_reservation'))
			->addIndex(     'iTypeId',                                               array('name' => 'idx_type'))
			->addIndex(     'fkiMakerUserId',                                        array('name' => 'idx_user_maker'))
			->addIndex(     'fkiOwnerUserId',                                        array('name' => 'idx_user_owner'))
			
			->create();
	}

	protected function vCreateParkingReservationTable(){
		
		$this->table('ParkingReservation', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity'  => true))
			
			->addColumn('fkiOrganisationId',                'biginteger',   array('null'    => false))
			->addColumn('fkiUserId',                        'biginteger',   array('null'    => false))
			->addColumn('fkiPreviousParkingReservationId',  'biginteger',   array('null'    => true))
			->addColumn('fkiInvoiceId',                     'biginteger',   array('null'    => true))
			->addColumn('fkiLocationId',                    'biginteger',   array('null'    => false))
			->addColumn('iStartDate',                       'biginteger',   array('null'    => false))
			->addColumn('iEndDate',                         'biginteger',   array('null'    => false))
			->addColumn('iLeaveDate',                       'biginteger',   array('null'    => false))
			->addColumn('sNotificationList',                'string',       array('null'    => false))
			->addColumn('iStatusId',                        'biginteger',   array('null'    => false))
			
			->addColumn('bDeleted',                         'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                        'biginteger',   array('null'    => false))
			->addColumn('iModification',                    'biginteger',   array('null'    => false))
			
			->addIndex(     'bDeleted',                                              array('name' => 'idx_deleted'))
			->addIndex(     'fkiInvoiceId',                                          array('name' => 'idx_invoice'))
			->addIndex(     'fkiLocationId',                                         array('name' => 'idx_location'))
			->addIndex(     'fkiOrganisationId',                                     array('name' => 'idx_organisation'))
			->addIndex(     'fkiPreviousParkingReservationId',                       array('name' => 'idx_previous_reservation'))
			->addIndex(     'iStatusId',                                             array('name' => 'idx_status'))
			->addIndex(     'fkiUserId',                                             array('name' => 'idx_user'))
			
			->create();
	}
}