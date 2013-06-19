<?php
require_once t3lib_extMgm::extPath('user_events', 'Classes/Core/ViewHelper/PibaseViewHelperInterface.php');
require_once t3lib_extMgm::extPath('user_events', 'Classes/Utility/PibaseMethodsProxy.php');

class user_events_ViewHelpers_EventViewHelper extends user_events_Utility_PibaseMethodsProxy implements user_events_Core_ViewHelper_PibaseViewHelperInterface {

	/**
	 *
	 * @var tslib_pibase
	 */
	protected $pluginInstance = NULL;

	/**
	 *
	 * @var tslib_content
	 */
	protected $cObj = NULL;

	public function __construct(tslib_pibase $plugin, tslib_cObj $cObj) {
		$this->pluginInstance = $plugin;
		$this->cObj = $cObj;
	}

	public function renderDetailViewLink($uid, $linktext = '', $stdWrap = array()) {
		if ('' === $linktext) {
			$linktext = $this->stdWrap(
				$this->getLL('list.more_link_text', 'view details'),
				$stdWrap
			);
		}

		return $this->list_linkSingle(
			$linktext,
			$uid,
			TRUE,
			array(),
			FALSE,
			0
		);
	}

	public function renderDetailViewButton($uid, $additionalClassesSpacePrefixed = '', $linktext = '') {
		$link = $this->renderDetailViewLink($uid, $linktext);

		return $this->renderBootstrapButtonFromLink($link, $additionalClassesSpacePrefixed);
	}

	public function renderBootstrapButtonFromLink($linkMarkup, $additionalClassesSpacePrefixed = '') {
		return str_replace('<a href=', '<a class="btn'. $additionalClassesSpacePrefixed .'" href=', $linkMarkup);
	}
}
?>