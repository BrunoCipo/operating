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

class AddressMigration
    extends AbstractMigration
{
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
    public function change()
    {
        $this->CreateCountryTables();
        $this->CreateRegionTables();
        $this->CreatePostalCodeTables();
        $this->CreateCityTables();
        $this->CreateStreetTables();
        $this->CreateStreetNumberTables();
        $this->CreateAddressTable();
    }

    /**
     * @return void
     */
    protected function CreateCountryTables()
    {
        $sEntityName = 'AddressCountry';

        $oTableCountry = $this->table($sEntityName, array('signed' => false));
        $oTableCountry->addColumn('sDefaultName', 'string', array('length' => 150))
            ->addColumn('sIso2Code', 'string', array('length' => 2))
            ->addColumn('sIso3Code', 'string', array('length' => 3))
            ->addColumn('iNumericCode', 'biginteger', array('length' => 5, 'signed' => false))
            ->addColumn('bDeleted', 'boolean')
            ->addColumn('iCreation', 'biginteger', array('signed' => 'false', 'null' => 'true'))
            ->addColumn('iModification', 'biginteger', array('signed' => 'false', 'null' => 'true'))
            ->addIndex('bDeleted', array('name' => 'idx_deleted'))
            ->addIndex('sIso2Code', array('unique' => true, 'name' => 'uq_iso_2_code'))
            ->addIndex('sIso3Code', array('unique' => true, 'name' => 'uq_iso_3_code'))
            ->addIndex('iNumericCode', array('unique' => true, 'name' => 'uq_numeric_code'))
            ->create();

        $oTableName = $this->oGetNameTable($sEntityName);
        $oTableName->create();
    }

    /**
     * @return void
     */
    protected function CreateRegionTables()
    {
        $sEntityName = 'AddressRegion';

        $oTableCountry = $this->table($sEntityName, array('signed' => false));
        $oTableCountry->addColumn('fkiAddressCountryId', 'biginteger', array('signed' => false))
            ->addColumn('sCode', 'string', array('length' => 10))
            ->addColumn('sIsoCode', 'string', array('length' => 5))
            ->addColumn('bDeleted', 'boolean')
            ->addColumn('iCreation', 'biginteger', array('signed' => 'false', 'null' => 'true'))
            ->addColumn('iModification', 'biginteger', array('signed' => 'false', 'null' => 'true'))
            ->addIndex('sCode', array('name' => 'idx_code'))
            ->addIndex('fkiAddressCountryId', array('name' => 'idx_address_country'))
            ->addIndex('bDeleted', array('name' => 'idx_deleted'))
            ->addIndex('sIsoCode', array('unique' => true, 'name' => 'uq_iso_code'))
            ->create();

        $oTableName = $this->oGetNameTable($sEntityName);
        $oTableName->create();
    }

    /**
     * @return void
     */
    protected function CreatePostalCodeTables()
    {
        $sEntityName = 'AddressPostalCode';

        $oTableCountry = $this->table($sEntityName, array('signed' => false));
        $oTableCountry->addColumn('fkiAddressCountryId', 'biginteger', array('signed' => false))
            ->addColumn('fkiAddressCityId', 'biginteger', array('signed' => false, 'null' => 'true'))
            ->addColumn('sPostalCode', 'string', array('length' => 20))
            ->addColumn('bDeleted', 'boolean')
            ->addColumn('iCreation', 'biginteger', array('signed' => 'false', 'null' => 'true'))
            ->addColumn('iModification', 'biginteger', array('signed' => 'false', 'null' => 'true'))
            ->addIndex('fkiAddressCountryId', array('name' => 'idx_address_country'))
					  ->addIndex('fkiAddressCityId')
            ->addIndex('sPostalCode', array('name' => 'idx_postal_code'))
            ->addIndex('bDeleted', array('name' => 'idx_deleted'))
            ->addIndex(array('fkiAddressCountryId', 'sPostalCode'),
                array('unique' => true, 'name' => 'uq_country_postal_code'))
            ->create();
    }

    /**
     * @return void
     */
    protected function CreateCityTables()
    {
        $sEntityName = 'AddressCity';

        $oTableCountry = $this->table($sEntityName, array('signed' => false));
        $oTableCountry->addColumn('fkiAddressCountryId', 'biginteger', array('signed' => false))
            ->addColumn('fkiAddressRegionId', 'biginteger', array('signed' => false, 'null' => 'true'))
            ->addColumn('sCode', 'string', array('length' => 10))
            ->addColumn('bDeleted', 'boolean')
            ->addColumn('iCreation', 'biginteger', array('signed' => 'false', 'null' => 'true'))
            ->addColumn('iModification', 'biginteger', array('signed' => 'false', 'null' => 'true'))
            ->addIndex('sCode', array('name' => 'idx_code'))
            ->addIndex('fkiAddressCountryId', array('name' => 'idx_address_country'))
            ->addIndex('fkiAddressRegionId', array('name' => 'idx_address_region'))
            ->addIndex('bDeleted', array('name' => 'idx_deleted'))
            ->create();

        $oTableName = $this->oGetNameTable($sEntityName);
        $oTableName->create();
    }

    /**
     * @return void
     */
    protected function CreateStreetTables()
    {
        $sEntityName = 'AddressStreet';

        $oTableCountry = $this->table($sEntityName, array('signed' => false));
        $oTableCountry->addColumn('fkiAddressCityId', 'biginteger', array('signed' => false))
            ->addColumn('sCode', 'string', array('length' => 10))
            ->addColumn('bDeleted', 'boolean')
            ->addColumn('iCreation', 'biginteger', array('signed' => 'false', 'null' => 'true'))
            ->addColumn('iModification', 'biginteger', array('signed' => 'false', 'null' => 'true'))
            ->addIndex('sCode', array('name' => 'idx_code'))
            ->addIndex('fkiAddressCityId', array('name' => 'idx_address_city'))
            ->addIndex('bDeleted', array('name' => 'idx_deleted'))
            ->create();

        $oTableName = $this->oGetNameTable($sEntityName);
        $oTableName->create();
    }

    /**
     * @return void
     */
    protected function CreateAddressTable()
    {
        $sEntityName = 'AddressBase';

        $oTableAddress = $this->table($sEntityName, array('signed' => false));
        $oTableAddress->addColumn('fkiAddressCityId', 'biginteger', array('signed' => false))
            ->addColumn('fkiAddressPostalCodeId', 'biginteger', array('signed' => false))
            ->addColumn('fkiAddressStreetId', 'biginteger', array('signed' => false))
            ->addColumn('fkiAddressStreetNumberId', 'biginteger', array('signed' => false))
            ->addColumn('bDeleted', 'boolean')
            ->addColumn('iCreation', 'biginteger', array('signed' => 'false', 'null' => 'true'))
            ->addColumn('iModification', 'biginteger', array('signed' => 'false', 'null' => 'true'))
            ->addIndex('fkiAddressCityId', array('name' => 'idx_address_city'))
            ->addIndex('fkiAddressPostalCodeId', array('name' => 'idx_postal_code'))
            ->addIndex('fkiAddressStreetId', array('name' => 'idx_address_street'))
            ->addIndex('fkiAddressStreetNumberId', array('name' => 'idx_address_street_number'))
            ->addIndex('bDeleted', array('name' => 'idx_deleted'))
            ->create();
    }

    /**
     * @return void
     */
    protected function CreateStreetNumberTables()
    {
        $sEntityName = 'AddressStreetNumber';

        $oTableCountry = $this->table($sEntityName, array('signed' => false));
        $oTableCountry->addColumn('fkiAddressStreetId', 'biginteger', array('signed' => false))
            ->addColumn('sStreetNumber', 'string', array('length' => 50))
            ->addColumn('dLatitude', 'decimal', array('signed' => 'true', 'precision' => 16, 'scale' => 13))
            ->addColumn('dLongitude', 'decimal', array('signed' => 'true', 'precision' => 16, 'scale' => 13))
            ->addColumn('bDeleted', 'boolean')
            ->addColumn('iCreation', 'biginteger', array('signed' => 'false', 'null' => 'true'))
            ->addColumn('iModification', 'biginteger', array('signed' => 'false', 'null' => 'true'))
            ->addIndex('sStreetNumber', array('name' => 'idx_street_number'))
            ->addIndex('dLatitude', array('name' => 'idx_latitude'))
            ->addIndex('dLongitude', array('name' => 'idx_longitude'))
            ->addIndex('fkiAddressStreetId', array('name' => 'idx_address'))
            ->addIndex('bDeleted', array('name' => 'idx_deleted'))
            ->addIndex(array('fkiAddressStreetId', 'sStreetNumber'),
                array('unique' => true, 'name' => 'uq_street_street_number'))
            ->create();
    }

    /**
     * @param $sMainEntityName
     *
     * @return \Phinx\Db\Table
     */
    protected function oGetNameTable($sMainEntityName)
    {
        $sFkiName        = 'fki' . $sMainEntityName . "Id";
        $entitySnakeCase = strtolower(preg_replace('/(?<!^)[A-Z]/', '_$0', $sMainEntityName));

        $oTableName = $this->table($sMainEntityName . 'Name', array('signed' => false));
        $oTableName->addColumn($sFkiName, 'biginteger', array('signed' => false))
            ->addColumn('fkiLanguageId', 'biginteger', array('signed' => false))
            ->addColumn('sName', 'string', array('length' => MysqlAdapter::TEXT_SMALL))
            ->addColumn('bDeleted', 'boolean')
            ->addColumn('iCreation', 'biginteger', array('signed' => 'false', 'null' => 'true'))
            ->addColumn('iModification', 'biginteger', array('signed' => 'false', 'null' => 'true'))
            ->addIndex($sFkiName, array('name' => 'idx_' . $entitySnakeCase),  ['type' => Index::FULLTEXT])
            ->addIndex('fkiLanguageId', array('name' => 'idx_language'))
            ->addIndex('bDeleted', array('name' => 'idx_deleted'))
            ->addIndex(array($sFkiName, 'fkiLanguageId'),
                array('unique' => true, 'name' => 'uq_name_' . $entitySnakeCase));

        return $oTableName;
    }
}
