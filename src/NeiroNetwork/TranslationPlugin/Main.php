<?php

declare(strict_types=1);

namespace NeiroNetwork\TranslationPlugin;

use pocketmine\plugin\PluginBase;

class Main extends PluginBase{

	protected function onLoad() : void{
		foreach($this->getServer()->getPluginManager()->getPlugins() as $plugin){
			foreach($plugin->getResources() as $file){
				if($file->getExtension() === "ini"){
					$code = $file->getBasename(".{$file->getExtension()}");
					LanguageFactory::getInstance()->get($code)->addLang($file->getPath(), $code);
				}
			}
		}
	}

	protected function onEnable() : void{
		$this->getServer()->getPluginManager()->registerEvents(new EventListener(), $this);
	}
}