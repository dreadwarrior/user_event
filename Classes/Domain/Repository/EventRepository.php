<?php

require_once t3lib_extMgm::extPath('user_events') . 'Classes/Persistence/PibaseRepository.php';

require_once t3lib_extMgm::extPath('user_events') . 'Classes/Domain/Model/Event.php';

class user_events_Domain_Repository_EventRepository extends user_events_Persistence_PibaseRepository {

	protected $tableName = 'user_events_events';

	protected $whereClause = '';

	public function getOccuringEvents() {
		$this->whereClause = ' AND eventdate >= ' . time() . ' AND sys_language_uid IN (-1, ' . $this->frontend->sys_language_uid . ')';

		$this->setPluginInternalConfigurationArray();

		// NOTE: this method works with various $this->conf[] & $this->internal[] settings
		$resultRessource = $this->exec_query($this->tableName, 0, $this->whereClause, '', '', 'eventdate');

		$events = $this->hydrate($resultRessource);

		return $events;
	}

	protected function setPluginInternalConfigurationArray() {
		$this->pluginInstance->internal['res_count'] = $this->countOccuringEvents();
		$this->pluginInstance->internal['results_at_a_time'] = $this->viewConf['maxPerPage'];
		$this->pluginInstance->internal['searchFieldList'] = 'title,subtitle,shorttext';
	}

	protected function countOccuringEvents() {
		$res = $this->exec_query($this->tableName, 1, $this->whereClause, '', '');

		$amountOfEvents = $this->database->sql_fetch_assoc($res);

		return $amountOfEvents['count(*)'];
	}

	public function getEventById($uid) {
		$row = $this->getRecord($this->tableName, $uid);

		$event = new user_events_Domain_Model_Event($row);

		$event->injectContentObject($this->pluginInstance->cObj);

		return $event;
	}

	protected function hydrate($resultRessource) {
		$events = array();

		while ($eventRow = $this->database->sql_fetch_assoc($resultRessource)) {
			$event = new user_events_Domain_Model_Event($eventRow);

			$event->injectContentObject($this->pluginInstance->cObj);

			$events[] = $event;
		}

		return $events;
	}
}
?>
