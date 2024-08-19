<?php

namespace HolaJotos\ByEvidencias\events;

use pocketmine\player\Player;
use pocketmine\event\player\PlayerJoinEvent;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginBase;

class Join implements Listener {

    private PluginBase $plugin;

    public function __construct(PluginBase $plugin) {
        $this->plugin = $plugin;
    }

    public function onPlayerJoin(PlayerJoinEvent $event): void { 
        $player = $event->getPlayer();
        $config = $this->plugin->getConfig();
        $message = $config->get("welcome-message", "&a[+] &e{player} &ase ha unido al servidor!");
        $message = str_replace("{player}", $player->getName(), $message);
        $message = $this->translateColors($message);
        $this->plugin->getServer()->broadcastMessage($message);
        $this->sendPrivateMessage($player);
        $event->setJoinMessage("");
    }

    private function sendPrivateMessage(Player $player): void { 
        $config = $this->plugin->getConfig();
        $privateMessageLines = $config->get("private-message", []);
        $privateMessage = implode("\n", $privateMessageLines);
        $privateMessage = str_replace("{player}", $player->getName(), $privateMessage);
        $privateMessage = $this->translateColors($privateMessage);
        $player->sendMessage($privateMessage);
    }

    private function translateColors(string $message): string {
        return str_replace(["&", "§"], "§", $message);
    }
}
