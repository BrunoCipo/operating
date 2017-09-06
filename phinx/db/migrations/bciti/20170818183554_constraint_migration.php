<?php

use Phinx\Migration\AbstractMigration;

class ConstraintMigration extends AbstractMigration
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

    	$this->vCreateConstraintTable();
    	$this->vCreateConstraintCategoryTable();
    	$this->vCreateConstraintDefinitionTable();
    	$this->vCreateConstraintPropositionTable();
    }
	
	protected function vCreateConstraintTable(){
		
		$this->table('Constraint', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false ] )
			->addColumn('fkiConstraintPropositionId',   'biginteger',   [ 'null'    => false ] )
			->addColumn('fkiConstraintDefinitionId',    'biginteger',   [ 'null'    => false ] )
			->addColumn('sOperator',                    'string',       [ 'null'    => false,   'length'    => 30,  'default' => '' ] )
			->addColumn('xValue',                       'string',       [ 'null'    => false,   'length'    => 30,  'default' => '' ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted'] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation'] )
			->addIndex(     'fkiConstraintPropositionId',   [ 'name' => 'idx_proposition'] )
			
			->create();
	}
	
	private function vCreateConstraintCategoryTable(){

		$this->table('ConstraintCategory', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',    'biginteger',   [ 'null'    => true  ] )
			->addColumn('sName',                'string',       [ 'null'    => false, 'length' => 1073741823  ] )
			->addColumn('sDescription',         'string',       [ 'null'    => false, 'length' => 1073741823  ] )
			
			->addColumn('bDeleted',             'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',            'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',        'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted'] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation'] )
			
			->create();
	}
	
	protected function vCreateConstraintDefinitionTable(){
		
		$this->table('ConstraintDefinition', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',        'biginteger',   [ 'null'    => true  ] )
			->addColumn('iCodeId',                  'biginteger',   [ 'null'    => false ] )
			->addColumn('fkiConstraintCategoryId',  'biginteger',   [ 'null'    => false ] )
			->addColumn('sName',                    'string',       [ 'null'    => false, 'length' => 1073741823  ] )
			->addColumn('sDescription',             'string',       [ 'null'    => false, 'length' => 1073741823  ] )
			->addColumn('sCondition',               'string',       [ 'null'    => false, 'length' => 1073741823  ] )
			->addColumn('sAvailableOperatorList',   'string',       [ 'null'    => false, 'length' => 1073741823  ] )
			->addColumn('bIsBlocking',              'integer',      [ 'null'    => false ,   'default' => 0 ] )
			
			->addColumn('bDeleted',                 'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',            'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted'] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation'] )
			->addIndex(     'fkiConstraintCategoryId',      [ 'name' => 'idx_constraint_category'] )
			
			->create();
	}
	
	protected function vCreateConstraintPropositionTable(){

		$this->table('ConstraintProposition', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',        'biginteger',   [ 'null'    => false ] )
			->addColumn('fkiSubscriptionPlanId',    'biginteger',   [ 'null'    => false ] )
			
			->addColumn('bDeleted',                 'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',            'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted'] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation'] )
			->addIndex(     'fkiSubscriptionPlanId',        [ 'name' => 'idx_subscription_plan'] )
			
			->create();
	}
	
}
