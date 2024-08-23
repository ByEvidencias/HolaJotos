<?php

namespace HolaJotos\ByEvidencias\events;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use HolaJotos\ByEvidencias\Main;

class Quit implements Listener {

    public function onPlayerQuit(PlayerQuitEvent $event): void {
        $event->setQuitMessage("");
        $player = $event->getPlayer();
        $plugin = Main::getInstance(); 
        $message = $plugin->getConfig()->get("quit-message", "&c[-] &e{player} &cse ha salido del servidor!");
        $message = str_replace("{player}", $player->getName(), $message);
        $message = $this->translateColors($message);
        $plugin->getServer()->broadcastMessage($message);
        $event->setQuitMessage("");
    }

    private function translateColors(string $message): string {
        return str_replace(["&", "§"], "§", $message);
    }
}
