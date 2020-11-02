<?php

namespace royal;


use pocketmine\event\block\BlockBreakEvent;
use pocketmine\block\Block;
use pocketmine\event\Listener;
use pocketmine\item\Item;


class Spawner implements Listener
{
    /**
     * @var Main
     */
    private $plugin;

    public function __construct(Main $plugin)
    {
        $this->plugin = $plugin;
    }


    public function onBreak(BlockBreakEvent $event) {
        $item_in_hand = $event->getPlayer()->getInventory()->getItemInHand();
        $block = $event->getBlock();
        $item = Item::MONSTER_SPAWNER;
        if ($item_in_hand == 369) {
            if($block->getId() == Block::MONSTER_SPAWNER){
                $event->setDrops([Item::get(52, 0, 1)]);
            }

        }
    }
}
