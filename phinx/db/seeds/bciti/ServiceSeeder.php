<?php

use Phinx\Seed\AbstractSeed;

class ServiceSeeder extends AbstractSeed
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
		
		$this->vService();
    }

	private function vService(){
		
		$tableName = "Service";
		$oRows = json_decode(file_get_contents(__DIR__ . "/data/" . $tableName . ".json"));
		$table = $this->table($tableName);
		$aData = [];
		
		foreach ($oRows as $oRow){
			
			array_push($aData, [
				'fkiOrganisationId'                     => $oRow->fkiOrganisationId,
				'fkiTransactionItemIdAdhesion'          => $oRow->fkiTransactionItemIdAdhesion,
				'fkiTransactionItemIdRenouvellement'    => $oRow->fkiTransactionItemIdRenouvellement,
				'fkiTransactionItemIdComtoirRe'         => $oRow->fkiTransactionItemIdComtoirRe,
				'sSystExt'                              => $oRow->sSystExt,
				'fkJsonOrganisationUserRoleType'        => $oRow->fkJsonOrganisationUserRoleType,
				'jsonRequiresOneOfService'              => $oRow->jsonRequiresOneOfService,
				'iForceSubscriptionFirstDate'           => $oRow->iForceSubscriptionFirstDate,
				'iForceSubscriptionLastDate'            => $oRow->iForceSubscriptionLastDate,
				'iForceExpire'                          => $oRow->iForceExpire,
				'iAgeMax'                               => $oRow->iAgeMax,
				'sCode'                                 => $oRow->sCode,
				'sNom'                                  => $oRow->sNom,
				'sDescription'                          => $oRow->sDescription,
				'bHeritageRelation'                     => $oRow->bHeritageRelation,
				'sHeritageRelationExportToSystExt'      => $oRow->sHeritageRelationExportToSystExt,
				
				'bDeleted'                              => $oRow->bDeleted,
				'iCreation'                             => time(),
				'iModification'                         => time()
			]);
			
		}
		
		array_multisort(
			array_column($aData,"fkiOrganisationId"), SORT_ASC, SORT_NUMERIC,
			array_column($aData,"fkiTransactionItemIdAdhesion"), SORT_ASC, SORT_NUMERIC,
			$aData
		);
		
		//file_put_contents(__DIR__ . "/data/" . $tableName . ".json", json_encode($aData));
		
		$table->truncate();
		$table->insert($aData)->save();
		
	}
	
}
