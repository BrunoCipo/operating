<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class NoticeMigration extends AbstractMigration{

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

		$this->vCreateAlerteTable();
		$this->vCreateAlerteCanauxTable();
		$this->vCreateAlerteCanauxFiltreTable();
		$this->vCreateAlerteClosedTable();
		$this->vCreateAlerteMqQueueTable();
		$this->vCreateNoticeCategoryTable();
		$this->vCreateNoticeReadTable();
		$this->vCreateNoticeSubCategoryTable();
	}

	protected function vCreateAlerteTable(){

	}

	/**
	 * @deprecated
	 */
	protected function vCreateAlerteCanauxTable(){

	}

	/**
	 * @deprecated
	 */
	protected function vCreateAlerteCanauxFiltreTable(){

	}

	/**
	 * @deprecated
	 */
	protected function vCreateAlerteClosedTable(){

	}

	/**
	 * @deprecated
	 */
	protected function vCreateAlerteMqQueueTable(){

	}

	protected function vCreateNoticeCategoryTable(){

	}

	protected function vCreateNoticeReadTable(){

	}

	protected function vCreateNoticeSubCategoryTable(){

	}
}