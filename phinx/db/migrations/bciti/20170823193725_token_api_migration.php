<?php

use Phinx\Migration\AbstractMigration;

class TokenApiMigration extends AbstractMigration
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
	
	    $this->table('TokenApi', [ 'id'=> false ] )
		
		    ->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => true  ] )
		    ->addColumn('sToken',                       'string',       [ 'null'    => false,   'length' => 1073741823  ] ) //todo bc , 'default' => ''
		    ->addColumn('iExpiration',                  'biginteger',   [ 'null'    => true  ] )
		
		    ->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
		    ->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
		
		    ->addIndex(     'fkiUserId',                     [ 'name' => 'fkiUserId' ] )
		
		    ->create();
    }
}
