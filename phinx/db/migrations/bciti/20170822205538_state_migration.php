<?php

use Phinx\Migration\AbstractMigration;

class StateMigration extends AbstractMigration
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
	
	    $this->table('State', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
		    ->addColumn('id',                           'biginteger',   [ 'identity'  => true ] )
		
		    ->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false ] )
		    ->addColumn('iType',                        'biginteger',   [ 'null'    => false ] )
		    ->addColumn('sName',                        'string',       [ 'null'    => false,   'length' => 100 ] )
		
		    ->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
		    ->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
		    ->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
		
		    ->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
		    ->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
		    ->addIndex(     'iType',                        [ 'name' => 'idx_type' ] )
		
		    ->create();
    }
}
