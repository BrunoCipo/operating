<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class ParkingMigration extends AbstractMigration{

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

		$this->vCreateParkingAreaTable();
		$this->vCreateParkingAreaPeriodTable();
		$this->vCreateParkingAreaRateTable();
		$this->vCreateParkingAreaZoneTable();
		$this->vCreateParkingBankPlanTable();
		$this->vCreateParkingBankTransactionTable();
		$this->vCreateParkingReservationTable();
	}

	protected function vCreateParkingAreaTable(){

	}

	protected function vCreateParkingAreaPeriodTable(){

	}

	protected function vCreateParkingAreaRateTable(){

	}

	protected function vCreateParkingAreaZoneTable(){

	}

	protected function vCreateParkingBankPlanTable(){

	}

	protected function vCreateParkingBankTransactionTable(){

	}

	protected function vCreateParkingReservationTable(){

	}
}