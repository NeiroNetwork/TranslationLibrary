<?php

declare(strict_types=1);

namespace NeiroNetwork\TranslationLibrary;

use pocketmine\lang\Language;
use pocketmine\lang\LanguageNotFoundException;
use pocketmine\lang\Translatable;
use pocketmine\player\Player;
use pocketmine\plugin\PluginBase;

class Translator{

	/** @var Language[] */
	protected array $languages = [];

	public function __construct(PluginBase $plugin, protected string $baseLocale = "ja_JP"){
		foreach($plugin->getResources() as $info){
			$name = $info->getBasename("." . $ext = $info->getExtension());
			if($ext === "ini" && preg_match("/[a-z]{2}_[A-Z]{2}/", $name) === 1){
				$this->languages[$name] = new Language($name, $info->getPath(), $baseLocale);
			}
		}

		if(!isset($this->languages[$baseLocale])){
			throw new LanguageNotFoundException("Base locale \"$baseLocale\" not found");
		}
	}

	public function translate(Translatable $translatable, ?Player $player = null) : string{
		$language = $this->languages[$player?->getLocale()] ?? $this->languages[$this->baseLocale];
		return $language->translate($translatable);
	}

	public function t(Translatable $translatable, ?Player $player = null) : string{
		return $this->translate($translatable, $player);
	}
}
