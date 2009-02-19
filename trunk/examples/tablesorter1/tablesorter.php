<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<style type="text/css">@import "default.css";</style>
	<script type="text/javascript" src="../../jquery/jquery.js"></script>
	<script type="text/javascript" src="../../jquery/jquery.tablesorter.js"></script>

	<script>
	$(function() {
		$("#simple").tableSorter();
		
		$("#simple-init-sort").tableSorter({
			sortColumn: 'name'	// Integer or String of the name of the column to sort by.  
		});

		$("#styling").tableSorter({
			sortColumn: 'name',					// Integer or String of the name of the column to sort by.  
			sortClassAsc: 'headerSortUp', 		// class name for ascending sorting action to header
			sortClassDesc: 'headerSortDown',	// class name for descending sorting action to header
			headerClass: 'header' 				// class name for headers (th's)
		});
		
		$("#styling-cutom-striping").tableSorter({
			sortColumn: 'name',					// Integer or String of the name of the column to sort by.  
			sortClassAsc: 'headerSortUp', 		// class name for ascending sorting action to header
			sortClassDesc: 'headerSortDown', 	// class name for descending sorting action to header
			headerClass: 'header', 				// class name for headers (th's)
			stripingRowClass: ['even','odd'],	// class names for striping supplyed as a array.
			stripeRowsOnStartUp: true
		});
		
		$("#styling-cutom-highlighting").tableSorter({
			sortColumn: 'name',					// Integer or String of the name of the column to sort by.
			sortClassAsc: 'headerSortUp',		// Class name for ascending sorting action to header
			sortClassDesc: 'headerSortDown',	// Class name for descending sorting action to header
			highlightClass: 'highlight', 		// class name for sort column highlighting.
			headerClass: 'header'				// Class name for headers (th's)
			
		});
		
		$("#date-uk").tableSorter({
			sortColumn: 'name',			// Integer or String of the name of the column to sort by.
			sortClassAsc: 'headerSortUp',		// Class name for ascending sorting action to header
			sortClassDesc: 'headerSortDown',	// Class name for descending sorting action to header
			headerClass: 'header',			// Class name for headers (th's)
			dateFormat: 'dd/mm/yyyy' 		// set date format for non iso dates default us, in this case override and set uk-format
		});
	});
	</script>
</head>

<body>
<h1>Simple tableSorter</h1>
<h4>Addes a simpel tableSorter with the default properties. Click on the header to start sorting.</h4>

<h3>Code:</h3>

<pre>
&lt;script&gt;
$(document).ready(function() {
	$(#simple).tableSorter();
});
&lt;/script&gt;
</pre>

<h3>Demo:</h3>	
<table id="simple">
	<thead>
		<tr>
			<th>Name</th>

			<th>Age</th>
			<th>Total purchase</th>
			<th>Email</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>

		<tr>
			<td>Peter</td>
			<td>28</td>
			<td>$9.99</td>
			<td>peter.parker@gmail.com</td>
			<td>Jul 6, 2006 8:14 AM</td>

		</tr>
		<tr>
			<td>John</td>
			<td>32</td>
			<td>$19.99</td>
			<td>john.doe@gmail.com</td>
			<td>Dec 10, 2002 5:14 AM</td>

		</tr>
		<tr>
			<td>Clark</td>
			<td>18</td>
			<td>$15.89</td>
			<td>c.kent@gmail.com</td>
			<td>Jan 12, 2003 11:14 AM</td>

		</tr>
	</tbody>
</table>

<br/>
<br/>

<h1>Default sorting column</h1>
<h4>Make the tableSorter sort on a column on startup.</h4>

<h3>Code:</h3>
<pre>

&lt;script&gt;
$(document).ready(function() {
	$(#simple-init-sort).tableSorter({
		sortColumn: 'name'	// Integer or String of the name of the column to sort by.  
	});
});
&lt;/script&gt;
</pre>

<h3>Demo:</h3>	
<table id="simple-init-sort">
	<thead>
		<tr>
			<th>Name</th>

			<th>Age</th>
			<th>Total purchase</th>
			<th>Email</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>

		<tr>
			<td>Peter</td>
			<td>28</td>
			<td>$9.99</td>
			<td>peter.parker@gmail.com</td>
			<td>Jul 6, 2006 8:14 AM</td>

		</tr>
		<tr>
			<td>John</td>
			<td>32</td>
			<td>$19.99</td>
			<td>john.doe@gmail.com</td>
			<td>Dec 10, 2002 5:14 AM</td>

		</tr>
		<tr>
			<td>Clark</td>
			<td>18</td>
			<td>$15.89</td>
			<td>c.kent@gmail.com</td>
			<td>Jan 12, 2003 11:14 AM</td>

		</tr>
	</tbody>
</table>

<br/>
<br/>
		
<h1>Styling: Adding a css styles to headers</h1>
<h4>Adds a tableSorter with custom header and sorting classes.</h4>

<h3>Code:</h3>
<pre>

&lt;script&gt;
$(document).ready(function() {
	$("#styling").tableSorter({
		sortColumn: 'name',			// Integer or String of the name of the column to sort by.
		sortClassAsc: 'headerSortUp',		// class name for ascending sorting action to header
		sortClassDesc: 'headerSortDown',	// class name for descending sorting action to header
		headerClass: 'header'			// class name for headers (th's)
	});
});
&lt;/script&gt;
</pre>

