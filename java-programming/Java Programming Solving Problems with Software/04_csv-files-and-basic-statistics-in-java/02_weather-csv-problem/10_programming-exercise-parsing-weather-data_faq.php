
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
  <h1>Frequently Asked Questions</h1>
</div>

<div class="navbar">
<table width="95%" border="0" align="center">
<tr>
  <td align="left"><a href="http://www.dukelearntoprogram.com/index.php">Duke Resources Home</a></td>
  <td align="center"><a href="http://www.dukelearntoprogram.com/course2/index.php">Duke Course Home</a></td>
  <td align="right"><a href="https://www.coursera.org/learn/java-programming">Coursera Course Home</a></td>
</tr>
</table>
</div>

<div class="content">

<p>&nbsp;</p>

<div class="lessons">
  <ul>
    <li><b>My gray images keep saving in the project directory instead of in the file where the original images are.</b><br>
      <p>By default, your images will save to the project directory. If you want to save them in the same folder as the original there are a few options. Assume <code>grayFileName</code> is a <code>String</code> that is the name of the original image with “gray-” added.</p>
      <ul>
        <li>Type the full path of wherever you want to save it e.g. <code>gray.setFileName(“Users/elizabeth/Desktop/pictures” + “/” + grayFileName)</code></li>
        <li>Use <code>File.getParentFile()</code>: <code>gray.setFileName(f.getParentFile() + “/” + grayFileName)</code></li>
      </ul>
    </li>
    <br>
    <li><b>I am finding the wrong number of genes / I think I found a gene that isn’t mentioned as a found gene in the programming exercise.</b><br> 
        <p>Make sure you are following the algorithm exactly as described in the programming exercises. This means genes should not overlap, and for each start codon you should only check the first occurrence of each stop codon. Errors are likely to be in the <code>.findStopIndex()</code> or <code>.StoreAll()</code> methods. Pay attention to how you update the search location depending on what is found.</p>
    </li>
    <li><b>For the project on baby names, what does it mean by number of unique names?</b><br> 
        <p>The number of unique girls/boys names means the number of distinct girls/boys names in the file. For example, in a file with 100 girls named “Sophia”, 150 girls named “Emma”, 100 boys named “Jacob”, and 200 boys named “William”, there are 2 unique girls’ names and 2 unique boys’ names.</p>
    </li>
    <li><b>For the project on baby names, what does it mean by the name with the highest rank?</b><br> 
        <p>Rank 1 is the highest rank and corresponds to the name with the most births that year.</p>
    </li>
  </ul>

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
