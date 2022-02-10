<?php

declare(strict_types=1);

namespace NeiroNetwork\TranslationPlugin;

use NeiroNetwork\TranslationPlugin\pocketmine\Player;
use pocketmine\event\Listener;
use pocketmine\event\player\PlayerCreationEvent;

class EventListener implements Listener{

	public function onPlayerCreation(PlayerCreationEvent $event){
		$event->setPlayerClass(Player::class);
	}
}