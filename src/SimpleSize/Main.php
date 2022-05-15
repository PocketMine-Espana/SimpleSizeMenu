<?php

namespace SimpleSize;

use pocketmine\player\Player;
use pocketmine\Server;

use pocketmine\event\Listener as L;
use pocketmine\plugin\PluginBase as P;

#libs
use Menus\FormAPI\SimpleForm;

class Main extends P implements L {
  
  public $prefix = "§l§aSize §r§7» ";
  
  public function onEnable(): void{
    
    $this->getServer()->getLogger()->info($this->prefix."Size Enable");                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                                           
    
  }
  
  public function onCommand(CommandSender $pl, Command $cmd, string $label, array $args): bool{
    switch($cmd->getName()){
      case "size":
        if($pl->hasPermission("size.cmd")){
          $this->getSize($pl);
        }else{
          $pl->sendMessage("§l§4! §r§7Oops Al Parecer no Tiene Permisos Suficientes");
        }
      break;
    }
    return true;
  }
  
  public function getSize(Player $pl){
    $form = new SimpleForm(function (Player $pl, int $data = null){
      if($data === null){
        return true;
      }
      switch($data){
        case 0:
          $pl->setScale(1.5);
          $pl->sendTip($this->prefix."Cambiaste de Tamaño");
        break;
        case 1:
          $pl->setScale(1.2);
          $pl->sendTip($this->prefix."Cambiaste de Tamaño");
        break;
        case 2:
          $pl->setScale(0.5);
          $pl->sendTip($this->prefix."Cambiaste de Tamaño");
        break;
        case 3:
          $pl->setScale(1.0);
          $pl->sendTip($this->prefix."Volviste a el Tamaño Original");
        break;
        case 4:
          $this->getVip($pl);
        break;
      }
    });
    $form->setTitle("§l§aSIZE");
    $form->addButton("§l§4GRANDE");
    $form->addButton("§l§4MEDIANO");
    $form->addButton("§l§4PEQUEÑO");
    $form->addButton("§l§cTamaño Original",0,"textures/ui/refresh_light");
    $form->addButton("§l§cVOLVER",0,"textures/ui/redX1");
    $form->sendToPlayer($pl);
    return $form;
  }
}
