Data visualization in HTML has long been tricky to achieve. Past solutions have involved non-standard plugins, proprietary behavior, and static images. But this has changed with the recent growth in support for the new HTML Canvas element, which provides a native drawing API that can be addressed with simple Javascript. This article is a proof of concept for visualizing HTML table data with the canvas element.

The idea of visualizing HTML table data has been a hot topic lately. The first mention of it that we have seen was Christian Heilmann's YUI blog entry, which provides a clean solution for the problem using the Yahoo library. The idea is a good one: having the data on the page in a table allows it to be accessible, and the chart can be shown as a visual enhancement. Our attempt at solving the problem uses jQuery and provides several types of graphs, such as Pie, Line, Area, and Bar.
So how does it work?
First the markup:

We start with a regular old HTML data table like the one shown below:

<table id="dataTable" summary="Member Data from 2000 to 2006">
	<caption>Member Data from 2000 to 2006</caption>
	<thead>
		<tr>
			<td></td>
			<th id="2000">2000</th>
			<th id="2001">2001</th>
			<th id="2002">2002</th>
			<th id="2003">2003</th>
			<th id="2004">2004</th>
			<th id="2005">2005</th>
			<th id="2006">2006</th>
		</tr>
	</thead>
	<tfoot>
		
	</tfoot>
	<tbody>
		<tr>
			<th headers="members">Mary</th>
			<td headers="2000">150</td>
			<td headers="2001">160</td>
			<td headers="2002">40</td>
			<td headers="2003">120</td>
			<td headers="2004">30</td>
			<td headers="2005">70</td>
			<td headers="2006">70</td>
		</tr>
		<tr>
			<th headers="members">Tom</th>
			<td headers="2000">3</td>
			<td headers="2001">40</td>
			<td headers="2002">30</td>
			<td headers="2003">45</td>
			<td headers="2004">35</td>
			<td headers="2005">49</td>
			<td headers="2006">70</td>
		</tr>
		<tr>
			<th headers="members">Brad</th>
			<td headers="2000">10</td>
			<td headers="2001">00</td>
			<td headers="2002">10</td>
			<td headers="2003">85</td>
			<td headers="2004">25</td>
			<td headers="2005">79</td>
			<td headers="2006">70</td>
		</tr>
		<tr>
			<th headers="members">Kate</th>
			<td headers="2000">40</td>
			<td headers="2001">80</td>
			<td headers="2002">90</td>
			<td headers="2003">25</td>
			<td headers="2004">15</td>
			<td headers="2005">119</td>
			<td headers="2006">200</td>
		</tr>		
	</tbody>
</table>

For the charts, we place Canvas elements in the markup with class names that are descriptive of their chart type and source.

<canvas id="chart1" class="fgCharting_src-dataTable_type-pie"></canvas>

As you can see, we've created somewhat of a custom syntax in our class names. The syntax begins with "fgCharting" and is followed by key/value pairs which are separated using underscores and matched using dashes. Using this syntax, the above class name tells our script that the source ("src") is a table with an ID of "dataTable", and our chart type ("type") is Pie. Note: There are many other ways this could be handled, and including the chart settings in the markup may not be the best separation of markup and behavior, but for the purposes of this example it seems to work well.
And now for the Scripting:

Once we have jQuery and our charting library attached, we can convert our canvas elements into charts with the following line of javascript:

$.fgCharting();


Cool! What about different charts?

We've developed several other types that can be specified using our library; these are:

    * line
    * filledLine
    * additiveLine
    * additiveFilledLine
    * pie
    * bar
    * additiveBar

Since these charts involve different groupings of data, our script organizes the table data in multiple ways. For example, Pie charts need the total table sum, each member's individual total, and each member's name. However, line, bar, and area (filled) charts need to know each member's value at every point on the X scale. Because of these differences, our script collects an object of the following properties and passes it along to the chart builder:

    * members: member names
    * allData: array of every value in the table
    * dataSum: sum of all members in the allData array
    * topValue: highest value in the table
    * memberTotals: array of totals for each member
    * yTotals: array of y-axis totals
    * topYtotal: highest value in the yTotals array
    * xLabels: labels for the X axis of line, bar, and area charts
    * yLabels: labels for the Y axis of line, bar, and area charts
    * yLabelsAdditive: y labels for the Y axis of additive charts
