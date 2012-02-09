<?php

// Email Pack for Discuz! Version 3.1.0
// Translated by Crossday

// ATTENTION: Please add slashes(\) before single & double quotes( ' & " )

$language = array
(

	'get_passwd_subject' =>		'取回密码说明',
	'get_passwd_message' =>		'
$member[username]，
这封信是由 $bbname 发送的。

您收到这封邮件，是因为在我们的论坛上这个邮箱地址被登记为用户邮箱，
且该用户请求使用 Email 密码重置功能所致。

----------------------------------------------------------------------
重要！
----------------------------------------------------------------------

如果您没有提交密码重置的请求或不是我们论坛的注册用户，请立即忽略
并删除这封邮件。只在您确认需要重置密码的情况下，才继续阅读下面的
内容。

----------------------------------------------------------------------
密码重置说明
----------------------------------------------------------------------

您只需在提交请求后的三天之内，通过点击下面的链接重置您的密码：

{$boardurl}member.php?action=getpasswd&uid=$member[uid]&id=$idstring

(如果上面不是链接形式，请将地址手工粘贴到浏览器地址栏再访问)

上面的页面打开后，输入新的密码后提交，之后您即可使用新的密码登录
论坛了。您可以在用户控制面板中随时修改您的密码。

本请求提交者的 IP 为 $onlineip



此致

$bbname 管理团队.
$boardurl',


	'email_verify_subject' =>	'Email 地址验证',
	'email_verify_message' =>	'
$discuz_user ，
这封信是由 $bbname 发送的。

您收到这封邮件，是因为在我们论坛的新用户注册，或用户修改 Email 使用
了您的地址。如果您并没有访问过我们的论坛，或没有进行上述操作，请忽
略这封邮件。您不需要退订或进行其他进一步的操作。

----------------------------------------------------------------------
帐号激活说明
----------------------------------------------------------------------

您是我们论坛的新用户，或在修改您的注册 Email 时使用了本地址，我们需
要对您的地址有效性进行验证以避免垃圾邮件或地址被滥用。

您只需点击下面的链接即可激活您的帐号：

{$boardurl}member.php?action=activate&uid=$discuz_uid&id=$idstring

(如果上面不是链接形式，请将地址手工粘贴到浏览器地址栏再访问)

感谢您的访问，祝您使用愉快！



此致

$bbname 管理团队.
$boardurl',


	'email_notify_subject' =>	'《$thread[subject]》新回复通知',
	'email_notify_message' =>	'
您好，
这封信是由 $bbname 发送的。

您收到这封邮件，是因为您订阅的以下主题在最近 24 小时内有了新的回复。
如果您并没有访问过我们的论坛，或没有进行上述操作，请忽略这封邮件。
您不需要退订或进行其他进一步的操作。

----------------------------------------------------------------------
主题信息
----------------------------------------------------------------------
URL:  {$boardurl}viewthread.php?tid=$thread[tid]
标题: $thread[subject]
作者: $thread[author]
查看: $thread[views]
回复: $thread[replies]

该主题最近一次由 $thread[lastposter] 于 $thread[lastpost] 回复。

您订阅的主题可能有更多的回复，为了不影响您信箱的正常使用，我们每 24
小时至多只会发送一次新回复通知，在此期间如果有新回复，将在下次一并通
知。



此致

$bbname 管理团队.
$boardurl',


	'add_member_subject' =>		'您被添加成为会员',
	'add_member_message' => 	'
$newusername ，
这封信是由 $bbname 发送的。

我是 $discuz_user ，$bbname 的管理者之一。您收到这封邮件，是因为您
刚刚被添加成为我们论坛的会员，当前 Email 即是我们为您注册的地址。

----------------------------------------------------------------------
重要！
----------------------------------------------------------------------

如果您对我们的论坛不感兴趣或无意成为会员，请忽略这封邮件。

----------------------------------------------------------------------
帐号信息
----------------------------------------------------------------------

论坛名称：$bbname
论坛地址：$boardurl

用户名：$newusername
密码：$newpassword

从现在起您可以使用您的帐号登录我们的论坛，祝您使用愉快！



此致

$bbname 管理团队.
$boardurl',


	'birthday_subject' =>		'祝您生日快乐',
	'birthday_message' => 		'
$member[username]，
这封信是由 $bbname 发送的。

您收到这封邮件，是因为在我们的论坛上这个邮箱地址被登记为用户邮箱，
并且按照您填写的信息，今天是您的生日，很高兴能在此时为您献上一份
生日祝福，我谨代表论坛管理团队，衷心祝福您生日快乐。

如果您并非我们的会员，或今天并非您的生日，可能是有人误用了您的邮
件地址，或错误的填写了生日信息，本邮件不会多次重复发送，请忽略这
封邮件。



此致

$bbname 管理团队.
$boardurl',


	'email_to_friend_subject' =>	'推荐给您: $thread[subject]',
	'email_to_friend_message' =>	'
$sendtoname,
这封信是由 $bbname 的 $discuz_userss 发送的。

您收到这封邮件，是因为在 $discuz_userss 通过我们论坛的“推荐给朋友”
功能推荐了如下的内容给您，如果您对此不感兴趣，请忽略这封邮件。您不
需要退订或进行其他进一步的操作。

----------------------------------------------------------------------
信件原文开始
----------------------------------------------------------------------

$message

----------------------------------------------------------------------
信件原文结束
----------------------------------------------------------------------

请注意这封信仅仅是由用户使用 “推荐给朋友”发送的，不是论坛官方邮件，
论坛管理团队不会对这类邮件负责。

欢迎您访问 $bbname
$boardurl',

	'email_to_invite_subject' =>	'您的朋友 $discuz_userss 发送 $bbname 论坛注册邀请码给您',
	'email_to_invite_message' =>	'
$sendtoname,
这封信是由 $bbname 的 $discuz_userss 发送的。

您收到这封邮件，是因为在 $discuz_userss 通过我们论坛的“发送邀请码给朋友”
功能推荐了如下的内容给您，如果您对此不感兴趣，请忽略这封邮件。您不
需要退订或进行其他进一步的操作。

----------------------------------------------------------------------
信件原文开始
----------------------------------------------------------------------

$message

----------------------------------------------------------------------
信件原文结束
----------------------------------------------------------------------

请注意这封信仅仅是由用户使用 “发送邀请码给朋友”发送的，不是论坛官方邮件，
论坛管理团队不会对这类邮件负责。

欢迎您访问 $bbname
$boardurl',


	'moderate_member_subject' =>	'用户审核结果通知',
	'moderate_member_message' =>	'
$member[username] ，
这封信是由 $bbname 发送的。

您收到这封邮件，是因为在我们的论坛上这个邮箱地址被新用户注册时所
使用，且管理员设置了需对新用户进行人工审核，本邮件将通知您提交的
申请的审核结果。

----------------------------------------------------------------------
注册信息与审核结果
----------------------------------------------------------------------

用户名: $member[username]
注册时间: $member[regdate]
提交时间: $member[submitdate]
提交次数: $member[submittimes]
注册原因: $member[message]

审核结果: $member[operation]
审核时间: $member[moddate]
审核管理员: $discuz_userss
管理员留言: $member[remark]

----------------------------------------------------------------------
审核结果说明
----------------------------------------------------------------------

通过: 您的注册已通过审核，您已成为我们论坛的正式用户。

否决: 您的注册信息不完整，或未满足我们对新用户的某些要求，您可以
      根据管理员留言，完善您的注册信息，然后再提交。

删除：您的注册由于与我们的要求偏差较大，或我们的论坛新注册人数已
      超过预期，申请被彻底否决。您的帐号已从数据库中删除，将无法
      再使用其登录或提交再次审核，请您谅解。



此致

$bbname 管理团队.
$boardurl'

);

?>