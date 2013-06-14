<?php
require_once(t3lib_extMgm::extPath('user_events') . '/Classes/View/MarkerView.php');

class user_events_View_EventListPageBrowserView extends user_events_View_MarkerView {

	public function render($subpartKey = '') {
		$viewTemplate = $this->viewManager->getSubpartFromTemplateOrStack($subpartKey, 'templateCode');

		$this->setPluginInternalConfigurationArray();

		$wrapArray = $this->viewConf['pageBrowserWrapArray.'];

		$content = $this->list_browseresults(1, '', $wrapArray, 'pointer', FALSE);

		return $this->cObj->substituteMarker($viewTemplate, '###PAGEBROWSER###', $content);
	}

	private function setPluginInternalConfigurationArray() {
		$this->pluginInstance->internal['maxPages'] = $this->viewConf['maxPages'];
		$this->pluginInstance->internal['dontLinkActivePage'] = TRUE;
		$this->pluginInstance->internal['showFirstLast'] = TRUE;
		$this->pluginInstance->internal['pagefloat'] = 'center';
		$this->pluginInstance->internal['showRange'] = FALSE;
	}
}
?>
