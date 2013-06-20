<?php
require_once t3lib_extMgm::extPath('user_events', '/Classes/Core/View/PibaseViewInterface.php');
require_once t3lib_extMgm::extPath('user_events', '/Classes/Utility/PibaseMethodsProxy.php');
require_once t3lib_extMgm::extPath('user_events', '/Classes/Utility/GeneralUtility.php');

abstract class user_events_Core_View_PhpView extends user_events_Utility_PibaseMethodsProxy implements user_events_Core_View_PibaseViewInterface {

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

	/**
	 *
	 * @var string
	 */
	protected $templatePathTemplate = 'Resources/Private/Templates/%template%.php';

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
		$templatePathSuffix = $this->getTemplatePathSuffix();

		$templatePath = t3lib_extMgm::extPath('user_events', $templatePathSuffix);

		return $templatePath;
	}

	protected function getTemplatePathSuffix() {
		$template = $this->getTemplateByViewInstanceName();

		$templatePathSuffix = strtr($this->templatePathTemplate, array(
			'%template%' => $template
		));

		return $templatePathSuffix;
	}

	protected function getTemplateByViewInstanceName() {
		$classNameCanonical = $this->getViewInstanceCanonicalName();

		// EventDetail
		$templateUpperCamelCase = str_replace('View', '', $classNameCanonical);
		// event_detail
		$templateUnderscored = user_events_Utility_GeneralUtility::camelCaseToLowerCaseUnderscored($templateUpperCamelCase);
		// ['event', 'detail']
		$templatePathParts = explode('_', $templateUnderscored);
		// 'Event/Detail'
		$template = implode('/', array_map('ucfirst', $templatePathParts));

		return $template;
	}

	protected function getViewInstanceCanonicalName() {
		// 'user_events_View_DetailView'
		$className = get_class($this);
		// ['user', 'events', 'View', 'EventDetailView']
		$classNameParts = explode('_', $className);
		// EventDetailView
		$classNameCanonical = array_pop($classNameParts);

		return $classNameCanonical;

	}

	abstract public function assignVariables();
}
?>