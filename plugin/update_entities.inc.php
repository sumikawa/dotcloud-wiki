<?php
// PukiWiki - Yet another WikiWikiWeb clone
// $Id: update_entities.inc.php,v 1.15 2007/04/08 10:29:24 henoheno Exp $
// Copyright (C) 2003-2007 PukiWiki Developers Team
// License: GPL v2 or (at your option) any later version
//
// Update entities plugin - Update XHTML entities from DTD (for admin)

define('W3C_XHTML_DTD_LOCATION', 'http://www.w3.org/TR/xhtml1/DTD/');

function plugin_update_entities_init()
{
	$messages = array(
		'_entities_messages'=>array(
			'title_update'  => '����å��幹��',
			'msg_adminpass' => '�����ԥѥ����',
			'btn_submit'    => '�¹�',
			'msg_done'      => '����å���ι�������λ���ޤ�����',
			'msg_usage'     => '
* ��������

:ʸ�����λ��Ȥ˥ޥå���������ɽ���ѥ�����Υ���å���򹹿�|
PHP�λ��ĥơ��֥뤪���W3C��DTD�򥹥���󤷤ơ�����å���˵�Ͽ���ޤ���

* �����о�
��COLOR(red){not found.}�פ�ɽ�����줿�ե�����Ͻ�������ޤ���
-%s

* �¹�
�����ԥѥ���ɤ����Ϥ��ơ�[�¹�]�ܥ���򥯥�å����Ƥ���������
'
		));
	set_plugin_messages($messages);
}

function plugin_update_entities_action()
{
	global $script, $vars;
	global $_entities_messages;

	if (PKWK_READONLY) die_message('PKWK_READONLY prohibits this');

	$msg = $body = '';
	if (empty($vars['action']) || empty($vars['adminpass']) || ! pkwk_login($vars['adminpass'])) {
		$msg   = & $_entities_messages['title_update'];
		$items = plugin_update_entities_create();
		$body  = convert_html(sprintf($_entities_messages['msg_usage'], join("\n" . '-', $items)));
		$body .= <<<EOD
<form method="post" action="$script">
 <div>
  <input type="hidden" name="plugin" value="update_entities" />
  <input type="hidden" name="action" value="update" />
  <label for="_p_update_entities_adminpass">{$_entities_messages['msg_adminpass']}</label>
  <input type="password" name="adminpass" id="_p_update_entities_adminpass" size="20" value="" />
  <input type="submit" value="{$_entities_messages['btn_submit']}" />
 </div>
</form>
EOD;
	} else if ($vars['action'] == 'update') {
		plugin_update_entities_create(TRUE);
		$msg  = & $_entities_messages['title_update'];
		$body = & $_entities_messages['msg_done'    ];
	} else {
		$msg  = & $_entities_messages['title_update'];
		$body = & $_entities_messages['err_invalid' ];
	}
	return array('msg'=>$msg, 'body'=>$body);
}

// Remove &amp; => amp
function plugin_update_entities_strtr($entity){
	return strtr($entity, array('&'=>'', ';'=>''));
}

function plugin_update_entities_create($do = FALSE)
{
	$files = array('xhtml-lat1.ent', 'xhtml-special.ent', 'xhtml-symbol.ent');
	
	$entities = array_map('plugin_update_entities_strtr',
		array_values(get_html_translation_table(HTML_ENTITIES)));
	$items   = array('php:html_translation_table');
	$matches = array();
	foreach ($files as $file) {
		// FIXME: 'allow_url_fopen = Off' will stop this
		$source = file(W3C_XHTML_DTD_LOCATION . $file);
//			or die_message('cannot receive ' . W3C_XHTML_DTD_LOCATION . $file . '.');
		if (! is_array($source)) {
			$items[] = 'w3c:' . $file . ' COLOR(red):not found.';
			continue;
		}
		$items[] = 'w3c:' . $file;
		if (preg_match_all('/<!ENTITY\s+([A-Za-z0-9]+)/',
			join('', $source), $matches, PREG_PATTERN_ORDER))
		{
			$entities = array_merge($entities, $matches[1]);
		}
	}
	if (! $do) return $items;

	$entities = array_unique($entities);
	sort($entities, SORT_STRING);
	$min = 999;
	$max = 0;
	foreach ($entities as $entity) {
		$len = strlen($entity);
		$max = max($max, $len);
		$min = min($min, $len);
	}

	$pattern = "(?=[a-zA-Z0-9]\{$min,$max})" . generate_trie_regex($entities);
	$fp = fopen(CACHE_DIR  . PKWK_ENTITIES_REGEX_CACHE, 'w')
		or die_message('cannot write file PKWK_ENTITIES_REGEX_CACHE<br />' . "\n" .
			'maybe permission is not writable or filename is too long');
	fwrite($fp, $pattern);
	fclose($fp);

	return $items;
}
?>
