<?php

	require_once "HTTP/Request.php";

	$wl = array();

	$req = new HTTP_Request('http://geizhals.at/deutschland/?cat=WL1');
	$req->addCookie('Hardware-Preisvergleich%20Cookie%20V0.0', '189620&4&WL1.217708&1&WL1.212116&2&WL1.238782&1&WL1.223983&1&WL1.t&Neuer%20Rechner&WL1.271260&1');
	if (!PEAR::isError($req->sendRequest())) {
		$body = $req->getResponseBody();
		$body = utf8_encode($body);
		foreach (explode("\n", $body) as $line)  {
			if (!strstr($line, '<TR class=trc>')) continue;
			$line = html_entity_decode($line, ENT_COMPAT, 'UTF-8');
			$line = preg_replace('/<a[^>]+>/iD', '', $line);
			$line = preg_replace('/<tr[^>]+>/iD', '', $line);
			$line = preg_replace('/<img[^>]+>/iD', '', $line);
			$line = str_ireplace('</A>', '', $line);
			$line = str_ireplace('</TR>', '', $line);
			$line = str_ireplace('<wbr>', '', $line);
			$line = preg_replace('/<\/{0,1}p[^>]*>/iD', ' ', $line);
			$line = preg_replace('/<\/{0,1}b[^>]*>/iD', ' ', $line);
			$line = preg_replace('/<\/{0,1}small[^>]*>/iD', ' ', $line);
			$line = preg_replace('/<\/[^>]+>/D', '', $line);
			$line = preg_replace('/<[^>]+>/D', '<tag>', $line);
			$data = explode('<tag>', $line);
			$wl[] = $data;
		}
	}

	if (count($wl) < 5) {
		throw new Exception('Wunschlistze enthält weniger als 5 Einträge.');
	}

?>