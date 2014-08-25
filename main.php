<?php
/*
This file provides the primary functionality for returning data for the Arb app.
*/

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
			$xml = new SimpleXMLElement('<xml></xml>');
			$test = $xml->addChild('test', 'Connected Successfully');

			echo $xml->asXML();
		}

		//Returns all GPS points for trails
		function trail_points() {
			echo readfile('data/ArbTrailsNumbered.xml');
		}

		//Returns season-appropriate "things to see" in the Arb.
		function arb_items() {
			//Need to add WHERE clause based on date - to be implemented after setup on max
			$query = $this->db->prepare('SELECT * FROM arb_items');
			$query->execute();
			$query->bind_result($id, $name, $image, $description, $lat, $lon, $start, $end, $other);

			while ($query->fetch()) {
				echo '<item><name>'.$name.'</name><image>'.$image.'</image><description>'.$description.'</description><coords><lat>'.$lat.'</lat><lon>'.$lon.'</lon></coords><dates><start>'.$start.'</start><end>'.$end."</end></dates></item>\n";
			}

			$query->close();
		}

		//Returns the trail names for corresponding ids
		function trail_info() {
			$query = $this->db->prepare('SELECT objectid, trail_name FROM trail_info');
			$query->execute();
			$query->bind_result($id, $name);

			while ($query->fetch())
				echo "<trail><id>".$id."</id><name>".$name."</name></trail>\n";

			$query->close();
		}
	}

	$api = new ArbAPI;

	if ($_GET['type'] == 'trail_points')
		$api->trail_points();
	else if ($_GET['type'] == 'trail_info')
		$api->trail_info();
	else if ($_GET['type'] == 'arb_items')
		$api->arb_items();
	else if ($_GET['type'] == 'test')
		$api->test();

?>
