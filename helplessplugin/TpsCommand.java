package xyz.mrhelpless.helplessplugin.commands;

import java.text.DecimalFormat;

import org.bukkit.ChatColor;
import org.bukkit.command.Command;
import org.bukkit.command.CommandExecutor;
import org.bukkit.command.CommandSender;
import xyz.mrhelpless.helplessplugin.classes.Tps;

public class TpsCommand implements CommandExecutor {

    String prefix = ChatColor.DARK_PURPLE.toString() + ChatColor.BOLD + "[HLP] " + ChatColor.RESET;

    @Override
    public boolean onCommand(CommandSender sender, Command command, String label, String[] args) {

        double TPS = Tps.getTPS();

        DecimalFormat TpsFormat = new DecimalFormat("#.##");

        if(TPS > 20){
            sender.sendMessage(prefix + ChatColor.DARK_GREEN+"TPS : " + TpsFormat.format(TPS));
            return true;
        } else if(TPS > 19){
            sender.sendMessage(prefix + ChatColor.GREEN+"TPS : " + TpsFormat.format(TPS) + ".");
            return true;
        } else if(TPS > 14){
            sender.sendMessage(prefix + ChatColor.YELLOW+"TPS : " + TpsFormat.format(TPS));
            return true;
        } else if(TPS > 9){
            sender.sendMessage(prefix + ChatColor.RED+"TPS : " + TpsFormat.format(TPS));
            return true;
        } else if(TPS < 9){
            sender.sendMessage(prefix + ChatColor.DARK_RED+"TPS : " + TpsFormat.format(TPS));
            return true;
        }

        return false;
    }
}
