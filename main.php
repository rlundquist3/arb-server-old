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
	}

	$api = new ArbAPI;

	if ($_GET['type'] === 'trails')
		$api->trails();
	else if ($_GET['type'] === 'test')
		$api->test();

?>
