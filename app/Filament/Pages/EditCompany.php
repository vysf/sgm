<?php

namespace App\Filament\Pages;

use Exception;
use App\Models\Company;
use Filament\Forms\Form;
use Filament\Pages\Page;
use Filament\Actions\Action;
use Filament\Forms\Components\Grid;
use Filament\Forms\Components\Select;
use Filament\Support\Exceptions\Halt;
use Filament\Forms\Components\Section;
use Filament\Forms\Contracts\HasForms;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Concerns\InteractsWithForms;

class EditCompany extends Page implements HasForms
{
    use InteractsWithForms;

    public ?array $data = [];

    protected static ?string $model = Company::class;

    protected static ?string $navigationIcon = 'heroicon-o-document-text';
    protected static ?string $navigationLabel = 'Company';
    protected static string $view = 'filament.pages.edit-company';

    public function mount() {
        $company = auth()->user()->company;
        $data = [
            'aboutUs' => $company->aboutUs ? $company->aboutUs->attributesToArray() : [],
            'keyFeatures' => $company->keyFeatures->toArray(),
            'commitment' => $company->commitment ? $company->commitment->attributesToArray() : [],
            'contact' => $company->contact ? $company->contact->attributesToArray() : [],
            'socialMedias' => $company->socialMedias->toArray(),
        ];
        
        $this->form->fill($data);
    }

    public function form(Form $form): Form
    {
        return $form
            ->schema([
                // Grid untuk About Us dan Contact, dua kolom di desktop, satu kolom di mobile
                Section::make('About Us and Contact')
                    ->schema([
                        Grid::make([
                                'lg' => 2, // 2 kolom pada ukuran besar (desktop)
                                'md' => 1, // 1 kolom pada ukuran medium (tablet)
                                'sm' => 1, // 1 kolom pada ukuran kecil (mobile)
                            ])  // 2 kolom di desktop
                            ->schema([
                                Section::make('About Us')
                                    ->schema([
                                        TextInput::make('aboutUs.title')
                                            ->label('Judul')
                                            ->required(),
                                        RichEditor::make('aboutUs.description')
                                            ->label('Deskripsi')
                                            ->required()
                                    ])
                                    ->columnSpan(1), // Section About Us mengambil 1 kolom

                                Section::make('Contact')
                                    ->schema([
                                        TextInput::make('contact.phone')
                                            ->label('Telepon')
                                            ->required()
                                            ->tel(),
                                        TextInput::make('contact.email')
                                            ->label('Email')
                                            ->required()
                                            ->email(),
                                        TextInput::make('contact.address')
                                            ->label('Alamat')
                                            ->required()
                                    ])
                                    ->columnSpan(1) // Section Contact mengambil 1 kolom
                            ])
                        ]),
                // Section lainnya tetap satu kolom
                Section::make('Key Features')
                    ->schema([
                        Repeater::make('keyFeatures')
                            ->schema([
                                TextInput::make('title')
                                    ->label('Judul')
                                    ->required(),
                                TextInput::make('icon')
                                    ->label('Icon')
                                    ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'Salin class <i class="bi bi-activity"></i> (ambil "bi bi-activity" saja)bootstrap icon. see: icons.getbootstrap.com')
                                    ->required(),
                                RichEditor::make('description')
                                    ->label('Deskripsi')
                            ])
                    ]),

                Section::make('Commitments')
                    ->schema([
                        TextInput::make('commitment.title')
                            ->label('Judul')
                            ->required(),
                        RichEditor::make('commitment.description')
                            ->label('Deskripsi')
                            ->required(),
                        Repeater::make('commitment.commitment_list')
                            ->label('Commitment List')
                            ->schema([
                                TextInput::make('icon')
                                    ->label('Icon')
                                    ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'Salin class <i class="bi bi-activity"></i> (ambil "bi bi-activity" saja)bootstrap icon. see: icons.getbootstrap.com')
                                    ->required(),
                                TextInput::make('title')
                                    ->label('Judul')
                                    ->required(),
                                TextInput::make('description')
                                    ->label('Deskripsi')
                                    ->required()
                            ])
                    ]),

                Section::make('Social Media')
                    ->schema([
                        Repeater::make('socialMedias')
                            ->schema([
                                TextInput::make('name')
                                    ->label('Nama')
                                    ->required(),
                                TextInput::make('icon')
                                    ->label('Icon')
                                    ->hintIcon('heroicon-m-question-mark-circle', tooltip: 'Salin class <i class="bi bi-activity"></i> (ambil "bi bi-activity" saja)bootstrap icon. see: icons.getbootstrap.com')
                                    ->required(),
                                TextInput::make('url')
                                    ->label('Url')
                                    ->url()
                                    ->suffixIcon('heroicon-m-globe-alt')
                                    ->required()
                            ])
                    ])
            ])
            ->statePath('data');
    }

    protected function getFormActions(): array
    {
        return [
            Action::make('save')
                ->label(__('filament-panels::resources/pages/edit-record.form.actions.save.label'))
                ->submit('save'),
        ];
    }

    public function save() {
        try {
            $data = $this->form->getState();
            // Cek apakah formState adalah stdClass
            // if ($data instanceof \stdClass) {
            //     // Konversi menjadi array
            //     $data = json_decode(json_encode($data), true);
            // }
    
            $company = auth()->user()->company;
    
            // Menyimpan data perusahaan
            $company->update($data);
    
            // Menyimpan relasi-relasi terkait
            if (!empty($data['aboutUs'])) {
                $company->aboutUs()->updateOrCreate([], $data['aboutUs']);
            }
    
            // Untuk key features (relasi one-to-many)
            $company->keyFeatures()->delete(); // Menghapus data lama
            foreach ($data['keyFeatures'] as $keyFeature) {
                $company->keyFeatures()->create($keyFeature);
            }
    
            // Untuk commitment (relasi one-to-one)
            if (!empty($data['commitment'])) {
                $company->commitment()->updateOrCreate([], $data['commitment']);
            }
    
            // Untuk contact (relasi one-to-one)
            if (!empty($data['contact'])) {
                $company->contact()->updateOrCreate([], $data['contact']);
            }
    
            // Untuk social medias (relasi one-to-many)
            $company->socialMedias()->delete(); // Menghapus data lama
            foreach ($data['socialMedias'] as $socialMedia) {
                $company->socialMedias()->create($socialMedia);
            }
    
            Notification::make()
                ->success()
                ->title(__('filament-panels::resources/pages/edit-record.notifications.saved.title'))
                ->send();
        } catch (Exception $exception) {
            Notification::make()
                ->danger()
                ->title(__('An error occurred while saving data!'))
                ->send();
        }
    }
}

