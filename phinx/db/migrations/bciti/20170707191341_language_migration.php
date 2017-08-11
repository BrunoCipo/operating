<?php
/**
 * @author     Camille Cimbolini <camille.cimbolini@metix.ca>
 * @copyright  B-CITI inc. <https://www.b-citi.com>
 * @creation   2017-06-27
 */

use Phinx\Migration\AbstractMigration;
use Phinx\Db\Adapter\MysqlAdapter;

/**
 * Class LanguageMigration
 */
class LanguageMigration extends AbstractMigration{

	private $LanguageTableName = 'Language';

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
	public function up(){

		$oTable = $this->table($this->LanguageTableName, array('signed' => false));
		$oTable->addColumn('sName', MysqlAdapter::PHINX_TYPE_STRING, array('length' => 150))
			->addColumn('sCode', MysqlAdapter::PHINX_TYPE_STRING, array('length' => 5))
			->addColumn('sLocale', MysqlAdapter::PHINX_TYPE_STRING, array('length' => 5))
			->addColumn('sIso2Code', MysqlAdapter::PHINX_TYPE_STRING, array('length' => 2))
			->addColumn('sIso3Code', MysqlAdapter::PHINX_TYPE_STRING, array('length' => 3))
			->addColumn('bDeleted', MysqlAdapter::PHINX_TYPE_BOOLEAN)
			->addColumn('iCreation', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addColumn('iModification', MysqlAdapter::PHINX_TYPE_BIG_INTEGER, array('signed' => false, 'null' => true))
			->addIndex('bDeleted', array('name' => 'idx_deleted'))
			->addIndex('sCode', array('unique' => true, 'name' => 'uq_code'))
			->addIndex('sLocale', array('unique' => true, 'name' => 'uq_locale'))
			->create();

		$this->insert($oTable, $this->aGetLanguageConfigs());
	}

	public function down(){

		$this->dropTable('Language');
	}

	/**
	 * @return array
	 */
	protected function aGetLanguageConfigs(){

		return array(
			array(
				'sName'     => 'Français',
				'sCode'     => 'fre',
				'sLocale'   => 'fr_CA',
				'sIso2code' => 'fr',
				'sIso3code' => 'fra'
			),
			array(
				'sName'     => 'English',
				'sCode'     => 'eng',
				'sLocale'   => 'en_CA',
				'sIso2code' => 'en',
				'sIso3code' => 'eng'
			)
		);
	}
}
