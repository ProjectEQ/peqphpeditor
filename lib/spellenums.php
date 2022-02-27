<?php

$sp_traveltypes = array(
    0  => "Unknown",
    3  => "Unknown",
    16 => "Unknown"
);

$sp_daytimes = array(
    0 => "Any",
    1 => "Daytime",
    2 => "Nighttime"
);

$sp_acttypes = array(
   -1 => "-1",
    0 => "0",
    1 => "1"
);

$sp_lighttypes = array(
    0 => "Unknown",
    1 => "Unknown",
    2 => "Unknown",
    3 => "Unknown",
    4 => "Unknown",
    5 => "Unknown",
    6 => "Unknown",
    7 => "Unknown",
    8 => "Unknown"
);

$sp_buffformulas = array(
    0    => "Not a Buff",
    1    => "Lowest of Level / 2 or Duration",
    2    => "Duration / 5 * 3",
    3    => "Lowest of Level * 30 or Duration",
    4    => "Duration if not 0, else 50",
    5    => "Lowest of Duration or 3",
    6    => "Lowest of Level / 2 or Duration",
    7    => "Duration if not 0, else Level",
    8    => "Lowest of Level + 10 or Duration",
    9    => "Lowest of Level * 2 + 10 or Duration",
    10   => "Lowest of Level * 3 + 10 or Duration",
    11   => "Duration",
    12   => "Duration",
    13   => "UNK Duration (13)",
    14   => "UNK Duration (14)",
    15   => "UNK Duration (15)",
    50   => "Permanent",
    51   => "Aura",
    3600 => "Duration if not 0, else 3600"
);

$sp_formulas = array(
    1   => "Effect Base + Level * Multiplier (use text entry)",
    60  => "Effect Base / 100",
    100 => "Effect Base Value",
    101 => "Effect Base + Level / 2",
    102 => "Effect Base + Level",
    103 => "Effect Base + Level * 2",
    104 => "Effect Base + Level * 3",
    105 => "Effect Base + Level * 4",
    107 => "Effect Base + Level / 2",
    108 => "Effect Base + Level / 3",
    109 => "Effect Base + Level / 4",
    110 => "Effect Base + Level / 5 **",
    111 => "Effect Base + 6 * (Level - Spell Level)",
    112 => "Effect Base + 8 * (Level - Spell Level)",
    113 => "Effect Base + 10 * (Level - Spell Level)",
    114 => "Effect Base + 15 * (Level - Spell Level)",
    115 => "Effect Base + 6 * (Level - Spell Level) **",
    116 => "Effect Base + 8 * (Level - Spell Level) **",
    117 => "Effect Base + 12 * (Level - Spell Level) **",
    118 => "Effect Base + 20 * (Level - Spell Level) **",
    119 => "Effect Base + Level / 8 **",
    121 => "Effect Base + Level / 3 **",
    122 => "Splurt",
    123 => "Random (Effect Base, Effect Max) **",
    203 => "Effect Max"
);

$sp_zonetypes = array(
   -1   => "None",
    0   => "Indoor",
    1   => "Outdoor",
    2   => "Dungeon",
    255 => "Any"
);

$sp_envtypes = array(
    0  => "Everywhere",
    8  => "Unknown",
    12 => "Cities",
    24 => "Planes"
);

$sp_classnums = array(
    1  => "Warrior",
    2  => "Cleric",
    3  => "Paladin",
    4  => "Ranger",
    5  => "Shadowknight",
    6  => "Druid", 
    7  => "Monk",
    8  => "Bard",
    9  => "Rogue",
    10 => "Shaman",
    11 => "Necromancer",
    12 => "Wizard",
    13 => "Magician",
    14 => "Enchanter",
    15 => "Beastlord",
    16 => "Berserker"
);

$sp_deities = array(
    0  => "Agnostic",
    1  => "Bertoxxulous",
    2  => "Brell Serilis",
    3  => "Cazic Thule",
    4  => "Erollisi Marr",
    5  => "Bristlebane",
    6  => "Innoruuk",
    7  => "Karana",
    8  => "Mithaniel Marr",
    9  => "Prexus",
    10 => "Quellious",
    11 => "Rallos Zek",
    12 => "Rodcet Nife",
    13 => "Solusek Ro",
    14 => "The Tribunal",
    15 => "Tunare",
    16 => "Veeshan"
);

$sp_targets = array(
    0  => "Rag'Zhezum Special",
    1  => "Line of Sight",
    2  => "AE PC v1",
    3  => "Group v1",
    4  => "PB AE",
    5  => "Single",
    6  => "Self",
    8  => "Targeted AE",
    9  => "Animal",
    10 => "Undead",
    11 => "Summoned",
    13 => "Lifetap",
    14 => "Pet",
    15 => "Corpse",
    16 => "Plant",
    17 => "Uber Giants",
    18 => "Uber Dragons",
    20 => "Targeted AE Tap",
    24 => "AE Undead",
    25 => "AE Summoned",
    32 => "Hatelist", //AE Caster2
    33 => "Hatelist2", //NPC Hatelist
    34 => "Chest", //Dungeon Object
    35 => "Special Muramites",
    36 => "Caster PB PC", //Area - PC Only
    37 => "Caster PB NPC", //Area - NPC Only
    38 => "Pet2", //Summoned Pet
    39 => "No Pets",
    40 => "AE PC v2",
    41 => "Group v2",
    42 => "Directional AE",
    43 => "Single in Group", //Group with Pets
    44 => "Beam",
    45 => "Free Target",
    46 => "Target of Target",
    47 => "Pet Owner",
    50 => "Target AE No Players Pets" // Blanket of Forgetfullness. Beneficial, AE mem blur, with max targets
);

$sp_npccats = array(
    0 => "Not Applicable (Non NPC Spell)",
    1 => "AoE Detrimental",
    2 => "Single Target Detrimental",
    3 => "Buffs",
    4 => "Pet Spells",
    5 => "Healing Spells",
    6 => "Gate or Last Cast",
    7 => "Debuffs",
    8 => "Dispells"
);

