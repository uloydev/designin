<?php

use Illuminate\Database\Seeder;
use App\Service;
use Faker\Factory as Faker;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($service = 1; $service <= 30; $service++) {
            $faker = Faker::create('id_ID');
            DB::table('service')->insert([

        		'title' => 'Desain ' . $faker->sentence($nbWords = 10, $variableNbWords = true),
        		'description' => '<h1>Tollenda est atque extrahenda radicitus.</h1>

                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Negat enim summo bono afferre incrementum
                    diem. Nisi enim id faceret, cur Plato Aegyptum peragravit, ut a sacerdotibus barbaris numeros et
                    caelestia acciperet? <a href="http://loripsum.net/" target="_blank">At hoc in eo M.</a> Quod etsi
                    ingeniis magnis praediti quidam dicendi copiam sine ratione consequuntur, ars tamen est dux certior
                    quam natura. Mihi quidem Homerus huius modi quiddam vidisse videatur in iis, quae de Sirenum cantibus
                    finxerit. Sic exclusis sententiis reliquorum cum praeterea nulla esse possit, haec antiquorum valeat
                    necesse est. <a href="http://loripsum.net/" target="_blank">Hoc simile tandem est?</a>
                    Duo Reges: constructio interrete. Gerendus est mos, modo recte sentiat. Itaque a sapientia praecipitur
                    se ipsam, si usus sit, sapiens ut relinquat. </p>

                    <p>Quam multa vitiosa! summum enim bonum et malum vagiens puer utra voluptate diiudicabit, stante an
                    movente? Itaque ne iustitiam quidem recte quis dixerit per se ipsam optabilem, sed quia iucunditatis
                    vel plurimum afferat. Hoc ille tuus non vult omnibusque ex rebus voluptatem quasi mercedem exigit.
                    Nam quod ait sensibus ipsis iudicari voluptatem bonum esse, dolorem malum, plus tribuit sensibus,
                    quam nobis leges permittunt, cum privatarum litium iudices sumus.
                    <i>Sed fac ista esse non inportuna;</i> Chrysippus autem exponens differentias animantium ait alias
                    earum corpore excellere, alias autem animo, non nullas valere utraque re; </p>

                    <p>At tu eadem ista dic in iudicio aut, si coronam times, dic in senatu. Partim cursu et peragratione
                    laetantur, congregatione aliae coetum quodam modo civitatis imitantur; Quae enim dici Latine posse non
                    arbitrabar, ea dicta sunt a te verbis aptis nec minus plane quam dicuntur a Graecis.
                    <a href="http://loripsum.net/" target="_blank">Haec para/doca illi, nos admirabilia dicamus.</a>
                    Ita multo sanguine profuso in laetitia et in victoria est mortuus. At enim iam dicitis virtutem non
                    posse constitui, si ea, quae extra virtutem sint, ad beate vivendum pertineant. Videamus animi partes,
                    quarum est conspectus illustrior; Quo plebiscito decreta a senatu est consuli quaestio Cn. Quid, si
                    reviviscant Platonis illi et deinceps qui eorum auditores fuerunt, et tecum ita loquantur? Hoc ne
                     statuam quidem dicturam pater aiebat, si loqui posset. <i>Quis negat?</i> Re mihi non aeque
                     satisfacit, et quidem locis pluribus. </p>

                    <ul>
                        <li>Quamquam te quidem video minime esse deterritum.</li>
                        <li>Ea, quae dialectici nunc tradunt et docent, nonne ab illis instituta sunt aut inventa sunt?</li>
                        <li>Id enim volumus, id contendimus, ut officii fructus sit ipsum officium.</li>
                        <li>An ea, quae per vinitorem antea consequebatur, per se ipsa curabit?</li>
                        <li>Audax negotium, dicerem impudens, nisi hoc institutum postea translatum ad philosophos nostros
                        esset.</li>
                        <li>Illud mihi a te nimium festinanter dictum videtur, sapientis omnis esse semper beatos;</li>
                    </ul>',
                'image' => 'public/temporary/stories.jpeg',
        		'agent_id' => $faker->unique()->numberBetween(2, 3),
        		'service_category_id' => $faker->numberBetween(1, 6)
           	]);
        }
    }
}
