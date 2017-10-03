<?php
/**
 * @author     Camille Cimbolini <camille.cimbolini@metix.ca>
 * @author     Vincent Mayer <vincent.mayer@metix.ca>
 * @copyright  B-CITI inc. <https://www.b-citi.com>
 * @creation   2017-06-27
 */

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;
use Phinx\Db\Table\Index;

class AddressMigration extends AbstractMigration{

	/**
	 * Change Method.
	 *
	 * Write your reversible migrations using this method.
	 *
	 * More information on writing migrations is available here:
	 * http://docs.phinx.org/en/latest/migrations.html#the-abstractmigration-class
	 *
	 * The following commands can be used in this method and Phinx will
	 * automatically reverse them when rolling back:
	 *
	 *    createTable
	 *    renameTable
	 *    addColumn
	 *    renameColumn
	 *    addIndex
	 *    addForeignKey
	 *
	 * Remember to call "create()" or "update()" and NOT "save()" when working
	 * with the Table class.
	 */
	public function change(){

		$this->CreateCountryTables();
		$this->CreateCountryConfigTable();
		$this->CreateRegionTables();
		$this->CreatePostalCodeTables();
		$this->CreateCityTables();
		$this->CreateCityConfigTable();
		$this->CreateStreetTables();
		$this->CreateStreetNumberTables();
		$this->CreateAddressTable();
	}

	/**
	 * @return void
	 */
	protected function CreateCountryTables(){

		$sEntityName = 'AddressCountry';
		
		echo("===> Table " . $sEntityName . ".....\n");
		
		$oTable = $this->table($sEntityName, array('signed' => false));
		$oTable->addColumn('sDefaultName', MysqlAdapter::PHINX_TYPE_STRING, array('length' => 150))
			->addColumn('sIso2Code', MysqlAdapter::PHINX_TYPE_STRING, array('length' => 2))
			->addColumn('sIso3Code', MysqlAdapter::PHINX_TYPE_STRING, array('length' => 3))
			->addColumn('iNumericCode', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('length' => 5, 'signed' => false))
			->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN, array('signed' => false, 'default' => 0))
			->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addIndex('bDeleted', array('name' => 'idx_deleted'))
			->addIndex('sIso2Code', array('unique' => true, 'name' => 'uq_iso_2_code'))
			->addIndex('sIso3Code', array('unique' => true, 'name' => 'uq_iso_3_code'))
			->addIndex('iNumericCode', array('unique' => true, 'name' => 'uq_numeric_code'))
			->create();
		echo("===> Table " . $sEntityName . " done\n");
		echo("===> Table " . $sEntityName . "Name.....\n");

