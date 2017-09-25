<?php

use Phinx\Migration\AbstractMigration;

class PeriodMigration extends AbstractMigration
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
    	
    	$this->vCreatePeriodTable();
    	$this->vCreatePeriodTimeSlotTable();
    	$this->vCreatePeriodWeekTable();

    }
	
	private function vCreatePeriodTable(){

		$this->table('Period', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false ] )
			->addColumn('iStartYear',                   'biginteger',   [ 'null'    => true  ] )
			->addColumn('iEndYear',                     'biginteger',   [ 'null'    => true  ] )
			->addColumn('iStartMonthId',                'biginteger',   [ 'null'    => false ] )
			->addColumn('iEndMonthId',                  'biginteger',   [ 'null'    => false ] )
			->addColumn('iStartDay',                    'biginteger',   [ 'null'    => false ] )
			->addColumn('iEndDay',                      'biginteger',   [ 'null'    => false ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			
			->create();
	}
	
	private function vCreatePeriodTimeSlotTable(){
		
		$this->table('PeriodTimeSlot', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiPeriodWeekId',              'biginteger',   [ 'null'    => false ] )
			->addColumn('sStartTime',                   'string',       [ 'null'    => false,   'length' => 8 ] )
			->addColumn('sEndTime',                     'string',       [ 'null'    => false,   'length' => 8 ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiPeriodWeekId',              [ 'name' => 'idx_week' ] )
			
			->create();
	}
	
	private function vCreatePeriodWeekTable(){
		
		$this->table('PeriodWeek', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiPeriodId',                  'biginteger',   [ 'null'    => false ] )
			->addColumn('sWeekdayList',                 'string',       [ 'null'    => false,   'length' => 1073741823  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiPeriodId',                  [ 'name' => 'idx_period' ] )
			
			->create();
	}
}
