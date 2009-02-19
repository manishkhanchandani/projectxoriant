<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
</head>

<body>
<h2>Basic Usage: <small class="Smaller NotB">Get the job done...</small></h2>
<p> Just add <code class="Big">multi</code> to the class property of your file input element and the script will do the rest. </p>
<p> Add <code class="Big">limit-99</code> or <code class="Big">max-99</code> to the class property of your file input element to set the maximum number of files that can be selected. </p>
<p> Add <code class="Big">accept-ext1|ext2|ext3</code> to the class property of your file input element to limit allowed extensions. </p>
<p> Add <code class="Big">debug</code> to the class property of your file input element to see it working in debug mode. </p>
<div class="Clear">&nbsp;</div>
<div class="Clear">&nbsp;</div>
<h2>Advanced Usage: <small class="Smaller NotB">Knock yourself out!</small></h2>
<p> Default usage: <code class="Big"> $(function(){ $.MultiFile(); }); </code> </p>
<p> Using your own selectors: <code class="Big"> $(function(){ $('#MyFileUpload').MultiFile(); }); </code> </p>
<p> Setting limit via script: <code class="Big"> $(function(){ $('#MyFileUpload').MultiFile(5 /*limit will be set to 5*/); }); </code> </p>
<p> Advanced configuration:
<pre class="Big">

$(function(){
 $('#MyCoolFileUpload').MultiFile({
  max: 5,
  accept: 'gif,jpg,png,bmp,swf'
 });
});
   </pre>
   <p></p>
   <p> Using events:
   <pre class="Big">
$(function(){
 $.MultiFile({
  afterFileSelect:function(element,value,master){
   alert('File selected:\n'+value);
  }
 });
});
   </pre>
   <p></p>
   <p> Customizing visible strings for multi-lingual support:
   <pre class="Big">

$(function(){
 $('#PortugueseFileUpload').MultiFile({
  STRING: {
   remove:'Remover',
   selected:'Selecionado: $file',
   denied:'Invalido arquivo de tipo $ext!'
  }
 });
});</pre>

</body>
</html>
