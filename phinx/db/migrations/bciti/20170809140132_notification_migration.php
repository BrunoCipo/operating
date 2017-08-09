<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class NotificationMigration extends AbstractMigration{

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

		$this->vCreateNotificationTable();
		$this->vCreateNotificationCategoryTable();
		$this->vCreateNotificationChannelTable();
		$this->vCreateNotificationEventTable();
		$this->vCreateNotificationOrganisationPreferenceTable();
		$this->vCreateNotificationRecipientTable();
		$this->vCreateNotificationUserChannelPreferenceTable();
		$this->vCreateNotificationUserPreferenceTable();
	}

	protected function vCreateNotificationTable(){

	}

	protected function vCreateNotificationCategoryTable(){

	}

	protected function vCreateNotificationChannelTable(){

	}

	protected function vCreateNotificationEventTable(){

	}

	protected function vCreateNotificationOrganisationPreferenceTable(){

	}

	protected function vCreateNotificationRecipientTable(){

	}

	protected function vCreateNotificationUserChannelPreferenceTable(){

	}

	protected function vCreateNotificationUserPreferenceTable(){

	}
}