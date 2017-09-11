<?php

use Phinx\Seed\AbstractSeed;

class DocumentSeeder extends AbstractSeed
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
		
		$this->vDocument();
			
    }

    private function vDocument(){
	
		$tableName = "Document";
	    $oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
	    $table = $this->table($tableName);
	    $aData = [];
	
	    foreach ($oRows as $oRow){
		
		    array_push($aData, [
			    'fkiOrganisationId'         => $oRow->fkiOrganisationId,
			    'iTypeId'                   => $oRow->iTypeId,
			    'sName'                     => $oRow->sName,
			    'sClassName'                => $oRow->sClassName,
			    
			    'bDeleted'                  => $oRow->bDeleted,
			    'iCreation'                 => time(),
			    'iModification'             => time()
		    ]);
		
	    }
	
	    array_multisort(
		    array_column($aData,"fkiOrganisationId"), SORT_ASC, SORT_NUMERIC,
		    array_column($aData,"fkiParentClassId"), SORT_ASC, SORT_NUMERIC,
		    array_column($aData,"iGabaritId"), SORT_ASC, SORT_NUMERIC,
		    $aData
	    );
	
	    file_put_contents(__DIR__ . "/data/" . $tableName . ".json", json_encode($aData));
	
	    $table->truncate();
	    $table->insert($aData)->save();
	
    }
	
}
