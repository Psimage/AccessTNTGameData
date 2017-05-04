# AccessTNTGameData
Adds parser functions to query information from TNT game files.

## Parser functions
 * tnt_unit_attr <unit_name> <unit_attr_name>
 * tnt_wpn_attr <weapon_name> <wpn_attr_name>
 * tnt_trait_attr <trait_name> <trait_attr_name>
 * tnt_unit_wpn_attr <unit_name> <wpn_attr_name>
 
### Example usage
 * {{#tnt_unit_attr: fox | desc}} - "She spent her summers sitting on the roof, picking off rustlers and interlopers. She hates the city, and is happy to be back at home in the countryside."
 * {{#tnt_trait_attr: swift | desc}} - "Moves twice as fast."
 * {{#tnt_wpn_attr: sniperfox | AtkRange}} - "6"
 * {{#tnt_unit_wpn_attr: fox | AtkRange}} - "6"

## Installation
 1. Place this repository into extensions directory of your mediawiki installation (\<root\>/extensions/AccessTNTGameData)
 2. Load extension by adding `wfLoadExtension( 'AccessTNTGameData' );` to the end of your LocalSettings.php
 3. (Optional) Set path to tnt_game_data.json file after loading the extension in your LocalSettings.php with `$wgATNTGDGameDataFilename = <path_to_tnt_data.json>`. By default it uses `pre-alpha-26-data.json` file that resides in extension's root directory.

## Additional info
 * You can find latest tnt_game_data.json [here](https://gitlab.com/pocketrangers/pocketbot/raw/develop/assets/units.json). Use it to find out what names and attributes are available.
 * All functions output "array" data types as a comma separated list so it can be further processed by other functions.
 
## Development on Linux (OS X anyone?)
To take advantage of this automation, use the Makefile: `make help`. To start,
run `make install` and follow the instructions.

## Development on Windows
Since you cannot use the `Makefile` on Windows, do the following:

  * Install nodejs, npm, and PHP composer
  * Change to the extension's directory
  * npm install
  * composer install

Once set up, running `npm test` and `composer test` will run automated code checks.
