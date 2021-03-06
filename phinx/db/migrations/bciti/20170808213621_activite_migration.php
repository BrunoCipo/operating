<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class ActiviteMigration extends AbstractMigration{

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

		$this->vCreateActiviteTable();
		$this->vCreateActiviteLieuTable();
		$this->vCreateActivitePlageTable();
		$this->vCreateActiviteReservationTable();
	}

	/**
	 * @return void
	 */
	protected function vCreateActiviteTable(){

		$sEntityName = 'Activite';

		$oTable = $this->table($sEntityName, array('signed' => false));
		$oTable->addColumn('fkiOrganisationId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
				->addColumn('sNom', MysqlAdapter::PHINX_TYPE_TEXT, ['null' => true])
				->addColumn('sDescription', MysqlAdapter::PHINX_TYPE_TEXT, ['null' => true])
				->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN, array('signed' => false, 'null' => true))
				->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
				->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
				->addIndex('bDeleted', array('name' => 'idx_deleted'))
				->addIndex('fkiOrganisationId', array('name' => 'idx_organisation'))
				->create();
	}

	/**
	 * @return void
	 */
	protected function vCreateActiviteLieuTable(){

		$sEntityName = 'ActiviteLieu';

		$oTable = $this->table($sEntityName, array('signed' => false));
		$oTable->addColumn('fkiActiviteId',             MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
				->addColumn('sAdresseDescription',      MysqlAdapter::PHINX_TYPE_TEXT, ['null' => true])
				->addColumn('sAdresseNumeroCivique',    MysqlAdapter::PHINX_TYPE_STRING, array('length' => 15,  'null' => true))
				->addColumn('sAdressePorte',            MysqlAdapter::PHINX_TYPE_STRING, array('length' => 10,  'null' => true))
				->addColumn('sAdresseRue',              MysqlAdapter::PHINX_TYPE_STRING, array('length' => 100, 'null' => true))
				->addColumn('sAdresseVille',            MysqlAdapter::PHINX_TYPE_STRING, array('length' => 100, 'null' => true))
				->addColumn('sAdresseProvince',         MysqlAdapter::PHINX_TYPE_STRING, array('length' => 2,   'null' => true))
				->addColumn('sAdressePays',             MysqlAdapter::PHINX_TYPE_STRING, array('length' => 3,   'null' => true))
				->addColumn('sAdresseCodePostal',       MysqlAdapter::PHINX_TYPE_STRING, array('length' => 6,   'null' => true))
				->addColumn('bDeleted',                 MysqlAdapter::PHINX_TYPE_BOOLEAN, array('signed' => false, 'null' => true))
				->addColumn('iCreation',                MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
				->addColumn('iModification',            MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			
				->addIndex('bDeleted', array('name' => 'idx_deleted'))
				->addIndex('fkiActiviteId', array('name' => 'idx_activite'))
				->create();
	}

	/**
	 * @return void
	 */
	protected function vCreateActivitePlageTable(){

		$sEntityName = 'ActivitePlage';

		$oTable = $this->table($sEntityName, array('signed' => false));
		$oTable->addColumn('fkiActiviteLieuId',         MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
				->addColumn('iDateDebut',               MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
				->addColumn('iDateFin',                 MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
				->addColumn('iNombrePlace',             MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
				->addColumn('iActiviteRecurrenceType',  MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
				->addColumn('bDeleted',                 MysqlAdapter::PHINX_TYPE_BOOLEAN,     array('signed' => false, 'null' => true))
				->addColumn('iCreation',                MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
				->addColumn('iModification',            MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			
				->addIndex('bDeleted', array('name' => 'idx_deleted'))
				->addIndex('fkiActiviteLieuId', array('name' => 'idx_activite_lieu'))
				->create();
	}

	/**
	 * @return void
	 */
	protected function vCreateActiviteReservationTable(){

		$sEntityName = 'ActiviteReservation';

		$oTable = $this->table($sEntityName, array('signed' => false));
		$oTable->addColumn('fkiOrganisationId',                 MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
				->addColumn('fkiActivitePlageId',               MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
				->addColumn('fkiUserId',                        MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
				->addColumn('iActiviteReservationStatutType',   MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
				->addColumn('bDeleted',                         MysqlAdapter::PHINX_TYPE_BOOLEAN, array('signed' => false,     'null' => true))
				->addColumn('iCreation',                        MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
				->addColumn('iModification',                    MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			
				->addIndex('bDeleted', array('name' => 'idx_deleted'))
				->addIndex('fkiOrganisationId', array('name' => 'idx_organisation'))
				->addIndex('fkiActivitePlageId', array('name' => 'idx_activite_plage'))
				->addIndex('fkiUserId', array('name' => 'idx_user'))
				->create();
	}
}