<?php

declare(strict_types=1);

namespace NeiroNetwork\TranslationPlugin;

use NeiroNetwork\TranslationPlugin\pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerCreationEvent;
use pocketmine\plugin\PluginBase;

class Main extends PluginBase implements Listener{

	private static self $instance;

	public static function getInstance() : self{
		return self::$instance;
	}

	protected function onEnable() : void{
		self::$instance = $this;
		$this->getServer()->getPluginManager()->registerEvents($this, $this);
	}

	public function onPlayerCreation(PlayerCreationEvent $event){
		$event->setPlayerClass(Player::class);
	}
}