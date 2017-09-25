<?php

use Phinx\Seed\AbstractSeed;

class ActiviteSeeder extends AbstractSeed
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
		
		$this->vActivite();
		$this->vActiviteLieu();
			
    }

    private function vActivite(){
	
		$tableName = "Activite";
	    $oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
	    $table = $this->table($tableName);
	    $aData = [];
	
	    foreach ($oRows as $oRow){
		
		    array_push($aData, [
			    'fkiOrganisationId'     => $oRow->fkiOrganisationId,
			    'sNom'                  => $oRow->sNom,
			    'sDescription'          => $oRow->sDescription,
			    'bDeleted'              => $oRow->bDeleted,
			    'iCreation'             => time(),
			    'iModification'         => time()
		    ]);
		
	    }
	
	    array_multisort(
		    array_column($aData,"fkiOrganisationId"), SORT_ASC, SORT_NUMERIC,
		    array_column($aData,"sNom"), SORT_ASC,
		    $aData
	    );
	
	    //file_put_contents(__DIR__ . "/data/" . $tableName . ".json", json_encode($aData));
	
	    $table->truncate();
	    $table->insert($aData)->save();
	
	    echo("===> " . $tableName . "-> Ok\n");
    }
    
    private function vActiviteLieu(){

	    $tableName = "ActiviteLieu";
	    $oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
	    $table = $this->table($tableName);
	    $aData = [];
	
	    foreach ($oRows as $oRow){
		
		    array_push($aData, [
			    'fkiActiviteId'             => $oRow->fkiActiviteId,
			    'sAdresseDescription'       => $oRow->sAdresseDescription,
			    'sAdresseNumeroCivique'     => $oRow->sAdresseNumeroCivique,
			    'sAdressePorte'             => $oRow->sAdressePorte,
			    'sAdresseRue'               => $oRow->sAdresseRue,
			    'sAdresseVille'             => $oRow->sAdresseVille,
			    'sAdresseProvince'          => $oRow->sAdresseProvince,
			    'sAdressePays'              => $oRow->sAdressePays,
			    'sAdresseCodePostal'        => $oRow->sAdresseCodePostal,

			    'bDeleted'                  => $oRow->bDeleted,
			    'iCreation'                 => time(),
			    'iModification'             => time()
		    ]);
		
	    }
	
	    array_multisort(
		    array_column($aData,"fkiActiviteId"), SORT_ASC, SORT_NUMERIC,
		    array_column($aData,"sAdresseDescription"), SORT_ASC,
		    $aData
	    );
	
	    //file_put_contents(__DIR__ . "/data/" . $tableName . ".json", json_encode($aData));
	
	    $table->truncate();
	    $table->insert($aData)->save();
	    echo("===> " . $tableName . "-> Ok\n");
	
    }
	

}
