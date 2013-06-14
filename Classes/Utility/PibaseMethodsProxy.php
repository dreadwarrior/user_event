<?php

require_once t3lib_extMgm::extPath('user_events') . '/Classes/Utility/PibaseMethodsProxyInterface.php';

abstract class user_events_Utility_PibaseMethodsProxy implements user_events_Utility_PibaseMethodsProxyInterface {

	final public function __call($methodName, $methodArguments) {
		$methodName = 'pi_' . $methodName;

		$callTarget = array($this->pluginInstance, $methodName);

		if (FALSE === is_callable($callTarget)) {
			throw new Exception(sprintf('Method "%s" is not available in tslib_pibase!', $methodName), 1347458799);
		}

		return call_user_func_array($callTarget, $methodArguments);
	}

	final public function stdWrap($content, $conf) {
		return $this->cObj->stdWrap($content, $conf);
	}
}
?>
