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
			echo readfile('data/ArbTrailsNumbered.xml');
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

			/*$xml = new XMLReader();
			if (!$xml->open('data/ArbTrailsNumbered.xml')) {
				die('Failed to open file');
			}
			while($xml->read()) {
				if ($xml->name == 'rte')
					echo $xml->readInnerXML();
			}
			$xml->close();*/
		}

		function arb_items() {
			$query = $this->db->prepare('SELECT * FROM arb_items');
			$query->execute();
			$query->bind_result($id, $name, $image, $description, $lat, $lon, $start, $end, $other);

			while ($query->fetch()) {
				echo '<item><name>'.$name.'</name><image>'.$image.'</image><description>'.$description.'</description><coords><lat>'.$lat.'</lat><lon>'.$lon.'</lon></coords><dates><start>'.$start.'</start><end>'.$end."</end></dates></item>\n";
				/*$item = new SimpleXMLElement('item');
				$nameData = $item->addChild('name', $name);
				$imageData = $item->addChild('image', $image);
				$descData = $item->addChild('description', $description);
				$latData = $item->addChild('lat', $lat);
				$lonData = $item->addChild('lon', $lon);
				$startData = $item->addChild('start', $start);
				$endData = $item->addChild('end', $end);
				echo $item->asXML();*/
			}

			$query->close();
		}
	}

	$api = new ArbAPI;

	if ($_GET['type'] === 'trail_points')
		$api->trail_points();
	else if ($_GET['type'] == 'arb_items')
		$api->arb_items();
	else if ($_GET['type'] == 'test')
		$api->test();

?>
