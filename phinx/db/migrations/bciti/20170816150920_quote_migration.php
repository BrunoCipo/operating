<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class QuoteMigration extends AbstractMigration
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
	public function change()
	{
		$this->CreateQuoteTables();
		$this->CreateQuoteItemTables();
	}

	protected function CreateQuoteTables(){

		$sEntityName = 'Quote';
		$oTableQuote = $this->table($sEntityName, array('signed' => false));

		$oTableQuote
			->addColumn('fkiUserId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false))
			->addColumn('fkiOrganisationId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false))
			->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN,array('signed' => false))
			->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_STRING, array('signed' => false, 'null' => true))
			->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addIndex('bDeleted', array('name' => 'idx_deleted'))
			->addIndex('fkiOrganisationId', array('name' => 'idx_organisation'))
			->addIndex('fkiUserId', array('name' => 'idx_user'))
			->create();
	}

	protected function CreateQuoteItemTables(){

		$sEntityName = 'QuoteItem';
		$oTableQuoteItem = $this->table($sEntityName, array('signed' => false));
		$oTableQuoteItem
			->addColumn('fkiQuoteId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false))
			->addColumn('iQuantity', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addColumn('sType', MysqlAdapter::PHINX_TYPE_STRING, array('length' => 30))
			->addColumn('iTypeInstanceId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false))
			->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN,array('signed' => false))
			->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_STRING, array('signed' => false, 'null' => true))
			->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addIndex('bDeleted', array('name' => 'idx_deleted'))
			->addIndex('fkiQuoteId', array('name' => 'idx_quote'))
			->addIndex('iQuantity', array('name' => 'idx_quantity'))
			->addIndex('sType', array('name' => 'idx_type'))
			->create();
	}
}
