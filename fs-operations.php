<?php
ob_start();

	include('api/FoursquareAPI.class.php');
	include('../EpiCurl.php');
	include('../EpiFoursquare.php');

		class foursquare {

			public $client_key = "3TZHZPQ3ZL4PHYUQQSI1K1M1WS4QTVCDUOKH4MNHQM2FNXT3";
			public $client_secret = "YVE0J4U0XD2CQ0YT1USUBRMRUTJPA0VL10E4LKPBCQTM2KOQ";
			public $redirect_uri = "http://www.vedohost.com/fs/test/fs-operations.php";
			public $code;
			public $foursquare;
			public $token;


			public function __construct() {
				

  			}

  			function auth() {

  			$this->foursquare = new FoursquareAPI($this->client_key,$this->client_secret);
					if($_GET["code"]){
						$token = $_GET["code"];
						$this->foursquare->SetAccessToken($token);
					}
					if(!isset($token)){
						echo "<a href='".$this->foursquare->AuthenticationLink($this->redirect_uri)."'>Connect to this app via Foursquare</a>";
					}else{
						echo "Your auth token: $token<br>";
			}

	  			$con = mysql_connect("localhost","napster_napster1","napster1");
				mysql_select_db("napster_vedodb", $con);
				mysql_query("INSERT INTO test (token) VALUES ('$token')");

  			}

			function getUserBadges() {
				$badges = $this->foursquare->getPrivate("/users/self/badges");
				var_dump($badges);
			}

			function isFoodie() {

			}

		}

$test = new foursquare;
$test->auth();
$test->getUserBadges();
?>