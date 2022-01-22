<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN"
	"http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en" dir="ltr"> 
<head>
	<meta http-equiv="Content-Type" content="application/xhtml+xml; charset=utf-8"/> 
	<title>Event and paint cascading for Processing</title>
	<script type="text/javascript" src="processing.js"></script>
	<link rel="stylesheet" href="style.css"/>
	<script type="text/javascript">
		function toggle(id) {
			var tbl = document.getElementById(id);
			var vis = tbl.style.display ;
			if(vis == "none") { tbl.style.display = "block"; }
			else { tbl.style.display ="none"; }}
	</script>
</head>
<body>
<h2>Event and paint cascading for <a href="http://www.processing.org">Processing</a>, implemented using <a href="http://processingjs.org/">Processing.js</a></h2>

<p>Processing, the visualisation programming language, uses
a javalike syntax, with full support for Object Oriented programming, but does not come with its own
cascaded event and paint model. These are relatively easy to implement (at least naively), and so
what follows is a simple framework that you can download and use in your own code. I personally use
it for work that I do in <a href="http://processingjs.org/">processing.js</a>, the javascript library
for using raw Processing (or P5, as it's also known) code inside script tags, or by script file inclusion.</p>

<h3>Component cascading</h3>

	<h4>Basic processing code</h4>

		<p>The main key in this framework is that <b>every event</b> runs through a master "Components"
		container, so all draw instructions, mouse events and key events are sent to it:</p>

		<div><span style='cursor: pointer;' class='codediv' onclick="toggle('PROCESSING_code')">&nbsp;toggle code&nbsp;</span></div>
<table class='code' id='PROCESSING_code' style='display: none;'>
<tr><td class='line'>703</td><td><pre>/**</pre></td></tr>
<tr><td class='line'>704</td><td><pre> * All events are routed through a single &quot;components&quot; instance</pre></td></tr>
<tr><td class='line'>705</td><td><pre> */</pre></td></tr>
<tr><td class='line'>706</td><td><pre>Components components;</pre></td></tr>
<tr><td class='line'>707</td><td><pre></pre></td></tr>
<tr><td class='line'>708</td><td><pre>/**</pre></td></tr>
<tr><td class='line'>709</td><td><pre> * Only does initialisation, then hands off all event work to the components handler</pre></td></tr>
<tr><td class='line'>710</td><td><pre> */</pre></td></tr>
<tr><td class='line'>711</td><td><pre>void setup() {</pre></td></tr>
<tr><td class='line'>712</td><td><pre>	noLoop();</pre></td></tr>
<tr><td class='line'>713</td><td><pre>	size(600,600);</pre></td></tr>
<tr><td class='line'>714</td><td><pre>	components = new Components();</pre></td></tr>
<tr><td class='line'>715</td><td><pre>	initUI();</pre></td></tr>
<tr><td class='line'>716</td><td><pre>}</pre></td></tr>
<tr><td class='line'>717</td><td><pre></pre></td></tr>
<tr><td class='line'>718</td><td><pre>/**</pre></td></tr>
<tr><td class='line'>719</td><td><pre> * Wrapper for component's draw()</pre></td></tr>
<tr><td class='line'>720</td><td><pre> */</pre></td></tr>
<tr><td class='line'>721</td><td><pre>void draw() { background(255); components.draw(); }</pre></td></tr>
<tr><td class='line'>722</td><td><pre></pre></td></tr>
<tr><td class='line'>723</td><td><pre>/**</pre></td></tr>
<tr><td class='line'>724</td><td><pre> * Wrappers for event handling</pre></td></tr>
<tr><td class='line'>725</td><td><pre> */</pre></td></tr>
<tr><td class='line'>726</td><td><pre>void mouseMoved() { components.mouseMoved(mouseX, mouseY); }</pre></td></tr>
<tr><td class='line'>727</td><td><pre>void mouseDragged() { components.mouseDragged(mouseX, mouseY); }</pre></td></tr>
<tr><td class='line'>728</td><td><pre>void mouseClicked() { components.mouseClicked(mouseX, mouseY); }</pre></td></tr>
<tr><td class='line'>729</td><td><pre>void mousePressed() { components.mousePressed(mouseX, mouseY); }</pre></td></tr>
<tr><td class='line'>730</td><td><pre>void mouseReleased() { components.mouseReleased(mouseX, mouseY); }</pre></td></tr>
<tr><td class='line'>731</td><td><pre>void keyPressed() { components.keyPressed(key, keyCode); }</pre></td></tr>
<tr><td class='line'>732</td><td><pre>void keyReleased() { components.keyReleased(key, keyCode); }</pre></td></tr>
<tr><td class='line'>733</td><td><pre></pre></td></tr>
</table>

		<p>You will notice a reference to the method initUI(), which is a convenient place to put all your UI
		initialisation and component filling.</p>

	<h4>Components container</h4>

		<p>The code for the Components object is relatively straight forward, and takes care of three things: 1) event
		cascading, 2) draw() cascading and 3) focus tracking based on a "focus follows the mouse" principle.</p>

		<div><span style='cursor: pointer;' class='codediv' onclick="toggle('Components_code')">&nbsp;toggle code&nbsp;</span></div>
<table class='code' id='Components_code' style='display: none;'>
<tr><td class='line cls'>65</td><td><pre>class Components {</pre></td></tr>
<tr><td class='line'>66</td><td><pre>	ArrayList components;</pre></td></tr>
<tr><td class='line'>67</td><td><pre>	Component focussed = null;</pre></td></tr>
<tr><td class='line'>68</td><td><pre>	</pre></td></tr>
<tr><td class='line'>69</td><td><pre>	Components() { components = new ArrayList(); }</pre></td></tr>
<tr><td class='line'>70</td><td><pre></pre></td></tr>
<tr><td class='line'>71</td><td><pre>	void add(Component component) { components.add(component); }</pre></td></tr>
<tr><td class='line'>72</td><td><pre>	Component get(int index) { return (Component) components.get(index); }</pre></td></tr>
<tr><td class='line'>73</td><td><pre>	int size() { return components.size(); }</pre></td></tr>
<tr><td class='line'>74</td><td><pre></pre></td></tr>
<tr><td class='line'>75</td><td><pre>	// cascades a debug down</pre></td></tr>
<tr><td class='line'>76</td><td><pre>	void setDebug(boolean debug) {</pre></td></tr>
<tr><td class='line'>77</td><td><pre>		for(int c=0; c&lt;components.size(); c++) {</pre></td></tr>
<tr><td class='line'>78</td><td><pre>			Component component = ((Component)components.get(c));</pre></td></tr>
<tr><td class='line'>79</td><td><pre>			component.setDebug(debug); }}</pre></td></tr>
<tr><td class='line'>80</td><td><pre></pre></td></tr>
<tr><td class='line'>81</td><td><pre>	// draws all components, lowest first</pre></td></tr>
<tr><td class='line'>82</td><td><pre>	void draw(){</pre></td></tr>
<tr><td class='line'>83</td><td><pre>		for(int c=0; c&lt;components.size(); c++) {</pre></td></tr>
<tr><td class='line'>84</td><td><pre>			Component component = ((Component)components.get(c));</pre></td></tr>
<tr><td class='line'>85</td><td><pre>			if (component.isVisible()) { component.draw(); }}}</pre></td></tr>
<tr><td class='line'>86</td><td><pre>			</pre></td></tr>
<tr><td class='line'>87</td><td><pre>	// we look for the last (=top most) component that will accept this mouseMove event.</pre></td></tr>
<tr><td class='line'>88</td><td><pre>	// if it's not the currently focussed component, send the old component a focusLost(),</pre></td></tr>
<tr><td class='line'>89</td><td><pre>	// and the new component a focusReceived() event.</pre></td></tr>
<tr><td class='line'>90</td><td><pre>	boolean mouseMoved(int mouseX, int mouseY) {</pre></td></tr>
<tr><td class='line'>91</td><td><pre>		boolean cfound = false;</pre></td></tr>
<tr><td class='line'>92</td><td><pre>		for(int c=components.size()-1; c&gt;=0; c--) {</pre></td></tr>
<tr><td class='line'>93</td><td><pre>			Component component = ((Component)components.get(c));</pre></td></tr>
<tr><td class='line'>94</td><td><pre>			if(component.listensAt(mouseX,mouseY)) {</pre></td></tr>
<tr><td class='line'>95</td><td><pre>				if(focussed!=component) {</pre></td></tr>
<tr><td class='line'>96</td><td><pre>					if(focussed!=null) { </pre></td></tr>
<tr><td class='line'>97</td><td><pre>						focussed.setFocus(false);</pre></td></tr>
<tr><td class='line'>98</td><td><pre>						focussed.focusLost(); }</pre></td></tr>
<tr><td class='line'>99</td><td><pre>					component.setFocus(true);</pre></td></tr>
<tr><td class='line'>100</td><td><pre>					component.focusReceived();</pre></td></tr>
<tr><td class='line'>101</td><td><pre>					focussed = component; }</pre></td></tr>
<tr><td class='line'>102</td><td><pre>				else if(!focussed.hasFocus()) {</pre></td></tr>
<tr><td class='line'>103</td><td><pre>					focussed.setFocus(true);</pre></td></tr>
<tr><td class='line'>104</td><td><pre>					focussed.focusReceived(); }</pre></td></tr>
<tr><td class='line'>105</td><td><pre>				component.mouseMoved(mouseX,mouseY);</pre></td></tr>
<tr><td class='line'>106</td><td><pre>				cfound = true;</pre></td></tr>
<tr><td class='line'>107</td><td><pre>				break; }}</pre></td></tr>
<tr><td class='line'>108</td><td><pre>		if(!cfound &amp;&amp; focussed!=null) { focussed.focusLost(); focussed=null; }</pre></td></tr>
<tr><td class='line'>109</td><td><pre>		redraw();</pre></td></tr>
<tr><td class='line'>110</td><td><pre>		return cfound; }</pre></td></tr>
<tr><td class='line'>111</td><td><pre></pre></td></tr>
<tr><td class='line'>112</td><td><pre>	// standard cascade</pre></td></tr>
<tr><td class='line'>113</td><td><pre>	void mouseClicked(int mouseX, int mouseY) {</pre></td></tr>
<tr><td class='line'>114</td><td><pre>		for(int c=components.size()-1; c&gt;=0; c--) {</pre></td></tr>
<tr><td class='line'>115</td><td><pre>			Component component = ((Component)components.get(c));</pre></td></tr>
<tr><td class='line'>116</td><td><pre>			if(component.listensAt(mouseX,mouseY)) {</pre></td></tr>
<tr><td class='line'>117</td><td><pre>				component.mouseClicked(mouseX,mouseY); break; }} redraw(); }</pre></td></tr>
<tr><td class='line'>118</td><td><pre></pre></td></tr>
<tr><td class='line'>119</td><td><pre>	// standard cascade</pre></td></tr>
<tr><td class='line'>120</td><td><pre>	void mousePressed(int mouseX, int mouseY) {</pre></td></tr>
<tr><td class='line'>121</td><td><pre>		for(int c=components.size()-1; c&gt;=0; c--) {</pre></td></tr>
<tr><td class='line'>122</td><td><pre>			Component component = ((Component)components.get(c));</pre></td></tr>
<tr><td class='line'>123</td><td><pre>			if(component.listensAt(mouseX,mouseY)) {</pre></td></tr>
<tr><td class='line'>124</td><td><pre>				component.mousePressed(mouseX,mouseY); break; }} redraw(); }</pre></td></tr>
<tr><td class='line'>125</td><td><pre></pre></td></tr>
<tr><td class='line'>126</td><td><pre>	// standard cascade</pre></td></tr>
<tr><td class='line'>127</td><td><pre>	void mouseDragged(int mouseX, int mouseY) {</pre></td></tr>
<tr><td class='line'>128</td><td><pre>		for(int c=components.size()-1; c&gt;=0; c--) {</pre></td></tr>
<tr><td class='line'>129</td><td><pre>			Component component = ((Component)components.get(c));</pre></td></tr>
<tr><td class='line'>130</td><td><pre>			if(component.listensAt(mouseX,mouseY)) {</pre></td></tr>
<tr><td class='line'>131</td><td><pre>				component.mouseDragged(mouseX,mouseY); break; }} redraw(); }</pre></td></tr>
<tr><td class='line'>132</td><td><pre></pre></td></tr>
<tr><td class='line'>133</td><td><pre>	// standard cascade</pre></td></tr>
<tr><td class='line'>134</td><td><pre>	void mouseReleased(int mouseX, int mouseY) {</pre></td></tr>
<tr><td class='line'>135</td><td><pre>		for(int c=components.size()-1; c&gt;=0; c--) {</pre></td></tr>
<tr><td class='line'>136</td><td><pre>			Component component = ((Component)components.get(c));</pre></td></tr>
<tr><td class='line'>137</td><td><pre>			if(component.listensAt(mouseX,mouseY)) {</pre></td></tr>
<tr><td class='line'>138</td><td><pre>				component.mouseReleased(mouseX,mouseY); break; }} redraw(); }</pre></td></tr>
<tr><td class='line'>139</td><td><pre></pre></td></tr>
<tr><td class='line'>140</td><td><pre>	// standard cascade</pre></td></tr>
<tr><td class='line'>141</td><td><pre>	void keyPressed(int key, int keyCode) {</pre></td></tr>
<tr><td class='line'>142</td><td><pre>		for(int c=0; c&lt;components.size(); c++) {</pre></td></tr>
<tr><td class='line'>143</td><td><pre>			Component component = ((Component)components.get(c));</pre></td></tr>
<tr><td class='line'>144</td><td><pre>			if(component.listensForKeyPress()) {</pre></td></tr>
<tr><td class='line'>145</td><td><pre>				component.keyPressed(key, keyCode); }} redraw(); }</pre></td></tr>
<tr><td class='line'>146</td><td><pre></pre></td></tr>
<tr><td class='line'>147</td><td><pre>	// standard cascade</pre></td></tr>
<tr><td class='line'>148</td><td><pre>	void keyReleased(int key, int keyCode) {</pre></td></tr>
<tr><td class='line'>149</td><td><pre>		for(int c=0; c&lt;components.size(); c++) {</pre></td></tr>
<tr><td class='line'>150</td><td><pre>			Component component = ((Component)components.get(c));</pre></td></tr>
<tr><td class='line'>151</td><td><pre>			if(component.listensForKeyRelease()) {</pre></td></tr>
<tr><td class='line'>152</td><td><pre>				component.keyReleased(key, keyCode); }} redraw(); }</pre></td></tr>
<tr><td class='line'>153</td><td><pre>}</pre></td></tr>
</table>

	<h4>The component class</h4>

		<p>Of course, we can't do any event/draw cascading without Component objects, so there is also
		a superancestor for components. Components can have focus or not, be visible or not, be set to debug
		mode or not, and can indicate whether they are interested in mouse events, key presses, and key releases:</p>

		<div><span style='cursor: pointer;' class='codediv' onclick="toggle('Component_code')">&nbsp;toggle code&nbsp;</span></div>