$sp_spellgroups = array(
   -100  => "Other (Use Text Field)",
   -99   => "NPC",
   -1    => "AA Procs",
    0    => "Unknown",
    1    => "Dir. Dmg [Magic]",
    2    => "Dir. Dmg [Undead]",
    3    => "Dir. Dmg [Summoned]",
    4    => "Dir. Dmg [Lifetaps]",
    5    => "Dir. Dmg [Plant]",
    6    => "Dir. Dmg [Velious Races]",
    7    => "DoT [Magic]",
    8    => "DoT [Undead]",
    9    => "DoT [Lifetaps]",
    10   => "Targeted AE Dmg",
    11   => "PB AE Dmg",
    12   => "AE Rain",
    13   => "Dir. Dmg [Bolt]",
    14   => "Stun [Targeted AE]",
    15   => "Stun [Targeted]",
    16   => "Stun [PB AE]",
    17   => "Drains [HP Mana]",
    18   => "Drains [Stats]",
    19   => "Contact Innates",
    20   => "Heal [Instant]",
    21   => "Heal [Duration]",
    22   => "Group Heal [Instant]",
    23   => "Group Heal [Duration]",
    24   => "Regen [Single]",
    25   => "Regen [Group]",
    26   => "Heal [Own Pet]",
    27   => "Resurrect",
    28   => "Necro Life Transfer",
    29   => "Cure [Poison]",
    30   => "HP Buffs [Single]",
    32   => "AC Buff [Single]",
    34   => "Hate Mod Buffs",
    35   => "Haste [Single]",
    36   => "Haste [Pet]",
    37   => "Haste [Group]",
    38   => "Slow [Single]",
    39   => "Slow [Targeted Area]",
    40   => "Cannabalize",
    41   => "Move Speed [Single]",
    42   => "Move Speed [Group]",
    43   => "Wolf Form",
    44   => "Move Speed [Pet]",
    45   => "Illusion [Self]",
    46   => "Lich",
    47   => "Bear Form",
    48   => "Tree Form",
    49   => "Dead Man Floating",
    50   => "Root",
    51   => "Summon Pet",
    52   => "Summon Corpse",
    53   => "Sense Undead",
    54   => "Invulnerability",
    55   => "Gate [Combat Portal]",
    56   => "Gate [Self Gates]",
    58   => "Translocate",
    59   => "Shadow Step",
    60   => "Enchant Item",
    61   => "Summon [Misc Item]",
    62   => "Fear",
    63   => "Fear [Animal]",
    64   => "Fear [Undead]",
    65   => "Dmg Shield [Single]",
    66   => "Dmg Shield [Group]",
    67   => "Mark Of Karn",
    68   => "Dmg Shield [Self]",
    69   => "Resist Debuffs",
    70   => "Resist Buffs",
    71   => "BST Pet Buffs",
    72   => "Summon Familiar",
    73   => "STR Buff",
    74   => "DEX Buff",
    75   => "AGI Buff",
    76   => "STA Buff",
    77   => "INT Buff",
    78   => "CHA Buff",
    79   => "Stat Debuffs",
    80   => "Invis Undead",
    81   => "Invis Animals",
    82   => "Invisibility",
    83   => "Absorb Damage",
    84   => "Casting Level Buffs",
    85   => "Clarity Line",
    86   => "Max Mana Buffs",
    87   => "Drain Mana",
    88   => "Mana Transfer",
    89   => "Instant Gain Mana",
    90   => "Lower Hate [Jolt]",
    91   => "Increase Archery",
    92   => "ATK Buff",
    93   => "Vision",
    94   => "Water Breathing",
    95   => "Improve Faction",
    96   => "Charm",
    97   => "Dispell",
    98   => "Lull",
    99   => "Mezmerise",
    100  => "Spell Focus Items",
    101  => "Snare [Single]",
    102  => "Snare [AE]",
    105  => "Feign Death",
    106  => "Identify",
    107  => "Reclaim Energy",
    108  => "Find Corpse",
    109  => "Summon Player",
    110  => "Spell Shield",
    112  => "Blindness",
    113  => "Levitation",
    114  => "Extinquish Fatigue",
    115  => "Death Pact",
    116  => "Mem Blur",
    118  => "Height",
    119  => "Add Hate",
    120  => "Iron Maiden",
    121  => "Focus Spells",
    122  => "Melee Guard",
    125  => "Dir. Dmg [Fire]",
    126  => "Dir. Dmg [Ice]",
    127  => "Dir. Dmg [Poison]",
    128  => "Dir. Dmg [Disease]",
    129  => "DoT [Fire]",
    130  => "DoT [Ice]",
    131  => "DoT [Poison]",
    132  => "DoT [Disease]",
    133  => "INT Caster Chest Opening",
    134  => "INT Caster Chest Trap Appraisal",
    135  => "INT Caster Chest Trap Disarm",
    136  => "WIS Caster Chest Trap Disarm",
    137  => "WIS Caster Chest Trap Appraisal",
    138  => "WIS Caster Chest Opening",
    140  => "Destroy [Undead]",
    141  => "Destroy [Summoned]",
    142  => "Targetted AE [Fire]",
    143  => "Targetted AE [Ice]",
    146  => "PB AE [Fire]",
    147  => "PB AE [Ice]",
    150  => "Rain [Fire]",
    151  => "Rain [Ice]",
    152  => "Rain [Poison]",
    154  => "Fear Song",
    155  => "Fast Heals",
    156  => "Mana to Hitpoints",
    157  => "Pet Siphons",
    159  => "Cure [Disease]",
    160  => "Cure [Curse]",
    161  => "Cure [Multiple]",
    162  => "Cure [Blind]",
    163  => "Group Cure [Multiple]",
    164  => "Misc Effects",
    165  => "Shielding",
    166  => "PAL/RNG/BST HP Buffs",
    167  => "Symbols",
    168  => "Aegolism Line",
    169  => "Paladin AC Buffs",
    170  => "Spell Damage Mitigate",
    171  => "Spell/Melee Block",
    172  => "Spell Reflect",
    173  => "Hybrid AC Buffs",
    174  => "HP/Mana Regen",
    175  => "Aggro Decreasers",
    200  => "Misc Spells",
    201  => "Disciplines",
    202  => "Melee Haste",
    203  => "AE Slow",
    204  => "Summon Air Pet",
    205  => "Summon Water Pet",
    206  => "Summon Fire Pet",
    207  => "Summon Earth Pet",
    208  => "Summon Monster Pet",
    209  => "Transport [Antonica]",
    210  => "Transport [Odus]",
    211  => "Transport [Faydwer]",
    212  => "Transport [Kunark]",
    213  => "Transport [Velious]",
    214  => "Transport [Luclin]",
    215  => "Transport [Planes]",
    216  => "Transport [Gates/Omens]",
    217  => "Summon [Weapon]",
    218  => "Summon [Focus]",
    219  => "Summon [Food/Drink]",
    220  => "Summon [Armor]",
    999  => "AA / Abilities",
    1000 => "Unknown"
);

