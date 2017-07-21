<?php

use Phinx\Seed\AbstractSeed;

class AddressCountrySeeder extends AbstractSeed
{
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
     */
    public function run()
    {

    	$jsonCountry = file_get_contents(__DIR__."/countries.json");

    	$oCountries = json_decode($jsonCountry);
    	$aLang = [1,2];

    	$aData = [];
    	$aNameData = [];

    	foreach ($oCountries as $key => $oCountry){

    		$iCountryId = $key + 1;
			$aData[] = [
				'sDefaultName' => $oCountry->name->common,
				'sIso2Code' => $oCountry->cca2,
				'sIso3Code' => $oCountry->cca3,
				'iNumericCode' => $oCountry->ccn3,
				'bDeleted' => 0,
				'iCreation' => time(),
				'iModification' => time()
			];

			$sFrenchName = $oCountry->translations->fra->common;
			$sEnglishName = $oCountry->name->common;

			foreach ($aLang as $iLang){

				$sName = $iLang == 1 ? $sFrenchName : $sEnglishName;
				$aNameData[] = [
					'fkiAddressCountryId' => $iCountryId,
					'fkiLanguageId' => $iLang,
					'sName' => $sName,
					'bDeleted' => 0,
					'iCreation' => time(),
					'iModification' => time()
				];
			}
		}

		$oAddressCountries = $this->table('AddressCountry');
		$oAddressCountryNames = $this->table('AddressCountryName');
		$oAddressCountries->insert($aData)->save();
		$oAddressCountryNames->insert($aNameData)->save();
    }
}