<table class='code' id='Component_code' style='display: none;'>
<tr><td class='line cls'>20</td><td><pre>class Component {</pre></td></tr>
<tr><td class='line'>21</td><td><pre>	boolean visible = true;		// visibility</pre></td></tr>
<tr><td class='line'>22</td><td><pre>	boolean hasfocus = false;	// focus</pre></td></tr>
<tr><td class='line'>23</td><td><pre>	boolean debug = false;		// debug status</pre></td></tr>
<tr><td class='line'>24</td><td><pre>	int xoffset = 0;			// nested positioning x-offset</pre></td></tr>
<tr><td class='line'>25</td><td><pre>	int yoffset = 0;			// nested positioning y-offset</pre></td></tr>
<tr><td class='line'>26</td><td><pre>	// empty constructor</pre></td></tr>
<tr><td class='line'>27</td><td><pre>	Component() {}</pre></td></tr>
<tr><td class='line'>28</td><td><pre>	// draw method</pre></td></tr>
<tr><td class='line'>29</td><td><pre>	void draw() {}</pre></td></tr>
<tr><td class='line'>30</td><td><pre>	// set offsets</pre></td></tr>
<tr><td class='line'>31</td><td><pre>	void setOffsets(int x, int y) { xoffset=x; yoffset=y; }</pre></td></tr>
<tr><td class='line'>32</td><td><pre>	int  getXOffset() { return xoffset; }</pre></td></tr>
<tr><td class='line'>33</td><td><pre>	int  getYOffset() { return yoffset; }</pre></td></tr>
<tr><td class='line'>34</td><td><pre>	// debug</pre></td></tr>
<tr><td class='line'>35</td><td><pre>	void setDebug(boolean d) { debug = d; }</pre></td></tr>
<tr><td class='line'>36</td><td><pre>	// handle visibility</pre></td></tr>
<tr><td class='line'>37</td><td><pre>	void setVisible(boolean v) { visible = v; }</pre></td></tr>
<tr><td class='line'>38</td><td><pre>	boolean isVisible() { return visible; }</pre></td></tr>
<tr><td class='line'>39</td><td><pre>	// event handling checks: mouse</pre></td></tr>
<tr><td class='line'>40</td><td><pre>	boolean listensAt(int x, int y) { return false; }</pre></td></tr>
<tr><td class='line'>41</td><td><pre>	// event handling checks: keybaord</pre></td></tr>
<tr><td class='line'>42</td><td><pre>	boolean listensForKeyPress() { return false; }</pre></td></tr>
<tr><td class='line'>43</td><td><pre>	// event handling checks: keyboard</pre></td></tr>
<tr><td class='line'>44</td><td><pre>	boolean listensForKeyRelease() { return false; }</pre></td></tr>
<tr><td class='line'>45</td><td><pre>	// event handling super methods</pre></td></tr>
<tr><td class='line'>46</td><td><pre>	void mouseMoved(int mouseX, int mouseY) {}</pre></td></tr>
<tr><td class='line'>47</td><td><pre>	void mouseClicked(int mouseX, int mouseY) {}</pre></td></tr>
<tr><td class='line'>48</td><td><pre>	void mouseDragged(int mouseX, int mouseY) {}</pre></td></tr>
<tr><td class='line'>49</td><td><pre>	void mousePressed(int mouseX, int mouseY) {}</pre></td></tr>
<tr><td class='line'>50</td><td><pre>	void mouseReleased(int mouseX, int mouseY) {}</pre></td></tr>
<tr><td class='line'>51</td><td><pre>	void keyPressed(int key, int keyCode) {}</pre></td></tr>
<tr><td class='line'>52</td><td><pre>	void keyReleased(int key, int keyCode) {}</pre></td></tr>
<tr><td class='line'>53</td><td><pre>	// action listening from other components</pre></td></tr>
<tr><td class='line'>54</td><td><pre>	void actionPerformed(Component source, int event, String action) {}</pre></td></tr>
<tr><td class='line'>55</td><td><pre>	// focus listening</pre></td></tr>
<tr><td class='line'>56</td><td><pre>	void setFocus(boolean f) { hasfocus = f; }</pre></td></tr>
<tr><td class='line'>57</td><td><pre>	boolean hasFocus() { return hasfocus; }</pre></td></tr>
<tr><td class='line'>58</td><td><pre>	void focusReceived() {}</pre></td></tr>
<tr><td class='line'>59</td><td><pre>	void focusLost() {}</pre></td></tr>
<tr><td class='line'>60</td><td><pre>}</pre></td></tr>
</table>

	<h4>Drawable components</h4>

		<p>While reasonably a component should be drawable, those properties are actually part of things that
		are "more" than just a component, so we stick those properties in a new superancestor, called "Drawable".
		This is an extension on Component with things like stroke and fill properties, as well as methods that
		offer an interface to the active drawable surface:</p>

		<div><span style='cursor: pointer;' class='codediv' onclick="toggle('Drawable_code')">&nbsp;toggle code&nbsp;</span></div>
