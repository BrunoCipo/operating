<?php

use Phinx\Migration\AbstractMigration;

class MessageMigration extends AbstractMigration
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

    	$this->vCreateMessageTable();
    	$this->vCreateMessageCommentTable();
    	$this->vCreateMessageFichierJointTable();
    	$this->vCreateMessageFollowedTable();
    	$this->vCreateMessageFormFieldTable();
    	$this->vCreateMessageStateTable();
    	$this->vCreateMessageSubjectTable();
    	$this->vCreateMessageSubjectCategoryTable();
    }
	
	private function vCreateMessageTable(){
		
		$this->table('Message', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true   ] )
			->addColumn('sExternalIdentifier',          'string',       [ 'null'    => true,    'length' => 150 ] )
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => true   ] )
			->addColumn('fkiReopenedMessageId',         'biginteger',   [ 'null'    => true   ] )
			->addColumn('sUserLang',                    'string',       [ 'null'    => false,   'length' => 3, 'default' => '' ] )
			->addColumn('fkiMessageSubjectCategoryId',  'biginteger',   [ 'null'    => true   ] )
			->addColumn('iDateEnvoi',                   'biginteger',   [ 'null'    => true   ] )
			->addColumn('iSujet',                       'biginteger',   [ 'null'    => true   ] )
			->addColumn('iSujetBeta',                   'biginteger',   [ 'null'    => true   ] )
			->addColumn('sContenu',                     'string',       [ 'null'    => true,    'length'    => 1073741823, ] )  //todo bc 'default' = ''
			->addColumn('fkiGeoPointId',                'biginteger',   [ 'null'    => true   ] )
			->addColumn('iVisibilityId',                'biginteger',   [ 'null'    => false,    'default' => 1  ] )
			->addColumn('sMetaData',                    'string',       [ 'null'    => true,    'length'    => 1073741823  ] )
			->addColumn('iLookup',                      'biginteger',   [ 'null'    => true   ] )
			->addColumn('bClosed',                      'biginteger',   [ 'null'    => false,    'default' => 0   ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'bClosed',                      [ 'name' => 'idx_closed' ] )
			->addIndex(     'iLookup',                      [ 'name' => 'idx_lookup' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			->addIndex(     'iSujet',                       [ 'name' => 'idx_subject' ] )
			->addIndex(     'fkiUserId',                    [ 'name' => 'idx_user' ] )
			->addIndex(     'iVisibilityId',                [ 'name' => 'idx_visibility' ] )
			
			->create();
	}
	
	private function vCreateMessageCommentTable(){
		
		$this->table('MessageComment', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false   ] )
			->addColumn('fkiMessageId',                 'biginteger',   [ 'null'    => false   ] )
			->addColumn('sComment',                     'string',       [ 'null'    => true,    'length'    => 1073741823 ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
	
	private function vCreateMessageFichierJointTable(){
		
		$this->table('MessageFichierJoint', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiMessageId',                 'biginteger',   [ 'null'    => true ] )
			->addColumn('fkiFichierId',                 'biginteger',   [ 'null'    => true ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiMessageId',                 [ 'name' => 'idx_message' ] )
			
			->create();
	}
	
	private function vCreateMessageFollowedTable(){
		
		$this->table('MessageFollowed', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false ] )
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => false ] )
			->addColumn('fkiMessageId',                 'biginteger',   [ 'null'    => false ] )
			->addColumn('sComment',                     'string',       [ 'null'    => true,    'length' => 1073741823  ] )
			->addColumn('sAttachmentList',              'string',       [ 'null'    => true,    'length' => 255 ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			->addIndex(     'fkiUserId',                    [ 'name' => 'idx_user' ] )
			
			->create();
	}
	
	private function vCreateMessageFormFieldTable(){
		
		$this->table('MessageFormField', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false ] )
			->addColumn('fkiMessageSubjectCategoryId',  'biginteger',   [ 'null'    => true  ] )
			->addColumn('iTypeId',                      'biginteger',   [ 'null'    => false ] )
			->addColumn('sTitle',                       'string',       [ 'null'    => false,    'length'    => 1073741823 ] )
			->addColumn('sName',                        'string',       [ 'null'    => false,    'length'    => 150 ] )
			->addColumn('sDefaultValue',                'string',       [ 'null'    => false,    'length'    => 1073741823 ] )
			->addColumn('sAttribute',                   'string',       [ 'null'    => false,    'length'    => 1073741823 ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiMessageSubjectCategoryId',  [ 'name' => 'idx_message_subject_category' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			
			->create();
	}
	
	private function vCreateMessageStateTable(){
		
		$this->table('MessageState', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false ] )
			->addColumn('fkiMessageId',                 'biginteger',   [ 'null'    => false ] )
			->addColumn('iStatusId',                    'biginteger',   [ 'null'    => false ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiMessageId',                 [ 'name' => 'idx_message' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			
			->create();
	}
	
	private function vCreateMessageSubjectTable(){
		
		$this->table('MessageSubject', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false ] )
			->addColumn('fkiMessageSubjectCategoryId',  'biginteger',   [ 'null'    => true  ] )
			->addColumn('sExternalIdentifier',          'string',       [ 'null'    => true,     'length' => 100, 'default' => ''  ] )
			->addColumn('sName',                        'string',       [ 'null'    => false,    'length' => 1073741823 ] )
			->addColumn('sDescription',                 'string',       [ 'null'    => false,    'length' => 1073741823 ] )
			->addColumn('sMetaData',                    'string',       [ 'null'    => false,    'length' => 1073741823 ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'fkiMessageSubjectCategoryId',  [ 'name' => 'idx_category' ] )
			->addIndex(     'sExternalIdentifier',          [ 'name' => 'idx_external_identifier' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			
			->create();
	}
	
	private function vCreateMessageSubjectCategoryTable(){
		
		$this->table('MessageSubjectCategory', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => false ] )
			->addColumn('sExternalIdentifier',          'string',       [ 'null'    => true,     'length'  => 100, 'default' => '' ] )
			->addColumn('sName',                        'string',       [ 'null'    => false,    'length' => 1073741823 ] )
			->addColumn('sDescription',                 'string',       [ 'null'    => false,    'length' => 1073741823 ] )
			->addColumn('sMetaData',                    'string',       [ 'null'    => false,    'length' => 1073741823 ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0   ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     'sExternalIdentifier',          [ 'name' => 'idx_external_identifier' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			
			->create();
	}
	
	
}
