<?php
require_once t3lib_extMgm::extPath('user_events') . 'Classes/Domain/Repository/EventRepository.php';

require_once t3lib_extMgm::extPath('user_events') . 'Classes/Controller/PibaseController.php';
require_once t3lib_extMgm::extPath('user_events') . 'Classes/View/EventListView.php';
require_once t3lib_extMgm::extPath('user_events') . 'Classes/View/EventDetailView.php';

class user_events_EventController extends user_events_PibaseController {

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
	 * @var user_events_View_PibaseViewInterface
	 */
	protected $view = NULL;

	/**
	 *
	 * @var array
	 */
	protected $viewConf = array();

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
		$this->initialize($conf);

		if (FALSE === isset($this->piVars['showUid'])) {
			$this->actionList();
		} else {
			$this->actionDetail();
		}

		$content = $this->view->render();

		return $this->pi_wrapInBaseClass($content);
	}

	protected function initialize($typoScriptConfiguration) {
		parent::initialize($typoScriptConfiguration);

		$this->initLocations();
	}

	protected function initConfig() {
		parent::initConfig();

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

	private function actionList() {
		$this->viewConf = $this->conf['list.'];

		$this->view = new user_events_View_EventListView($this);
		$this->view->setViewConf($this->viewConf);
	}

	protected function actionDetail() {
		$eventUid = intval($this->piVars['showUid']);

		$eventRepository = new user_events_Domain_Repository_EventRepository($this);
		$event = $eventRepository->getEventById($eventUid);

		$this->view = new user_events_View_EventDetailView($this);
		$this->view->setViewConf($this->conf['detail.']);
		$this->view->setEvent($event);
	}

	public function getLocations() {
		return $this->locations;
	}
}

if (defined('TYPO3_MODE') && isset($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/user_events/Classes/Controller/EventController.php'])) {
	include_once($GLOBALS['TYPO3_CONF_VARS'][TYPO3_MODE]['XCLASS']['ext/user_events/Classes/Controller/EventController.php']);
}
?>