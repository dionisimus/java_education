
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="author" content="Owen Astrachan, Drew Hilton, Susan Rodger, Robert Duvall">
  <link rel="icon" href="/common/images/duke.gif" type="image/gif">
  <link rel="shortcut icon" href="/common/images/duke.ico">
  <link rel="apple-touch-icon image_src" href="/common/images/duke.png">
  <link rel=stylesheet href="./common/css/style.css" type="text/css">
  <title>Build Software Applications</title>
</head>

<body>

<div class="titlebar">
  <img src="./common/images/dukelogovert.png" id="dukeLogo"/>
  <img src="./common/images/coursera.png" id="courseraLogo"/>
  <h1>BlueJ - Installation Instructions</h1>
</div>

<div class="navbar">
<table width="95%" border="0" align="center">
<tr>
  <td align="left"><a href="http://www.dukelearntoprogram.com/index.php">Duke Resources Home</a></td>
  <td align="center"><a href="http://www.dukelearntoprogram.com/course0/index.php">Duke Course Home</a></td>
  <td align="right"><a href="https://www.coursera.org/specializations/java-programming">Coursera Course Home</a></td>
</tr>
</table>
</div>

<div class="content">

<div class="lessons">
<table width="100%" border="0" cellspacing="10">
  <tr>
    <td><img src="common/images/bluej-icon-256.png" align="right" width="120" alt="BlueJ" /></td>
    <td>For Duke's courses, we will be using a custom version of the <a href="http://www.bluej.org/">BlueJ Development Environment</a> to develop our Java code. This environment has been used successfully by millions of programmers over  15 years and has been designed by educators at the University of Kent for teaching people new to programming. It does not require a lot of disk space (~200Mb) or processing power (~128Mb RAM) so it should run comfortably on any machine.</td>
    <td><img src="common/images/kent-logo-svg.png" align="right" width="120" height="85" alt="University of Kent" /></td>
  </tr>
</table>
<table width="100%" border="0" cellspacing="10">
  <tr>
    <td><img src="common/images/apple-logo.png" width="120" alt="Mac OSX" /></td>
    <td valign="top"><h4>Mac OS X</h4>
      <p>On the Mac, BlueJ comes bundled with a Java Development Kit, JDK, so only a single download is needed.</p>
      <ol>
        <li><a href="https://bluej.org/download/files/BlueJ-mac-411-duke.zip">Download the Duke/Coursera specific version</a></li>
        <li>Expand the downloaded ZIP file</li>
        <li>Move the BlueJ application from the resulting folder to your preferred location</li>
    </ol></td>
  </tr>
  <tr>
    <td><img src="common/images/windows-logo.png" width="120" alt="Windows" /></td>
    <td valign="top"><h4>Windows</h4>
      <p>On Windows, BlueJ comes bundled with a Java Development Kit, JDK, so only a single download is needed.</p>
      <ol>
        <li><a href="https://bluej.org/download/files/BlueJ-windows-411-duke.msi">Download the Duke/Coursera specific version</a> (choose Save instead of Run)</li>
        <li>Double-click the downloaded install file and follow the wizard  to  install it in your preferred location</li>
        <li>By default, the installer will place a shortcut to BlueJ on your desktop</li>
      </ol></td>
  </tr>
  <tr>
    <td><img src="common/images/ubuntu-logo.png" width="120" alt="Linux" /></td>
    <td valign="top"><h4>Linux</h4>
      <p>On Linux, BlueJ does <em>not</em> come bundled with a Java Development Kit, JDK, so you will need to make sure it is installed as well. You must use version  1.8.x for this course. The instructions below assume you know how to use the command line and package manager. </p>
      <ol>
        <li><a href="https://bluej.org/download/files/BlueJ-linux-411-duke.deb">Download the Duke/Coursera specific version</a></li>
        <li>Check to see if a JDK is currently installed on your machine using the following command (again, any response that starts with 1.8 or higher is fine):<br />
          <code>javac -version </code></li>
        <li>If not, install Oracle's Java 8 JDK by following these instructions for <a href="https://www.digitalocean.com/community/tutorials/how-to-install-java-on-ubuntu-with-apt-get">Ubuntu/Debian</a> or <a href="https://www.digitalocean.com/community/tutorials/how-to-install-java-on-centos-and-fedora">Fedora/RedHat</a> </li>
        <li>Install <code>xdg-utils</code> using the package manager for your version of Linux (such as <code>apt-get</code> for Ubuntu/Debian or <code>yum</code> for Fedora/RedHat)</li>
        <li>Finally, run the following command in your shell to run a standard installation<br />
          <code>sudo dpkg -i BlueJ-linux-411-duke.deb</code> </li>
        <li>The installer will install the application <code>/usr/bin/bluej</code></li>
      </ol></td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td valign="top"><h4>Course Code Packages</h4>
      <p>These are included by default in our Coursera specific version of BlueJ, but in case you need them, you can also download just our code package files for Java (the code is compatible with any Java versions 6 or greater):</p>
      <ul>
        <li><a href="archives/courserajava.jar">edu.duke</a></li>
        <li><a href="archives/apache-csv.jar">org.apache.commons.csv</a></li>
      </ul></td>
  </tr>
