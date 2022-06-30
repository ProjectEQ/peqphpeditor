        <div class="table_container" style="width: 750px;">
          <div class="table_header">
            <table width="100%" cellpadding="0" cellspacing="0">
              <tr>
                <td>Books</td>
                <td>
                  <div style="float:right">
                    &nbsp;
                  </div>
                </td>
              </tr>
            </table>
          </div>
          <div>
          <table class="edit_form_content" width="100%">
<?if (isset($books)):?>
            <tr>
              <td align="center" width="10%"><strong>Name</strong></td>
              <td align="center" width="60%"><strong>Text</strong></td>
              <td align="center" width="25%"><strong>Language</strong></td>
              <td width="5%">&nbsp;</td>
            </tr>
<?$x=0;
foreach($books as $book):?>
            <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
              <td align="center" width="10%"><?echo ($book['name'] != "") ? $book['name'] : "N/A";?></td>
              <td align="center" width="60%"><?=substr($book['txtfile'],0,60)?></td>
              <td align="center" width="25%"><?echo ($book['language'] >= 0) ? $langtypes[$book['language']] . " (" . $book['language'] . ")" : "UNK (" . $book['language'] . ")";?></td>
              <td align="right" width="5%"><a href="index.php?editor=items&name=<?=$book['name']?>&action=3"><img src="images/edit2.gif" width="13" height="13" border="0" title="View Book"></a></td>
            </tr>
<?$x++;
endforeach;
else:?>
            <tr>
              <td align="left" width="100%" style="padding: 10px;">No Books</td>
            </tr>
<?endif;?>
          </table>
          </div>
        </div>
