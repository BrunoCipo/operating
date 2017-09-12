<?php

use Phinx\Seed\AbstractSeed;

class TransactionSeeder extends AbstractSeed
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
		
		$this->vTransactionItem();
		
	}
	
	private function vTransactionItem(){
		
		$tableName = "TransactionItem";
		$oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
		$table = $this->table($tableName);
		$aData = [];
		
		foreach ($oRows as $oRow){
			
			array_push($aData, [
				'fkiOrganisationId'     => $oRow->fkiOrganisationId,
				'sNom'                  => $oRow->sNom,
				'sDescription'          => $oRow->sDescription,
				'iSousTotal'            => $oRow->iSousTotal,
				'iTPS'                  => $oRow->iTPS,
				'iTVQ'                  => $oRow->iTVQ,
				'iTotal'                => $oRow->iTotal,
				
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
		
	}
	
	
}
