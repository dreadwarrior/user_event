<?php
require_once(t3lib_extMgm::extPath('user_events') . '/Classes/View/MarkerView.php');

class user_events_View_EventListSearchFormView extends user_events_View_MarkerView {
	public function render($subpartKey = '') {
		$viewTemplate = $this->viewManager->getSubpartFromTemplateOrStack($subpartKey, 'templateCode');

		$_markers = array(
			'ACTION' => htmlspecialchars(t3lib_div::getIndpEnv('REQUEST_URI')),
			'SWORD' => htmlspecialchars($this->pluginInstance->piVars['sword']),
			'PLACEHOLDER' => $this->getLL('search_placeholder'),
			'LABEL_SEARCH' => $this->getLL('search_label'),
			'STARTSEARCH' => $this->getLL('search_start')
		);

		$markers = $this->decorateMarkerKeys($_markers);

		unset($_markers);

		return $this->cObj->substituteMarkerArray($viewTemplate, $markers);
	}
}
?>
