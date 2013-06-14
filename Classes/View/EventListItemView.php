<?php
require_once(t3lib_extMgm::extPath('user_events') . '/Classes/View/MarkerView.php');

class user_events_View_EventListItemView extends user_events_View_MarkerView {

	/**
	 *
	 * @var user_events_Model_Event
	 */
	protected $event;

	public function setEvent(user_events_Model_Event $event) {
		$this->event = $event;
	}

	public function render($subpartKey = '') {
		$viewTemplate = $this->viewManager->getSubpartFromTemplateOrStack($subpartKey, 'LIST');

		$locations = $this->pluginInstance->getLocations();

		$_markers = array(
			'DATE' => $this->event->getDateStdWrapped($this->viewConf['dateStdWrap.']),
			'TIME' => $this->event->getTimeStdWrapped($this->viewConf['timeStdWrap.']),
			'TITLE' => $this->createDetailViewLink($this->event->getUid(), $this->event->getTitleHtmlEscaped()),
			'SUBTITLE' => $this->event->getSubtitleHtmlEscaped(),
			'LOCATION' => $locations[$this->event->getLocation()]['city'], //$this->getLocation(),
			'SHORTTEXT' => $this->event->getShorttextStdWrapped($this->viewConf['shorttextStdWrap.']),
			'LINK' => $this->createDetailViewButton($this->event->getUid(), ' btn-primary')
		);

		$markers = $this->decorateMarkerKeys($_markers);

		unset($_markers);

		$content = $this->cObj->substituteMarkerArray($viewTemplate, $markers);

		return $content;
	}

	private function createDetailViewLink($uid, $linktext = '') {
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

	private function createDetailViewButton($uid, $additionalClassesSpacePrefixed = '', $linktext = '') {
		$link = $this->createDetailViewLink($uid, $linktext);

		return $this->makeBootstrapButtonFromLink($link, $additionalClassesSpacePrefixed);
	}

//	private function getLocation() {
//		$eventPid = $this->event['pid'];
//		$whereClause = $this->cObj->enableFields('tt_address');
//		$whereClause .= ' AND uid = ' . $this->event['location'];
//
//		$locations = $this->getCategoryTableContents(
//			'tt_address',
//			$eventPid,
//			$whereClause,
//			'', // $groupBy
//			'', // $orderBy
//			'' // $limit
//		);
//
//		$location = array_shift($locations);
//
//		return $location['title'];
//	}
}
?>
