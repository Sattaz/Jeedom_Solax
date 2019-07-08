<?php

/* This file is part of Jeedom.
 *
 * Jeedom is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * Jeedom is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE. See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with Jeedom. If not, see <http://www.gnu.org/licenses/>.
 */

/* * ***************************Includes********************************* */
require_once __DIR__  . '/../../../../core/php/core.inc.php';

class solax extends eqLogic {
    /*     * *************************Attributs****************************** */

    /*     * ***********************Methode static*************************** */

    //Fonction exécutée automatiquement toutes les minutes par Jeedom
    public static function cron() {
		foreach (self::byType('solax') as $solax) {//parcours tous les équipements du plugin solax
			if ($solax->getIsEnable() == 1) {//vérifie que l'équipement est actif
				$cmd = $solax->getCmd(null, 'refresh');//retourne la commande "refresh si elle existe
				if (!is_object($cmd)) {//Si la commande n'existe pas
					continue; //continue la boucle
				}
				$cmd->execCmd(); // la commande existe on la lance
			}
		}
    }
    
	/*
     * Fonction exécutée automatiquement toutes les heures par Jeedom
      public static function cronHourly() {

      }
     */

    /*
     * Fonction exécutée automatiquement tous les jours par Jeedom
      public static function cronDaily() {

      }
     */



    /*     * *********************Méthodes d'instance************************* */

    public function preInsert() {
        
    }

    public function postInsert() {
        
    }

    public function preSave() {
		$this->setDisplay("width","1600px");
		$this->setDisplay("height","250px");
    }