<table class='code' id='Drawable_code' style='display: none;'>
<tr><td class='line cls'>193</td><td><pre>class Drawable extends Component {</pre></td></tr>
<tr><td class='line'>194</td><td><pre>	int stroke_r, stroke_g, stroke_b, stroke_a;	// stroke color</pre></td></tr>
<tr><td class='line'>195</td><td><pre>	int fill_r, fill_g, fill_b, fill_a;				// fill color</pre></td></tr>
<tr><td class='line'>196</td><td><pre>	int x, y;						// component's location on a surface</pre></td></tr>
<tr><td class='line'>197</td><td><pre>	BoundingBox bounds = null;</pre></td></tr>
<tr><td class='line'>198</td><td><pre>	Drawable(int x, int y) {</pre></td></tr>
<tr><td class='line'>199</td><td><pre>		super();</pre></td></tr>
<tr><td class='line'>200</td><td><pre>		setStroke(0,0,0,255);</pre></td></tr>
<tr><td class='line'>201</td><td><pre>		setFill(255,255,255,255); </pre></td></tr>
<tr><td class='line'>202</td><td><pre>		setX(x);</pre></td></tr>
<tr><td class='line'>203</td><td><pre>		setY(y);</pre></td></tr>
<tr><td class='line'>204</td><td><pre>		setupBoundingBox(); }</pre></td></tr>
<tr><td class='line'>205</td><td><pre>	// all drawable components have a bounding box</pre></td></tr>
<tr><td class='line'>206</td><td><pre>	void setupBoundingBox() {</pre></td></tr>
<tr><td class='line'>207</td><td><pre>		bounds = new BoundingBox(x,y,x,y); }</pre></td></tr>
<tr><td class='line'>208</td><td><pre>	void setOffsets(int x, int y) { </pre></td></tr>
<tr><td class='line'>209</td><td><pre>		super.setOffsets(x,y);</pre></td></tr>
<tr><td class='line'>210</td><td><pre>		bounds.move(x,y); }</pre></td></tr>
<tr><td class='line'>211</td><td><pre>	// draw means setting colors, and if debugging, drawing the bounding box</pre></td></tr>
<tr><td class='line'>212</td><td><pre>	void draw() {</pre></td></tr>
<tr><td class='line'>213</td><td><pre>		if(debug) { </pre></td></tr>
<tr><td class='line'>214</td><td><pre>			stroke(255,0,0,100); </pre></td></tr>
<tr><td class='line'>215</td><td><pre>			fill(255,0,0,10); </pre></td></tr>
<tr><td class='line'>216</td><td><pre>			bounds.draw(); }</pre></td></tr>
<tr><td class='line'>217</td><td><pre>		stroke(stroke_r,stroke_g,stroke_b,stroke_a);</pre></td></tr>
<tr><td class='line'>218</td><td><pre>		fill(fill_r,fill_g,fill_b,fill_a); }</pre></td></tr>
<tr><td class='line'>219</td><td><pre>	void setStroke(int r, int g, int b, int a) {</pre></td></tr>
<tr><td class='line'>220</td><td><pre>		stroke_r = r; stroke_g = g; stroke_b = b; stroke_a = a; }</pre></td></tr>
<tr><td class='line'>221</td><td><pre>	void setFill(int r, int g, int b, int a) {</pre></td></tr>
<tr><td class='line'>222</td><td><pre>		fill_r = r; fill_g = g; fill_b = b; fill_a = a; }</pre></td></tr>
<tr><td class='line'>223</td><td><pre>	// standard getter/setters</pre></td></tr>
<tr><td class='line'>224</td><td><pre>	int getX() { return x; }</pre></td></tr>
<tr><td class='line'>225</td><td><pre>	int getY() { return y; }</pre></td></tr>
<tr><td class='line'>226</td><td><pre>	void setX(int v) { x=v; }</pre></td></tr>
<tr><td class='line'>227</td><td><pre>	void setY(int v) { y=v; }</pre></td></tr>
<tr><td class='line'>228</td><td><pre>	BoundingBox getBoundingBox() { return bounds; }</pre></td></tr>
<tr><td class='line'>229</td><td><pre>	// moved a drawable component around on the surface</pre></td></tr>
<tr><td class='line'>230</td><td><pre>	void move(int dx, int dy) { x += dx; y += dy; bounds.move(dx,dy); }</pre></td></tr>
<tr><td class='line'>231</td><td><pre>	// superancestral methods for determining whether focus and events should propagate</pre></td></tr>
<tr><td class='line'>232</td><td><pre>	boolean listensAt(int x, int y) { return inArea(x,y); }</pre></td></tr>
<tr><td class='line'>233</td><td><pre>	boolean inArea(int x, int y) { return false; }</pre></td></tr>
<tr><td class='line'>234</td><td><pre>}</pre></td></tr>
</table>

		<p>Drawable components have a location in their parent container, and have stroke and fill color
		properties. In addition, the "listensAt" method now refers to the inArea method, so that subclasses
		only have to implement an "inArea" check for interfacing with the drawable surface</p>

	<h4>Bounding boxes</h4>
	
		<p>All drawable components have a bounding box, which is basically just a rectange that indicates the
		extremities of a shape. For some shapes the bounding box is simply defined by the x and y coordinates
		of the points on the shape, such as lines and rectangles, but for some shapes the bounding box depends
		on the shape of the line segments drawn, rather than the shape's points, such as for circles and bezier
		curves.</p>
		
		<div><span style='cursor: pointer;' class='codediv' onclick="toggle('BoundingBox_code')">&nbsp;toggle code&nbsp;</span></div>
<table class='code' id='BoundingBox_code' style='display: none;'>
<tr><td class='line cls'>163</td><td><pre>class BoundingBox</pre></td></tr>
<tr><td class='line'>164</td><td><pre>{</pre></td></tr>
<tr><td class='line'>165</td><td><pre>	int x, y, X, Y;</pre></td></tr>
<tr><td class='line'>166</td><td><pre>	BoundingBox(int x, int y, int X, int Y) { this.x=x; this.y=y; this.X=X; this.Y=Y; }</pre></td></tr>
<tr><td class='line'>167</td><td><pre>	// draw</pre></td></tr>
<tr><td class='line'>168</td><td><pre>	void draw() { rectMode(CORNER); rect(x, y, X-x, Y-y); }</pre></td></tr>
<tr><td class='line'>169</td><td><pre>	// getters</pre></td></tr>
<tr><td class='line'>170</td><td><pre>	int getMinX() { return x; }</pre></td></tr>
<tr><td class='line'>171</td><td><pre>	int getMinY() { return y; }</pre></td></tr>
<tr><td class='line'>172</td><td><pre>	int getMaxX() { return X; }</pre></td></tr>
<tr><td class='line'>173</td><td><pre>	int getMaxY() { return Y; }</pre></td></tr>
<tr><td class='line'>174</td><td><pre>	int getWidth() { return X-x; }</pre></td></tr>
<tr><td class='line'>175</td><td><pre>	int getHeight() { return Y-y; }</pre></td></tr>
<tr><td class='line'>176</td><td><pre>	// setters</pre></td></tr>
<tr><td class='line'>177</td><td><pre>	void setMinX(int v) { x = v; }</pre></td></tr>
<tr><td class='line'>178</td><td><pre>	void setMinY(int v) { y = v; }</pre></td></tr>
<tr><td class='line'>179</td><td><pre>	void setMaxX(int v) { X = v; }</pre></td></tr>
<tr><td class='line'>180</td><td><pre>	void setMaxY(int v) { Y = v; }</pre></td></tr>
<tr><td class='line'>181</td><td><pre>	// movers</pre></td></tr>
<tr><td class='line'>182</td><td><pre>	void move(int dx, int dy) { x+=dx; y+=dy; X+=dx; Y+=dy; }</pre></td></tr>
<tr><td class='line'>183</td><td><pre>	// in bound check</pre></td></tr>
<tr><td class='line'>184</td><td><pre>	boolean inBoundsX(int v) { return (x&lt;=v &amp;&amp; v&lt;=X); }</pre></td></tr>
<tr><td class='line'>185</td><td><pre>	boolean inBoundsY(int v) { return (y&lt;=v &amp;&amp; v&lt;=Y); }</pre></td></tr>
<tr><td class='line'>186</td><td><pre>	boolean inArea(int x, int y) { return (inBoundsX(x) &amp;&amp; inBoundsY(y)); }</pre></td></tr>
<tr><td class='line'>187</td><td><pre>}</pre></td></tr>
</table>
		
		<p>Normally, the bounding box is hidden, but because it's always good to be able to play around with, it can
		be made visible by setting a component's debug flag to <span style="font-family: monospaced">true</span></p>

<h3>Using objects instead of draw primitives</h3>

	<p>The point of an event/draw tree is that you can treat what you draw as individual components. So let's
	make that happen: lets define the basic drawing primitives in Processing as proper objects instead:</p>

	<h4>Ellipse</h4>

		<div><span style='cursor: pointer;' class='codediv' onclick="toggle('Ellipse_code')">&nbsp;toggle code&nbsp;</span></div>
<table class='code' id='Ellipse_code' style='display: none;'>
<tr><td class='line cls'>239</td><td><pre>class Ellipse extends Drawable</pre></td></tr>
<tr><td class='line'>240</td><td><pre>{</pre></td></tr>
<tr><td class='line'>241</td><td><pre>	int width, height;</pre></td></tr>
<tr><td class='line'>242</td><td><pre>	Ellipse(int xv, int yv, int w, int h) {</pre></td></tr>
<tr><td class='line'>243</td><td><pre>		super(xv,yv);</pre></td></tr>
<tr><td class='line'>244</td><td><pre>		width = w;</pre></td></tr>
<tr><td class='line'>245</td><td><pre>		height = h; </pre></td></tr>
<tr><td class='line'>246</td><td><pre>		setupBoundingBox(); }</pre></td></tr>
<tr><td class='line'>247</td><td><pre>	void setupBoundingBox() {</pre></td></tr>
<tr><td class='line'>248</td><td><pre>		int hw = (width/2);</pre></td></tr>
<tr><td class='line'>249</td><td><pre>		int hh = (height/2);</pre></td></tr>
<tr><td class='line'>250</td><td><pre>		bounds = new BoundingBox(x-hw, y-hh, x+hw, y+hh); }</pre></td></tr>
<tr><td class='line'>251</td><td><pre>	// draw</pre></td></tr>
<tr><td class='line'>252</td><td><pre>	void draw() { super.draw(); ellipse(x+xoffset, y+yoffset, width, height); }</pre></td></tr>
<tr><td class='line'>253</td><td><pre>	// getters</pre></td></tr>
<tr><td class='line'>254</td><td><pre>	int getWidth() { return width; }</pre></td></tr>
<tr><td class='line'>255</td><td><pre>	int getHeight() { return height; }</pre></td></tr>
<tr><td class='line'>256</td><td><pre>	// setters</pre></td></tr>
<tr><td class='line'>257</td><td><pre>	void setWidth(int v) { width = v; }</pre></td></tr>
<tr><td class='line'>258</td><td><pre>	void setHeight(int v) { height = v; }</pre></td></tr>
<tr><td class='line'>259</td><td><pre>	// poly check (sort of) - Ellipse cartesian formula: (x-h)&sup2;/a&sup2; + (y-k)&sup2;/b&sup2; = 1</pre></td></tr>
<tr><td class='line'>260</td><td><pre>	// in this formula {h,k} = center, a = half width, and b = half height</pre></td></tr>
<tr><td class='line'>261</td><td><pre>	boolean inArea(int xv, int yv) { </pre></td></tr>
<tr><td class='line'>262</td><td><pre>		int a = width/2;	int sqa = a*a;</pre></td></tr>
<tr><td class='line'>263</td><td><pre>		int b = height/2;	int sqb = b*b;</pre></td></tr>
<tr><td class='line'>264</td><td><pre>		int xh = x - xv;	int sqxh = xh*xh;</pre></td></tr>
<tr><td class='line'>265</td><td><pre>		int yk = y - yv;	int sqyk = yk*yk;</pre></td></tr>
<tr><td class='line'>266</td><td><pre>		return (sqxh/sqa + sqyk/sqb) &lt;= 1; }</pre></td></tr>
<tr><td class='line'>267</td><td><pre>}</pre></td></tr>
</table>

	<h4>Circle</h4>

		<p>technically this is not a Processing primitive, you'd use ellipse(x,y,d,d), but it's worth giving its own class.</p>

		<div><span style='cursor: pointer;' class='codediv' onclick="toggle('Circle_code')">&nbsp;toggle code&nbsp;</span></div>
