<? if(!defined('IN_DISCUZ')) exit('Access Denied'); ?>
<script type="text/javascript">
lang['post_trade_costprice_is_number'] = '对不起，商品原价必须为有效数字。';
lang['post_trade_price_is_number'] = '对不起，商品现价必须为有效数字。';
lang['post_trade_amount_is_number'] = '对不起，商品数量必须为数字。';
</script>
<input type="hidden" name="trade" value="yes" />
<tr>
	<th style="border-bottom: 0"><label for="item_name">商品名称</label></th>
	<td style="border-bottom: 0"><?=$tradetypeselect?> <input type="text" id="item_name" name="item_name" size="30" value="<?=$trade['subject']?>" tabindex="50" /></td>
</tr>

<tr><td id="threadtypes" colspan="2" style="border: 0px; padding: 0px"></td></tr>

<tr>
	<th><label for="item_quality">商品类型</label></th>
	<td>
		<select id="item_quality" name="item_quality" tabindex="51">
			<option value="1" <? if($trade['quality'] == 1) { ?>selected="selected"<? } ?>>全新</option>
			<option value="2" <? if($trade['quality'] == 2) { ?>selected="selected"<? } ?>>二手</option>
		</select>

		<select name="item_type" tabindex="52">
		<option value="1" <? if($trade['itemtype'] == 1) { ?>selected<? } ?>>商品</option>
		<option value="2" <? if($trade['itemtype'] == 2) { ?>selected<? } ?>>服务</option>
		<option value="3" <? if($trade['itemtype'] == 3) { ?>selected<? } ?>>拍卖</option>
		<option value="4" <? if($trade['itemtype'] == 4) { ?>selected<? } ?>>捐赠</option>
		<option value="5" <? if($trade['itemtype'] == 5) { ?>selected<? } ?>>邮费</option>
		<option value="6" <? if($trade['itemtype'] == 6) { ?>selected<? } ?>>奖金</option>
		</select>
	</td>
</tr>

<? if($allowpostattach) { ?>
	<tr>
		<th>商品图片</th>
		<td>
		<input type="file" name="tradeattach[]" class="absmiddle" size="30" onchange="attachpreview(this, 'tradeattach_preview', 80, 80)" tabindex="53" />
		<div id="tradeattach_preview">
		<? if($tradeattach['attachment']) { ?>
			<a href="<?=$tradeattach['url']?>/<?=$tradeattach['attachment']?>" target="_blank">
			<? if($tradeattach['thumb']) { ?>
				<img height="80" src="<?=$tradeattach['url']?>/<?=$tradeattach['attachment']?>.thumb.jpg" border="0" alt="" />
			<? } else { ?>
				<img height="80" src="<?=$tradeattach['url']?>/<?=$tradeattach['attachment']?>" border="0" alt="" />
			<? } ?>
			</a>
		<? } ?>
		</div><? if($tradeattach['attachment']) { ?><input name="tradeaid" type="hidden" value="<?=$tradeattach['aid']?>"><? } ?>
		<div id="tradeattach_preview_hidden" style="position: absolute; top: -100000px; filter: progid:DXImageTransform.Microsoft.AlphaImageLoader(sizingMethod='image'); width: 80px; height: 80px"></div>
		</td>
	</tr>
<? } ?>
<tr>
<? include template('post_editor'); ?>
</tr>

<? if(($action == 'newthread' || $action == 'edit' && $isfirstpost) && $tagstatus) { ?>
	<tr>
		<th><label for="tags">标签</label></th>
		<td>
			<input size="45" type="input" id="tags" name="tags" value="<?=$threadtags?>" tabindex="154" />&nbsp;
			<button onclick="relatekw();return false">可用标签</button><span id="tagselect"></span>
			<em class="tips">(用空格隔开多个标签，最多可填写 <strong>5</strong> 个)</em>
		</td>
	</tr>
<? } ?>
<thead>
	<tr>
		<th>交易信息</th>
		<td>&nbsp;</td>
	</tr>
</thead>
<tr>
	<th><label for="item_costprice">商品原价</label></th>
	<td><input type="text" id="item_costprice" name="item_costprice" size="30" value="<?=$trade['costprice']?>" tabindex="155" />
</tr>
<tr>
	<th><label for="item_price">商品现价</label></th>
	<td><input type="text" id="item_price" name="item_price" size="30" value="<?=$trade['price']?>" tabindex="156" /> <em class="tips"><? if($mintradeprice && $maxtradeprice) { ?>价格范围 <?=$mintradeprice?> 元 - <?=$maxtradeprice?> 元<? } else { ?>最小价格 <?=$mintradeprice?> 元<? } ?></em></td>
