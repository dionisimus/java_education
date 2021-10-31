
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>Build Software Applications</title>
  <meta name="author" content="Owen Astrachan, Drew Hilton, Susan Rodger, Robert Duvall">
  <link rel="icon" href="/common/images/duke.gif" type="image/gif">
  <link rel="shortcut icon" href="/common/images/duke.ico">
  <link rel="apple-touch-icon image_src" href="/common/images/duke.png">
  <link rel=stylesheet href="./common/css/style.css" type="text/css">
</head>

<body>

<div class="titlebar">
  <img src="./common/images/dukelogovert.png" id="dukeLogo"/>
  <img src="./common/images/coursera.png" id="courseraLogo"/>
  <h1>Arrays, Lists and Structured Data</h1>
</div>

<div class="navbar">
<table width="95%" border="0" align="center">
<tr>
  <td align="left"><a href="http://www.dukelearntoprogram.com/index.php">Duke Resources Home</a></td>
  <td align="center"><a href="http://www.dukelearntoprogram.com/course3/index.php">Duke Course Home</a></td>
  <td align="right"><a href="https://www.coursera.org/learn/java-programming-arrays-lists-data">Coursera Course Home</a></td>
</tr>
</table>
</div>

<div class="content">

<h3>Resources for the Course</h3>
<div class="lessons">

<table width="100%" border="0" cellspacing="10">
  <tr>
    <td align="center"><img src="common/images/bluej-icon-256.png" width="120" alt="BlueJ" /></td>
    <td valign="top">
      <h4><a href="../downloads/bluej.php?course=3">Download BlueJ Environment</a></h4>
      Download and install BlueJ for your operating system, complete with libraries for this course.
    </td>
  </tr>
  <tr>
    <td align="center"><img src="common/images/files.png" width="120" alt="Resources" /></td>
    <td valign="top">
      <h4><a href="files.php">Project Resources</a></h4>
      Zipfiles for all projects used in this course, each with Java and data files as needed.
    </td>
  </tr>
  <tr>
    <td align="center"><img src="common/images/doc.png" width="120" alt="Documentation" /></td>
    <td valign="top"><h4><a href="doc">Documentation</a></h4>
      Learn more about the Java classes and methods discussed in this course. </td>
  </tr>
  <tr>
    <td align="center"><img src="common/images/osi-logo.png" width="100" alt="Open Source" /></td>
    <td valign="top">
      <h4><a href="../downloads/openSource.php?course=3">Get the Source Code</a></h4>
      Get the source code for all the software used in this course.
    </td>
  </tr>
  <tr>
    <td align="center"><img src="common/images/question.jpg" height="80" alt="Questions" /></td>
    <td valign="top">
      <h4><a href="faq.php">FAQ</a></h4>
      Frequently asked questions about this course.
    </td>
  </tr>
</table>

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
