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

		$sEntityName = 'Alerte';

		$oTable = $this->table($sEntityName, ['signed' => false]);
		$oTable->addColumn('fkiOrganisationId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('sExternalIdentifier', MysqlAdapter::PHINX_TYPE_STRING, ['length' => 150])
				->addColumn('fkiNoticeCategoryId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('fkiNoticeSubCategoryId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('sTitle', MysqlAdapter::PHINX_TYPE_TEXT)
				->addColumn('sResume', MysqlAdapter::PHINX_TYPE_TEXT)
				->addColumn('sTexte', MysqlAdapter::PHINX_TYPE_TEXT)
				->addColumn('iAlertePrioriteType', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('bActif', MysqlAdapter::PHINX_TYPE_BOOLEAN, ['signed' => false])
				->addColumn('iDateDebut', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('iDateFin', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('sMetaData', MysqlAdapter::PHINX_TYPE_TEXT)
				->addColumn('fkiFichierId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('sNotificationList', MysqlAdapter::PHINX_TYPE_TEXT)
				->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN, ['signed' => false])
				->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addIndex('fkiOrganisationId', ['name' => 'idx_organisation'])
				->addIndex('sExternalIdentifier', ['name' => 'idx_external_identifier'])
				->addIndex('bDeleted', ['name' => 'idx_deleted'])
				->create();
	}

	/**
	 * @deprecated
	 */
	protected function vCreateAlerteCanauxTable(){

		$sEntityName = 'AlerteCanaux';

		$oTable = $this->table($sEntityName, ['signed' => false]);
		$oTable->addColumn('fkiAlerteId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('iAlerteCanauxType', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN, ['signed' => false])
				->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addIndex('fkiAlerteId', ['name' => 'idx_alerte'])
				->addIndex('bDeleted', ['name' => 'idx_deleted'])
				->create();
	}

	/**
	 * @deprecated
	 */
	protected function vCreateAlerteCanauxFiltreTable(){

		$sEntityName = 'AlerteCanauxFiltre';

		$oTable = $this->table($sEntityName, ['signed' => false]);
		$oTable->addColumn('fkiUserId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('iAlerteCanauxType', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN, ['signed' => false])
				->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addIndex('fkiUserId', ['name' => 'idx_user'])
				->addIndex('bDeleted', ['name' => 'idx_deleted'])
				->create();
	}

	/**
	 * @deprecated
	 */
	protected function vCreateAlerteClosedTable(){

		$sEntityName = 'AlerteClosed';

		$oTable = $this->table($sEntityName, ['signed' => false]);
		$oTable->addColumn('fkiUserId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('fkiAlerteId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN, ['signed' => false])
				->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addIndex('fkiUserId', ['name' => 'idx_user'])
				->addIndex('fkiAlerteId', ['name' => 'idx_alerte'])
				->addIndex('bDeleted', ['name' => 'idx_deleted'])
				->create();
	}

	/**
	 * @deprecated
	 */
	protected function vCreateAlerteMqQueueTable(){

		$sEntityName = 'AlerteMqQueue';

		$oTable = $this->table($sEntityName, ['signed' => false]);
		$oTable->addColumn('fkiUserId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('fkiAlerteId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('bEnvoye', MysqlAdapter::PHINX_TYPE_BOOLEAN, ['signed' => false])
				->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN, ['signed' => false])
				->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addIndex('fkiUserId', ['name' => 'idx_user'])
				->addIndex('fkiAlerteId', ['name' => 'idx_alerte'])
				->addIndex('bDeleted', ['name' => 'idx_deleted'])
				->create();
	}

	protected function vCreateNoticeCategoryTable(){

		$sEntityName = 'NoticeCategory';

		$oTable = $this->table($sEntityName, ['signed' => false]);
		$oTable->addColumn('fkiOrganisationId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('sExternalIdentifier', MysqlAdapter::PHINX_TYPE_STRING, ['length' => 150])
				->addColumn('iPriorityId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('sName', MysqlAdapter::PHINX_TYPE_TEXT)
				->addColumn('sDescription', MysqlAdapter::PHINX_TYPE_TEXT)
				->addColumn('sMetaData', MysqlAdapter::PHINX_TYPE_TEXT)
				->addColumn('fkiFichierId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN, ['signed' => false])
				->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addIndex('fkiOrganisationId', ['name' => 'idx_organisation'])
				->addIndex('sExternalIdentifier', ['name' => 'idx_external_identifier'])
				->addIndex('bDeleted', ['name' => 'idx_deleted'])
				->create();
	}

	protected function vCreateNoticeReadTable(){

		$sEntityName = 'NoticeRead';

		$oTable = $this->table($sEntityName, ['signed' => false]);
		$oTable->addColumn('fkiOrganisationId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('fkiUserId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('fkiNoticeId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('iChannelId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN, ['signed' => false])
				->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addIndex('fkiOrganisationId', ['name' => 'idx_organisation'])
				->addIndex('fkiUserId', ['name' => 'idx_user'])
				->addIndex('fkiNoticeId', ['name' => 'idx_notice'])
				->addIndex('iChannelId', ['name' => 'idx_channel'])
				->addIndex('bDeleted', ['name' => 'idx_deleted'])
				->create();
	}

	protected function vCreateNoticeSubCategoryTable(){

		$sEntityName = 'NoticeSubCategory';

		$oTable = $this->table($sEntityName, ['signed' => false]);
		$oTable->addColumn('fkiOrganisationId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('fkiNoticeCategoryId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false])
				->addColumn('sExternalIdentifier', MysqlAdapter::PHINX_TYPE_STRING, ['length' => 150])
				->addColumn('sName', MysqlAdapter::PHINX_TYPE_TEXT)
				->addColumn('sDescription', MysqlAdapter::PHINX_TYPE_TEXT)
				->addColumn('sMetaData', MysqlAdapter::PHINX_TYPE_TEXT)
				->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN, ['signed' => false])
				->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, ['signed' => false, 'null' => true])
				->addIndex('fkiOrganisationId', ['name' => 'idx_organisation'])
				->addIndex('fkiNoticeCategoryId', ['name' => 'idx_sub_category'])
				->addIndex('sExternalIdentifier', ['name' => 'idx_external_identifier'])
				->addIndex('bDeleted', ['name' => 'idx_deleted'])
				->create();
	}
}