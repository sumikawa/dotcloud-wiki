<?php
// PukiWiki - Yet another WikiWikiWeb clone.
// $Id: default.ini.php,v 1.25 2005/12/20 14:04:40 henoheno Exp $
// Copyright (C)
//   2003-2005 PukiWiki Developers Team
//   2001-2002 Originally written by yu-ji
// License: GPL v2 or (at your option) any later version
//
// PukiWiki setting file (user agent:default)

/////////////////////////////////////////////////
// Skin file

if (defined('TDIARY_THEME')) {
	define('SKIN_FILE', DATA_HOME . SKIN_DIR . 'tdiary.skin.php');
} else {
	define('SKIN_FILE', DATA_HOME . SKIN_DIR . 'pukiwiki.skin.php');
}

/////////////////////////////////////////////////
// �����Ȥ���ڡ������ɤ߹��ߤ��ǽ�ˤ���
$load_template_func = 1;

/////////////////////////////////////////////////
// ����ʸ�����ʬ������
$search_word_color = 1;

/////////////////////////////////////////////////
// �����ڡ�����Ƭʸ������ǥå�����Ĥ���
$list_index = 1;

/////////////////////////////////////////////////
// �ꥹ�ȹ�¤�κ��ޡ�����
$_ul_left_margin = 0;   // �ꥹ�ȤȲ��̺�ü�Ȥδֳ�(px)
$_ul_margin = 16;       // �ꥹ�Ȥγ��ش֤δֳ�(px)
$_ol_left_margin = 0;   // �ꥹ�ȤȲ��̺�ü�Ȥδֳ�(px)
$_ol_margin = 16;       // �ꥹ�Ȥγ��ش֤δֳ�(px)
$_dl_left_margin = 0;   // �ꥹ�ȤȲ��̺�ü�Ȥδֳ�(px)
$_dl_margin = 16;        // �ꥹ�Ȥγ��ش֤δֳ�(px)
$_list_pad_str = ' class="list%d" style="padding-left:%dpx;margin-left:%dpx"';

/////////////////////////////////////////////////
// �ƥ����ȥ��ꥢ�Υ�����
$cols = 80;

/////////////////////////////////////////////////
// �ƥ����ȥ��ꥢ�ιԿ�
$rows = 20;

/////////////////////////////////////////////////
// �硦�����Ф������ܼ�������󥯤�ʸ��
$top = $_msg_content_back_to_top;

/////////////////////////////////////////////////
// ź�եե�����ΰ�������ɽ������ (��ô��������ޤ�)
$attach_link = 1;

/////////////////////////////////////////////////
// ��Ϣ����ڡ����Υ�󥯰�������ɽ������(��ô��������ޤ�)
$related_link = 1;

// ��󥯰����ζ��ڤ�ʸ��
$related_str = "\n ";

// (#related�ץ饰����ɽ������) ��󥯰����ζ��ڤ�ʸ��
$rule_related_str = "</li>\n<li>";

/////////////////////////////////////////////////
// ��ʿ���Υ���
$hr = '<hr class="full_hr" />';

/////////////////////////////////////////////////
// ����ǽ��Ϣ

// ����Υ��󥫡�����������ʸ�κ���Ĺ
define('PKWK_FOOTNOTE_TITLE_MAX', 16); // Characters

// ����Υ��󥫡������Хѥ���ɽ������ (0 = ���Хѥ�)
//  * ���Хѥ��ξ�硢�����ΥС�������Opera������ˤʤ뤳�Ȥ�����ޤ�
//  * ���Хѥ��ξ�硢calendar_viewer�ʤɤ�����ˤʤ뤳�Ȥ�����ޤ�
// (�ܤ�����: BugTrack/698)
define('PKWK_ALLOW_RELATIVE_FOOTNOTE_ANCHOR', 1);

// ʸ���ε����ľ����ɽ�����륿��
$note_hr = '<hr class="note_hr" />';

/////////////////////////////////////////////////
// WikiName,BracketName�˷в���֤��ղä���
$show_passage = 1;

/////////////////////////////////////////////////
// ���ɽ���򥳥�ѥ��Ȥˤ���
// * �ڡ������Ф���ϥ��ѡ���󥯤��饿���ȥ�򳰤�
// * Dangling link��CSS�򳰤�
$link_compact = 0;

/////////////////////////////////////////////////
// �ե������ޡ�������Ѥ���
$usefacemark = 1;

/////////////////////////////////////////////////
// �桼������롼��
//
//  ����ɽ���ǵ��Ҥ��Ƥ���������?(){}-*./+\$^|�ʤ�
//  �� \? �Τ褦�˥������Ȥ��Ƥ���������
//  �����ɬ�� / ��ޤ�Ƥ�����������Ƭ����� ^ ��Ƭ�ˡ�
//  ��������� $ ����ˡ�
//
/////////////////////////////////////////////////
// �桼������롼��(����С��Ȼ����ִ�)
$line_rules = array(
	'COLOR\(([^\(\)]*)\){([^}]*)}'	=> '<span style="color:$1">$2</span>',
	'SIZE\(([^\(\)]*)\){([^}]*)}'	=> '<span style="font-size:$1px">$2</span>',
	'COLOR\(([^\(\)]*)\):((?:(?!COLOR\([^\)]+\)\:).)*)'	=> '<span style="color:$1">$2</span>',
	'SIZE\(([^\(\)]*)\):((?:(?!SIZE\([^\)]+\)\:).)*)'	=> '<span class="size$1">$2</span>',
	'%%%(?!%)((?:(?!%%%).)*)%%%'	=> '<ins>$1</ins>',
	'%%(?!%)((?:(?!%%).)*)%%'	=> '<del>$1</del>',
	"'''(?!')((?:(?!''').)*)'''"	=> '<em>$1</em>',
	"''(?!')((?:(?!'').)*)''"	=> '<strong>$1</strong>',
);

