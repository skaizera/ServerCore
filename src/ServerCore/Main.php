<?php

namespace ServerCore;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\PluginBase;
use pocketmine\utils\TextFormat;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\event\Listener;
use pocketmine\entity\Entity;
use pocketmine\level\Level;

class Main extends PluginBase implements Listener {
	
		public function onLoad() : void{
				$this->getLogger()->info("§6ServerCore Plugin §aenabled");
		}
	
		public function onCommand(CommandSender $sender, Command $command, string $label, array $args) : bool{
				switch($command->getName()){
						case "servercore":
							if($sender instanceof Player){
								$sender->sendMessage("§6Plugin created and developed by: §cSkaizera");
							} else {
								
							}
						break;
						
						case "ci":
							if($sender instanceof Player){
								if($sender->hasPermission("servercore.ci")){
									$sender->getArmorInventory()->clearAll();
									$sender->getInventory()->clearAll();
									$sender->sendMessage("§6Your inventory has been cleared.");
								}
							} else {
								
							}
						break;
						
						case "fly":
							if($sender instanceof Player){
								if($sender->hasPermission("servercore.fly")){
									if(!isset($this->flyList[$sender->getName()])){
										$this->flyList[$sender->getName()] = $sender->getName();
										$sender->setFlying(true);
										$sender->setAllowFlight(true);
										$sender->sendMessage("§6Flying enabled.");
									} else {
										unset($this->flyList[$sender->getName()]);
										$sender->setFlying(false);
										$sender->setAllowFlight(false);
										$sender->sendMessage("§6Flying disabled.");
									}
								}
								
							}
						break;

						case "vanish":
							if($sender instanceof Player){
								if($sender->hasPermission("servercore.vanish")){
									if(!isset($this->vanish[$sender->getName()])){
											$this->vanish[$sender->getName()] = true;
											$sender->setDataFlag(Entity::DATA_FLAGS, Entity::DATA_FLAG_INVISIBLE, true);
											$sender->setNameTagVisible(false);
											$sender->sendMessage("§6You are vanished.");
									} else {
										unset($this->vanish[$sender->getName()]);
										$sender->setDataFlag(Entity::DATA_FLAGS, Entity::DATA_FLAG_INVISIBLE, false);
										$sender->setNameTagVisible(true);
										$sender->sendMessage("§6You are no longer vanished.");
									}
								}

							}
						break;

						case "heal":
							if($sender instanceof Player){
								if($sender->hasPermission("servercore.heal")){
									$sender->setHealth($sender->getMaxHealth());
									$sender->sendMessage("§6You have been healed.");
								}
							} else {

							}
						break;

						case "spawn":
							if($sender instanceof Player){
								if($sender->hasPermission("servercore.spawn")){
									$sender->teleport($this->getServer()->getDefaultLevel()->getSafeSpawn());
									$sender->sendMessage("§6Teleporting to spawn...");
								}
							} else {

							}
						break;

						case "vcore":
							if($sender instanceof Player){
								$sender->sendMessage("§6This server uses the ServerCore plugin which is developed by Skaizera. More informations related our plugin support soon.");
				            } else {

							}
						break;
				}
				
			return true;
		}
}