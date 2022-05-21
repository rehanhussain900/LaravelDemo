<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\QualityAssuranceSurveyQuestion;

class QualityAssuranceSurveyQuestionTitleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
            $data =[
                        //Customer Interview Questions (Yes/No/NA)
                        [
                            'title'         =>'Were you home during your 6 Point Advantage service?',
                            'valid_answer'  =>'Yes',
                            'points'        => 0,
                            'title_id'      => 1,
                        ],
                        [
                            'title'         =>'Did our technician knock on the door upon arrival?',
                            'valid_answer'  =>'Yes',
                            'points'        => 20,
                            'title_id'      => 1,
                        ],
                        [
                            'title'         =>'Did our technician ask if you had any concerns prior to beginning your service?',
                            'valid_answer'  =>'Yes',
                            'points'        => 20,
                            'title_id'      => 1,
                        ],
                        [
                            'title'         =>'Did your technician offer to perform an interior pest inspection?',
                            'valid_answer'  =>'Yes',
                            'points'        => 15,
                            'title_id'      => 1,
                        ],
                        [
                            'title'         =>'Did our technician ask to treat your garage?',
                            'valid_answer'  =>'Yes, NA',
                            'points'        => 15,
                            'title_id'      => 1,
                        ],
                        [
                            'title'         =>'Did our technician discuss the treatment/follow- expectations after completion of the service?',
                            'valid_answer'  =>'Yes',
                            'points'        => 20,
                            'title_id'      => 1,
                        ],
                        [
                            'title'         =>'Is there anything we can do to improve your customer experience?',
                            'valid_answer'  =>'No',
                            'points'        => 10,
                            'title_id'      => 1,
                        ],
                        //Title: Exterior Inspection (Yes/No/NA)
                        [
                            'title'         =>'Is there any current pest activity not including spider webs? (ex. trailing ants, occasional invaders, etc.)',
                            'valid_answer'  =>'No',
                            'points'        => 15,
                            'title_id'      => 2,
                        ],
                        [
                            'title'         =>'Have all cob webs and wasp nests (within reach) been removed?',
                            'valid_answer'  =>'Yes',
                            'points'        => 15,
                            'title_id'      => 2,
                        ],
                        [
                            'title'         =>'Did the tech follow the treatment protocol and use proper amounts of material?',
                            'valid_answer'  =>'Yes',
                            'points'        => 15,
                            'title_id'      => 2,
                        ],
                        [
                            'title'         =>'Does the amount of product injected match the number of Taexx lines or wheel updated/initialed?',
                            'valid_answer'  =>'Yes',
                            'points'        => 15,
                            'title_id'      => 2,
                        ],
                        [
                            'title'         =>'Is the port box in working condition with legible HomeTeam decal?',
                            'valid_answer'  =>'Yes, NA',
                            'points'        => 10,
                            'title_id'      => 2,
                        ],
                        [
                            'title'         =>'Are there specific conditions conducive to pest activity and were they notated on ticket?',
                            'valid_answer'  =>'Yes, NA',
                            'points'        => 15,
                            'title_id'      => 2,
                        ],
                        [
                            'title'         =>'Service note: Personalized to the home and includes the "3 point criteria"',
                            'valid_answer'  =>'Yes',
                            'points'        => 15,
                            'title_id'      => 2,
                        ],
                        [
                            'title'         =>'Was the amount of time spent on service in line with region standards?',
                            'valid_answer'  =>'Yes',
                            'points'        => 10,
                            'title_id'      => 2,
                        ],
                        // Sentricon (Yes/No/NA with comment box)
                        [
                            'title'         =>'Are stations installed at 10ft or less intervals and within 4ft of critical areas?',
                            'valid_answer'  =>'Yes',
                            'points'        => 15,
                            'title_id'      => 3,
                        ],
                        [
                            'title'         =>'Are there stations missing from the site?',
                            'valid_answer'  =>'No',
                            'points'        => 15,
                            'title_id'      => 3,
                        ],
                        [
                            'title'         =>'Are all the stations properly numbered counter clockwise starting right of the front door?',
                            'valid_answer'  =>'Yes',
                            'points'        => 15,
                            'title_id'      => 3,
                        ],
                        [
                            'title'         =>'Are all the stations flush with the ground?',
                            'valid_answer'  =>'Yes',
                            'points'        => 15,
                            'title_id'      => 3,
                        ],
                        [
                            'title'         =>'Are the stations properly maintained and inspected?',
                            'valid_answer'  =>'Yes',
                            'points'        => 15,
                            'title_id'      => 3,
                        ],
                        [
                            'title'         =>'Clean out tool used and 2/3 bait present in all?',
                            'valid_answer'  =>'Yes',
                            'points'        => 15,
                            'title_id'      => 3,
                        ],
                        [
                            'title'         =>'Are all top caps present, secured, and not damaged?',
                            'valid_answer'  =>'Yes',
                            'points'        => 15,
                            'title_id'      => 3,
                        ],
                        [
                            'title'         =>'Does the station placement correctly follow the roofline?',
                            'valid_answer'  =>'Yes',
                            'points'        => 15,
                            'title_id'      => 3,
                        ],
                        [
                            'title'         =>'Are the stations placed outside the dripline and at least 18" from the foundation?',
                            'valid_answer'  =>'Yes',
                            'points'        => 15,
                            'title_id'      => 3,
                        ],
                        [
                            'title'         =>'Was any termite activity found in stations and if so properly recorded on service ticket? (No= Activity in station but not recorded on service ticket, N/A = No termite activity in stations)',
                            'valid_answer'  =>'No, NA',
                            'points'        => 15,
                            'title_id'      => 3,
                        ],
                        [
                            'title'         =>'Is the jobsite clean (debris removed) with no vacant station holes present?',
                            'valid_answer'  =>'Yes',
                            'points'        => 15,
                            'title_id'      => 3,
                        ],
                        [
                            'title'         =>'Are the appropriate conditions conducive noted on the service ticket? (N/A=  no conditions conducive at the site)',
                            'valid_answer'  =>'Yes',
                            'points'        => 15,
                            'title_id'      => 3,
                        ]
                    ];
            foreach( $data as $obj ){
                QualityAssuranceSurveyQuestion::create( $obj );
            }
    }   
}
