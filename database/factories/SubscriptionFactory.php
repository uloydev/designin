<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Subscription;
use Faker\Generator as Faker;

$factory->define(Subscription::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence,
        'desc' => '<p>Excalibur bluemarvel satana kang steverogers, husk cardiac? Crossbones ink toxin sunfire'.
                    'blastaar cypher blackbolt howlett blackcat chameleon ironpatriot! Celestials scrambler romulus'.
                    'hammer silversurfer dracula, changeling daredevil jimmywoo snowbird! Wildchild shaman, mordo.'.
                    'Quasimodo praxagora steverogers blonsky barnes fisk urich. Skreet skrulls, unus lizard tchalla'.
                    'caliban blob jarvis spider-woman ironpatriot. Puck rand howard johnnystorm chamber arcana'.
                    'squirrel-girl hepzibah. Sprite vision janefoster jimmywoo faustus snowbird, typhoidmary thanos.'.
                    'Cyclops punisher nomad, humantorch gambit scourge lightspeed firebird contessa tinkerer gamora'.
                    'stryker. Maelstrom barnes scrambler captainbritain blackwidow cardiac ironpatriot.'.
                    '</p>'.
                    '<p>Blink hyperion medusa abomb blastaar captainmarvel swordsman smasher x-factor. Scourge drax'.
                    'miek vision whiplash rand redskull ego wendigo octopus korvac psylocke. Atlas kaine blackwidow '.
                    'mauler redskull galactus. Dazzler daredevil maelstrom felicia scourge mysterio prism kanga'.
                    'unionjack madrox! Sprite unus toxin mistyknight jessicajones tombstone moleculeman spot'.
                    'barton. Sentry ricochet skrulls reaper aim kree namorita chimera nova blackknight polaris'.
                    'Macgargan valkyrie moltenman calypso scarletspider unionjack sabretooth onslaught. Firebrand'.
                    'electro rasputin moleman dracula, taskmaster longshot magneto braddock hepzibah. Spot redskull,'.
                    'celestials dormammu valkyrie bishop wendigo! Avengers.'.
                    '</p>'.
                    '<p>Penance wilsonfisk thor jackal mayparker gamora surge destiny sauron blackwidow hellcat?'.
                    'Mrfantastic kronos cypher tombstone zodiak colossus thor prodigy sprite blonsky macgargan '.
                    'purpleman smasher. Atlas hammer ronan boomerang darkstar korg chameleon satana blonsky proteus'.
                    'professorx skaar jackal? Moonknight pryde barnes feral! Goliath cannonball pyro changeling,'.
                    'wraith polaris mojo omega magus maelstrom pandemic? Blackbolt tusk, mystique sandman spider-ham'.
                    'parker moonknight puck magus. Spider-ham illuminati avalanche tonystark tigra piledriver penance'.
                    'piledriver komodo.'.
                    '</p>'.
                    '<p>Ilyana mimic wong barton empath omega jeangrey mrfantastic sasquatch mystique avengers x-51.'.
                    'Madrox suestorm sage ezekiel shadowcat? Powerman puck namora pandemic warbound spider-ham'.
                    'hammerhead doop. Uatu hellcat azazel diablo piledriver ricochet spider-woman alpha-flight'.
                    'grandmaster firebird madripoor husk ronan. Macgargan nickfury whiplash spyke thor johnnystorm'.
                    'mystique angela howlett. Moonstar hepzibah surge barnes, shiar.'.
                    '</p>'.
                    '<p>Havok mojo asgardian madthinker lionheart lockjaw stick. Stick hammer howlett cannonball!'.
                    'Bluemarvel scarletspider exodus electro tusk thanos eternals annihilus cerebro! Angela electro'.
                    'carnage tombstone korvac lionheart dagger satana blackheart. Brood forge feral unus angela hulk'.
                    'cyber felicia centurions. Hepzibah taskmaster ghostrider mystique braddock moonstone betaray'.
                    'grandmaster surge cuckoos riptide! Wiccan karnak sprite jackal blackbolt lockjaw mephisto batroc'.
                    'Taskmaster harrier antman empath spot lilith'.
                    '</p>',
        'img' => 'temporary/subscription.jpg',
        'token' => 10
    ];
});
