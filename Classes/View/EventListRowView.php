<?php
require_once(t3lib_extMgm::extPath('user_events') . '/Classes/View/SubpartView.php');

require_once(t3lib_extMgm::extPath('user_events') . '/Classes/View/EventListItemView.php');

class user_events_View_EventListRowView extends user_events_View_SubpartView {

	protected $subpart = 'SINGLEROW';

	/**
	 *
	 * @var user_events_Model_EventRepository
	 */
	protected $eventRepository = NULL;

	public function injectEventRepository(user_events_Model_RepositoryInterface $repository) {
		$this->eventRepository = $repository;
	}

	public function render($subpartKey = '') {
		$viewTemplate = $this->viewManager->getSubpartFromTemplateOrStack($subpartKey, 'templateCode');

		$events = $this->eventRepository->getOccuringEvents();

		$content = '';

		foreach ($events as $i => $event) {
			$templateVariant = 'LIST_' . (($i % 2) + 1);

			$eventListItem = new user_events_View_EventListItemView($this->pluginInstance, $this->viewManager);
			$eventListItem->setEvent($event);
			// @note: viewconf is the same as for this parent view
			$eventListItem->setViewConf($this->viewConf);

			$content .= $eventListItem->render($templateVariant);
		}

		return $this->cObj->substituteSubpart($viewTemplate, '###' . $this->subpart . '###', $content);
	}
}
?>
