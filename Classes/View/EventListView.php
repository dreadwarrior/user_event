<?php
require_once(t3lib_extMgm::extPath('user_events') . '/Classes/View/SubpartView.php');

require_once(t3lib_extMgm::extPath('user_events') . '/Classes/View/EventListRowView.php');
require_once(t3lib_extMgm::extPath('user_events') . '/Classes/View/EventListSearchFormView.php');
require_once(t3lib_extMgm::extPath('user_events') . '/Classes/View/EventListPageBrowserView.php');

class user_events_View_EventListView extends user_events_View_SubpartView {

	protected $subpart = 'LIST';

	public function render($subpartKey = '') {
		$this->viewManager->getSubpartFromTemplateOrStack($subpartKey, 'templateCode');

		$this->renderEventRowView();

		$this->renderPageBrowserView();

		$this->renderSearchFormView();

		return $this->viewManager->getSubpart($this->subpart);
	}

	private function renderEventRowView() {
		$eventRepository = new user_events_Model_EventRepository($this->pluginInstance);

		$eventRow = new user_events_View_EventListRowView($this->pluginInstance, $this->viewManager);
		$eventRow->setViewConf($this->viewConf);

		$eventRow->injectEventRepository($eventRepository);

		$eventRows = $eventRow->render($this->subpart);
		$this->viewManager->setSubpart($this->subpart, $eventRows);
	}

	private function renderPageBrowserView() {
		$pageBrowserView = new user_events_View_EventListPageBrowserView($this->pluginInstance, $this->viewManager);
		$pageBrowserView->setViewConf($this->viewConf);

		$pageBrowser = $pageBrowserView->render($this->subpart);
		$this->viewManager->setSubpart($this->subpart, $pageBrowser);
	}

	private function renderSearchFormView() {
		$searchFormView = new user_events_View_EventListSearchFormView($this->pluginInstance, $this->viewManager);

		$searchForm = $searchFormView->render($this->subpart);
		$this->viewManager->setSubpart($this->subpart, $searchForm);
	}
}
?>
