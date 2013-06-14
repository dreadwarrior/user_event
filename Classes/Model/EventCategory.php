<?php
require_once t3lib_extMgm::extPath('user_events') . '/Classes/Model/PibaseDomainObject.php';

class user_events_Model_EventCategory extends user_events_Model_PibaseDomainObject {

	protected $title = '';

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

	public function getTitleStdWrapped($conf) {
		return $this->stdWrap($this->title, $conf);
	}
}
?>