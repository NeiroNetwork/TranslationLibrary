<?php

declare(strict_types=1);

namespace NeiroNetwork\TranslationPlugin;

use pocketmine\plugin\PluginBase;
use ReflectionClass;

class Main extends PluginBase{

	protected function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);

		foreach($this->getServer()->getPluginManager()->getPlugins() as $plugin){
			foreach($plugin->getResources() as $file){
				if($file->getExtension() === "ini"){
					$code = $file->getBasename(".{$file->getExtension()}");
					LanguageFactory::getInstance()->get($code)->addLang($file->getPath(), $code);
				}
			}
		}

		$property = (new ReflectionClass($this->getServer()))->getProperty("forceLanguage");
		$property->setAccessible(true);
		$property->setValue($this->getServer(), true);
	}
}