<?php

use Phinx\Migration\AbstractMigration;

class KbMigration extends AbstractMigration
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
    	
    	$this->vCreateKBFileTable();
    	$this->vCreateKBFileArborescenceTable();
    	$this->vCreateKBFileCommentTable();
    	$this->vCreateKBFileDocumentTable();
    	$this->vCreateKBFileEvaluationTable();
    	$this->vCreateKBFileJournalisationTable();
    	$this->vCreateKBFileRecuperateurAssociationTable();
    	$this->vCreateKBFileWebsiteAssociationTable();
    	$this->vCreateKBObjectCategoryTable();
    	$this->vCreateKBObjectCategoryAssociationTable();
    	$this->vCreateKBObjectRecuperationTable();
    	$this->vCreateKBOntologyTable();
    	$this->vCreateKBRecuperateurTable();
    	$this->vCreateKBRecuperateurNomTable();
    	$this->vCreateKBRecuperateurObjectAssociationTable();
    	$this->vCreateKBRecuperateurTelephoneAssociationTable();
    	$this->vCreateKBRecuperateurWebsiteAssociationTable();
    	$this->vCreateKBResponsableTable();
    	$this->vCreateKBSignalementTable();
    	$this->vCreateKBTreeClassTable();
    	$this->vCreateKBTreeClassStructureTable();

    }
	
	protected function vCreateKBFileTable(){
		
		$this->table('KBFile', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true   ] )
			->addColumn('fkiTreeClassId',               'biginteger',   [ 'null'    => true   ] )
			->addColumn('sTitle',                       'string',       [ 'null'    => true   ] )
			->addColumn('sBody',                        'string',       [ 'null'    => true   ] )
			->addColumn('sTitleEn',                     'string',       [ 'null'    => true   ] )
			->addColumn('sBodyEn',                      'string',       [ 'null'    => true   ] )
			->addColumn('iStatut',                      'biginteger',   [ 'null'    => true   ] )
			->addColumn('bSuggere',                     'integer',      [ 'null'    => true   ] )
			->addColumn('iPublication',                 'biginteger',   [ 'null'    => true   ] )
			->addColumn('iDeprecated',                  'biginteger',   [ 'null'    => true   ] )
			->addColumn('iTypeBd',                      'biginteger',   [ 'null'    => true   ] )
			->addColumn('iFrequencyId',                 'biginteger',   [ 'null'    => true   ] )
			->addColumn('sSeasonIdList',                'string',       [ 'null'    => true   ] )
			->addColumn('sMonthIdList',                 'string',       [ 'null'    => true   ] )
			->addColumn('sValidation',                  'string',       [ 'null'    => true   ] )
			->addColumn('sInternalProcedure',           'string',       [ 'null'    => true   ] )
			->addColumn('iInterventionTypeId',          'biginteger',   [ 'null'    => true   ] )
			->addColumn('sInternalReferences',          'string',       [ 'null'    => true   ] )
			->addColumn('sExternalReferences',          'string',       [ 'null'    => true   ] )
			->addColumn('sUrl',                         'string',       [ 'null'    => true   ] )
			->addColumn('sKeywords',                    'string',       [ 'null'    => true   ] )
			->addColumn('sKeywordsEn',                  'string',       [ 'null'    => true   ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
    }
	
	protected function vCreateKBFileArborescenceTable(){
		
		$this->table('KBFileArborescence', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiFileId',                    'biginteger',   [ 'null'    => true   ] )
			->addColumn('iTypeBd',                      'biginteger',   [ 'null'    => true   ] )
			->addColumn('fkiSousTypeId',                'biginteger',   [ 'null'    => true   ] )
			->addColumn('fkiTypeId',                    'biginteger',   [ 'null'    => true   ] )
			->addColumn('fkiDivisionId',                'biginteger',   [ 'null'    => true   ] )
			->addColumn('fkiDirectionId',               'biginteger',   [ 'null'    => true   ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
	
	protected function vCreateKBFileCommentTable(){
		
		$this->table('KBFileComment', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiFileId',                    'biginteger',   [ 'null'    => true   ] )
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => true   ] )
			->addColumn('sComment',                     'string',       [ 'null'    => true   ] )
			->addColumn('iExpiration',                  'biginteger',   [ 'null'    => true   ] )
			->addColumn('bIsPublic',                    'integer',      [ 'null'    => true   ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,   'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
	
	protected function vCreateKBFileDocumentTable(){
		
		$this->table('KBFileDocument', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiFileId',                    'biginteger',   [ 'null'    => true   ] )
			->addColumn('fkiFichierId',                 'biginteger',   [ 'null'    => true   ] )
			->addColumn('sLang',                        'string',       [ 'null'    => true,    'length' => 10 ] )
			->addColumn('bIsPublic',                    'integer',      [ 'null'    => true   ] )
			->addColumn('iPriority',                    'biginteger',   [ 'null'    => true   ] )
			->addColumn('iDeprecated',                  'biginteger',   [ 'null'    => true   ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
	
	protected function vCreateKBFileEvaluationTable(){
		
		$this->table('KBFileEvaluation', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiFileId',                    'biginteger',   [ 'null'    => true   ] )
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => true   ] )
			->addColumn('iEvaluation',                  'biginteger',   [ 'null'    => true   ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
	
	protected function vCreateKBFileJournalisationTable(){
		
		$this->table('KBFileJournalisation', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => true   ] )
			->addColumn('fkiFileId',                    'biginteger',   [ 'null'    => true   ] )
			->addColumn('sTitle',                       'string',       [ 'null'    => true   ] )
			->addColumn('sBody',                        'string',       [ 'null'    => true   ] )
			->addColumn('sTitleEn',                     'string',       [ 'null'    => true   ] )
			->addColumn('sBodyEn',                      'string',       [ 'null'    => true   ] )
			->addColumn('iStatut',                      'biginteger',   [ 'null'    => true   ] )
			->addColumn('bSuggere',                     'integer',      [ 'null'    => true   ] )
			->addColumn('iPublication',                 'biginteger',   [ 'null'    => true   ] )
			->addColumn('iDeprecated',                  'biginteger',   [ 'null'    => true   ] )
			->addColumn('iFrequencyId',                 'biginteger',   [ 'null'    => true   ] )
			->addColumn('sSeasonIdList',                'string',       [ 'null'    => true   ] )
			->addColumn('sMonthIdList',                 'string',       [ 'null'    => true   ] )
			->addColumn('sValidation',                  'string',       [ 'null'    => true   ] )
			->addColumn('sInternalProcedure',           'string',       [ 'null'    => true   ] )
			->addColumn('iInterventionTypeId',          'biginteger',   [ 'null'    => true   ] )
			->addColumn('sInternalReferences',          'string',       [ 'null'    => true   ] )
			->addColumn('sExternalReferences',          'string',       [ 'null'    => true   ] )
			->addColumn('sUrl',                         'string',       [ 'null'    => true   ] )
			->addColumn('bDeletedCopy',                 'integer',      [ 'null'    => true   ] )
			->addColumn('iModificationCopy',            'biginteger',   [ 'null'    => true   ] )
			->addColumn('sResponsableList',             'string',       [ 'null'    => true   ] )
			->addColumn('sArborescenceNameList',        'string',       [ 'null'    => true   ] )
			->addColumn('dFileEvaluation',              'decimal',      [ 'null'    => true, 'precision' => 18, 'scale' => 0   ] )
			->addColumn('sKeywords',                    'string',       [ 'null'    => true   ] )
			->addColumn('sKeywordsEn',                  'string',       [ 'null'    => true   ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
	
	protected function vCreateKBFileRecuperateurAssociationTable(){
		
		$this->table('KBFileRecuperateurAssociation', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiFileId',                    'biginteger',   [ 'null'    => true   ] )
			->addColumn('fkiRecuperateurId',            'biginteger',   [ 'null'    => true   ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
	
	protected function vCreateKBFileWebsiteAssociationTable(){
		
		$this->table('KBFileWebsiteAssociation', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiFileId',                    'biginteger',   [ 'null'    => true   ] )
			->addColumn('fkiWebsiteId',                 'biginteger',   [ 'null'    => true   ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
	
	protected function vCreateKBObjectCategoryTable(){
		
		$this->table('KBObjectCategory', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true   ] )
			->addColumn('sNameFr',                      'string',       [ 'null'    => true,    'length' => 255   ] )
			->addColumn('sNameEn',                      'string',       [ 'null'    => true,    'length' => 255   ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
	
	protected function vCreateKBObjectCategoryAssociationTable(){
		
		$this->table('KBObjectCategoryAssociation', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiObjectCategoryId',          'biginteger',   [ 'null'    => true   ] )
			->addColumn('fkiOntologyId',                'biginteger',   [ 'null'    => true   ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
	
	protected function vCreateKBObjectRecuperationTable(){
		
		$this->table('KBObjectRecuperation', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true   ] )
			->addColumn('fkiOntologyId',                'biginteger',   [ 'null'    => true   ] )
			->addColumn('bCollecteMenagere',            'integer',      [ 'null'    => true   ] )
			->addColumn('sInfoSupp',                    'string',       [ 'null'    => true   ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
	
	protected function vCreateKBOntologyTable(){
		
		$this->table('KBOntology', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('sNameFr',                      'string',       [ 'null'    => true   ] )
			->addColumn('sNameEn',                      'string',       [ 'null'    => true   ] )
			->addColumn('sUri',                         'string',       [ 'null'    => true   ] )
			->addColumn('sJsonSynonymes',               'string',       [ 'null'    => true   ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
	
	protected function vCreateKBRecuperateurTable(){
		
		$this->table('KBRecuperateur', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true ] )
			->addColumn('fkiRecuperateurNomId',         'biginteger',   [ 'null'    => true ] )
			->addColumn('fkiAdressId',                  'biginteger',   [ 'null'    => true ] )
			->addColumn('sDescription',                 'string',       [ 'null'    => true   ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0 ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     [   'fkiOrganisationId',
								'fkiRecuperateurNomId',
								'fkiAdressId',
							    'bDeleted' ],                        [ 'name' => 'UniqueRecuperateur' ] )
			
			->create();
	}
	
	protected function vCreateKBRecuperateurNomTable(){
		
		$this->table('KBRecuperateurNom', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('sNameFr',                      'string',       [ 'null'    => true,    'length' => 255 ] )
			->addColumn('sNameEn',                      'string',       [ 'null'    => true,    'length' => 255 ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
	
	protected function vCreateKBRecuperateurObjectAssociationTable(){
		
		$this->table('KBRecuperateurObjectAssociation', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true ] )
			->addColumn('fkiOntologyId',                'biginteger',   [ 'null'    => true ] )
			->addColumn('fkiRecuperateurId',            'biginteger',   [ 'null'    => true ] )
			->addColumn('sModalite',                    'string',       [ 'null'    => true,    'length' => 255 ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
	
	protected function vCreateKBRecuperateurTelephoneAssociationTable(){
		
		$this->table('KBRecuperateurTelephoneAssociation', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiRecuperateurId',            'biginteger',   [ 'null'    => true ] )
			->addColumn('fkiTelephoneId',               'biginteger',   [ 'null'    => true ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     [   'fkiRecuperateurId',
								'fkiTelephoneId',
								'bDeleted'],                        [ 'name' => 'UniquePhoneAssociation' ] )
			
			->create();
	}
	
	protected function vCreateKBRecuperateurWebsiteAssociationTable(){
		
		$this->table('KBRecuperateurWebsiteAssociation', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiRecuperateurId',            'biginteger',   [ 'null'    => true ] )
			->addColumn('fkiWebsiteId',                 'biginteger',   [ 'null'    => true ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			->addIndex(     [   'fkiRecuperateurId',
								'fkiWebsiteId',
								'bDeleted'],                         [ 'name' => 'UniqueWebsiteAssociation' ] )
			
			->create();
	}
	
	protected function vCreateKBResponsableTable(){
		
		$this->table('KBResponsable', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiFileId',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iTypeId',                      'biginteger',   [ 'null'    => true ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
	
	protected function vCreateKBSignalementTable(){
		
		$this->table('KBSignalement', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true ] )
			->addColumn('fkiUserId',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('fkiFileId',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('fkiRecuperateurId',            'biginteger',   [ 'null'    => true ] )
			->addColumn('fkiObjectId',                  'biginteger',   [ 'null'    => true ] )
			->addColumn('sMessage',                     'string',       [ 'null'    => true ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
	
	protected function vCreateKBTreeClassTable(){
		
		$this->table('KBTreeClass', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true ] )
			->addColumn('fkiTreeStructureId',           'biginteger',   [ 'null'    => true ] )
			->addColumn('fkiClassParentId',             'biginteger',   [ 'null'    => true ] )
			->addColumn('sMessage',                     'string',       [ 'null'    => true,    'length' => 255 ] )
			->addColumn('sClassNameEn',                 'string',       [ 'null'    => true,    'length' => 255 ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
	
	protected function vCreateKBTreeClassStructureTable(){
		
		$this->table('KBTreeClassStructure', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                               'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',            'biginteger',   [ 'null'    => true ] )
			->addColumn('fkiParentClassId',             'biginteger',   [ 'null'    => true,    'default' => 1 ] )
			->addColumn('iGabaritId',                   'biginteger',   [ 'null'    => true ] )
			->addColumn('sClassName',                   'string',       [ 'null'    => true,    'length' => 100 ] )
			
			->addColumn('bDeleted',                     'integer',      [ 'null'    => false ,  'default' => 0  ] )
			->addColumn('iCreation',                    'biginteger',   [ 'null'    => true ] )
			->addColumn('iModification',                'biginteger',   [ 'null'    => true ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'idx_deleted' ] )
			
			->create();
	}
}