// // AOUT US
// App\Models\AboutUs::create([
//     'company_id' => 1,
//     'title' => 'Unleashing Potential with Creative Strategy',
//     'description' => '<p class="fst-italic">Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p><ul><li><i class="bi bi-check-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat.</span></li><li><i class="bi bi-check-circle"></i> <span>Duis aute irure dolor in reprehenderit in voluptate velit.</span></li><li><i class="bi bi-check-circle"></i> <span>Ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate trideta storacalaperda mastiro dolore eu fugiat nulla pariatur.</span></li></ul>'
// ]);

// // KEY FEATURES
// App\Models\KeyFeature::create([
//     'company_id' => 1,
//     'title' => 'Nesciunt Mete',
//     'description' => 'Provident nihil minus qui consequatur non omnis maiores. Eos accusantium minus dolores iure perferendis tempore et consequatur.',
//     'icon' => '<i class="bi bi-activity"></i>'
// ]);

// App\Models\KeyFeature::create([
//     'company_id' => 1,
//     'title' => 'Eosle Commodi',
//     'description' => 'Ut autem aut autem non a. Sint sint sit facilis nam iusto sint. Libero corrupti neque eum hic non ut nesciunt dolorem.',
//     'icon' => '<i class="bi bi-broadcast"></i>'
// ]);
// App\Models\KeyFeature::create([
//     'company_id' => 1,
//     'title' => 'Ledo Markt',
//     'description' => 'Ut excepturi voluptatem nisi sed. Quidem fuga consequatur. Minus ea aut. Vel qui id voluptas adipisci eos earum corrupti.',
//     'icon' => '<i class="bi bi-easel"></i>'
// ]);
// App\Models\KeyFeature::create([
//     'company_id' => 1,
//     'title' => 'Asperiores Commodit',
//     'description' => 'Non et temporibus minus omnis sed dolor esse consequatur. Cupiditate sed error ea fuga sit provident adipisci neque.',
//     'icon' => '<i class="bi bi-bounding-box-circles"></i>'
// ]);
// App\Models\KeyFeature::create([
//     'company_id' => 1,
//     'title' => 'Velit Doloremque',
//     'description' => 'Cumque et suscipit saepe. Est maiores autem enim facilis ut aut ipsam corporis aut. Sed animi at autem alias eius labore.',
//     'icon' => '<i class="bi bi-calendar4-week"></i>'
// ]);
// App\Models\KeyFeature::create([
//     'company_id' => 1,
//     'title' => 'Dolori Architecto',
//     'description' => 'Hic molestias ea quibusdam eos. Fugiat enim doloremque aut neque non et debitis iure. Corrupti recusandae ducimus enim.',
//     'icon' => '<i class="bi bi-chat-square-text"></i>'
// ]);


