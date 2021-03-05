<?php

namespace App\Console\Commands;

use App\Models\Blueprint;
use Illuminate\Console\Command;

class ImportBlueprints extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'blueprints:import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $blueprints = '[{"shortname": "ammo.pistol.fire", "displayName": {"token": "ammo.pistol.fire", "english": "Incendiary Pistol Bullet"}, "workbenchLevelRequired": 2}, {"shortname": "ammo.pistol.hv", "displayName": {"token": "ammo.pistol.hv", "english": "HV Pistol Ammo"}, "workbenchLevelRequired": 2}, {"shortname": "ammo.pistol", "displayName": {"token": "ammo.pistol", "english": "Pistol Bullet"}, "workbenchLevelRequired": 1}, {"shortname": "ammo.rifle.explosive", "displayName": {"token": "ammo.rifle.explosive", "english": "Explosive 5.56 Rifle Ammo"}, "workbenchLevelRequired": 3}, {"shortname": "ammo.rifle.hv", "displayName": {"token": "ammo.rifle.hv", "english": "HV 5.56 Rifle Ammo"}, "workbenchLevelRequired": 3}, {"shortname": "ammo.rifle.incendiary", "displayName": {"token": "ammo.rifle.incendiary", "english": "Incendiary 5.56 Rifle Ammo"}, "workbenchLevelRequired": 3}, {"shortname": "ammo.rifle", "displayName": {"token": "ammo.rifle", "english": "5.56 Rifle Ammo"}, "workbenchLevelRequired": 2}, {"shortname": "ammo.rocket.basic", "displayName": {"token": "ammo.rocket.basic", "english": "Rocket"}, "workbenchLevelRequired": 3}, {"shortname": "ammo.rocket.fire", "displayName": {"token": "ammo.rocket.fire", "english": "Incendiary Rocket"}, "workbenchLevelRequired": 2}, {"shortname": "ammo.rocket.hv", "displayName": {"token": "ammo.rocket.hv", "english": "High Velocity Rocket"}, "workbenchLevelRequired": 3}, {"shortname": "ammo.shotgun.slug", "displayName": {"token": "ammo.shotgun.slug", "english": "12 Gauge Slug"}, "workbenchLevelRequired": 2}, {"shortname": "ammo.shotgun", "displayName": {"token": "ammo.shotgun", "english": "12 Gauge Buckshot"}, "workbenchLevelRequired": 2}, {"shortname": "autoturret", "displayName": {"token": "autoturret", "english": "Auto Turret"}, "workbenchLevelRequired": 2}, {"shortname": "axe.salvaged", "displayName": {"token": "axe.salvaged", "english": "Salvaged Axe"}, "workbenchLevelRequired": 2}, {"shortname": "barricade.concrete", "displayName": {"token": "barricade.concrete", "english": "Concrete Barricade"}, "workbenchLevelRequired": 2}, {"shortname": "barricade.metal", "displayName": {"token": "barricade.metal", "english": "Metal Barricade"}, "workbenchLevelRequired": 2}, {"shortname": "barricade.sandbags", "displayName": {"token": "barricade.sandbags", "english": "Sandbag Barricade"}, "workbenchLevelRequired": 1}, {"shortname": "barricade.stone", "displayName": {"token": "barricade.stone", "english": "Stone Barricade"}, "workbenchLevelRequired": 0}, {"shortname": "barricade.wood", "displayName": {"token": "barricade.wood", "english": "Wooden Barricade"}, "workbenchLevelRequired": 0}, {"shortname": "barricade.woodwire", "displayName": {"token": "barricade.woodwire", "english": "Barbed Wooden Barricade"}, "workbenchLevelRequired": 1}, {"shortname": "bed", "displayName": {"token": "bed", "english": "Bed"}, "workbenchLevelRequired": 1}, {"shortname": "bucket.helmet", "displayName": {"token": "bucket.helmet", "english": "Bucket Helmet"}, "workbenchLevelRequired": 1}, {"shortname": "bucket.water", "displayName": {"token": "bucket.water", "english": "Water Bucket"}, "workbenchLevelRequired": 0}, {"shortname": "burlap.gloves", "displayName": {"token": "burlap.gloves", "english": "Leather Gloves"}, "workbenchLevelRequired": 0}, {"shortname": "ceilinglight", "displayName": {"token": "ceilinglight", "english": "Ceiling Light"}, "workbenchLevelRequired": 1}, {"shortname": "chair", "displayName": {"token": "chair", "english": "Chair"}, "workbenchLevelRequired": 1}, {"shortname": "coffeecan.helmet", "displayName": {"token": "coffeecan.helmet", "english": "Coffee Can Helmet"}, "workbenchLevelRequired": 2}, {"shortname": "door.double.hinged.metal", "displayName": {"token": "door.double.hinged.metal", "english": "Sheet Metal Double Door"}, "workbenchLevelRequired": 0}, {"shortname": "door.double.hinged.toptier", "displayName": {"token": "door.double.hinged.toptier", "english": "Armored Double Door"}, "workbenchLevelRequired": 3}, {"shortname": "door.hinged.toptier", "displayName": {"token": "door.hinged.toptier", "english": "Armored Door"}, "workbenchLevelRequired": 3}, {"shortname": "dropbox", "displayName": {"token": "dropbox", "english": "Drop Box"}, "workbenchLevelRequired": 1}, {"shortname": "ducttape", "displayName": {"token": "ducttape.name", "english": "Duct Tape"}, "workbenchLevelRequired": 3}, {"shortname": "explosive.satchel", "displayName": {"token": "explosive.satchel", "english": "Satchel Charge"}, "workbenchLevelRequired": 1}, {"shortname": "explosive.timed", "displayName": {"token": "explosive.timed", "english": "Timed Explosive Charge"}, "workbenchLevelRequired": 3}, {"shortname": "explosives", "displayName": {"token": "explosives", "english": "Explosives"}, "workbenchLevelRequired": 3}, {"shortname": "fireplace.stone", "displayName": {"token": "fireplace.stone", "english": "Stone Fireplace"}, "workbenchLevelRequired": 0}, {"shortname": "flamethrower", "displayName": {"token": "flamethrower", "english": "Flame Thrower"}, "workbenchLevelRequired": 2}, {"shortname": "flameturret", "displayName": {"token": "flameturret", "english": "Flame Turret"}, "workbenchLevelRequired": 1}, {"shortname": "floor.grill", "displayName": {"token": "floor.grill", "english": "Floor grill"}, "workbenchLevelRequired": 1}, {"shortname": "floor.ladder.hatch", "displayName": {"token": "floor.ladder.hatch", "english": "Ladder Hatch"}, "workbenchLevelRequired": 2}, {"shortname": "fridge", "displayName": {"token": "fridge", "english": "Fridge"}, "workbenchLevelRequired": 1}, {"shortname": "fun.guitar", "displayName": {"token": "fun.guitar", "english": "Acoustic Guitar"}, "workbenchLevelRequired": 0}, {"shortname": "furnace.large", "displayName": {"token": "furnace.large", "english": "Large Furnace"}, "workbenchLevelRequired": 2}, {"shortname": "gates.external.high.stone", "displayName": {"token": "gates.external.high.stone", "english": "High External Stone Gate"}, "workbenchLevelRequired": 3}, {"shortname": "gates.external.high.wood", "displayName": {"token": "gates.external.high.wood", "english": "High External Wooden Gate"}, "workbenchLevelRequired": 1}, {"shortname": "gears", "displayName": {"token": "gears.name", "english": "Gears"}, "workbenchLevelRequired": 3}, {"shortname": "grenade.beancan", "displayName": {"token": "grenade.beancan", "english": "Beancan Grenade"}, "workbenchLevelRequired": 1}, {"shortname": "grenade.f1", "displayName": {"token": "grenade.f1", "english": "F1 Grenade"}, "workbenchLevelRequired": 2}, {"shortname": "guntrap", "displayName": {"token": "guntrap.name", "english": "Shotgun Trap"}, "workbenchLevelRequired": 1}, {"shortname": "hammer.salvaged", "displayName": {"token": "hammer.salvaged", "english": "Salvaged Hammer"}, "workbenchLevelRequired": 1}, {"shortname": "hat.beenie", "displayName": {"token": "hat.beenie", "english": "Beenie Hat"}, "workbenchLevelRequired": 0}, {"shortname": "hat.miner", "displayName": {"token": "hat.miner", "english": "Miners Hat"}, "workbenchLevelRequired": 1}, {"shortname": "hatchet", "displayName": {"token": "hatchet", "english": "Hatchet"}, "workbenchLevelRequired": 1}, {"shortname": "heavy.plate.helmet", "displayName": {"token": "heavy.plate.helmet", "english": "Heavy Plate Helmet"}, "workbenchLevelRequired": 2}, {"shortname": "heavy.plate.jacket", "displayName": {"token": "heavy.plate.jacket", "english": "Heavy Plate Jacket"}, "workbenchLevelRequired": 2}, {"shortname": "heavy.plate.pants", "displayName": {"token": "heavy.plate.pants", "english": "Heavy Plate Pants"}, "workbenchLevelRequired": 2}, {"shortname": "hoodie", "displayName": {"token": "hoodie", "english": "Hoodie"}, "workbenchLevelRequired": 2}, {"shortname": "icepick.salvaged", "displayName": {"token": "icepick.salvaged", "english": "Salvaged Icepick"}, "workbenchLevelRequired": 2}, {"shortname": "jacket.snow", "displayName": {"token": "jacket.snow", "english": "Snow Jacket - Red"}, "workbenchLevelRequired": 1}, {"shortname": "jacket", "displayName": {"token": "jacket", "english": "Jacket"}, "workbenchLevelRequired": 1}, {"shortname": "ladder.wooden.wall", "displayName": {"token": "ladder.wooden.wall", "english": "Wooden Ladder"}, "workbenchLevelRequired": 1}, {"shortname": "largemedkit", "displayName": {"token": "largemedkit", "english": "Large Medkit"}, "workbenchLevelRequired": 2}, {"shortname": "locker", "displayName": {"token": "locker", "english": "Locker"}, "workbenchLevelRequired": 2}, {"shortname": "longsword", "displayName": {"token": "longsword", "english": "Longsword"}, "workbenchLevelRequired": 2}, {"shortname": "mace", "displayName": {"token": "mace", "english": "Mace"}, "workbenchLevelRequired": 1}, {"shortname": "machete", "displayName": {"token": "machete", "english": "Machete"}, "workbenchLevelRequired": 0}, {"shortname": "mailbox", "displayName": {"token": "mailbox", "english": "Mail Box"}, "workbenchLevelRequired": 0}, {"shortname": "mask.balaclava", "displayName": {"token": "mask.balaclava", "english": "Improvised Balaclava"}, "workbenchLevelRequired": 0}, {"shortname": "metal.facemask", "displayName": {"token": "metal.facemask", "english": "Metal Facemask"}, "workbenchLevelRequired": 3}, {"shortname": "metal.plate.torso", "displayName": {"token": "metal.plate.torso", "english": "Metal Chest Plate"}, "workbenchLevelRequired": 3}, {"shortname": "metalblade", "displayName": {"token": "metalblade.name", "english": "Metal Blade"}, "workbenchLevelRequired": 2}, {"shortname": "metalpipe", "displayName": {"token": "metalpipe.name", "english": "Metal Pipe"}, "workbenchLevelRequired": 3}, {"shortname": "metalspring", "displayName": {"token": "metalspring.name", "english": "Metal Spring"}, "workbenchLevelRequired": 3}, {"shortname": "pants.shorts", "displayName": {"token": "pants.shorts", "english": "Shorts"}, "workbenchLevelRequired": 0}, {"shortname": "pants", "displayName": {"token": "pants", "english": "Pants"}, "workbenchLevelRequired": 1}, {"shortname": "pickaxe", "displayName": {"token": "pickaxe", "english": "Pickaxe"}, "workbenchLevelRequired": 1}, {"shortname": "pistol.python", "displayName": {"token": "pistol.pyhon", "english": "Python Revolver"}, "workbenchLevelRequired": 2}, {"shortname": "pistol.revolver", "displayName": {"token": "pistol.revolver", "english": "Revolver"}, "workbenchLevelRequired": 1}, {"shortname": "pistol.semiauto", "displayName": {"token": "pistol.semiauto", "english": "Semi-Automatic Pistol"}, "workbenchLevelRequired": 2}, {"shortname": "planter.large", "displayName": {"token": "planter.large.name", "english": "Large Planter Box"}, "workbenchLevelRequired": 0}, {"shortname": "planter.small", "displayName": {"token": "planter.small.name", "english": "Small Planter Box"}, "workbenchLevelRequired": 0}, {"shortname": "propanetank", "displayName": {"token": "propanetank.name", "english": "Empty Propane Tank"}, "workbenchLevelRequired": 2}, {"shortname": "rifle.ak", "displayName": {"token": "rifle.ak", "english": "Assault Rifle"}, "workbenchLevelRequired": 3}, {"shortname": "rifle.bolt", "displayName": {"token": "rifle.bolt", "english": "Bolt Action Rifle"}, "workbenchLevelRequired": 3}, {"shortname": "rifle.semiauto", "displayName": {"token": "rifle.semiauto", "english": "Semi-Automatic Rifle"}, "workbenchLevelRequired": 2}, {"shortname": "riot.helmet", "displayName": {"token": "riot.helmet", "english": "Riot Helmet"}, "workbenchLevelRequired": 1}, {"shortname": "roadsign.jacket", "displayName": {"token": "roadsign.jacket", "english": "Road Sign Jacket"}, "workbenchLevelRequired": 2}, {"shortname": "roadsign.kilt", "displayName": {"token": "roadsign.kilt", "english": "Road Sign Kilt"}, "workbenchLevelRequired": 2}, {"shortname": "roadsigns", "displayName": {"token": "roadsigns.name", "english": "Road Signs"}, "workbenchLevelRequired": 3}, {"shortname": "rocket.launcher", "displayName": {"token": "rocket.launcher", "english": "Rocket Launcher"}, "workbenchLevelRequired": 3}, {"shortname": "rug.bear", "displayName": {"token": "rug_bear", "english": "Rug Bear Skin"}, "workbenchLevelRequired": 0}, {"shortname": "rug", "displayName": {"token": "rug", "english": "Rug"}, "workbenchLevelRequired": 0}, {"shortname": "salvaged.cleaver", "displayName": {"token": "salvaged.cleaver", "english": "Salvaged Cleaver"}, "workbenchLevelRequired": 1}, {"shortname": "salvaged.sword", "displayName": {"token": "salvaged.sword", "english": "Salvaged Sword"}, "workbenchLevelRequired": 1}, {"shortname": "searchlight", "displayName": {"token": "searchlight.name", "english": "Search Light"}, "workbenchLevelRequired": 2}, {"shortname": "sewingkit", "displayName": {"token": "sewingkit.name", "english": "Sewing Kit"}, "workbenchLevelRequired": 3}, {"shortname": "shelves", "displayName": {"token": "shelves", "english": "Salvaged Shelves"}, "workbenchLevelRequired": 0}, {"shortname": "shirt.collared", "displayName": {"token": "shirt.collared", "english": "Shirt"}, "workbenchLevelRequired": 1}, {"shortname": "shirt.tanktop", "displayName": {"token": "shirt.tanktop", "english": "Tank Top"}, "workbenchLevelRequired": 1}, {"shortname": "shoes.boots", "displayName": {"token": "shoes.boots", "english": "Boots"}, "workbenchLevelRequired": 2}, {"shortname": "shotgun.double", "displayName": {"token": "shotgun.double", "english": "Double Barrel Shotgun"}, "workbenchLevelRequired": 1}, {"shortname": "shotgun.pump", "displayName": {"token": "shotgun.pump", "english": "Pump Shotgun"}, "workbenchLevelRequired": 2}, {"shortname": "shotgun.waterpipe", "displayName": {"token": "shotgun.waterpipe", "english": "Waterpipe Shotgun"}, "workbenchLevelRequired": 1}, {"shortname": "shutter.metal.embrasure.a", "displayName": {"token": "shutter.metal.embrasure.a", "english": "Metal horizontal embrasure"}, "workbenchLevelRequired": 1}, {"shortname": "shutter.metal.embrasure.b", "displayName": {"token": "shutter.metal.embrasure.b", "english": "Metal Vertical embrasure"}, "workbenchLevelRequired": 1}, {"shortname": "shutter.wood.a", "displayName": {"token": "shutter.wood.a", "english": "Wood Shutters"}, "workbenchLevelRequired": 0}, {"shortname": "sign.wooden.huge", "displayName": {"token": "sign.wooden.huge", "english": "Huge Wooden Sign"}, "workbenchLevelRequired": 0}, {"shortname": "sign.wooden.large", "displayName": {"token": "sign.wooden.large", "english": "Large Wooden Sign"}, "workbenchLevelRequired": 0}, {"shortname": "small.oil.refinery", "displayName": {"token": "small.oil.refinery", "english": "Small Oil Refinery"}, "workbenchLevelRequired": 2}, {"shortname": "smg.2", "displayName": {"token": "smg.2", "english": "Custom SMG"}, "workbenchLevelRequired": 2}, {"shortname": "smg.mp5", "displayName": {"token": "smg.mp5", "english": "MP5A4"}, "workbenchLevelRequired": 3}, {"shortname": "smg.thompson", "displayName": {"token": "smg.thompson", "english": "Thompson"}, "workbenchLevelRequired": 2}, {"shortname": "spikes.floor", "displayName": {"token": "spikes.floor", "english": "Wooden Floor Spikes"}, "workbenchLevelRequired": 0}, {"shortname": "spinner.wheel", "displayName": {"token": "spinner.wheel", "english": "Spinning wheel"}, "workbenchLevelRequired": 0}, {"shortname": "surveycharge", "displayName": {"token": "surveycharge", "english": "Survey Charge"}, "workbenchLevelRequired": 2}, {"shortname": "syringe.medical", "displayName": {"token": "syringe.medical", "english": "Medical Syringe"}, "workbenchLevelRequired": 2}, {"shortname": "table", "displayName": {"token": "table", "english": "Table"}, "workbenchLevelRequired": 0}, {"shortname": "target.reactive", "displayName": {"token": "target.reactive", "english": "Reactive Target"}, "workbenchLevelRequired": 1}, {"shortname": "trap.bear", "displayName": {"token": "trap.bear", "english": "Snap Trap"}, "workbenchLevelRequired": 1}, {"shortname": "trap.landmine", "displayName": {"token": "trap.landmine", "english": "Land Mine"}, "workbenchLevelRequired": 2}, {"shortname": "tshirt.long", "displayName": {"token": "tshirt.long", "english": "Longsleeve T-Shirt"}, "workbenchLevelRequired": 1}, {"shortname": "tshirt", "displayName": {"token": "tshirt", "english": "T-Shirt"}, "workbenchLevelRequired": 1}, {"shortname": "tunalight", "displayName": {"token": "tunalight", "english": "Tuna Can Lamp"}, "workbenchLevelRequired": 0}, {"shortname": "wall.external.high.stone", "displayName": {"token": "wall.external.high.stone", "english": "High External Stone Wall"}, "workbenchLevelRequired": 2}, {"shortname": "wall.external.high", "displayName": {"token": "wall.external.high", "english": "High External Wooden Wall"}, "workbenchLevelRequired": 1}, {"shortname": "wall.frame.cell.gate", "displayName": {"token": "wall.frame.cell.gate", "english": "Prison Cell Gate"}, "workbenchLevelRequired": 2}, {"shortname": "wall.frame.cell", "displayName": {"token": "wall.frame.cell", "english": "Prison Cell Wall"}, "workbenchLevelRequired": 2}, {"shortname": "wall.frame.fence.gate", "displayName": {"token": "wall.frame.fence.gate", "english": "Chainlink Fence Gate"}, "workbenchLevelRequired": 1}, {"shortname": "wall.frame.fence", "displayName": {"token": "wall.frame.fence", "english": "Chainlink Fence"}, "workbenchLevelRequired": 1}, {"shortname": "wall.frame.garagedoor", "displayName": {"token": "wall.frame.garagedoor", "english": "Garage Door"}, "workbenchLevelRequired": 1}, {"shortname": "wall.window.bars.metal", "displayName": {"token": "wall.window.bars.metal", "english": "Metal Window Bars"}, "workbenchLevelRequired": 1}, {"shortname": "wall.window.bars.toptier", "displayName": {"token": "wall.window.bars.toptier", "english": "Reinforced Window Bars"}, "workbenchLevelRequired": 3}, {"shortname": "wall.window.glass.reinforced", "displayName": {"token": "wall.window.glass.reinforced", "english": "Reinforced Glass Window"}, "workbenchLevelRequired": 1}, {"shortname": "water.barrel", "displayName": {"token": "water.barrel", "english": "Water Barrel"}, "workbenchLevelRequired": 0}, {"shortname": "water.catcher.large", "displayName": {"token": "water.catcher.large", "english": "Large Water Catcher"}, "workbenchLevelRequired": 2}, {"shortname": "water.catcher.small", "displayName": {"token": "water.catcher.small", "english": "Small Water Catcher"}, "workbenchLevelRequired": 1}, {"shortname": "weapon.mod.flashlight", "displayName": {"token": "weapon.mod.flashlight", "english": "Weapon flashlight"}, "workbenchLevelRequired": 1}, {"shortname": "weapon.mod.holosight", "displayName": {"token": "weapon.mod.holosight", "english": "Holosight"}, "workbenchLevelRequired": 3}, {"shortname": "weapon.mod.lasersight", "displayName": {"token": "weapon.mod.lasersight", "english": "Weapon Lasersight"}, "workbenchLevelRequired": 3}, {"shortname": "weapon.mod.muzzleboost", "displayName": {"token": "weapon.mod.muzzleboost", "english": "Muzzle Boost"}, "workbenchLevelRequired": 2}, {"shortname": "weapon.mod.muzzlebrake", "displayName": {"token": "weapon.mod.muzzlebrake", "english": "Muzzle Brake"}, "workbenchLevelRequired": 2}, {"shortname": "weapon.mod.silencer", "displayName": {"token": "weapon.mod.silencer", "english": "Silencer"}, "workbenchLevelRequired": 1}, {"shortname": "weapon.mod.simplesight", "displayName": {"token": "weapon.mod.simplesight", "english": "Simple Handmade Sight"}, "workbenchLevelRequired": 1}, {"shortname": "weapon.mod.small.scope", "displayName": {"token": "weapon.mod.small.scope", "english": "4x Zoom Scope"}, "workbenchLevelRequired": 3}]';

        $blueprints = json_decode($blueprints);
        
        foreach ($blueprints as $blueprint) {
            $bp = new Blueprint();
            $bp->display_name = $blueprint->displayName->english;
            $bp->name = $blueprint->shortname;
            $bp->workbench_level = $blueprint->workbenchLevelRequired;
            $bp->save();
        }
        
        return 0;
    }
}
