<?php

use App\User;
use App\Video;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SeedData extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Departments
        $department1 = new \App\Department([
            "name" => "Software",
            "order" => 1
        ]);
        $department1->save();
        $department2 = new \App\Department([
            "name" => "Hardware",
            "order" => 2
        ]);
        $department2->save();
        $department3 = new \App\Department([
            "name" => "Human resources",
            "order" => 3
        ]);
        $department3->save();
        $department4 = new \App\Department([
            "name" => "Management",
            "order" => 4
        ]);
        $department4->save();

        // Users
        $usersInfo = [
            [
                'name' => "Josep Ruiz",
                'sub_auth0' => "josep-ruiz",
                'picture' => "/img/estudy/josep_ruiz.jpg",
            ],
            [
                'name' => "Jandro Mendez",
                'sub_auth0' => "jandro-mendez",
                'picture' => "/img/estudy/jandro_mendez.jpg",
            ],
            [
                'name' => "Andreu Ramon",
                'sub_auth0' => "andreu-ramon",
                'picture' => "/img/estudy/andreu_ramon.jpg",
            ],
            [
                'name' => "Bruno Lopez",
                'sub_auth0' => "bruno-lopez",
                'picture' => "/img/estudy/bruno_lopez.jpg",
            ],
            [
                'name' => "Victor Aguiular",
                'sub_auth0' => "victor-aguilar",
                'picture' => "/img/estudy/victor_aguilar.jpg",
            ],
            [
                'name' => "Carla García",
                'sub_auth0' => "carla-garcia",
                'picture' => "/img/estudy/carla_garcia.jpg",
            ],
            [
                'name' => "Carlos Fernández",
                'sub_auth0' => "carlos-fernandez",
                'picture' => "/img/estudy/carlos_fernandez.jpg",
            ],
            [
                'name' => "Antoni Sardà",
                'sub_auth0' => "antoni-sarda",
                'picture' => "/img/estudy/antoni_sarda.jpg",
            ],
            [
                'name' => "Natàlia Rius",
                'sub_auth0' => "natalia-rius",
                'picture' => "/img/estudy/natalia_rius.jpg",
            ],
            [
                'name' => "Daniel Martínez",
                'sub_auth0' => "dnaiel-martinez",
                'picture' => "/img/estudy/daniel_martinez.jpg",
            ],
            [
                'name' => "Laia Melero",
                'sub_auth0' => "laia-melero",
                'picture' => "/img/estudy/laia_melero.jpg",
            ],
            [
                'name' => "Ramon Ferrol",
                'sub_auth0' => "ramon-ferrol",
                'picture' => "/img/estudy/ramon_ferrol.jpg",
            ],
            [
                'name' => "Jordi Sánchez",
                'sub_auth0' => "jordi-sanchez",
                'picture' => "/img/estudy/jordi_sanchez.jpg",
            ],
            [
                'name' => "Gerard Gallego",
                'sub_auth0' => "gerard.gallego",
                'picture' => "/img/estudy/gerard_gallego.jpg",
            ],
            [
                'name' => "Joel Romero",
                'sub_auth0' => "joel-romero",
                'picture' => "/img/estudy/joel_romero.jpg",
            ],
            [
                'name' => "Ramon Rovira",
                'sub_auth0' => "ramon-rovira",
                'picture' => "/img/estudy/ramon_rovira.jpg",
            ],
            [
                'name' => "Alfons Menéndez",
                'sub_auth0' => "alfons-menendez",
                'picture' => "/img/estudy/alfons_menendez.jpg",
            ],
            [
                'name' => "Laura Rovira",
                'sub_auth0' => "laura-rovira",
                'picture' => "/img/estudy/laura_rovira.jpg",
            ],
            [
                'name' => "Judith Pérez",
                'sub_auth0' => "judith-perez",
                'picture' => "/img/estudy/judith_perez.jpg",
            ],
            [
                'name' => "Maria Pie",
                'sub_auth0' => "maria-pie",
                'picture' => "/img/estudy/marta_pie.jpg",
            ],
            [
                'name' => "Marc Rossi",
                'sub_auth0' => "marc-rossi",
                'picture' => "/img/estudy/marc_rossi.jpg",
            ],
            [
                'name' => "Carles Castells",
                'sub_auth0' => "carles-castells",
                'picture' => "/img/estudy/carles_castells.jpg",
            ],
            [
                'name' => "Maria Marín",
                'sub_auth0' => "maria-marin",
                'picture' => "/img/estudy/maria_marin.jpg",
            ],
            [
                'name' => "Esther Maestro",
                'sub_auth0' => "esther-maestro",
                'picture' => "/img/estudy/esther_maestro.jpg",
            ],
            [
                'name' => "Pau Nonell",
                'sub_auth0' => "pau-nonell",
                'picture' => "/img/estudy/pau_nonell.jpg",
            ],
            [
                'name' => "Jordi Mateu",
                'sub_auth0' => "jordi-mateu",
                'picture' => "/img/estudy/jordi_mateu.jpg",
            ],
            [
                'name' => "Martí Fernàndez",
                'sub_auth0' => "marti-fernandez",
                'picture' => "/img/estudy/marti_fernandez.jpg",
            ],
            [
                'name' => "Pol Monge",
                'sub_auth0' => "pol-monge",
                'picture' => "/img/estudy/pol_monge.jpg",
            ],
            [
                'name' => "Rafa Caro",
                'sub_auth0' => "rafa-caro",
                'picture' => "/img/estudy/rafa_caro.jpg",
            ],
            [
                'name' => "Roberto Jimenez",
                'sub_auth0' => "roberto-jimenez",
                'picture' => "/img/estudy/roberto_jimenez.jpg",
            ],
            [
                'name' => "Marina Costa",
                'sub_auth0' => "marina-costa",
                'picture' => "/img/estudy/marina_costa.jpg",
            ],
            [
                'name' => "Salvador Sants",
                'sub_auth0' => "salvador-sants",
                'picture' => "/img/estudy/salvador_sants.jpg",
            ],
            [
                'name' => "Sergio Javier",
                'sub_auth0' => "sergio-javier",
                'picture' => "/img/estudy/sergio_javier.jpg",
            ],
            [
                'name' => "Anna Prieto",
                'sub_auth0' => "anna-prieto",
                'picture' => "/img/estudy/anna_prieto.jpg",
            ],
            [
                'name' => "Ramón Cáceres",
                'sub_auth0' => "ramon-caceres",
                'picture' => "/img/estudy/ramon_caceres.jpg",
            ],
            [
                'name' => "Ernesto Sevilla",
                'sub_auth0' => "ernesto-sevilla",
                'picture' => "/img/estudy/ernesto_sevilla.jpg",
            ],
        ];
        shuffle($usersInfo);

        $users = array();
        $length = count($usersInfo);
        for ($i = 0; $i < $length; $i++) {
            // $i: 0-35
            $user = new User([
                'name' => $usersInfo[$i]['name'],
                'sub_auth0' => $usersInfo[$i]['sub_auth0'],
                'picture' => $usersInfo[$i]['picture'],
            ]);
            if ($i >= 0 && $i <= 8) {
                $user->department()->associate($department1);
            }
            else if ($i >= 9 && $i <= 17) {
                $user->department()->associate($department2);
            }
            else if ($i >= 18 && $i <= 26) {
                $user->department()->associate($department3);
            }
            else if ($i >= 27 && $i <= 35) {
                $user->department()->associate($department4);
            }
            $user->save();
            array_push($users, $user);
        }

        // Categories
        $categoryTechnology = new \App\Category([
            'title' => "Technology",
            "id" => "technology",
            'order' => 1
        ]);
        $categoryTechnology->save();
        $categoryBiology = new \App\Category([
            'title' => "Biology",
            "id" => "biology",
            'order' => 2
        ]);
        $categoryBiology->save();
        $categorySociology = new \App\Category([
            'title' => "Sociology",
            "id" => "sociology",
            'order' => 3
        ]);
        $categorySociology->save();
        $categoryGraphicDesign = new \App\Category([
            'title' => "Graphic design",
            "id" => "graphic_design",
            'order' => 4
        ]);
        $categoryGraphicDesign->save();

        // Videos
        $videosCategoryTechnologyInfo = [
            [
                "description" => 'How are batteries made and how they work?',
                "id" => 'tech_0',
                "name" => 'Bateries',
                "author" => 'How its made',
                "date" => '09/05/2015',
                "duration" => '5:03',
                "source" => 'https://www.dropbox.com/s/p2yl8an601cn150/Bateries-Tech.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/ajuauuqvgwyuft7/bateries.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 3.99,
                "business_price" => 14.50
            ],
            [
                "description" => 'China has a saying; to see the past, visit Beijing, to see the present, go to Shanghai but for the future, it’s Shenzhen.',
                "id" => 'tech_1',
                "name" => 'Shenzhen: The city of the future',
                "author" => 'RT Documentary',
                "date" => '08/07/2017',
                "duration" => '25:54',
                "source" => 'https://www.dropbox.com/s/8tnqxv51e0zadnl/Shenzhen-Tech.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/bs0g7we0oh83izc/shenzhen.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 2.99,
                "business_price" => 14.50
            ],
            [
                "description" => 'People in green screen suits, monsters that arent actually there and much more. Come behind the scenes and take a look what really went on in the making of "Fantastic Beasts and Where to Find Them".',
                "id" => 'tech_2',
                "name" => 'Special Effects on Fantastic Beasts',
                "author" => 'Fame Focus',
                "date" => '19/12/2018',
                "duration" => '09:00',
                "source" => 'https://www.dropbox.com/s/vtl4zxxm0gw667c/SpecialEffects-Tech.mp4?dl=1',
                "photo_urls_size" => '240x180',
    	        "photo_urls_url" => 'https://www.dropbox.com/s/sosbye0jtq7rm3f/specialeffects.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 1.99,
                "business_price" => 9.50
            ],
            [
                "description" => 'Artificial Intelligence: Mankinds Last Invention - Technological Singularity Explained',
                "id" => 'tech_3',
                "name" => 'Artificial Intelligence',
                "author" => 'Aperture',
                "date" => '05/10/2018',
                "duration" => '20:21',
                "source" => 'https://www.dropbox.com/s/8y4rx6y84gtil9n/AI-Tech.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/asb1ldo6mq7k7ew/ai.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 3.50,
                "business_price" => 18.50
            ],
            [
                "description" => 'What is a blockchain and how do they work? I\'ll explain why blockchains are so special in simple and plain English!',
                "id" => 'tech_4',
                "name" => 'Blockchain',
                "author" => 'Simply Explained - Savjee',
                "date" => '13/11/2017',
                "duration" => '05:59',
                "source" => 'https://www.dropbox.com/s/rs0z1x39is9kqyo/BlockChain-Tech.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/yb6asrglrikra2p/blockchain.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 4.50,
                "business_price" => 21.50
            ],
            [
                "description" => 'A complete Guide to setup and install Raspberry Pi 3 Model B as Gaming, Multimedia, Hacking and as a coding device. All you need to know is mentioned in the video, How to get started, How to assemble and how to make it run.',
                "id" => 'tech_5',
                "name" => 'Raspberry',
                "author" => 'Trick i Know',
                "date" => '08/01/2018',
                "duration" => '26:13',
                "source" => 'https://www.dropbox.com/s/50co0j11jfulr70/Raspberry-Tech.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/k0qxb4hhcfzs0fh/raspberry.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 3.50,
                "business_price" => 19.50
            ],
            [
                "description" => 'How networks grew from small groups of connected computers on LAN networks to eventually larger worldwide networks like the ARPANET and even the Internet we know today.',
                "id" => 'tech_6',
                "name" => 'Computer Networks',
                "author" => 'Crash course',
                "date" => '13/11/2017',
                "duration" => '12:19',
                "source" => 'https://www.dropbox.com/s/665rzab3myjgfmw/Network-Tech.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/5bz3o5mye8uyv4c/networks.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 2.50,
                "business_price" => 15.50
            ],
        ];
        $videosCategoryBiologyInfo = [
            [
                "description" => 'Hank explains the extremely complex series of reactions whereby plants feed themselves on sunlight, carbon dioxide and water, and also create some by products we re pretty fond of as well.',
                "id" => 'bio_0',
                "name" => 'Photosynthesis',
                "author" => 'CrashCourse',
                "date" => '19/03/2012',
                "duration" => '13:14',
                "source" => 'https://www.dropbox.com/s/3udfzjsran8cymh/Photosynthesis-Bio.mp4?dl=1',
                "photo_urls_size" => '240x180',
    	    	"photo_urls_url" => 'https://www.dropbox.com/s/y1qyh3rmu94h0t0/photosynthesis.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 4.50,
                "business_price" => 20.99
            ],
            [
                "description" => 'An exploration of the structure of deoxyribonucleic acid, or DNA. ',
                "id" => 'bio_1',
                "name" => 'DNA',
                "author" => 'MITx Bio',
                "date" => '26/05/2015',
                "duration" => '5:58',
                "source" => 'https://www.dropbox.com/s/p5hxahi4sehaljs/DNA-Bio.mp4?dl=1',
                "photo_urls_size" => '240x180',
    	    	"photo_urls_url" => 'https://www.dropbox.com/s/mob1ebr68vx53jf/dna.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 1.50,
                "business_price" => 5.99
            ],
            [
                "description" => 'An animation/video teaching the basics of how cancer forms and spreads.  Topics include: mutation, tumor suppressors, oncogenes, angiogenesis, apoptosis, metastasis and drug resistance.  ',
                "id" => 'bio_2',
                "name" => 'Cancer',
                "author" => 'CancerQuest',
                "date" => '02/10/2013',
                "duration" => '12:07',
                "source" => 'https://www.dropbox.com/s/okrx0xjo9n7zxwt/Cancer-Bio.mp4?dl=1',
                "photo_urls_size" => '240x180',
    	    	"photo_urls_url" => 'https://www.dropbox.com/s/0c45f7wzcf5vvum/cancer.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 2.50,
                "business_price" => 7.99
            ],
            [
                "description" => 'In which Hank does some push ups for science and describes the "economy" of cellular respiration and the various processes whereby our bodies create energy in the form of ATP.',
                "id" => 'bio_3',
                "name" => 'ATP & Respiration',
                "author" => 'CrashCourse',
                "date" => '12/03/2012',
                "duration" => '13:25',
                "source" => 'https://www.dropbox.com/s/xdphjb1gpypo4jb/ATP-Bio.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/yqdi3bvffsbgsfl/atp.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 3.50,
                "business_price" => 16.99
            ],
            [
                "description" => 'There are two main types of diabetes, known as Type 1 and Type 2. Both types of diabetes are lifelong health conditions. There are 4.05 million people diagnosed with diabetes in the UK and an estimated 549,000 people who have the condition but don\'t know it.',
                "id" => 'bio_4',
                "name" => 'Diabetes',
                "author" => 'Diabetes UK',
                "date" => '03/11/2013',
                "duration" => '08:44',
                "source" => 'https://www.dropbox.com/s/rlj58rezw3noiw9/Diabetes-Bio.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/ukfbqhmytymrd66/diabates.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 4.77,
                "business_price" => 27.77
            ],
            [
                "description" => 'Osmosis of water (or any solvent) from area of lower solute concentration to areas of higher solute concentration through a semipermeable membrane.',
                "id" => 'bio_5',
                "name" => 'Osmosis',
                "author" => 'Khan Academy',
                "date" => '30/07/2015',
                "duration" => '08:03',
                "source" => 'https://www.dropbox.com/s/cswa7ohf20yy3ba/Osmosis-Bio.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/3lfb2813ykc7tnw/osmosis.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 1.27,
                "business_price" => 10.55
            ],
            [
                "description" => 'This animation by Nucleus shows you the function of plant and animal cells for middle school and high school biology, including organelles like the nucleus, nucleolus, DNA (chromosomes), ribosomes, mitochondria, etc.',
                "id" => 'bio_6',
                "name" => 'Cell Structure',
                "author" => 'Nucleus Medical Media',
                "date" => '18/03/2015',
                "duration" => '07:21',
                "source" => 'https://www.dropbox.com/s/jwcfkhod4gn0z8y/Cell-Bio.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/r0heo2f5x3n6443/cell.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 3.50,
                "business_price" => 77.77
            ]
        ];
        $videosCategorySociologyInfo = [
            [
                "description" => 'How can an academic discipline like Sociology be life changing? This talk suggests one way by exploring how sociologists teach us to re-imagine our personal problems and ourselves.',
                "id" => 'soci_0',
                "name" => 'The wisdom of sociology: Sam Richards',
                "author" => 'TEDx',
                "date" => '22/04/2012',
                "duration" => '13:59',
                "source" => 'https://www.dropbox.com/s/bxid68wrd647815/Sociology-soci.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/564yd0fj2p3y31e/sociology.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 3.50,
                "business_price" => 18.99
            ],
            [
                "description" => 'The independence vote in the north-eastern region of Catalonia shook Spain’s democracy to the core. The Spanish authorities used force to try and stop it, but more than two million Catalans defied the police to back a new independent republic.',
                "id" => 'soci_1',
                "name" => 'Catalonia independence',
                "author" => 'BBC',
                "date" => '24/07/2018',
                "duration" => '23:03',
                "source" => 'https://www.dropbox.com/s/12ayepgt0x4alj7/Catalonia-Soci.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/oksm6phwqjz6iow/catalonia.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 2.50,
                "business_price" => 16.99
            ],
            [
                "description" => 'In which John Green teaches you about American women in the Progressive Era and, well, the progress they made. So the big deal is, of course, the right to vote women gained when the 19th amendment was passed and ratified.',
                "id" => 'soci_2',
                "name" => 'Womens Suffrage',
                "author" => 'CrashCourse',
                "date" => '26/11/2013',
                "duration" => '13:30',
                "source" => 'https://www.dropbox.com/s/fs22vdb0jlfgi85/WomenSuffrage-Soci.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/zl4c2xz17i1l44k/womensuffrage.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 1.50,
                "business_price" => 12.99
            ],
            [
                "description" => '"Are you going to win?" the journalist asked the rebel."We don t deserve to lose," the rebel answered. Twenty years after the Zapatista uprising, VICE traveled to Chiapas to meet Morquecho, the first local journalist to speak with the Zapatista Army face-to-face.',
                "id" => 'soci_3',
                "name" => 'The Zapatista Uprising',
                "author" => 'Vice',
                "date" => '14/01/2014',
                "duration" => '12:39',
                "source" => 'https://www.dropbox.com/s/rfqgkgdi192lbn2/Zapatistas-Soci.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/7ui3h0fbd2huluv/zapatistas.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 3.80,
                "business_price" => 18.99
            ],
            [
                "description" => 'One of the worst Financial crisis happened in 2008 which brought the whole world economy to its knees. Lewis Raneiri, a bond trader at solomon brothers changed banking forever with his one simple idea of Mortgaged Backed Securities (M.B.S).',
                "id" => 'soci_4',
                "name" => 'Financial crisis',
                "author" => 'FinHead',
                "date" => '12/03/2012',
                "duration" => '05:17',
                "source" => 'https://www.dropbox.com/s/bhuj7mgxf5umo84/Crisis-Soci.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/int6qmyfv7t7em2/crisis.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 3.17,
                "business_price" => 77.77
            ],
            [
                "description" => 'How sociology defines family and the different terms used to describe specific types of family. We’ll look at marriage in different societies, as well as marital residential patterns and patterns of descent.',
                "id" => 'soci_5',
                "name" => 'Family & Marriage',
                "author" => 'CrashCourse',
                "date" => '11/09/2018',
                "duration" => '10:59',
                "source" => 'https://www.dropbox.com/s/mz5j2or3badcl6m/Family-Soci.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/2jb14veo1cd7qkh/family.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 4.70,
                "business_price" => 22.77
            ],
            [
                "description" => 'What is the mass media? What kind of influence does it have on our lives?',
                "id" => 'soci_6',
                "name" => 'Mass Media',
                "author" => 'Brooke Miller',
                "date" => '11/12/2014',
                "duration" => '05:55',
                "source" => 'https://www.dropbox.com/s/fx5oy2zcxc585us/MassMedia-Soci.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/nrhhb771agj1ww1/massmedia.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 3.80,
                "business_price" => 22.77
            ],
        ];
        $videosCategoryGraphicDesignInfo = [
            [
                "description" => 'In this video, you’ll learn the fundamentals of graphic design.',
                "id" => 'graph_0',
                "name" => 'Fundamentals of Graphic Design',
                "author" => 'GCFLearnFree',
                "date" => '13/07/2017',
                "duration" => '6:25',
                "source" => 'https://www.dropbox.com/s/6avhn806yr4uouj/Fundamentals-graph.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/ejkzqoiagmxy19c/fundamentals.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 2.99,
                "business_price" => 10.99
            ],
            [
                "description" => 'This is effect is for beginners and people who know photoshop both. So without any worry just watch it.',
                "id" => 'graph_1',
                "name" => 'Photoshop: Photo manipulation',
                "author" => 'Photoshop Tutorials',
                "date" => '12/07/2016',
                "duration" => '10:49',
                "source" => 'https://www.dropbox.com/s/eprkgxd8phraqvp/PhotoManipulation-Graph.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/r8cawv8j20u1uqi/photomanipulation.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 0.99,
                "business_price" => 5.50
            ],
            [
                "description" => 'As human beings, we get used to "the way things are" really fast. But for designers, the way things are is an opportunity ... Could things be better? How? In this funny, breezy talk, the man behind the iPod and the Nest thermostat shares some of his tips for noticing — and driving — change.',
                "id" => 'graph_2',
                "name" => 'Tony Fadell: Secret of Design',
                "author" => 'TED',
                "date" => '03/06/2015',
                "duration" => '16:41',
                "source" => 'https://www.dropbox.com/s/c9xu6pxe0m2yr2z/SecretDesign-Graph.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/swfuo47x7mdody7/secretDesign.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 2.99,
                "business_price" => 16.50
            ],
            [
                "description" => 'How to design a quality poster, using my poster designing tips. The tips that I have for you on how to design a poster, all are very relevant and will enable you to design a quality poster. So tune in and watch this tutorial on poster design top tips!',
                "id" => 'graph_3',
                "name" => 'Poster designing tips',
                "author" => 'Satori Graphics',
                "date" => '19/01/2018',
                "duration" => '8:25',
                "source" => 'https://www.dropbox.com/s/d1x4o0hiy8rlkib/Posters-Graph.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/q27048au5b1njfi/posters.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 4.99,
                "business_price" => 21.50
            ],
            [
                "description" => 'In this tutorial, I have explained about design Technology Roll Up Banner, Graphic Design in Photoshop.',
                "id" => 'graph_4',
                "name" => 'RollUp design',
                "author" => 'Apple Graphic Studio',
                "date" => '10/12/2018',
                "duration" => '20:56',
                "source" => 'https://www.dropbox.com/s/x8ldiwg62bcn0f8/RollUp-Graph.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/kq8b3mvvqlqc2rh/rollup.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 1.99,
                "business_price" => 15.60
            ],
            [
                "description" => 'Creating a modern logo design can be hard. So in this video I\'m giving you a sneaky look into a new logo design course! ',
                "id" => 'graph_5',
                "name" => 'Modern Logo',
                "author" => 'Will Paterson',
                "date" => '06/06/2017',
                "duration" => '13:48',
                "source" => 'https://www.dropbox.com/s/khkgqvs1209hzxc/Logo-Graph.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/go9yzppzx8ppdtk/logo.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 2.50,
                "business_price" => 77.77
            ],
            [
                "description" => 'There are many products that are well designed, but don\'t get the traction they deserve because the color\'s not right. Research has shown that the average human attention span has fallen to eight seconds- one second less than that of the goldfish.',
                "id" => 'graph_6',
                "name" => 'Color In Sight',
                "author" => 'Tealeaves',
                "date" => '05/12/2016',
                "duration" => '21:31',
                "source" => 'https://www.dropbox.com/s/oofzw9i2ihla5yf/Color-Graph.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/aoy96s5ofrxlwpz/color.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 5.50,
                "business_price" => 77.77
            ],
        ];

        $videos = array();
        $length = count($videosCategoryTechnologyInfo);
        for ($i = 0; $i < $length; $i++) {
            $video = $this->createVideo($videosCategoryTechnologyInfo[$i]);
            $video->category()->associate($categoryTechnology);
            $video->save();
            array_push($videos, $video);
            $video = $this->createVideo($videosCategoryBiologyInfo[$i]);
            $video->category()->associate($categoryBiology);
            $video->save();
            array_push($videos, $video);
            $video = $this->createVideo($videosCategorySociologyInfo[$i]);
            $video->category()->associate($categorySociology);
            $video->save();
            array_push($videos, $video);
            $video = $this->createVideo($videosCategoryGraphicDesignInfo[$i]);
            $video->category()->associate($categoryGraphicDesign);
            $video->save();
            array_push($videos, $video);
        }

        // Create views and purchases
        /*$length = count($videos);
        for ($i = 0; $i < $length; $i++) {
            $video = $videos[$i];
            // Save views
            $randomLimit = random_int(10435, 30452);
            for ($j = 0; $j < $randomLimit; $j++) {
                $view = new \App\View();
                $randomId = random_int(1, 10);
                $view->user()->associate($randomId);
                $view->video()->associate($video);
                $view->save();
            }
            // Save purchases
            $randomLimit = random_int(2905, 5494);
            for ($j = 0; $j < $randomLimit; $j++) {
                $purchase = new \App\Purchase();
                $randomId = random_int(1, 10);
                $view->user()->associate($randomId);
                $purchase->video()->associate($video);
                $purchase->stripe_token = "token_example";
                $purchase->save();
            }
        }*/
    }

    private function createVideo($info) {
        $video = new \App\Video([
            "description" => $info["description"],
            "id" => $info["id"],
            "name" => $info["name"],
            "author" => $info["author"],
            "date" => \Carbon\Carbon::createFromFormat('d/m/Y', $info["date"]),
            "duration" => $info["duration"],
            "source" => $info["source"],
            "photo_urls_size" => $info["photo_urls_size"],
            "photo_urls_url" => $info["photo_urls_url"],
            "color" => $info["color"],
            "price" => $info["price"],
            "business_price" => $info["business_price"],
            "views" => random_int(10435, 30452),
            "purchases" => random_int(2905, 5494),
        ]);
        return $video;
    }
}
