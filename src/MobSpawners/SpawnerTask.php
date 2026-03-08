<?php

namespace MobSpawners;

use pocketmine\scheduler\Task;
use pocketmine\block\tile\Tile;

class SpawnerTask extends Task{

    private Main $plugin;

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }

    public function onRun(): void{

        foreach($this->plugin->getServer()->getWorldManager()->getWorlds() as $world){

            foreach($world->getLoadedChunks() as $chunk){

                foreach($chunk->getTiles() as $tile){

                    if(!$tile instanceof Tile){
                        continue;
                    }

                    $nbt = $tile->getNamedTag();

                    if(!$nbt->getTag("spawner_type")){
                        continue;
                    }

                    $type = $nbt->getString("spawner_type");
                    $level = $nbt->getInt("spawner_level", 1);

                    MobStack::spawnStack($tile->getPosition(), $type, $level);
                }
            }
        }
    }
}
