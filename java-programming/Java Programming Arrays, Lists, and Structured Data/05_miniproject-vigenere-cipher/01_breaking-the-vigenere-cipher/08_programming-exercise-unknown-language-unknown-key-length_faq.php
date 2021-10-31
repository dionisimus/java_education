
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
  <td align="center"><a href="http://www.dukelearntoprogram.com/course3/index.php">Duke Course Home</a></td>
  <td align="right"><a href="https://www.coursera.org/learn/java-programming-arrays-lists-data">Coursera Course Home</a></td>
</tr>
</table>
</div>

<div class="content">

<p>&nbsp;</p>

<div class="lessons">  
  <ul>
    <li><b>How do I find the filename of a file?</b><br> 
        <p>You can use the <code>File</code> method <code>.getName()</code></p>
    </li>
    <li><b>I’m confused about how to use an <code>ArrayList</code> as the value within a <code>HashMap</code>. How do I create and update an <code>ArrayList</code> for each word?</b><br>
        <p>Each word should map to a separate <code>ArrayList</code>. When you encounter a key that isn’t already in the <code>HashMap</code>, you should create a new <code>ArrayList</code> and use <code>HashMap.put()</code> to insert the key and its associated <code>ArrayList</code>. When you want to add to the <code>ArrayList</code> of a key that is already in the <code>HashMap</code>, you should use <code>HashMap.get()</code> to get the <code>ArrayList</code>, update it, then use <code>HashMap.put()</code> to put the key and the updated <code>ArrayList</code> back into the <code>HashMap</code>.</p>
    </li>
    <li><b>I’m not sure how to go about not reusing words in <code>GladLibs</code>. How do I make sure the new word hasn’t been used already? Where do I write this code?</b><br> 
        <p>Think about what type of a loop you will need – do you know how many times this loop will need to run? When will you want to stop the loop? To figure out where to add this code, think about where you generate new words and when you could check whether these have been used already.</p>
    </li>
    <li><b>Why am I getting a <code>null pointer exception</code> whenever I try to call a method on my <code>HashMap</code>?</b><br> 
        <p>Make sure you have initialized your <code>HashMap</code> before calling methods on it. Also, if you are declaring and initializing it in different places, make sure that you have not declared it a second time when you initialize it.</p>
    </li>
    <li><b>My <code>LogAnalyzer</code> class prints out all the values correctly except for the date/time. Does the time zone setting in the computer have an impact on the output value from the <code>.getAccessTime()</code> method?</b><br> 
        <p>Yes, if your time zone is different from Durham, USA, you may want to temporarily change the time zone on your computer.</p>
    </li>
    <li><b>Where can I find the dictionary files to use for my <code>VigenereBreaker</code>?</b><br> 
        <p>The dictionary files are included in the starter program you download. They are inside the folder called ‘dictionaries’.</p>
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
