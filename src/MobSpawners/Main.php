<?php

namespace MobSpawners;

use pocketmine\plugin\PluginBase;
use pocketmine\scheduler\TaskScheduler;
use MobSpawners\commands\SpawnerGiveCommand;
use MobSpawners\commands\SpawnerShopCommand;

class Main extends PluginBase{

    private static Main $instance;

    public SpawnerManager $spawnerManager;

    public static function getInstance(): Main{
        return self::$instance;
    }

    public function onEnable(): void{

        self::$instance = $this;

        $this->saveDefaultConfig();

        $this->spawnerManager = new SpawnerManager($this);

        $this->getScheduler()->scheduleRepeatingTask(
            new SpawnerTask($this),
            20 * 10
        );

        $this->getServer()->getCommandMap()->register("spawnergive", new SpawnerGiveCommand($this));
        $this->getServer()->getCommandMap()->register("spawnershop", new SpawnerShopCommand($this));
    }
}
