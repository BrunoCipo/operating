<?php

use Phinx\Seed\AbstractSeed;

class systExtSeeder extends AbstractSeed
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
		
		$this->vSystExtAcceoLudikFamille();
		$this->vSystExtMamrotListVille();
		$this->vSystExtSomum();
    }
	
	private function vSystExtAcceoLudikFamille(){
		$tableName = "SystExtAcceoLudikFamille";
		$oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
		$table = $this->table($tableName);
		$aData = [];
		
		echo("===> Table " . $tableName . "\n");
		
		$table->truncate();
		
		$i = 0;
		foreach ($oRows as $oRow){
			
			if (++$i % 1000 == 0){
				echo ("=====> Batch inserts -------> " . $i . "\n");
				$table->insert($aData)->save();
				$aData = [];
			}
			
			array_push($aData, [
				'sIdentifiantNumero1'                   => $oRow->sIdentifiantNumero1,
				'sIdentifiantNumero2'                   => $oRow->sIdentifiantNumero2,
				'iUserRelationType'                     => $oRow->iUserRelationType,
				
				'bDeleted'                              => $oRow->bDeleted,
				'iCreation'                             => time(),
				'iModification'                         => time()
			]);
			
		}
		
		$table->insert($aData)->save();

		echo ("=====>  Total Insert: " . $i . "\n");
		echo("===> " . $tableName . "-> Ok\n");
		
	}
	
	private function vSystExtMamrotListVille(){
		
		$tableName = "SystExtMamrotListVille";
		$oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
		$table = $this->table($tableName);
		$aData = [];
		
		foreach ($oRows as $oRow){
			
			array_push($aData, [
				'fkiOrganisationId'                     => $oRow->fkiOrganisationId,
				'sCode'                                 => $oRow->sCode,
				'sVille'                                => $oRow->sVille,
				'sDesignation'                          => $oRow->sDesignation,
				'iRegionAdminCode'                      => $oRow->iRegionAdminCode,
				
				'bDeleted'                              => $oRow->bDeleted,
				'iCreation'                             => time(),
				'iModification'                         => time()
			]);
			
		}
		
		array_multisort(
			array_column($aData,"fkiOrganisationId"), SORT_ASC, SORT_NUMERIC,
			array_column($aData,"sVille"), SORT_ASC,
			$aData
		);
		
		//file_put_contents(__DIR__ . "/data/" . $tableName . ".json", json_encode($aData));
		
		$table->truncate();
		$table->insert($aData)->save();
		echo("===> " . $tableName . "-> Ok\n");
		
	}
	
	private function vSystExtSomum()
	{
		
		$tableName = 'SystExtSomum';
		$oRows = json_decode(file_get_contents(__DIR__ . '/data/' . $tableName . '.json'));
		$table = $this->table($tableName);
		$aData = [];
		
		echo("===> Table " . $tableName . "\n");
		
		$table->truncate();
		
		$i = 0;
		foreach ($oRows as $oRow) {
			
			if (++$i % 1000 == 0) {
				echo("=====> Batch inserts -------> " . $i . "\n");
				$table->insert($aData)->save();
				$aData = [];
			}
			
			array_push($aData, [
				'googleid' => $oRow->googleid,
				'nom' => $oRow->nom,
				'prenom' => $oRow->prenom,
				'nocivique' => $oRow->nocivique,
				'appt' => $oRow->appt,
				'rue' => $oRow->rue,
				'ville' => $oRow->codepostal,
				'codepostal' => $oRow->codepostal,
				'nbcoord' => $oRow->nbcoord,
				'coord1' => $oRow->coord1,
				'poste1' => $oRow->poste1,
				'type1' => $oRow->type1,
				'coord2' => $oRow->coord2,
				'poste2' => $oRow->poste2,
				'type2' => $oRow->type2,
				'coord3' => $oRow->coord3,
				'poste3' => $oRow->poste3,
				'type3' => $oRow->type3,
				'coord4' => $oRow->coord4,
				'poste4' => $oRow->poste4,
				'type4' => $oRow->type4,
				'coord5' => $oRow->coord5,
				'poste5' => $oRow->poste5,
				'type5' => $oRow->type5,
				'coord6' => $oRow->coord6,
				'poste6' => $oRow->poste6,
				'type6' => $oRow->type6,
				'coord7' => $oRow->coord7,
				'poste7' => $oRow->poste7,
				'type7' => $oRow->type7
			]);

		}
		
		$table->insert($aData)->save();
		echo("=====>  Total Insert: " . $i . "\n");
		echo("===> " . $tableName . "-> Ok\n");
		
	}
	
}
