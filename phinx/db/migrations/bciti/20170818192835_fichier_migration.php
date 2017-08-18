<?php

use Phinx\Migration\AbstractMigration;

class FichierMigration extends AbstractMigration
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
		
		$this->table('Fichier', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('sNomOriginal',                 'string',       [ 'null'    => true,     'length' => 1000 ] )
			->addColumn('sSHA1',                        'string',       [ 'null'    => true,     'length' => 40   ] )
			->addColumn('sRepertoire',                  'string',       [ 'null'    => true,     'length' => 3    ] )
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('sDroits',                      'string',       [ 'null'    => true,     'length' => 4    ] )
			->addColumn('sModele',                      'string',       [ 'null'    => true,     'length' => 100  ] )
			
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			->addIndex(     'fkiUserId',                    [ 'name' => 'fkiUserId' ] )
			
			->create();
	}
}
