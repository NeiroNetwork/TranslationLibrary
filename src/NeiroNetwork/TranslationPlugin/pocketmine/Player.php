<?php

declare(strict_types=1);

namespace NeiroNetwork\TranslationPlugin\pocketmine;

use NeiroNetwork\TranslationPlugin\LanguageFactory;
use pocketmine\entity\Location;
use pocketmine\lang\TranslationContainer;
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

	/**
	 * @param TranslationContainer|string $message
	 */
	public function sendTip($message) : void{
		parent::sendTip($this->translate($message));
	}

	/**
	 * @param TranslationContainer|string $message
	 */
	private function translate($message) : string{
		if($message instanceof TranslationContainer){
			return $this->getLanguage()->translateString($message->getText(), $message->getParameters());
		}
		return $this->getLanguage()->translateString((string) $message);
	}

	public function getLanguage() : Language{
		return $this->language;
	}

	/**
	 * @param TranslationContainer|string $message
	 */
	public function sendPopup($message) : void{
		parent::sendPopup($this->translate($message));
	}

	/**
	 * @param TranslationContainer|string $message
	 */
	public function sendActionBarMessage($message) : void{
		parent::sendActionBarMessage($this->translate($message));
	}

	/**
	 * @param TranslationContainer|string $title
	 * @param TranslationContainer|string $subtitle
	 */
	public function sendTitle($title, $subtitle = "", int $fadeIn = -1, int $stay = -1, int $fadeOut = -1) : void{
		parent::sendTitle($this->translate($title), $this->translate($subtitle), $fadeIn, $stay, $fadeOut);
	}

	/**
	 * @param TranslationContainer|string $subtitle
	 */
	public function sendSubTitle($subtitle) : void{
		parent::sendSubTitle($this->translate($subtitle));
	}

	public function sendJukeboxPopup(string $key, array $args) : void{
		parent::sendJukeboxPopup($key, $args); // TODO: Change the autogenerated stub
	}
}