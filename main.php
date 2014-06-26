<?php
	class RedeemAPI {
		private $db;
		
		function __construct() {
			$this->db = new mysqli('localhost', 'username', 'password', 'arb');
			$this->db->autocommit(FALSE);
		}

		function __destruct() {
			$this->db->close();
		}
	
		function redeem() {
			$query = $this->db->prepare('SELECT * FROM trails');
			$query->execute();
			$query->bind_result($trail_id, $name, $color);
			while ($query->fetch()) {
				echo "$name is $color";
			}
			echo "Finished";
			$query->close;
		}
	}

	$api = new RedeemAPI;
	$api->redeem();
	
	echo "Noodles";
?>

