<div class="book_author" >
              <?=$book["author"]?>
              著 </div>
		    <div class="book_text" > <a href="reserve.php?bookid=<?=$book["bookid"]?>&name=<?=$book["title"]?>"> <img style="float:right; margin-bottom:20px;" src="../images/head_06.gif" alt="点击预定，放入我的购物框" width="16" height="11" /></a> </div>
		    <div class="book_title"><a class="info" href="reserve.php?bookid=<?=$book["bookid"]?>&name=<?=$book["title"]?>" title="" target="subheaderFrame">
		      <? echo cut_str($book["title"],32);?>
              <span class="infobox">
              <table width="100%" border="0">
                <tr>
                  <td colspan="2">书名：
                      <? echo cut_str($book["title"],48);?></td>
                </tr>
                <tr>
                  <td colspan="2">出版社：
                      <?=$book["public"]?></td>
                </tr>
                <tr>
                  <td width="65%" >作者：
                      <?=$book["author"]?></td>
                 <td width="35%" rowspan="2" ><div align="left"><strong class="highlight">
                   <? if($book["tag"]==2) 
						 echo "<a href=reserve.php?bookid=".$book["bookid"].">该书已被预定</a>";
					else if($book["tag"]==1) echo "<a href=reserve.php?bookid=".$book["bookid"].">点击预定</a>";			else if($book["tag"]==3) echo "<a href=reserve.php?bookid=".$book["bookid"].">：已售：</a>";?>			
                 </strong></div></td>
                </tr>
                <tr>
                  <td>新旧程度：
                      <?=$book["old_degree"]?>成新</td>
                </tr>
              </table>
              </span> </a> </div>
		    <div class="book_price" >
              <div class="before">
                <?=$book["price0"]?>
                元</div>
		      <div class="now">
		        <?=$book["price1"]?>
		        元</div>
	        </div>