<table class='code' id='Circle_code' style='display: none;'>
<tr><td class='line cls'>278</td><td><pre>class Circle extends Drawable</pre></td></tr>
<tr><td class='line'>279</td><td><pre>{</pre></td></tr>
<tr><td class='line'>280</td><td><pre>	int radius;</pre></td></tr>
<tr><td class='line'>281</td><td><pre>	Circle(int xv, int yv, int r) {</pre></td></tr>
<tr><td class='line'>282</td><td><pre>		super(xv,yv);</pre></td></tr>
<tr><td class='line'>283</td><td><pre>		radius = (int)r; </pre></td></tr>
<tr><td class='line'>284</td><td><pre>		setupBoundingBox(); }</pre></td></tr>
<tr><td class='line'>285</td><td><pre>	void setupBoundingBox() {</pre></td></tr>
<tr><td class='line'>286</td><td><pre>		bounds = new BoundingBox(x-radius, y-radius, x+radius, y+radius); }</pre></td></tr>
<tr><td class='line'>287</td><td><pre>	// draw</pre></td></tr>
<tr><td class='line'>288</td><td><pre>	void draw() { super.draw(); ellipse(x+xoffset, y+yoffset, 2*radius, 2*radius); }</pre></td></tr>
<tr><td class='line'>289</td><td><pre>	// getters</pre></td></tr>
<tr><td class='line'>290</td><td><pre>	int getRadius() { return radius; }</pre></td></tr>
<tr><td class='line'>291</td><td><pre>	// setters</pre></td></tr>
<tr><td class='line'>292</td><td><pre>	void setRadius(int v) { radius = v; }</pre></td></tr>
<tr><td class='line'>293</td><td><pre>	// poly check (sort of)</pre></td></tr>
<tr><td class='line'>294</td><td><pre>	boolean inArea(int xv, int yv) { </pre></td></tr>
<tr><td class='line'>295</td><td><pre>		int dx = xv-x;</pre></td></tr>
<tr><td class='line'>296</td><td><pre>		int sqx = dx*dx;</pre></td></tr>
<tr><td class='line'>297</td><td><pre>		int dy = yv-y;</pre></td></tr>
<tr><td class='line'>298</td><td><pre>		int sqy = dy*dy;</pre></td></tr>
<tr><td class='line'>299</td><td><pre>		int sqr = radius*radius;</pre></td></tr>
<tr><td class='line'>300</td><td><pre>		// aways use multiplication rather than sqrt when possible. Much, much cheaper</pre></td></tr>
<tr><td class='line'>301</td><td><pre>		return sqx+sqy &lt;= sqr; }</pre></td></tr>
<tr><td class='line'>302</td><td><pre>}</pre></td></tr>
</table>

	<h4>Rect</h4>

		<div><span style='cursor: pointer;' class='codediv' onclick="toggle('Rect_code')">&nbsp;toggle code&nbsp;</span></div>
<table class='code' id='Rect_code' style='display: none;'>
<tr><td class='line cls'>308</td><td><pre>class Rect extends Drawable</pre></td></tr>
<tr><td class='line'>309</td><td><pre>{</pre></td></tr>
<tr><td class='line'>310</td><td><pre>	int x2, y2;</pre></td></tr>
<tr><td class='line'>311</td><td><pre>	Rect(int x, int y, int w, int h) {</pre></td></tr>
<tr><td class='line'>312</td><td><pre>		super(x,y);</pre></td></tr>
<tr><td class='line'>313</td><td><pre>		x2 = x+w;</pre></td></tr>
<tr><td class='line'>314</td><td><pre>		y2 = y+h;</pre></td></tr>
<tr><td class='line'>315</td><td><pre>		setupBoundingBox(); }</pre></td></tr>
<tr><td class='line'>316</td><td><pre>	void setupBoundingBox() {</pre></td></tr>
<tr><td class='line'>317</td><td><pre>		bounds = new BoundingBox(x,y,x2,y2); }</pre></td></tr>
<tr><td class='line'>318</td><td><pre>	// draw</pre></td></tr>
<tr><td class='line'>319</td><td><pre>	void draw() {</pre></td></tr>
<tr><td class='line'>320</td><td><pre>		super.draw();</pre></td></tr>
<tr><td class='line'>321</td><td><pre>		rectMode(CORNER);</pre></td></tr>
<tr><td class='line'>322</td><td><pre>		rect(x+xoffset, y+yoffset, getWidth(), getHeight()); }</pre></td></tr>
<tr><td class='line'>323</td><td><pre>	// getters</pre></td></tr>
<tr><td class='line'>324</td><td><pre>	int getMinX() { return x; }</pre></td></tr>
<tr><td class='line'>325</td><td><pre>	int getMinY() { return y; }</pre></td></tr>
<tr><td class='line'>326</td><td><pre>	int getMaxX() { return x2; }</pre></td></tr>
<tr><td class='line'>327</td><td><pre>	int getMaxY() { return y2; }</pre></td></tr>
<tr><td class='line'>328</td><td><pre>	int getWidth() { return x2-x; }</pre></td></tr>
<tr><td class='line'>329</td><td><pre>	int getHeight() { return y2-y; }</pre></td></tr>
<tr><td class='line'>330</td><td><pre>	// setters</pre></td></tr>
<tr><td class='line'>331</td><td><pre>	void setMinX(int v) { setX(v); }</pre></td></tr>
<tr><td class='line'>332</td><td><pre>	void setMinY(int v) { setY(v); }</pre></td></tr>
<tr><td class='line'>333</td><td><pre>	void setMaxX(int v) { x2 = v; }</pre></td></tr>
<tr><td class='line'>334</td><td><pre>	void setMaxY(int v) { y2 = v; }</pre></td></tr>
<tr><td class='line'>335</td><td><pre>	// move override, because we have more than just x/y to move</pre></td></tr>
<tr><td class='line'>336</td><td><pre>	void move(int dx, int dy) {</pre></td></tr>
<tr><td class='line'>337</td><td><pre>		super.move(dx,dy);</pre></td></tr>
<tr><td class='line'>338</td><td><pre>		x2 += dx;</pre></td></tr>
<tr><td class='line'>339</td><td><pre>		y2 += dy; }</pre></td></tr>
<tr><td class='line'>340</td><td><pre>	// poly check (sort of)</pre></td></tr>
<tr><td class='line'>341</td><td><pre>	boolean inBoundsX(int v) { return (x&lt;=v &amp;&amp; v&lt;=x2); }</pre></td></tr>
<tr><td class='line'>342</td><td><pre>	boolean inBoundsY(int v) { return (y&lt;=v &amp;&amp; v&lt;=y2); }</pre></td></tr>
<tr><td class='line'>343</td><td><pre>	boolean inArea(int x, int y) { return (inBoundsX(x) &amp;&amp; inBoundsY(y)); }</pre></td></tr>
<tr><td class='line'>344</td><td><pre>}</pre></td></tr>
</table>

	<h4>Line</h4>

		<div><span style='cursor: pointer;' class='codediv' onclick="toggle('Line_code')">&nbsp;toggle code&nbsp;</span></div>
