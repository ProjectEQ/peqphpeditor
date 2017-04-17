<!DOCTYPE html>
<html>

  <head>
    <meta name="viewport" content="width=800">
    <meta http-equiv="Content-type" content="text/html;charset=UTF-8">
    <script type="text/javascript">
      function gotosite(site) { if (site != "") { self.location=site; } }
    </script>
    <script type="text/javascript">
      function clearField(obj) { obj.value=""; }
    </script>

<?if (isset($javascript)) echo $javascript;?>

    <title>PEQ Database Editor</title>

    <link rel="stylesheet" href="css/peq.css" type="text/css">
  </head>

  <body>
    <div id="container">
      <div id="header">
        <a href="index.php"><img src="images/peq_editor.gif" title="Home" border="0" alt="PEQ Editor Banner"></a>
      </div>
<?php if (ini_get('short_open_tag') != 1): ?>
  <div class="error">
    <table width="100%">
      <tr>
        <td valign="middle" width="30px"><img src="images/caution.gif"></td>
        <td style="padding:0px 5px;">The setting for <strong><em>short_open_tag</em></strong> must be turned <strong><em>on</em></strong> in php.ini</td>
      </tr>
    </table>
  </div>
<?php exit; endif; ?>
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