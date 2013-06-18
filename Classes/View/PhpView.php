<?php
require_once(t3lib_extMgm::extPath('user_events') . '/Classes/View/PibaseViewInterface.php');

require_once(t3lib_extMgm::extPath('user_events') . '/Classes/Utility/PibaseMethodsProxy.php');

require_once(t3lib_extMgm::extPath('user_events') . '/Classes/Utility/GeneralUtility.php');

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

	protected $viewConf = array();

	/**
	 *
	 * @var array
	 */
	protected $templateVariables = array();

	public function __construct(tslib_pibase $plugin) {
		$this->pluginInstance = $plugin;
		$this->cObj = $this->pluginInstance->cObj;
	}

	public function setViewConf(array $conf) {
		$this->viewConf = $conf;
	}

	public function assign($templateVariableKey, $templateVariableValue) {
		$this->templateVariables[$templateVariableKey] = $templateVariableValue;
	}

	public final function render() {
		$this->assignVariables();

		extract($this->templateVariables);

		ob_start();
		ob_implicit_flush(0);

		require $this->getTemplatePath();

		// @todo: check if this works with TYPO3 output buffering; also try ob_end_flush() if problems arise
		return ob_get_clean();
	}

	protected function getTemplatePath() {
		// 'user_events_View_DetailView'
		$className = get_class($this);
		// ['user', 'events', 'View', 'EventDetailView']
		$classNameParts = explode('_', $className);
		// EventDetailView
		$classNameCanonical = array_pop($classNameParts);
		// EventDetail
		$templateUpperCamelCase = str_replace('View', '', $classNameCanonical);

		$templateUnderscored = user_events_Utility_GeneralUtility::camelCaseToLowerCaseUnderscored($templateUpperCamelCase);

		$templatePathParts = explode('_', $templateUnderscored);

		$templatePath = array();

		foreach ($templatePathParts as $templatePathPart) {
			$templatePath[] = ucfirst($templatePathPart);
		}

		$template = implode('/', $templatePath);

		$templatePath = t3lib_extMgm::extPath('user_events', '/Resources/Private/Templates/' . $template . '.php');

		return $templatePath;

	}

	final protected function makeBootstrapButtonFromLink($linkMarkup, $additionalClassesSpacePrefixed = '') {
		return str_replace('<a href=', '<a class="btn'. $additionalClassesSpacePrefixed .'" href=', $linkMarkup);
	}

	abstract public function assignVariables();
}
?>