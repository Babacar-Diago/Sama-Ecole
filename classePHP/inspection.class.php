<?php 

	class Inspection {

		private $_idInspection;
		private $_nomInspection;
		private $_region; 
		private $_departement;
		private $_email;
		private $_telefax; 
		private $_telephone1; 
		private $_telephone2; 
		private $_BP;  
		private $_motDePasse; 
		private $_confirmation_token;
		private $_confirmation_at;
		private $_reset_token;
		private $_reset_at;
		private $_avatar;
		private $_remember_token;
		

		public function __construct(array $donnees) {
			$this->hydrate($donnees);
		}

		public function hydrate(array $donnees) {
			foreach ($donnees as $key => $value) {
				$method = 'set'.ucfirst($key);
				if (method_exists($this, $method)) {
					$this->$method($value);
				}
			}
		}

		
		//  GETTERS  //
		public function idInspection() {
			return $this->_idInspection;
		}
		public function nomInspection() {
			return $this->_nomInspection;
		}
		public function region() {
			return $this->_region;
		}
		public function departement() {
			return $this->_departement;
		}
		public function email() {
			return $this->_email;
		}
		public function telefax() {
			return $this->_telefax;
		}
		public function telephone1() {
			return $this->_telephone1;
		}
		public function telephone2() {
			return $this->_telephone2;
		}
		public function BP() {
			return $this->_BP;
		}
		public function motDePasse() {
			return $this->_motDePasse;
		}
		public function confirmation_token() {
			return $this->_confirmation_token;
		}
		public function confirmation_at() {
			return $this->_confirmation_at;
		}
		public function reset_token() {
			return $this->_reset_token;
		}
		public function reset_at() {
			return $this->_reset_at;
		}
		public function avatar() {
			return $this->_avatar;
		}
		public function remember_token() {
			return $this->_remember_token;
		}
		
		//  SETTERS  //
		public function setIdInspection($idInspection) {
				$this->_idInspection = $idInspection;
		}
		public function setNomInspection($inspection) {
				$this->_nomInspection = $inspection;
		}
		public function setRegion($region) {
			$this->_region = $region;
		}
		public function setDepartement($departement) {   
			$this->_departement = $departement;
		}
		public function setEmail($email) {
				$this->_email = $email;
		}
		public function setTelefax($telefax) {
			$this->_telefax = $telefax;
		}
		public function setTelephone1($telephone) {
			$this->_telephone1 = $telephone;
		}
		public function setTelephone2($telephone) {
			$this->_telephone2 = $telephone;
		}
		public function setBP($BP) {
			$this->_BP = $BP;
		}
		public function setMotDePasse($motDePasse) {
			$this->_motDePasse = $motDePasse;
		}
		public function setConfirmation_token($confirmToken) {
			$this->_confirmation_token = $confirmToken;
		}
		public function setConfirmation_at($confirmAt) {
				$this->_confirmation_at = $confirmAt;
		}
		public function setReset_token($resetToken) {
				$this->_reset_token = $resetToken;
		}
		public function setReset_at($resetAt) {
				$this->_reset_at = $resetAt;
		}
		public function setAvatar($avatar) {
			$this->_avatar = $avatar;
		}
		public function setRemember_token($rememberToken) {
			$this->_remember_token = $rememberToken;
		}
	
	}


?>