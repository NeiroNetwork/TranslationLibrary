<?php

declare(strict_types=1);

namespace NeiroNetwork\TranslationPlugin\api;

use NeiroNetwork\TranslationPlugin\LanguageFactory;
use pocketmine\plugin\Plugin;

final class LangAPI{

	public static function loadLangs(Plugin $plugin) : void{
		foreach($plugin->getResources() as $file){
			$code = $file->getBasename(".{$file->getExtension()}");
			LanguageFactory::getInstance()->get($code)->addLang($file->getPath(), $code);
		}
	}
}