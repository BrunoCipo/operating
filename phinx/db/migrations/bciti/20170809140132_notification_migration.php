<?php

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class NotificationMigration extends AbstractMigration{

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

		$this->vCreateNotificationTable();
		$this->vCreateNotificationCategoryTable();
		$this->vCreateNotificationChannelTable();
		$this->vCreateNotificationEventTable();
		$this->vCreateNotificationOrganisationPreferenceTable();
		$this->vCreateNotificationRecipientTable();
		$this->vCreateNotificationUserChannelPreferenceTable();
		$this->vCreateNotificationUserPreferenceTable();
	}

	protected function vCreateNotificationTable(){
		
		$this->table('Notification', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity'  => true))
			
			->addColumn('fkiOrganisationId',            'biginteger',   array('null'    => false))
			->addColumn('iTypeId',                      'biginteger',   array('null'    => false))
			->addColumn('sLang',                        'string',       array('null'    => false,   'default'   => ''))
			->addColumn('sSenderName',                  'string',       array('null'    => false,   'default'   => ''))
			->addColumn('sSenderAddress',               'string',       array('null'    => false,   'default'   => ''))
			->addColumn('sSubject',                     'string',       array('null'    => false,   'length' => 1073741823 ))
			->addColumn('sText',                        'string',       array('null'    => false,   'length' => 1073741823 ))
			->addColumn('sAltText',                     'string',       array('null'    => false,   'length' => 1073741823 ))
			->addColumn('iSendAt',                      'biginteger',   array('null'    => false))
			->addColumn('iStatusId',                    'biginteger',   array('null'    => false))
			->addColumn('sMtxFileList',                 'string',       array('null'    => true,    'length' => 1073741823 ))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                          array('name' => 'idx_deleted'))
			->addIndex(     'fkiOrganisationId',                                 array('name' => 'idx_organisation'))
			->addIndex(     'iStatusId',                                         array('name' => 'idx_status'))
			
			->create();
	}

	protected function vCreateNotificationCategoryTable(){
		
		$this->table('NotificationCategory', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity'  => true))
			
			->addColumn('fkiOrganisationId',            'biginteger',   array('null'    => false))
			->addColumn('iTypeId',                      'biginteger',   array('null'    => false))
			->addColumn('sName',                        'string',       array('null'    => false,   'length' => 1073741823 ))
			->addColumn('sDescription',                 'string',       array('null'    => false,   'length' => 1073741823 ))
			->addColumn('sMetaData',                    'string',       array('null'    => false,   'length' => 1073741823 ))
			->addColumn('sNotificationChannelList',     'string',       array('null'    => true,    'length' => 1073741823 ))
			->addColumn('iPriorityId',                  'biginteger',   array('null'    => true))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                          array('name' => 'idx_deleted'))
			->addIndex(     'fkiOrganisationId',                                 array('name' => 'idx_organisation'))
			->addIndex(     'iTypeId',                                           array('name' => 'idx_type'))
			
			->create();
	}

	protected function vCreateNotificationChannelTable(){
		
		$this->table('NotificationChannel', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity'  => true))
			
			->addColumn('fkiOrganisationId',            'biginteger',   array('null'    => false))
			->addColumn('iTypeId',                      'biginteger',   array('null'    => false))
			->addColumn('sName',                        'string',       array('null'    => false,   'length' => 1073741823 ))
			->addColumn('sDescription',                 'string',       array('null'    => false,   'length' => 1073741823 ))
			->addColumn('sMetaData',                    'string',       array('null'    => false,   'length' => 1073741823 ))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                          array('name' => 'idx_deleted'))
			->addIndex(     'fkiOrganisationId',                                 array('name' => 'idx_organisation'))
			->addIndex(     'iTypeId',                                           array('name' => 'idx_type'))
			
			->create();
	}

	protected function vCreateNotificationEventTable(){
		
		$this->table('NotificationEvent', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity'  => true))
			
			->addColumn('fkiOrganisationId',            'biginteger',   array('null'    => false))
			->addColumn('fkiNotificationCategoryId',    'biginteger',   array('null'    => false))
			->addColumn('iTypeId',                      'biginteger',   array('null'    => false))
			->addColumn('sName',                        'string',       array('null'    => false,   'length' => 1073741823 ))
			->addColumn('sDescription',                 'string',       array('null'    => false,   'length' => 1073741823 ))
			->addColumn('sMetaData',                    'string',       array('null'    => false,   'length' => 1073741823 ))
			->addColumn('fkiFichierId',                 'biginteger',   array('null'    => true))
			->addColumn('bRequired',                    'integer',      array('null'    => false,   'default' => 0))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                          array('name' => 'idx_deleted'))
			->addIndex(     'fkiNotificationCategoryId',                         array('name' => 'idx_category'))
			->addIndex(     'fkiOrganisationId',                                 array('name' => 'idx_organisation'))
			->addIndex(     'iTypeId',                                           array('name' => 'idx_type'))
			
			->create();
	}

	protected function vCreateNotificationOrganisationPreferenceTable(){
		
		$this->table('NotificationOrganisationPreference', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity'  => true))
			
			->addColumn('fkiOrganisationId',            'biginteger',   array('null'    => false))
			->addColumn('fkiNotificationCategoryId',    'biginteger',   array('null'    => true))
			->addColumn('fkiNotificationEventId',       'biginteger',   array('null'    => true))
			->addColumn('fkiNotificationChannelId',     'biginteger',   array('null'    => true))
			->addColumn('sAvailableDelayList',          'string',       array('null'    => false,   'length' => 1073741823 ))
			->addColumn('iDelayInSeconds',              'biginteger',   array('null'    => true))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                          array('name' => 'idx_deleted'))
			->addIndex(     'fkiNotificationCategoryId',                         array('name' => 'idx_category'))
			->addIndex(     'fkiNotificationChannelId',                          array('name' => 'idx_channel'))
			->addIndex(     'fkiNotificationEventId',                            array('name' => 'idx_event'))
			->addIndex(     'fkiOrganisationId',                                 array('name' => 'idx_organisation'))
			
			->create();
	}

	protected function vCreateNotificationRecipientTable(){
		
		$this->table('NotificationRecipient', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity'  => true))
			
			->addColumn('fkiOrganisationId',            'biginteger',   array('null'    => false))
			->addColumn('fkiUserId',                    'biginteger',   array('null'    => false))
			->addColumn('fkiNotificationId',            'biginteger',   array('null'    => false))
			->addColumn('sName',                        'string',       array('null'    => false, 'length' => 150, 'default' => ''))
			->addColumn('sAddress',                     'string',       array('null'    => false, 'length' => 300, 'default' => ''))
			->addColumn('sMetaData',                    'string',       array('null'    => false, 'length' => 1073741823 , 'default' => ''))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                          array('name' => 'idx_deleted'))
			->addIndex(     'fkiNotificationId',                                 array('name' => 'idx_notification'))
			->addIndex(     'fkiUserId',                                         array('name' => 'idx_user'))
			
			->create();
	}

	protected function vCreateNotificationUserChannelPreferenceTable(){
		
		$this->table('NotificationUserChannelPreference', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity'  => true))
			
			->addColumn('fkiOrganisationId',            'biginteger',   array('null'    => false))
			->addColumn('fkiUserId',                    'biginteger',   array('null'    => false))
			->addColumn('fkiNotificationCategoryId',    'biginteger',   array('null'    => false))
			->addColumn('fkiNotificationChannelId',     'biginteger',   array('null'    => false))
			->addColumn('sMetaData',                    'string',       array('null'    => true,   'length' => 1073741823 ))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->create();
	}

	protected function vCreateNotificationUserPreferenceTable(){
		
		$this->table('NotificationUserPreference', array('id'=> false, 'primary_key' => array('id')))
			->addColumn('id',                               'biginteger',   array('identity'  => true))
			
			->addColumn('fkiOrganisationId',            'biginteger',   array('null'    => false))
			->addColumn('fkiUserId',                    'biginteger',   array('null'    => false))
			->addColumn('fkiNotificationCategoryId',    'biginteger',   array('null'    => false))
			->addColumn('fkiNotificationEventId',       'biginteger',   array('null'    => false))
			->addColumn('fkiNotificationChannelId',     'biginteger',   array('null'    => false))
			->addColumn('iDelayInSeconds',              'biginteger',   array('null'    => true))
			
			->addColumn('bDeleted',                     'integer',      array('null'    => false,   'default' => 0))
			->addColumn('iCreation',                    'biginteger',   array('null'    => true))
			->addColumn('iModification',                'biginteger',   array('null'    => true))
			
			->addIndex(     'bDeleted',                                          array('name' => 'idx_deleted'))
			
			->addIndex(        array('fkiOrganisationId',
							         'fkiUserId',
									 'fkiNotificationCategoryId',
									 'fkiNotificationEventId',
									 'fkiNotificationChannelId'),                         array('name' => 'uq_user_preference_delay', 'unique' => true))
			
			->addIndex(     'fkiNotificationCategoryId',                         array('name' => 'idx_category'))
			->addIndex(     'fkiNotificationEventId',                            array('name' => 'idx_event'))
			->addIndex(     'fkiOrganisationId',                                 array('name' => 'idx_organisation'))
			->addIndex(     'fkiUserId',                                         array('name' => 'idx_user'))
			
			->create();
	}
}