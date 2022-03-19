package xyz.mrhelpless.helplessplugin.listener;

import org.bukkit.ChatColor;
import org.bukkit.event.EventHandler;
import org.bukkit.event.Listener;
import org.bukkit.event.entity.PlayerDeathEvent;

public class DeathListener implements Listener {

    String prefix = ChatColor.DARK_PURPLE.toString() + ChatColor.BOLD + "[HLP] " + ChatColor.RESET + ChatColor.GOLD;

    @EventHandler
    public void onDeath(PlayerDeathEvent event) {

        event.setDeathMessage(prefix + event.getDeathMessage());

    }
}
