<?php

namespace royal\commandes;

use Core\API\FormAPI\SimpleForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\command\PluginCommand;
use pocketmine\event\Listener;
use pocketmine\Player;
use onebone\EconomieAPI;
use pocketmine\utils\Config;
use Royal\Main;

class Sppioche extends PluginCommand
{
    /**
     * @var Main
     */
    private $plugin;

    public function __construct(string $name, Main $plugin)
    {
        parent::__construct($name, $plugin);
        $this->plugin = $plugin;
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
        $myMoney = EconomyAPI::getInstance()->myMoney($player);
        $form = new SimpleForm(function (Player $player, int $data = null){
            $result = $data;
            if($result === null){
                return true;
            }
            switch($result){
                case 0:
                    $config = new Config($this->plugin->getDataFolder()."Config.yml");
                    $myMoney = EconomyAPI::getInstance()->myMoney($player);
                    if ($myMoney < $config->get("Price_pickaxe")){
                        break;
                    }else{
                        EconomyAPI::getInstance()->reduceMoney($player, 25);

                        $player->sendMessage("il ne vous reste que : " . $myMoney . " en monnaie.");

                    }
                    break;
            }
            return true;
        });
        $config = new Config($this->plugin->getDataFolder()."Config.yml");

        $form->setTitle($config->get("titre"));
        $form->setContent(str_replace(["{money}", "{player}"], [$myMoney, $player], $config->get("ContentUI")));
        $form->addButton($config->get("name_pioche"));
        $form->sendToPlayer($player);
        return $form;
    }
}