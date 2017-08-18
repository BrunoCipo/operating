<?php

use Phinx\Migration\AbstractMigration;

class CommentMigration extends AbstractMigration
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
	
	    $this->vCreateCommentTable();
	    $this->vCreateCommentAssociationTable();
	
    }
	
	protected function vCreateCommentTable(){
		
		$this->table('Comment', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false ] )
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => false ] )
			->addColumn('sText',                        'biginteger',   [ 'null'    => false ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',           [ 'name' => 'idx_deleted'] )
			->addIndex(     'fkiOrganisationId',  [ 'name' => 'idx_organisation'] )
			
			->create();
	}

	protected function vCreateCommentAssociationTable(){
		
		$this->table('CommentAssociation', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiCommentId',                 'biginteger',   [ 'null'    => false  ] )
			->addColumn('sEntityName',                  'biginteger',   [ 'null'    => false,    'length'    => 100 ] )
			->addColumn('fkiEntityId',                  'biginteger',   [ 'null'    => false ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',           [ 'name' => 'idx_deleted'] )
			->addIndex(     'fkiCommentId',       [ 'name' => 'idx_comment'] )
			->addIndex(     [ 'sEntityName',
							 'fkiEntityId' ],              [ 'name' => 'idx_entity'] )
			
			->create();
	}
}
