<?php

namespace MobSpawners\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use MobSpawners\Main;

class SpawnerGiveCommand extends Command{

    private Main $plugin;

    public function __construct(Main $plugin){

        parent::__construct("spawnergive","Give spawner");

        $this->plugin = $plugin;

        $this->setPermission("spawner.give");
    }

    public function execute(CommandSender $sender,string $label,array $args): bool{

        if(count($args) < 4){

            $sender->sendMessage("/spawnergive <player> <spawner> <level> <amount>");
            return true;
        }

        $player = $this->plugin->getServer()->getPlayerExact($args[0]);

        if(!$player instanceof Player){
            $sender->sendMessage("Player not found");
            return true;
        }

        $type = strtolower($args[1]);
        $level = (int)$args[2];
        $amount = (int)$args[3];

        $item = $this->plugin->spawnerManager->createSpawner($type,$level);
        $item->setCount($amount);

        $player->getInventory()->addItem($item);

        $sender->sendMessage("Spawner given");

        return true;
    }
}
