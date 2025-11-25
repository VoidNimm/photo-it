<?php

namespace App\Filament\Resources\Settings\Pages;

use App\Filament\Resources\Settings\SettingsResource;
use App\Models\Setting;
use Filament\Actions\Action;
use Filament\Resources\Pages\ManageRecords;
use Illuminate\Support\Facades\Cache;

class ManageSettings extends ManageRecords
{
    protected static string $resource = SettingsResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Action::make('edit')
                ->label('Edit Settings')
                ->icon('heroicon-o-pencil')
                ->form(\App\Filament\Resources\Settings\Schemas\SettingsForm::getComponents(...))
                ->fillForm(function () {
                    return [
                        'navbar_logo_text' => Setting::get('navbar_logo_text', 'Photo It'),
                        'navbar_logo_image' => Setting::get('navbar_logo_image'),
                        'navbar_menu_items' => Setting::get('navbar_menu_items', [
                            [
                                'label' => 'Home',
                                'url' => '/',
                                'order' => 1,
                                'target' => '_self',
                            ],
                            [
                                'label' => 'About',
                                'url' => '/about',
                                'order' => 2,
                                'target' => '_self',
                            ],
                            [
                                'label' => 'Gallery',
                                'url' => '/gallery',
                                'order' => 3,
                                'target' => '_self',
                            ],
                            [
                                'label' => 'Services',
                                'url' => '/services',
                                'order' => 4,
                                'target' => '_self',
                            ],
                            [
                                'label' => 'Contact',
                                'url' => '/contact',
                                'order' => 5,
                                'target' => '_self',
                            ],
                        ]),
                        'navbar_facebook' => Setting::get('navbar_facebook'),
                        'navbar_twitter' => Setting::get('navbar_twitter'),
                        'navbar_instagram' => Setting::get('navbar_instagram'),
                        'navbar_linkedin' => Setting::get('navbar_linkedin'),
                        'footer_copyright' => Setting::get('footer_copyright', '© Copyright Photo It All Rights Reserved'),
                        'footer_credits' => Setting::get('footer_credits', 'Designed by BootstrapMade'),
                        'footer_credits_url' => Setting::get('footer_credits_url', 'https://bootstrapmade.com/'),
                        'footer_facebook' => Setting::get('footer_facebook'),
                        'footer_twitter' => Setting::get('footer_twitter'),
                        'footer_instagram' => Setting::get('footer_instagram'),
                        'footer_linkedin' => Setting::get('footer_linkedin'),
                        // About Page Settings
                        'about_page_title' => Setting::get('about_page_title', 'About'),
                        'about_page_subtitle' => Setting::get('about_page_subtitle', 'Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi ratione sint. Sit quaerat ipsum dolorem.'),
                        'about_page_cta_text' => Setting::get('about_page_cta_text', 'Available for Hire'),
                        'about_page_cta_url' => Setting::get('about_page_cta_url', '/contact'),
                        'about_company_image' => Setting::get('about_company_image'),
                        'about_company_title' => Setting::get('about_company_title', 'Professional Photography Company'),
                        'about_company_subtitle' => Setting::get('about_company_subtitle', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'),
                        'about_company_info' => Setting::get('about_company_info', [
                            ['label' => 'Established', 'value' => '2015'],
                            ['label' => 'Location', 'value' => 'Jakarta, Indonesia'],
                            ['label' => 'Team Size', 'value' => '50+ Members'],
                            ['label' => 'Projects Completed', 'value' => '500+'],
                        ]),
                        'about_company_description_1' => Setting::get('about_company_description_1', 'Officiis eligendi itaque labore et dolorum mollitia officiis optio vero. Quisquam sunt adipisci omnis et ut. Nulla accusantium dolor incidunt officia tempore. Et eius omnis. Cupiditate ut dicta maxime officiis quidem quia. Sed et consectetur qui quia repellendus itaque neque. Aliquid amet quidem ut quaerat cupiditate. Ab et eum qui repellendus omnis culpa magni laudantium dolores.'),
                        'about_company_description_2' => Setting::get('about_company_description_2', 'Recusandae est praesentium consequatur eos voluptatem. Vitae dolores aliquam itaque odio nihil. Neque ut neque ut quae voluptas. Maxime corporis aut ut ipsum consequatur. Repudiandae sunt sequi minus qui et. Doloribus molestiae officiis. Soluta eligendi fugiat omnis enim. Numquam alias sint possimus eveniet ad. Ratione in earum eum magni totam.'),
                        'about_testimonials_title' => Setting::get('about_testimonials_title', 'Testimonials'),
                        'about_testimonials_subtitle' => Setting::get('about_testimonials_subtitle', 'What they are saying'),
                    ];
                })
                ->action(function (array $data): void {
                    // Save all settings
                    foreach ($data as $key => $value) {
                        if ($value !== null) {
                            Setting::set($key, $value);
                        }
                    }

                    Cache::forget('settings');

                    \Filament\Notifications\Notification::make()
                        ->title('Settings berhasil disimpan')
                        ->success()
                        ->send();
                })
                ->successNotificationTitle('Settings berhasil disimpan'),
        ];
    }
}
