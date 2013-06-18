<div class="span8">
	<h1>Veranstaltungen</h1>
	<div class="well">
		<form action="<?php echo htmlspecialchars(t3lib_div::getIndpEnv('REQUEST_URI')) ?>" method="post" style="margin: 0 0 0 0;" class="form-horizontal form-search">
			<fieldset>
				<div class="control-group">
					<label for="user-events-sword" class="control-label"><?php echo $this->getLL('search_label') ?></label>
					<div class="controls">
						<div class="input-append">
							<input type="search" id="user-events-sword" class="span3" name="user_events_pi1[sword]" value="<?php echo htmlspecialchars($this->pluginInstance->piVars['sword']) ?>" placeholder="<?php echo $this->getLL('search_placeholder') ?>" />
							<button type="submit" class="btn"><i class="icon-search"></i> <?php echo $this->getLL('search_start') ?></button>
						</div>
					</div>
				</div>
				<div style="display:none;">
					<input type="hidden" name="no_cache" value="1" />
					<input type="hidden" name="user_events_pi1[pointer]" value="" />
				</div>
			</fieldset>
		</form>
	</div>
	<hr />
	<?php echo $this->list_browseresults(1, '', $viewConf['pageBrowserWrapArray.'], 'pointer', FALSE); ?>
	<hr />
	<div class="user-events-pi1-items">
	<?php foreach ($events as $i => $event): ?>
		<div class="user-events-listitem user-events-<?php echo ($i % 2) ? 'even' : 'odd' ?>">
			<div class="user-events-date"><?php echo $event->getDateStdWrapped($viewConf['dateStdWrap.']) ?> <?php echo $event->getTimeStdWrapped($viewConf['timeStdWrap.']) ?></div>
			<div class="user-events-title">
				<hgroup>
					<h2><?php echo $this->createDetailViewLink($event->getUid(), $event->getTitleHtmlEscaped()) ?></h2>
					<h3><?php echo $event->getSubtitleHtmlEscaped() ?></h3>
				</hgroup>
			</div>
			<?php echo $locations[$event->getLocation()]['city'] ?>
			<div class="user-events-shorttext"><?php echo $event->getShorttextStdWrapped($viewConf['shorttextStdWrap.']) ?></div>
			<div class="user-events-detaillink"><?php echo $this->createDetailViewButton($event->getUid(), ' btn-primary') ?></div>
		</div>
		<hr />
	<?php endforeach ?>
	</div>
	<?php echo $this->list_browseresults(1, '', $viewConf['pageBrowserWrapArray.'], 'pointer', FALSE); ?>
	<div class="user-events-trenner"><!-- --></div>
</div>