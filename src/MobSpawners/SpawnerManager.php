<?php

namespace MobSpawners;

use pocketmine\block\VanillaBlocks;
use pocketmine\item\Item;
use pocketmine\nbt\tag\CompoundTag;

class SpawnerManager{

    private Main $plugin;

    public function __construct(Main $plugin){
        $this->plugin = $plugin;
    }

    public function createSpawner(string $type, int $level): Item{

        $item = VanillaBlocks::SPAWNER()->asItem();

        $nbt = $item->getNamedTag();
        $nbt->setString("spawner_type", $type);
        $nbt->setInt("spawner_level", $level);

        $item->setNamedTag($nbt);

        $config = $this->plugin->getConfig();

        $name = $config->get("spawners")[$type]["name"] ?? ucfirst($type) . " Spawner";

        $item->setCustomName("§e".$name);

        $item->setLore([
            "§7Level: §e".$level
        ]);

        return $item;
    }

    public function getSpawnerLevel(Item $item): int{
        return $item->getNamedTag()->getInt("spawner_level", 1);
    }

    public function getSpawnerType(Item $item): string{
        return $item->getNamedTag()->getString("spawner_type", "");
    }
}
