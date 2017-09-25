<?php

use Phinx\Migration\AbstractMigration;

class InvoiceMigration extends AbstractMigration
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
    	
    	$this->vCreateInvoiceTable();
    	$this->vCreateInvoiceItemTable();
    	$this->vCreateInvoiceItemTaxTable();

    }
	
	protected function vCreateInvoiceTable(){
		
		$this->table('Invoice', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false  ] )
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => false  ] )
			->addColumn('iTypeId',                      'biginteger',   [ 'null'    => false  ] )
			->addColumn('sNumber',                      'string',       [ 'null'    => true,    'length' => 50  ] )
			->addColumn('iIssueDate',                   'biginteger',   [ 'null'    => false  ] )
			->addColumn('sName',                        'string',       [ 'null'    => true,    'length'    => 1073741823   ] )
			->addColumn('sDescription',                 'string',       [ 'null'    => true,    'length'    => 1073741823   ] )
			->addColumn('dTotalAmountTaxExcluded',      'decimal',      [ 'null'    => true,    'precision' => 20, 'scale' => 8 ] )
			->addColumn('dTotalTaxAmount',              'decimal',      [ 'null'    => true,    'precision' => 20, 'scale' => 8 ] )
			->addColumn('dTotalAmountTaxIncluded',      'decimal',      [ 'null'    => true,    'precision' => 20, 'scale' => 8 ] )
			->addColumn('sIdentificationNumber',        'string',       [ 'null'    => true,    'length'    => 1073741823   ] )
			->addColumn('sPaymentTerms',                'string',       [ 'null'    => true,    'length'    => 1073741823   ] )
			->addColumn('sComment',                     'string',       [ 'null'    => true,    'length'    => 1073741823   ] )
			->addColumn('sUserNote',                    'string',       [ 'null'    => true,    'length'    => 1073741823   ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'iIssueDate',                   [ 'name' => 'idx_issue_date' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			->addIndex(     'fkiUserId',                    [ 'name' => 'idx_user' ] )
			->addIndex(     ['fkiOrganisationId',
							 'sNumber'],                             [ 'name' => 'Invoice_uq_invoice_number' ] )
			
			->create();
	}
	
	protected function vCreateInvoiceItemTable(){
		
		$this->table('InvoiceItem', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiInvoiceId',                 'biginteger',   [ 'null'    => false  ] )
			->addColumn('sProductIdentifier',           'string',       [ 'null'    => true,    'length' => 100  ] )
			->addColumn('sNomination',                  'string',       [ 'null'    => false,   'length'    => 1073741823  ] )
			->addColumn('sDescription',                 'string',       [ 'null'    => false,   'length'    => 1073741823  ] )
			->addColumn('dQuantity',                    'decimal',      [ 'null'    => false,   'precision' => 20, 'scale' => 8 ] )
			->addColumn('dUnitPriceTaxExcluded',        'decimal',      [ 'null'    => false,   'precision' => 20, 'scale' => 8 ] )
			->addColumn('dUnitTaxAmount',               'decimal',      [ 'null'    => false,   'precision' => 20, 'scale' => 8 ] )
			->addColumn('dUnitPriceTaxIncluded',        'decimal',      [ 'null'    => false,   'precision' => 20, 'scale' => 8 ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiInvoiceId',                 [ 'name' => 'idx_invoice' ] )
			->addIndex(     'sProductIdentifier',           [ 'name' => 'idx_product_identifier' ] )
			
			->create();
	}
	
	protected function vCreateInvoiceItemTaxTable(){
		
		$this->table('InvoiceItemTax', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiInvoiceItemId',             'biginteger',   [ 'null'    => false  ] )
			->addColumn('sName',                        'string',       [ 'null'    => false,    'length'    => 1073741823  ] )
			->addColumn('dRate',                        'decimal',      [ 'null'    => false,    'precision' => 20, 'scale' => 8 ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiInvoiceItemId',             [ 'name' => 'idx_invoice_item' ] )
			
			->create();
	}
}
