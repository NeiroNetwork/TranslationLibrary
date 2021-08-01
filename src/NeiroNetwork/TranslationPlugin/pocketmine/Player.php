<?php

declare(strict_types=1);

namespace NeiroNetwork\TranslationPlugin\pocketmine;

use NeiroNetwork\TranslationPlugin\LanguageFactory;
use pocketmine\lang\Language;
use pocketmine\player\Player as PmPlayer;

class Player extends PmPlayer{

	public function getLanguage() : Language{
		return LanguageFactory::getInstance()->get($this->getLocale());
	}
}