    public function postSave() {
		$info = $this->getCmd(null, 'PV1_Current');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('PV1 Amps', __FILE__));
		}
		$info->setLogicalId('PV1_Current');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setConfiguration('minValue', 0);
		$info->setConfiguration('maxValue', 20); //$this->getConfiguration("Power"));
		$info->setIsHistorized(1);
		$info->setUnite('A');
		$info->setOrder(1);
		$info->save();
		
		$info = $this->getCmd(null, 'PV2_Current');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('PV2 Amps', __FILE__));
		}
		$info->setLogicalId('PV2_Current');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setConfiguration('minValue', 0);
		$info->setConfiguration('maxValue', 20); //$this->getConfiguration("Power"));
		$info->setIsHistorized(1);
		$info->setUnite('A');
		$info->setOrder(1);
		$info->save();
		
		$info = $this->getCmd(null, 'PV1_Voltage');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('Volts PV1', __FILE__));
		}
		$info->setLogicalId('PV1_Voltage');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setConfiguration('minValue', 0);
		$info->setConfiguration('maxValue', 500);
		$info->setIsHistorized(1);
		$info->setUnite('V');
		$info->setOrder(5);
		$info->save();
		
		$info = $this->getCmd(null, 'PV2_Voltage');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('Volts PV2', __FILE__));
		}
		$info->setLogicalId('PV2_Voltage');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setConfiguration('minValue', 0);
		$info->setConfiguration('maxValue', 500);
		$info->setIsHistorized(1);
		$info->setUnite('V');
		$info->setOrder(5);
		$info->save();
		
		$info = $this->getCmd(null, 'Grid_Current');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('Amps Réseau', __FILE__));
		}
		$info->setLogicalId('Grid_Current');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setConfiguration('minValue', 0);
		$info->setConfiguration('maxValue', 25);
		$info->setIsHistorized(1);
		$info->setUnite('A');
		$info->setOrder(6);
		$info->save();
		
		$info = $this->getCmd(null, 'Grid_Voltage');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('Volts Réseau', __FILE__));
		}
		$info->setLogicalId('Grid_Voltage');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setConfiguration('minValue', 0);
		$info->setConfiguration('maxValue', 500);
		$info->setIsHistorized(1);
		$info->setUnite('V');
		$info->setOrder(5);
		$info->save();
		
		$info = $this->getCmd(null, 'Grid_Power');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('PV Production', __FILE__));
		}
		$info->setLogicalId('Grid_Power');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setConfiguration('minValue', 0);
		$info->setConfiguration('maxValue', $this->getConfiguration("Power"));
		$info->setIsHistorized(1);
		$info->setUnite('W');
		$info->setOrder(1);
		$info->save();
		
		$info = $this->getCmd(null, 'Inner_Temp');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('Temp. Inter.', __FILE__));
		}
		$info->setLogicalId('Inner_Temp');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setConfiguration('minValue', 0);
		$info->setConfiguration('maxValue', 100);
		$info->setIsHistorized(1);
		$info->setUnite('°C');
		$info->setOrder(1);
		$info->save();
		
		$info = $this->getCmd(null, 'Solar_Today');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('Prod. Jour', __FILE__));
		}
		$info->setLogicalId('Solar_Today');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(1);
		$info->setUnite('KWh');
		$info->setOrder(1);
		$info->save();
		
		$info = $this->getCmd(null, 'Solar_Total');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('Prod. Tot.', __FILE__));
		}
		$info->setLogicalId('Solar_Total');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(1);
		$info->setUnite('KWh');
		$info->setOrder(1);
		$info->save();
		
		$info = $this->getCmd(null, 'Solar_Total2');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('Prod. Tot.2', __FILE__));
		}
		$info->setLogicalId('Solar_Total2');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(1);
		$info->setUnite('KWh');
		$info->setOrder(1);
		$info->save();
		
		$info = $this->getCmd(null, 'Feed_In_Power');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('P. Consommée', __FILE__));
		}
		$info->setLogicalId('Feed_In_Power');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(1);
		$info->setUnite('W');
		$info->setOrder(1);
		$info->save();
		
		$info = $this->getCmd(null, 'PV1_Power');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('PV1 Prod.', __FILE__));
		}
		$info->setLogicalId('PV1_Power');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(1);
		$info->setUnite('W');
		$info->setOrder(1);
		$info->save();
		
		$info = $this->getCmd(null, 'PV2_Power');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('PV2 Prod.', __FILE__));
		}
		$info->setLogicalId('PV2_Power');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(1);
		$info->setUnite('W');
		$info->setOrder(1);
		$info->save();
		
		$info = $this->getCmd(null, 'Battery_Voltage');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('Volts Batt.', __FILE__));
		}
		$info->setLogicalId('Battery_Voltage');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(1);
		$info->setUnite('V');
		$info->setOrder(5);
		$info->save();
		
		$info = $this->getCmd(null, 'Battery_Current');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('Amps Batt.', __FILE__));
		}
		$info->setLogicalId('Battery_Current');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(1);
		$info->setUnite('A');
		$info->setOrder(5);
		$info->save();
		
		$info = $this->getCmd(null, 'Battery_Temp');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('Temp. Batt.', __FILE__));
		}
		$info->setLogicalId('Battery_Temp');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(1);
		$info->setUnite('°C');
		$info->setOrder(5);
		$info->save();
		
		$info = $this->getCmd(null, 'Battery_Capacity');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('Capa. Batt.', __FILE__));
		}
		$info->setLogicalId('Battery_Capacity');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(1);
		$info->setUnite('A');
		$info->setOrder(5);
		$info->save();
		
		$info = $this->getCmd(null, 'Battery_Power');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('P. Batt.', __FILE__));
		}
		$info->setLogicalId('Battery_Power');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(1);
		$info->setUnite('W');
		$info->setOrder(5);
		$info->save();
		
		$info = $this->getCmd(null, 'Energy_From_Grid');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('P. <- Réseau', __FILE__));
		}
		$info->setLogicalId('Energy_From_Grid');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(1);
		$info->setUnite('W');
		$info->setOrder(5);
		$info->save();
		
		$info = $this->getCmd(null, 'Energy_To_Grid');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('P. -> Réseau', __FILE__));
		}
		$info->setLogicalId('Energy_To_Grid');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(1);
		$info->setUnite('W');
		$info->setOrder(5);
		$info->save();
		
		$info = $this->getCmd(null, 'Grid_Frequency');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('Fréq. Réseau', __FILE__));
		}
		$info->setLogicalId('Grid_Frequency');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setConfiguration('minValue', 0);
		$info->setConfiguration('maxValue', 60);
		$info->setIsHistorized(1);
		$info->setUnite('Hz');
		$info->setOrder(5);
		$info->save();
		
		$info = $this->getCmd(null, 'EPS_Voltage');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('Volts EPS', __FILE__));
		}
		$info->setLogicalId('EPS_Voltage');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(1);
		$info->setUnite('V');
		$info->setOrder(1);
		$info->save();
		
		$info = $this->getCmd(null, 'EPS_Current');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('Amps EPS', __FILE__));
		}
		$info->setLogicalId('EPS_Current');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(1);
		$info->setUnite('W');
		$info->setOrder(5);
		$info->save();
		
		$info = $this->getCmd(null, 'EPS_VA');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('VA EPS', __FILE__));
		}
		$info->setLogicalId('EPS_VA');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setIsHistorized(1);
		$info->setUnite('VA');
		$info->setOrder(5);
		$info->save();
		
		$info = $this->getCmd(null, 'EPS_Frequency');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('Fréq. EPS', __FILE__));
		}
		$info->setLogicalId('EPS_Frequency');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('numeric');
		$info->setConfiguration('minValue', 0);
		$info->setConfiguration('maxValue', 60);
		$info->setIsHistorized(1);
		$info->setUnite('Hz');
		$info->setOrder(5);
		$info->save();
		
		$info = $this->getCmd(null, 'status');
		if (!is_object($info)) {
			$info = new solaxCmd();
			$info->setName(__('Statut', __FILE__));
		}
		$info->setLogicalId('status');
		$info->setEqLogic_id($this->getId());
		$info->setType('info');
		$info->setSubType('string');
		$info->setIsHistorized(0);
		$info->setIsVisible(1);
		$info->setOrder(11);
		$info->save();
		
		$refresh = $this->getCmd(null, 'refresh');
		if (!is_object($refresh)) {
			$refresh = new solaxCmd();
			$refresh->setName(__('Rafraîchir', __FILE__));
		}
		$refresh->setEqLogic_id($this->getId());
		$refresh->setLogicalId('refresh');
		$refresh->setType('action');
		$refresh->setSubType('other');
		$refresh->setOrder(12);
		$refresh->save();
    }

    public function preUpdate() {
        
    }

    public function postUpdate() {
		$cmd = $this->getCmd(null, 'refresh'); // On recherche la commande refresh de l’équipement
		if (is_object($cmd)) { //elle existe et on lance la commande
			 $cmd->execCmd();
		}
    }

    public function preRemove() {
       
    }

    public function postRemove() {
        
    }
	
	public function getSolaxData() {
		$solax_IP = $this->getConfiguration("IP");
		$solax_Port = $this->getConfiguration("Port");
		
		if (strlen($solax_IP) == 0) {
			log::add('solax', 'debug','No IP defined for PV inverter interface ...');
			$this->checkAndUpdateCmd('status', 'IP onduleur manquante ...');
			return;
		}
		
		if (strlen($solax_Port) == 0) {
			$solax_Port = 80;
		}
	
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		
		// COLLECTING VALUES
		curl_setopt($ch, CURLOPT_URL, 'http://'.$solax_IP.':'.$solax_Port.'/api/realTimeData.htm');
		$data = curl_exec($ch);
		
		if (curl_errno($ch)) {
			curl_close ($ch);
			log::add('solax', 'error','Error getting inverter values: '.curl_error($ch));
			$this->checkAndUpdateCmd('status', 'Erreur Données');
			return;
		}

		$data = str_replace(',,', ',0,', $data);
		$data = str_replace(',,', ',0,', $data);
		$json = json_decode($data, true);
		
		$PV1_Current = $json['Data']['0']; 			//1: PV1 Current
		$PV2_Current = $json['Data']['1']; 			//2: PV2 Current
		$PV1_Voltage = $json['Data']['2']; 			//3: PV1 Voltage
		$PV2_Voltage = $json['Data']['3']; 			//4: PV2 Voltage
		$Grid_Current = $json['Data']['4'];			//5: Grid Current
		$Grid_Voltage = $json['Data']['5']; 		//6: Grid Voltage
		$Grid_Power = $json['Data']['6'];  			//7: Grid Power
		$Inner_Temp = $json['Data']['7'];  			//8: Inner Temp
		$Solar_Today = $json['Data']['8']; 			//9: Solar Today
		$Solar_Total = $json['Data']['9']; 			//10: Solar Total
		$Feed_In_Power = $json['Data']['10']; 		//11: Feed In Power
		$PV1_Power = $json['Data']['11']; 			//12: PV1 Power
		$PV2_Power = $json['Data']['12']; 			//13: PV2 Power
		$Battery_Voltage = $json['Data']['13']; 	//14: Battery Voltage
		$Battery_Current = $json['Data']['14']; 	//15: Battery Current
		$Battery_Power = $json['Data']['15']; 		//16: Battery Power
		$Battery_Temp = $json['Data']['16']; 		//17: Battery Temp
		$Battery_Capacity = $json['Data']['18']; 	//19: Battery Capacity
		$Solar_Total2 = $json['Data']['19']; 		//20: Solar Total 2
		$Energy_To_Grid = $json['Data']['41']; 		//42: Energy to Grid
		$Energy_From_Grid = $json['Data']['42']; 	//43: Energy from Grid
		$Grid_Frequency = $json['Data']['50']; 		//51: Grid Frequency
		$EPS_Voltage = $json['Data']['53']; 		//54: EPS Voltage
		$EPS_Current = $json['Data']['54']; 		//55: EPS Current
		$EPS_VA = $json['Data']['55']; 				//56: EPS VA
		$EPS_Frequency = $json['Data']['56'];  		//57: EPS Frequency
		
		if ($Grid_Power == '') {
			$this->checkAndUpdateCmd('PV1_Current', 0);
			$this->checkAndUpdateCmd('PV2_Current', 0);
			$this->checkAndUpdateCmd('PV1_Voltage', 0);
			$this->checkAndUpdateCmd('PV2_Voltage', 0);
			$this->checkAndUpdateCmd('Grid_Current', 0);
			$this->checkAndUpdateCmd('Grid_Voltage', 0);
			$this->checkAndUpdateCmd('Grid_Power', 0);
			$this->checkAndUpdateCmd('Inner_Temp', 0);
			$this->checkAndUpdateCmd('Solar_Today', 0);
			$this->checkAndUpdateCmd('Solar_Total', 0);
			$this->checkAndUpdateCmd('Feed_In_Power', 0);
			$this->checkAndUpdateCmd('PV1_Power', 0);
			$this->checkAndUpdateCmd('PV2_Power', 0);
			$this->checkAndUpdateCmd('Battery_Voltage', 0);
			$this->checkAndUpdateCmd('Battery_Temp', 0);
			$this->checkAndUpdateCmd('Battery_Current', 0);
			$this->checkAndUpdateCmd('Battery_Capacity', 0);
			$this->checkAndUpdateCmd('Battery_Power', 0);
			$this->checkAndUpdateCmd('Solar_Total2', 0);
			$this->checkAndUpdateCmd('Energy_From_Grid', 0);
			$this->checkAndUpdateCmd('Energy_To_Grid', 0);
			$this->checkAndUpdateCmd('Grid_Frequency', 0);
			$this->checkAndUpdateCmd('EPS_Voltage', 0);
			$this->checkAndUpdateCmd('EPS_Current', 0);
			$this->checkAndUpdateCmd('EPS_VA', 0);
			$this->checkAndUpdateCmd('EPS_Frequency', 0);
								
			$this->checkAndUpdateCmd('status', 'Hors Ligne ...');
			log::add('solax', 'debug','Inverter is off-line ...');
			return;
		} else {
			curl_close ($ch);
			$this->checkAndUpdateCmd('PV1_Current', $PV1_Current);
			$this->checkAndUpdateCmd('PV2_Current', $PV2_Current);
			$this->checkAndUpdateCmd('PV1_Voltage', $PV1_Voltage);
			$this->checkAndUpdateCmd('PV2_Voltage', $PV2_Voltage);
			$this->checkAndUpdateCmd('Grid_Current', $Grid_Current);
			$this->checkAndUpdateCmd('Grid_Voltage', $Grid_Voltage);
			$this->checkAndUpdateCmd('Grid_Power', $Grid_Power);
			$this->checkAndUpdateCmd('Inner_Temp', $Inner_Temp);
			$this->checkAndUpdateCmd('Solar_Today', $Solar_Today);
			$this->checkAndUpdateCmd('Solar_Total', $Solar_Total);
			$this->checkAndUpdateCmd('Feed_In_Power', $Feed_In_Power);
			$this->checkAndUpdateCmd('PV1_Power', $PV1_Power);
			$this->checkAndUpdateCmd('PV2_Power', $PV2_Power);
			$this->checkAndUpdateCmd('Battery_Voltage', $Battery_Voltage);
			$this->checkAndUpdateCmd('Battery_Temp', $Battery_Temp);
			$this->checkAndUpdateCmd('Battery_Current', $Battery_Current);
			$this->checkAndUpdateCmd('Battery_Capacity', $Battery_Capacity);
			$this->checkAndUpdateCmd('Battery_Power', $Battery_Power);
			$this->checkAndUpdateCmd('Solar_Total2', $Solar_Total2);
			$this->checkAndUpdateCmd('Energy_From_Grid', $Energy_From_Grid);
			$this->checkAndUpdateCmd('Energy_To_Grid', $Energy_To_Grid);
			$this->checkAndUpdateCmd('Grid_Frequency', $Grid_Frequency);
			$this->checkAndUpdateCmd('EPS_Voltage', $EPS_Voltage);
			$this->checkAndUpdateCmd('EPS_Current', $EPS_Current);
			$this->checkAndUpdateCmd('EPS_VA', $EPS_VA);
			$this->checkAndUpdateCmd('EPS_Frequency', $EPS_Frequency);
			
			$this->checkAndUpdateCmd('status', 'OK');
			log::add('solax', 'debug','All good: Data='.$data);
			return;
		}	
	}
	
    /*
     * Non obligatoire mais permet de modifier l'affichage du widget si vous en avez besoin
      public function toHtml($_version = 'dashboard') {

      }
     */

    /*
     * Non obligatoire mais ca permet de déclencher une action après modification de variable de configuration
    public static function postConfig_<Variable>() {
    }
     */

    /*
     * Non obligatoire mais ca permet de déclencher une action avant modification de variable de configuration
    public static function preConfig_<Variable>() {
    }
     */

    /*     * **********************Getteur Setteur*************************** */
}

class solaxCmd extends cmd {
    /*     * *************************Attributs****************************** */


    /*     * ***********************Methode static*************************** */


    /*     * *********************Methode d'instance************************* */

    /*
     * Non obligatoire permet de demander de ne pas supprimer les commandes même si elles ne sont pas dans la nouvelle configuration de l'équipement envoyé en JS
      public function dontRemoveCmd() {
      return true;
      }
     */

    public function execute($_options = array()) {
				$eqlogic = $this->getEqLogic();
				switch ($this->getLogicalId()) {		
					case 'refresh':
						$info = $eqlogic->getSolaxData();
						break;					
		}
    }
    /*     * **********************Getteur Setteur*************************** */
}


