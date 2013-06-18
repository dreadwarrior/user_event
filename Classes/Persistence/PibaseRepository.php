<?php

require_once t3lib_extMgm::extPath('user_events') . '/Classes/Persistence/RepositoryInterface.php';

require_once t3lib_extMgm::extPath('user_events') . '/Classes/Utility/PibaseMethodsProxy.php';

abstract class user_events_Persistence_PibaseRepository extends user_events_Utility_PibaseMethodsProxy implements user_events_Persistence_RepositoryInterface {

	/**
	 *
	 * @var tslib_pibase
	 */
	protected $pluginInstance = NULL;

	/**
	 *
	 * @var tslib_fe
	 */
	protected $frontend = NULL;

	/**
	 *
	 * @var t3lib_DB
	 */
	protected $database = NULL;

	final public function __construct(tslib_pibase $plugin) {
		$this->pluginInstance = $plugin;
	
		$this->frontend = $GLOBALS['TSFE'];
	
		$this->database = $GLOBALS['TYPO3_DB'];
	}

	abstract protected function setPluginInternalConfigurationArray();

	abstract protected function hydrate($resultRessource);
}
?>