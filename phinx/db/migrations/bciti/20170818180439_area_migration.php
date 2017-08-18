<?php

use Phinx\Migration\AbstractMigration;

class AreaMigration extends AbstractMigration
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
	
	    $this->table('Area', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
		    ->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
		
		    ->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false  ] )
		    ->addColumn('sName',                        'string',       [ 'null'    => false  ] )
		    ->addColumn('sDescription',                 'string',       [ 'null'    => false  ] )
		    ->addColumn('sGeoPointList',                'string',       [ 'null'    => false  ] )

		
		    ->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
		    ->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
		    ->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
		
		    ->addIndex(     'bDeleted',           [ 'name' => 'idx_deleted' ] )
		    ->addIndex(     'fkiOrganisationId',  [ 'name' => 'idx_organisation' ] )
		
		    ->create();
    }
}