$sp_skills = array(
   -1  => "All Skills",
    0  => "1H Blunt",
    1  => "1H Slashing",
    2  => "2H Blunt",
    3  => "2H Slashing",
    4  => "Abjuration",
    5  => "Alteration",
    6  => "Apply Poison",
    7  => "Archery",
    8  => "Backstab",
    9  => "Bind Wound",
    10 => "Bash",
    11 => "Block",
    12 => "Brass Instruments",
    13 => "Channeling",
    14 => "Conjuration",
    15 => "Defense",
    16 => "Disarm",
    17 => "Disarm Traps",
    18 => "Divination",
    19 => "Dodge",
    20 => "Double Attack",
    21 => "Dragon Punch",
    22 => "Dual Wield",
    23 => "Eagle Strike",
    24 => "Evocation",
    25 => "Feign Death",
    26 => "Flying Kick",
    27 => "Forage",
    28 => "Hand To Hand",
    29 => "Hide",
    30 => "Kick",
    31 => "Meditate",
    32 => "Mend",
    33 => "Offense",
    34 => "Parry",
    35 => "Pick Lock",
    36 => "1H Piercing",
    37 => "Riposte",
    38 => "Round Kick",
    39 => "Safe Fall",
    40 => "Sense Heading",
    41 => "Singing",
    42 => "Sneak",
    43 => "Specialize Abjure",
    44 => "Specialize Alteration",
    45 => "Specialize Conjuration",
    46 => "Specialize Divinatation",
    47 => "Specialize Evocation",
    48 => "Pick Pockets",
    49 => "Stringed Instruments",
    50 => "Swimming",
    51 => "Throwing",
    52 => "Tiger Claw",
    53 => "Tracking",
    54 => "Wind Instruments",
    55 => "Fishing",
    56 => "Make Poison",
    57 => "Tinkering",
    58 => "Research",
    59 => "Alchemy",
    60 => "Baking",
    61 => "Tailoring",
    62 => "Sense Traps",
    63 => "Blacksmithing",
    64 => "Fletching",
    65 => "Brewing",
    66 => "Alcohol Tolerance",
    67 => "Begging",
    68 => "Jewelry Making",
    69 => "Pottery",
    70 => "Percussion Instruments",
    71 => "Intimidation",
    72 => "Berserking",
    73 => "Taunt",
    74 => "Frenzy",
    75 => "Remove Trap",
    76 => "Triple Attack",
    77 => "2H Piercing",
    78 => "Unknown78",
    79 => "Unknown79",
    80 => "Unknown80",
    81 => "Unknown81",
    82 => "Unknown82",
    83 => "Unknown83",
    84 => "Unknown84",
    85 => "Unknown85",
    86 => "Unknown86",
    87 => "Unknown87",
    88 => "Unknown88",
    89 => "Unknown89",
    90 => "Unknown90",
    91 => "Unknown91",
    92 => "Unknown92",
    93 => "Unknown93",
    94 => "Unknown94",
    95 => "Unknown95",
    96 => "Unknown96",
    97 => "Unknown97",
    98 => "Unknown98",
    99 => "Unknown99",
   100 => "Unknown100",
   101 => "Unknown101",
   102 => "Unknown102",
   103 => "Unknown103",
   104 => "Unknown104",
   105 => "Harm Touch",
   106 => "Unknown106",
   107 => "Lay Hands",
   108 => "Unknown108",
   109 => "Unknown109",
   110 => "Unknown110",
   111 => "Slam",
   112 => "Unknown112",
   113 => "Unknown113",
   114 => "Inspect",
   115 => "Open",
   116 => "Reveal Trap",
   117 => "Unknown117",
   118 => "Unknown118",
   119 => "Unknown119",
   120 => "Unknown120",
   121 => "Unknown121",
   122 => "Unknown122",
   123 => "Unknown123",
   124 => "Unknown124",
   125 => "Unknown125",
   126 => "Unknown126",
   127 => "Unknown127",
   128 => "Unknown128",
   129 => "Unknown129",
   130 => "Unknown130",
   131 => "Unknown131",
   132 => "Throw Stone"
);

$sp_spelltypes = array(
    1    => "Nuke",
    2    => "Heal",
    4    => "Root",
    8    => "Buff",
    16   => "Escape",
    32   => "Pet",
    64   => "Lifetap",
    128  => "Snare",
    256  => "DoT",
    512  => "Dispel",
    1024 => "In Combat Buff",
    2048 => "Mez",
    4096 => "Charm"
);

$sp_beneficial = 2 | 8 | 16 | 32 | 1024;
$sp_detrimental = 1 | 4 | 64 | 128 | 256 | 512 | 2048 | 4096;

$sp_goodeffect = array(
    0 => "Detrimental",
    1 => "Beneficial",
    2 => "Beneficial, Group Only"
);

$sp_resisttype = array(
    0 => "Unresistable",
    1 => "Magic",
    2 => "Fire",
    3 => "Cold",
    4 => "Poison",
    5 => "Disease",
    6 => "Chromatic",
    7 => "Prismatic",
    8 => "Physical",
    9 => "Corruption"
);