		$oTableName = $this->oGetNameTable($sEntityName);
		$oTableName->create();
		echo("===> Table " . $sEntityName . "Name done\n");
	}

	/**
	 * @return void
	 */
	protected function CreateCountryConfigTable(){

		$sEntityName = 'AddressCountryConfig';

		echo("===> Table " . $sEntityName . ".....\n");

		$oTable = $this->table($sEntityName, array('signed' => false));
		$oTable->addColumn('fkiAddressCountryId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false))
			->addColumn('sPostalCodeFormat', MysqlAdapter::PHINX_TYPE_STRING,
				array('length' => MysqlAdapter::TEXT_TINY))
			->addColumn('sAddressFormat', MysqlAdapter::PHINX_TYPE_TEXT)
			->addColumn('sPhonePrefix', MysqlAdapter::PHINX_TYPE_STRING, array('length' => 10))
			->addColumn('bHasRegion', MysqlAdapter::PHINX_TYPE_BOOLEAN, array('signed' => false))
			->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN, array('signed' => false, 'default' => 0))
			->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addIndex('bDeleted', array('name' => 'idx_deleted'))
			->addIndex('fkiAddressCountryId', array('unique' => true, 'name' => 'uq_country'))
			->create();

		echo("===> Table " . $sEntityName . " done\n");
		
	}

	/**
	 * @return void
	 */
	protected function CreateRegionTables(){

		$sEntityName = 'AddressRegion';
		
		echo("===> Table " . $sEntityName . ".....\n");

		$oTable = $this->table($sEntityName, array('signed' => false));
		$oTable->addColumn('fkiAddressCountryId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false))
			->addColumn('sCode', MysqlAdapter::PHINX_TYPE_STRING, array('length' => 10))
			->addColumn('sIsoCode', MysqlAdapter::PHINX_TYPE_STRING, array('length' => 5))
			->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN, array('signed' => false, 'default' => 0))
			->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addIndex('sCode', array('name' => 'idx_code'))
			->addIndex('fkiAddressCountryId', array('name' => 'idx_address_country'))
			->addIndex('bDeleted', array('name' => 'idx_deleted'))
			->addIndex('sIsoCode', array('unique' => true, 'name' => 'uq_iso_code'))
			->create();
		
		echo("===> Table " . $sEntityName . " done\n");
		echo("===> Table " . $sEntityName . "Name.....\n");
		
		$oTableName = $this->oGetNameTable($sEntityName);
		$oTableName->create();
		echo("===> Table " . $sEntityName . "Name done\n");
	}

	/**
	 * @return void
	 */
	protected function CreatePostalCodeTables(){

		$sEntityName = 'AddressPostalCode';
		
		echo("===> Table " . $sEntityName . ".....\n");
		
		$oTable = $this->table($sEntityName, array('signed' => false));
		$oTable->addColumn('fkiAddressCountryId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false))
			->addColumn('fkiAddressCityId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER,
				array('signed' => false, 'null' => true))
			->addColumn('sPostalCode', MysqlAdapter::PHINX_TYPE_STRING, array('length' => 20))
			->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN, array('signed' => false, 'default' => 0))
			->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addIndex('fkiAddressCountryId', array('name' => 'idx_address_country'))
			->addIndex('fkiAddressCityId')
			->addIndex('sPostalCode', array('name' => 'idx_postal_code'))
			->addIndex('bDeleted', array('name' => 'idx_deleted'))
			->addIndex(array('fkiAddressCountryId', 'sPostalCode'),
				array('unique' => true, 'name' => 'uq_country_postal_code'))
			->create();

		echo("===> Table " . $sEntityName . " done\n");
	}

	/**
	 * @return void
	 */
	protected function CreateCityTables(){

		$sEntityName = 'AddressCity';
		
		echo("===> Table " . $sEntityName . ".....\n");
		
		$oTable = $this->table($sEntityName, array('signed' => false));
		$oTable->addColumn('fkiAddressCountryId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false))
			->addColumn('fkiAddressRegionId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER,
				array('signed' => false, 'null' => true, 'default' => null))
			->addColumn('sCode', MysqlAdapter::PHINX_TYPE_STRING, array('length' => 10))
			->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN, array('signed' => false, 'default' => 0))
			->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addIndex('sCode', array('name' => 'idx_code'))
			->addIndex('fkiAddressCountryId', array('name' => 'idx_address_country'))
			->addIndex('fkiAddressRegionId', array('name' => 'idx_address_region'))
			->addIndex('bDeleted', array('name' => 'idx_deleted'))
			->addIndex(array('fkiAddressCountryId', 'fkiAddressRegionId', 'sCode'),
				array('unique' => true, 'name' => 'uq_country_region_code'))
			->create();
		
		echo("===> Table " . $sEntityName . " done\n");
		echo("===> Table " . $sEntityName . "Name.....\n");
		
		$oTableName = $this->oGetNameTable($sEntityName);
		$oTableName->create();
		echo("===> Table " . $sEntityName . "Name done\n");
	}
	
	/**
	 * @return void
	 */
	protected function CreateCityConfigTable(){
		
		$sEntityName = 'AddressCityConfig';
		
		echo("===> Table " . $sEntityName . ".....\n");
		
		$oTable = $this->table($sEntityName, array('signed' => false));
		
		$oTable
			->addColumn('fkiAddressCityId',         MysqlAdapter::PHINX_TYPE_BIG_INTEGER,   array('signed' => false, 'null'    => false))
			->addColumn('bStrictAutocomplete',      MysqlAdapter::PHINX_TYPE_BOOLEAN,       array('null' => false,   'default' => false))
			->addColumn('bDeleted',                 MysqlAdapter::PHINX_TYPE_BOOLEAN,       array('signed' => false, 'default' => false))
			->addColumn('iCreation',                MysqlAdapter::PHINX_TYPE_BIG_INTEGER,   array('signed' => false, 'null'    => true))
			->addColumn('iModification',            MysqlAdapter::PHINX_TYPE_BIG_INTEGER,   array('signed' => false, 'null'    => true))
			
			->addIndex('bDeleted',          array('name' => 'idx_deleted'))
			->addIndex('fkiAddressCityId',  array('unique' => true, 'name' => 'uq_city'))
			->create();
		
		echo("===> Table " . $sEntityName . " done\n");
	}
	
	/**
	 * @return void
	 */
	protected function CreateStreetTables(){

		$sEntityName = 'AddressStreet';
		
		echo("===> Table " . $sEntityName . ".....\n");
		
		$oTable = $this->table($sEntityName, array('signed' => false));
		$oTable->addColumn('fkiAddressCityId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false))
			->addColumn('sCode', MysqlAdapter::PHINX_TYPE_STRING, array('length' => 10))
			->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN, array('signed' => false, 'default' => 0))
			->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addIndex('sCode', array('name' => 'idx_code'))
			->addIndex('fkiAddressCityId', array('name' => 'idx_address_city'))
			->addIndex('bDeleted', array('name' => 'idx_deleted'))
			->addIndex(array('fkiAddressCityId', 'sCode'),
				array('unique' => true, 'name' => 'uq_city_street_code'))
			->create();
		
		echo("===> Table " . $sEntityName . " done\n");
		echo("===> Table " . $sEntityName . "Name.....\n");
		
		$oTableName = $this->oGetNameTable($sEntityName);
		$oTableName->create();
		echo("===> Table " . $sEntityName . "Name done\n");
	}

	/**
	 * @return void
	 */
	protected function CreateAddressTable(){

		$sEntityName = 'AddressBase';
		
		echo("===> Table " . $sEntityName . ".....\n");
		
		$oTableAddress = $this->table($sEntityName, array('signed' => false));
		$oTableAddress->addColumn('fkiAddressCityId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false))
			->addColumn('fkiAddressPostalCodeId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false))
			->addColumn('fkiAddressStreetId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false))
			->addColumn('fkiAddressStreetNumberId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false))
			->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN, array('signed' => false, 'default' => 0))
			->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addIndex('fkiAddressCityId', array('name' => 'idx_address_city'))
			->addIndex('fkiAddressPostalCodeId', array('name' => 'idx_postal_code'))
			->addIndex('fkiAddressStreetId', array('name' => 'idx_address_street'))
			->addIndex('fkiAddressStreetNumberId', array('name' => 'idx_address_street_number'))
			->addIndex('bDeleted', array('name' => 'idx_deleted'))
			->create();

		echo("===> Table " . $sEntityName . " done\n");
	}

	/**
	 * @return void
	 */
	protected function CreateStreetNumberTables(){

		$sEntityName = 'AddressStreetNumber';
		
		echo("===> Table " . $sEntityName . ".....\n");
		
		$oTable = $this->table($sEntityName, array('signed' => false));
		$oTable->addColumn('fkiAddressStreetId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false))
			->addColumn('sStreetNumber', MysqlAdapter::PHINX_TYPE_STRING, array('length' => 50))
			->addColumn('dLatitude', 'decimal', array('signed' => true, 'precision' => 16, 'scale' => 13))
			->addColumn('dLongitude', 'decimal', array('signed' => true, 'precision' => 16, 'scale' => 13))
			->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN, array('signed' => false, 'default' => 0))
			->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addIndex('sStreetNumber', array('name' => 'idx_street_number'))
			->addIndex('dLatitude', array('name' => 'idx_latitude'))
			->addIndex('dLongitude', array('name' => 'idx_longitude'))
			->addIndex('fkiAddressStreetId', array('name' => 'idx_address'))
			->addIndex('bDeleted', array('name' => 'idx_deleted'))
			->addIndex(array('fkiAddressStreetId', 'sStreetNumber'),
				array('unique' => true, 'name' => 'uq_street_street_number'))
			->create();

		echo("===> Table " . $sEntityName . " done\n");
	}

	/**
	 * @param $sMainEntityName
	 *
	 * @return \Phinx\Db\Table
	 */
	protected function oGetNameTable($sMainEntityName){

		$sFkiName = 'fki' . $sMainEntityName . "Id";
		$entitySnakeCase = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $sMainEntityName));
		
		$oTable = $this->table($sMainEntityName . 'Name', array('signed' => false));
		$oTable->addColumn($sFkiName, MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false))
			->addColumn('fkiLanguageId', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false))
			->addColumn('sName', MysqlAdapter::PHINX_TYPE_STRING, array('length' => MysqlAdapter::TEXT_TINY))
			->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN, array('signed' => false, 'default' => 0))
			->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addIndex($sFkiName, array('name' => 'idx_' . $entitySnakeCase))
			->addIndex('fkiLanguageId', array('name' => 'idx_language'))
			->addIndex('bDeleted', array('name' => 'idx_deleted'))
			->addIndex(array($sFkiName, 'fkiLanguageId'),
				array('unique' => true, 'name' => 'uq_name_' . $entitySnakeCase));

		return $oTable;
	}
}
