<?php

declare(strict_types=1);

namespace NeiroNetwork\TranslationPlugin\api;

use pocketmine\command\CommandSender;
use pocketmine\lang\TranslationContainer;
use pocketmine\player\Player;
use pocketmine\Server;

final class Broadcast{

	/**
	 * @return Player[]
	 * @see Server::getPlayerBroadcastSubscribers()
	 */
	private function getPlayerBroadcastSubscribers(string $channelId) : array{
		/** @var Player[] $players */
		$players = [];
		foreach(Server::getInstance()->getBroadcastChannelSubscribers($channelId) as $subscriber){
			if($subscriber instanceof Player){
				$players[spl_object_id($subscriber)] = $subscriber;
			}
		}
		return $players;
	}

	/**
	 * @param TranslationContainer|string $message
	 * @param CommandSender[]|null        $recipients
	 */
	public function message($message, ?array $recipients = null) : int{
		return Server::getInstance()->broadcastMessage($message, $recipients);
	}

	/**
	 * @param TranslationContainer|string $tip
	 * @param Player[]|null $recipients
	 */
	public function tip($tip, ?array $recipients = null) : int{
		$recipients = $recipients ?? self::getPlayerBroadcastSubscribers(Server::BROADCAST_CHANNEL_USERS);

		foreach($recipients as $recipient){
			$recipient->sendTip($tip);
		}

		return count($recipients);
	}

	/**
	 * @param TranslationContainer|string $popup
	 * @param Player[]|null $recipients
	 */
	public function popup($popup, ?array $recipients = null) : int{
		$recipients = $recipients ?? self::getPlayerBroadcastSubscribers(Server::BROADCAST_CHANNEL_USERS);

		foreach($recipients as $recipient){
			$recipient->sendPopup($popup);
		}

		return count($recipients);
	}

	/**
	 * @param TranslationContainer|string $title
	 * @param TranslationContainer|string $subtitle
	 * @param Player[]|null $recipients
	 */
	public function title($title, $subtitle = "", int $fadeIn = -1, int $stay = -1, int $fadeOut = -1, ?array $recipients = null) : int{
		$recipients = $recipients ?? self::getPlayerBroadcastSubscribers(Server::BROADCAST_CHANNEL_USERS);

		foreach($recipients as $recipient){
			$recipient->sendTitle($title, $subtitle, $fadeIn, $stay, $fadeOut);
		}

		return count($recipients);
	}
}