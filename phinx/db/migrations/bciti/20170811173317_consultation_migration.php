<?php

use Phinx\Migration\AbstractMigration;

class ConsultationMigration extends AbstractMigration{

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

		$this->vCreateConsultationAnswerTable();
		$this->vCreateConsultationProjectTable();
		$this->vCreateConsultationQuestionTable();
		$this->vCreateConsultationQuestionChoiceTable();
		$this->vCreateConsultationSurveyTable();
		$this->vCreateConsultationSurveyUserStatusTable();
	}

	protected function vCreateConsultationAnswerTable(){
		
		$this->table('ConsultationAnswer', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiConsultationProjectId',     'biginteger',   [ 'null'    => true ] )
			->addColumn('fkiConsultationSurveyId',      'biginteger',   [ 'null'    => true ] )
			->addColumn('fkiConsultationQuestionId',    'biginteger',   [ 'null'    => true ] )
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('jAnswer',                      'string',       [ 'null'    => true, 'length' => 1073741823  ] )
		 
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',           [ 'name' => 'idx_deleted'] )
			
			->create();
	}

	protected function vCreateConsultationProjectTable(){
		
		$this->table('ConsultationProject', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true ] )
			->addColumn('sTitle',                       'string',       [ 'null'    => true, 'length' => 1073741823  ] )
			->addColumn('sShortDescription',            'string',       [ 'null'    => true, 'length' => 1073741823  ] )
			->addColumn('sFichierIdShortDescription',   'string',       [ 'null'    => true, 'length' => 1073741823  ] )
			->addColumn('sRichText',                    'string',       [ 'null'    => true, 'length' => 1073741823  ] )
			->addColumn('iTimestampStart',              'biginteger',   [ 'null'    => true ] )
			->addColumn('iTimestampEnd',                'biginteger',   [ 'null'    => true ] )
			->addColumn('bArchived',                    'integer',      [ 'null'    => true ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',           [ 'name' => 'idx_deleted'] )
			
			->create();
	}

	protected function vCreateConsultationQuestionTable(){
		
		$this->table('ConsultationQuestion', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiConsultationSurveyId',      'biginteger',   [ 'null'    => true  ] )
			->addColumn('iConsultationQuestionType',    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iOrder',                       'biginteger',   [ 'null'    => true  ] )
			->addColumn('bShowResults',                 'integer',      [ 'null'    => false ] )
			->addColumn('bMandatory',                   'integer',      [ 'null'    => false ] )
			->addColumn('bStyleBold',                   'integer',      [ 'null'    => false ] )
			->addColumn('bStyleItalic',                 'integer',      [ 'null'    => false ] )
			->addColumn('jConfiguration',               'string',       [ 'null'    => false, 'length' => 1073741823  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',           [ 'name' => 'idx_deleted'] )
			
			->create();
	}

	protected function vCreateConsultationQuestionChoiceTable(){
		
		$this->table('ConsultationQuestionChoice', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiConsultationQuestionId',    'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiSkipToQuestionId',          'biginteger',   [ 'null'    => true  ] )
			->addColumn('iOrder',                       'biginteger',   [ 'null'    => true  ] )
			->addColumn('jConfiguration',               'string',       [ 'null'    => true, 'length' => 1073741823   ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',           [ 'name' => 'idx_deleted'] )
			
			->create();
	}

	protected function vCreateConsultationSurveyTable(){
		
		$this->table('ConsultationSurvey', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiConsultationProjectId',     'biginteger',   [ 'null'    => true  ] )
			->addColumn('sName',                        'string',       [ 'null'    => true, 'length' => 1073741823   ] )
			->addColumn('sDescription',                 'string',       [ 'null'    => true, 'length' => 1073741823   ] )
			->addColumn('iTimestampStart',              'biginteger',   [ 'null'    => true  ] )
			->addColumn('iTimestampEnd',                'biginteger',   [ 'null'    => true  ] )
			->addColumn('iTargetAgeMin',                'biginteger',   [ 'null'    => true  ] )
			->addColumn('iTargetAgeMax',                'biginteger',   [ 'null'    => true  ] )
			->addColumn('iTargetSex',                   'biginteger',   [ 'null'    => true  ] )
			->addColumn('iConsultationSurveyStatusType','biginteger',   [ 'null'    => true  ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',           [ 'name' => 'idx_deleted'] )
			
			->create();
	}

	protected function vCreateConsultationSurveyUserStatusTable(){
		
		$this->table('ConsultationSurveyUserStatus', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiConsultationProjectId',           'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiConsultationSurveyId',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiUserId',                          'biginteger',   [ 'null'    => true  ] )
			->addColumn('iConsultationSurveyUserStatusType',  'biginteger',   [ 'null'    => true  ] )
			
			->addColumn('bDeleted',                            'integer',         [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                           'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                       'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',           [ 'name' => 'idx_deleted'] )
			
			->create();
	}
}