<?php

namespace HolaJotos\ByEvidencias;

use pocketmine\plugin\PluginBase;
use pocketmine\event\Listener;
use HolaJotos\ByEvidencias\events\Join;
use HolaJotos\ByEvidencias\events\Quit;
use pocketmine\utils\TextFormat;

class Main extends PluginBase implements Listener {

    public function onEnable(): void {
        $this->getServer()->getPluginManager()->registerEvents(new Join($this), $this);
        $this->getServer()->getPluginManager()->registerEvents(new Quit($this), $this);
        
        $this->getLogger()->info(TextFormat::GREEN . "HolaJotos plugin has been enabled!");
    }

    public function onDisable(): void {
        $this->getLogger()->info(TextFormat::RED . "HolaJotos plugin has been disabled!");
    }
}
