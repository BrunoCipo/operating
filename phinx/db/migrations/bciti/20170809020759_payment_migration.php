<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class PaymentMigration extends AbstractMigration{

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

		$this->vCreatePaymentTable();
		$this->vCreatePaymentCardTable();
		$this->vCreatePaymentMethodTable();
		$this->vCreatePaymentTermTable();
	}

	protected function vCreatePaymentTable(){

		$sEntityName = 'Payment';

		$oTable = $this->table($sEntityName, ['signed' => false]);
		$oTable->addColumn('fkiOrganisationId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('fkiInvoiceId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('fkiMakerUserId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('fkiOwnerUserId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('fkiPaymentMethodId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('fkiCurrencyId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('dAmount', MysqlAdapter::PHINX_TYPE_DECIMAL, ['signed' => false, 'precision' => 20, 'scale' => 2])
				->addColumn('sDescription', MysqlAdapter::PHINX_TYPE_TEXT)
				->addColumn('sPaymentToken', MysqlAdapter::PHINX_TYPE_STRING, ['length' => 150])
				->addColumn('sTransactionNumber', MysqlAdapter::PHINX_TYPE_STRING, ['length' => 150])
				->addColumn('sAuthorizationCode', MysqlAdapter::PHINX_TYPE_STRING, ['length' => 50])
				->addColumn('fkiPaymentCardId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('iStatusId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN, ['signed' => false])
				->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addIndex('fkiOrganisationId', ['name' => 'idx_organisation'])
				->addIndex('fkiInvoiceId', ['name' => 'idx_invoice'])
				->addIndex('fkiOwnerUserId', ['name' => 'idx_owner_user'])
				->addIndex('iStatusId', ['name' => 'idx_status'])
				->addIndex('bDeleted', ['name' => 'idx_deleted'])
				->addIndex(['fkiOwnerUserId', 'iStatusId', 'iCreation'], ['unique' => true, 'name' => 'uq_transaction_at_same_time'])
				->create();
	}

	protected function vCreatePaymentCardTable(){

		$sEntityName = 'PaymentCard';

		$oTable = $this->table($sEntityName, ['signed' => false]);
		$oTable->addColumn('fkiOrganisationId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('fkiUserId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('sPaymentToken', MysqlAdapter::PHINX_TYPE_STRING, ['length' => 150])
				->addColumn('sHolderFirstName', MysqlAdapter::PHINX_TYPE_STRING, ['length' => 100])
				->addColumn('sHolderLastName', MysqlAdapter::PHINX_TYPE_STRING, ['length' => 100])
				->addColumn('iBrandId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('sNumber', MysqlAdapter::PHINX_TYPE_STRING, ['length' => 30])
				->addColumn('sName', MysqlAdapter::PHINX_TYPE_STRING, ['length' => 150])
				->addColumn('sFirst6Digits', MysqlAdapter::PHINX_TYPE_STRING, ['length' => 6])
				->addColumn('sLast4Digits', MysqlAdapter::PHINX_TYPE_STRING, ['length' => 4])
				->addColumn('iExpirationMonth', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('iExpirationYear', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('bIsFavorite', MysqlAdapter::PHINX_TYPE_BOOLEAN, ['signed' => false])
				->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN, ['signed' => false])
				->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addIndex('fkiOrganisationId', ['name' => 'idx_organisation'])
				->addIndex('fkiUserId', ['name' => 'idx_user'])
				->addIndex('bDeleted', ['name' => 'idx_deleted'])
				->create();
	}

	protected function vCreatePaymentMethodTable(){

		$sEntityName = 'PaymentMethod';

		$oTable = $this->table($sEntityName, ['signed' => false]);
		$oTable->addColumn('fkiOrganisationId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('iTypeId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('sName', MysqlAdapter::PHINX_TYPE_TEXT)
				->addColumn('sDescription', MysqlAdapter::PHINX_TYPE_TEXT)
				->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN, ['signed' => false])
				->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addIndex('fkiOrganisationId', ['name' => 'idx_organisation'])
				->addIndex('bDeleted', ['name' => 'idx_deleted'])
				->create();
	}

	protected function vCreatePaymentTermTable(){

		$sEntityName = 'PaymentTerm';

		$oTable = $this->table($sEntityName, ['signed' => false]);
		$oTable->addColumn('fkiOrganisationId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('iTypeId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('sName', MysqlAdapter::PHINX_TYPE_TEXT)
				->addColumn('sDescription', MysqlAdapter::PHINX_TYPE_TEXT)
				->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN, ['signed' => false])
				->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addIndex('fkiOrganisationId', ['name' => 'idx_organisation'])
				->addIndex('bDeleted', ['name' => 'idx_deleted'])
				->create();
	}
}