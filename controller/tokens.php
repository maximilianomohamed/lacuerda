<?php 
	$CONF['csrf_secret'] = 'dfa%d_FA{]2Ñf523scvDAgfasg';

	function generateFormToken($form) {
	   $secret = $GLOBALS['CONF']['csrf_secret'];
	   $sid = session_id();
	   $token = md5($secret.$sid.$form);
	   return $token;
	}
	 
	function verifyFormToken($form, $token) {
	   $secret = $GLOBALS['CONF']['csrf_secret'];
	   $sid = session_id();
	   $correct = md5($secret.$sid.$form);
	   return ($token == $correct);
	}
?>