package xyz.mrhelpless.helplessplugin;

import org.bukkit.Bukkit;
import org.bukkit.plugin.PluginManager;
import org.bukkit.plugin.java.JavaPlugin;
import xyz.mrhelpless.helplessplugin.commands.KillCommand;
import xyz.mrhelpless.helplessplugin.commands.TpsCommand;
import xyz.mrhelpless.helplessplugin.commands.PingCommand;
import xyz.mrhelpless.helplessplugin.listener.DeathListener;
import xyz.mrhelpless.helplessplugin.listener.JoinListener;
import xyz.mrhelpless.helplessplugin.listener.QuitListener;
import xyz.mrhelpless.helplessplugin.tablist.TablistManager;

import java.util.logging.Logger;

public final class Main extends JavaPlugin {

    private static Main instance;

    private TablistManager tablistManager;

    @Override
    public void onLoad() {
        instance = this;
    }

    @Override
    public void onEnable() {
        // Plugin startup logic

        Logger log = getLogger();

        PluginManager manager = getServer().getPluginManager();

        manager.registerEvents(new JoinListener(), this);
        manager.registerEvents(new QuitListener(), this);
        manager.registerEvents(new DeathListener(), this);

        getCommand("hkill").setExecutor(new KillCommand());
        getCommand("htps").setExecutor(new TpsCommand());
        getCommand("hping").setExecutor(new PingCommand());

        tablistManager = new TablistManager();

        log.info("--------------------------------");
        log.info("|HelplessPlugin is now Enabled!|");
        log.info("--------------------------------");

    }

    @Override
    public void onDisable() {
        // Plugin shutdown logic

        Logger log = getLogger();

        log.info("---------------------------------");
        log.info("|HelplessPlugin is now Disabled!|");
        log.info("---------------------------------");

    }

    public TablistManager getTablistManager() {
        return tablistManager;
    }

    public static Main getInstance() {
        return instance;
    }
}
