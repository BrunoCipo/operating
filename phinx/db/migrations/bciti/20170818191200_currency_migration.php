<?php

use Phinx\Migration\AbstractMigration;

class CurrencyMigration extends AbstractMigration
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
	
	    $this->table('Currency', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
		    ->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
		
		    ->addColumn('sName',                        'string',       [ 'null'    => false ] )
		    ->addColumn('sIsoCode',                     'string',       [ 'null'    => false,   'length'    => 3  ] )
		    ->addColumn('sSymbol',                      'string',       [ 'null'    => false,   'length'    => 10 ] )
		
		    ->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false ] )

		    ->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
		    ->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
		    ->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
		
		    ->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted'] )
		
		    ->create();
    }
}
