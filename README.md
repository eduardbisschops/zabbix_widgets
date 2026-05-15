These widgets have been tested on Zabbix 7.0.24, 7.2.15 and 7.4.8.

**Installation**

1. Copy the `host_overview` and/or `banner` directory into the `modules` directory of your Zabbix frontend. This is usually located at `/usr/share/zabbix/modules/`.
2. In Zabbix, go to **Administration → General → Modules** and enable the module.
3. Add the widget to a dashboard.

## Host overview

A compact, flexible host summary widget for Zabbix dashboards. It turns standard Linux and Windows template items into a clear at-a-glance overview with badges, status bars, grouped metrics, sparkline history, and quick links to Latest data. The configuration dialog also includes built-in preview and testing tools, so item mapping is easier to validate before you save.

**Features**

- Display any combination of Processor, Memory, Load, Swap, Interfaces, Disk utilization, and Partitions.
- Works out of the box with common Zabbix Linux and Windows templates, with default item names and wildcard matching that can be remapped per widget.
- Add useful host badges such as Hostname, Uptime, Liveliness, Problems, Maintenance, Tags, free text, or custom links.
- Set medium and high thresholds for each metric.
- Choose threshold-based or solid colors, adjust bar height, pick full or short labels, and use rounded or square corners.
- Show interface traffic with a configurable ceiling and unit (Kbps, Mbps, or Gbps), while long interface names are shortened automatically.
- Add sparklines for quick historical context directly in the widget.
- Open built-in Zabbix host and item popup menus from the widget.
- See live frontend updates for percentage and bitrate changes with animated tickers.
- Keep interfaces, disks, and partitions organized in consistent multi-row layouts.
- Test exact-name matching for CPU, Memory, Load, Swap, and Uptime directly in the config dialog.
- Preview wildcard matches for Interfaces, Disks, and Partitions, including items filtered out by your rules.
- Customize the Problems badge to hide acknowledged or suppressed issues and optionally pulse when active.
- Supports all Zabbix themes.

**Screenshots**

![](https://i.imgur.com/EMDHCrm.png)

![](https://i.imgur.com/k5nBeF7.png)

## Banner

A widget for creating custom visual banners on your dashboard. Displays titles, descriptive text, and background images with lots of styling options. Perfect for highlighting key information, adding aesthetic elements or adding inline comments to your dashboard.

**Features**

- BB-codes.
- Add inline images.
- Horizontal text alignment.
- Seperate font colors and sizes for the title and description.
- Background color or image.
- Three background image display options.
- Header mode that centers the title and hides everything else.
- Supports all Zabbix themes.

**Screenshots**

![](https://i.imgur.com/8EoUFPU.png)

![](https://i.imgur.com/Nttk9na.png)

**Available BB-codes**

| BB-code                                     | Result                                                                                |
| ------------------------------------------- | ------------------------------------------------------------------------------------- |
| `[b]bold text[/b]`                          | **bold text**                                                                         |
| `[u]underlined[/u]`                         | underlined                                                                            |
| `[i]italic[/i]`                             | _italic_                                                                              |
| `[s]strike[/s]`                             | ~strike~                                                                              |
| `[center]centered text[/center]`            | centered text                                                                         |
| `[color=red]colored[/color]`                | colored text                                                                          |
| `[img]https://example.com/heart.png[/img]`  | ![image](https://icons.iconarchive.com/icons/paomedia/small-n-flat/16/heart-icon.png) |
| `[link=http://example.com]hyperlink[/link]` | [hyperlink](https://www.youtube.com/watch?v=dQw4w9WgXcQ)                              |
