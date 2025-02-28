<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\AboutUs;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Company;
use App\Models\Contact;
use App\Models\Commitment;
use App\Models\KeyFeature;
use App\Models\SocialMedia;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $user = User::factory()->create([
            'name' => 'Admin',
            'email' => 'cvsinargrahamitra@gmail.com',
        ]);

        if ($user) {
            // Buat company baru untuk user yang ditemukan
            $company = Company::create([
                'user_id' => $user->id,
                // Anda bisa menambahkan field lain sesuai kebutuhan, misalnya:
                // 'name' => 'Company Example', // Misalnya untuk nama perusahaan
            ]);
        } else {
            // Jika user dengan id tersebut tidak ditemukan
            echo "User dengan ID 1 tidak ditemukan.\n";
        }

        AboutUs::create([
            'company_id' => $company->id,
            'title' => 'Unleashing Potential with Creative Strategy',
            'description' => '<p class="fst-italic">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><ul><li><i class="bi bi-check-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li><li><i class="bi bi-check-circle"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li><li><i class="bi bi-check-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li></ul>'
        ]);

        // KEY FEATURES
        KeyFeature::create([
            'company_id' => $company->id,
            'title' => 'Nesciunt Mete',
            'description' => 'Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure perferendis tempore et consequatur.',
            'icon' => '<i class="bi bi-activity"></i>'
        ]);

        KeyFeature::create([
            'company_id' => $company->id,
            'title' => 'Eosle Commodi',
            'description' => 'Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non ut nesciunt dolorem.',
            'icon' => '<i class="bi bi-broadcast"></i>'
        ]);
        KeyFeature::create([
            'company_id' => $company->id,
            'title' => 'Ledo Markt',
            'description' => 'Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos earum corrupti.',
            'icon' => '<i class="bi bi-easel"></i>'
        ]);
        KeyFeature::create([
            'company_id' => $company->id,
            'title' => 'Asperiores Commodit',
            'description' => 'Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga sit provident adipisci neque.',
            'icon' => '<i class="bi bi-bounding-box-circles"></i>'
        ]);
        KeyFeature::create([
            'company_id' => $company->id,
            'title' => 'Velit Doloremque',
            'description' => 'Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed animi at autem alias eius labore.',
            'icon' => '<i class="bi bi-calendar4-week"></i>'
        ]);
        KeyFeature::create([
            'company_id' => $company->id,
            'title' => 'Dolori Architecto',
            'description' => 'Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure. Corrupti recusandae ducimus enim.',
            'icon' => '<i class="bi bi-chat-square-text"></i>'
        ]);


        // COMMITMENTS
        // add new attribute: commitment_list, buat jadi repeater
        Commitment::create([
            'company_id' => $company->id,
            'title' => 'Enim quis est voluptatibus aliquid consequatur fugiat',
            'description' => 'Esse voluptas cumque vel exercitationem. Reiciendis est hic accusamus. Non ipsam et sed minima temporibus laudantium. Soluta voluptate sed facere corporis dolores excepturi',
            'commitment_list' => [
                [
                    'icon' => '<i class="bi bi-easel flex-shrink-0"></i>',
                    'title' => 'Lorem Ipsum',
                    'description' => 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident'
                ],
                [
                    'icon' => '<i class="bi bi-patch-check flex-shrink-0"></i>',
                    'title' => 'Nemo Enim',
                    'description' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque'
                ],
                [
                    'icon' => '<i class="bi bi-brightness-high flex-shrink-0"></i>',
                    'title' => 'Dine Pad',
                    'description' => 'Explicabo est voluptatum asperiores consequatur magnam. Et veritatis odit. Sunt aut deserunt minus aut eligendi omnis'
                ],
                [
                    'icon' => '<i class="bi bi-brightness-high flex-shrink-0"></i>',
                    'title' => 'Tride clov',
                    'description' => 'Est voluptatem labore deleniti quis a delectus et. Saepe dolorem libero sit non aspernatur odit amet. Et eligendi'
                ],
            ]
        ]);

        Contact::create([
            'company_id' => $company->id,
            'phone' => '+1 5589 55488 55',
            'email' => 'info@example.com',
            'address' => 'A108 Adam Street, New York, NY 535022'
        ]);


        // modify attribute from description to url
        SocialMedia::create([
            'company_id' => $company->id,
            'name' => 'twitter',
            'url' => 'http://127.0.0.1:8000/',
            'icon' => '<i class="bi bi-twitter-x"></i>'
        ]);
        SocialMedia::create([
            'company_id' => $company->id,
            'name' => 'facebook',
            'url' => 'http://127.0.0.1:8000/',
            'icon' => '<i class="bi bi-facebook"></i>'
        ]);
        SocialMedia::create([
            'company_id' => $company->id,
            'name' => 'instagram',
            'url' => 'http://127.0.0.1:8000/',
            'icon' => '<i class="bi bi-instagram"></i>'
        ]);
        SocialMedia::create([
            'company_id' => $company->id,
            'name' => 'linkedin',
            'url' => 'http://127.0.0.1:8000/',
            'icon' => '<i class="bi bi-linkedin"></i>'
        ]);
    }
}
