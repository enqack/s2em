<?php
/** 
 * \package SMF2 EDK Killboard Menu (s2em)
 * \file Subs-KillboardMenuLink.php
 * \version 1.0.0
 * \author Steve Verhelle
 * \date 2012-12-12
 * \brief Creates SMF2 menu item for SMF2 EDK Killboard Menu modification
 * 
 *  
 * Copyright (c) 2012, Enqack
 * All rights reserved.
 * 
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of the <organization> nor the
 *       names of its contributors may be used to endorse or promote products
 *       derived from this software without specific prior written permission.
 * 
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS" AND
 * ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE IMPLIED
 * WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE ARE
 * DISCLAIMED. IN NO EVENT SHALL <COPYRIGHT HOLDER> BE LIABLE FOR ANY
 * DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR CONSEQUENTIAL DAMAGES
 * (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF SUBSTITUTE GOODS OR SERVICES;
 * LOSS OF USE, DATA, OR PROFITS; OR BUSINESS INTERRUPTION) HOWEVER CAUSED AND
 * ON ANY THEORY OF LIABILITY, WHETHER IN CONTRACT, STRICT LIABILITY, OR TORT
 * (INCLUDING NEGLIGENCE OR OTHERWISE) ARISING IN ANY WAY OUT OF THE USE OF THIS
 * SOFTWARE, EVEN IF ADVISED OF THE POSSIBILITY OF SUCH DAMAGE.
 */

// check if executed inside SMF
if (!defined('SMF'))
	die('Hack Attempt...');

loadLanguage('KillboardMenu');

function KillboardMenuLinks(&$buttons) {
	global $txt, $tea, $context, $modSettings;

	if(!$modSettings['s2em_enable'])
	  return;

	$new_button = array('killboard' => array(
						'title' => $txt['killboard'],
						'href' => $modSettings['s2em_killboard_url'],
						'show' => true,
						'sub_buttons' => array(
							'postkm' => array(
								'title' => $txt['kb_post_mail'],
								'href' => $modSettings['s2em_killboard_url'].'?a=post',
								'show' => true,
							),
						),
					),
				);

	// if not a guest and Temars Eve API integration is on create the character details links
	if( !$context['user']['is_guest'] && $modSettings['s2em_tea_intigration']) {
		// if tea is not instantiated do so
		if( !is_object($tea))
			require_once(dirname(__FILE__) . '/TEA.php');

		// get characters on eve account that are in approved corps
		$all_chars = $tea->get_all_chars($context['user']['id']);
		$approved_corps = explode("\n",$modSettings['s2em_approved_corps']);
		array_walk($approved_corps, 'trim_escapecodes');  // clean up textarea artifacts

		foreach( $all_chars as $charID => $info ) {
			if( in_array($info[2], $approved_corps, true ) ) {
				$name = $info[0];
			    // add link details for character
				$details_sub_buttons[$name.'_details'] = array(
					'title' => $txt['view'].' '.$name,
					'href' => $modSettings['s2em_killboard_url'].'?a=pilot_detail&plt_ext_id=' . $charID,
					'show' => !$context['user']['is_guest'],
					'is_last' => true,
				);
			}
		}

		// check we have created menu items before sorting and merging arrays
		if(!empty($details_sub_buttons)) {
			asort( $details_sub_buttons );
			$new_button['killboard']['sub_buttons'] = array_merge( $new_button['killboard']['sub_buttons'], $details_sub_buttons);
		}

	}

	// insert menu after 'home' or otherwise specified location
	$fnd = 0;
	$insert_after = !empty($modSettings['s2em_insert_after']) ? $modSettings['s2em_insert_after'] : 'home';
	reset($buttons);
	while((list($key, $val) = each($buttons)) && $key != $insert_after)
		$fnd++;

	$fnd++;
	$buttons = array_merge(
		array_slice($buttons, 0, $fnd),	$new_button, array_slice($buttons, $fnd, count($buttons) - $fnd)
	);
}

function trim_escapecodes(&$value) 
{ 
    $value = trim($value, "\n\r\t"); 
}
?>
