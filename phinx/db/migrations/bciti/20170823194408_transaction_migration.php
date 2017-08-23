<?php

use Phinx\Migration\AbstractMigration;

class TransactionMigration extends AbstractMigration
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

    	$this->vCreateTransaction();
    	$this->vCreateTransactionItem();
    	$this->vCreateTransactionPanier();
    	$this->vCreateTransactionProfil();
    }
	
	private function vCreateTransaction(){
		
		$this->table('Transaction', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiSystExtId',                 'biginteger',   [ 'null'    => true  ] )
			->addColumn('sFournisseur',                 'string',       [ 'null'    => true,    'length' => 100  ] )
			->addColumn('iTransactionType',             'biginteger',   [ 'null'    => true  ] )
			->addColumn('iTransactionStatutType',       'biginteger',   [ 'null'    => true  ] )
			->addColumn('iTime',                        'biginteger',   [ 'null'    => true  ] )
			->addColumn('sNumTransaction',              'string',       [ 'null'    => true,    'length' => 100  ] )
			->addColumn('sNumConfirmation',             'string',       [ 'null'    => true,    'length' => 100  ] )
			->addColumn('sNomPorteurCarte',             'string',       [ 'null'    => true,    'length' => 100  ] )
			->addColumn('sNumCarte',                    'string',       [ 'null'    => true,    'length' => 20   ] )
			->addColumn('iCarteType',                   'biginteger',   [ 'null'    => true  ] )
			->addColumn('iExpMois',                     'biginteger',   [ 'null'    => true  ] )
			->addColumn('iExpAnnee',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('sCodeReponse',                 'string',       [ 'null'    => true,    'length' => 10   ] )
			->addColumn('sAvsReponse',                  'string',       [ 'null'    => true,    'length' => 10   ] )
			->addColumn('sCvdReponse',                  'string',       [ 'null'    => true,    'length' => 10   ] )
			->addColumn('iDeviseType',                  'biginteger',   [ 'null'    => true  ] )
			->addColumn('sRembTxnGUID',                 'string',       [ 'null'    => true,    'length' => 100  ] )
			->addColumn('sRembCode',                    'string',       [ 'null'    => true,    'length' => 100  ] )
			->addColumn('sRembMessage',                 'string',       [ 'null'    => true,    'length' => 100  ] )
			->addColumn('sRembMId',                     'string',       [ 'null'    => true,    'length' => 100  ] )
			->addColumn('sRembAmount',                  'string',       [ 'null'    => true,    'length' => 100  ] )
			->addColumn('sRembTicketNumber',            'string',       [ 'null'    => true,    'length' => 100  ] )
			->addColumn('sRembEntryMode',               'string',       [ 'null'    => true,    'length' => 100  ] )
			->addColumn('sRembError',                   'string',       [ 'null'    => true,    'length' => 100  ] )
			->addColumn('iSousTotal',                   'biginteger',   [ 'null'    => true  ] )
			->addColumn('iTPS',                         'biginteger',   [ 'null'    => true  ] )
			->addColumn('iTVQ',                         'biginteger',   [ 'null'    => true  ] )
			->addColumn('iTViTotalQ',                   'biginteger',   [ 'null'    => true  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			->addIndex(     'fkiUserId',                    [ 'name' => 'idx_user' ] )
			
			->create();
	}
	
	private function vCreateTransactionItem(){
		
		$this->table('TransactionItem', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('sNom',                         'string',       [ 'null'    => true  ] )
			->addColumn('sDescription',                 'string',       [ 'null'    => true  ] )
			->addColumn('iSousTotal',                   'biginteger',   [ 'null'    => true  ] )
			->addColumn('iTPS',                         'biginteger',   [ 'null'    => true  ] )
			->addColumn('iTVQ',                         'biginteger',   [ 'null'    => true  ] )
			->addColumn('iTViTotalQ',                   'biginteger',   [ 'null'    => true  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			
			->create();
	}
	
	private function vCreateTransactionPanier(){
		
		$this->table('TransactionPanier', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiTransactionId',             'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiTransactionItemId',         'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iQuantite',                    'biginteger',   [ 'null'    => true  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiTransactionId',             [ 'name' => 'idx_transaction' ] )
			->addIndex(     'fkiTransactionItemId',         [ 'name' => 'idx_transaction_item' ] )
			
			->create();
	}
	
	private function vCreateTransactionProfil(){
		
		$this->table('TransactionProfil', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiUserId',                        'biginteger',   [ 'null'    => true  ] )
			->addColumn('iTransactionProfilCarteCreditType','biginteger',   [ 'null'    => true  ] )
			->addColumn('sCarteQuatreDigits',               'string',       [ 'null'    => true,    'length' => 4    ] )
			->addColumn('sCarteExpirationAnnee',            'string',       [ 'null'    => true,    'length' => 4    ] )
			->addColumn('sCarteExpirationMois',             'string',       [ 'null'    => true,    'length' => 2    ] )
			->addColumn('sCarteToken',                      'string',       [ 'null'    => true,    'length' => 255  ] )
			->addColumn('sCarteNomPersonne',                'string',       [ 'null'    => true,    'length' => 255  ] )
			->addColumn('sCarteAdresse',                    'string',       [ 'null'    => true,    'length' => 255  ] )
			->addColumn('sCarteProvince',                   'string',       [ 'null'    => true,    'length' => 2    ] )
			->addColumn('sCartePays',                       'string',       [ 'null'    => true,    'length' => 2    ] )
			->addColumn('sCarteCodePostal',                 'string',       [ 'null'    => true,    'length' => 6    ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                      [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiUserId',                     [ 'name' => 'idx_user' ] )
			
			->create();
	}
}
