<?php

declare(strict_types=1);

namespace NeiroNetwork\TranslationPlugin\pocketmine;

use pocketmine\lang\Language as PmLanguage;

class Language extends PmLanguage{

	public const FALLBACK_LOCALE = "ja_JP";

	public function addLang(string $path, string $languageCode, string $fallback = self::FALLBACK_LOCALE) : void{
		$this->lang = array_merge($this->lang, self::loadLang($path, $languageCode));
		$this->fallbackLang = array_merge($this->fallbackLang, self::loadLang($path, $fallback));
	}
}