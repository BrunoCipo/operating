<?php

use Phinx\Seed\AbstractSeed;

class ConstraintSeeder extends AbstractSeed
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
		
		$this->vConstraintCategory();
		$this->vConstraintDefinition();
			
    }

    private function vConstraintCategory(){
	
		$tableName = "ConstraintCategory";
	    $oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
	    $table = $this->table($tableName);
	    $aData = [];
	
	    foreach ($oRows as $oRow){
		
		    array_push($aData, [
			    'fkiOrganisationId'     => $oRow->fkiOrganisationId,
			    'sName'                 => $oRow->sName,
			    'sDescription'          => $oRow->sDescription,
			    
			    'bDeleted'              => $oRow->bDeleted,
			    'iCreation'             => time(),
			    'iModification'         => time()
		    ]);
		
	    }
	
	    array_multisort(
		    array_column($aData,"fkiOrganisationId"), SORT_ASC, SORT_NUMERIC,
		    $aData
	    );
	
	    //file_put_contents(__DIR__ . "/data/" . $tableName . ".json", json_encode($aData));
	
	    $table->truncate();
	    $table->insert($aData)->save();
	
    }
	
    private function vConstraintDefinition(){
	
		$tableName = "ConstraintDefinition";
	    $oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
	    $table = $this->table($tableName);
	    $aData = [];
	
	    foreach ($oRows as $oRow){
		
		    array_push($aData, [
			    'fkiOrganisationId'         => $oRow->fkiOrganisationId,
			    'iCodeId'                   => $oRow->iCodeId,
			    'fkiConstraintCategoryId'   => $oRow->fkiConstraintCategoryId,
			    'sName'                     => $oRow->sName,
			    'sDescription'              => $oRow->sDescription,
			    'sCondition'                => $oRow->sCondition,
			    'sAvailableOperatorList'    => $oRow->sAvailableOperatorList,
			    'bIsBlocking'               => $oRow->bIsBlocking,
			    
			    'bDeleted'                  => $oRow->bDeleted,
			    'iCreation'                 => time(),
			    'iModification'             => time()
		    ]);
		
	    }
	
	    array_multisort(
		    array_column($aData,"fkiOrganisationId"), SORT_ASC, SORT_NUMERIC,
		    array_column($aData,"iCodeId"), SORT_ASC, SORT_NUMERIC,
		    array_column($aData,"fkiConstraintCategoryId"), SORT_ASC, SORT_NUMERIC,
		    $aData
	    );
	
	    //file_put_contents(__DIR__ . "/data/" . $tableName . ".json", json_encode($aData));
	
	    $table->truncate();
	    $table->insert($aData)->save();
	
    }
	
}
