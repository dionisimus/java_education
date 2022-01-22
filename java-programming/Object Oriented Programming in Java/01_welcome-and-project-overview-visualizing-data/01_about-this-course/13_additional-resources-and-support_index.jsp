


 
 <!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Frameset//EN" "http://www.w3.org/TR/html4/frameset.dtd">
<!--
 ! Copyright (c) 2000, 2018 IBM Corporation and others.
 !
 ! This program and the accompanying materials 
 ! are made available under the terms of the Eclipse Public License 2.0
 ! which accompanies this distribution, and is available at
 ! https://www.eclipse.org/legal/epl-2.0/
 !
 ! SPDX-License-Identifier: EPL-2.0
 ! 
 ! Contributors:
 !     IBM Corporation - initial API and implementation
 -->



<html lang="en">

<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<noscript>
<meta HTTP-EQUIV="REFRESH" CONTENT="0;URL=index.jsp?noscript=1">
</noscript>
<title>Help - Eclipse Platform</title>



<script type="text/javascript">
function liveActionInternal(topHelpWindow, pluginId, className, argument)
{

	alert("You\u0020must\u0020run\u0020help\u0020locally\u0020to\u0020perform\u0020\u0022active\u0020help\u0022\u0020actions\u002E");
	return;

}
function showTopicInContentsInternal(topHelpWindow, topic) {
	try{
		topHelpWindow.HelpFrame.NavFrame.displayTocFor(topic, false);
	}catch(e){
	}
}

</script>


<style type="text/css">
FRAMESET {
	border: 0px;
}
</style>

<script type="text/javascript">

function onloadHandler(e)
{


    try {
	    window.HelpToolbarFrame.frames["SearchFrame"].document.getElementById("searchWord").focus();
	} catch (e) {
	}
}

</script>
</head>

<frameset id="indexFrameset" onload="onloadHandler()" rows="55,24,*"  frameborder="0" framespacing="0" border=0 spacing=0>

	<frame name="BannerFrame" title="Banner" src='topic/org.foundation.helpbanner2/banner.html'  tabIndex="3" marginwidth="0" marginheight="0" scrolling="no" frameborder="0" noresize=0>

	<frame name="HelpToolbarFrame" title="Layout frame: HelpToolbarFrame" src='advanced/helpToolbar.jsp' marginwidth="0" marginheight="0" scrolling="no" frameborder="0" noresize=0>
	<frame name="HelpFrame" title="Layout frame: HelpFrame" src='advanced/help.jsp' marginwidth="0" marginheight="0" scrolling="no" frameborder="0" >

</frameset>

</html>

