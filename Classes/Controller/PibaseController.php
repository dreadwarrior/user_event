<?php
class user_events_PibaseController extends tslib_pibase {

	protected function initialize($typoScriptConfiguration) {
		$this->conf = $typoScriptConfiguration;
		$this->pi_setPiVarDefaults();
		$this->pi_loadLL();

		$this->initConfig();
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
	}

}
?>