<table class='code' id='Line_code' style='display: none;'>
<tr><td class='line cls'>393</td><td><pre>class Line extends Drawable</pre></td></tr>
<tr><td class='line'>394</td><td><pre>{</pre></td></tr>
<tr><td class='line'>395</td><td><pre>	int bounding_thickness;</pre></td></tr>
<tr><td class='line'>396</td><td><pre>	int x2, y2, xdif, ydif;</pre></td></tr>
<tr><td class='line'>397</td><td><pre></pre></td></tr>
<tr><td class='line'>398</td><td><pre>	Line(int x1, int y1, int x2, int y2) {</pre></td></tr>
<tr><td class='line'>399</td><td><pre>		super(x1,y1);</pre></td></tr>
<tr><td class='line'>400</td><td><pre>		this.x2 = x2; this.y2 = y2;</pre></td></tr>
<tr><td class='line'>401</td><td><pre>		bounding_thickness = 3;</pre></td></tr>
<tr><td class='line'>402</td><td><pre>		setupBoundingBox(); }</pre></td></tr>
<tr><td class='line'>403</td><td><pre>	</pre></td></tr>
<tr><td class='line'>404</td><td><pre>	void setupBoundingBox() { </pre></td></tr>
<tr><td class='line'>405</td><td><pre>		bounds = new BoundingBox(min(x,x2)-bounding_thickness, </pre></td></tr>
<tr><td class='line'>406</td><td><pre>							min(y,y2)-bounding_thickness,</pre></td></tr>
<tr><td class='line'>407</td><td><pre>							max(x,x2)+bounding_thickness,</pre></td></tr>
<tr><td class='line'>408</td><td><pre>							max(y,y2)+bounding_thickness); }</pre></td></tr>
<tr><td class='line'>409</td><td><pre></pre></td></tr>
<tr><td class='line'>410</td><td><pre>	void setStartX(int v) { setX(v); setupBoundingBox(); }</pre></td></tr>
<tr><td class='line'>411</td><td><pre>	void setStartY(int v) { setY(v); setupBoundingBox(); }</pre></td></tr>
<tr><td class='line'>412</td><td><pre>	void setEndX(int v) { x2=v; setupBoundingBox(); }</pre></td></tr>
<tr><td class='line'>413</td><td><pre>	void setEndY(int v) { y2=v; setupBoundingBox(); }</pre></td></tr>
<tr><td class='line'>414</td><td><pre>	</pre></td></tr>
<tr><td class='line'>415</td><td><pre>	void move(int dx, int dy) {</pre></td></tr>
<tr><td class='line'>416</td><td><pre>		super.move(dx,dy);</pre></td></tr>
<tr><td class='line'>417</td><td><pre>		x2+=dx;</pre></td></tr>
<tr><td class='line'>418</td><td><pre>		y2+=dy; }</pre></td></tr>
<tr><td class='line'>419</td><td><pre></pre></td></tr>
<tr><td class='line'>420</td><td><pre>	void setBoundingThickness(int t) {</pre></td></tr>
<tr><td class='line'>421</td><td><pre>		bounding_thickness = t; </pre></td></tr>
<tr><td class='line'>422</td><td><pre>		setupBoundingBox(); }</pre></td></tr>
<tr><td class='line'>423</td><td><pre></pre></td></tr>
<tr><td class='line'>424</td><td><pre>	void draw() { super.draw(); drawLine(); }</pre></td></tr>
<tr><td class='line'>425</td><td><pre>	void drawLine() { line(x+xoffset,y+yoffset,x2+xoffset,y2+yoffset); }</pre></td></tr>
<tr><td class='line'>426</td><td><pre></pre></td></tr>
<tr><td class='line'>427</td><td><pre>	// compute the y we get for this x, and see if it's close enough to the y we *should* get.</pre></td></tr>
<tr><td class='line'>428</td><td><pre>	boolean onLine(int xv, int yv) {</pre></td></tr>
<tr><td class='line'>429</td><td><pre>		if(bounds.inArea(xv,yv)) {</pre></td></tr>
<tr><td class='line'>430</td><td><pre>			if(abs(x2-x)&lt;=bounding_thickness) { return (min(y,y2)&lt;=yv &amp;&amp; yv&lt;=max(y,y2)); }</pre></td></tr>
<tr><td class='line'>431</td><td><pre>			else if(abs(y2-y)&lt;=bounding_thickness) { return (min(x,x2)&lt;=yv &amp;&amp; yv&lt;=max(x,x2)); }</pre></td></tr>
<tr><td class='line'>432</td><td><pre>			else {</pre></td></tr>
<tr><td class='line'>433</td><td><pre>				double ydif = y2-y;</pre></td></tr>
<tr><td class='line'>434</td><td><pre>				double xdif = x2-x;</pre></td></tr>
<tr><td class='line'>435</td><td><pre>				double coeff = ydif/xdif;</pre></td></tr>
<tr><td class='line'>436</td><td><pre>				int computed_y = (int) (y + (((xv-bounding_thickness)-x)*coeff));</pre></td></tr>
<tr><td class='line'>437</td><td><pre>				int computed_y2 = (int) (y + (((xv+bounding_thickness)-x)*coeff));</pre></td></tr>
<tr><td class='line'>438</td><td><pre>				boolean online = (min(computed_y,computed_y2)&lt;=yv &amp;&amp; yv&lt;=max(computed_y,computed_y2));</pre></td></tr>
<tr><td class='line'>439</td><td><pre>				return online; }}</pre></td></tr>
<tr><td class='line'>440</td><td><pre>		return false; }</pre></td></tr>
<tr><td class='line'>441</td><td><pre></pre></td></tr>
<tr><td class='line'>442</td><td><pre>	// lines strictly speaking have no area, so an inArea check is the same as an onLine check</pre></td></tr>
<tr><td class='line'>443</td><td><pre>	boolean inArea(int x, int y) { return onLine(x,y); }</pre></td></tr>
<tr><td class='line'>444</td><td><pre>}</pre></td></tr>
</table>

	<h4>Bezier</h4>

		<p>The bezier curve is a spectacular beast, mostly because its bounding box and "is the mouse hovering
		over it" computation are rather funky bits of math:</p>

		<div><span style='cursor: pointer;' class='codediv' onclick="toggle('Bezier_code')">&nbsp;toggle code&nbsp;</span></div>
