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

	}

	protected function vCreatePermitApplicationTable(){
		
	}

	protected function vCreatePermitApplicationDocumentTable(){

	}

	protected function vCreatePermitApplicationInternalStateTable(){

	}

	protected function vCreatePermitApplicationRelatedObjectTable(){

	}

	protected function vCreatePermitApplicationStateTable(){

	}

	protected function vCreatePermitCategoryTable(){

	}

	protected function vCreatePermitPermissionTable(){

	}

	protected function vCreatePermitPermissionZoneTable(){

	}

	protected function vCreatePermitSubscriptionTable(){

	}

	protected function vCreatePermitSubscriptionInternalStateTable(){

	}

	protected function vCreatePermitSubscriptionRelatedObjectTable(){

	}

	protected function vCreatePermitSubscriptionStateTable(){

	}

	protected function vCreatePermitWaitingListConfigTable(){

	}
}