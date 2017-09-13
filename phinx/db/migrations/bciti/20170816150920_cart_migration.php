<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class CartMigration extends AbstractMigration
{

	public function change()
	{
		$this->CreateCartTables();
		$this->CreateCartItemTables();
	}

	protected function CreateCartTables(){

		$sEntityName = 'Cart';
		$oTableCart = $this->table($sEntityName, array('signed' => false));

		$oTableCart
			->addColumn('fkiUserId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false))
			->addColumn('fkiOrganisationId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false))
			->addColumn('iType', MysqlAdapter::PHINX_TYPE_INTEGER, array('signed' => false))
			->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN,array('signed' => false))
			->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addIndex('bDeleted', array('name' => 'idx_deleted'))
			->addIndex('fkiOrganisationId', array('name' => 'idx_organisation'))
			->addIndex('fkiUserId', array('name' => 'idx_user'))
			->create();
	}



	protected function CreateCartItemTables(){

		$sEntityName = 'CartItem';
		$oTableCartItem = $this->table($sEntityName, array('signed' => false));
		$oTableCartItem
			->addColumn('fkiCartId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false))
			->addColumn('iQuantity', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addColumn('sType', MysqlAdapter::PHINX_TYPE_STRING, array('length' => 30))
			->addColumn('iTypeInstanceId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false))
			->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN,array('signed' => false))
			->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addIndex('bDeleted', array('name' => 'idx_deleted'))
			->addIndex('fkiCartId', array('name' => 'idx_Cart'))
			->addIndex('iQuantity', array('name' => 'idx_quantity'))
			->addIndex('sType', array('name' => 'idx_type'))
			->create();
	}
}