$sp_effects = array(
    0   => "Current HP",
    1   => "AC",
    2   => "ATK",
    3   => "Movement Speed",
    4   => "STR",
    5   => "DEX",
    6   => "AGI",
    7   => "STA",
    8   => "INT",
    9   => "WIS",
    10  => "CHA",
    11  => "Attack Speed",
    12  => "Invisibility",
    13  => "See Invis",
    14  => "Water Breathing",
    15  => "Current Mana",
    16  => "NPC Frenzy",
    17  => "NPC Awareness",
    18  => "Lull",
    19  => "Add Faction",
    20  => "Blind",
    21  => "Stun",
    22  => "Charm",
    23  => "Fear",
    24  => "Stamina",
    25  => "Bind Affinity",
    26  => "Gate",
    27  => "Cancel Magic",
    28  => "Invis vs Undead",
    29  => "Invis vs Animals",
    30  => "Change Frenzy Radius",
    31  => "Mez",
    32  => "Summon Item",
    33  => "Summon Pet",
    34  => "Confuse",
    35  => "Disease Counter",
    36  => "Poison Counter",
    37  => "Detect Hostile",
    38  => "Detect Magic",
    39  => "Twincast Blocker",
    40  => "Divine Aura",
    41  => "Destroy",
    42  => "Shadow Step",
    43  => "Berserk",
    44  => "Lycanthropy",
    45  => "Vampirism",
    46  => "Resist Fire",
    47  => "Resist Cold",
    48  => "Resist Poison",
    49  => "Resist Disease",
    50  => "Resist Magic",
    51  => "Detect Traps",
    52  => "Sense Undead",
    53  => "Sense Summoned",
    54  => "Sense Animals",
    55  => "Rune",
    56  => "True North",
    57  => "Levitate",
    58  => "Illusion",
    59  => "Damage Shield",
    60  => "Transfer Item",
    61  => "Identify",
    62  => "Item ID",
    63  => "Wipe Hate List",
    64  => "Spin Target",
    65  => "Infra Vision",
    66  => "Ultra Vision",
    67  => "Eye of Zomm",
    68  => "Reclaim Pet",
    69  => "Total HP",
    70  => "Corpse Bomb",
    71  => "Necro Pet",
    72  => "Preserve Corpse",
    73  => "Bind Sight",
    74  => "Feign Death",
    75  => "Voice Graft",
    76  => "Sentinel",
    77  => "Locate Corpse",
    78  => "Absorb Magic Attack",
    79  => "Current HP Once",
    80  => "Enchant Light",
    81  => "Revive",
    82  => "Summon PC",
    83  => "Teleport",
    84  => "Toss Up",
    85  => "Weapon Proc",
    86  => "Harmony",
    87  => "Magnify Vision",
    88  => "Succor",
    89  => "Model Size",
    90  => "Cloak",
    91  => "Summon Corpse",
    92  => "Instant Hate",
    93  => "Stop Rain",
    94  => "Negate if Combat",
    95  => "Sacrifice",
    96  => "Silence",
    97  => "Mana Pool",
    98  => "Attack Speed 2",
    99  => "Root",
    100 => "Heal Over Time",
    101 => "Complete Heal",
    102 => "Fearless",
    103 => "Call Pet",
    104 => "Translocate",
    105 => "Anti-Gate",
    106 => "Summon Beast Pet",
    107 => "Alter NPC Level",
    108 => "Familiar",
    109 => "Create Item Into Bag",
    110 => "Increase Archery",
    111 => "Resist All",
    112 => "Casting Level",
    113 => "Summon Horse",
    114 => "Change Aggro",
    115 => "Hunger",
    116 => "Curse Counter",
    117 => "Magic Weapon",
    118 => "Amplification",
    119 => "Attack Speed 3",
    120 => "Heal Rate",
    121 => "Reverse DS",
    122 => "Reduce Skill",
    123 => "Screech",
    124 => "Improved Damage",
    125 => "Improved Heal",
    126 => "Spell Resist Reduction",
    127 => "Increase Spell Haste",
    128 => "Increase Spell Duration",
    129 => "Increase Range",
    130 => "Spell Hate Mod",
    131 => "Reduce Reagent Cost",
    132 => "Reduce Mana Cost",
    133 => "Focus: Stun Time Mod",
    134 => "Limit: Max Level",
    135 => "Limit: Resist",
    136 => "Limit: Target",
    137 => "Limit: Effect",
    138 => "Limit: Spell Type",
    139 => "Limit: Spell",
    140 => "Limit: Min Duration",
    141 => "Limit: Instant",
    142 => "Limit: Min Level",
    143 => "Limit: Cast Time Min",
    144 => "Limit: Cast Time Max",
    145 => "Teleport 2",
    146 => "Electricity Resist",
    147 => "Percent Heal",
    148 => "Stacking Command Block",
    149 => "Stacking Command Overwrite",
    150 => "Death Save",
    151 => "Suspend Pet",
    152 => "Temporary Pets",
    153 => "Balance HP",
    154 => "Dispel Detrimental",
    155 => "Spell Crit Damage Increase",
    156 => "Illusion Copy",
    157 => "Spell Damage Shield",
    158 => "Reflect",
    159 => "All Stats",
    160 => "Make Drunk",
    161 => "Mitigate Spell Damage",
    162 => "Mitigate Melee Damage",
    163 => "Negate Attacks",
    164 => "Appraise LDoN Chest",
    165 => "Disarm LDoN Trap",
    166 => "Unlock LDoN Chest",
    167 => "Pet Power Increase",
    168 => "Melee Mitigation",
    169 => "Critical Hit CHance",
    170 => "Spell Crit Chance",
    171 => "Crippling Blow Chance",
    172 => "Avoid Melee Chance",
    173 => "Riposte Chance",
    174 => "Dodge Chance",
    175 => "Parry Chance",
    176 => "Dual Wield Chance",
    177 => "Double Attack Chance",
    178 => "Melee Lifetap",
    179 => "All Instrument Mod",
    180 => "Resist Spell Chance",
    181 => "Resist Fear Chance",
    182 => "Hundred Hands",
    183 => "Melee Skill Check",
    184 => "Hit Chance",
    185 => "Damage Modifier",
    186 => "Min Damage Mod",
    187 => "Balance Mana",
    188 => "Increase Block Chance",
    189 => "CurrentEndurance",
    190 => "Endurance Pool",
    191 => "Amnesia",
    192 => "Hate",
    193 => "Skill Attack",
    194 => "Fading Memories",
    195 => "Stun Resist",
    196 => "Strike Through",
    197 => "Skill Damage Taken",
    198 => "Current Endurance Once",
    199 => "Taunt",
    200 => "Proc Chance",
    201 => "Ranged Proc",
    202 => "Illusion Other",
    203 => "Mass Group Buff",
    204 => "Group Fear Immunity",
    205 => "Rampage",
    206 => "AE Taunt",
    207 => "Flesh to Bone",
    208 => "Purge Poison",
    209 => "Dispel Beneficial",
    210 => "Pet Shield",
    211 => "AE Melee",
    212 => "Frenzied Devastation",
    213 => "Pet Max HP",
    214 => "Max HP Change",
    215 => "Pet Avoidance",
    216 => "Accuracy",
    217 => "Head Shot",
    218 => "Pet Critical Hit",
    219 => "Slay Undead",
    220 => "Skill Damage Amount",
    221 => "Packrat",
    222 => "Block Behind",
    223 => "Double Riposte",
    224 => "Give Double Riposte",
    225 => "Give Double Attack",
    226 => "Two Hand Bash",
    227 => "Reduce Skill Timer",
    228 => "Reduce Fall Damage",
    229 => "Persistent Casting",
    230 => "Extended Shielding",
    231 => "Stun Bash Chance",
    232 => "Divine Save",
    233 => "Metabolism",
    234 => "Reduce Apply Poison Time",
    235 => "Channel Chance Spells",
    236 => "Free Pet",
    237 => "Give Pet Group Target",
    238 => "Illusion Persistence",
    239 => "Feigned Cast on Chance",
    240 => "String Unbreakable",
    241 => "Improve Reclaim Energy",
    242 => "Increase Chance Memwipe",
    243 => "Charm Break Chance",
    244 => "Root Break Chance",
    245 => "Trap Circumvention",
    246 => "Set Breath Level",
    247 => "Raise Skill Cap",
    248 => "Secondary Forte",
    249 => "Secondary Damage Increase",
    250 => "Spell Proc Chance",
    251 => "Consume Projectile",
    252 => "Frontal Backstab Chance",
    253 => "Frontal Backstab Min Damage",
    254 => "Blank",
    255 => "Shield Duration",
    256 => "Shroud of Stealth",
    257 => "Pet Discipline",
    258 => "Triple Backstab",
    259 => "Combat Stability",
    260 => "Add Singing Mod",
    261 => "Song Mod Cap",
    262 => "Raise Stat Cap",
    263 => "Tradeskill Mastery",
    264 => "Hastened AA Skill",
    265 => "Mastery of Past",
    266 => "Extra Attack Chance",
    267 => "Add Pet Command",
    268 => "Reduce Tradeskill Fail",
    269 => "Max Bind Wound",
    270 => "Bard Song Range",
    271 => "Base Movement Speed",
    272 => "Casting Level 2",
    273 => "Critical DoT Chance",
    274 => "Critical Heal Chance",
    275 => "Critical Mend",
    276 => "Ambidexterity",
    277 => "Unfailing Divinity",
    278 => "Finishing Blow",
    279 => "Flurry",
    280 => "Pet Flurry",
    281 => "Feigned Minion",
    282 => "Improved Bind Wound",
    283 => "Double Special Attack",
    284 => "LoH Set Heal",
    285 => "Nimble Evasion",
    286 => "Focus: Damage Amount",
    287 => "Spell Duration Increase by Tick",
    288 => "Skill Attack Proc",
    289 => "Cast on Fade Effect",
    290 => "Increase Run Speed Cap",
    291 => "Purify",
    292 => "Strike Through 2",
    293 => "Frontal Stun Resist",
    294 => "Critical Spell Chance",
    295 => "Reduce Timer Special",
    296 => "Focus: Spell Vulnerability",
    297 => "Focus: Damage Amount Incoming",
    298 => "Change Height",
    299 => "Wake the Dead",
    300 => "Doppelganger",
    301 => "Archery Damage Modifier",
    302 => "Focus: Damage Percent Crit",
    303 => "Focus: Damage Amount Crit",
    304 => "Offhand Riposte Fail",
    305 => "Mitigate Damage Shield",
    306 => "Army of the Dead",
    307 => "Appraisal",
    308 => "Suspend Minion",
    309 => "Gate Casters Bindpoint",
    310 => "Reduce Reuse Timer",
    311 => "Limit: Combat Skills",
    312 => "Sanctuary",
    313 => "Forage Additional Items",
    314 => "Invisibility 2",
    315 => "Invis vs Undead 2",
    316 => "Improved Invis Animals",
    317 => "Item HP Regen Cap Increase",
    318 => "Item Mana Regen Cap Increase",
    319 => "Critical Heal Over Time",
    320 => "Shield Block",
    321 => "Reduce Hate",
    322 => "Gate to Home City",
    323 => "Defensive Proc",
    324 => "HP to Mana",
    325 => "No Break AE Sneak",
    326 => "Spell Slot Increase",
    327 => "Mystical Attune",
    328 => "Delay Death",
    329 => "Mana Absorb Percent Damage",
    330 => "Critical Damage Mod",
    331 => "Salvage",
    332 => "Summon to Corpse",
    333 => "Cast on Rune Fade Effect",
    334 => "Bard AE DoT",
    335 => "Block Next Spell Focus",
    336 => "Illusionary Target",
    337 => "Percent XP Increase",
    338 => "Summon and Resurrect All Corpses",
    339 => "Trigger on Cast",
    340 => "Spell Trigger",
    341 => "Item Attack Cap Increase",
    342 => "Immune Fleeing",
    343 => "Interrupt Casting",
    344 => "Channel Chance Items",
    345 => "Assassinate Level",
    346 => "Head Shot Level",
    347 => "Double Ranged Attack",
    348 => "Limit: Mana Min",
    349 => "Shield Equip Damage Mod",
    350 => "Mana Burn",
    351 => "Persistent Effect",
    352 => "Increase Trap Count",
    353 => "Additional Aura",
    354 => "Deactivate All Traps",
    355 => "Learn Trap",
    356 => "Change Trigger Type",
    357 => "Focus: Mute",
    358 => "Current Mana Once",
    359 => "Passive Sense Trap",
    360 => "Proc on Kill Shot",
    361 => "Spell on Death",
    362 => "Potion Belt Slots",
    363 => "Bandolier Slots",
    364 => "Triple Attack Chance",
    365 => "Proc on Spell Kill Shot",
    366 => "Group Shielding",
    367 => "Set Body Type",
    368 => "Faction Mod",
    369 => "Corruption Counter",
    370 => "Resist Corruption",
    371 => "Attack Speed 4",
    372 => "Forage Skill",
    373 => "Cast on Fade Effect Always",
    374 => "Apply Effect",
    375 => "DoT Crit Damage Increase",
    376 => "Fling",
    377 => "Cast on Fade Effect NPC",
    378 => "Spell Effect Resist Chance",
    379 => "Shadow Step Directional",
    380 => "Knockdown",
    381 => "Knock Toward Caster",
    382 => "Negate Spell Effect",
    383 => "Sympathetic Proc",
    384 => "Leap",
    385 => "Limit: Spell Group",
    386 => "Cast on Curer",
    387 => "Cast on Cure",
    388 => "Summon Corpse Zone",
    389 => "Focus: Timer Refresh",
    390 => "Focus: Timer Lockout",
    391 => "Limit: Mana Max",
    392 => "Focus: Heal Amt",
    393 => "Focus: Heal Percent Incoming",
    394 => "Focus: Heal Amt Incoming",
    395 => "Focus: Heal Percent Crit Incoming",
    396 => "Focus: Heal Amt Crit",
    397 => "Pet Melee Mitigation",
    398 => "Swarm Pet Duration",
    399 => "Focus: Twincast",
    400 => "Heal Group from Mana",
    401 => "Mana Drain with Dmg",
    402 => "Endurance Drain with Dmg",
    403 => "Limit: Spell Class",
    404 => "Limit: Spell Subclass",
    405 => "Two Hand Blunt Block",
    406 => "Cast on Num Hit Fade",
    407 => "Cast on Focus Effect",
    408 => "Limit: HP Percent",
    409 => "Limit: Mana Percent",
    410 => "Limit: Endurance Percent",
    411 => "Limit: Class",
    412 => "Limit: Race",
    413 => "Focus: Base Effects",
    414 => "Limit: Casting Skill",
    415 => "Limit: Item Class",
    416 => "AC v2",
    417 => "Mana Regen v2",
    418 => "Skill Damage Amount 2",
    419 => "Add Melee Proc",
    420 => "Focus: Limit Use",
    421 => "Focus: Increase Num Hits",
    422 => "Limit: Use Min",
    423 => "Limit: Use Type",
    424 => "Gravity Effect",
    425 => "Display",
    426 => "Increase Ext Target Window",
    427 => "Skill Proc",
    428 => "Limit to Skill",
    429 => "Skill Proc Success",
    430 => "Post Effect",
    431 => "Post Effect Data",
    432 => "Expand Max Active Trophy Benefits",
    433 => "Critical DoT Decay",
    434 => "Critical Heal Decay",
    435 => "Critical Regen Decay",
    436 => "Beneficial Countdown Hold",
    437 => "Teleport to Anchor",
    438 => "Translocate to Anchor",
    439 => "Assassinate",
    440 => "Finishing Blow Level",
    441 => "Distance Removal",
    442 => "Trigger on Req Target",
    443 => "Trigger on Req Caster",
    444 => "Improved Taunt",
    445 => "Add Merc Slot",
    446 => "A Stacker",
    447 => "B Stacker",
    448 => "C Stacker",
    449 => "D Stacker",
    450 => "Mitigate DoT Damage",
    451 => "Melee Threshold Guard",
    452 => "Spell Threshold Guard",
    453 => "Trigger Melee Threshold",
    454 => "Trigger Spell Threshold",
    455 => "Add Hate Percent",
    456 => "Add Hate Over Time Percent",
    457 => "Resource Tap",
    458 => "Faction Mod Percent",
    459 => "Damage Modifier 2",
    460 => "Limit: Override Not Focusable",
    461 => "Improved Damage 2",
    462 => "Focus: Damage Amount 2",
    463 => "Shield Target",
    464 => "PC Pet Rampage",
    465 => "PC Pet AE Rampage",
    466 => "Player Pet Flurry Chance",
    467 => "DS Mitigation Amount",
    468 => "DS Mitigation Percent",
    469 => "Chance Best in Spell Group",
    470 => "Trigger Best in Spell Group",
    471 => "Double Melee Round",
    472 => "Buy AA Rank",
    473 => "Double Backstab Front",
    474 => "Pet Crit Melee Damage Percent Owner",
    475 => "Trigger Spell Non-Item",
    476 => "Weapon Stance",
    477 => "Hatelist to Top Index",
    478 => "Hatelist to Tail Index",
    479 => "Limit: Value Min",
    480 => "Limit: Value Max",
    481 => "Focus: Cast Spell on Land",
    482 => "Skill Base Damage Mod",
    483 => "Focus: Spell Damage Percent Incoming PC",
    484 => "Focus: Spell Damage Amount Incoming PC",
    485 => "Limit: Caster Class",
    486 => "Limit: Same Caster",
    487 => "Extend Tradeskill Cap",
    488 => "Defender Melee Force Percent PC",
    489 => "Worn Endurance Regen Cap",
    490 => "Limit: Reuse Time Min",
    491 => "Limit: Reuse Time Max",
    492 => "Limit: Endurance Min",
    493 => "Limit: Endurance Max",
    494 => "Pet Add Attack",
    495 => "Limit: Duration Max",
    496 => "Critical Melee Damage Mod Max",
    497 => "Limit: Focus Cast Proc No Bypass",
    498 => "Add Extra Attack Percent 1H PRI",
    499 => "Add Extra Attack Percent 1H SEC",
    500 => "Focus: Cast Time Mod 2",
    501 => "Focus: Cast Time Amount",
    502 => "Fearstun",
    503 => "Melee Damage Position Mod",
    504 => "Melee Damage Position Amount",
    505 => "Damage Taken Position Mod",
    506 => "Damage Taken Position Amount",
    507 => "Focus: Amplify Mod",
    508 => "Focus: Amplify Amount",
    509 => "Health Transfer",
    510 => "Focus: Resist Incoming",
    511 => "Limit: Focus Timer Min",
    512 => "Proc Timer Modifier",
    513 => "Mana Max Percent",
    514 => "Endurance Max Percent",
    515 => "AC Avoidance Max Percent",
    516 => "AC Mitigation Max Percent",
    517 => "Attack Offense Max Percent",
    518 => "Attack Accuracy Max Percent",
    519 => "Luck Amount",
    520 => "Luck Percent",
    521 => "Endurance Absorb Percent Damage",
    522 => "Instant Mana Percent",
    523 => "Instant Endurance Percent",
    524 => "Duration HP Percent",
    525 => "Duration Mana Percent",
    526 => "Duration Endurance Percent"
);

