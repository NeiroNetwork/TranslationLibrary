# TranslationPlugin
プラグインを簡単に多言語対応させることができるやつ

## 使い方
プラグインの`resources`フォルダに`ロケール.ini`というファイルを作成する。  
例のように日本語なら`ja_JP.ini`のようにする。
```ini
myplugin.message.welcome = "ようこそ！"
myplugin.message.welcome_name = "{%0}さん！"
myplugin.message.ping_info = "あなたのPINGは{%0}msです。"
```
プラグインでは`LangAPI::loadLangs()`を呼び出す。
```php
<?php

use NeiroNetwork\TranslationPlugin\api\LangAPI;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\lang\TranslationContainer;
use pocketmine\plugin\PluginBase;

class MyPlugin extends PluginBase implements Listener{

    protected function onEnable() : void{
        LangAPI::loadLangs($this);
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        $player->sendMessage("myplugin.message.welcome");
        $player->sendMessage(new TranslationContainer("myplugin.message.welcome_name", [$player->getName()]));
        $player->sendTranslation("myplugin.message.ping_info", [$player->getNetworkSession()->getPing()]);
        $player->sendTip($player->getLanguage()->translateString("myplugin.message.welcome"));
    }
}
```

## ロケール一覧
<!---
  https://github.com/ZtechNetwork/MCBVanillaResourcePack/blob/master/texts/language_names.json
--->
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