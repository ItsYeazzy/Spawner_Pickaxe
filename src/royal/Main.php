<?php

namespace royal;

use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\Server;
use pocketmine\item\Item;
use pocketmine\item\ItemFactory;
use pocketmine\event\Listener;
use pocketmine\plugin\PluginManager;

use onebone\EconomieAPI;

use royal\Pioche;
use royal\Spawner;

class Main extends PluginBase implements Listener{
    public function onEnable()
    {
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getLogger()->info( "§aPlugin Chargé avec succès !");
        ItemFactory::getPluginManager(new Pioche(), true );
        $this->getPluginManager()->registerEvents(new Spawner($this), $this);
    }
    public function onCommand(CommandSender $player, Command $command, string $label, array $args): bool
    {
        switch($command->getName()){
            case "PiocheUI":
                if($player instanceof Player){
                    $this->openServerForm($player);
                }
            break;
        }
        return true;
    }
    public function openServerForm($player)
    {
        $api = $this->getServer()->getPluginManager()->getPlugin("FormAPI");
        $form = $api->createSimpleForm(function (Player $player, int $data = null){
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $myMoney = EconomyAPI::getInstance()->myMoney($player);

                    $player->sendMessage("Vous avez : " . $myMoney . " en monnaie.");
                break;

                case 2:
                    EconomyAPI::getInstance()->reduceMoney($player, 25);

                    $myMoney = EconomyAPI::getInstance()->myMoney($player);


                    $player->sendMessage("il ne vous reste que : " . $myMoney . " en monnaie.");
                break;
            }
        });
        $form->setTitle("PiocheSpawner");
        $form->setContent("Acheter une pioche Spéciale spawner?");
        $form->addButton("que me reste t'il ", $maMoney);
        $form->addButton("Acheter la pioche ^^");
        $form->sendToPlayer($player);
        return $form;
    }
}


