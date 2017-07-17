<?php
/**
 * @author     Camille Cimbolini <camille.cimbolini@metix.ca>
 * @author     Vincent Mayer <vincent.mayer@metix.ca>
 * @copyright  B-CITI inc. <https://www.b-citi.com>
 * @creation   2017-06-27
 */

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

class AddressMigration extends AbstractMigration {
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
		$this->CreateRegionTables();
		$this->CreatePostalCodeTables();
		$this->CreateCityTables();
		$this->CreateStreetTables();
		$this->CreateStreetGenericTables();
		$this->CreateStreetCodeLinkTables();
		$this->CreateStreetNumberTables();
		$this->CreateAddressTable();
	}

	/**
	 * @return void
	 */
	protected function CreateAddressTable(){
		$sEntityName = 'Address';

		$oTableAddress = $this->table($sEntityName, array('signed' => false));
		$oTableAddress->addColumn('fkiIdAddressCity', 'integer', array('signed' => false))
					  ->addColumn('fkiIdAddressPostalCode', 'integer', array('signed' => false))
					  ->addColumn('fkiIdAddressStreet', 'integer', array('signed' => false))
					  ->addColumn('fkiIdAddressStreetNumber', 'integer', array('signed' => false))
					  ->addColumn('bDeleted', 'boolean')
					  ->addColumn('iDateCreation', 'integer', array('signed' => 'false', 'null' => 'true'))
					  ->addColumn('iDateModification', 'integer', array('signed' => 'false', 'null' => 'true'))
					  ->addIndex('bDeleted')
					  ->addIndex('fkiIdAddressCity')
					  ->addIndex('fkiIdAddressPostalCode')
					  ->addIndex('fkiIdAddressStreet')
					  ->addIndex('fkiIdAddressStreetNumber')
					  ->create();
	}

	/**
	 * @return void
	 */
	protected function CreateCountryTables(){
		$sEntityName = 'AddressCountry';

		$oTableCountry = $this->table($sEntityName, array('signed' => false));
		$oTableCountry->addColumn('sDefaultName', 'string', array('length' => 150))
					  ->addColumn('sIso2Code', 'string', array('length' => 2))
					  ->addColumn('sIso3Code', 'string', array('length' => 3))
					  ->addColumn('iNumericCode', 'integer', array('length' => 5, 'signed' => false))
					  ->addColumn('bDeleted', 'boolean')
					  ->addColumn('iDateCreation', 'integer', array('signed' => 'false', 'null' => 'true'))
					  ->addColumn('iDateModification', 'integer', array('signed' => 'false', 'null' => 'true'))
					  ->addIndex('bDeleted')
					  ->addIndex('sIso2Code', array('unique' => true))
					  ->addIndex('sIso3Code', array('unique' => true))
					  ->addIndex('iNumericCode', array('unique' => true, 'name' => 'unique_address_country_language'))
					  ->create();

		$oTableName = $this->oGetNameTable($sEntityName);
		$oTableName->create();
	}

	/**
	 * @return void
	 */
	protected function CreateRegionTables(){
		$sEntityName = 'AddressRegion';

		$oTableCountry = $this->table($sEntityName, array('signed' => false));
		$oTableCountry->addColumn('fkiIdAddressCountry', 'integer', array('signed' => false))
					  ->addColumn('sCode', 'string', array('length' => 10))
					  ->addColumn('sIsoCode', 'string', array('length' => 5))
					  ->addColumn('sDetaultName', 'string', array('length' => 255))
					  ->addColumn('bDeleted', 'boolean')
					  ->addColumn('iDateCreation', 'integer', array('signed' => 'false', 'null' => 'true'))
					  ->addColumn('iDateModification', 'integer', array('signed' => 'false', 'null' => 'true'))
					  ->addIndex('sCode')
					  ->addIndex('fkiIdAddressCountry')
					  ->addIndex('bDeleted')
					  ->addIndex('sIsoCode', array('unique' => true))
					  ->create();

		$oTableName = $this->oGetNameTable($sEntityName);
		$oTableName->create();
	}

	/**
	 * @return void
	 */
	protected function CreatePostalCodeTables(){
		$sEntityName = 'AddressPostalCode';

		$oTableCountry = $this->table($sEntityName, array('signed' => false));
		$oTableCountry->addColumn('fkiIdAddressCountry', 'integer', array('signed' => false))
					  ->addColumn('sZoneCode', 'string', array('length' => 10))
					  ->addColumn('sPostalCode', 'string', array('length' => 20))
					  ->addColumn('bDeleted', 'boolean')
					  ->addColumn('iDateCreation', 'integer', array('signed' => 'false', 'null' => 'true'))
					  ->addColumn('iDateModification', 'integer', array('signed' => 'false', 'null' => 'true'))
					  ->addIndex('fkiIdAddressCountry')
					  ->addIndex('sZoneCode')
					  ->addIndex('sPostalCode')
					  ->addIndex('bDeleted')
					  ->addIndex(array('fkiIdAddressCountry', 'sPostalCode'), array('unique' => true))
					  ->create();
	}

	/**
	 * @return void
	 */
	protected function CreateCityTables(){
		$sEntityName = 'AddressCity';

		$oTableCountry = $this->table($sEntityName, array('signed' => false));
		$oTableCountry->addColumn('fkiIdAddressCountry', 'integer', array('signed' => false))
					  ->addColumn('fkiIdAddressRegion', 'integer', array('signed' => false))
					  ->addColumn('sCode', 'string', array('length' => 10))
					  ->addColumn('bDeleted', 'boolean')
					  ->addColumn('iDateCreation', 'integer', array('signed' => 'false', 'null' => 'true'))
					  ->addColumn('iDateModification', 'integer', array('signed' => 'false', 'null' => 'true'))
					  ->addIndex('sCode')
					  ->addIndex('fkiIdAddressCountry')
					  ->addIndex('fkiIdAddressRegion')
					  ->addIndex('bDeleted')
					  ->create();

		$oTableName = $this->oGetNameTable($sEntityName);
		$oTableName->create();
	}

	/**
	 * @return void
	 */
	protected function CreateStreetTables(){
		$sEntityName = 'AddressStreet';

		$oTableCountry = $this->table($sEntityName, array('signed' => false));
		$oTableCountry->addColumn('fkiIdAddressCity', 'integer', array('signed' => false))
					  ->addColumn('sName', 'string', array('length' => 255))
					  ->addColumn('sCode', 'string', array('length' => 10))
					  ->addColumn('bDeleted', 'boolean')
					  ->addColumn('iDateCreation', 'integer', array('signed' => 'false', 'null' => 'true'))
					  ->addColumn('iDateModification', 'integer', array('signed' => 'false', 'null' => 'true'))
					  ->addIndex('sCode')
					  ->addIndex('fkiIdAddressCity')
					  ->addIndex('bDeleted')
					  ->create();
	}

	/**
	 * @return void
	 */
	protected function CreateStreetGenericTables(){
		$sEntityName = 'AddressStreetGeneric';

		$oTableCountry = $this->table($sEntityName, array('signed' => false));
		$oTableCountry->addColumn('fkiIdAddressStreet', 'integer', array('signed' => false))
					  ->addColumn('sCode', 'string', array('length' => 10))
					  ->addColumn('bDeleted', 'boolean')
					  ->addColumn('iDateCreation', 'integer', array('signed' => 'false', 'null' => 'true'))
					  ->addColumn('iDateModification', 'integer', array('signed' => 'false', 'null' => 'true'))
					  ->addIndex('bDeleted')
					  ->addIndex('sCode')
					  ->addIndex('fkiIdAddressStreet')
					  ->create();

		$oTableName = $this->oGetNameTable($sEntityName);
		$oTableName->create();
	}

	/**
	 * @return void
	 */
	protected function CreateStreetCodeLinkTables(){
		$sEntityName = 'AddressStreetGenericCodeLink';

		$oTableCountry = $this->table($sEntityName, array('signed' => false));
		$oTableCountry->addColumn('fkiIdAddressStreet', 'integer', array('signed' => false))
					  ->addColumn('sCode', 'string', array('length' => 10))
					  ->addColumn('bDeleted', 'boolean')
					  ->addColumn('iDateCreation', 'integer', array('signed' => 'false', 'null' => 'true'))
					  ->addColumn('iDateModification', 'integer', array('signed' => 'false', 'null' => 'true'))
					  ->addIndex('bDeleted')
					  ->addIndex('sCode')
					  ->addIndex('fkiIdAddressStreet')
					  ->create();

		$oTableName = $this->oGetNameTable($sEntityName);
		$oTableName->create();
	}

	/**
	 * @return void
	 */
	protected function CreateStreetNumberTables(){
		$sEntityName = 'AddressStreetNumber';

		$oTableCountry = $this->table($sEntityName, array('signed' => false));
		$oTableCountry->addColumn('fkiIdAddress', 'integer', array('signed' => false))
					  ->addColumn('sStreetNumber', 'string', array('length' => 50))
					  ->addColumn('bDeleted', 'boolean')
					  ->addColumn('iDateCreation', 'integer', array('signed' => 'false', 'null' => 'true'))
					  ->addColumn('iDateModification', 'integer', array('signed' => 'false', 'null' => 'true'))
					  ->addIndex('bDeleted')
					  ->addIndex('sStreetNumber')
					  ->addIndex('fkiIdAddress')
					  ->create();
	}

	/**
	 * @param $sMainEntityName
	 *
	 * @return \Phinx\Db\Table
	 */
	protected function oGetNameTable($sMainEntityName){
		$sFkiName = 'fkiId' . $sMainEntityName;
		$oTableName = $this->table($sMainEntityName . 'Name', array('signed' => false));
		$oTableName->addColumn($sFkiName, 'integer', array('signed' => false))
				   ->addColumn('fkiIdLanguage', 'integer', array('signed' => false))
				   ->addColumn('sName', 'string', array('length' => MysqlAdapter::TEXT_SMALL))
				   ->addColumn('bDeleted', 'boolean')
				   ->addColumn('iDateCreation', 'integer', array('signed' => 'false', 'null' => 'true'))
				   ->addColumn('iDateModification', 'integer', array('signed' => 'false', 'null' => 'true'))
				   ->addIndex($sFkiName)
				   ->addIndex('fkiIdLanguage')
				   ->addIndex('bDeleted')
				   ->addIndex(array($sFkiName, 'fkiIdLanguage'), array('unique' => true));

		return $oTableName;
	}
}
