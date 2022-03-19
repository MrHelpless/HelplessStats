package xyz.mrhelpless.helplessplugin.listener;

import org.bukkit.ChatColor;
import org.bukkit.entity.Player;
import org.bukkit.event.Listener;
import org.bukkit.event.EventHandler;
import org.bukkit.event.player.PlayerJoinEvent;
import xyz.mrhelpless.helplessplugin.Main;

public class JoinListener implements Listener {

    String prefix = ChatColor.DARK_PURPLE.toString() + ChatColor.BOLD + "[HLP] " + ChatColor.RESET + ChatColor.GOLD;

    @EventHandler
    public void onJoin(PlayerJoinEvent event) {

        Player player = event.getPlayer();

        event.setJoinMessage(prefix + event.getJoinMessage());

        player.sendMessage(prefix + "Welcome to mc.mrhelpless.xyz");
        player.sendMessage(prefix + "If you want to know more about our commands type: /help helplessplugin");

        Main.getInstance().getTablistManager().setTablist(player);

    }

}