<table class='code' id='Bezier_code' style='display: none;'>
<tr><td class='line cls'>450</td><td><pre>class Bezier extends Line</pre></td></tr>
<tr><td class='line'>451</td><td><pre>{</pre></td></tr>
<tr><td class='line'>452</td><td><pre>	int cx1, cy1, cx2, cy2;	// control coordinates</pre></td></tr>
<tr><td class='line'>453</td><td><pre></pre></td></tr>
<tr><td class='line'>454</td><td><pre>	// third order bezier (cubic)</pre></td></tr>
<tr><td class='line'>455</td><td><pre>	Bezier(int x1, int y1, int cx1, int cy1, int cx2, int cy2, int x2, int y2) {</pre></td></tr>
<tr><td class='line'>456</td><td><pre>		super(x1,y1,x2,y2);</pre></td></tr>
<tr><td class='line'>457</td><td><pre>		this.cx1 = cx1; this.cy1 = cy1; this.cx2 = cx2; this.cy2 = cy2;</pre></td></tr>
<tr><td class='line'>458</td><td><pre>		setupBezierBounds(); }</pre></td></tr>
<tr><td class='line'>459</td><td><pre></pre></td></tr>
<tr><td class='line'>460</td><td><pre>	// bounds computation for Bezier curves is not quite as straight forward as lines...</pre></td></tr>
<tr><td class='line'>461</td><td><pre>	// in fact, it's downright complex.</pre></td></tr>
<tr><td class='line'>462</td><td><pre>	void setupBezierBounds()</pre></td></tr>
<tr><td class='line'>463</td><td><pre>	{</pre></td></tr>
<tr><td class='line'>464</td><td><pre>		int x1=x;</pre></td></tr>
<tr><td class='line'>465</td><td><pre>		int y1=y;</pre></td></tr>
<tr><td class='line'>466</td><td><pre></pre></td></tr>
<tr><td class='line'>467</td><td><pre>		// I don't know why, but when we get to this point, bounds is not guaranteed to have been instantiated...</pre></td></tr>
<tr><td class='line'>468</td><td><pre>		// perhaps a processing.js bug, perhaps an inherent feature. Don't know, easy to work around.</pre></td></tr>
<tr><td class='line'>469</td><td><pre>		bounds = new BoundingBox(min(x1,x2), min(y1,y2), max(x1,x2), max(y1,y2));</pre></td></tr>
<tr><td class='line'>470</td><td><pre></pre></td></tr>
<tr><td class='line'>471</td><td><pre>		//</pre></td></tr>
<tr><td class='line'>472</td><td><pre>		//	The next bit is technical. See the comment on this topic on</pre></td></tr>
<tr><td class='line'>473</td><td><pre>		//	http://newsgroups.derkeiler.com/Archive/Comp/comp.graphics.algorithms/2005-07/msg00334.html</pre></td></tr>
<tr><td class='line'>474</td><td><pre>		//	and the worked out mathematics at http://pomax.nihongoresources.com/downloads/bezierbounds.html</pre></td></tr>
<tr><td class='line'>475</td><td><pre>		//	for an explanation of why the following code is being used, and why it works.</pre></td></tr>
<tr><td class='line'>476</td><td><pre>		//</pre></td></tr>
<tr><td class='line'>477</td><td><pre></pre></td></tr>
<tr><td class='line'>478</td><td><pre>		double dcx0 = (double) (cx1-x1);</pre></td></tr>
<tr><td class='line'>479</td><td><pre>		double dcy0 = (double) (cy1-y1);</pre></td></tr>
<tr><td class='line'>480</td><td><pre>		double dcx1 = (double) (cx2 - cx1);</pre></td></tr>
<tr><td class='line'>481</td><td><pre>		double dcy1 = (double) (cy2 - cy1);</pre></td></tr>
<tr><td class='line'>482</td><td><pre>		double dcx2 = (double) (x2 - cx2);</pre></td></tr>
<tr><td class='line'>483</td><td><pre>		double dcy2 = (double) (y2 - cy2);</pre></td></tr>
<tr><td class='line'>484</td><td><pre></pre></td></tr>
<tr><td class='line'>485</td><td><pre>		// recompute bounds projected on the x-axis, if the control points lie outside the bounding box x-bounds</pre></td></tr>
<tr><td class='line'>486</td><td><pre>		if(!bounds.inBoundsX(cx1) || !bounds.inBoundsX(cx2)) {</pre></td></tr>
<tr><td class='line'>487</td><td><pre>			double a = dcx0;</pre></td></tr>
<tr><td class='line'>488</td><td><pre>			double b = dcx1;</pre></td></tr>
<tr><td class='line'>489</td><td><pre>			double c = dcx2;</pre></td></tr>
<tr><td class='line'>490</td><td><pre></pre></td></tr>
<tr><td class='line'>491</td><td><pre>			// Do we have a problematic discriminator if we use these values?</pre></td></tr>
<tr><td class='line'>492</td><td><pre>			// If we do, because we're computing at sub-pixel level anyway, simply salt 'b' a tiny bit.</pre></td></tr>
<tr><td class='line'>493</td><td><pre>			if(a+c != 2*b) { b+=0.01; }</pre></td></tr>
<tr><td class='line'>494</td><td><pre></pre></td></tr>
<tr><td class='line'>495</td><td><pre>			double numerator = 2*(a - b);</pre></td></tr>
<tr><td class='line'>496</td><td><pre>			double denominator = 2*(a - 2*b + c);</pre></td></tr>
<tr><td class='line'>497</td><td><pre>			double doubleroot = (2*b-2*a)*(2*b-2*a) - 2*a*denominator;</pre></td></tr>
<tr><td class='line'>498</td><td><pre>			double root = sqrt((float)doubleroot);</pre></td></tr>
<tr><td class='line'>499</td><td><pre></pre></td></tr>
<tr><td class='line'>500</td><td><pre>			// there are two possible values for t that yield inflection points</pre></td></tr>
<tr><td class='line'>501</td><td><pre>			double t1 =  (numerator + root) / denominator;</pre></td></tr>
<tr><td class='line'>502</td><td><pre>			double t2 =  (numerator - root) / denominator;</pre></td></tr>
<tr><td class='line'>503</td><td><pre></pre></td></tr>
<tr><td class='line'>504</td><td><pre>			// so, which of these is the useful point? (t must lie in [0,1])</pre></td></tr>
<tr><td class='line'>505</td><td><pre>			if(0&lt;=t1 &amp;&amp; t1&lt;=1) {</pre></td></tr>
<tr><td class='line'>506</td><td><pre>				double inflectionpoint = evaluateX(t1);</pre></td></tr>
<tr><td class='line'>507</td><td><pre>				if(inflectionpoint&gt;=0) {</pre></td></tr>
<tr><td class='line'>508</td><td><pre>					if(bounds.getMinX() &gt; inflectionpoint) { bounds.setMinX((int)inflectionpoint); }</pre></td></tr>
<tr><td class='line'>509</td><td><pre>					else if(bounds.getMaxX() &lt; inflectionpoint) { bounds.setMaxX((int)inflectionpoint); }}}</pre></td></tr>
<tr><td class='line'>510</td><td><pre>			if(0&lt;=t2 &amp;&amp; t2&lt;=1) {</pre></td></tr>
<tr><td class='line'>511</td><td><pre>				double inflectionpoint = evaluateX(t2);</pre></td></tr>
<tr><td class='line'>512</td><td><pre>				if(inflectionpoint&gt;=0) {</pre></td></tr>
<tr><td class='line'>513</td><td><pre>					if(bounds.getMinX() &gt; inflectionpoint) { bounds.setMinX((int)inflectionpoint); }</pre></td></tr>
<tr><td class='line'>514</td><td><pre>					else if(bounds.getMaxX() &lt; inflectionpoint) { bounds.setMaxX((int)inflectionpoint); }}}</pre></td></tr>
<tr><td class='line'>515</td><td><pre>		}</pre></td></tr>
<tr><td class='line'>516</td><td><pre></pre></td></tr>
<tr><td class='line'>517</td><td><pre>		// recompute bounds projected on the y-axis, if the control points lie outside the bounding box y-bounds</pre></td></tr>
<tr><td class='line'>518</td><td><pre>		// no comments, because it's virtually identical code. Kept as duplicate, though, to emphasise that we have</pre></td></tr>
<tr><td class='line'>519</td><td><pre>		// to do this for the x-axis and y-axis separately.</pre></td></tr>
<tr><td class='line'>520</td><td><pre>		if(!bounds.inBoundsY(cy1) || !bounds.inBoundsY(cy2)) {</pre></td></tr>
<tr><td class='line'>521</td><td><pre>			double a = dcy0;</pre></td></tr>
<tr><td class='line'>522</td><td><pre>			double b = dcy1;</pre></td></tr>
<tr><td class='line'>523</td><td><pre>			double c = dcy2;</pre></td></tr>
<tr><td class='line'>524</td><td><pre>			if(a+c != 2*b) { b+=0.01; }</pre></td></tr>
<tr><td class='line'>525</td><td><pre>			double numerator = 2*(a - b);</pre></td></tr>
<tr><td class='line'>526</td><td><pre>			double denominator = 2*(a - 2*b + c);</pre></td></tr>
<tr><td class='line'>527</td><td><pre>			double doubleroot = (2*b-2*a)*(2*b-2*a) - 2*a*denominator;</pre></td></tr>
<tr><td class='line'>528</td><td><pre>			double root = sqrt((float)doubleroot);</pre></td></tr>
<tr><td class='line'>529</td><td><pre>			double t1 =  (numerator + root) / denominator;</pre></td></tr>
<tr><td class='line'>530</td><td><pre>			double t2 =  (numerator - root) / denominator;</pre></td></tr>
<tr><td class='line'>531</td><td><pre>			if(0&lt;=t1 &amp;&amp; t1&lt;=1) {</pre></td></tr>
<tr><td class='line'>532</td><td><pre>				double inflectionpoint = evaluateY(t1);</pre></td></tr>
<tr><td class='line'>533</td><td><pre>				if(inflectionpoint&gt;=0) {</pre></td></tr>
<tr><td class='line'>534</td><td><pre>					if(bounds.getMinY() &gt; inflectionpoint) { bounds.setMinY((int)inflectionpoint); }</pre></td></tr>
<tr><td class='line'>535</td><td><pre>					else if(bounds.getMaxY() &lt; inflectionpoint) { bounds.setMaxY((int)inflectionpoint); }}}</pre></td></tr>
<tr><td class='line'>536</td><td><pre>			if(0&lt;=t2 &amp;&amp; t2&lt;=1) {</pre></td></tr>
<tr><td class='line'>537</td><td><pre>				double inflectionpoint = evaluateY(t2);</pre></td></tr>
<tr><td class='line'>538</td><td><pre>				if(inflectionpoint&gt;=0) {</pre></td></tr>
<tr><td class='line'>539</td><td><pre>					if(bounds.getMinY() &gt; inflectionpoint) { bounds.setMinY((int)inflectionpoint); }</pre></td></tr>
<tr><td class='line'>540</td><td><pre>					else if(bounds.getMaxY() &lt; inflectionpoint) { bounds.setMaxY((int)inflectionpoint); }}}</pre></td></tr>
<tr><td class='line'>541</td><td><pre>		}</pre></td></tr>
<tr><td class='line'>542</td><td><pre>	}</pre></td></tr>
<tr><td class='line'>543</td><td><pre>	// evaluates the x-projection of the bezier curve for parameter t</pre></td></tr>
<tr><td class='line'>544</td><td><pre>	double evaluateX(double t) {</pre></td></tr>
<tr><td class='line'>545</td><td><pre>		double it = (1-t);</pre></td></tr>
<tr><td class='line'>546</td><td><pre>		return ((double)x*it*it*it + 3.0*(double)cx1*t*it*it + 3.0*(double)cx2*it*t*t + (double)x2*t*t*t); }</pre></td></tr>
<tr><td class='line'>547</td><td><pre></pre></td></tr>
<tr><td class='line'>548</td><td><pre>	// evaluates the y-projection of the bezier curve for parameter t</pre></td></tr>
<tr><td class='line'>549</td><td><pre>	double evaluateY(double t) {</pre></td></tr>
<tr><td class='line'>550</td><td><pre>		double it = (1-t);</pre></td></tr>
<tr><td class='line'>551</td><td><pre>		return ((double)y*it*it*it + 3.0*(double)cy1*t*it*it + 3.0*(double)cy2*it*t*t + (double)y2*t*t*t); }</pre></td></tr>
<tr><td class='line'>552</td><td><pre>		</pre></td></tr>
<tr><td class='line'>553</td><td><pre>	// override - instead of drawing a straight line, we draw the bezier curve</pre></td></tr>
<tr><td class='line'>554</td><td><pre>	void drawLine() { bezier(x+xoffset,y+yoffset, cx1+xoffset,cy1+yoffset, cx2+xoffset,cy2+yoffset, x2+xoffset,y2+yoffset); }</pre></td></tr>
<tr><td class='line'>555</td><td><pre></pre></td></tr>
<tr><td class='line'>556</td><td><pre>	// override on move, because not only do we have to move our start and end point, but also our</pre></td></tr>
<tr><td class='line'>557</td><td><pre>	// bezier control points.</pre></td></tr>
<tr><td class='line'>558</td><td><pre>	void move(int dx, int dy) {</pre></td></tr>
<tr><td class='line'>559</td><td><pre>		super.move(dx,dy);</pre></td></tr>
<tr><td class='line'>560</td><td><pre>		this.cx1 += dx;</pre></td></tr>
<tr><td class='line'>561</td><td><pre>		this.cy1 += dy;</pre></td></tr>
<tr><td class='line'>562</td><td><pre>		this.cx2 += dx;</pre></td></tr>
<tr><td class='line'>563</td><td><pre>		this.cy2 += dy; }</pre></td></tr>
<tr><td class='line'>564</td><td><pre></pre></td></tr>
<tr><td class='line'>565</td><td><pre>	// run through the bezier parametric curve and see if we pass the provided coordinate.</pre></td></tr>
<tr><td class='line'>566</td><td><pre>	// this check can be optimised by setting the step size for t based on what the bezier</pre></td></tr>
<tr><td class='line'>567</td><td><pre>	// parameters in the constructor are. however, for simplicity (right now), we simply use</pre></td></tr>
<tr><td class='line'>568</td><td><pre>	// step 1/100 so we'll probably always catch any mouseover</pre></td></tr>
<tr><td class='line'>569</td><td><pre>	boolean onLine(int x, int y) {</pre></td></tr>
<tr><td class='line'>570</td><td><pre>		for(double t=0.0; t&lt;=1.0; t+=0.01) {</pre></td></tr>
<tr><td class='line'>571</td><td><pre>			int ftx = (int) evaluateX(t);</pre></td></tr>
<tr><td class='line'>572</td><td><pre>			int fty = (int) evaluateY(t);</pre></td></tr>
<tr><td class='line'>573</td><td><pre>			if(abs(ftx-x)&lt;=bounding_thickness &amp;&amp; abs(fty-y)&lt;=bounding_thickness) { return true; }}</pre></td></tr>
<tr><td class='line'>574</td><td><pre>		return false; }</pre></td></tr>
<tr><td class='line'>575</td><td><pre>}</pre></td></tr>
</table>

<h3>Extended components</h3>

	<p>Just primitives only get us so far, so in this framework there are also two extra, extended components: The
	Panel, and the Button.</p>
	
	<h4>Panels</h4>
	
		<p>Panels allow us to define a region on the screen, and place components relative to that region. For example,
		if we define a 200x200 region of the screen, with its top-left corner at 150x250, then we can add a component
		to the panel docked nicely to the upper-left corner by giving the component coordinates 0x0, rather than
		coordinates 150x250. This is really useful! The code for this is not very complicated:</p>
		
		<div><span style='cursor: pointer;' class='codediv' onclick="toggle('Panel_code')">&nbsp;toggle code&nbsp;</span></div>
