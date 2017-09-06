<?php

use Phinx\Migration\AbstractMigration;

class SondageMigration extends AbstractMigration
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

    	$this->vCreateSondageTable();
    	$this->vCreateSondageChoixReponseTable();
    	$this->vCreateSondageQuestionTable();
    	$this->vCreateSondageReponseTable();
    }
	
	private function vCreateSondageTable(){
		
		$this->table('Sondage', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('sSondageCibleType',            'string',       [ 'null'    => true,   'length' => 1073741823  ] )
			->addColumn('sNom',                         'string',       [ 'null'    => true,   'length' => 1073741823  ] )
			->addColumn('sDescription',                 'string',       [ 'null'    => true,   'length' => 1073741823  ] )
			->addColumn('iDateDebut',                   'biginteger',   [ 'null'    => true  ] )
			->addColumn('iDateFin',                     'biginteger',   [ 'null'    => true  ] )
			->addColumn('bActif',                       'integer',      [ 'null'    => true  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
    }
	
	private function vCreateSondageChoixReponseTable(){
		
		$this->table('SondageChoixReponse', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiSondageQuestionId',         'biginteger',   [ 'null'    => true  ] )
			->addColumn('sChoixReponse',                'string',       [ 'null'    => true,   'length' => 1073741823  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
	
	private function vCreateSondageQuestionTable(){
		
		$this->table('SondageQuestion', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiSondageId',                 'biginteger',   [ 'null'    => true  ] )
			->addColumn('sQuestion',                    'string',       [ 'null'    => true,   'length' => 1073741823  ] )
			->addColumn('iOrdre',                       'biginteger',   [ 'null'    => true  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
	
	private function vCreateSondageReponseTable(){
		
		$this->table('SondageReponse', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiSondageId',                 'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiSondageQuestionId',         'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiSondageChoixReponseId',     'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('sIdentifiantCookie',           'string',       [ 'null'    => true,   'length' => 1073741823  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
}
