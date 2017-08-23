<?php

use Phinx\Migration\AbstractMigration;

class SubscriptionPlanMigration extends AbstractMigration
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
	
    	$this->vCreateSubscriptionPLan();
    	$this->vCreateSubscriptionRecurrencePLan();
    	
    }
	
	private function vCreateSubscriptionPLan(){
		
		$this->table('SubscriptionPlan', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false ] )
			->addColumn('fkiPermitId',                  'biginteger',   [ 'null'    => false ] )
			->addColumn('sName',                        'string',       [ 'null'    => false ] )
			->addColumn('sDescription',                 'string',       [ 'null'    => false ] )
			->addColumn('iStatusId',                    'biginteger',   [ 'null'    => false,   'default' => 1 ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			->addIndex(     'fkiPermitId',                  [ 'name' => 'idx_permit' ] )
			
			->create();
	}
	
	private function vCreateSubscriptionRecurrencePLan(){
		
		$this->table('SubscriptionPlanRecurrence', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false ] )
			->addColumn('fkiSubscriptionPlanId',        'biginteger',   [ 'null'    => false ] )
			->addColumn('sType',                        'string',       [ 'null'    => false,   'length' => 50  ] )
			->addColumn('sName',                        'string',       [ 'null'    => false ] )
			->addColumn('sDescription',                 'string',       [ 'null'    => false ] )
			->addColumn('dPurchasePriceTaxExcluded',    'decimal',      [ 'null'    => false, 'precision' => 20, 'scale' => 8 ] )
			->addColumn('sPurchasePriceTaxList',        'string',       [ 'null'    => false ] )
			->addColumn('bPurchaseIsAvailable',         'integer',      [ 'null'    => false ] )
			->addColumn('dRenewalPriceTaxExcluded',     'decimal',      [ 'null'    => true,  'precision' => 20, 'scale' => 8 ] )
			->addColumn('sRenewalPriceTaxList',         'string',       [ 'null'    => false ] )
			->addColumn('bRenewalIsAvailable',          'integer',      [ 'null'    => false ] )
			->addColumn('iMaxRenewal',                  'integer',      [ 'null'    => false ] )
			->addColumn('sPaymentMethodList',           'string',       [ 'null'    => false ] )
			->addColumn('sPaymentTermList',             'string',       [ 'null'    => false ] )
			->addColumn('fkiProrataId',                 'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiValidityPeriodId',          'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiPurchasePeriodId',          'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiRenewalPeriodId',           'biginteger',   [ 'null'    => true  ] )
			->addColumn('iStartMonthId',                'biginteger',   [ 'null'    => true  ] )
			->addColumn('iStartDay',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('sStartTime',                   'string',       [ 'null'    => true ,   'length' => 8 ] )
			->addColumn('iTimeQuantity',                'biginteger',   [ 'null'    => true  ] )
			->addColumn('iUnitTimeId',                  'biginteger',   [ 'null'    => true  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			->addIndex(     'fkiSubscriptionPlanId',        [ 'name' => 'idx_subscription_plan' ] )
			->addIndex(     'sType',                        [ 'name' => 'idx_type' ] )
			
			->create();
	}
}
