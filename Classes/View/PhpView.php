<?php
require_once(t3lib_extMgm::extPath('user_events') . '/Classes/View/PibaseViewInterface.php');

require_once(t3lib_extMgm::extPath('user_events') . '/Classes/Utility/PibaseMethodsProxy.php');

abstract class user_events_View_PhpView extends user_events_Utility_PibaseMethodsProxy implements user_events_View_PibaseViewInterface {

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

	/**
	 *
	 * @var array
	 */
	protected $templateVariables = array();

	public function __construct(tslib_pibase $plugin, user_events_View_ViewManagerInterface $viewManager) {
		$this->pluginInstance = $plugin;
		$this->cObj = $this->pluginInstance->cObj;
		$this->viewManager = $viewManager;

		$this->assignVariables();
	}

	public function setViewConf(array $conf) {
		$this->viewConf = $conf;
	}

	public function assign($templateVariableKey, $templateVariableValue) {
		$this->templateVariables[$templateVariableKey] = $templateVariableValue;
	}

	public final function render() {
		extract($this->templateVariables);

		ob_start();
		ob_implicit_flush(0);

		require $this->getTemplatePath();

		// @todo: check if this works with TYPO3 output buffering; also try ob_end_flush() if problems arise
		return ob_end_clean();
	}

	protected function getTemplatePath() {
		// 'user_events_View_DetailView'
		$className = get_class($this);
		// ['user', 'events', 'View', 'EventDetailView']
		$classNameParts = explode('_', $classNameParts);
		// EventDetailView
		$classNameCanonical = array_pop($classNameParts);
		// EventDetail
		$template = str_replace('View', '', $classNameCanonical);

		$templatePath = t3lib_extMgm::extPath('user_events', '/Resources/Private/Templates/' . $template '.php')

		return $templatePath;
		
	}

	abstract public function assignVariables();
}
?>