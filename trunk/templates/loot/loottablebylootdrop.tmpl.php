      <div class="table_container" style="width: 400px">
      <div class="table_header">
        <table width="100%" cellpadding="0" cellspacing="0">
          <tr>
           <td>Loottables using Lootdrop <?=$ldid?></td>
           <td align="right">    
            </td>
           </tr>        
         </table>
      </div>
       
       <table class="table_content2" width="100%">
<?if ($ldrop != ''):?>
             <tr>
          <td align="center" width="5%"><strong>ID</strong></td>
          <td align="center" width="50%"><strong>Name</strong></td>
          <th width="5%"></th>
         </tr>
  <?foreach($ldrop as $ldrop):?>
            <tr bgcolor="#<? echo ($x % 2 == 0) ? "BBBBBB" : "AAAAAA";?>">
            <td align="center" width="5%"> <a href="index.php?editor=loot&z=<?=$currzone?>&zoneid=<?=$currzoneid?>&npcid=<?=$ldrop['npcid']?>"> <?=$ldrop['loottid']?></td>
            <td align="center" width="50%"><?=$ldrop['loottname']?></td>
           </tr>
 <?endforeach;?>
       </table>
<?endif;?>
<?if ($ldrop == ''):?>
               <tr>
                <td align="left" width="100" style="padding: 10px;">Lootdrop is not assigned to any Loottables.</td>
              </tr>
  <?endif;?>
            
 