</table>

<p>
BlueJ is <a href="https://en.wikipedia.org/wiki/Open-source_software">open source software</a>, meaning you can also <a href="http://www.bluej.org/download/files/BlueJ-source-315-duke.zip">download the source code</a>.
The copyright for BlueJ is held by M. Kölling and J. Rosenberg.<br />
BlueJ is available under the <a href="http://www.bluej.org/about/LICENSE.txt">GNU General Public License version 2 with the Classpath Exception</a>.
</p>
</div>
</div>

<div class="footer">
<p>
<a rel="license" href="http://creativecommons.org/licenses/by/4.0/"><img alt="Creative Commons License" style="border-width:0" src="https://licensebuttons.net/l/by/4.0/88x31.png" /></a><br />
Material accessible from this webpage developed by the instructors at Duke University is licensed under a <a rel="license" href="http://creativecommons.org/licenses/by/4.0/">Creative Commons Attribution 4.0 International License</a>.
</p>

<!-- Apache license 
<a rel="license" href="http://www.apache.org/licenses/LICENSE-2.0.html"><img alt="Apache License" style="border-width:0" src="http://www.apache.org/img/asf_logo.png" width="120" height="31"></a><br />The code for this work is licensed under a <a rel="license" href="http://www.apache.org/licenses/LICENSE-2.0.html">Apache License Version 2.0</a>.
-->
</div>

<!-- WhichBrowser -->
<script>
function waitForWhichBrowser(cb) {
    var callback = cb;
    function wait() {
        if (typeof WhichBrowser == 'undefined') 
            window.setTimeout(wait, 100)
        else 
            callback();
    }
    wait();
}
waitForWhichBrowser(function() {
    var o = document.createElement('div');
	o.id = 'warning';
    try {
        Browsers = new WhichBrowser({ useFeatures: true, detectCamouflage: true });
        if (Browsers.isBrowser('Safari', '>', '0')) {
            o.innerHTML = 'Unfortunately, some features of our JavaScript programming environment are not compatible with the browser you are using. This <a href="./common/saving.php">link</a> explains an alernate way to save your work.';
			document.body.insertBefore(o, document.getElementsByClassName('content')[0]);
        }
        else if (Browsers.isBrowser('Internet Explorer', '>', '0') || Browsers.isBrowser('Edge', '>', '0')) {
            o.innerHTML = 'Unfortunately, our JavaScript programming environment is not compatible with any version of Microsoft\'s Internet Explorer/Edge browser. We suggest you use the latest version of either <a href="https://www.mozilla.org/download">Firefox</a> or <a href="https://www.google.com/chrome/browser/index.html">Chrome</a> instead.';
			document.body.insertBefore(o, document.getElementsByClassName('content')[0]);
        }
		else if (! Boolean(document.createElement('canvas').getContext)) {
			o.innerHTML = 'Unfortunately, you are using an older version of your browser that is not compatible with our JavaScript programming environment. We suggest you download and install the latest version of your of these browser before continuing.';
			document.body.insertBefore(o, document.getElementsByClassName('content')[0]);
		}
    } catch (e) {
        console.log('WhichBrowser error: ' + e);
    }
});
</script>

<!-- Google analytics -->
<script>
  (function(i,s,o,g,r,a,m){i['GoogleAnalyticsObject']=r;i[r]=i[r]||function(){
  (i[r].q=i[r].q||[]).push(arguments)},i[r].l=1*new Date();a=s.createElement(o),
  m=s.getElementsByTagName(o)[0];a.async=1;a.src=g;m.parentNode.insertBefore(a,m)
  })(window,document,'script','//www.google-analytics.com/analytics.js','ga');
  ga('create', 'UA-66891748-1', 'auto');
  ga('send', 'pageview');
</script>


</body>
</html>
