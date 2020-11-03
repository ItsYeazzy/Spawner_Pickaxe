<?php

namespace royal;


use pocketmine\event\block\BlockBreakEvent;
use pocketmine\block\Block;
use pocketmine\event\Listener;
use pocketmine\item\Item;
use pocketmine\utils\Config;


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
        if ($item_in_hand == 369 && $block->getId() == Block::MONSTER_SPAWNER) {
            $event->setDrops([Item::get(52, 0, 1)]);
        }else{
            $event->setDrops([]);
            $player = $event->getPlayer();
            $config = new Config(Main::getInstance()->getDataFolder()."Config.yml");

            $player->sendMessage($config->get("phrase"));
        }
    }
}
