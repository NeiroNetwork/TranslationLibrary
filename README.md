# TranslationLibrary
プラグインを簡単に多言語対応させることができるやつ

## 使い方
### 翻訳ファイルを用意する
プラグインの`resources`フォルダに`ロケール.ini`というファイルを作成する。  
例のように日本語なら`ja_JP.ini`のようにする。
```ini
myplugin.message.welcome = "〇〇サーバーへようこそ！"
myplugin.message.player_joined = "{%0}さんが参加しました"
```

### 翻訳したいメッセージを送信する

```php
<?php

use NeiroNetwork\TranslationPlugin\api\Broadcast;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\lang\Translatable;
use pocketmine\plugin\PluginBase;

class MyPlugin extends PluginBase implements Listener{

    protected function onEnable() : void{
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
    }

    public function onJoin(PlayerJoinEvent $event){
        $player = $event->getPlayer();
        $player->sendMessage(new Translatable("myplugin.message.welcome"));
        Broadcast::tip(new Translatable("myplugin.message.player_joined", [$player->getName()]));
    }
}
```

## 注意
- プラグインの`onLoad`、`onEnable`では期待通りに翻訳が送信できるとは限らないので注意が必要。（使わないのが好ましい）
- フォールバックロケールは`ja_JP`に設定されているので、翻訳ファイルは必ず`ja_JP.ini`を用意しなければならない。

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