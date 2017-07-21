<?php

use Phinx\Seed\AbstractSeed;

class AddressSeeder extends AbstractSeed
{

	CONST CANADA_COUNTRY_ID = 39;
	CONST GERMANY_COUNTRY_ID = 59;
	CONST SPAIN_COUNTRY_ID = 69;
	CONST USA_COUNTRY_ID = 239;
	CONST SWITZERLAND_COUNTRY_ID = 41;
	CONST AUSTRIA_COUNTRY_ID = 16;
    /**
     * Run Method.
     *
     * Write your database seeder using this method.
     *
     * More information on writing seeders is available here:
     * http://docs.phinx.org/en/latest/seeding.html
	 *
	 * https://github.com/astockwell/countries-and-provinces-states-regions/tree/master/countries
     */
    public function run()
    {
		$this->seedCountries();
		$this->seedRegions();
    }

    protected function seedCountries(){
		$jsonCountry = file_get_contents(__DIR__ . "/data/address/countries.json");

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

	public function seedRegions(){
    	$aRegionsList = [
    		'austria' => self::AUSTRIA_COUNTRY_ID,
			'canada' => self::CANADA_COUNTRY_ID,
			'germany' => self::GERMANY_COUNTRY_ID,
			'spain' => self::SPAIN_COUNTRY_ID,
			'states' => self::USA_COUNTRY_ID,
			'switzerland' => self::SWITZERLAND_COUNTRY_ID
		];

    	$iRegionId = 1;

    	foreach ($aRegionsList as $sRegionName => $iCountryId){
			$jsonRegion = file_get_contents(__DIR__ . "/data/address/$sRegionName-regions.json");

			$oRegions = json_decode($jsonRegion);
			$aLang = [1,2];

			$aData = [];
			$aNameData = [];

			foreach ($oRegions as $oRegion){

				$aData[] = [
					'fkiAddressCountryId' => $iCountryId,
					'sCode' => explode('-',$oRegion->code)[1],
					'sIsoCode' => $oRegion->code,
					'bDeleted' => 0,
					'iCreation' => time(),
					'iModification' => time()
				];

				$sFrenchName = $oRegion->fre;
				$sEnglishName = $oRegion->eng;

				foreach ($aLang as $iLang){

					$sName = $iLang == 1 ? $sFrenchName : $sEnglishName;

					$aNameData[] = [
						'fkiAddressRegionId' => $iRegionId,
						'fkiLanguageId' => $iLang,
						'sName' => $sName,
						'bDeleted' => 0,
						'iCreation' => time(),
						'iModification' => time()
					];
				}

				$iRegionId ++;
			}

			$oAddressRegions = $this->table('AddressRegion');
			$oAddressRegionNames = $this->table('AddressRegionName');
			$oAddressRegions->insert($aData)->save();
			$oAddressRegionNames->insert($aNameData)->save();
		}
	}
}
