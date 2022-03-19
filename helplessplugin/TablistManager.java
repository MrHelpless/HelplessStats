package xyz.mrhelpless.helplessplugin.tablist;

import org.bukkit.ChatColor;
import org.bukkit.entity.Player;

public class TablistManager {

    public void setTablist(Player player) {

        player.setPlayerListHeaderFooter(ChatColor.DARK_PURPLE + "mc.mrhelpless.xyz",
                ChatColor.GREEN + "Survival");

    }

}
