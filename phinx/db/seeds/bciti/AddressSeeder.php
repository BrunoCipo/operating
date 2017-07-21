<?php

use Phinx\Seed\AbstractSeed;

class AddressSeeder extends AbstractSeed {

	CONST CANADA_COUNTRY_ID = 39;
	CONST GERMANY_COUNTRY_ID = 59;
	CONST SPAIN_COUNTRY_ID = 69;
	CONST USA_COUNTRY_ID = 239;
	CONST SWITZERLAND_COUNTRY_ID = 41;
	CONST AUSTRIA_COUNTRY_ID = 16;

	CONST TOTAL_COUNTRY_COUNT = 248;
	CONST TOTAL_REGION_COUNT = 190;

	public static $COUNTRY_WITH_REGION_ID_LIST = [39, 59, 69, 239, 41, 16];
	public static $AUSTRIA_REGION_ID_RANGE = [1, 9];
	public static $CANADA_REGION_ID_RANGE = [10, 22];
	public static $GERMANY_REGION_ID_RANGE = [23, 38];
	public static $SPAIN_REGION_ID_RANGE = [39, 107];
	public static $USA_REGION_ID_RANGE = [108, 164];
	public static $SWITZERLAND_REGION_ID_RANGE = [165, 190];


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
	public function run(){

		$this->seedCountries();
		$this->seedRegions();
		$this->seedCities();

	}

	protected function seedCountries(){
		$jsonCountry = file_get_contents(__DIR__ . "/data/address/countries.json");

		$oCountries = json_decode($jsonCountry);
		$aLang = [1, 2];

		$aData = [];
		$aNameData = [];

		foreach ($oCountries as $key => $oCountry) {

			$iCountryId = $key + 1;
			$aData[] = [
				'sDefaultName'  => $oCountry->name->common,
				'sIso2Code'     => $oCountry->cca2,
				'sIso3Code'     => $oCountry->cca3,
				'iNumericCode'  => $oCountry->ccn3,
				'bDeleted'      => 0,
				'iCreation'     => time(),
				'iModification' => time()
			];

			$sFrenchName = $oCountry->translations->fra->common;
			$sEnglishName = $oCountry->name->common;

			foreach ($aLang as $iLang) {

				$sName = $iLang == 1 ? $sFrenchName : $sEnglishName;
				$aNameData[] = [
					'fkiAddressCountryId' => $iCountryId,
					'fkiLanguageId'       => $iLang,
					'sName'               => $sName,
					'bDeleted'            => 0,
					'iCreation'           => time(),
					'iModification'       => time()
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
			'austria'     => self::AUSTRIA_COUNTRY_ID,
			'canada'      => self::CANADA_COUNTRY_ID,
			'germany'     => self::GERMANY_COUNTRY_ID,
			'spain'       => self::SPAIN_COUNTRY_ID,
			'states'      => self::USA_COUNTRY_ID,
			'switzerland' => self::SWITZERLAND_COUNTRY_ID
		];

		$iRegionId = 1;

		foreach ($aRegionsList as $sRegionName => $iCountryId) {
			$jsonRegion = file_get_contents(__DIR__ . "/data/address/$sRegionName-regions.json");

			$oRegions = json_decode($jsonRegion);
			$aLang = [1, 2];

			$aData = [];
			$aNameData = [];

			foreach ($oRegions as $oRegion) {

				$aData[] = [
					'fkiAddressCountryId' => $iCountryId,
					'sCode'               => explode('-', $oRegion->code)[1],
					'sIsoCode'            => $oRegion->code,
					'bDeleted'            => 0,
					'iCreation'           => time(),
					'iModification'       => time()
				];

				$sFrenchName = $oRegion->fre;
				$sEnglishName = $oRegion->eng;

				foreach ($aLang as $iLang) {

					$sName = $iLang == 1 ? $sFrenchName : $sEnglishName;

					$aNameData[] = [
						'fkiAddressRegionId' => $iRegionId,
						'fkiLanguageId'      => $iLang,
						'sName'              => $sName,
						'bDeleted'           => 0,
						'iCreation'          => time(),
						'iModification'      => time()
					];
				}

				$iRegionId++;
			}

			$oAddressRegions = $this->table('AddressRegion');
			$oAddressRegionNames = $this->table('AddressRegionName');
			$oAddressRegions->insert($aData)->save();
			$oAddressRegionNames->insert($aNameData)->save();
		}
	}

	private function aGetCountryRegionIdRange($iCountryId){
		switch ($iCountryId) {
			case self::CANADA_COUNTRY_ID:
				return self::$CANADA_REGION_ID_RANGE;
			case self::USA_COUNTRY_ID:
				return self::$USA_REGION_ID_RANGE;
			case self::GERMANY_COUNTRY_ID:
				return self::$GERMANY_REGION_ID_RANGE;
			case self::SPAIN_COUNTRY_ID:
				return self::$SPAIN_REGION_ID_RANGE;
			case self::AUSTRIA_COUNTRY_ID:
				return self::$AUSTRIA_REGION_ID_RANGE;
			case self::SWITZERLAND_COUNTRY_ID:
				return self::$SWITZERLAND_REGION_ID_RANGE;
		}
	}

	public function seedCities(){

		$oFaker = Faker\Factory::create();

		$aCityData = [];
		$aCityNameData = [];
		$aLang = [1, 2];

		$iCityId = 1;

		foreach (range(1, self::TOTAL_COUNTRY_COUNT) as $iCountryId) {

			if (!in_array($iCountryId, self::$COUNTRY_WITH_REGION_ID_LIST)) {
				for ($i = 0; $i < 10; $i++) {
					$aCityData[] = [
						'fkiAddressCountryId' => $iCountryId,
						'fkiAddressRegionId'  => null,
						'sCode'               => $oFaker->randomLetter . $oFaker->randomNumber(5),
						'bDeleted'            => 0,
						'iCreation'           => time(),
						'iModification'       => time()
					];

					foreach ($aLang as $iLang) {

						$sName = $oFaker->city;
						$aCityNameData[] = [
							'fkiAddressCityId' => $iCityId,
							'fkiLanguageId'    => $iLang,
							'sName'            => $sName,
							'bDeleted'         => 0,
							'iCreation'        => time(),
							'iModification'    => time()
						];
					}
					$iCityId++;
				}
			} else {
				$aRegionIdRange = $this->aGetCountryRegionIdRange($iCountryId);
				foreach (range($aRegionIdRange[0], $aRegionIdRange[1]) as $iRegionId) {
					for ($i = 0; $i < 10; $i++) {

						$aCityData[] = [
							'fkiAddressCountryId' => $iCountryId,
							'fkiAddressRegionId'  => $iRegionId,
							'sCode'               => $oFaker->randomLetter . $oFaker->randomNumber(5),
							'bDeleted'            => 0,
							'iCreation'           => time(),
							'iModification'       => time()
						];

						foreach ($aLang as $iLang) {

							$sName = $oFaker->city;
							$aCityNameData[] = [
								'fkiAddressCityId' => $iCityId,
								'fkiLanguageId'    => $iLang,
								'sName'            => $sName,
								'bDeleted'         => 0,
								'iCreation'        => time(),
								'iModification'    => time()
							];
						}
						$iCityId++;
					}
				}
			}
		}
		$oAddressRegions = $this->table('AddressCity');
		$oAddressRegionNames = $this->table('AddressCityName');
		$oAddressRegions->insert($aCityData)->save();
		$oAddressRegionNames->insert($aCityNameData)->save();
	}
}
