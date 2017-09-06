<?php

use Phinx\Migration\AbstractMigration;

class VignetteDemandeMigration extends AbstractMigration
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
    public function change(){

    	$this->vCreateVignetteDemande();
    	$this->vCreateVignetteDemandeVehicule();
    }
	
	private function vCreateVignetteDemande(){
		
		$this->table('VignetteDemande', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                   'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiOrganisationId',                'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiUserId',                        'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiUserAdresseId',                 'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiTransactionId',                 'biginteger',   [ 'null'    => true  ] )
			->addColumn('iVignetteDemandeStatutType',       'biginteger',   [ 'null'    => true  ] )
			->addColumn('iVignetteDemandeRaisonRefusType',  'biginteger',   [ 'null'    => true  ] )
			->addColumn('iNbEspaceResidence',               'biginteger',   [ 'null'    => true  ] )
			->addColumn('iNbVignetteDemande',               'biginteger',   [ 'null'    => true  ] )
			->addColumn('iAnneeReference',                  'biginteger',   [ 'null'    => true  ] )
			->addColumn('iDateSoumission',                  'biginteger',   [ 'null'    => true  ] )
			->addColumn('bTitulaireAnneePrec',              'integer',      [ 'null'    => false ] )
			->addColumn('sNotes',                           'string',       [ 'null'    => false,   'length' => 1073741823 ] )
			
			->addColumn('bDeleted',             'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',        'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'bDeleted' ] )
			->addIndex(     'fkiUserAdresseId',             [ 'name' => 'idx_adresse' ] )
			->addIndex(     'fkiOrganisationId',            [ 'name' => 'idx_organisation' ] )
			->addIndex(     'fkiTransactionId',             [ 'name' => 'idx_transaction' ] )
			
			->create();
	}
	
	private function vCreateVignetteDemandeVehicule(){
		
		$this->table('VignetteDemandeVehicule', [ 'id'=> false, 'primary_key' => [ 'id' ] ] )
			->addColumn('id',                   'biginteger',   [ 'identity'  => true ] )
			
			->addColumn('fkiVignetteDemandeId',             'biginteger',   [ 'null'    => true  ] )
			->addColumn('fkiFichierId',                     'biginteger',   [ 'null'    => true  ] )
			->addColumn('sNumeroImmatriculation',           'string',       [ 'null'    => false,   'length' => 255 ] )
			->addColumn('sNomProprietaire',                 'string',       [ 'null'    => false,   'length' => 1073741823 ] )
			
			->addColumn('bDeleted',             'integer',      [ 'null'    => false,   'default' => 0  ] )
			->addColumn('iCreation',            'biginteger',   [ 'null'    => true  ] )
			->addColumn('iModification',        'biginteger',   [ 'null'    => true  ] )
			
			->addIndex(     'bDeleted',                     [ 'name' => 'bDeleted' ] )
			->addIndex(     'fkiVignetteDemandeId',         [ 'name' => 'idx_vignettedemande' ] )
			
			->create();
	}
}
