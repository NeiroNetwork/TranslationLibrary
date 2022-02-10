# TranslationLibrary
プラグインを簡単に多言語対応させることができるライブラリ

## 使い方
### 翻訳ファイルを用意する
プラグインの`resources`フォルダに`ロケール.ini`というファイルを作成する。  
例えば日本語なら`ja_jp.ini`のようにする。  
注意点としては、ファイル名は小文字である必要がある。
```ini
my_first_message = "これが初めてのメッセージです"
message.hello = "こんにちは！{%0}さん。"
```

### 翻訳したいメッセージを送信する
```php
<?php

use NeiroNetwork\TranslationLibrary\Translator;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\lang\Translatable;
use pocketmine\plugin\PluginBase;

class MyPlugin extends PluginBase implements Listener{

    private Translator $l;

    protected function onEnable() : void{
        $this->l = new Translator($this, "ja_jp");
        $this->getLogger()->info($this->l->t(new Translatable("my_first_message")));

        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        $player->sendMessage($this->l->t(new Translatable("message.hello", [$player->getName()]), $player));
    }
}
```

## ロケール一覧
参照: https://github.com/ZtechNetwork/MCBVanillaResourcePack/blob/master/texts/language_names.json

| ロケールコード | 名称 |
| --- | --- |
| en_US | English (US) |
| en_GB | English (UK) |
| de_DE | Deutsch (Deutschland) |
| es_ES | Español (España) |
| es_MX | Español (México) |
| fr_FR | Français (France) |
| fr_CA | Français (Canada) |
| it_IT | Italiano (Italia) |
| ja_JP | 日本語 (日本) |
| ko_KR | 한국어 (대한민국) |
| pt_BR | Português (Brasil) |
| pt_PT | Português (Portugal) |
| ru_RU | Русский (Россия) |
| zh_CN | 简体中文 |
| zh_TW | 繁體中文 |
| nl_NL | Nederlands (Nederland) |
| bg_BG | Български (BG) |
| cs_CZ | Čeština (Česká republika) |
| da_DK | Dansk (DA) |
| el_GR | Ελληνικά (Ελλάδα) |
| fi_FI | Suomi (Suomi) |
| hu_HU | Magyar (HU) |
| id_ID | Bahasa Indonesia (Indonesia) |
| nb_NO | Norsk bokmål (Norge) |
| pl_PL | Polski (PL) |
| sk_SK | Slovensky (SK) |
| sv_SE | Svenska (Sverige) |
| tr_TR | Türkçe (Türkiye) |
| uk_UA | Українська (Україна) |