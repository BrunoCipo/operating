<?php

use Phinx\Seed\AbstractSeed;

class OrganisationSeeder extends AbstractSeed
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
		
		$this->vOrganisationConfiguration();
		$this->vOrganisation();
		$this->vOrganisationNumeroTel();
    }

    private function vOrganisationConfiguration(){
	
	    $oOrganisationConfigurations = json_decode(file_get_contents(__DIR__ . "/data/OrganisationConfiguration.json"));
	    $table = $this->table('OrganisationConfiguration');
	    $aData = [];
	    
	    foreach ($oOrganisationConfigurations as $oOrganisationConfiguration){
		    
		    array_push($aData, [
	    		'fkiOrganisationId'     => $oOrganisationConfiguration->fkiOrganisationId,
	    		'sKey'                  => $oOrganisationConfiguration->sKey,
	    		'sValue'                => $oOrganisationConfiguration->sValue,
	    		'bDeleted'              => $oOrganisationConfiguration->bDeleted,
			    'iCreation'             => time(),
			    'iModification'         => time()
		    ]);
		
	    }
	
	    array_multisort(
		    array_column($aData,"fkiOrganisationId"), SORT_NUMERIC, SORT_ASC,
		    array_column($aData,"sKey"), SORT_NUMERIC, SORT_ASC,
		    $aData
	    );
	
	    file_put_contents(__DIR__ . "/data/OrganisationConfiguration.out.json", json_encode($aData));
	
	    $table->truncate();
	    $table->insert($aData)->save();
	
    }
	
	private function vOrganisation(){
		
		$tableName = "Organisation";
		$oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
		$table = $this->table($tableName);
		$aData = [];
		
		foreach ($oRows as $oRow){
			
			array_push($aData, [
				'id'                            => $oRow->id,
				'iOrganisationNatureType'       => $oRow->iOrganisationNatureType,
				'iOrganisationDomaineType'      => $oRow->iOrganisationDomaineType,
				'sNom'                          => $oRow->sNom,
				'sUrl'                          => $oRow->sUrl,
				'sLogo'                         => $oRow->sLogo,
				
				'bDeleted'                      => $oRow->bDeleted,
				'iCreation'                     => time(),
				'iModification'                 => time()
			]);
			
		}
		
		array_multisort(
			array_column($aData,"id"), SORT_ASC, SORT_NUMERIC,
			$aData
		);
		
		//file_put_contents(__DIR__ . "/data/" . $tableName . ".json", json_encode($aData));
		
		$table->truncate();
		$table->insert($aData)->save();
		
	}
	
	private function vOrganisationNumeroTel(){
		
		$tableName = "OrganisationNumeroTel";
		$oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
		$table = $this->table($tableName);
		$aData = [];
		
		foreach ($oRows as $oRow){
			
			array_push($aData, [
				'fkiOrganisationId'             => $oRow->fkiOrganisationId,
				'sNumeroTel'                    => $oRow->sNumeroTel,
				'iOrganisationNumeroTelType'    => $oRow->iOrganisationNumeroTelType,
				
				'bDeleted'                      => $oRow->bDeleted,
				'iCreation'                     => time(),
				'iModification'                 => time()
			]);
			
		}
		
		array_multisort(
			array_column($aData,"fkiOrganisationId"), SORT_ASC, SORT_NUMERIC,
			array_column($aData,"iOrganisationDomaineType"), SORT_ASC, SORT_NUMERIC,
			array_column($aData,"sNom"), SORT_ASC,
			$aData
		);
		
		file_put_contents(__DIR__ . "/data/" . $tableName . ".json", json_encode($aData));
		
		$table->truncate();
		$table->insert($aData)->save();
		
	}
	
}
