<?php

/** 
*     _    _ _                  ____ 
*    / \  | (_) ___ __ _ _ __  / ___|
*   / _ \ | | |/ __/ _` | '_ \| |    
*  / ___ \| | | (_| (_| | | | | |___ 
* /_/   \_\_|_|\___\__,_|_| |_|\____|
*                                 
*                                  
* -I'm getting stronger if I'm not dying-
*
*@version 1.0
*@author AlicanCopur
*@copyright HashCube Network© | 2015 - 2020
*@license Açık yazılım lisansı altındadır. Tüm hakları saklıdır. 
*/            

namespace AlicanCopur\AntiDefaultCommand;

use pocketmine\plugin\PluginBase;
use pocketmine\utils\Config;

class Main extends PluginBase {
	
	private $commands;
	public function onEnable(){
    	@mkdir($this->getDataFolder());
		$this->saveResource("Config.yml");
		$cfg = new Config($this->getDataFolder()."Config.yml", Config::YAML);
		$this->commands = $cfg->get("Commands");
		$this->removeDefaultCommands();
	}
	private function removeDefaultCommands(){
		$map = $this->getServer()->getCommandMap();
		foreach($this->commands as $cmdname){
			$cmd = $map->getCommand($cmdname);
			if($cmd != null){
				$map->unregister($cmd);
			}
		}
		return true;
	}
}
