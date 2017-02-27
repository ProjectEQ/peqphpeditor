  <table class="edit_form" cellpadding="0" cellspacing="0" width="300px">
    <tr>
      <td class="edit_form_header">Generate Spell File</td>
    </tr>
    <tr>
      <td class="edit_form_content">
<?if ($response['success']):?>
        <b>Spells Written:</b> <?=$response['count']?><br>
        <b>Highest Spell ID:</b> <?=$response['lastid']?><br>
        <b>File Download:</b> <a href="<?=$response['spellsfile']?>" title="Right click and choose 'Save Link As' or 'Save Target As' to download spell file."><?=$response['spellsfile']?></a>
<?else:?>
        <center><img src="images/caution.gif"> <b>Failed to export spells into <?=$response['spellsfile']?></b> <img src="images/caution.gif"></center>
<?endif;?>
      </td>
    </tr>
  </table>