</tr>
<tr>
	<th><label for="item_locus">所在地点</label></th>
	<td><input type="text" id="item_locus" name="item_locus" size="30" value="<?=$trade['locus']?>" tabindex="157" /></td>
</tr>
<tr>
	<th><label for="item_number">商品数量</label></th>
	<td><input type="text" id="item_number" name="item_number" size="30" value="<?=$trade['amount']?>" tabindex="158" /></td>
</tr>

<? if($ec_account) { ?>
	<tr>
		<th><label for="paymethod">交易方式</label></td>
		<td><input type="radio" id="paymethod" name="paymethod" onclick="$('tradeaccount').style.display = ''" value="1"<? if($trade['account']) { ?> checked="checked"<? } ?> /> 支付宝在线交易 <input type="radio" id="paymethod" name="paymethod" onclick="$('tradeaccount').style.display = 'none'" value="0"<? if(!$trade['account']) { ?> checked="checked"<? } ?> /> 线下交易
		</td>
	</tr>
	<tbody id="tradeaccount"<? if(!$trade['account']) { ?> style="display: none"<? } ?>>
	<tr>
		<th><label for="seller">支付宝账户</label></td>
		<td>
			<input type="text" id="seller" name="seller" size="30" value="<?=$trade['account']?>" />
		</td>
	</tr>
	</tbody>
<? } else { ?>
	<input type="hidden" id="seller" name="seller" value="" />
<? } ?>

<tr>
	<th valign="top">物流方式</th>
	<td>
		<label><input class="radio" type="radio" name="transport" value="virtual" tabindex="160" <? if($trade['transport'] == 3) { ?>checked="checked"<? } ?> onclick="$('logisticssetting').style.display='none'" /> 虚拟物品或无需邮递</label>
		<label><input class="radio" type="radio" name="transport" value="seller" tabindex="161" <? if($trade['transport'] == 1) { ?>checked="checked"<? } ?> onclick="$('logisticssetting').style.display=''" /> 卖家承担运费</label>
		<label><input class="radio" type="radio" name="transport" value="buyer" tabindex="162" <? if($trade['transport'] == 2) { ?>checked="checked"<? } ?> onclick="$('logisticssetting').style.display=''" /> 买家承担运费</label>
		<label><input class="radio" type="radio" name="transport" value="logistics" tabindex="163" <? if($trade['transport'] == 4) { ?>checked="checked"<? } ?> onclick="$('logisticssetting').style.display=''" /> 支付给物流公司</label>
	</td>
</tr>
<tbody id="logisticssetting" style="display:<? if($trade['transport'] == 3) { ?> none<? } ?>">
<tr>
	<th valign="top">运费</th>
	<td>
		平邮 <input type="text" name="postage_mail" size="3" value="<?=$trade['ordinaryfee']?>" tabindex="164" /> 元<em class="tips">(不填表示不提供平邮)</em><br />
		快递 <input type="text" name="postage_express" size="3" value="<?=$trade['expressfee']?>" tabindex="165" /> 元 <em class="tips">(不填表示不提供快递)</em><br />
		EMS <input type="text" name="postage_ems" size="3" value="<?=$trade['emsfee']?>" tabindex="166" /> 元 <em class="tips">(不填表示不提供 EMS)</em><br />
	</td>
</tr>
</tbody>
<? if($action == 'edit') { ?>
	<tr>
		<th>启动交易</th>
		<td>
			<label><input class="radio" type="radio" name="closed" value="0" tabindex="167" <? if($trade['closed'] == 0) { ?>checked="checked"<? } ?>>是</label>&nbsp;
			<label><input class="radio" type="radio" name="closed" value="1" tabindex="168" <? if($trade['closed'] == 1) { ?>checked="checked"<? } ?>>否</label>
		</td>
	</tr>
<? } ?>
<tr>
	<th><label for="item_expiration">有效期</label></th>
	<td>
		<input onclick="showcalendar(event, this, false)" type="text" id="item_expiration" name="item_expiration" size="30" value="<?=$trade['expiration']?>" tabindex="169">
		<select onchange="this.form.item_expiration.value = this.value">
			<option value=''></option>
			<option value=''>永久有效</option>
			<option value='<?=$expiration_7days?>'>7天</option>
			<option value='<?=$expiration_14days?>'>14天</option>
			<option value='<?=$expiration_month?>'>1个月</option>
			<option value='<?=$expiration_3months?>'>3个月</option>
			<option value='<?=$expiration_halfyear?>'>半年</option>
			<option value='<?=$expiration_year?>'>1年</option>
		</select></td>
</tr>

<script type="text/javascript">
	<? if($trade['price'] && $tradetaxtype == 2) { ?>$('realtax').innerHTML = Math.ceil(<?=$trade['price']?> * (<?=$tradetaxs?> / 100));<? } ?>
</script>