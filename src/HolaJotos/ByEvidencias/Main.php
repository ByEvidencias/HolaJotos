<?php

namespace HolaJotos\ByEvidencias;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use pocketmine\utils\SingletonTrait;
use HolaJotos\ByEvidencias\events\Join;
use HolaJotos\ByEvidencias\events\Quit;

class Main extends PluginBase implements Listener {
    use SingletonTrait;

    protected function onEnable(): void {
        self::setInstance($this); 

        $this->getServer()->getPluginManager()->registerEvents(new Join(), $this);
        $this->getServer()->getPluginManager()->registerEvents(new Quit(), $this);
    }
}
