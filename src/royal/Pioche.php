<?php

namespace royal;

use pocketmine\item\Pickaxe;
use pocketmine\block\Block;
use pocketmine\block\BlockToolType;
use pocketmine\entity\Entity;
use pocketmine\utils\Config;



class Pioche extends Pickaxe {


    public function __construct($meta = 0){
        $config = new Config(Main::getInstance()->getDataFolder()."Config.yml");
        parent::__construct( $config->get("Item"), $meta, "Spawner Pickaxe", 5);
    }

    public function getBlockToolType() : int{
        return BlockToolType::TYPE_PICKAXE;
    }

    public function getBlockToolHarvestLevel() : int{
        return 5;
    }

    public function getMaxDurability(): int
    {
        $config = new Config(Main::getInstance()->getDataFolder()."Config.yml");

        return $config->get("Durabilitie");
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
