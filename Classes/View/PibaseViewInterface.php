<?php
interface user_events_View_PibaseViewInterface {
	public function __construct(tslib_pibase $plugin, user_events_View_ViewManagerInterface $viewManager);

	public function setViewConf(array $conf);

	public function render($subpartKey);
}
?>