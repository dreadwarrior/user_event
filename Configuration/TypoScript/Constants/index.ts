# Constants
plugin.user_events_EventController {
	#cat=PLUGIN.EVENTCALENDAR/file/z; type=file[html,htm,tmpl,txt]; label=Template file:HTML template file for display of events. See EXT:user_events/res/template.html for an example.
	templateFile = EXT:user_events/Resources/Private/Templates/Event/template.html
	#cat=PLUGIN.EVENTCALENDAR/others/a1; type=int+; label=Sysfolder Page ID:
	pidList = 4
	#cat=PLUGIN.EVENTCALENDAR/others/a2; type=options[ =0, 1 level = 1, 2 levels = 2, 3 levels = 3, 4 levels = 4, Infinite = 250]; label=Recursive:
	recursive = 0
	locationStoragePid = 4
	list.maxPerPage = 2
	#cat=PLUGIN.EVENTCALENDAR/others/c; type=int[1-100]; label=List limit:
	list.maxPages = 10
	#cat=PLUGIN.EVENTCALENDAR/links/a; type=int+; label=Single view Page ID:
	list.detailPid = 3
	list.dateStdWrap.strftime = %A, %d.%B.%Y
	list.timeStdWrap.strftime = %H:%M Uhr
	detail.dateStdWrap.strftime = %A, %d.%B.%Y
	detail.timeStdWrap.strftime = %H:%M Uhr
}