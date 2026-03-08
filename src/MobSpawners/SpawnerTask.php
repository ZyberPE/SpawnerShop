<?php

namespace MobSpawners;

use pocketmine\scheduler\Task;

class SpawnerTask extends Task{

    private Main $plugin;

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }

    public function onRun(): void{

        foreach($this->plugin->getServer()->getWorldManager()->getWorlds() as $world){

            foreach($world->getTileEntities() as $tile){

                if(!$tile instanceof \pocketmine\block\tile\MobSpawner) continue;

                $nbt = $tile->getNamedTag();

                if(!$nbt->getTag("spawner_type")) continue;

                $type = $nbt->getString("spawner_type");
                $level = $nbt->getInt("spawner_level");

                $amount = $level;

                MobStack::spawnStack($tile->getPosition(),$type,$amount);
            }
        }
    }
}
