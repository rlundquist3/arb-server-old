<?php
	class ArbAPI {
		private $db;

		function __construct() {
			$this->db = new mysqli('localhost', 'root', 'root', 'arb');
			$this->db->autocommit(FALSE);
		}

		function __destruct() {
			$this->db->close();
		}

		function test() {
			/*$query = $this->db->prepare('SELECT * FROM trails');
			$query->execute();
			$query->bind_result($trail_id, $name, $color);
			while ($query->fetch()) {
				echo "$name is $color";
			}
			$query->close;*/

			$xml = new SimpleXMLElement('<xml></xml>');
			$test = $xml->addChild('test', 'Connected Successfully');

			echo $xml->asXML();
		}

		function trail_points() {
			/*$query = $this->db->prepare('SELECT id, latitude, longitude FROM trail_points');
			$query->execute();
			$query->bind_result($id, $lat, $lon);

			while ($query->fetch()) {
				$point = new SimpleXMLElement('<rtept></rtept>');
				$lat = $point->addChild('lat', $lat);
				$lon = $point->addChild('lon', $lon);
				echo $point->asXML();
			}
			$query->close();*/

			$xml = new XMLReader();
			if (!$xml->open('data/ArbTrails.xml')) {
				die('Failed to open file');
			}
			while($xml->read()) {
				echo $xml->readInnerXML();
			}
			$xml->close();
		}
	}

	$api = new ArbAPI;

	if ($_GET['type'] === 'trail_points')
		$api->trail_points();
	else if ($_GET['type'] === 'test')
		$api->test();

?>
