<?php

/** @var Factory $factory */

use App\Model;
use App\Subscription;
use Faker\Generator as Faker;
use Illuminate\Database\Eloquent\Factory;

$factory->define(Subscription::class, function (Faker $faker) {
    $subscribeName = ['Enterprise Pack', 'Discovery Pack', 'Start-up Pack'];
    return [
        'title' => $subscribeName[$faker->numberBetween(0, 2)],
        'desc' => '<p>Excalibur blue marvel satana kang steve rogers, husk cardiac? Crossbones ink toxin sunfire'.
                    'blastaar cypher black bolt howlett blackcat chameleon ironpatriot! Celestials scrambler romulus'.
                    'hammer silver surfer dracula, changeling daredevil jimmywoo snowbird! Wild child shaman, mordo.'.
                    'Quasimodo praxagora steve rogers blonsky barnes fisk urich. Skreet skrulls, unus lizard tchalla'.
                    'caliban blob jarvis spider-woman iron patriot. Puck rand howard johnnystorm chamber arcana'.
                    'squirrel-girl hepzibah. Sprite vision jane foster jimmywoo faustus snowbird, typhoidmary thanos.'.
                    'Cyclops punisher nomad, human torch gambit scourge lightspeed firebird contessa tinkerer gamora.'.
                    'stryker. Maelstrom barnes scrambler captain britain black widow cardiac iron patriot.'.
                    '</p>'.
                    '<p>Blink hyperion medusa abomb blastaar captain marvel swordsman smasher x-factor. Scourge drax'.
                    'miek vision whiplash rand redskull ego wendigo octopus korvac psylocke. Atlas kaine black widow '.
                    'mauler red skull galactus. Dazzler daredevil maelstrom felicia scourge mysterio prism kanga'.
                    'unionjack madrox! Sprite unus toxin mistyknight jessica jones tombstone moleculeman spot'.
                    'barton. Sentry ricochet skrulls reaper aim kree namorita chimera nova black knight polaris'.
                    'Macgargan valkyrie moltenman calypso scarlet spider unionjack sabretooth onslaught. Firebrand'.
                    'electro rasputin moleman dracula, taskmaster longshot magneto braddock hepzibah. Spot redskull,'.
                    'celestials dormammu valkyrie bishop wendigo! Avengers.'.
                    '</p>'.
                    '<p>Penance wilsonfisk thor jackal mayparker gamora surge destiny sauron black widow hellcat?'.
                    'Mrfantastic kronos cypher tombstone zodiak colossus thor prodigy sprite blonsky macgargan '.
                    'purpleman smasher. Atlas hammer ronan boomerang darkstar korg chameleon satana blonsky proteus'.
                    'professorx skaar jackal? Moonknight pryde barnes feral! Goliath cannonball pyro changeling,'.
                    'wraith polaris mojo omega magus maelstrom pandemic? Blac kbolt tusk, mystique sandman spider-ham.'.
                    'parker moonknight puck magus. Spider-ham illuminati avalanche tony stark tigra piledriver penance'.
                    'piledriver komodo.'.
                    '</p>'.
                    '<p>Ilyana mimic wong barton empath omega jeangrey mrfantastic sasquatch mystique avengers x-51.'.
                    'Madrox suestorm sage ezekiel shadowcat? Powerman puck namora pandemic warbound spider-ham'.
                    'hammerhead doop. Uatu hellcat azazel diablo piledriver ricochet spider-woman alpha-flight'.
                    'grandmaster firebird madripoor husk ronan. Macgargan nickfury whiplash spyke thor johnnystorm'.
                    'mystique angela howlett. Moonstar hepzibah surge barnes, shiar.'.
                    '</p>'.
                    '<p>Havok mojo asgardian madthinker lion heart lockjaw stick. Stick hammer howlett cannonball!'.
                    'Blue marvel scarletspider exodus electro tusk thanos eternals annihilus cerebro! Angela electro'.
                    'carnage tombstone korvac lionheart dagger satana black heart. Brood forge feral unus angela hulk'.
                    'cyber felicia centurions. Hepzibah taskmaster ghost rider mystique braddock moonstone betaray'.
                    'grand master surge cuckoos riptide! Wiccan karnak sprite jackal black bolt lockjaw mephisto batroc'.
                    'Taskmaster harrier ant man empath spot lilith'.
                    '</p>',
        'img' => $faker->randomElement(['files/discovery.webp', 'files/startup.webp', 'files/enterprise.webp']),
        'token' => $faker->numberBetween($min = 20, $max = 40),
        'price' => $faker->randomElement([450000, 1050000, 3600000]),
        'duration' => $faker->randomElement([7, 30]),
    ];
});
