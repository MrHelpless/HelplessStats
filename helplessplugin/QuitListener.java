package xyz.mrhelpless.helplessplugin.listener;

import org.bukkit.ChatColor;
import org.bukkit.event.EventHandler;
import org.bukkit.event.Listener;
import org.bukkit.event.player.PlayerQuitEvent;

public class QuitListener implements Listener {

    String prefix = ChatColor.DARK_PURPLE.toString() + ChatColor.BOLD + "[HLP] " + ChatColor.RESET + ChatColor.GOLD;

    @EventHandler
    public void onQuit(PlayerQuitEvent event) {

        event.setQuitMessage(prefix + event.getQuitMessage());

    }
}
