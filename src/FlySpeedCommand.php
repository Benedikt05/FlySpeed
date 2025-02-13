<?php

namespace WolfDen133\FlySpeed;

use pocketmine\command\Command;
use pocketmine\command\CommandSender;
use pocketmine\Player;
use pocketmine\utils\TextFormat;

class FlySpeedCommand extends Command
{
    private Main $plugin;

    public function __construct(Main $plugin)
    {
        parent::__construct("flyspeed");

        $this->setDescription("Change the speed of your flight");
        $this->setPermission("flyspeed.command.use");
        $this->setUsage("Usage: /flyspeed <float: value>");
        $this->setAliases(["fspeed", "flys", "fs"]);

        $this->plugin = $plugin;
    }

    public function execute(CommandSender $sender, string $commandLabel, array $args)
    {
        if (!$this->testPermission($sender)) return;

        if (!$sender instanceof Player) {
            $sender->sendMessage(TextFormat::DARK_GRAY . "[" . TextFormat::RED . "!" . TextFormat::DARK_GRAY . "]" . TextFormat::RED . " Sorry, this command is for players only!");
            return;
        }

        if (count($args) !== 1) {
            $sender->sendMessage(TextFormat::DARK_GRAY . "[" . TextFormat::RED . "!" . TextFormat::DARK_GRAY . "]" . TextFormat::YELLOW . $this->getUsage());
            return;
        }

        if (!is_numeric($args[0])) {
            $sender->sendMessage(TextFormat::DARK_GRAY . "[" . TextFormat::RED . "!" . TextFormat::DARK_GRAY . "]" . TextFormat::RED . "Argument 1 should be of type int/float!");
            return;
        }

        $this->plugin->updateFlySpeed($sender, $args[0]);
        $sender->sendMessage(TextFormat::DARK_GRAY . "[" . TextFormat::GREEN . "!" . TextFormat::DARK_GRAY . "]" . TextFormat::GRAY . " Successfully updated your fly-speed to " . TextFormat::AQUA . $args[0] . TextFormat::GRAY . "!");
    }
}