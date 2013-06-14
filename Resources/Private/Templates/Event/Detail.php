<div class="span8">
	<div class="user-events-date"><?php echo $event->getDateStdWrapped($viewConf['dateStdWrap.'] ?> <?php echo $event->getTimeStdWrapped($viewConf['timeStdWrap.']) ?></div>

	<div class="user-events-title">
		<?php if ($event->hasSubtitle()): ?>
		<hgroup>
		<?php endif; ?>

		<h2><?php echo $event->getTitleHtmlEscaped() ?></h2>

		<?php if ($event->hasSubtitle()): ?>
		<?php echo $event->getSubtitleStdWrapped($viewConf['subtitleStdWrap.']) ?>
		</hgroup>
		<?php endif; ?>
	</div>
	<?php echo $location['address'] ?><br /><?php echo $location['zip'] ?> <?php echo $location['city'] ?>

	<?php if ($event->getNumberOfCategories() > 0): ?>
	<div class="user-events-category">
		<?php foreach ($categories as $i => $category): ?>
			<?php echo ($i > 0 ? ', ' : '') ?>
			<?php echo $category->getTitleStdWrapped($viewConf['categoryTitleStdWrap.'] ?>
		<?php endforeach; ?>
	</div>
	<?php endif; ?>

	<div class="user-events-bodytext-container">
		<div class="user-events-bodytext"><?php $event->getBodytextStdWrapped($viewConf['bodytextStdWrap.']) ?></div>
		<ul class="thumbnails">
			<li class="span3"><?php echo $cObj->cImage('uploads/tx_userevents/' . $event->getImage(), $imageConfiguration) ?></li>
		</ul>
	</div>
	<hr />
	<?php if ($event->hasLinks()): ?>
		<div class="user-events-links">
			<h3><?php echo $this->getLL('pi_detail_links_label', 'Links:') ?></h3>
				<?php echo $this->stdWrap(
					$cObj->http_makelinks($event->getLinks(), $viewConf['links.']),
					$viewConf['linksStdWrap.']
				) ?>
				<?php echo $cObj->http_makelinks($event->getLinks(), $viewConf['links.']) ?>
		</div>
	<?php endif; ?>

	<?php if ($event->hasDocuments()): ?>
		<div class="user-events-documents">
			<h3><?php echo $this->getLL('pi_detail_documents_label', 'Documents:') ?></h3>

			<?php foreach ($documents as $document): ?>
				<?php echo $cObj->filelink($document, $viewConf['documents.']); ?>
			<?php endforeach; ?>
		</div>
	<?php endif; ?>
	<div class="user-events-detaillink">
		<br />
		<?php 
			$this->makeBootstrapButtonFromLink(
				$this->stdWrap($this->getLL('back'), $viewConf['backlinkStdWrap.']),
				' btn btn-small'
			)
		?>
		<div class="user-events-trenner">&nbsp;</div>
	</div>
</div>