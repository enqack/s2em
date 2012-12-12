<?php
/** 
 * \package SMF2 EDK Killboard Menu (s2em)
 * \file Subs-KillboardMenuAdmin.php
 * \version 1.0.0
 * \author Steve Verhelle
 * \date 2012-12-12
 * \brief Adds controls for SMF2 EDK Killboard Menu to Miscellaneous section of Modfications Settings in SMF2
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

// used by integrate_general_mod_settings hook
function KillboardMenuAdmin(&$config_vars) {
	global $txt;

	$config_vars[] = '';
	$config_vars[] = array('check', 's2em_enable', 'subtext' => $txt['s2em_enable_sub']);
	$config_vars[] = array('text', 's2em_insert_after', 'subtext' => $txt['s2em_insert_after_sub']);
	$config_vars[] = array('text', 's2em_killboard_url', 'subtext' => $txt['s2em_killboard_url_sub']);
    $config_vars[] = array('check', 's2em_tea_intigration', 'subtext' => $txt['s2em_tea_intigration_sub']);
	$config_vars[] = array('large_text', 's2em_approved_corps', 'subtext' => $txt['s2em_approved_corps_sub']);
}


?>
