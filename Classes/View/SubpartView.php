<?php
require_once(t3lib_extMgm::extPath('user_events') . '/Classes/View/PibaseViewInterface.php');

require_once(t3lib_extMgm::extPath('user_events') . '/Classes/Utility/PibaseMethodsProxy.php');

abstract class user_events_View_SubpartView extends user_events_Utility_PibaseMethodsProxy implements user_events_View_PibaseViewInterface {

	protected $subpart = '';

	/**
	 *
	 * @var tslib_pibase
	 */
	protected $pluginInstance;

	/**
	 *
	 * @var tslib_cObj
	 */
	protected $cObj;

	/**
	 *
	 * @var user_events_View_ViewManagerInterface
	 */
	protected $viewManager = NULL;

	protected $viewConf = array();

	public function __construct(tslib_pibase $plugin, user_events_View_ViewManagerInterface $viewManager) {
		$this->pluginInstance = $plugin;
		$this->cObj = $this->pluginInstance->cObj;
		$this->viewManager = $viewManager;
	}

	final public function setViewConf(array $conf) {
		$this->viewConf = $conf;
	}
}
?>
