<?php
require_once(t3lib_extMgm::extPath('user_events') . '/Classes/Model/EventRepository.php');

require_once(t3lib_extMgm::extPath('user_events') . '/Classes/View/StackedViewManager.php');
require_once(t3lib_extMgm::extPath('user_events') . '/Classes/View/EventListView.php');
require_once(t3lib_extMgm::extPath('user_events') . '/Classes/View/EventDetailView.php');

class user_events_EventController extends tslib_pibase {

	/**
	 * Same as class name
	 *
	 * @var string
	 */
	public $prefixId = 'user_events_pi1';

	/**
	 * Path to this script relative to the extension dir.
	 *
	 * @var string
	 */
	public $scriptRelPath = 'Resources/Private/Language/Event.xml';

	/**
	 * The extension key.
	 *
	 * @var type string
	 */
	public $extKey = 'user_events';

	/**
	 *
	 * @var boolean
	 */
	public $pi_checkCHash = TRUE;

	/**
	 *
	 * @var array
	 */
	protected $lConf = array();

	/**
	 *
	 * @var array
	 */
	protected $viewConf = array();

	/**
	 *
	 * @var user_events_View_ViewManagerInterface
	 */
	protected $viewManager = NULL;

	/**
	 *
	 * @var array
	 */
	protected $locations = array();

	/**
	 * The main method of the Plugin.
	 *
	 * @param string $content The Plugin content
	 * @param array $conf The Plugin configuration
	 * @return string The content that is displayed on the website
	 */
	public function main($content, array $conf) {
		$this->conf = $conf;
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();

		$this->initConfig();

		$templateCode = $this->cObj->fileResource($this->conf['templateFile']);

		$this->viewManager = new user_events_View_StackedViewManager($this->cObj, $templateCode);

		$this->initLocations();

		if (FALSE === isset($this->piVars['showUid'])) {
			$content = $this->getEventList();
		} else {
			$content = $this->getEventDetail();
		}

		return $this->pi_wrapInBaseClass($content);
	}

	protected function initConfig() {
		// Init and get the flexform data of the plugin
		$this->pi_initPIflexForm();
		// Setup our storage array...
		$this->lConf = array();

		// Assign the flexform data to a local variable for easier access
		$piFlexForm = $this->cObj->data['pi_flexform'];

		// Traverse the entire array based on the language...
		// and assign each configuration option to $this->lConf array
		foreach ($piFlexForm['data'] as $sheet => $data) {
			foreach ($data as $lang => $value) {
				foreach ($value as $key => $val) {
					$this->lConf[$key] = $this->pi_getFFvalue($piFlexForm, $key, $sheet);
				}
			}
		}

		if ('' !== $this->lConf['pages']) {
			$this->conf['pidList'] = $this->lConf['pages'];
		}

		if ('' !== $this->lConf['recursive']) {
			$this->conf['recursive'] = $this->lConf['recursive'];
		}

		if ('' !== $this->lConf['templateFile']) {
			$this->conf['templateFile'] = $this->lConf['templateFile'];
		}
	}

	protected function initLocations() {
		$storagePid = $this->conf['locationStoragePid'];
		$whereClause = $this->cObj->enableFields('tt_address');

		$this->locations = $this->pi_getCategoryTableContents(
			'tt_address',
			$storagePid,
			$whereClause,
			'', // $groupBy
			'', // $orderBy
			'' // $limit
		);
	}

	private function getEventList() {
		$this->viewConf = $this->conf['list.'];

		$eventListView = new user_events_View_EventListView($this, $this->viewManager);
		$eventListView->setViewConf($this->viewConf);

		return $eventListView->render('LIST');
	}

	protected function getEventDetail() {
		$eventUid = intval($this->piVars['showUid']);

		$eventRepository = new user_events_Model_EventRepository($this);
		$event = $eventRepository->getEventById($eventUid);

		$eventDetailView = new user_events_View_EventDetailView($this, $this->viewManager);
		$eventDetailView->setEvent($event);
		$eventDetailView->setViewConf($this->conf['detail.']);

		return $eventDetailView->render();
	}

	public function getLocations() {
		return $this->locations;
	}
}

if (defined('TYPO3_MODE') && isset($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/user_events/Classes/Controller/EventController.php'])) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/user_events/Classes/Controller/EventController.php']);
}
?>