<h3>Demo:</h3>	
<table id="styling" border="0" cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>Name</th>

			<th>Age</th>
			<th>Total purchase</th>
			<th>Email</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>

		<tr>
			<td>Peter</td>
			<td>28</td>
			<td>$9.99</td>
			<td>peter.parker@gmail.com</td>
			<td>Jul 6, 2006 8:14 AM</td>

		</tr>
		<tr>
			<td>John</td>
			<td>32</td>
			<td>$19.99</td>
			<td>john.doe@gmail.com</td>
			<td>Dec 10, 2002 5:14 AM</td>

		</tr>
		<tr>
			<td>Clark</td>
			<td>18</td>
			<td>$15.89</td>
			<td>c.kent@gmail.com</td>
			<td>Jan 12, 2003 11:14 AM</td>

		</tr>
	</tbody>
</table>

<br/>
<br/>
		
<h1>Styling: Custom header style and row striping</h1>
<h4>Adds a tableSorter with custom header, sorting classes and row striping.</h4>

<h3>Code:</h3>
<pre>

&lt;script&gt;
$(document).ready(function() {
	$("#styling-cutom-striping").tableSorter({
		sortColumn: 'name',			// Integer or String of the name of the column to sort by.
		sortClassAsc: 'headerSortUp',		// Class name for ascending sorting action to header
		sortClassDesc: 'headerSortDown',	// Class name for descending sorting action to header
		headerClass: 'header',			// Class name for headers (th's)
		stripingRowClass: ['even','odd'],	// Class names for striping supplyed as a array.
		stripeRowsOnStartUp: true		// Strip rows on tableSorter init.
	});
});
&lt;/script&gt;
</pre>

<h3>Demo:</h3>	
<table id="styling-cutom-striping" border="0" cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>Name</th>

			<th>Age</th>
			<th>Total purchase</th>
			<th>Email</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>

		<tr>
			<td>Peter</td>
			<td>28</td>
			<td>$9.99</td>
			<td>peter.parker@gmail.com</td>
			<td>Jul 6, 2006 8:14 AM</td>

		</tr>
		<tr>
			<td>John</td>
			<td>32</td>
			<td>$19.99</td>
			<td>john.doe@gmail.com</td>
			<td>Dec 10, 2002 5:14 AM</td>

		</tr>
		<tr>
			<td>Clark</td>
			<td>18</td>
			<td>$15.89</td>
			<td>c.kent@gmail.com</td>
			<td>Jan 12, 2003 11:14 AM</td>

		</tr>
	</tbody>
</table>

<br/>
<br/>
		
<h1>Styling: Custom header style and sort highlighting.</h1>
<h4>Adds row striping.</h4>

<h3>Code:</h3>
<pre>

&lt;script&gt;
$(document).ready(function() {
	$("#styling-cutom-highlighting").tableSorter({
		sortColumn: 'name',			// Integer or String of the name of the column to sort by.
		sortClassAsc: 'headerSortUp',		// Class name for ascending sorting action to header
		sortClassDesc: 'headerSortDown',	// Class name for descending sorting action to header
		highlightClass: 'highlight', 		// class name for sort column highlighting.
		headerClass: 'header',			// Class name for headers (th's)
	});
});
&lt;/script&gt;
</pre>

<h3>Demo:</h3>	
<table id="styling-cutom-highlighting" border="0" cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>Name</th>

			<th>Age</th>
			<th>Total purchase</th>
			<th>Email</th>
			<th>Date</th>
		</tr>
	</thead>
	<tbody>

		<tr>
			<td>Peter</td>
			<td>28</td>
			<td>$9.99</td>
			<td>peter.parker@gmail.com</td>
			<td>Jul 6, 2006 8:14 AM</td>

		</tr>
		<tr>
			<td>John</td>
			<td>32</td>
			<td>$19.99</td>
			<td>john.doe@gmail.com</td>
			<td>Dec 10, 2002 5:14 AM</td>

		</tr>
		<tr>
			<td>Clark</td>
			<td>18</td>
			<td>$15.89</td>
			<td>c.kent@gmail.com</td>
			<td>Jan 12, 2003 11:14 AM</td>

		</tr>
	</tbody>
</table>

<br/>
<br/>
		
<h1>Dates: Changing default date from US to UK format.</h1>
<h4>Change default short date format to UK from US. Keep in mind that ISO dates are allways supprted.</h4>

<h3>Code:</h3>
<pre>

&lt;script&gt;
$(document).ready(function() {
	$("#date-uk").tableSorter({
		sortColumn: 'name',			// Integer or String of the name of the column to sort by.
		sortClassAsc: 'headerSortUp',		// Class name for ascending sorting action to header
		sortClassDesc: 'headerSortDown',	// Class name for descending sorting action to header
		headerClass: 'header',			// Class name for headers (th's)
		dateFormat: 'dd/mm/yyyy' 		// set date format for non iso dates default us, in this case override and set uk-format
	});
});
&lt;/script&gt;
</pre>

<h3>Demo:</h3>	
<table id="date-uk" border="0" cellpadding="0" cellspacing="0">
	<thead>
		<tr>
			<th>Name</th>

			<th>Age</th>
			<th>Total purchase</th>
			<th>ISO Date</th>
			<th>UK Short Date</th>
			<th>US Long Date</th>
		</tr>

	</thead>
	<tbody>
		<tr>
			<td>Peter</td>
			<td>28</td>
			<td>$9.99</td>
			<td>2001/12/24</td>

			<td>12/24/2001</td>
			<td>Jul 6, 2006 8:14 AM</td>
		</tr>
		<tr>
			<td>John</td>
			<td>32</td>
			<td>$19.99</td>

			<td>2002/10/14</td>
			<td>12/10/2001</td>
			<td>Dec 10, 2002 5:14 AM</td>
		</tr>
		<tr>
			<td>Clark</td>
			<td>18</td>

			<td>$15.89</td>
			<td>2006/01/17</td>
			<td>4/21/1962</td>
			<td>Jan 12, 2003 11:14 AM</td>
		</tr>
	</tbody>
</table>
</body>
</html>
