<?php
require_once t3lib_extMgm::extPath('user_events') . '/Classes/Model/PibaseDomainObject.php';

class user_events_Model_Event extends user_events_Model_PibaseDomainObject {

	protected $uid = '';

	protected $title = '';

	protected $subtitle = '';

	protected $eventdate = 0;

	protected $shorttext = '';

	protected $bodytext = '';

	protected $image = '';

	protected $alttext = '';

	protected $titletext = '';

	protected $links = '';

	protected $documents = '';

	protected $location = NULL;

	protected $categories = 0;

	/**
	 *
	 * @var tslib_content
	 */
	protected $cObj = NULL;

	public function __construct(array $row) {
		foreach ($row as $property => $value) {
			$this->$property = $value;
		}
	}

	public function __set($property, $value) {
		if (TRUE === property_exists($this, $property)) {
			$this->$property = $value;
		}
	}

	public function injectContentObject(tslib_cObj $cObj) {
		$this->cObj = $cObj;
	}

	public function toString() {
		return $this->title;
	}

	public function getDateStdWrapped($conf) {
		return $this->stdWrap($this->eventdate, $conf);
	}

	public function getTimeStdWrapped($conf) {
		return $this->getDateStdWrapped($conf);
	}

	public function getUid() {
		return $this->uid;
	}

	public function getTitle() {
		return $this->title;
	}

	public function getTitleHtmlEscaped() {
		return htmlspecialchars($this->title);
	}

	public function getSubtitleStdWrapped($conf) {
		return $this->stdWrap($this->getSubtitleHtmlEscaped(), $conf);
	}

	public function getSubtitleHtmlEscaped() {
		return htmlspecialchars($this->subtitle);
	}

	public function hasSubtitle() {
		return '' !== $this->subtitle;
	}

	public function getShorttextStdWrapped($conf) {
		return $this->stdWrap($this->getShorttextHtmlEscaped(), $conf);
	}

	public function getShorttextHtmlEscaped() {
		return htmlspecialchars($this->shorttext);
	}

	public function getBodytextStdWrapped($conf) {
		return $this->stdWrap($this->bodytext, $conf);
	}

	public function getImage() {
		return $this->image;
	}

	public function getAlttext() {
		return $this->alttext;
	}

	public function getTitletext() {
		return $this->titletext;
	}

	public function getNumberOfCategories() {
		return $this->categories;
	}

	public function getCategories(user_events_Model_EventCategoryRepository $repository) {
		$categories = $repository->getCategoriesForEvent($this->getUid());

		return $categories;
	}

	public function getLocation() {
		return $this->location;
	}

	public function getLinks() {
		return $this->links;
	}

	public function hasLinks() {
		return '' !== $this->links;
	}

	public function getDocuments() {
		return $this->documents;
	}

	public function getDocumentsArray() {
		return explode(',', $this->documents);
	}

	public function hasDocuments() {
		return '' !== $this->documents;
	}
}
?>