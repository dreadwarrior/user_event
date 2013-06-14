<?php
require_once t3lib_extMgm::extPath('user_events') . '/Classes/Model/EventCategoryRepository.php';

require_once(t3lib_extMgm::extPath('user_events') . '/Classes/View/MarkerView.php');

class user_events_View_EventDetailView extends user_events_View_MarkerView {

	/**
	 *
	 * @var user_events_Model_Event
	 */
	protected $event;

	public function setEvent(user_events_Model_Event $event) {
		$this->event = $event;
	}

	public function render($subKey) {
		$this->modifyPageTitle();

		$viewTemplate = $this->viewManager->getSubpartFromTemplateOrStack($subKey, 'templateCode');

		$_markers = array(
			'DATE' => $this->event->getDateStdWrapped($this->viewConf['dateStdWrap.']),
			'TIME' => $this->event->getTimeStdWrapped($this->viewConf['timeStdWrap.']),
			'TITLE' => $this->event->getTitleHtmlEscaped(),
			'SUBTITLE' => $this->event->getSubtitleStdWrapped($this->viewConf['subtitleStdWrap.']),
			'LOCATION' => $this->getLocation(),
			'CATEGORIES' => '',
			// @note: alternative to stdWrap.parseFunc: $this->pluginInstance->pi_RTEcssText()
			'BODYTEXT' => $this->event->getBodytextStdWrapped($this->viewConf['bodytextStdWrap.']),
			// @note: hover over thumbnail in backend to fetch EXT's upload path
			'IMAGE' => $this->cObj->cImage('uploads/tx_userevents/' . $this->event->getImage(), $this->getImageConfiguration()),
			'LABEL_LINKS' => $this->getLL('pi_detail_links_label', 'Links:'),
			'LINKS' => $this->getLinks(),
			'LABEL_DOCUMENTS' => $this->getLL('pi_detail_documents_label', 'Documents:'),
			'DOCUMENTS' => $this->getDocuments(),
			'BACKLINK' => $this->makeBacklink()
		);

		$_wrappedSubparts = array(
			'HGROUP' => array('', ''),
		);

		if (trim($_markers['SUBTITLE']) !== '') {
			$_wrappedSubparts['HGROUP'] = array('<hgroup>', '</hgroup>');
		}

		if ($this->event->getNumberOfCategories() > 0) {
			$_markers['CATEGORIES'] = $this->getCategories();
			$_wrappedSubparts['CATEGORIES_CONTAINER'] = array('', '');
		} else {
			$_subparts['CATEGORIES_CONTAINER'] = '';
		}

		if (trim($_markers['LINKS']) !== '') {
			$_wrappedSubparts['LINKS_CONTAINER'] = array('', '');
		} else {
			$_subparts['LINKS_CONTAINER'] = '';
		}

		if (trim($_markers['DOCUMENTS']) !== '') {
			$_wrappedSubparts['DOCUMENTS_CONTAINER'] = array('', '');
		} else {
			$_subparts['DOCUMENTS_CONTAINER'] = '';
		}

		$markers = $this->decorateMarkerKeys($_markers);
		$subparts = $this->decorateMarkerKeys($_subparts);
		$wrappedSubparts = $this->decorateMarkerKeys($_wrappedSubparts);

		unset($_markers, $_subparts, $_wrappedSubparts);

		return $this->cObj->substituteMarkerArrayCached($viewTemplate, $markers, $subparts, $wrappedSubparts);
	}

	protected function modifyPageTitle() {
		// @note: titles are htmlspecialchars()'ed automatically
		$GLOBALS['TSFE']->page['title'] = $this->event->getTitle();
		$GLOBALS['TSFE']->indexedDocTitle = $this->event->getTitle();
	}

	protected function getLocation() {
		$locations = $this->pluginInstance->getLocations();
		$location = $locations[$this->event->getLocation()];

		return sprintf('%s<br>%s %s', $location['address'], $location['zip'], $location['city']);
	}

	protected function getImageConfiguration() {
		$conf = $this->viewConf['image.'];

		// override alt + title text configuration
		$conf['altText'] = $this->event->getAlttext();
		$conf['titleText'] = $this->event->getTitletext();

		return $conf;
	}

	protected function getLinks() {
		$links = $this->cObj->http_makelinks($this->event->getLinks(), $this->viewConf['links.']);

		return $this->stdWrap($links, $this->viewConf['linksStdWrap.']);
	}

	protected function getDocuments() {
		$documents = explode(',', $this->event->getDocuments());

		$content = '';

		foreach ($documents as $document) {
			$content .= $this->cObj->filelink($document, $this->viewConf['documents.']);
		}

		return $content;
	}

	protected function makeBackLink() {
		$linkMarkup = $this->stdWrap($this->getLL('back'), $this->viewConf['backlinkStdWrap.']);

		return $this->makeBootstrapButtonFromLink($linkMarkup, ' btn btn-small');
	}

	protected function getCategories() {
		$eventCategoryRepository = new user_events_Model_EventCategoryRepository($this->pluginInstance);
		$categories = $this->event->getCategories($eventCategoryRepository);

		$categoriesString = '';

		foreach ($categories as $i => $category) {
			$categoriesString .= ($i > 0 ? ', ' : '');
			$categoriesString .= $category->getTitleStdWrapped($this->viewConf['categoryTitleStdWrap.']);
		}

		return $categoriesString;
	}
}
?>