<?php
// PukiWiki - Yet another WikiWikiWeb clone
// $Id: popular.inc.php,v 1.19 2007/10/06 13:20:59 henoheno Exp $
// Copyright (C)
//   2003-2005, 2007 PukiWiki Developers Team
//   2002 Kazunori Mizushima <kazunori@uc.netyou.jp>
// License: WHERE IS THE RECORD?
//
// Popular pages plugin: Show an access ranking of this wiki
// -- like recent plugin, using counter plugin's count --

/*
 * �̻�����Ӻ������̤��ư������뤳�Ȥ��Ǥ��ޤ���
 *
 * [Usage]
 *   #popular
 *   #popular(20)
 *   #popular(20,FrontPage|MenuBar)
 *   #popular(20,FrontPage|MenuBar,true)
 *
 * [Arguments]
 *   1 - ɽ��������                             default 10
 *   2 - ɽ�������ʤ��ڡ���������ɽ��             default �ʤ�
 *   3 - �̻�(true)������(false)�ΰ������Υե饰  default false
 */

define('PLUGIN_POPULAR_DEFAULT', 10);

function plugin_popular_convert()
{
	global $vars;
	global $_popular_plugin_frame, $_popular_plugin_today_frame;

	$max    = PLUGIN_POPULAR_DEFAULT;
	$except = '';

	$array = func_get_args();
	$today = FALSE;
	switch (func_num_args()) {
	case 3: if ($array[2]) $today = get_date('Y/m/d');
	case 2: $except = $array[1];
	case 1: $max    = $array[0];
	}

	$counters = array();
	foreach (get_existpages(COUNTER_DIR, '.count') as $file=>$page) {
		if (($except != '' && ereg($except, $page)) ||
		    is_cantedit($page) || check_non_list($page) ||
		    ! is_page($page))
			continue;

		$array = file(COUNTER_DIR . $file);
		$count = rtrim($array[0]);
		$date  = rtrim($array[1]);
		$today_count = rtrim($array[2]);

		if ($today) {
			// $page�����ͤ˸�����(���Ȥ���encode('BBS')=424253)�Ȥ���
			// array_splice()�ˤ�äƥ����ͤ��ѹ�����Ƥ��ޤ��Τ��ɤ�
			// ���ᡢ������ '_' ��Ϣ�뤹��
			if ($today == $date) $counters['_' . $page] = $today_count;
		} else {
			$counters['_' . $page] = $count;
		}
	}

	asort($counters, SORT_NUMERIC);

	// BugTrack2/106: Only variables can be passed by reference from PHP 5.0.5
	$counters = array_reverse($counters, TRUE); // with array_splice()
	$counters = array_splice($counters, 0, $max);

	$items = '';
	if (! empty($counters)) {
		$items = '<ul class="popular_list">' . "\n";

		foreach ($counters as $page=>$count) {
			$page = substr($page, 1);

			$s_page = htmlspecialchars($page);
			if ($page === $vars['page']) {
				// No need to link itself, notifies where you just read
				$pg_passage = get_pg_passage($page,FALSE);
				$items .= ' <li><span title="' . $s_page . ' ' . $pg_passage . '">' .
					$s_page . '<span class="counter">(' . $count .
					')</span></span></li>' . "\n";
			} else {
				$items .= ' <li>' . make_pagelink($page,
					$s_page . '<span class="counter">(' . $count . ')</span>') .
					'</li>' . "\n";
			}
		}
		$items .= '</ul>' . "\n";
	}

	return sprintf($today ? $_popular_plugin_today_frame : $_popular_plugin_frame, count($counters), $items);
}
?>