$sp_fields = array(
    "name",                 //SPELLNAME
    "player_1",             //ACTORTAG
    "teleport_zone",        //NPC_FILENAME
    "you_cast",             //CASTERMETXT
    "other_casts",          //CASTEROTHERTXT
    "cast_on_you",          //CASTEDMETXT
    "cast_on_other",        //CASTEDOTHERTXT
    "spell_fades",          //SPELLGONE
    "`range`",              //RANGE
    "aoerange",             //IMPACTRANGE
    "pushback",             //OUTFORCE
    "pushup",               //UPFORCE
    "cast_time",            //CASTINGTIME
    "recovery_time",        //RECOVERYDELAY
    "recast_time",          //SPELLDELAY
    "buffdurationformula",  //DURATIONBASE
    "buffduration",         //DURATIONCAP
    "AEDuration",           //IMPACTDURATION
    "mana",                 //MANACOST
    "effect_base_value1",   //BASEAFFECT1
    "effect_base_value2",   //BASEAFFECT2
    "effect_base_value3",   //BASEAFFECT3
    "effect_base_value4",   //BASEAFFECT4
    "effect_base_value5",   //BASEAFFECT5
    "effect_base_value6",   //BASEAFFECT6
    "effect_base_value7",   //BASEAFFECT7
    "effect_base_value8",   //BASEAFFECT8
    "effect_base_value9",   //BASEAFFECT9
    "effect_base_value10",  //BASEAFFECT10
    "effect_base_value11",  //BASEAFFECT11
    "effect_base_value12",  //BASEAFFECT12
    "effect_limit_value1",  //BASE_EFFECT2_1
    "effect_limit_value2",  //BASE_EFFECT2_2
    "effect_limit_value3",  //BASE_EFFECT2_3
    "effect_limit_value4",  //BASE_EFFECT2_4
    "effect_limit_value5",  //BASE_EFFECT2_5
    "effect_limit_value6",  //BASE_EFFECT2_6
    "effect_limit_value7",  //BASE_EFFECT2_7
    "effect_limit_value8",  //BASE_EFFECT2_8
    "effect_limit_value9",  //BASE_EFFECT2_9
    "effect_limit_value10", //BASE_EFFECT2_10
    "effect_limit_value11", //BASE_EFFECT2_11
    "effect_limit_value12", //BASE_EFFECT2_12
    "max1",                 //AFFECT1CAP
    "max2",                 //AFFECT2CAP
    "max3",                 //AFFECT3CAP
    "max4",                 //AFFECT4CAP
    "max5",                 //AFFECT5CAP
    "max6",                 //AFFECT6CAP
    "max7",                 //AFFECT7CAP
    "max8",                 //AFFECT8CAP
    "max9",                 //AFFECT9CAP
    "max10",                //AFFECT10CAP
    "max11",                //AFFECT11CAP
    "max12",                //AFFECT12CAP
    "icon",                 //IMAGENUMBER
    "memicon",              //MEMIMAGENUMBER
    "components1",          //EXPENDREAGENT1
    "components2",          //EXPENDREAGENT2
    "components3",          //EXPENDREAGENT3
    "components4",          //EXPENDREAGENT4
    "component_counts1",    //EXPENDQTY1
    "component_counts2",    //EXPENDQTY2
    "component_counts3",    //EXPENDQTY3
    "component_counts4",    //EXPENDQTY4
    "NoexpendReagent1",     //NOEXPENDREAGENT1
    "NoexpendReagent2",     //NOEXPENDREAGENT2
    "NoexpendReagent3",     //NOEXPENDREAGENT3
    "NoexpendReagent4",     //NOEXPENDREAGENT4
    "formula1",             //LEVELAFFECT1MOD
    "formula2",             //LEVELAFFECT2MOD
    "formula3",             //LEVELAFFECT3MOD
    "formula4",             //LEVELAFFECT4MOD
    "formula5",             //LEVELAFFECT5MOD
    "formula6",             //LEVELAFFECT6MOD
    "formula7",             //LEVELAFFECT7MOD
    "formula8",             //LEVELAFFECT8MOD
    "formula9",             //LEVELAFFECT9MOD
    "formula10",            //LEVELAFFECT10MOD
    "formula11",            //LEVELAFFECT11MOD
    "formula12",            //LEVELAFFECT12MOD
    "LightType",            //LIGHTTYPE
    "goodEffect",           //BENEFICIAL
    "Activated",            //ACTIVATED
    "resisttype",           //RESISTTYPE
    "effectid1",            //SPELLAFFECT1
    "effectid2",            //SPELLAFFECT2
    "effectid3",            //SPELLAFFECT3
    "effectid4",            //SPELLAFFECT4
    "effectid5",            //SPELLAFFECT5
    "effectid6",            //SPELLAFFECT6
    "effectid7",            //SPELLAFFECT7
    "effectid8",            //SPELLAFFECT8
    "effectid9",            //SPELLAFFECT9
    "effectid10",           //SPELLAFFECT10
    "effectid11",           //SPELLAFFECT11
    "effectid12",           //SPELLAFFECT12
    "targettype",           //TYPENUMBER
    "basediff",             //BASEDIFFICULTY
    "skill",                //CASTINGSKILL
    "zonetype",             //ZONETYPE
    "EnvironmentType",      //ENVIRONMENTTYPE
    "TimeOfDay",            //TIMEOFDAY
    "classes1",             //WARRIORMIN
    "classes2",             //CLERICMIN
    "classes3",             //PALADINMIN
    "classes4",             //RANGERMIN
    "classes5",             //SHADOWKNIGHTMIN
    "classes6",             //DRUIDMIN
    "classes7",             //MONKMIN
    "classes8",             //BARDMIN
    "classes9",             //ROGUEMIN
    "classes10",            //SHAMANMIN
    "classes11",            //NECROMANCERMIN
    "classes12",            //WIZARDMIN
    "classes13",            //MAGICIANMIN
    "classes14",            //ENCHANTERMIN
    "classes15",            //BEASTLORDMIN
    "classes16",            //BERSERKERMIN
    "CastingAnim",          //CASTINGANIM
    "TargetAnim",           //TARGETANIM
    "TravelType",           //TRAVELTYPE
    "SpellAffectIndex",     //SPELLAFFECTINDEX
    "disallow_sit",         //CANCELONSIT
    "deities0",             //DIETY_AGNOSTIC
    "deities1",             //DIETY_BERTOXXULOUS
    "deities2",             //DIETY_BRELLSIRILIS
    "deities3",             //DIETY_CAZICTHULE
    "deities4",             //DIETY_EROLLISIMARR
    "deities5",             //DIETY_BRISTLEBANE
    "deities6",             //DIETY_INNORUUK
    "deities7",             //DIETY_KARANA
    "deities8",             //DIETY_MITHANIELMARR
    "deities9",             //DIETY_PREXUS
    "deities10",            //DIETY_QUELLIOUS
    "deities11",            //DIETY_RALLOSZEK
    "deities12",            //DIETY_RODCETNIFE
    "deities13",            //DIETY_SOLUSEKRO
    "deities14",            //DIETY_THETRIBUNAL
    "deities15",            //DIETY_TUNARE
    "deities16",            //DIETY_VEESHAN
    "field142",             //NPC_NO_CAST
    "field143",             //AI_PT_BONUS
    "new_icon",             //NEW_ICON
    "spellanim",            //SPELL_EFFECT_INDEX
    "uninterruptable",      //NO_INTERRUPT
    "ResistDiff",           //RESIST_MOD
    "dot_stacking_exempt",  //NOT_STACKABLE_DOT
    "deleteable",           //DELETE_OK
    "RecourseLink",         //REFLECT_SPELLINDEX
    "no_partial_resist",    //NO_PARTIAL_SAVE
    "field152",             //SMALL_TARGETS_ONLY
    "field153",             //USES_PERSISTENT_PARTICLES
    "short_buff_box",       //BARD_BUFF_BOX
    "descnum",              //DESCRIPTION_INDEX
    "typedescnum",          //PRIMARY_CATEGORY
    "effectdescnum",        //SECONDARY_CATEGORY_1
    "effectdescnum2",       //SECONDARY_CATEGORY_2
    "npc_no_los",           //NO_NPC_LOS
    "field160",             //FEEDBACKABLE
    "reflectable",          //REFLECTABLE
    "bonushate",            //HATE_MOD
    "field163",             //RESIST_PER_LEVEL
    "field164",             //RESIST_CAP
    "ldon_trap",            //AFFECT_INANIMATE
    "EndurCost",            //STAMINA_COST
    "EndurTimerIndex",      //TIMER_INDEX
    "IsDiscipline",         //IS_SKILL
    "field169",             //ATTACK_OPENING
    "field170",             //DEFENSE_OPENING
    "field171",             //SKILL_OPENING
    "field172",             //NPC_ERROR_OPENING
    "HateAdded",            //SPELL_HATE_GIVEN
    "EndurUpkeep",          //ENDUR_UPKEEP
    "numhitstype",          //LIMITED_USE_TYPE
    "numhits",              //LIMITED_USE_COUNT
    "pvpresistbase",        //PVP_RESIST_MOD
    "pvpresistcalc",        //PVP_RESIST_PER_LEVEL
    "pvpresistcap",         //PVP_RESIST_CAP
    "spell_category",       //GLOBAL_GROUP
    "pvp_duration",         //PVP_DURATION
    "pvp_duration_cap",     //PVP_DURATION_CAP
    "pcnpc_only_flag",      //PCNPC_ONLY_FLAG
    "cast_not_standing",    //CAST_NOT_STANDING
    "can_mgb",              //CAN_MGB
    "nodispell",            //NO_DISPELL
    "npc_category",         //NPC_MEM_CATEGORY
    "npc_usefulness",       //NPC_USEFULNESS
    "MinResist",            //MIN_RESIST
    "MaxResist",            //MAX_RESIST
    "viral_targets",        //MIN_SPREAD_TIME
    "viral_timer",          //MAX_SPREAD_TIME
    "nimbuseffect",         //DURATION_PARTICLE_EFFECT
    "ConeStartAngle",       //CONE_START_ANGLE
    "ConeStopAngle",        //CONE_END_ANGLE
    "sneaking",             //SNEAK_ATTACK
    "not_extendable",       //NOT_FOCUSABLE
    "field198",             //NO_DETRIMENTAL_SPELL_AGGRO
    "field199",             //SHOW_WEAR_OFF_MESSAGE
    "suspendable",          //IS_COUNTDOWN_HELD
    "viral_range",          //SPREAD_RADIUS
    "songcap",              //BASE_EFFECTS_FOCUS_CAP
    "field203",             //STACKS_WITH_SELF
    "field204",             //NOT_SHOWN_TO_PLAYER
    "no_block",             //NO_BUFF_BLOCK
    "field206",             //ANIM_VARIATION
    "spellgroup",           //SPELL_GROUP
    "rank",                 //SPELL_GROUP_RANK
    "field209",             //NO_RESIST
    "field210",             //ALLOW_SPELLSCRIBE
    "CastRestriction",      //SPELL_REQ_ASSOCIATION_ID
    "allowrest",            //BYPASS_REGEN_CHECK
    "InCombat",             //CAN_CAST_IN_COMBAT
    "OutofCombat",          //CAN_CAST_OUT_OF_COMBAT
    "field215",             //SHOW_DOT_MESSAGE
    "field216",             //INVALID
    "field217",             //OVERRIDE_CRIT_CHANCE
    "aemaxtargets",         //MAX_TARGETS
    "maxtargets",           //NO_HEAL_DAMAGE_ITEM_MOD
    "field220",             //CASTER_REQUIREMENT_ID
    "field221",             //SPELL_CLASS
    "field222",             //SPELL_SUBCLASS
    "field223",             //AI_VALID_TARGETS
    "persistdeath",         //NO_STRIP_ON_DEATH
    "field225",             //BASE_EFFECTS_FOCUS_SLOPE
    "field226",             //BASE_EFFECTS_FOCUS_OFFSET
    "min_dist",             //DISTANCE_MOD_CLOSE_DIST
    "min_dist_mod",         //DISTANCE_MOD_CLOSE_MULT
    "max_dist",             //DISTANCE_MOD_FAR_DIST
    "max_dist_mod",         //DISTANCE_MOD_FAR_MULT
    "min_range",            //MIN_RANGE
    "field232",             //NO_REMOVE
    "field233",             //SPELL_RECOURSE_TYPE
    "field234",             //ONLY_DURING_FAST_REGEN
    "field235",             //IS_BETA_ONLY
    "field236"              //SPELL_SUBGROUP
);
?>