// COMMITMENTS
// add new attribute: commitment_list, buat jadi repeater
// App\Models\Commitment::create([
//     'company_id' => 1,
//     'title' => 'Enim quis est voluptatibus aliquid consequatur fugiat',
//     'description' => 'Esse voluptas cumque vel exercitationem. Reiciendis est hic accusamus. Non ipsam et sed minima temporibus laudantium. Soluta voluptate sed facere corporis dolores excepturi',
//     'commitment_list' => json_encode([
//         [
//             'icon' => '<i class="bi bi-easel flex-shrink-0"></i>',
//             'title' => 'Lorem Ipsum',
//             'description' => 'Voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditate non provident'
//         ],
//         [
//             'icon' => '<i class="bi bi-patch-check flex-shrink-0"></i>',
//             'title' => 'Nemo Enim',
//             'description' => 'At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque'
//         ],
//         [
//             'icon' => '<i class="bi bi-brightness-high flex-shrink-0"></i>',
//             'title' => 'Dine Pad',
//             'description' => 'Explicabo est voluptatum asperiores consequatur magnam. Et veritatis odit. Sunt aut deserunt minus aut eligendi omnis'
//         ],
//         [
//             'icon' => '<i class="bi bi-brightness-high flex-shrink-0"></i>',
//             'title' => 'Tride clov',
//             'description' => 'Est voluptatem labore deleniti quis a delectus et. Saepe dolorem libero sit non aspernatur odit amet. Et eligendi'
//         ],
//     ])
// ]);

// App\Models\Contact::create([
//     'company_id' => 1,
//     'phone' => '+1 5589 55488 55',
//     'email' => 'info@example.com',
//     'address' => 'A108 Adam Street, New York, NY 535022'
// ]);


// // modify attribute from description to url
// App\Models\SocialMedia::create([
//     'company_id' => 1,
//     'name' => 'twitter',
//     'url' => 'http://127.0.0.1:8000/',
//     'icon' => '<i class="bi bi-twitter-x"></i>'
// ]);
// App\Models\SocialMedia::create([
//     'company_id' => 1,
//     'name' => 'facebook',
//     'url' => 'http://127.0.0.1:8000/',
//     'icon' => '<i class="bi bi-facebook"></i>'
// ]);
// App\Models\SocialMedia::create([
//     'company_id' => 1,
//     'name' => 'instagram',
//     'url' => 'http://127.0.0.1:8000/',
//     'icon' => '<i class="bi bi-instagram"></i>'
// ]);
// App\Models\SocialMedia::create([
//     'company_id' => 1,
//     'name' => 'linkedin',
//     'url' => 'http://127.0.0.1:8000/',
//     'icon' => '<i class="bi bi-linkedin"></i>'
// ]);
