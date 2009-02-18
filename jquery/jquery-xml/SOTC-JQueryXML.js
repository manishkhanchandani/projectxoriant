function parseXml(xml)
{
  //find every Tutorial and print the author
  $("#output").append("<b><i><u>Get attributes of Tutorial tag:</u></i></b><br /><br />");
  $(xml).find("Tutorial").each(function()
  {	
    $("#output").append($(this).attr("author") + "<br />");
  });

  // Output:
  // The Reddest
  // The Harriest
  // The Tallest
  // The Fattest
  
  //print the date followed by the title of each tutorial
  $("#output").append("<br /><br /><b><i><u>Get date followed by the title of each tutorial:</u></i></b><br /><br />");
  $(xml).find("Tutorial").each(function()
  {
    $("#output").append($(this).find("Date").text());
    $("#output").append(": " + $(this).find("Title").text() + "<br />");
  });

  // Output:
  // 1/13/2009: Silverlight and the Netflix API
  // 1/12/2009: Cake PHP 4 - Saving and Validating Data
  // 1/6/2009: Silverlight 2 - Using initParams
  // 12/12/2008: Silverlight 2 - Using initParams
  
  //print each tutorial title followed by their categories
  $("#output").append("<br /><br /><b><i><u>Get each tutorial title followed by their categories:</u></i></b><br /><br />");
  $(xml).find("Tutorial").each(function()
  {
    $("#output").append($(this).find("Title").text() + "<br />");

    $(this).find("Category").each(function()
    {
      $("#output").append($(this).text() + "<br />");
    });

    $("#output").append("<br />");
  });

  // Output:
  // Silverlight and the Netflix API
  // Tutorials
  // Silverlight 2.0
  // Silverlight
  // C#
  // XAML

  // Cake PHP 4 - Saving and Validating Data
  // Tutorials
  // CakePHP
  // PHP

  // Silverlight 2 - Using initParams
  // Tutorials
  // Silverlight 2.0
  // Silverlight
  // C#
  // HTML

  // Silverlight 2 - Using initParams
  // Tutorials
  // Silverlight 2.0
  // Silverlight
  // C#
  // HTML
}