/////////////////////////////////////////////////
// �ե������ޡ�������롼��(����С��Ȼ����ִ�)

// $usefacemark = 1�ʤ�ե������ޡ������ִ�����ޤ�
// ʸ�����XD�ʤɤ����ä�����facemark���ִ�����Ƥ��ޤ��Τ�
// ɬ�פΤʤ����� $usefacemark��0�ˤ��Ƥ���������

$facemark_rules = array(
	// Face marks
	'\s(\:\))'	=> ' <img alt="$1" src="' . IMAGE_DIR . 'face/smile.png" />',
	'\s(\:D)'	=> ' <img alt="$1" src="' . IMAGE_DIR . 'face/bigsmile.png" />',
	'\s(\:p)'	=> ' <img alt="$1" src="' . IMAGE_DIR . 'face/huh.png" />',
	'\s(\:d)'	=> ' <img alt="$1" src="' . IMAGE_DIR . 'face/huh.png" />',
	'\s(XD)'	=> ' <img alt="$1" src="' . IMAGE_DIR . 'face/oh.png" />',
	'\s(X\()'	=> ' <img alt="$1" src="' . IMAGE_DIR . 'face/oh.png" />',
	'\s(;\))'	=> ' <img alt="$1" src="' . IMAGE_DIR . 'face/wink.png" />',
	'\s(;\()'	=> ' <img alt="$1" src="' . IMAGE_DIR . 'face/sad.png" />',
	'\s(\:\()'	=> ' <img alt="$1" src="' . IMAGE_DIR . 'face/sad.png" />',
	'&amp;(smile);'	=> ' <img alt="[$1]" src="' . IMAGE_DIR . 'face/smile.png" />',
	'&amp;(bigsmile);'=>' <img alt="[$1]" src="' . IMAGE_DIR . 'face/bigsmile.png" />',
	'&amp;(huh);'	=> ' <img alt="[$1]" src="' . IMAGE_DIR . 'face/huh.png" />',
	'&amp;(oh);'	=> ' <img alt="[$1]" src="' . IMAGE_DIR . 'face/oh.png" />',
	'&amp;(wink);'	=> ' <img alt="[$1]" src="' . IMAGE_DIR . 'face/wink.png" />',
	'&amp;(sad);'	=> ' <img alt="[$1]" src="' . IMAGE_DIR . 'face/sad.png" />',
	'&amp;(heart);'	=> ' <img alt="[$1]" src="' . IMAGE_DIR . 'face/heart.png" />',
	'&amp;(worried);'=>' <img alt="[$1]" src="' . IMAGE_DIR . 'face/worried.png" />',

	// Face marks, Japanese style
	'\s(\(\^\^\))'	=> ' <img alt="$1" src="' . IMAGE_DIR . 'face/smile.png" />',
	'\s(\(\^-\^)'	=> ' <img alt="$1" src="' . IMAGE_DIR . 'face/bigsmile.png" />',
	'\s(\(\.\.;)'	=> ' <img alt="$1" src="' . IMAGE_DIR . 'face/oh.png" />',
	'\s(\(\^_-\))'	=> ' <img alt="$1" src="' . IMAGE_DIR . 'face/wink.png" />',
	'\s(\(--;)'	=> ' <img alt="$1" src="' . IMAGE_DIR . 'face/sad.png" />',
	'\s(\(\^\^;\))'	=> ' <img alt="$1" src="' . IMAGE_DIR . 'face/worried.png" />',
	'\s(\(\^\^;)'	=> ' <img alt="$1" src="' . IMAGE_DIR . 'face/worried.png" />',

	// Push buttons, 0-9 and sharp (Compatibility with cell phones)
	'&amp;(pb1);'	=> '[1]',
	'&amp;(pb2);'	=> '[2]',
	'&amp;(pb3);'	=> '[3]',
	'&amp;(pb4);'	=> '[4]',
	'&amp;(pb5);'	=> '[5]',
	'&amp;(pb6);'	=> '[6]',
	'&amp;(pb7);'	=> '[7]',
	'&amp;(pb8);'	=> '[8]',
	'&amp;(pb9);'	=> '[9]',
	'&amp;(pb0);'	=> '[0]',
	'&amp;(pb#);'	=> '[#]',

	// Other icons (Compatibility with cell phones)
	'&amp;(zzz);'	=> '[zzz]',
	'&amp;(man);'	=> '[man]',
	'&amp;(clock);'	=> '[clock]',
	'&amp;(mail);'	=> '[mail]',
	'&amp;(mailto);'=> '[mailto]',
	'&amp;(phone);'	=> '[phone]',
	'&amp;(phoneto);'=>'[phoneto]',
	'&amp;(faxto);'	=> '[faxto]',
);

?>
