<?php

declare(strict_types=1);

namespace NeiroNetwork\TranslationPlugin\api;

use pocketmine\command\CommandSender;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\Server;

final class Broadcast{

	/**
	 * @param CommandSender[]|null $recipients
	 */
	public static function message(Translatable|string $message, ?array $recipients = null) : int{
		return Server::getInstance()->broadcastMessage($message, $recipients);
	}

	/**
	 * @param Player[]|null $recipients
	 */
	public static function tip(Translatable|string $tip, ?array $recipients = null) : int{
		$recipients = $recipients ?? self::getPlayerBroadcastSubscribers(Server::BROADCAST_CHANNEL_USERS);

		foreach($recipients as $recipient){
			$recipient->sendTip($tip);
		}

		return count($recipients);
	}

	/**
	 * @return Player[]
	 * @see Server::getPlayerBroadcastSubscribers()
	 */
	private static function getPlayerBroadcastSubscribers(string $channelId) : array{
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
	 * @param Player[]|null $recipients
	 */
	public static function popup(Translatable|string $popup, ?array $recipients = null) : int{
		$recipients = $recipients ?? self::getPlayerBroadcastSubscribers(Server::BROADCAST_CHANNEL_USERS);

		foreach($recipients as $recipient){
			$recipient->sendPopup($popup);
		}

		return count($recipients);
	}

	/**
	 * @param Player[]|null $recipients
	 */
	public static function title(Translatable|string $title, Translatable|string $subtitle = "", int $fadeIn = -1, int $stay = -1, int $fadeOut = -1, ?array $recipients = null) : int{
		$recipients = $recipients ?? self::getPlayerBroadcastSubscribers(Server::BROADCAST_CHANNEL_USERS);

		foreach($recipients as $recipient){
			$recipient->sendTitle($title, $subtitle, $fadeIn, $stay, $fadeOut);
		}

		return count($recipients);
	}
}