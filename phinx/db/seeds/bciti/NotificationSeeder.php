<?php

use Phinx\Seed\AbstractSeed;

class NotificationSeeder extends AbstractSeed
{
	
	/**
	 * Run Method.
	 *
	 * Write your database seeder using this method.
	 *
	 * More information on writing seeders is available here:
	 * http://docs.phinx.org/en/latest/seeding.html
	 */
	public function run(){
		
		$this->vNotificationCategory();
		$this->vNotificationChannel();
		$this->vNotificationOrganisationPreference();
			
    }

    private function vNotificationCategory(){
	
		$tableName = "NotificationCategory";
	    $oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
	    $table = $this->table($tableName);
	    $aData = [];
	
	    foreach ($oRows as $oRow){
		
		    array_push($aData, [
			    'fkiOrganisationId'             => $oRow->fkiOrganisationId,
			    'iTypeId'                       => $oRow->iTypeId,
			    'sName'                         => $oRow->sName,
			    'sDescription'                  => $oRow->sDescription,
			    'sMetaData'                     => $oRow->sMetaData,
			    'sNotificationChannelList'      => $oRow->sNotificationChannelList,
			    
			    'bDeleted'                      => $oRow->bDeleted,
			    'iCreation'                     => time(),
			    'iModification'                 => time()
		    ]);
		
	    }
	
	    array_multisort(
		    array_column($aData,"fkiOrganisationId"), SORT_ASC, SORT_NUMERIC,
		    array_column($aData,"iTypeId"), SORT_ASC, SORT_NUMERIC,
		    array_column($aData,"sName"), SORT_ASC,
		    $aData
	    );
	
	    file_put_contents(__DIR__ . "/data/" . $tableName . ".json", json_encode($aData));
	
	    $table->truncate();
	    $table->insert($aData)->save();
	
    }
	
    private function vNotificationChannel(){
	
		$tableName = "NotificationChannel";
	    $oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
	    $table = $this->table($tableName);
	    $aData = [];
	
	    foreach ($oRows as $oRow){
		
		    array_push($aData, [
			    'fkiOrganisationId'             => $oRow->fkiOrganisationId,
			    'iTypeId'                       => $oRow->iTypeId,
			    'sName'                         => $oRow->sName,
			    'sDescription'                  => $oRow->sDescription,
			    'sMetaData'                     => $oRow->sMetaData,
			    
			    'bDeleted'                      => $oRow->bDeleted,
			    'iCreation'                     => time(),
			    'iModification'                 => time()
		    ]);
		
	    }
	
	    array_multisort(
		    array_column($aData,"fkiOrganisationId"), SORT_ASC, SORT_NUMERIC,
		    array_column($aData,"iTypeId"), SORT_ASC, SORT_NUMERIC,
		    array_column($aData,"sName"), SORT_ASC,
		    $aData
	    );
	
	    file_put_contents(__DIR__ . "/data/" . $tableName . ".json", json_encode($aData));
	
	    $table->truncate();
	    $table->insert($aData)->save();
	
    }
	
    private function vNotificationOrganisationPreference(){
	
		$tableName = "NotificationOrganisationPreference";
	    $oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
	    $table = $this->table($tableName);
	    $aData = [];
	
	    foreach ($oRows as $oRow){
		
		    array_push($aData, [
			    'fkiOrganisationId'             => $oRow->fkiOrganisationId,
			    'fkiNotificationCategoryId'     => $oRow->fkiNotificationCategoryId,
			    'fkiNotificationEventId'        => $oRow->fkiNotificationEventId,
			    'fkiNotificationChannelId'      => $oRow->fkiNotificationChannelId,
			    'sAvailableDelayList'           => $oRow->sAvailableDelayList,
			    'iDelayInSeconds'               => $oRow->iDelayInSeconds,
			    
			    'bDeleted'                      => $oRow->bDeleted,
			    'iCreation'                     => time(),
			    'iModification'                 => time()
		    ]);
		
	    }
	
	    array_multisort(
		    array_column($aData,"fkiOrganisationId"), SORT_ASC, SORT_NUMERIC,
		    array_column($aData,"fkiNotificationCategoryId"), SORT_ASC, SORT_NUMERIC,
		    array_column($aData,"fkiNotificationEventId"), SORT_ASC, SORT_NUMERIC,
		    array_column($aData,"fkiNotificationChannelId"), SORT_ASC, SORT_NUMERIC,
		    $aData
	    );
	
	    file_put_contents(__DIR__ . "/data/" . $tableName . ".json", json_encode($aData));
	
	    $table->truncate();
	    $table->insert($aData)->save();
	
    }
	
}
