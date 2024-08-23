<?php

namespace HolaJotos\ByEvidencias\events;

use pocketmine\player\Player;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use HolaJotos\ByEvidencias\Main;

class Join implements Listener {

    public function onPlayerJoin(PlayerJoinEvent $event): void { 
        $player = $event->getPlayer();
        $plugin = Main::getInstance();
        $message = $plugin->getConfig()->get("welcome-message", "&a[+] &e{player} &ase ha unido al servidor!");
        $message = str_replace("{player}", $player->getName(), $message);
        $message = $this->translateColors($message);
        $plugin->getServer()->broadcastMessage($message);
        $this->sendPrivateMessage($player);
        $event->setJoinMessage("");
    }

    private function sendPrivateMessage(Player $player): void { 
        $plugin = Main::getInstance();
        $privateMessageLines = $plugin->getConfig()->get("private-message", []);
        $privateMessage = implode("\n", $privateMessageLines);
        $privateMessage = str_replace("{player}", $player->getName(), $privateMessage);
        $privateMessage = $this->translateColors($privateMessage);
        $player->sendMessage($privateMessage);
    }

    private function translateColors(string $message): string {
        return str_replace(["&", "§"], "§", $message);
    }
}
