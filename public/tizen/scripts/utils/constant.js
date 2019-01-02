var CONSTANT = {
    ITEM: {
        loaded: false
    },
    ITEMS: [this.ITEM, this.ITEM, this.ITEM, this.ITEM],
    CATEGORY: {
        TECHNOLOGY: 0,
        ALPHABETS: 1,
        NUMBERS: 2,
        RELATED_PLAY_LIST: 3
    },
    EFFECT_DELAY_TIME: 500,
    SCROLL_HEIGHT_OF_INDEX: 297, //269, //369, 265+28
    MEDIA_CONTROLLER_TIMEOUT: 3500,
    KEY_CODE: {
        RETURN: 10009,
        ESC: 27
    },
    VIDEOS: {
    	TECHNOLOGY: [
    	      {
    	    	  description: 'How are batteries made and how they work?',
    	    	  id: 'tech_0',
    	    	  name: 'Bateries',
    	    	  author: 'How its made',
    	    	  date: '09/05/2015',
    	    	  duration: '5:03',
    	    	  source: 'https://www.dropbox.com/s/p2yl8an601cn150/Bateries-Tech.mp4?dl=1',
    	    	  photo_urls: [
    	                       {
    	                           size: '240x180',
    	                           url: 'https://www.dropbox.com/s/ajuauuqvgwyuft7/bateries.png?dl=1'
    	                       }
    	                   ],
    	          color: 'rgba(255, 0, 0, .3)',
    	          price: 3.99,
    	          business_price: 14.50
    	      },
    	      {
    	    	  description: 'China has a saying; to see the past, visit Beijing, to see the present, go to Shanghai but for the future, it’s Shenzhen.',
    	    	  id: 'tech_1',
    	    	  name: 'Shenzhen: The city of the future',
    	    	  author: 'RT Documentary',
    	    	  date: '08/07/2017',
    	    	  duration: '25:54',
    	    	  source: 'https://www.dropbox.com/s/8tnqxv51e0zadnl/Shenzhen-Tech.mp4?dl=1',
    	    	  photo_urls: [
    	                       {
    	                           size: '240x180',
    	                           url: 'https://www.dropbox.com/s/bs0g7we0oh83izc/shenzhen.png?dl=1'
    	                       }
    	                   ],
    	          color: 'rgba(255, 0, 0, .3)',
    	          price: 2.99,
    	          business_price: 14.50
    	      },
    	      {
    	    	  description: 'People in green screen suits, monsters that arent actually there and much more. Come behind the scenes and take a look what really went on in the making of "Fantastic Beasts and Where to Find Them".',
    	    	  id: 'tech_2',
    	    	  name: 'Special Effects on Fantastic Beasts',
    	    	  author: 'Fame Focus',
    	    	  date: '19/12/2018',
    	    	  duration: '9:00',
    	    	  source: 'https://www.dropbox.com/s/vtl4zxxm0gw667c/SpecialEffects-Tech.mp4?dl=1',
    	    	  photo_urls: [
    	                       {
    	                           size: '240x180',
    	                           url: 'https://www.dropbox.com/s/sosbye0jtq7rm3f/specialeffects.png?dl=1'
    	                       }
    	                   ],
    	          color: 'rgba(255, 0, 0, .3)',
    	          price: 1.99,
    	          business_price: 9.50
    	      },
    	      {
    	    	  description: 'Artificial Intelligence: Mankinds Last Invention - Technological Singularity Explained',
    	    	  id: 'tech_3',
    	    	  name: 'Artificial Intelligence',
    	    	  author: 'Aperture',
    	    	  date: '05/10/2018',
    	    	  duration: '20:21',
    	    	  source: 'https://www.dropbox.com/s/8y4rx6y84gtil9n/AI-Tech.mp4?dl=1',
    	    	  photo_urls: [
    	                       {
    	                           size: '240x180',
    	                           url: 'https://www.dropbox.com/s/asb1ldo6mq7k7ew/ai.png?dl=1'
    	                       }
    	                   ],
    	          color: 'rgba(255, 0, 0, .3)',
    	          price: 3.50,
    	          business_price: 18.50
    	      }
    	 ],
    	 BIOLOGY: [
    	    	      {
    	    	    	  description: 'Hank explains the extremely complex series of reactions whereby plants feed themselves on sunlight, carbon dioxide and water, and also create some by products we re pretty fond of as well.',
    	    	    	  id: 'bio_0',
    	    	    	  name: 'Photosynthesis',
    	    	    	  author: 'CrashCourse',
    	    	    	  date: '19/03/2012',
    	    	    	  duration: '13:14',	 
    	    	    	  source: 'https://www.dropbox.com/s/3udfzjsran8cymh/Photosynthesis-Bio.mp4?dl=1',
    	    	    	  photo_urls: [
    	    	                       {
    	    	                           size: '240x180',
    	    	                           url: 'https://www.dropbox.com/s/y1qyh3rmu94h0t0/photosynthesis.png?dl=1'
    	    	                       }
    	    	                   ],
    	    	          color: 'rgba(255, 0, 0, .3)',
    	    	          price: 4.50,
    	    	    	  business_price: 20.99
    	    	      },
    	    	      {
    	    	    	  description: 'An exploration of the structure of deoxyribonucleic acid, or DNA. ',
    	    	    	  id: 'bio_1',
    	    	    	  name: 'DNA',
    	    	    	  author: 'MITx Bio',
    	    	    	  date: '26/05/2015',
    	    	    	  duration: '5:58',	 
    	    	    	  source: 'https://www.dropbox.com/s/p5hxahi4sehaljs/DNA-Bio.mp4?dl=1',
    	    	    	  photo_urls: [
    	    	                       {
    	    	                           size: '240x180',
    	    	                           url: 'https://www.dropbox.com/s/mob1ebr68vx53jf/dna.png?dl=1'
    	    	                       }
    	    	                   ],
    	    	          color: 'rgba(255, 0, 0, .3)',
    	    	          price: 1.50,
    	    	    	  business_price: 5.99
    	    	      },
    	    	      {
    	    	    	  description: 'An animation/video teaching the basics of how cancer forms and spreads.  Topics include: mutation, tumor suppressors, oncogenes, angiogenesis, apoptosis, metastasis and drug resistance.  ',
    	    	    	  id: 'bio_2',
    	    	    	  name: 'Cancer',
    	    	    	  author: 'CancerQuest',
    	    	    	  date: '02/10/2013',
    	    	    	  duration: '12:07',	 
    	    	    	  source: 'https://www.dropbox.com/s/okrx0xjo9n7zxwt/Cancer-Bio.mp4?dl=1',
    	    	    	  photo_urls: [
    	    	                       {
    	    	                           size: '240x180',
    	    	                           url: 'https://www.dropbox.com/s/0c45f7wzcf5vvum/cancer.png?dl=1'
    	    	                       }
    	    	                   ],
    	    	          color: 'rgba(255, 0, 0, .3)',
    	    	          price: 2.50,
    	    	    	  business_price: 7.99
    	    	      },
    	    	      {
    	    	    	  description: 'In which Hank does some push ups for science and describes the "economy" of cellular respiration and the various processes whereby our bodies create energy in the form of ATP.',
    	    	    	  id: 'bio_3',
    	    	    	  name: 'ATP & Respiration',
    	    	    	  author: 'CrashCourse',
    	    	    	  date: '12/03/2012',
    	    	    	  duration: '13:25',	 
    	    	    	  source: 'https://www.dropbox.com/s/xdphjb1gpypo4jb/ATP-Bio.mp4?dl=1',
    	    	    	  photo_urls: [
    	    	                       {
    	    	                           size: '240x180',
    	    	                           url: 'https://www.dropbox.com/s/yqdi3bvffsbgsfl/atp.png?dl=1'
    	    	                       }
    	    	                   ],
    	    	          color: 'rgba(255, 0, 0, .3)',
    	    	          price: 3.50,
    	    	    	  business_price: 16.99
    	    	      }   
    	 ],
    	 SOCIOLOGY: [
 	    	      {
 	    	    	  description: 'How can an academic discipline like Sociology be life changing? This talk suggests one way by exploring how sociologists teach us to re-imagine our personal problems and ourselves.',
 	    	    	  id: 'soci_0',
 	    	    	  name: 'The wisdom of sociology: Sam Richards',
 	    	    	  author: 'TEDx',
 	    	    	  date: '22/04/2012',
 	    	    	  duration: '13:59',	 
 	    	    	  source: 'https://www.dropbox.com/s/bxid68wrd647815/Sociology-soci.mp4?dl=1',
 	    	    	  photo_urls: [
 	    	                       {
 	    	                           size: '240x180',
 	    	                           url: 'https://www.dropbox.com/s/564yd0fj2p3y31e/sociology.png?dl=1'
 	    	                       }
 	    	                   ],
 	    	          color: 'rgba(255, 0, 0, .3)',
 	    	          price: 3.50,
 	    	    	  business_price: 18.99
 	    	      },
 	    	      {
 	    	    	  description: 'The independence vote in the north-eastern region of Catalonia shook Spain’s democracy to the core. The Spanish authorities used force to try and stop it, but more than two million Catalans defied the police to back a new independent republic. Nine months on, Catalonia is still part of Spain, its leaders are in prison or abroad and its people are deeply split on the region’s future.',
 	    	    	  id: 'soci_1',
 	    	    	  name: 'Catalonia independence',
 	    	    	  author: 'BBC',
 	    	    	  date: '24/07/2018',
 	    	    	  duration: '23:03',	 
 	    	    	  source: 'https://www.dropbox.com/s/12ayepgt0x4alj7/Catalonia-Soci.mp4?dl=1',
 	    	    	  photo_urls: [
 	    	                       {
 	    	                           size: '240x180',
 	    	                           url: 'https://www.dropbox.com/s/oksm6phwqjz6iow/catalonia.png?dl=1'
 	    	                       }
 	    	                   ],
 	    	          color: 'rgba(255, 0, 0, .3)',
 	    	          price: 2.50,
 	    	    	  business_price: 16.99
 	    	      },
 	    	     {
 	    	    	  description: 'In which John Green teaches you about American women in the Progressive Era and, well, the progress they made. So the big deal is, of course, the right to vote women gained when the 19th amendment was passed and ratified. But women made a lot of other gains in the 30 years between 1890 and 1920.',
 	    	    	  id: 'soci_2',
 	    	    	  name: 'Womens Suffrage',
 	    	    	  author: 'CrashCourse',
 	    	    	  date: '26/11/2013',
 	    	    	  duration: '13:30',	 
 	    	    	  source: 'https://www.dropbox.com/s/fs22vdb0jlfgi85/WomenSuffrage-Soci.mp4?dl=1',
 	    	    	  photo_urls: [
 	    	                       {
 	    	                           size: '240x180',
 	    	                           url: 'https://www.dropbox.com/s/zl4c2xz17i1l44k/womensuffrage.png?dl=1'
 	    	                       }
 	    	                   ],
 	    	          color: 'rgba(255, 0, 0, .3)',
 	    	          price: 1.50,
 	    	    	  business_price: 12.99
 	    	      },
 	    	     {
 	    	    	  description: '"Are you going to win?" the journalist asked the rebel."We don t deserve to lose," the rebel answered. Twenty years after the Zapatista uprising, VICE traveled to Chiapas to meet Morquecho, the first local journalist to speak with the Zapatista Army face-to-face, so he could recall the events of that fateful day—it was the first indigenous armed uprising in Latin America in the internet age.',
 	    	    	  id: 'soci_3',
 	    	    	  name: 'The Zapatista Uprising',
 	    	    	  author: 'Vice',
 	    	    	  date: '14/01/2014',
 	    	    	  duration: '12:39',	 
 	    	    	  source: 'https://www.dropbox.com/s/rfqgkgdi192lbn2/Zapatistas-Soci.mp4?dl=1',
 	    	    	  photo_urls: [
 	    	                       {
 	    	                           size: '240x180',
 	    	                           url: 'https://www.dropbox.com/s/7ui3h0fbd2huluv/zapatistas.png?dl=1'
 	    	                       }
 	    	                   ],
 	    	          color: 'rgba(255, 0, 0, .3)',
 	    	          price: 3.80,
 	    	    	  business_price: 18.99
 	    	      },
 	      ],
    	 GRAPHIC_DESIGN: [
    	      {
    	    	  description: 'In this video, you’ll learn the fundamentals of graphic design.',
    	    	  id: 'graph_0',
    	    	  name: 'Fundamentals of Graphic Design',
    	    	  author: 'GCFLearnFree',
    	    	  date: '13/07/2017',
    	    	  duration: '6:25',	 
    	    	  source: 'https://www.dropbox.com/s/6avhn806yr4uouj/Fundamentals-graph.mp4?dl=1',
    	    	  photo_urls: [
    	                       {
    	                           size: '240x180',
    	                           url: 'https://www.dropbox.com/s/ejkzqoiagmxy19c/fundamentals.png?dl=1'
    	                       }
    	                   ],
    	          color: 'rgba(255, 0, 0, .3)',
    	          price: 2.99,
    	    	  business_price: 10.99
    	      },
    	      {
    	    	  description: 'This is effect is for beginners and people who know photoshop both. So without any worry just watch it.',
    	    	  id: 'graph_1',
    	    	  name: 'Photoshop: Photo manipulation',
    	    	  author: 'Photoshop Tutorials',
    	    	  date: '12/07/2016',
    	    	  duration: '10:49',	 
    	    	  source: 'https://www.dropbox.com/s/eprkgxd8phraqvp/PhotoManipulation-Graph.mp4?dl=1',
    	    	  photo_urls: [
    	                       {
    	                           size: '240x180',
    	                           url: 'https://www.dropbox.com/s/r8cawv8j20u1uqi/photomanipulation.png?dl=1'
    	                       }
    	                   ],
    	          color: 'rgba(255, 0, 0, .3)',
    	          price: 0.99,
    	    	  business_price: 5.50
    	      },
    	      {
    	    	  description: 'As human beings, we get used to "the way things are" really fast. But for designers, the way things are is an opportunity ... Could things be better? How? In this funny, breezy talk, the man behind the iPod and the Nest thermostat shares some of his tips for noticing — and driving — change.',
    	    	  id: 'graph_2',
    	    	  name: 'Tony Fadell: Secret of Design',
    	    	  author: 'TED',
    	    	  date: '03/06/2015',
    	    	  duration: '16:41',	 
    	    	  source: 'https://www.dropbox.com/s/c9xu6pxe0m2yr2z/SecretDesign-Graph.mp4?dl=1',
    	    	  photo_urls: [
    	                       {
    	                           size: '240x180',
    	                           url: 'https://www.dropbox.com/s/swfuo47x7mdody7/secretDesign.png?dl=1'
    	                       }
    	                   ],
    	          color: 'rgba(255, 0, 0, .3)',
    	          price: 2.99,
    	    	  business_price: 16.50
    	      },
    	      {
    	    	  description: 'How to design a quality poster, using my poster designing tips. The tips that I have for you on how to design a poster, all are very relevant and will enable you to design a quality poster. So tune in and watch this tutorial on poster design top tips!',
    	    	  id: 'graph_3',
    	    	  name: 'Poster designing tips',
    	    	  author: 'Satori Graphics',
    	    	  date: '19/01/2018',
    	    	  duration: '8:25',	 
    	    	  source: 'https://www.dropbox.com/s/d1x4o0hiy8rlkib/Posters-Graph.mp4?dl=1',
    	    	  photo_urls: [
    	                       {
    	                           size: '240x180',
    	                           url: 'https://www.dropbox.com/s/q27048au5b1njfi/posters.png?dl=1'
    	                       }
    	                   ],
    	          color: 'rgba(255, 0, 0, .3)',
    	          price: 4.99,
    	    	  business_price: 21.50
    	      }        
    	 ]
    },
    PREPARED_DATA: {
        COLORS: [
            {
                description: 'Put the description of color here. Put the description of blue color here. Put the description of color here. Put the description of color here. Put the description of blue color here. Put the description of color here.',
                id: 'color_0',
                name: 'RED color',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/red.png'
                    }
                ],
                color: 'rgba(255, 0, 0, .3)'
            },
            {
                description: 'Put the description of color here. Put the description of blue color here. Put the description of color here. Put the description of color here. Put the description of blue color here. Put the description of color here.',
                id: 'color_1',
                name: 'BLUE color',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/blue.png'
                    }
                ],
                color: 'rgba(0, 0, 255, .3)'
            },
            {
                description: 'Put the description of color here. Put the description of blue color here. Put the description of color here. Put the description of color here. Put the description of blue color here. Put the description of color here.',
                id: 'color_2',
                name: 'BROWN color',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/brown.png'
                    }
                ],
                color: 'rgba(165, 42, 24, .3)'
            },
            {
                description: 'Put the description of color here. Put the description of blue color here. Put the description of color here. Put the description of color here. Put the description of blue color here. Put the description of color here.',
                id: 'color_3',
                name: 'CITRUS color',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/citrus.png'
                    }
                ],
                color: 'rgba(161, 197, 10, .3)'
            },
            {
                description: 'Put the description of color here. Put the description of blue color here. Put the description of color here. Put the description of color here. Put the description of blue color here. Put the description of color here.',
                id: 'color_4',
                name: 'Deep Green color',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/deepGreen.png'
                    }
                ],
                color: 'rgba(2, 89, 15, .3)'
            },
            {
                description: 'Put the description of color here. Put the description of blue color here. Put the description of color here. Put the description of color here. Put the description of blue color here. Put the description of color here.',
                id: 'color_5',
                name: 'Dusk color',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/dusk.png'
                    }
                ],
                color: 'rgba(78, 84, 129, .3)'
            },
            {
                description: 'Put the description of color here. Put the description of blue color here. Put the description of color here. Put the description of color here. Put the description of blue color here. Put the description of color here.',
                id: 'color_6',
                name: 'Lime color',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/lime.png'
                    }
                ],
                color: 'rgba(153, 255, 153, .3)'
            },
            {
                description: 'Put the description of color here. Put the description of blue color here. Put the description of color here. Put the description of color here. Put the description of blue color here. Put the description of color here.',
                id: 'color_7',
                name: 'Maroon color',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/maroon.png'
                    }
                ],
                color: 'rgba(101, 0, 33, .3)'
            },
            {
                description: 'Put the description of color here. Put the description of blue color here. Put the description of color here. Put the description of color here. Put the description of blue color here. Put the description of color here.',
                id: 'color_8',
                name: 'Merlot color',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/merlot.png'
                    }
                ],
                color: 'rgba(102, 0, 51, .3)'
            },
            {
                description: 'Put the description of color here. Put the description of blue color here. Put the description of color here. Put the description of color here. Put the description of blue color here. Put the description of color here.',
                id: 'color_9',
                name: 'Mint color',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/mint.png'
                    }
                ],
                color: 'rgba(159, 254, 176, .3)'
            },
            {
                description: 'Put the description of color here. Put the description of blue color here. Put the description of color here. Put the description of color here. Put the description of blue color here. Put the description of color here.',
                id: 'color_10',
                name: 'Mustard color',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/mustard.png'
                    }
                ],
                color: 'rgba(255, 204, 102, .3)'
            }
        ],
        ALPHABETS: [
            {
                description: 'This is alphabet description.',
                id: 'alphabet_0',
                name: 'Alphabet A',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/alphabet_a.png'
                    }
                ],
                color: 'rgba(200, 191, 231, .3)'
            },
            {
                description: 'This is alphabet description.',
                id: 'alphabet_1',
                name: 'Alphabet B',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/alphabet_b.png'
                    }
                ],
                color: 'rgba(200, 191, 231, .3)'
            },
            {
                description: 'This is alphabet description.',
                id: 'alphabet_2',
                name: 'Alphabet C',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/alphabet_c.png'
                    }
                ],
                color: 'rgba(200, 191, 231, .3)'
            },
            {
                description: 'This is alphabet description.',
                id: 'alphabet_3',
                name: 'Alphabet D',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/alphabet_d.png'
                    }
                ],
                color: 'rgba(78, 84, 129, .3)'
            },
            {
                description: 'This is alphabet description.',
                id: 'alphabet_4',
                name: 'Alphabet E',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/alphabet_e.png'
                    }
                ],
                color: 'rgba(78, 84, 129, .3)'
            },
            {
                description: 'This is alphabet description.',
                id: 'alphabet_5',
                name: 'Alphabet F',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/alphabet_f.png'
                    }
                ],
                color: 'rgba(78, 84, 129, .3)'
            },
            {
                description: 'This is alphabet description.',
                id: 'alphabet_6',
                name: 'Alphabet G',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/alphabet_g.png'
                    }
                ],
                color: 'rgba(63, 72, 204, .3)'
            },
            {
                description: 'This is alphabet description.',
                id: 'alphabet_7',
                name: 'Alphabet H',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/alphabet_h.png'
                    }
                ],
                color: 'rgba(63, 72, 204, .3)'
            },
            {
                description: 'This is alphabet description.',
                id: 'alphabet_8',
                name: 'Alphabet I',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/alphabet_i.png'
                    }
                ],
                color: 'rgba(63, 72, 204, .3)'
            },
            {
                description: 'This is alphabet description.',
                id: 'alphabet_9',
                name: 'Alphabet J',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/alphabet_j.png'
                    }
                ],
                color: 'rgba(2, 89, 15, .3)'
            },
            {
                description: 'This is alphabet description.',
                id: 'alphabet_10',
                name: 'Alphabet K',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/alphabet_k.png'
                    }
                ],
                color: 'rgba(2, 89, 15, .3)'
            },
            {
                description: 'This is alphabet description.',
                id: 'alphabet_11',
                name: 'Alphabet L',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/alphabet_l.png'
                    }
                ],
                color: 'rgba(2, 89, 15, .3)'
            },
            {
                description: 'This is alphabet description.',
                id: 'alphabet_12',
                name: 'Alphabet M',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/alphabet_m.png'
                    }
                ],
                color: 'rgba(102, 0, 51, .3)'
            },
            {
                description: 'This is alphabet description.',
                id: 'alphabet_13',
                name: 'Alphabet N',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/alphabet_n.png'
                    }
                ],
                color: 'rgba(102, 0, 51, .3)'
            },
            {
                description: 'This is alphabet description.',
                id: 'alphabet_14',
                name: 'Alphabet O',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/alphabet_o.png'
                    }
                ],
                color: 'rgba(102, 0, 51, .3)'
            },
            {
                description: 'This is alphabet description.',
                id: 'alphabet_15',
                name: 'Alphabet P',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/alphabet_p.png'
                    }
                ],
                color: 'rgba(101, 55, 0, .3)'
            },
            {
                description: 'This is alphabet description.',
                id: 'alphabet_16',
                name: 'Alphabet Q',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/alphabet_q.png'
                    }
                ],
                color: 'rgba(101, 55, 0, .3)'
            },
            {
                description: 'This is alphabet description.',
                id: 'alphabet_17',
                name: 'Alphabet R',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/alphabet_r.png'
                    }
                ],
                color: 'rgba(101, 55, 0, .3)'
            },
            {
                description: 'This is alphabet description.',
                id: 'alphabet_18',
                name: 'Alphabet S',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/alphabet_s.png'
                    }
                ],
                color: 'rgba(136, 0, 21, .3)'
            },
            {
                description: 'This is alphabet description.',
                id: 'alphabet_19',
                name: 'Alphabet T',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/alphabet_t.png'
                    }
                ],
                color: 'rgba(136, 0, 21, .3)'
            },
            {
                description: 'This is alphabet description.',
                id: 'alphabet_20',
                name: 'Alphabet U',
                photo_urls: [
                    {
                        size: '240x180',
                        url: 'images/alphabet_u.png'
                    }
                ],
                color: 'rgba(136, 0, 21, .3)'
            }
        ],
        NUMBERS: [
            {
                description: 'NUMBER Description',
                id: 'number_1',
                name: 'Number 1',
                photo_urls: [
                    {
                        size: '268x268',
                        url: 'images/1.png'
                    }
                ],
                color: 'rgba(0, 162, 232, .3)'
            },
            {
                description: 'NUMBER Description',
                id: 'number_2',
                name: 'Number 2',
                photo_urls: [
                    {
                        size: '268x268',
                        url: 'images/2.png'
                    }
                ],
                color: 'rgba(0, 162, 232, .3)'
            },
            {
                description: 'NUMBER Description',
                id: 'number_3',
                name: 'Number 3',
                photo_urls: [
                    {
                        size: '268x268',
                        url: 'images/3.png'
                    }
                ],
                color: 'rgba(0, 162, 232, .3)'
            },
            {
                description: 'NUMBER Description',
                id: 'number_4',
                name: 'Number 4',
                photo_urls: [
                    {
                        size: '268x268',
                        url: 'images/4.png'
                    }
                ],
                color: 'rgba(0, 162, 232, .3)'
            },
            {
                description: 'NUMBER Description',
                id: 'number_5',
                name: 'Number 5',
                photo_urls: [
                    {
                        size: '268x268',
                        url: 'images/5.png'
                    }
                ],
                color: 'rgba(0, 162, 232, .3)'
            },
            {
                description: 'NUMBER Description',
                id: 'number_6',
                name: 'Number 6',
                photo_urls: [
                    {
                        size: '268x268',
                        url: 'images/6.png'
                    }
                ],
                color: 'rgba(0, 162, 232, .3)'
            },
            {
                description: 'NUMBER Description',
                id: 'number_7',
                name: 'Number 7',
                photo_urls: [
                    {
                        size: '268x268',
                        url: 'images/7.png'
                    }
                ],
                color: 'rgba(0, 162, 232, .3)'
            },
            {
                description: 'NUMBER Description',
                id: 'number_8',
                name: 'Number 8',
                photo_urls: [
                    {
                        size: '268x268',
                        url: 'images/8.png'
                    }
                ],
                color: 'rgba(0, 162, 232, .3)'
            },
            {
                description: 'NUMBER Description',
                id: 'number_9',
                name: 'Number 9',
                photo_urls: [
                    {
                        size: '268x268',
                        url: 'images/9.png'
                    }
                ],
                color: 'rgba(0, 162, 232, .3)'
            },
            {
                description: 'NUMBER Description',
                id: 'number_10',
                name: 'Number 10',
                photo_urls: [
                    {
                        size: '268x268',
                        url: 'images/10.png'
                    }
                ],
                color: 'rgba(0, 162, 232, .3)'
            }
        ]
    }
};