<?php
require_once t3lib_extMgm::extPath('user_events') . '/Classes/Persistence/PibaseRepository.php';

require_once t3lib_extMgm::extPath('user_events') . '/Classes/Domain/Model/EventCategory.php';

class user_events_Domain_Repository_EventCategoryRepository extends user_events_Persistence_PibaseRepository {

	protected $tableName = 'user_events_categories';

	public function getCategoriesForEvent(user_events_Domain_Model_Event $event) {
		$resultRessource = $this->database->exec_SELECT_mm_query(
				$this->tableName . '.title',
				'user_events_events',
				'user_events_events_categories_mm',
				$this->tableName,
				' AND user_events_events.uid = ' . $event->getUid(),
				'', // group by
				$this->tableName . '.title', // order by
				''
		);

		return $this->hydrate($resultRessource);
	}

	protected function setPluginInternalConfigurationArray() {
		// NULL
	}

	protected function hydrate($resultRessource) {
		$categories = array();

		while ($row = $this->database->sql_fetch_assoc($resultRessource)) {
			$category = new user_events_Domain_Model_EventCategory($row);

			$category->injectContentObject($this->pluginInstance->cObj);

			$categories[] = $category;
		}

		return $categories;
	}
}
?>