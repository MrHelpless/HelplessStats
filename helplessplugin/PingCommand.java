package xyz.mrhelpless.helplessplugin.commands;

import org.bukkit.ChatColor;
import org.bukkit.command.Command;
import org.bukkit.command.CommandExecutor;
import org.bukkit.command.CommandSender;
import org.bukkit.entity.Player;

public class PingCommand implements CommandExecutor {

    String prefix = ChatColor.DARK_PURPLE.toString() + ChatColor.BOLD + "[HLP] " + ChatColor.RESET;

    @Override
    public boolean onCommand(CommandSender sender, Command command, String label, String[] args) {

        if(!(sender instanceof Player)) {
            return false;
        }

        Player player = (Player) sender;

        sender.sendMessage(prefix + ChatColor.GOLD + "Your ping is " + ChatColor.DARK_PURPLE + player.getPing() + "ms" + ChatColor.GOLD + ".");

        return true;
    }
}
