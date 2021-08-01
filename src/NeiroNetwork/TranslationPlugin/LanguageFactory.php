<?php

declare(strict_types=1);

namespace NeiroNetwork\TranslationPlugin;

use NeiroNetwork\TranslationPlugin\pocketmine\Language;
use pocketmine\lang\LanguageNotFoundException;
use pocketmine\utils\SingletonTrait;

final class LanguageFactory{
	use SingletonTrait;

	/** @var Language[] */
	private array $list = [];

	public function __construct(){
		$this->register("id_ID", "ind");
		$this->register("da_DK", "dan");
		$this->register("de_DE", "deu");
		$this->register("en_GB", "eng");
		$this->register("en_US", "eng");
		$this->register("es_ES", "spa");
		$this->register("es_MX", "spa");
		$this->register("fr_CA", "fra");
		$this->register("fr_FR", "fra");
		$this->register("it_IT", "ita");
		$this->register("hu_HU", "hun");
		$this->register("nl_NL", "nld");
		$this->register("nb_NO", "nob");
		$this->register("pl_PL", "pol");
		$this->register("pt_BR", "por");
		$this->register("pt_PT", "por");
		$this->register("sk_SK", "slk");
		$this->register("fi_FI", "fin");
		$this->register("sv_SE", "swe");
		$this->register("tr_TR", "tur");
		$this->register("cs_CZ", "ces");
		$this->register("el_GR", "ell");
		$this->register("bg_BG", "bul");
		$this->register("ru_RU", "rus");
		$this->register("uk_UA", "ukr");
		$this->register("ja_JP", "jpn");
		$this->register("zh_CN", "zho");
		$this->register("zh_TW", "zho");
		$this->register("ko_KR", "kor");
	}

	public function register(string $locale, string $lang) : void{
		try{
			$l = new Language($lang);
		}catch(LanguageNotFoundException $e){
			$l = new Language(Language::FALLBACK_LANGUAGE);
		}
		$this->list[$locale] = $l;
	}

	public function get(string $locale) : Language{
		if(isset($this->list[$locale])){
			return $this->list[$locale];
		}
		throw new LanguageNotFoundException("Locale \"$locale\" not found");
	}

	public function getAllRegistered() : array{
		return $this->list;
	}
}