<?php

namespace MobSpawners\commands;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\player\Player;
use MobSpawners\Main;
use pocketmine\world\Position;

class SpawnerShopCommand extends Command{

    private Main $plugin;

    public function __construct(Main $plugin){

        parent::__construct("spawnershop","Spawner shop");

        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender,string $label,array $args): bool{

        if(!$sender instanceof Player) return true;

        $cfg = $this->plugin->getConfig()->get("spawner-shop");

        $world = $this->plugin->getServer()->getWorldManager()->getWorldByName($cfg["world"]);

        $sender->teleport(new Position(
            $cfg["x"],
            $cfg["y"],
            $cfg["z"],
            $world
        ));

        return true;
    }
}
