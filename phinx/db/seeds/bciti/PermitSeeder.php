<?php

use Phinx\Seed\AbstractSeed;

class PermitSeeder extends AbstractSeed
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
		
		$this->vPermitCategory();
    }

	private function vPermitCategory(){
		
		$tableName = "PermitCategory";
		$oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
		$table = $this->table($tableName);
		$aData = [];
		
		foreach ($oRows as $oRow){
			
			array_push($aData, [
				'fkiOrganisationId'      => $oRow->fkiOrganisationId,
				'iPermitTypeId'          => $oRow->iPermitTypeId,
				'sName'                  => $oRow->sName,
				'sDescription'           => $oRow->sDescription,
				
				'bDeleted'               => $oRow->bDeleted,
				'iCreation'              => time(),
				'iModification'          => time()
			]);
			
		}
		
		array_multisort(
			array_column($aData,"fkiOrganisationId"), SORT_ASC, SORT_NUMERIC,
			array_column($aData,"iPermitTypeId"), SORT_ASC, SORT_NUMERIC,
			array_column($aData,"sName"), SORT_ASC,
			$aData
		);
		
		//file_put_contents(__DIR__ . "/data/" . $tableName . ".json", json_encode($aData));
		
		$table->truncate();
		$table->insert($aData)->save();
		echo("===> " . $tableName . "-> Ok\n");
		
	}
	
}
