<?php

use Phinx\Migration\AbstractMigration;

class TaxMigration extends AbstractMigration
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
	
	    $this->table('Tax', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
		    ->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )
		
		    ->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false ] )
		    ->addColumn('sName',                        'string',       [ 'null'    => false,    'length'    => 1073741823 ] )
		    ->addColumn('dRate',                        'decimal',      [ 'null'    => false,    'precision' => 20, 'scale' => 8  ] )
		
		    ->addColumn('bDeleted',                     'integer',      [ 'null'    => false,    'default'   => 0  ] )
		    ->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
		    ->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
		
		    ->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
		    ->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
		
		    ->create();
    }
}
