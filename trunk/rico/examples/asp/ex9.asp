<%@ LANGUAGE="VBSCRIPT" %>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<html>
<head>
<title>Rico LiveGrid Plus-Example 9</title>

<!-- #INCLUDE FILE = "chklang.vbs" --> 
<!-- #INCLUDE FILE = "settings.vbs" --> 

<script src="../../src/rico.js" type="text/javascript"></script>
<link href="../client/css/demo.css" type="text/css" rel="stylesheet" />
<script type='text/javascript'>
Rico.loadModule('LiveGridAjax');
Rico.loadModule('LiveGridMenu');
<%
setStyle
setLang
%>

var weatherGrid, weatherBuffer;

Rico.onLoad( function() {
  var opts = {  
    <% GridSettingsScript %>,
    specTemp      : {type:'number', decPlaces:0, ClassName:'alignright', suffix:'&deg;C'},
    columnSpecs   : [,,,,,'specTemp','specTemp','specTemp']
  };
  var flag=$('flag').getElementsByTagName('IMG')[0];
  if (flag) {
    if (flag.src.match(/\/([A-Z]+)-flag.gif/)) {
      var country=RegExp.$1;
      //alert(country);
    }
  }
  weatherBuffer=new Rico.Buffer.AjaxXML('../php/yahooWeather.php', {requestParameters:['c='+country], acceptAttr:['style']});
  weatherGrid=new Rico.LiveGrid ('weathergrid', weatherBuffer, opts);
  weatherGrid.menu=new Rico.GridMenu(<% GridSettingsMenu %>);
});
</script>

</head>

<body>
<table border='0'><tr><td id='flag'>
<script language="Javascript" src="http://map.geoup.com/geoup?template=flag"></script>
</td><td>
<!-- #INCLUDE FILE = "menu.vbs" --> 
</td></tr></table>

<table id='explanation' border='0' cellpadding='0' cellspacing='5' style='clear:both'><tr valign='top'><td>
<%  GridSettingsForm %>
</td><td>The flag above is generated by <a href='http://www.geobytes.com/'>geobytes.com</a> based on your IP address.
<a href='../php/yahooWeather.php'>yahooWeather.php</a> is used as a proxy to gather data from <a href='http://weather.yahoo.com/'>Yahoo Weather</a>.
The weather data is delivered to the client via AJAX. 
During the AJAX request, any cities in the list that match the flag are highlighted in yellow and any freezing temperatures are colored blue.
Note that these styles are passed back in the AJAX response and incorporated into the grid dynamically.
</td></tr></table>

<p class="ricoBookmark"><span id="weathergrid_bookmark">&nbsp;</span></p>
<table id="weathergrid" class="ricoLiveGrid" cellspacing="0" cellpadding="0">
<colgroup>
<col style='width:120px;' >
<col style='width:200px;' >
<col style='width:70px;'>
<col style='width:70px;' >
<col style='width:150px;' >
<col style='width:50px;'>
<col style='width:50px;'>
<col style='width:50px;'>
<col style='width:150px;'>
<col style='width:60px;'>
</colgroup>
  <tr>
	  <th>City</th>
	  <th>As of</th>
	  <th>Sunrise</th>
	  <th>Sunset</th>
	  <th>Currently</th>
	  <th>Temp</th>
	  <th>Low</th>
	  <th>High</th>
	  <th>Forecast</th>
	  <th>Source</th>
  </tr>
</table>
<!--
<textarea id='weathergrid_debugmsgs' rows='5' cols='80'></textarea>
-->
</body>
</html>

