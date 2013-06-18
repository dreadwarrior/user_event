<?php
require_once(t3lib_extMgm::extPath('user_events') . 'Classes/Core/View/PhpView.php');

class user_events_View_EventListView extends user_events_Core_View_PhpView {

	public function assignVariables($subpartKey = '') {
		$this->setPluginInternalConfigurationArray();

		$eventRepository = new user_events_Domain_Repository_EventRepository($this->pluginInstance);

		$this->assign('cObj', $this->cObj);
		$this->assign('viewConf', $this->viewConf);

		$this->assign('locations', $this->pluginInstance->getLocations());
		$this->assign('events', $eventRepository->getOccuringEvents());
	}

	private function setPluginInternalConfigurationArray() {
		$this->pluginInstance->internal['maxPages'] = $this->viewConf['maxPages'];
		$this->pluginInstance->internal['dontLinkActivePage'] = TRUE;
		$this->pluginInstance->internal['showFirstLast'] = TRUE;
		$this->pluginInstance->internal['pagefloat'] = 'center';
		$this->pluginInstance->internal['showRange'] = FALSE;
	}

	protected function createDetailViewLink($uid, $linktext = '') {
		if ('' === $linktext) {
			$linktext = $this->stdWrap(
				$this->getLL('list.more_link_text', 'view details'),
				$this->viewConf['linkStdWrap.']
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

	protected function createDetailViewButton($uid, $additionalClassesSpacePrefixed = '', $linktext = '') {
		$link = $this->createDetailViewLink($uid, $linktext);

		return $this->makeBootstrapButtonFromLink($link, $additionalClassesSpacePrefixed);
	}
}
?>