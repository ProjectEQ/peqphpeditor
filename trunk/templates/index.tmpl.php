<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN"
   "http://www.w3.org/TR/html4/loose.dtd">

<html>

  <head>
    <SCRIPT LANGUAGE="JavaScript">
      function gotosite(site) { if (site != "") { self.location=site; } }
    </SCRIPT>
    <SCRIPT LANGUAGE="JavaScript">
      function clearField(obj) { obj.value=""; }
    </SCRIPT>

<?if (isset($javascript)) echo $javascript;?>

    <title>PEQ Database Editor</title>

    <link rel="stylesheet" href="css/peq.css" type="text/css">
  </head>

  <body>
    <div id="container">
      <div id="header">
        <a href="index.php"><img src="images/peq_editor.jpg" title="Home" border="0"></a>
      </div>
<?if (isset($headbar)) echo $headbar;?>
<?if (isset($searchbar)) echo $searchbar;?>
      <div id="content">
<?if(isset($breadcrumbs) && ($breadcrumbs != '')):?>
      <div class='page_title'><?=$breadcrumbs?></div>
<?endif;?>
<?=$body?>
      </div>
    </div>
  </body>
</html>