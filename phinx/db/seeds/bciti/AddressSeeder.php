<?php

use Phinx\Seed\AbstractSeed;

class AddressSeeder extends AbstractSeed
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
		
		$this->vAddressCity();
		$this->vAddressCityName();
		$this->vAddressCountry();
		$this->vAddressCountryName();
		$this->vAddressCountryConfig();
		$this->vAddressRegion();
		$this->vAddressRegionName();
			
    }

    private function vAddressCity(){
	
		$tableName = "AddressCity";
	    $oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
	    $table = $this->table($tableName);
	    $aData = [];
	
	    foreach ($oRows as $oRow){
		
		    array_push($aData, [
			    'fkiAddressCountryId'   => $oRow->fkiAddressCountryId,
			    'fkiAddressRegionId'    => $oRow->fkiAddressRegionId,
			    'sCode'                 => $oRow->sCode,
			    
			    'bDeleted'              => $oRow->bDeleted,
			    'iCreation'             => time(),
			    'iModification'         => time()
		    ]);
		
	    }
	
	    array_multisort(
		    array_column($aData,"fkiAddressCountryId"), SORT_ASC, SORT_NUMERIC,
		    array_column($aData,"fkiAddressRegionId"), SORT_ASC, SORT_NUMERIC,
		    array_column($aData,"sCode"), SORT_NUMERIC,
		    $aData
	    );
	
	    //file_put_contents(__DIR__ . "/data/" . $tableName . ".json", json_encode($aData));
	
	    $table->truncate();
	    $table->insert($aData)->save();
	
    }

    private function vAddressCityName(){
	
		$tableName = "AddressCityName";
	    $oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
	    $table = $this->table($tableName);
	    $aData = [];
	
	    foreach ($oRows as $oRow){
		
		    array_push($aData, [
			    'fkiAddressCityId'      => $oRow->fkiAddressCityId,
			    'fkiLanguageId'         => $oRow->fkiLanguageId,
			    'sName'                 => $oRow->sName,
			    
			    'bDeleted'              => $oRow->bDeleted,
			    'iCreation'             => time(),
			    'iModification'         => time()
		    ]);
		
	    }
	
	    array_multisort(
		    array_column($aData,"fkiAddressCityId"), SORT_ASC, SORT_NUMERIC,
		    array_column($aData,"fkiLanguageId"), SORT_ASC, SORT_NUMERIC,
		    $aData
	    );
	
	    //file_put_contents(__DIR__ . "/data/" . $tableName . ".json", json_encode($aData));
	
	    $table->truncate();
	    $table->insert($aData)->save();
	
    }
    
    private function vAddressCountry(){
	
		$tableName = "AddressCountry";
	    $oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
	    $table = $this->table($tableName);
	    $aData = [];
	
	    foreach ($oRows as $oRow){
		
		    array_push($aData, [
			    'sDefaultName'          => $oRow->sDefaultName,
			    'sIso2Code'             => $oRow->sIso2Code,
			    'sIso3Code'             => $oRow->sIso3Code,
			    'iNumericCode'          => $oRow->iNumericCode,
			    
			    'bDeleted'              => $oRow->bDeleted,
			    'iCreation'             => time(),
			    'iModification'         => time()
		    ]);
		
	    }
	
	    array_multisort(
		    array_column($aData,"sDefaultName"), SORT_ASC,
		    $aData
	    );
	
	    //file_put_contents(__DIR__ . "/data/" . $tableName . ".json", json_encode($aData));
	
	    $table->truncate();
	    $table->insert($aData)->save();
	
    }
    
    private function vAddressCountryName(){
	
		$tableName = "AddressCountryName";
	    $oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
	    $table = $this->table($tableName);
	    $aData = [];
	
	    foreach ($oRows as $oRow){
		
		    array_push($aData, [
			    'fkiAddressCountryId'   => $oRow->fkiAddressCountryId,
			    'fkiLanguageId'         => $oRow->fkiLanguageId,
			    'sName'                 => $oRow->sName,
			    
			    'bDeleted'              => $oRow->bDeleted,
			    'iCreation'             => time(),
			    'iModification'         => time()
		    ]);
		
	    }
	
	    array_multisort(
		    array_column($aData,"fkiAddressCountryId"), SORT_ASC, SORT_NUMERIC,
		    array_column($aData,"fkiLanguageId"), SORT_ASC, SORT_NUMERIC,
		    $aData
	    );
	
	    file_put_contents(__DIR__ . "/data/" . $tableName . ".json", json_encode($aData));
	
	    $table->truncate();
	    $table->insert($aData)->save();
	
    }
    
    private function vAddressCountryConfig(){
	
		$tableName = "AddressCountryConfig";
	    $oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
	    $table = $this->table($tableName);
	    $aData = [];
	
	    foreach ($oRows as $oRow){
		
		    array_push($aData, [
			    'fkiAddressCountryId'   => $oRow->fkiAddressCountryId,
			    'sPostalCodeFormat'     => $oRow->sPostalCodeFormat,
			    'sAddressFormat'        => $oRow->sAddressFormat,
			    'sPhonePrefix'          => $oRow->sPhonePrefix,
			    'bHasRegion'            => $oRow->bHasRegion,
			    
			    'bDeleted'              => $oRow->bDeleted,
			    'iCreation'             => time(),
			    'iModification'         => time()
		    ]);
		
	    }
	
	    array_multisort(
		    array_column($aData,"fkiAddressCountryId"), SORT_ASC, SORT_NUMERIC,
		    $aData
	    );
	
	    file_put_contents(__DIR__ . "/data/" . $tableName . ".json", json_encode($aData));
	
	    $table->truncate();
	    $table->insert($aData)->save();
	
    }
    
    private function vAddressRegion(){
	
		$tableName = "AddressRegion";
	    $oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
	    $table = $this->table($tableName);
	    $aData = [];
	
	    foreach ($oRows as $oRow){
		
		    array_push($aData, [
			    'fkiAddressCountryId'   => $oRow->fkiAddressCountryId,
			    'sCode'                 => $oRow->sCode,
			    'sIsoCode'              => $oRow->sIsoCode,
			    
			    'bDeleted'              => $oRow->bDeleted,
			    'iCreation'             => time(),
			    'iModification'         => time()
		    ]);
		
	    }
	
	    array_multisort(
		    array_column($aData,"fkiAddressCountryId"), SORT_ASC, SORT_NUMERIC,
		    array_column($aData,"sCode"), SORT_ASC,
		    $aData
	    );
	
	    //file_put_contents(__DIR__ . "/data/" . $tableName . ".json", json_encode($aData));
	
	    $table->truncate();
	    $table->insert($aData)->save();
	
    }
    
    private function vAddressRegionName(){
	
		$tableName = "AddressRegionName";
	    $oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
	    $table = $this->table($tableName);
	    $aData = [];
	
	    foreach ($oRows as $oRow){
		
		    array_push($aData, [
			    'fkiAddressRegionId'    => $oRow->fkiAddressRegionId,
			    'fkiLanguageId'         => $oRow->fkiLanguageId,
			    'sName'                 => $oRow->sName,
			    
			    'bDeleted'              => $oRow->bDeleted,
			    'iCreation'             => time(),
			    'iModification'         => time()
		    ]);
		
	    }
	
	    array_multisort(
		    array_column($aData,"fkiAddressRegionId"), SORT_ASC, SORT_NUMERIC,
		    array_column($aData,"fkiLanguageId"), SORT_ASC, SORT_NUMERIC,
		    $aData
	    );
	
	    file_put_contents(__DIR__ . "/data/" . $tableName . ".json", json_encode($aData));
	
	    $table->truncate();
	    $table->insert($aData)->save();
	
    }
    
}
