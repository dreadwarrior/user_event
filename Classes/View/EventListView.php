<?php
require_once t3lib_extMgm::extPath('user_events', 'Classes/Core/View/PhpView.php');
require_once t3lib_extMgm::extPath('user_events', 'Classes/ViewHelpers/EventViewHelper.php');

class user_events_View_EventListView extends user_events_Core_View_PhpView {

	public function assignVariables($subpartKey = '') {
		$this->setInternalPageBrowserConfiguration();

		$eventViewHelper = new user_events_ViewHelpers_EventViewHelper($this->pluginInstance, $this->cObj);
		$eventRepository = new user_events_Domain_Repository_EventRepository($this->pluginInstance);

		$this->assign('cObj', $this->cObj);
		$this->assign('viewConf', $this->viewConf);
		$this->assign('helper', $eventViewHelper);

		$this->assign('locations', $this->pluginInstance->getLocations());
		$this->assign('events', $eventRepository->getOccuringEvents());
	}

	private function setInternalPageBrowserConfiguration() {
		$this->pluginInstance->internal['maxPages'] = $this->viewConf['maxPages'];
		$this->pluginInstance->internal['dontLinkActivePage'] = TRUE;
		$this->pluginInstance->internal['showFirstLast'] = TRUE;
		$this->pluginInstance->internal['pagefloat'] = 'center';
		$this->pluginInstance->internal['showRange'] = FALSE;
	}
}
?>