<table class='code' id='Panel_code' style='display: none;'>
<tr><td class='line cls'>351</td><td><pre>class Panel extends Rect</pre></td></tr>
<tr><td class='line'>352</td><td><pre>{</pre></td></tr>
<tr><td class='line'>353</td><td><pre>	Components components;</pre></td></tr>
<tr><td class='line'>354</td><td><pre>	Component focussed = null;</pre></td></tr>
<tr><td class='line'>355</td><td><pre>	Panel(int x, int y, int w, int h) {</pre></td></tr>
<tr><td class='line'>356</td><td><pre>		super(x,y,w,h);</pre></td></tr>
<tr><td class='line'>357</td><td><pre>		components = new Components();</pre></td></tr>
<tr><td class='line'>358</td><td><pre>		setStroke(0,0,0,0);</pre></td></tr>
<tr><td class='line'>359</td><td><pre>		setFill(255,255,255,255); }</pre></td></tr>
<tr><td class='line'>360</td><td><pre>	// panels don't have a stroke, only a background color</pre></td></tr>
<tr><td class='line'>361</td><td><pre>	void setBackground(int r, int g, int b) { setFill(r,g,b,255); }</pre></td></tr>
<tr><td class='line'>362</td><td><pre>	void add(Component component) {</pre></td></tr>
<tr><td class='line'>363</td><td><pre>		component.setOffsets(x+xoffset,y+yoffset);</pre></td></tr>
<tr><td class='line'>364</td><td><pre>		components.add(component); }</pre></td></tr>
<tr><td class='line'>365</td><td><pre>	void setDebug(boolean debug) { components.setDebug(debug); }</pre></td></tr>
<tr><td class='line'>366</td><td><pre>	Component get(int index) { return (Component) components.get(index); }</pre></td></tr>
<tr><td class='line'>367</td><td><pre>	int size() { return components.size(); }</pre></td></tr>
<tr><td class='line'>368</td><td><pre>	void draw(){</pre></td></tr>
<tr><td class='line'>369</td><td><pre>		super.draw();</pre></td></tr>
<tr><td class='line'>370</td><td><pre>		for(int c=0; c&lt;components.size(); c++) {</pre></td></tr>
<tr><td class='line'>371</td><td><pre>			Component component = ((Component)components.get(c));</pre></td></tr>
<tr><td class='line'>372</td><td><pre>			if (component.isVisible()) { component.draw(); }}}</pre></td></tr>
<tr><td class='line'>373</td><td><pre>	</pre></td></tr>
<tr><td class='line'>374</td><td><pre>	// movemoved events inside a canvas must be propagated to the components</pre></td></tr>
<tr><td class='line'>375</td><td><pre>	// inside the panel - note the offset corrections in the passed coordinates!</pre></td></tr>
<tr><td class='line'>376</td><td><pre>	void mouseMoved(int x, int y) {</pre></td></tr>
<tr><td class='line'>377</td><td><pre>		boolean handled = components.mouseMoved(x-(this.x+xoffset),y-(this.y+yoffset)); </pre></td></tr>
<tr><td class='line'>378</td><td><pre>		if(handled&amp;&amp;hasfocus) { setFocus(false); focusLost(); }}</pre></td></tr>
<tr><td class='line'>379</td><td><pre>	</pre></td></tr>
<tr><td class='line'>380</td><td><pre>	// generic propagation - note the offset corrections in the passed coordinates!</pre></td></tr>
<tr><td class='line'>381</td><td><pre>	void mouseClicked(int x, int y) { components.mouseClicked(x-(this.x+xoffset),y-(this.y+yoffset)); }</pre></td></tr>
<tr><td class='line'>382</td><td><pre>	void mousePressed(int x, int y) { components.mousePressed(x-(this.x+xoffset),y-(this.y+yoffset)); }</pre></td></tr>
<tr><td class='line'>383</td><td><pre>	void mouseDragged(int x, int y) { components.mouseDragged(x-(this.x+xoffset),y-(this.y+yoffset)); }</pre></td></tr>
<tr><td class='line'>384</td><td><pre>	void mouseReleased(int x, int y) { components.mouseReleased(x-(this.x+xoffset),y-(this.y+yoffset)); }</pre></td></tr>
<tr><td class='line'>385</td><td><pre>	void keyPressed(int k, int kc) { components.keyPressed(k,kc); }</pre></td></tr>
<tr><td class='line'>386</td><td><pre>	void keyReleased(int k, int kc) { components.keyReleased(k,kc); }</pre></td></tr>
<tr><td class='line'>387</td><td><pre>}</pre></td></tr>
</table>
	
	<h4>Buttons</h4>
	
		<p>Buttons are generally useful when it comes to making your code do something based on functional mouse
		events. Of course, in processing.js you can use on-page UI elements, rather than in-sketch elements, but then
		you are making your sketch impossible to load in Processing... so let's look at the button definition too:</p>

		<div><span style='cursor: pointer;' class='codediv' onclick="toggle('Button_code')">&nbsp;toggle code&nbsp;</span></div>
<table class='code' id='Button_code' style='display: none;'>
<tr><td class='line cls'>594</td><td><pre>class Button extends Component</pre></td></tr>
<tr><td class='line'>595</td><td><pre>{</pre></td></tr>
<tr><td class='line'>596</td><td><pre>	public int BUTTON_PRESSED = 0;</pre></td></tr>
<tr><td class='line'>597</td><td><pre>	public int BUTTON_UNPRESSED = 1;</pre></td></tr>
<tr><td class='line'>598</td><td><pre>	private boolean pressed = false;</pre></td></tr>
<tr><td class='line'>599</td><td><pre>	ArrayList actionlisteners = new ArrayList();</pre></td></tr>
<tr><td class='line'>600</td><td><pre>	private Drawable face;</pre></td></tr>
<tr><td class='line'>601</td><td><pre>	private String action;</pre></td></tr>
<tr><td class='line'>602</td><td><pre>	public Button(Drawable face, String action) { </pre></td></tr>
<tr><td class='line'>603</td><td><pre>		this.face=face; </pre></td></tr>
<tr><td class='line'>604</td><td><pre>		this.action=action;</pre></td></tr>
<tr><td class='line'>605</td><td><pre>		release(); }</pre></td></tr>
<tr><td class='line'>606</td><td><pre>	void draw() { face.draw(); }</pre></td></tr>
<tr><td class='line'>607</td><td><pre>	void setDebug(boolean debug) { face.setDebug(debug); }</pre></td></tr>
<tr><td class='line'>608</td><td><pre>	void setStroke(int r, int g, int b, int a) { face.setStroke(r,g,b,a); }</pre></td></tr>
<tr><td class='line'>609</td><td><pre>	void setFill(int r, int g, int b, int a) { face.setFill(r,g,b,a); }</pre></td></tr>
<tr><td class='line'>610</td><td><pre>	void setOffsets(int x, int y) { face.setOffsets(x,y); }</pre></td></tr>
<tr><td class='line'>611</td><td><pre>	// standard getter/setters</pre></td></tr>
<tr><td class='line'>612</td><td><pre>	int getX() { return face.getX(); }</pre></td></tr>
<tr><td class='line'>613</td><td><pre>	int getY() { return face.getY(); }</pre></td></tr>
<tr><td class='line'>614</td><td><pre>	void setX(int v) { face.setX(v); }</pre></td></tr>
<tr><td class='line'>615</td><td><pre>	void setY(int v) { face.setY(v); }</pre></td></tr>
<tr><td class='line'>616</td><td><pre>	BoundingBox getBoundingBox() { return face.getBoundingBox(); }</pre></td></tr>
<tr><td class='line'>617</td><td><pre>	void move(int dx, int dy) { if(face!=null) { face.move(dx,dy); }}</pre></td></tr>
<tr><td class='line'>618</td><td><pre>	// superancestral methods for determining whether focus and events should propagate</pre></td></tr>
<tr><td class='line'>619</td><td><pre>	boolean listensAt(int x, int y) { return face.listensAt(x,y); }</pre></td></tr>
<tr><td class='line'>620</td><td><pre>	boolean inArea(int x, int y) { return face.inArea(x,y); }</pre></td></tr>
<tr><td class='line'>621</td><td><pre>	// getter</pre></td></tr>
<tr><td class='line'>622</td><td><pre>	Drawable getFace() { return face; }</pre></td></tr>
<tr><td class='line'>623</td><td><pre>	// action listeners</pre></td></tr>
<tr><td class='line'>624</td><td><pre>	void addActionListener(Component c) { actionlisteners.add(c); }</pre></td></tr>
<tr><td class='line'>625</td><td><pre>	String getActionString() { return action; }</pre></td></tr>
<tr><td class='line'>626</td><td><pre>	// coloring</pre></td></tr>
<tr><td class='line'>627</td><td><pre>	void setNormalColors() { setStroke(0,0,0,255); setFill(255,255,255,255); }</pre></td></tr>
<tr><td class='line'>628</td><td><pre>	void setMouseoverColors() { setStroke(255,0,175,255); }</pre></td></tr>
<tr><td class='line'>629</td><td><pre>	void setClickedColors() { setStroke(0,0,0,255); setFill(200,200,255,255); }</pre></td></tr>
<tr><td class='line'>630</td><td><pre>	// button has been pressed</pre></td></tr>
<tr><td class='line'>631</td><td><pre>	void press() {</pre></td></tr>
<tr><td class='line'>632</td><td><pre>		pressed = true;</pre></td></tr>
<tr><td class='line'>633</td><td><pre>		setClickedColors();</pre></td></tr>
<tr><td class='line'>634</td><td><pre>		for(int a=0; a&lt;actionlisteners.size(); a++) {</pre></td></tr>
<tr><td class='line'>635</td><td><pre>			((Component)actionlisteners.get(a)).actionPerformed(this, BUTTON_PRESSED, action); }}</pre></td></tr>
<tr><td class='line'>636</td><td><pre>	// button has been released</pre></td></tr>
<tr><td class='line'>637</td><td><pre>	void release() {</pre></td></tr>
<tr><td class='line'>638</td><td><pre>		pressed = false;</pre></td></tr>
<tr><td class='line'>639</td><td><pre>		setNormalColors();</pre></td></tr>
<tr><td class='line'>640</td><td><pre>		for(int a=0; a&lt;actionlisteners.size(); a++) {</pre></td></tr>
<tr><td class='line'>641</td><td><pre>			((Component)actionlisteners.get(a)).actionPerformed(this, BUTTON_UNPRESSED, action); }}</pre></td></tr>
<tr><td class='line'>642</td><td><pre>	// state check</pre></td></tr>
<tr><td class='line'>643</td><td><pre>	boolean isPressed() { return pressed; }</pre></td></tr>
<tr><td class='line'>644</td><td><pre>	// mouse handler for clicking on the button</pre></td></tr>
<tr><td class='line'>645</td><td><pre>	void mousePressed(int x, int y) { if(pressed) { release(); } else { press(); }}</pre></td></tr>
<tr><td class='line'>646</td><td><pre>	// what to do when focus is lost</pre></td></tr>
<tr><td class='line'>647</td><td><pre>	void focusLost() {</pre></td></tr>
<tr><td class='line'>648</td><td><pre>		if(pressed) { setClickedColors(); }</pre></td></tr>
<tr><td class='line'>649</td><td><pre>		else { setNormalColors(); }}</pre></td></tr>
<tr><td class='line'>650</td><td><pre>	// what to do when focus is granted</pre></td></tr>
<tr><td class='line'>651</td><td><pre>	void focusReceived() { setMouseoverColors(); }</pre></td></tr>
<tr><td class='line'>652</td><td><pre>}</pre></td></tr>
</table>
		
		<p>In order for a button to trigger functionality in another Component, that component needs to have been
		added as a listener to the button, using <span style="font-family: monospaced">button.addActionListener(component)</span>.
		This will then automatically make the button trigger the component's <span style="font-family: monospaced">actionPerformed(source, action)</span>
		method, with the "source" being the button, and "action" being an action string as defined by the button, for switch running.</p>

<h3>Putting it together</h3>

	<p>Let's look at a practical example - A panel with lots of clickable "buttons". For the purpose of this
	exercise, we'll use rect, ellipse, circle and bezier buttons. First off, the code we'll use in our initUI():</p>

	<div><span style='cursor: pointer;' class='codediv' onclick="toggle('initui_code')">&nbsp;toggle code&nbsp;</span></div>
