<?php
require_once t3lib_extMgm::extPath('user_events') . 'Classes/Domain/Repository/EventCategoryRepository.php';

require_once(t3lib_extMgm::extPath('user_events') . 'Classes/Core/View/PhpView.php');

class user_events_View_EventDetailView extends user_events_Core_View_PhpView {

	/**
	 *
	 * @var user_events_Model_Event
	 */
	protected $event;

	public function setEvent(user_events_Domain_Model_Event $event) {
		$this->event = $event;
	}

	public function assignVariables() {
		$this->modifyPageTitle();

		$eventViewHelper = new user_events_ViewHelpers_EventViewHelper($this->pluginInstance, $this->cObj);
		$eventCategoryRepository = new user_events_Domain_Repository_EventCategoryRepository($this->pluginInstance);

		$this->assign('cObj', $this->cObj);
		$this->assign('viewConf', $this->viewConf);
		$this->assign('helper', $eventViewHelper);

		$this->assign('event', $this->event);
		$this->assign('locations', $this->pluginInstance->getLocations());
		$this->assign('categories', $eventCategoryRepository->getCategoriesForEvent($this->event));
		$this->assign('documents', $this->event->getDocumentsArray());
	}

	protected function modifyPageTitle() {
		// @note: titles are htmlspecialchars()'ed automatically
		$GLOBALS['TSFE']->page['title'] = $this->event->getTitle();
		$GLOBALS['TSFE']->indexedDocTitle = $this->event->getTitle();
	}
}
?>