<?php
require_once 'model/ContactsLogic.php';
class ContactsController{

	public function __construct() {
		$this->ContactsLogic = new ContactsLogic();
	}

	public function handleRequest()
	{
		try {
			$op = isset($_REQUEST['op'])?$_REQUEST['op']:NULL;
			$url = strtolower($_GET['url']);
			if(!empty($op)) {
				switch ($op) {
					case 'login':
					$this->collectReadAdmin($_REQUEST['userName'], $_REQUEST['userPass']);
					break;
					default:
					echo $op;
					break;
				}
			} else {
				switch ($url) {
					case 'admin': include 'view/login.php'; break;
					default:
					echo $url;
					break;
				}
			}
		} catch (ValidationException $e) {
				$errors = $e->getErrors();
		}

	}

	public function collectCreateContact(){

	}

	public function collectReadAdmin($userName, $userPass){
		$check = $this->ContactsLogic->checkData($userName, $userPass);
		if($check == false) {
			$admin = $this->ContactsLogic->readAdmin($userName, $userPass);
			if(empty($admin)) {
				$error = "Verkeerde wachtwoord of gebruikersnaam";
				include 'view/login.php';
			} else {
				include 'view/dashboard.php';
				echo var_dump($admin);
			}
		} else {
			$error = 'Ongeldige gegevens bij het inlogen controleer de velden opnieuw';
			include 'view/login.php';
		}
		//include 'view/reads.php';
	}

	public function collectReadContact($id){

	}

	public function collectUpdateContact(){

	}

	public function collectDeleteContact($id){

	}
	public function __destruct(){

	}

}

?>
