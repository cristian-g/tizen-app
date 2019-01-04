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
        $usersInfo = [
            [
                'name' => "Adrià Puigdellívol Pérez",
                'sub_auth0' => "estudy|adria.puigdellivol",
                'picture' => "/img/estudy/adria.puigdellivol.jpg",
            ],
            [
                'name' => "Alejandro Sardá Sagarra",
                'sub_auth0' => "estudy|alejandro.sarda",
                'picture' => "/img/estudy/alejandro.sarda.jpg",
            ],
            [
                'name' => "Andreu Salzano García",
                'sub_auth0' => "estudy|andreu.salzano",
                'picture' => "/img/estudy/andreu.salzano.jpg",
            ],
            [
                'name' => "Angela Brunet Rodríguez",
                'sub_auth0' => "estudy|angela.brunet",
                'picture' => "/img/estudy/angela.brunet.jpg",
            ],
            [
                'name' => "Borja Aguilar Vítores",
                'sub_auth0' => "estudy|borja.aguilar",
                'picture' => "/img/estudy/borja.aguilar.jpg",
            ],
            [
                'name' => "Carla Radresa Badosa",
                'sub_auth0' => "estudy|carla.radresa",
                'picture' => "/img/estudy/carla.radresa.jpg",
            ],
            [
                'name' => "Carlos Rocha Cavaller",
                'sub_auth0' => "estudy|carlos.rocha",
                'picture' => "/img/estudy/carlos.rocha.jpg",
            ],
            [
                'name' => "Carlos Muntané Fuentes",
                'sub_auth0' => "estudy|carlos.muntane",
                'picture' => "/img/estudy/carlos.muntane.jpg",
            ],
            [
                'name' => "Carme Perseguer Barragán",
                'sub_auth0' => "estudy|carme.perseguer",
                'picture' => "/img/estudy/carme.perseguer.jpg",
            ],
            [
                'name' => "Daniel Solé Serentill",
                'sub_auth0' => "estudy|daniel.ss",
                'picture' => "/img/estudy/daniel.ss.jpg",
            ],
            [
                'name' => "David Gonzàlez Lesmes",
                'sub_auth0' => "estudy|david.gl",
                'picture' => "/img/estudy/david.gl.jpg",
            ],
            [
                'name' => "Esteve Genovard Ferriol",
                'sub_auth0' => "estudy|esteve.genovard",
                'picture' => "/img/estudy/esteve.genovard.jpg",
            ],
            [
                'name' => "Genís Serrabasa Sánchez",
                'sub_auth0' => "estudy|genis.serrabasa",
                'picture' => "/img/estudy/genis.serrabasa.jpg",
            ],
            [
                'name' => "Gerard Parareda Gallifa",
                'sub_auth0' => "estudy|gerard.parareda",
                'picture' => "/img/estudy/gerard.parareda.jpg",
            ],
            [
                'name' => "Joel López Romero",
                'sub_auth0' => "estudy|joel.lopez",
                'picture' => "/img/estudy/joel.lopez.jpg",
            ],
            [
                'name' => "Jordi Gallego Rovira",
                'sub_auth0' => "estudy|jordi.gallego",
                'picture' => "/img/estudy/jordi.gallego.jpg",
            ],
            [
                'name' => "Jordi Alonso Martí",
                'sub_auth0' => "estudy|jordi.alonso",
                'picture' => "/img/estudy/jordi.alonso.jpg",
            ],
            [
                'name' => "Jordi Roldán García",
                'sub_auth0' => "estudy|jordi.roldan",
                'picture' => "/img/estudy/jordi.roldan.jpg",
            ],
            [
                'name' => "Judit Villanueva Pérez",
                'sub_auth0' => "estudy|judit.villanueva",
                'picture' => "/img/estudy/judit.villanueva.jpg",
            ],
            [
                'name' => "Laura Gendrau Sanclemente",
                'sub_auth0' => "estudy|laura.gendrau",
                'picture' => "/img/estudy/laura.gendrau.jpg",
            ],
            [
                'name' => "Marc Grau Riesco",
                'sub_auth0' => "estudy|marc.gr",
                'picture' => "/img/estudy/marc.gr.jpg",
            ],
            [
                'name' => "Marc Castells Güell",
                'sub_auth0' => "estudy|marc.castells",
                'picture' => "/img/estudy/marc.castells.jpg",
            ],
            [
                'name' => "Maria Chueca Buxó",
                'sub_auth0' => "estudy|maria.chueca",
                'picture' => "/img/estudy/maria.chueca.jpg",
            ],
            [
                'name' => "Noa Duran Plass",
                'sub_auth0' => "estudy|noa.duran",
                'picture' => "/img/estudy/noa.duran.jpg",
            ],
            [
                'name' => "Pau Nonell Isach",
                'sub_auth0' => "estudy|pau.nonell",
                'picture' => "/img/estudy/pau.nonell.jpg",
            ],
            [
                'name' => "Pau Freixas Mateu",
                'sub_auth0' => "estudy|pau.freixas",
                'picture' => "/img/estudy/pau.freixas.jpg",
            ],
            [
                'name' => "Pol Fernàndez Martí",
                'sub_auth0' => "estudy|pol.fm",
                'picture' => "/img/estudy/pol.fm.jpg",
            ],
            [
                'name' => "Pol Valés Rodon",
                'sub_auth0' => "estudy|pol.vales",
                'picture' => "/img/estudy/pol.vales.jpg",
            ],
            [
                'name' => "Rafael Rebollo Cacín",
                'sub_auth0' => "estudy|rafael.rebollo",
                'picture' => "/img/estudy/rafael.rebollo.jpg",
            ],
            [
                'name' => "Robin Jiménez Newman",
                'sub_auth0' => "estudy|robin.jimenez",
                'picture' => "/img/estudy/robin.jimenez.jpg",
            ],
            [
                'name' => "Roger Cecilia Costa",
                'sub_auth0' => "estudy|roger.cecilia",
                'picture' => "/img/estudy/roger.cecilia.jpg",
            ],
            [
                'name' => "Sergi Simó Bosquet",
                'sub_auth0' => "estudy|sergi.simo",
                'picture' => "/img/estudy/sergi.simo.jpg",
            ],
            [
                'name' => "Sergio Álvarez Durán",
                'sub_auth0' => "estudy|sergio.ad",
                'picture' => "/img/estudy/sergio.ad.jpg",
            ],
            [
                'name' => "Sònia Arroyo Esparza",
                'sub_auth0' => "estudy|sonia.arroyo",
                'picture' => "/img/estudy/sonia.arroyo.jpg",
            ],
            [
                'name' => "Tatiana Cáceres Amigo",
                'sub_auth0' => "estudy|tatiana.caceres",
                'picture' => "/img/estudy/tatiana.caceres.jpg",
            ],
            [
                'name' => "Xavier Hernández Sevilla",
                'sub_auth0' => "estudy|xavier.hernandez",
                'picture' => "/img/estudy/xavier.hernandez.jpg",
            ],
        ];

        $users = array();
        $length = count($usersInfo);
        for ($i = 0; $i < $length; $i++) {
            $user = new User([
                'name' => $usersInfo[$i]['name'],
                'sub_auth0' => $usersInfo[$i]['name'],
                'picture' => $usersInfo[$i]['name'],
            ]);
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
                "description" => 'Description.',
                "id" => 'bio_4',
                "name" => 'Name.',
                "author" => 'Author',
                "date" => '12/03/2012',
                "duration" => '77:77',
                "source" => 'https://www.dropbox.com/s/xdphjb1gpypo4jb/ATP-Bio.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/yqdi3bvffsbgsfl/atp.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 7.77,
                "business_price" => 77.77
            ],
            [
                "description" => 'Description.',
                "id" => 'bio_5',
                "name" => 'Name.',
                "author" => 'Author',
                "date" => '12/03/2012',
                "duration" => '77:77',
                "source" => 'https://www.dropbox.com/s/xdphjb1gpypo4jb/ATP-Bio.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/yqdi3bvffsbgsfl/atp.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 7.77,
                "business_price" => 77.77
            ],
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
                "description" => 'The independence vote in the north-eastern region of Catalonia shook Spain’s democracy to the core. The Spanish authorities used force to try and stop it, but more than two million Catalans defied the police to back a new independent republic. Nine months on, Catalonia is still part of Spain, its leaders are in prison or abroad and its people are deeply split on the region’s future.',
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
                "description" => 'In which John Green teaches you about American women in the Progressive Era and, well, the progress they made. So the big deal is, of course, the right to vote women gained when the 19th amendment was passed and ratified. But women made a lot of other gains in the 30 years between 1890 and 1920.',
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
                "description" => '"Are you going to win?" the journalist asked the rebel."We don t deserve to lose," the rebel answered. Twenty years after the Zapatista uprising, VICE traveled to Chiapas to meet Morquecho, the first local journalist to speak with the Zapatista Army face-to-face, so he could recall the events of that fateful day—it was the first indigenous armed uprising in Latin America in the internet age.',
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
                "description" => 'Description.',
                "id" => 'soci_4',
                "name" => 'Name.',
                "author" => 'Author',
                "date" => '12/03/2012',
                "duration" => '77:77',
                "source" => 'https://www.dropbox.com/s/xdphjb1gpypo4jb/ATP-Bio.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/yqdi3bvffsbgsfl/atp.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 7.77,
                "business_price" => 77.77
            ],
            [
                "description" => 'Description.',
                "id" => 'soci_5',
                "name" => 'Name.',
                "author" => 'Author',
                "date" => '12/03/2012',
                "duration" => '77:77',
                "source" => 'https://www.dropbox.com/s/xdphjb1gpypo4jb/ATP-Bio.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/yqdi3bvffsbgsfl/atp.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 7.77,
                "business_price" => 77.77
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
                "description" => 'Description.',
                "id" => 'graph_4',
                "name" => 'Name.',
                "author" => 'Author',
                "date" => '12/03/2012',
                "duration" => '77:77',
                "source" => 'https://www.dropbox.com/s/xdphjb1gpypo4jb/ATP-Bio.mp4?dl=1',
                "photo_urls_size" => '240x180',
                "photo_urls_url" => 'https://www.dropbox.com/s/yqdi3bvffsbgsfl/atp.png?dl=1',
                "color" => 'rgba(255, 0, 0, .3)',
                "price" => 7.77,
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
