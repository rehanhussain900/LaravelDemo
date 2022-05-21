<?php

namespace Database\Seeders;

use App\Models\Specie;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

/**
 *
 */
class SpecieSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'        => 'Bat Family',
                'sort_order'  => 1,
                'description' => '
                    <p>Evidence may include the scent of urine, urine stains, fecal matter, trailing and tunneling, nesting, and gnawing. It is important to note that these animals tend to damage electrical wiring and HVAC duct work and is considered a very real threat when raccoons nest in attics. Raccoons are also known for transmitting diseases such as rabies and dropping parasites such as Raccoon Roundworm. We encourage the homeowner to stay away from any raccoons they may see around their home, and to not interact with any of the areas where these animals may have contaminated.</p>
                    <p>A wildlife removal program is recommended to commence immediately to remove the raccoons from the home. A designated technician will set up a one-way door, deterrents, or traps to remove the animals from the home and provide the necessary wildlife relief. A schedule to inspect the one-way door, reapply deterrents, or check the traps will be communicated with you. This service also includes the removal of any animals caught and the addition of more traps if necessary, to ensure the problem has been solved.</p>
                    <p>It is also recommended that we perform a cleanup service and a sanitizing treatment to reduce the harmful elements of contamination left by these animals, as well as reducing the lingering pheromones that may attract other animals. An ectoparasite treatment may also be needed to address parasites that used these animals as a host."</p>
                ',
            ],
            [
                'name'        => 'Bobcat',
                'sort_order'  => 2,
                'description' => '
                    <p>After performing a thorough inspection of the property, the follow concerns should be addressed: professional seal up of the home will aid in long term prevention of nuisance wildlife. </p>
                    <p>Evidence may include the scent of urine, urine stains, fecal matter, trailing and tunneling, nesting and gnawing. </p>
                    <p>A trapping regimen is recommended to commence immediately to controll the rodent population. A designated technician will set up a schedule to check the traps with you. This service also includes the removal of any animals caugh and the addition of more traps if necessary.</p>
                ',
            ],
            [
                'name'        => 'Coyote',
                'sort_order'  => 3,
                'description' => '
                    <p>After performing a thorough inspection of the property, the follow concerns should be addressed: professional seal up of the home will aid in long term prevention of nuisance wildlife. </p>
                    <p>Evidence may include the scent of urine, urine stains, fecal matter, trailing and tunneling, nesting and gnawing. </p>
                    <p>A trapping regimen is recommended to commence immediately to controll the rodent population. A designated technician will set up a schedule to check the traps with you. This service also includes the removal of any animals caugh and the addition of more traps if necessary.</p>
                ',
            ],
            [
                'name'        => 'Dead Animal Removal',
                'sort_order'  => 4,
                'description' => '
                    <p>After performing a thorough inspection of the property, the follow concerns should be addressed: professional seal up of the home will aid in long term prevention of nuisance wildlife. </p>
                    <p>Evidence may include the scent of urine, urine stains, fecal matter, trailing and tunneling, nesting and gnawing. </p>
                    <p>A trapping regimen is recommended to commence immediately to controll the rodent population. A designated technician will set up a schedule to check the traps with you. This service also includes the removal of any animals caugh and the addition of more traps if necessary.</p>
                ',
            ],
            [
                'name'        => 'Gray Fox',
                'sort_order'  => 5,
                'description' => '
                    <p>After performing a thorough inspection of the property, the follow concerns should be addressed: professional seal up of the home will aid in long term prevention of nuisance wildlife. </p>
                    <p>Evidence may include the scent of urine, urine stains, fecal matter, trailing and tunneling, nesting and gnawing. </p>
                    <p>A trapping regimen is recommended to commence immediately to controll the rodent population. A designated technician will set up a schedule to check the traps with you. This service also includes the removal of any animals caugh and the addition of more traps if necessary.</p>
                ',
            ],
            [
                'name'        => 'Insects',
                'sort_order'  => 6,
                'description' => '
                    <p>After performing a thorough inspection of the property, the follow concerns should be addressed: professional seal up of the home will aid in long term prevention of nuisance wildlife. </p>
                    <p>Evidence may include the scent of urine, urine stains, fecal matter, trailing and tunneling, nesting and gnawing. </p>
                    <p>A trapping regimen is recommended to commence immediately to controll the rodent population. A designated technician will set up a schedule to check the traps with you. This service also includes the removal of any animals caugh and the addition of more traps if necessary.</p>
                ',
            ],
            [
                'name'        => 'Mice',
                'sort_order'  => 7,
                'description' => '
                    <p>After performing a thorough inspection of the property, the follow concerns should be addressed: professional seal up of the home will aid in long term prevention of nuisance wildlife. </p>
                    <p>Evidence may include the scent of urine, urine stains, fecal matter, trailing and tunneling, nesting and gnawing. </p>
                    <p>A trapping regimen is recommended to commence immediately to controll the rodent population. A designated technician will set up a schedule to check the traps with you. This service also includes the removal of any animals caugh and the addition of more traps if necessary.</p>
                ',
            ],
            [
                'name'        => 'Pack Rat',
                'sort_order'  => 8,
                'description' => '
                    <p>After performing a thorough inspection of the property, the follow concerns should be addressed: professional seal up of the home will aid in long term prevention of nuisance wildlife. </p>
                    <p>Evidence may include the scent of urine, urine stains, fecal matter, trailing and tunneling, nesting and gnawing. </p>
                    <p>A trapping regimen is recommended to commence immediately to controll the rodent population. A designated technician will set up a schedule to check the traps with you. This service also includes the removal of any animals caugh and the addition of more traps if necessary.</p>
                ',
            ],
            [
                'name'        => 'Pigeons/Birds',
                'sort_order'  => 9,
                'description' => '
                    <u>Structural Impacts</u>
                    <p>Bird occupation on buildings presents a variety of concerns for the homeowner. Apart from being unsightly streaking down a wall or piling up on sidewalks below, bird excrement contains acids which can eat away at tar-based roofing membranes when they accumulate- especially here in Arizona where pigeons seek shade under solar panels to nest and raise young. Nests built on top of vents and chimneys obstruct air flow and have even lead to carbon monoxide poisoning. The dried droppings, feathers and twigs that make up those nests act as kindling for electrical fires. Here in southern Arizona this danger is most likely on flat roofs where pigeons choose to congregate under air conditioning units.
                    </p>
                    <u>Disease implications</u>
                    <p>
                    Pigeons are known carriers of several diseases, the two most common being cryptococcosis and histoplasmosis. Cryptococcosis is spread via their droppings and causes mild pulmonary infections. If left untreated, the illness spreads through the rest of the body and eventually attacks the central nervous system. Early symptoms of the disease include bumps that resemble acne or ulcers just below the surface of the skin.
                    </p>
                    <p>Histoplasmosis causes flu-like symptoms such as high fever, and severe cases can lead to pneumonia or even death. Pigeon droppings cultivate the growth of the fungus that causes the disease. People then inhale the spores into their lungs and get infected. Pigeons can also carry psittacosis and toxoplasmosis, though reported cases are rare."
                    </p>
                ',
            ],
            [
                'name'        => 'Pocket Gopher',
                'sort_order'  => 10,
                'description' => '
                    <p>After performing a thorough inspection of the property, the follow concerns should be addressed: professional seal up of the home will aid in long term prevention of nuisance wildlife. </p>
                    <p>Evidence may include the scent of urine, urine stains, fecal matter, trailing and tunneling, nesting and gnawing. </p>
                    <p>A trapping regimen is recommended to commence immediately to controll the rodent population. A designated technician will set up a schedule to check the traps with you. This service also includes the removal of any animals caugh and the addition of more traps if necessary.</p>
                ',
            ],
            [
                'name'        => 'Raccoon',
                'sort_order'  => 11,
                'description' => '
                    <p>Evidence may include the scent of urine, urine stains, fecal matter, trailing and tunneling, nesting, and gnawing. It is important to note that these animals tend to damage electrical wiring and HVAC duct work and is considered a very real threat when raccoons nest in attics. Raccoons are also known for transmitting diseases such as rabies and dropping parasites such as Raccoon Roundworm. We encourage the homeowner to stay away from any raccoons they may see around their home, and to not interact with any of the areas where these animals may have contaminated.</p>
                    <p>A wildlife removal program is recommended to commence immediately to remove the raccoons from the home. A designated technician will set up a one-way door, deterrents, or traps to remove the animals from the home and provide the necessary wildlife relief. A schedule to inspect the one-way door, reapply deterrents, or check the traps will be communicated with you. This service also includes the removal of any animals caught and the addition of more traps if necessary, to ensure the problem has been solved.</p>
                    <p>It is also recommended that we perform a cleanup service and a sanitizing treatment to reduce the harmful elements of contamination left by these animals, as well as reducing the lingering pheromones that may attract other animals. An ectoparasite treatment may also be needed to address parasites that used these animals as a host.</p>
                ',
            ],
            [
                'name'        => 'Ringtail',
                'sort_order'  => 12,
                'description' => '
                    <p>After performing a thorough inspection of the property, the follow concerns should be addressed: professional seal up of the home will aid in long term prevention of nuisance wildlife. </p>
                    <p>Evidence may include the scent of urine, urine stains, fecal matter, trailing and tunneling, nesting and gnawing. </p>
                    <p>A trapping regimen is recommended to commence immediately to controll the rodent population. A designated technician will set up a schedule to check the traps with you. This service also includes the removal of any animals caugh and the addition of more traps if necessary.</p>
                ',
            ],
            [
                'name'        => 'Rock/Ground Squirrel',
                'sort_order'  => 13,
                'description' => '
                    <p>After performing a thorough inspection of the property, the follow concerns should be addressed: professional seal up of the home will aid in long term prevention of nuisance wildlife. </p>
                    <p>Evidence may include the scent of urine, urine stains, fecal matter, trailing and tunneling, nesting and gnawing. </p>
                    <p>A trapping regimen is recommended to commence immediately to controll the rodent population. A designated technician will set up a schedule to check the traps with you. This service also includes the removal of any animals caugh and the addition of more traps if necessary.</p>
                ',
            ],
            [
                'name'        => 'Skunk spp.',
                'sort_order'  => 14,
                'description' => '
                    <p>After performing a thorough inspection of the property, the follow concerns should be addressed: professional seal up of the home will aid in long term prevention of nuisance wildlife. </p>
                    <p>Evidence may include the scent of urine, urine stains, fecal matter, trailing and tunneling, nesting and gnawing. </p>
                    <p>A trapping regimen is recommended to commence immediately to controll the rodent population. A designated technician will set up a schedule to check the traps with you. This service also includes the removal of any animals caugh and the addition of more traps if necessary.</p>
                ',
            ],
            [
                'name'        => 'Venomous Snakes',
                'sort_order'  => 15,
                'description' => '
                    <p>After performing a thorough inspection of the property, the follow concerns should be addressed: professional seal up of the home will aid in long term prevention of nuisance wildlife. </p>
                    <p>Evidence may include the scent of urine, urine stains, fecal matter, trailing and tunneling, nesting and gnawing. </p>
                    <p>A trapping regimen is recommended to commence immediately to controll the rodent population. A designated technician will set up a schedule to check the traps with you. This service also includes the removal of any animals caugh and the addition of more traps if necessary.</p>
                ',
            ],
            [
                'name'        => 'White-nosed Coati',
                'sort_order'  => 16,
                'description' => '
                    <p>After performing a thorough inspection of the property, the follow concerns should be addressed: professional seal up of the home will aid in long term prevention of nuisance wildlife. </p>
                    <p>Evidence may include the scent of urine, urine stains, fecal matter, trailing and tunneling, nesting and gnawing. </p>
                    <p>A trapping regimen is recommended to commence immediately to controll the rodent population. A designated technician will set up a schedule to check the traps with you. This service also includes the removal of any animals caugh and the addition of more traps if necessary.</p>
                ',
            ],
            [
                'name'        => 'Additional Services',
                'sort_order'  => 17,
                'description' => '',
            ]
        ];
        foreach( $data as $i => $row ) {
            $row[ 'sort_order' ] = ++$i;
            $row[ 'slug' ] = Str::slug( $row[ 'name' ] );
            Specie::create( $row );
        }
    }
}
