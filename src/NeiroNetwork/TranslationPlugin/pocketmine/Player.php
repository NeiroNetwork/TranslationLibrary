<?php

declare(strict_types=1);

namespace NeiroNetwork\TranslationPlugin\pocketmine;

use NeiroNetwork\TranslationPlugin\LanguageFactory;
use pocketmine\entity\Location;
use pocketmine\event\player\PlayerChatEvent;
use pocketmine\event\player\PlayerCommandPreprocessEvent;
use pocketmine\nbt\tag\CompoundTag;
use pocketmine\network\mcpe\NetworkSession;
use pocketmine\player\Player as PmPlayer;
use pocketmine\player\PlayerInfo;
use pocketmine\Server;
use pocketmine\timings\Timings;
use pocketmine\utils\TextFormat;

class Player extends PmPlayer{

	private Language $language;

	public function __construct(Server $server, NetworkSession $session, PlayerInfo $playerInfo, bool $authenticated, Location $spawnLocation, ?CompoundTag $namedtag){
		parent::__construct($server, $session, $playerInfo, $authenticated, $spawnLocation, $namedtag);
		$this->language = LanguageFactory::getInstance()->get($this->getLocale());
	}

	public function getLanguage() : Language{
		return $this->language;
	}

	/**
	 * @see PmPlayer::chat()
	 */
	public function chat(string $message) : bool{
		$this->doCloseInventory();

		$message = TextFormat::clean($message, false);
		foreach(explode("\n", $message) as $messagePart){
			if(trim($messagePart) !== "" and strlen($messagePart) <= 255 and $this->messageCounter-- > 0){
				if(str_starts_with($messagePart, './')){
					$messagePart = substr($messagePart, 1);
				}

				$ev = new PlayerCommandPreprocessEvent($this, $messagePart);
				$ev->call();

				if($ev->isCancelled()){
					break;
				}

				if(str_starts_with($ev->getMessage(), "/")){
					Timings::$playerCommand->startTiming();
					$this->server->dispatchCommand($ev->getPlayer(), substr($ev->getMessage(), 1));
					Timings::$playerCommand->stopTiming();
				}else{
					$ev = new PlayerChatEvent($this, $ev->getMessage(), $this->server->getBroadcastChannelSubscribers(Server::BROADCAST_CHANNEL_USERS));
					$ev->call();
					if(!$ev->isCancelled()){
						// プレイヤーが送信したチャットは翻訳しないでください
						$tmpMessage = $this->getServer()->getLanguage()->translateString($ev->getFormat(), [$ev->getPlayer()->getDisplayName()]);
						$tmpMessage = str_replace("{%1}", $ev->getMessage(), $tmpMessage);
						$this->server->broadcastMessage($tmpMessage, $ev->getRecipients());
					}
				}
			}
		}

		return true;
	}
}