<table class='code' id='initui_code' style='display: none;'>
<tr><td class='line'>738</td><td><pre>void initUI()</pre></td></tr>
<tr><td class='line'>739</td><td><pre>{</pre></td></tr>
<tr><td class='line'>740</td><td><pre>	// make a 400x400 panel, placed at {100, 100}</pre></td></tr>
<tr><td class='line'>741</td><td><pre>	RandomColorPanel randomcolorpanel = new RandomColorPanel(100,550,400,25);</pre></td></tr>
<tr><td class='line'>742</td><td><pre>	MainPanel mainpanel = new MainPanel(100,100,400,400);</pre></td></tr>
<tr><td class='line'>743</td><td><pre></pre></td></tr>
<tr><td class='line'>744</td><td><pre>	int howmanyofeach=10;</pre></td></tr>
<tr><td class='line'>745</td><td><pre></pre></td></tr>
<tr><td class='line'>746</td><td><pre>	// make a couple of (almost) randomly placed 25x25 buttons, inside the panel.</pre></td></tr>
<tr><td class='line'>747</td><td><pre>	for(int i=0; i&lt;howmanyofeach; i++) {</pre></td></tr>
<tr><td class='line'>748</td><td><pre>		RectButton button = new RectButton((int)random(0,300)+25,(int)random(0,300)+25,25,25, &quot;rectangle&quot;);</pre></td></tr>
<tr><td class='line'>749</td><td><pre>		button.addActionListener(randomcolorpanel);</pre></td></tr>
<tr><td class='line'>750</td><td><pre>		mainpanel.add(button); }</pre></td></tr>
<tr><td class='line'>751</td><td><pre></pre></td></tr>
<tr><td class='line'>752</td><td><pre>	// make a couple of (almost) randomly placed 13px radius circle buttons, inside the panel.</pre></td></tr>
<tr><td class='line'>753</td><td><pre>	for(int i=0; i&lt;howmanyofeach; i++) {</pre></td></tr>
<tr><td class='line'>754</td><td><pre>		CircleButton button = new CircleButton((int)random(0,300)+25,(int)random(0,300)+25,13, &quot;circle&quot;);</pre></td></tr>
<tr><td class='line'>755</td><td><pre>		button.addActionListener(randomcolorpanel);</pre></td></tr>
<tr><td class='line'>756</td><td><pre>		mainpanel.add(button); }</pre></td></tr>
<tr><td class='line'>757</td><td><pre>	</pre></td></tr>
<tr><td class='line'>758</td><td><pre>	// make a couple of almost randomly placed randomly bulged ellipse buttons, too.</pre></td></tr>
<tr><td class='line'>759</td><td><pre>	for(int i=0; i&lt;howmanyofeach; i++) {</pre></td></tr>
<tr><td class='line'>760</td><td><pre>		EllipseButton button = new EllipseButton((int)random(0,300)+25,(int)random(0,300)+25,(int)random(10,30), (int)random(10,30), &quot;ellipse&quot;);</pre></td></tr>
<tr><td class='line'>761</td><td><pre>		button.addActionListener(randomcolorpanel);</pre></td></tr>
<tr><td class='line'>762</td><td><pre>		mainpanel.add(button); }</pre></td></tr>
<tr><td class='line'>763</td><td><pre>	</pre></td></tr>
<tr><td class='line'>764</td><td><pre>	// and finally, make a couple of randomly curved clickable bezier curves, in a pretty configuration</pre></td></tr>
<tr><td class='line'>765</td><td><pre>	for(int i=0; i&lt;howmanyofeach; i++) {</pre></td></tr>
<tr><td class='line'>766</td><td><pre>		BezierLineButton button = new BezierLineButton(0,0,</pre></td></tr>
<tr><td class='line'>767</td><td><pre>											(int)random(100,400),(int)random(100,400),</pre></td></tr>
<tr><td class='line'>768</td><td><pre>											(int)random(-200,600),(int)random(-200,600),</pre></td></tr>
<tr><td class='line'>769</td><td><pre>											380,380,</pre></td></tr>
<tr><td class='line'>770</td><td><pre>											&quot;bezier line&quot;);</pre></td></tr>
<tr><td class='line'>771</td><td><pre>		button.addActionListener(randomcolorpanel);</pre></td></tr>
<tr><td class='line'>772</td><td><pre>		mainpanel.add(button); }	</pre></td></tr>
<tr><td class='line'>773</td><td><pre>	</pre></td></tr>
<tr><td class='line'>774</td><td><pre>	// add panel to components, and we're done</pre></td></tr>
<tr><td class='line'>775</td><td><pre>	components.add(mainpanel);</pre></td></tr>
<tr><td class='line'>776</td><td><pre>	components.add(randomcolorpanel);</pre></td></tr>
<tr><td class='line'>777</td><td><pre>}</pre></td></tr>
</table>

	<p>And then the code that actually defines our custom clickable panel, and the button objects we will be using.</p>

	<p>We want our main panel to be a dull grey that changes to white when it has focus, changing to blue when it is
	clicked. We want our buttons white with a black stroke, unless they receive focus, in which case their stroke should
	be pink. A pressed button is a dull blue-grey. Bezier curve "buttons" are black, unless they have focus, in which
	case they're pink, or they've been pressed, in which case they're dull blue-grey. Finally, we also want an extra
	"nonsense" panel below our main panel, and we want it to change to a random colour every time any button is
	clicked, but not when the main panel is clicked.</p>

	<div><span style='cursor: pointer;' class='codediv' onclick="toggle('EXAMPLECODE_code')">&nbsp;toggle code&nbsp;</span></div>
<table class='code' id='EXAMPLECODE_code' style='display: none;'>
<tr><td class='line cls'>658</td><td><pre>class RandomColorPanel extends Panel {</pre></td></tr>
<tr><td class='line'>659</td><td><pre>	RandomColorPanel(int x, int y, int w, int h) { </pre></td></tr>
<tr><td class='line'>660</td><td><pre>		super(x,y,w,h); </pre></td></tr>
<tr><td class='line'>661</td><td><pre>		colorBackground();}</pre></td></tr>
<tr><td class='line'>662</td><td><pre>	void colorBackground() {</pre></td></tr>
<tr><td class='line'>663</td><td><pre>		setBackground((int)random(255),(int)random(255),(int)random(255)); }</pre></td></tr>
<tr><td class='line'>664</td><td><pre>	// when something notifies us that an action occured, change color</pre></td></tr>
<tr><td class='line'>665</td><td><pre>	void actionPerformed(Component source, int event, String action) { colorBackground(); }</pre></td></tr>
<tr><td class='line'>666</td><td><pre>}</pre></td></tr>
<tr><td class='line'>667</td><td><pre></pre></td></tr>
<tr><td class='line cls'>668</td><td><pre>class MainPanel extends Panel {</pre></td></tr>
<tr><td class='line'>669</td><td><pre>	MainPanel(int x, int y, int w, int h) { super(x,y,w,h); setBackground(230,230,230);}</pre></td></tr>
<tr><td class='line'>670</td><td><pre>	void focusLost() { setBackground(230,230,230); }</pre></td></tr>
<tr><td class='line'>671</td><td><pre>	void focusReceived() { setBackground(255,255,255); }</pre></td></tr>
<tr><td class='line'>672</td><td><pre>	void mousePressed(int x, int y) { </pre></td></tr>
<tr><td class='line'>673</td><td><pre>		if(hasFocus()) { setBackground(100,200,255); }</pre></td></tr>
<tr><td class='line'>674</td><td><pre>		super.mousePressed(x,y); }</pre></td></tr>
<tr><td class='line'>675</td><td><pre>	void mouseReleased(int x, int y) { </pre></td></tr>
<tr><td class='line'>676</td><td><pre>		if(hasFocus()) { setBackground(255,255,255); }</pre></td></tr>
<tr><td class='line'>677</td><td><pre>		super.mouseReleased(x,y); }</pre></td></tr>
<tr><td class='line'>678</td><td><pre>}</pre></td></tr>
<tr><td class='line'>679</td><td><pre></pre></td></tr>
<tr><td class='line cls'>680</td><td><pre>class RectButton extends Button {</pre></td></tr>
<tr><td class='line'>681</td><td><pre>	RectButton(int x, int y, int w, int h, String action) {</pre></td></tr>
<tr><td class='line'>682</td><td><pre>		super(new Rect(x,y,w,h), action); }}</pre></td></tr>
<tr><td class='line'>683</td><td><pre></pre></td></tr>
<tr><td class='line cls'>684</td><td><pre>class EllipseButton extends Button {</pre></td></tr>
<tr><td class='line'>685</td><td><pre>	EllipseButton(int x, int y, int r1, int r2, String action) {</pre></td></tr>
<tr><td class='line'>686</td><td><pre>		super(new Ellipse(x,y,r1,r2), action); }}</pre></td></tr>
<tr><td class='line'>687</td><td><pre></pre></td></tr>
<tr><td class='line cls'>688</td><td><pre>class CircleButton extends Button {</pre></td></tr>
<tr><td class='line'>689</td><td><pre>	CircleButton(int x, int y, int r, String action) {</pre></td></tr>
<tr><td class='line'>690</td><td><pre>		super(new Circle(x,y,r), action); }}</pre></td></tr>
<tr><td class='line'>691</td><td><pre></pre></td></tr>
<tr><td class='line cls'>692</td><td><pre>class BezierLineButton extends Button {</pre></td></tr>
<tr><td class='line'>693</td><td><pre>	BezierLineButton(int x1, int y1, int cx1, int cy1, int cx2, int cy2, int x2, int y2, String action) {</pre></td></tr>
<tr><td class='line'>694</td><td><pre>		super(new Bezier(x1,y1,cx1,cy1,cx2,cy2,x2,y2), action); }</pre></td></tr>
<tr><td class='line'>695</td><td><pre>	void setNormalColors() { setStroke(0,0,0,255); setFill(0,0,0,0); }</pre></td></tr>
<tr><td class='line'>696</td><td><pre>	void setMouseoverColors() { setStroke(255,0,175,255); setFill(0,0,0,0); }</pre></td></tr>
<tr><td class='line'>697</td><td><pre>	void setClickedColors() { setStroke(150,150,255,255); setFill(0,0,0,0); }}</pre></td></tr>
</table>

<h3>So... what does this sketch look like?</h3>

	<p>I'll let you come up with a name for this sketch yourself, but my associations are marine biology inspired...</p>

	<canvas style="background-color: #FFF; margin-left: 2em; border: 1px solid black; width:600px; height:600px; " datasrc="framework.pde"></canvas>

	<p>Note that the big white border is actually still part of the sketch - the sketch itself takes up 600x600 pixels, but
	the panel with content is only 400x400, and placed at an offset of 100x100. Note that the bezier curves may be bigger
	than the main panel, so they'll be drawn "outside" what you might think is the drawing surface!</p>

<h3>Get the code</h3>

	<p>To save you some copy/paste work, click <a href="framework.pde" target="_blank">here</a> to download the complete source code file!</p>
</body>
</html>