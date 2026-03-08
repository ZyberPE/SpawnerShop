<?php

namespace MobSpawners;

use pocketmine\world\Position;

class MobStack{

    public static array $stacks = [];

    public static function spawnStack(Position $pos,string $type,int $amount): void{

        $key = $pos->getX().":".$pos->getY().":".$pos->getZ().":".$type;

        if(isset(self::$stacks[$key])){

            self::$stacks[$key]["amount"] += $amount;

        }else{

            self::$stacks[$key] = [
                "amount"=>$amount,
                "type"=>$type
            ];
        }
    }
}
