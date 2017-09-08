<?php

use Phinx\Seed\AbstractSeed;

class OrganisationConfigurationSeeder extends AbstractSeed
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
		    array_column($aDataata,"sKey"), SORT_NUMERIC, SORT_ASC,
		    $aData
	    );
	
	    //file_put_contents(__DIR__ . "/data/OrganisationConfiguration.out.json", json_encode($aData));
	
	    $table->truncate();
	    $table->insert($aData)->save();
	
    }
	

}
