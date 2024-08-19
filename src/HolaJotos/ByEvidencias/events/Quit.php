<?php

namespace HolaJotos\ByEvidencias\events;

use pocketmine\event\Listener;
use pocketmine\event\player\PlayerQuitEvent;
use pocketmine\utils\TextFormat;
use HolaJotos\ByEvidencias\Main;

class Quit implements Listener {

    private Main $plugin;

    public function __construct(Main $plugin) {
        $this->plugin = $plugin;
    }

    public function onPlayerQuit(PlayerQuitEvent $event): void {
        $event->setQuitMessage("");
        $player = $event->getPlayer();
        $config = $this->plugin->getConfig();
        $message = $config->get("quit-message", "&c[-] &e{player} &cse ha salido del servidor!");
        $message = str_replace("{player}", $player->getName(), $message);
        $message = $this->translateColors($message);
        $this->plugin->getServer()->broadcastMessage($message);
        $event->setQuitMessage("");
    }

    private function translateColors(string $message): string {
        return str_replace(["&", "§"], "§", $message);
    }
}
