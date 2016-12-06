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
    50   => "72000 (5 Days)",
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
   -1  => "None",
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
    20 => "Targeted AE, Tap",
    24 => "AE Undead",
    25 => "AE Summoned",
    32 => "AE Caster2",
    33 => "NPC Hatelist",
    34 => "Dungeon Object",
    35 => "Muramite",
    36 => "Area - PC Only",
    37 => "Area - NPC Only",
    38 => "Summoned Pet",
    39 => "Group No Pets",
    40 => "AE PC v2",
    41 => "Group v2",
    42 => "Self (Directional)",
    43 => "Group With Pets",
    44 => "Beam"
);

$sp_npccats = array(
    0 => "Not Applicable (Non NPC Spell)",
    1 => "AoE Detrimental",
    2 => "Single Target Detrimental",
    3 => "Buffs",
    4 => "Pet Spells",
    5 => "Healing Spells",
    6 => "Gate or last cast",
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
    10   => "Targeted Ae Dmg",
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
    101  => "Snare [single]",
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
    36 => "Piercing",
    37 => "Riposte",
    38 => "Round Kick",
    39 => "Safe Fall",
    40 => "Sense Heading",
    41 => "Sing",
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
    75 => "Unknown75",
    76 => "Unknown76",
    77 => "Unknown77",
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
    98 => "Unknown98"
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
    9 => "Unknown"
);

