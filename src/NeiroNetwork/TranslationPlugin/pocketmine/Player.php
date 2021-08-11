<?php

declare(strict_types=1);

namespace NeiroNetwork\TranslationPlugin\pocketmine;

use NeiroNetwork\TranslationPlugin\LanguageFactory;
use pocketmine\entity\Location;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\NetworkSession;
use pocketmine\player\Player as PmPlayer;
use pocketmine\player\PlayerInfo;
use pocketmine\Server;

class Player extends PmPlayer{

	private Language $language;

	public function __construct(Server $server, NetworkSession $session, PlayerInfo $playerInfo, bool $authenticated, Location $spawnLocation, ?CompoundTag $namedtag){
		parent::__construct($server, $session, $playerInfo, $authenticated, $spawnLocation, $namedtag);
		$this->language = LanguageFactory::getInstance()->get($this->getLocale());
	}

	public function getLanguage() : Language{
		return $this->language;
	}
}