<?php
if($_POST) {
	echo "<pre>";
	print_r($_POST);
	print_r($_FILES);
	echo "</pre>";
}
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
<title>Untitled Document</title>
<script src="../../jquery/jquery-latest.js" type="text/javascript" language="javascript"></script>
  <script src="../../jquery/jquery.MetaData.js" type="text/javascript" language="javascript"></script>
  <script src="../../jquery/jquery.MultiFile.js" type="text/javascript" language="javascript"></script>

  <script src="../../jquery/jquery.blockUI.js" type="text/javascript" language="javascript"></script>
</head>

<body>
<h2>Examples: <small class="Smaller NotB">Try it yourself!</small></h2>
  <p>
   The plugin provides very simple integration in 2 methods:<br>
   a) By using the accept and maxlength properties.<br>

   b) By using the class property<br>
   Take a look at the examples below and decide which method is best for you.
  </p>

  <h3>Using accept and maxlength properties</h3>
  <table summary="MultiFile Upload Demos" width="100%" cellspacing="10">
   <tr>
    <td valign="top" width="33%">
     <fieldset>

      <legend>Example 1</legend>
      <code class="Big">
       class="multi" maxlength="5"
      </code>
      <div class="P5 B">
       Limit: 5 files.
       <br/>
       Allowed extensions: any.
      </div>
      <form action="" method="post" enctype="multipart/form-data" class="P10">

       <input type="file" class="multi" maxlength="5"/>
	   <input type="submit" name="submit" value="submit">
      </form>
     </fieldset>
    </td>
    <td valign="top" width="33%">
     <fieldset>
      <legend>Example 2</legend>
      <code class="Big">

       class="multi" accept="gif|jpg"
      </code>
      <div class="P5 B">
       Limit: no limit.
       <br/>
       Allowed extensions: gif and jpg.
      </div>
      <form action="" method="post" enctype="multipart/form-data" class="P10">
       <input type="file" class="multi" accept="gif|jpg"/>
	   <input type="submit" name="submit" value="submit">
      </form>

     </fieldset>
    </td>
    <td valign="top" width="33%">
     <fieldset>
      <legend>Example 3</legend>
      <code class="Big">
       class="multi" accept="gif|jpg" maxlength="3"
      </code>
      <div class="P5 B">

       Limit: 3 files
       <br/>
       Allowed extensions: gif and jpg.
      </div>
      <form action="" method="post" enctype="multipart/form-data" class="P10">
       <input type="file" class="multi" accept="gif|jpg" maxlength="3"/>
	   <input type="submit" name="submit" value="submit">
      </form>
      <div class="P5">
       Note that server-side validation is still required if Javascript is disabled.
      </div>

     </fieldset>
    </td>
   </tr>
  </table>
  
  <h3>Using class property</h3>
  <table summary="MultiFile Upload Demos" width="100%" cellspacing="10">
   <tr>
    <td valign="top" width="33%">

     <fieldset>
      <legend>Example 4</legend>
      <code class="Big">
       class="multi"
      </code>
      <div class="P5 B">
       No limit.
       <br/>
       Allowed extensions: any.
      </div>

      <form action="" method="post" enctype="multipart/form-data" class="P10">
       <input type="file" class="multi"/>
	   <input type="submit" name="submit" value="submit">
      </form>
     </fieldset>
    </td>
    <td valign="top" width="33%">
     <fieldset>
      <legend>Example 5</legend>

      <code class="Big">
       class="multi limit-2"
      </code>
      <div class="P5 B">
       Limit: 2 files.
       <br/>
       Allowed extensions: any.
      </div>
      <form action="" method="post" enctype="multipart/form-data" class="P10">
       <input type="file" class="multi limit-2"/>
       <input type="submit" name="submit" value="submit">
      </form>
     </fieldset>
    </td>
    <td valign="top" width="33%">
     <fieldset>
      <legend>Example 6</legend>
      <code class="Big">
       class="multi limit-3 accept-jpg|gif|bmp|png"
      </code>

      <div class="P5 B">
       Limit: 3 files
       <br/>
       Allowed extensions: jpg,gif,bmp,png.
      </div>
      <form action="" method="post" enctype="multipart/form-data" class="P10">
       <input type="file" class="multi limit-3 accept-jpg|gif|bmp|png"/>
	   <input type="submit" name="submit" value="submit">
      </form>
      <div class="P5">
       Note that server-side validation is still required if Javascript is disabled.
      </div>

     </fieldset>
    </td>
   </tr>
  </table>
  
  <h3>Multi-lingual support</h3>
  <table summary="MultiFile Upload Demos" width="100%" cellspacing="10">
   <tr>
    <td valign="top" width="33%">

     <fieldset>
      <legend>Example 7</legend>
						This example has been configured to accept gif/pg files
						only in order to demonstrate the error messages.
      <form action="" method="post" enctype="multipart/form-data" class="P10">
       <input type="file" class="multi {accept:'gif|jpg', max:3, STRING: {remove:'Remover',selected:'Selecionado: $file',denied:'Invalido arquivo de tipo $ext!',duplicate:'Arquivo ja selecionado:\n$file!'}}"/>
	   <input type="submit" name="submit" value="submit">
      </form>
      <ul>
       <li>
        <b>Method 1</b>: Using class property (require MetaData plugin)<br/>

        <code><pre>
&lt;input type="file" class="<span style="color:#900">multi</span>
<span style="color:#900">{accept:'gif|jpg', max:3, STRING:{
 remove:'Remover',
 selected:'Selecionado: $file',
 denied:'Invalido arquivo de tipo $ext!',
 duplicate:'Arquivo ja selecionado:\n$file!'
}}</span>" /&gt;
         </pre></code>
       </li>
       <li>
        <b>Method 2</b>: Programatically by ID (ONE element only, does not require MetaData plugin)<br/>

        <pre class="Big">
&lt;input type="file" id="<span style="color:#900">PortugueseFileUpload</span>" /&gt;
...
$(function(){
 $('<span style="color:#900">#PortugueseFileUpload</span>').MultiFile({
  accept:'gif|jpg', max:3, STRING: {
   remove:'Remover',
   selected:'Selecionado: $file',
   denied:'Invalido arquivo de tipo $ext!',
   duplicate:'Arquivo ja selecionado:\n$file!'
  }
 });
});
        </pre>
       </li>
       <li>
        <b>Method 3</b>: Programatically (<em>n</em> elements, does not require MetaData plugin)<br/>

        <a href="http://plugins.jquery.com/node/1251">See this feature request for details</a><br/>
        <pre class="Big">
&lt;input type="file" class="<span style="color:#900">multi-pt</span>" /&gt;
&lt;input type="file" class="<span style="color:#900">multi-pt</span>" /&gt;
&lt;input type="file" class="<span style="color:#900">multi-pt</span>" /&gt;

...
$(function(){
 $('<span style="color:#900">.multi-pt</span>').MultiFile({
  accept:'gif|jpg', max:3, STRING: {
   remove:'Remover',
   selected:'Selecionado: $file',
   denied:'Invalido arquivo de tipo $ext!',
   duplicate:'Arquivo ja selecionado:\n$file!'
  }
 });
});
        </pre>
       </li>
      </ul>
     </fieldset>
    </td>
   </tr>
  </table>

  <div class="Clear">&nbsp;</div>
  <div class="Clear">&nbsp;</div>
</body>
</html>