$sp_effects = array(
    0   => "HP",
    1   => "AC",
    2   => "Attack Power",
    3   => "Movement Rate",
    4   => "STR",
    5   => "DEX",
    6   => "AGI",
    7   => "STA",
    8   => "INT",
    9   => "WIS",
    10  => "CHA",
    11  => "Melee Speed",
    12  => "Invisibility",
    13  => "See Invis",
    14  => "Enduring Breath",
    15  => "Mana",
    16  => "NPC Frenzy",
    17  => "NPC Awareness",
    18  => "NPC Aggro",
    19  => "NPC Faction",
    20  => "Blindness",
    21  => "Stun",
    22  => "Charm",
    23  => "Fear",
    24  => "Fatigue",
    25  => "Bind Affinity",
    26  => "Gate",
    27  => "Dispel Magic",
    28  => "Invis vs Undead",
    29  => "Invis vs Animals",
    30  => "NPC React Range",
    31  => "Enthrall (Mez)",
    32  => "Create Item",
    33  => "Spawn NPC",
    34  => "Confuse",
    35  => "Disease",
    36  => "Poison",
    37  => "Detect Hostile",
    38  => "Detect Magic",
    39  => "Detect Poison",
    40  => "Invulnerability",
    41  => "Banish",
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
    52  => "Detect Undead",
    53  => "Detect Summoned",
    54  => "Detect Animals",
    55  => "Stoneskin",
    56  => "True North",
    57  => "Levitation",
    58  => "Change Form",
    59  => "Reflect Damage",
    60  => "Transfer Item",
    61  => "Identify",
    62  => "Item ID",
    63  => "NPC Wipe Hate List",
    64  => "Spin Stun",
    65  => "Infravision",
    66  => "Ultravision",
    67  => "NPC POV",
    68  => "Reclaim Energy",
    69  => "Max HP",
    70  => "Corpse Bomb",
    71  => "Create Undead",
    72  => "Preserve Corpse",
    73  => "Targets View",
    74  => "Feign Death",
    75  => "Ventriloquism",
    76  => "Sentinel",
    77  => "Locate Corpse",
    78  => "Spell Shield",
    79  => "Instant HP",
    80  => "Enchant: Light",
    81  => "Resurrect",
    82  => "Summon Player",
    83  => "Portal",
    84  => "HP NPC Only",
    85  => "Contact Ability",
    86  => "NPC Help Radius",
    87  => "Telescope",
    88  => "Combat Portal",
    89  => "Height",
    90  => "Ignore Pet",
    91  => "Summon Corpse",
    92  => "Instant Hate",
    93  => "Weather Control",
    94  => "Fragile",
    95  => "Sacrifice",
    96  => "Silence",
    97  => "Max Mana",
    98  => "Bard Haste",
    99  => "Root",
    100 => "DoT Heals",
    101 => "Complete Heal",
    102 => "Pet No Fear",
    103 => "Summon Pet",
    104 => "Translocate",
    105 => "Anti-Gate",
    106 => "Beastlord Pet",
    107 => "Alter NPC Level",
    108 => "Familiar",
    109 => "Create Item In Bag",
    110 => "Increase Archery",
    111 => "Resistances",
    112 => "Set Casting Level",
    113 => "Summon Mount",
    114 => "Modify Hate",
    115 => "Cornucopia",
    116 => "Curse",
    117 => "Hit Magic",
    118 => "Amplification",
    119 => "Bard Haste 2",
    120 => "Heal Mod",
    121 => "Iron Maiden",
    122 => "Reduce Skill",
    123 => "Immunity",
    124 => "Focus Damage Percent",
    125 => "Focus Heal Mod",
    126 => "Focus Resist Mod",
    127 => "Focus Cast Time Mod",
    128 => "Focus Duration Mod",
    129 => "Focus Range Mod",
    130 => "Focus Hate Mod",
    131 => "Focus Reagent Mod",
    132 => "Focus Mana Mod",
    133 => "Focus Stun Time Mod",
    134 => "Limit: Level Max",
    135 => "Limit: Resist Type",
    136 => "Limit: Target Type",
    137 => "Limit: Which Spell Effect",
    138 => "Limit: Beneficial",
    139 => "Limit: Which Spell ID",
    140 => "Limit: Duration Min",
    141 => "Limit: Instant Only",
    142 => "Limit: Level Min",
    143 => "Limit: Cast Time Min",
    144 => "Limit: Cast Time Max",
    145 => "NPC Warder Banish",
    146 => "Resist Electricity",
    147 => "Percent Heal",
    148 => "Stacking Blocker",
    149 => "Strip Virtual Slot",
    150 => "Death Pact",
    151 => "Pocket Pet",
    152 => "Pet Swarm",
    153 => "Damage Balance",
    154 => "Cancel Negative",
    155 => "PoP Resurrect",
    156 => "Mirror",
    157 => "Feedback",
    158 => "Reflect",
    159 => "Mod All Stats",
    160 => "Sobriety",
    161 => "Spell Guard",
    162 => "Melee Guard",
    163 => "Absorb Hit",
    164 => "Object - Sense Trap",
    165 => "Object - Disarm Trap",
    166 => "Object - Picklock",
    167 => "Focus Pet Power",
    168 => "Defensive",
    169 => "Critical Melee",
    170 => "Critical Spell",
    171 => "Crippling Blow",
    172 => "Evasion",
    173 => "Riposte",
    174 => "Dodge",
    175 => "Parry",
    176 => "Dual Wield",
    177 => "Double Attack",
    178 => "Melee Lifetap",
    179 => "Puretone",
    180 => "Sanctification",
    181 => "Fearless",
    182 => "Hundred Hands",
    183 => "Skill Increase Chance",
    184 => "Accuracy Percent",
    185 => "Skill Damage Mod",
    186 => "Min Damage Done Mod",
    187 => "Mana Balance",
    188 => "Block",
    189 => "Endurance",
    190 => "Max Endurance",
    191 => "Amnesia",
    192 => "Hate",
    193 => "Skill Attack",
    194 => "Fade",
    195 => "Stun Resist",
    196 => "Strikethrough",
    197 => "Skill Damage Taken",
    198 => "Instant Endurance",
    199 => "Taunt",
    200 => "Proc Chance",
    201 => "Ranged Proc",
    202 => "Illusion Other",
    203 => "Mass Buff",
    204 => "Group Fear Immunity",
    205 => "Rampage",
    206 => "AE Taunt",
    207 => "Flesh to Bone",
    208 => "Purge Poison",
    209 => "Cancel Beneficial",
    210 => "Pet Shield",
    211 => "AE Melee",
    212 => "Frenzied Devastation",
    213 => "Pet Percent HP",
    214 => "HP Max Percent",
    216 => "Accuracy Amount",
    218 => "Pet Crit Melee",
    219 => "Slay Undead",
    220 => "Skill Damage Amount",
    221 => "Reduce Weight",
    222 => "Block Behind",
    223 => "Double Riposte",
    224 => "Add Riposte",
    225 => "Give Double Attack",
    226 => "2H Bash",
    227 => "Reduce Skill Timer",
    228 => "Reduce Fall Damage",
    229 => "Cast Through Stun",
    230 => "Increase Shield Dist",
    231 => "Stun Bash Chance",
    232 => "Divine Save",
    233 => "Metabolism",
    234 => "Poison Mastery",
    235 => "Focus Channeling",
    236 => "Free Pet",
    237 => "Pet Affinity",
    238 => "Permanent Illusion",
    239 => "Stonewall",
    240 => "String Unbreakable",
    241 => "Improve Reclaim Energy",
    242 => "Increase Chance Memwipe",
    243 => "No Break Charm Chance",
    244 => "Root Break Chance",
    245 => "Trap Circumvention",
    246 => "Lung Capacity",
    247 => "Increase Skill Cap",
    248 => "Extra Specialization",
    249 => "Offhand Min",
    250 => "Spell Proc Chance",
    251 => "Endless Quiver",
    252 => "Backstab Front",
    253 => "Chaotic Stab",
    254 => "No Spell",
    255 => "Shielding Duration Mod",
    256 => "Shroud of Stealth",
    257 => "Give Pet Hold",
    258 => "Triple Backstab",
    259 => "AC Limit Mod",
    260 => "Add Instrument Mod",
    261 => "Song Mod Cap",
    262 => "Stats Cap",
    263 => "Tradeskill Masteries",
    264 => "Reduce AA Timer",
    265 => "No Fizzle",
    266 => "Add Extra Attack Chance (2H)",
    267 => "Add Pet Commands",
    268 => "Alchemy Fail Rate",
    269 => "Bandage Percent Limit",
    270 => "Bard Song Range",
    271 => "Base Run Mod",
    272 => "Casting Level",
    273 => "Critical DoT",
    274 => "Critical Heal",
    275 => "Critical Mend",
    276 => "Dual Wield Amount",
    277 => "Extra DI Chance",
    278 => "Finishing Blow",
    279 => "Flurry Chance",
    280 => "Pet Flurry Chance",
    281 => "Give Pet Feign",
    282 => "Increase Bandage Amount",
    283 => "Special Attack Chain",
    284 => "LoH Set Heal",
    285 => "No Move Check Sneak",
    286 => "Focus Damage Amount",
    287 => "Focus Duration Mod (static)",
    288 => "Add Proc Hit",
    289 => "Improved Spell Effect",
    290 => "Increase Movement Cap",
    291 => "Purify",
    292 => "Strikethrough 2",
    293 => "Stun Resist 2",
    294 => "Spell Crit Chance",
    295 => "Reduce Timer Special",
    296 => "Focus Damage Percent Incoming",
    297 => "Focus Damage Amount Incoming",
    298 => "Height (Small)",
    299 => "Wake the Dead",
    300 => "Doppelganger",
    301 => "Increase Range Damage",
    302 => "Focus Damage Percent Crit",
    303 => "Focus Damage Amount Crit",
    304 => "Secondary Riposte Mod",
    305 => "Mitigate Damage Shield",
    306 => "Wake the Dead 2",
    307 => "Appraisal",
    308 => "Zone Suspend Minion",
    309 => "Gate Casters Bindpoint",
    310 => "Focus Reuse Timer",
    311 => "Limit: Combat Skill",
    312 => "Observer",
    313 => "Forage Master",
    314 => "Improved Invis",
    315 => "Improved Invis Undead",
    316 => "Improved Invis Animals",
    317 => "Worn Regen Cap",
    318 => "Worn Mana Cap",
    319 => "Critical HP Regen",
    320 => "Shield Block Chance",
    321 => "Reduce Target Hate",
    322 => "Gate Starting City",
    323 => "Defensive Proc",
    324 => "HP for Mana",
    325 => "No Break AE Sneak",
    326 => "Spell Slots",
    327 => "Buff Slots",
    328 => "Negative HP Limit",
    329 => "Mana Absorb Percent Damage",
    330 => "Critical Melee Damage Mod",
    331 => "Alchemy Item Recovery",
    332 => "Summon to Corpse",
    333 => "Doom Rune Effect",
    334 => "HP No Move",
    335 => "Focus Immunity Focus",
    336 => "Illusionary Target",
    337 => "Increase Exp Percent",
    338 => "Expedient Recovery",
    339 => "Focus Cast Proc",
    340 => "Chance Spell",
    341 => "Worn Attack Cap",
    342 => "No Panic",
    343 => "Spell Interrupt",
    344 => "Item Channeling",
    345 => "Assassinate Max",
    346 => "Headshot Max",
    347 => "Double Ranged Attack",
    348 => "Limit: Mana Min",
    349 => "Increase Damage with Shield",
    350 => "Manaburn",
    351 => "Spawn Interactive Object",
    352 => "Increase Trap Count",
    353 => "Increase SOI Count",
    354 => "Deactivate All Traps",
    355 => "Learn Trap",
    356 => "Change Trigger Type",
    357 => "Focus Mute",
    358 => "Instant Mana",
    359 => "Passive Sense Trap",
    360 => "Proc on Kill Shot",
    361 => "Proc on Death",
    362 => "Potion Belt",
    363 => "Bandolier",
    364 => "Add Triple Attack Chance",
    365 => "Proc on Spell Kill Shot",
    366 => "Group Shielding",
    367 => "Modify Body Type",
    368 => "Modify Faction",
    369 => "Corruption",
    370 => "Resist Corruption",
    371 => "Slow",
    372 => "Grant Foraging",
    373 => "Doom Always",
    374 => "Trigger Spell",
    375 => "Critical DoT Damage Mod",
    376 => "Fling",
    377 => "Doom Entity",
    378 => "Resist Other Spell Effect",
    379 => "Directional Shadow Step",
    380 => "Knockback Explosive",
    381 => "Fling to Self",
    382 => "Suppression",
    383 => "Focus Cast Proc Normalized",
    384 => "Fling to Target",
    385 => "Limit: Which Spell Group",
    386 => "Doom Dispeller",
    387 => "Doom Dispellee",
    388 => "Summon All Corpses",
    389 => "Focus Timer Refresh",
    390 => "Focus Timer Lockout",
    391 => "Limit: Mana Max",
    392 => "Focus Heal Amt",
    393 => "Focus Heal Percent Incoming",
    394 => "Focus Heal Amt Incoming",
    395 => "Focus Heal Percent Crit",
    396 => "Focus Heal Amt Crit",
    397 => "Pet Amt Mitigation",
    398 => "Focus Swarm Pet Duration",
    399 => "Focus Twincast",
    400 => "Healburn",
    401 => "Mana Ignite",
    402 => "Endurance Ignite",
    403 => "Limit: Spell Class",
    404 => "Limit: Spell Subclass",
    405 => "Staff Block Chance",
    406 => "Doom Limit Use",
    407 => "Doom Focus Used",
    408 => "Limit HP",
    409 => "Limit Mana",
    410 => "Limit Endurance",
    411 => "Limit: Class Player",
    412 => "Limit: Race",
    413 => "Focus Base Effects",
    414 => "Limit: Casting Skill",
    415 => "Limit: Item Class",
    416 => "AC 2",
    417 => "Mana 2",
    418 => "Increased Skill Damage 2",
    419 => "Contact Ability 2",
    420 => "Focus Limit Use",
    421 => "Focus Limit Use Amt",
    422 => "Limit: Limit Use Min",
    423 => "Limit: Limit Use Type",
    424 => "Gravitate",
    425 => "Fly",
    426 => "Add Ext Target Slots",
    427 => "Skill Proc",
    428 => "Skill Proc Modifier",
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
    440 => "Finishing Blow Max",
    441 => "Distance Removal",
    442 => "Doom Req Target",
    443 => "Doom Req Caster",
    444 => "Improved Taunt",
    445 => "Add Merc Slot",
    446 => "A Stacker",
    447 => "B Stacker",
    448 => "C Stacker",
    449 => "D Stacker",
    450 => "DoT Guard",
    451 => "Melee Threshold Guard",
    452 => "Spell Threshold Guard",
    453 => "Doom Melee Threshold",
    454 => "Doom Spell Threshold",
    455 => "Add Hate Percent",
    456 => "Add Hate Over Time Percent",
    457 => "Resource Tap",
    458 => "Faction Mod Percent",
    459 => "Damage Modifier 2",
    460 => "FF Override",
    461 => "Improved Damage 2",
    462 => "FC Damage Amount 2",
    463 => "Shield Target",
    464 => "Player Pet Rampage",
    465 => "Player Pet AE Rampage",
    466 => "Player Pet Flurry Chance",
    467 => "DS Mitigation Amount",
    468 => "DS Mitigation Percent",
    469 => "Chance Best in Spell Group",
    470 => "Trigger Best in Spell Group",
    471 => "Double Melee Round"
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
    "field181",             //PVP_DURATION
    "field182",             //PVP_DURATION_CAP
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
