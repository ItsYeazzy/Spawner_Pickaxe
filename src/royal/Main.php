<?php

namespace royal;

use Core\API\FormAPI\SimpleForm;
use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\plugin\Plugin;
use pocketmine\plugin\PluginBase;
use pocketmine\Player;
use pocketmine\item\ItemFactory;
use pocketmine\event\Listener;

use onebone\EconomieAPI;
use pocketmine\utils\Config;


class Main extends PluginBase implements Listener{
    private static $instance;

    public function onEnable()
    {
        self::$instance = $this;
        $this->getServer()->getPluginManager()->registerEvents($this, $this);
        $this->getServer()->getLogger()->info("Plugin Spawner_Pickaxe load ");
        $this->getLogger()->info( "§aPlugin Chargé avec succès !");
        ItemFactory::registerItem(new Pioche($this));
        $this->getServer()->getPluginManager()->registerEvents(new Spawner($this), $this);
        $config = new Config($this->getDataFolder()."Config.yml", Config::YAML, array(
            "Price_pickaxe" => 100000,
            "ContentUI" => "PRix de la pioche : ",
            "titre" => "spawnerpickaxe",
            "name_pioche" => "pioche en topaze",
            "Item" => 244,
            "phrase" => " tu as cassé un spawner mais tu n'as pas pus le récupéré , domage ",
            "Durabilitie" => 1000,
        ));
    }
    public static function getInstance(){
        return self::$instance;
    }

}


