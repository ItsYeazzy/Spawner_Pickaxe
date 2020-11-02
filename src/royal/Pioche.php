<?php

namespace royal;

use pocketmine\item\Pickaxe;
use pocketmine\item\TieredTool;
use pocketmine\plugin;
use pocketmine\event;
use pocketmine\block\Block;
use pocketmine\block\BlockToolType;
use pocketmine\entity\Entity;
use pocketmine\utils\Config;



class Pioche extends TieredTool {


    public function __construct($meta = 0){
        parent::__construct( 369, $meta, "Spawner Pickaxe", 5);
    }

    public function getBlockToolType() : int{
        return BlockToolType::TYPE_PICKAXE;
    }

    public function getBlockToolHarvestLevel() : int{
        return 5;
    }

    public function getMaxDurability(): int
    {
        return 1000;
    }

    public function getAttackPoints() : int{
        return self::getBaseDamageFromTier($this->tier) - 2;
    }

    public function onDestroyBlock(Block $block) : bool{
        if($block->getHardness() > 0){
            return $this->applyDamage(1);
        }
        return false;
    }

    public function onAttackEntity(Entity $victim) : bool{
        return $this->applyDamage(2);
    }
}
