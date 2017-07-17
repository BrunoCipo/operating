<?php
/**
 * @author     Camille Cimbolini <camille.cimbolini@metix.ca>
 * @copyright  B-CITI inc. <https://www.b-citi.com>
 * @creation   2017-06-27
 */

use Phinx\Migration\AbstractMigration;

/**
 * Class LanguageMigration
 */
class LanguageMigration
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
        $oTable = $this->table('Language', array('signed' => false));
        $oTable->addColumn('sName', 'string', array('length' => 150))
            ->addColumn('sCode', 'string', array('length' => 5))
            ->addColumn('sLocale', 'string', array('length' => 5))
            ->addColumn('sIso2Code', 'string', array('length' => 2))
            ->addColumn('sIso3Code', 'string', array('length' => 3))
            ->addColumn('bDeleted', 'boolean')
            ->addColumn('iCreation', 'integer', array('signed' => 'false', 'null' => 'true'))
            ->addColumn('iModification', 'integer', array('signed' => 'false', 'null' => 'true'))
            ->addIndex('bDeleted')
            ->addIndex('sCode', array('unique' => true))
            ->addIndex('sLocale', array('unique' => true))
            ->create();

        $this->insert($oTable, $this->aGetLanguageConfigs());
    }

    /**
     * @return array
     */
    protected function aGetLanguageConfigs()
    {
        return array(
            array('sName' => 'Français', 'sCode' => 'fre', 'sLocale' => 'fr_CA', 'sIso2code' => 'fr', 'sIso3code' => 'fra'),
            array('sName' => 'English', 'sCode' => 'eng', 'sLocale' => 'en_CA', 'sIso2code' => 'en', 'sIso3code' => 'eng')
        );
    }
}
