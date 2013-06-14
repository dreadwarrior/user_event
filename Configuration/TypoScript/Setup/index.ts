# Setup
plugin.user_events_pi1 {
	templateFile = {$plugin.user_events_pi1.templateFile}
	pidList = {$plugin.user_events_pi1.pidList}
	recursive = {$plugin.user_events_pi1.recursive}
	locationStoragePid = {$plugin.user_events_pi1.locationStoragePid}
	list {
		maxPerPage = {$plugin.user_events_pi1.list.maxPerPage}
		maxPages = {$plugin.user_events_pi1.list.maxPages}

		dateStdWrap {
			strftime = {$plugin.user_events_pi1.list.dateStdWrap.strftime}
			noTrimWrap = |<i class="icon-calendar"></i> ||
		}
		timeStdWrap {
			strftime = {$plugin.user_events_pi1.list.timeStdWrap.strftime}
			noTrimWrap = |<i class="icon-time"></i> ||
		}
		shorttextStdWrap {
			// non-breaking space (alt + 0160)
			// ellipsis (alt + 0133)
			crop = 200 |  … | 1
		}
		linkStdWrap {
			//typolink.parameter = {$plugin.user_events_pi1.list.detailPid}
			noTrimWrap = || <i class="icon-chevron-right icon-white"></i>|
		}
		pageBrowserWrapArray {
			browseBoxWrap = <div class="browseBoxWrap">|</div>
			showResultsWrap = <div class="showResultsWrap">|</div>
			browseLinksWrap = <div class="pagination"><ul>|</ul></div>
			showResultsNumbersWrap = <span class="showResultsNumbersWrap">|</span>
			disabledLinkWrap = <li class="disabled"><a>|</a></li>
			inactiveLinkWrap = <li class="inactiveLinkWrap">|</li>
			activeLinkWrap = <li class="active"><a>|</a></li>
		}
	}
	detail {
		dateStdWrap {
			strftime = {$plugin.user_events_pi1.detail.dateStdWrap.strftime}
			noTrimWrap = |<i class="icon-calendar"></i> ||
		}
		timeStdWrap {
			strftime = {$plugin.user_events_pi1.detail.timeStdWrap.strftime}
			noTrimWrap = |<i class="icon-time"></i> ||
		}
		subtitleStdWrap {
			required = 1
			wrap = <h3>|</h3>
		}
		categoryTitleStdWrap {
			wrap = <span class="badge badge-info"><i class="icon icon-tags icon-white"></i> |</span>
		}
		bodytextStdWrap {
			parseFunc =< lib.parseFunc_RTE
		}
		image {
			file {
				width = 260c
			}
			params = class="img-polaroid"
			imageLinkWrap < tt_content.image.20.1.imageLinkWrap
			imageLinkWrap.enable >
			imageLinkWrap.enable = 1
			imageLinkWrap.typolink >
		}
		// tslib_cObj->http_makelinks() conf
		links {
			ATagParams = class="btn btn-success btn-mini"
			extTarget = {$styles.content.links.extTarget}
			//wrap = |<br><br>
		}
		linksStdWrap {
			br = 1
			//brTag = <br><br>
		}
		backlinkStdWrap {
			wrap = <a href="#" onclick="history.back(); return false;"><i class="icon icon-chevron-left"></i> |</a>
		}
		// tslib_cObj->filelink() conf
		documents {
			path = uploads/tx_userevents/
			icon = 1
			wrap = |<br>
		}
	}
}