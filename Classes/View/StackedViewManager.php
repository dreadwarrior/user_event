<?php
require_once(t3lib_extMgm::extPath('user_events') . '/Classes/View/ViewManagerInterface.php');

class user_events_View_StackedViewManager implements user_events_View_ViewManagerInterface {
	protected $cObj = NULL;

	protected $templateCode = '';

	protected $subpartStack = array();

	public function __construct(tslib_cObj $cObj, $templateCode) {
		$this->cObj = $cObj;
		$this->templateCode = $templateCode;
	}

	public function getSubpartFromTemplateOrStack($subpartKey, $fromTemplate) {
		if (FALSE === isset($this->subpartStack[$subpartKey])) {
			$fromTemplate = $this->getSubpartParentTemplate($fromTemplate);

			$this->subpartStack[$subpartKey] = $this->cObj->getSubpart($fromTemplate, '###' . $subpartKey . '###');
		}

		return $this->subpartStack[$subpartKey];
	}

	protected function getSubpartParentTemplate($templateOrSubpartKey) {
		$subpart = '';

		if (TRUE === property_exists($this, $templateOrSubpartKey)) {
			$subpart = $this->$templateOrSubpartKey;
		} else if (TRUE === isset($this->subpartStack[$templateOrSubpartKey])) {
			$subpart = $this->subpartStack[$templateOrSubpartKey];
		}

		return $subpart;
	}

	public function setSubpart($subpartKey, $content) {
		$this->subpartStack[$subpartKey] = $content;
	}

	public function getSubpart($subpartKey) {
		return $this->subpartStack[$subpartKey];
	}
}
?>