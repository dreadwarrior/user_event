<?php
require_once t3lib_extMgm::extPath('user_events') . '/Classes/Model/EventCategoryRepository.php';

require_once(t3lib_extMgm::extPath('user_events') . '/Classes/View/PhpView.php');

class user_events_View_EventDetailView extends user_events_View_PhpView {

	/**
	 *
	 * @var user_events_Model_Event
	 */
	protected $event;

	public function setEvent(user_events_Model_Event $event) {
		$this->event = $event;
	}

	public function assignVariables() {
		$this->modifyPageTitle();

		$this->assign('cObj', $this->cObj);
		$this->assign('viewConf', $this->viewConf);

		$this->assign('imageConfiguration', $this->getImageConfiguration());

		$this->assign('event', $this->event);
		$this->assign('location', $this->getLocation());
		$this->assign('categories', $this->getCategories());
		$this->assign('documents', $this->event->getDocumentsArray());
	}

	protected function modifyPageTitle() {
		// @note: titles are htmlspecialchars()'ed automatically
		$GLOBALS['TSFE']->page['title'] = $this->event->getTitle();
		$GLOBALS['TSFE']->indexedDocTitle = $this->event->getTitle();
	}

	protected function getImageConfiguration() {
		$conf = $this->viewConf['image.'];

		// override alt + title text configuration
		$conf['altText'] = $this->event->getAlttext();
		$conf['titleText'] = $this->event->getTitletext();

		return $conf;
	}

	protected function getLocation() {
		$locations = $this->pluginInstance->getLocations();
		return $locations[$this->event->getLocation()];
	}

	protected function getCategories() {
		$eventCategoryRepository = new user_events_Model_EventCategoryRepository($this->pluginInstance);
		return $this->event->getCategories($eventCategoryRepository);
	}
}
?>