<?php

use Phinx\Seed\AbstractSeed;

class UiMenuSeeder extends AbstractSeed
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
		
		$this->vUiMenu();
		$this->vUiMenuOrganisation();
			
    }

    private function vUiMenu(){
	
		$tableName = "UiMenu";
	    $oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
	    $table = $this->table($tableName);
	    $aData = [];
	    
	    foreach ($oRows as $oRow){
		    
		    array_push($aData, [
	    		'sLink'                 => $oRow->sLink,
	    		'sText'                 => $oRow->sText,
			    'iCreation'             => time(),
			    'iModification'         => time()
		    ]);
		
	    }
	
	    array_multisort(
		    array_column($aData,"sLink"), SORT_ASC,
		    $aData
	    );
	
	    //file_put_contents(__DIR__ . "/data/" . $tableName . ".out.json", json_encode($aData));
	
	    $table->truncate();
	    $table->insert($aData)->save();
	    echo("===> " . $tableName . "-> Ok\n");
	
    }
    
    private function vUiMenuOrganisation(){
	
	    $tableName = "UiMenuOrganisation";
	    $oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
	    $table = $this->table($tableName);
	    $aData = [];
	
	    foreach ($oRows as $oRow){
		
		    array_push($aData, [
			    'fkiOrganisationId'     => $oRow->fkiOrganisationId,
			    'sConfigMenu'           => $oRow->sConfigMenu,
			    'bDeleted'              => $oRow->bDeleted,
			    'iCreation'             => time(),
			    'iModification'         => time()
		    ]);
		
	    }
	
	    array_multisort(
		    array_column($aData,"fkiOrganisationId"), SORT_ASC, SORT_NUMERIC,
		    array_column($aData,"sConfigMenu"), SORT_ASC,
		    $aData
	    );
	
	    //file_put_contents(__DIR__ . "/data/" . $tableName . ".out.json", json_encode($aData));
	
	    $table->truncate();
	    $table->insert($aData)->save();
	    echo("===> " . $tableName . "-> Ok\n");
	
    }
	

}
