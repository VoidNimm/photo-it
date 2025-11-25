<?php

namespace App\Filament\Resources\Settings\Schemas;

use App\Models\Setting;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Repeater;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Components\Fieldset;
use Filament\Schemas\Schema;

class SettingsForm
{
    public static function getComponents(): array
    {
        return [
            TextInput::make('navbar_logo_text')
                ->label('Logo Text')
                ->default(fn() => Setting::get('navbar_logo_text', 'Photo It'))
                ->required()
                ->maxLength(255)
                ->helperText('Text yang akan ditampilkan sebagai logo'),

            FileUpload::make('navbar_logo_image')
                ->label('Logo Image (Optional)')
                ->image()
                ->disk('public')
                ->directory('settings')
                ->visibility('public')
                ->maxSize(2048)
                ->helperText('Upload logo image jika ingin menggunakan gambar logo. Kosongkan jika hanya menggunakan text.'),

            Repeater::make('navbar_menu_items')
                ->label('Navbar Items')
                ->schema([
                    TextInput::make('label')
                        ->label('Label Menu')
                        ->required()
                        ->maxLength(255)
                        ->placeholder('Contoh: Home, About, Gallery'),
                    TextInput::make('url')
                        ->label('URL')
                        ->required()
                        ->placeholder('/about atau https://example.com')
                        ->helperText('Gunakan / untuk route internal atau full URL untuk external'),
                    TextInput::make('order')
                        ->label('Urutan')
                        ->numeric()
                        ->default(0)
                        ->required()
                        ->helperText('Angka kecil akan muncul lebih dulu'),
                    TextInput::make('target')
                        ->label('Target')
                        ->default('_self')
                        ->placeholder('_self atau _blank')
                        ->helperText('_self untuk link internal, _blank untuk external (buka tab baru)'),
                ])
                ->defaultItems(1)
                ->collapsible()
                ->itemLabel(fn(array $state): ?string => $state['label'] ?? 'Menu Item')
                ->addActionLabel('Tambah Menu Item')
                ->reorderableWithButtons()
                ->columnSpanFull(),

            TextInput::make('navbar_facebook')
                ->label('Facebook URL (Navbar)')
                ->url()
                ->maxLength(255)
                ->placeholder('https://facebook.com/yourpage'),
            TextInput::make('navbar_twitter')
                ->label('Twitter/X URL (Navbar)')
                ->url()
                ->maxLength(255)
                ->placeholder('https://twitter.com/yourhandle'),
            TextInput::make('navbar_instagram')
                ->label('Instagram URL (Navbar)')
                ->url()
                ->maxLength(255)
                ->placeholder('https://instagram.com/yourhandle'),
            TextInput::make('navbar_linkedin')
                ->label('LinkedIn URL (Navbar)')
                ->url()
                ->maxLength(255)
                ->placeholder('https://linkedin.com/in/yourprofile'),

            Textarea::make('footer_copyright')
                ->label('Copyright Text')
                ->default(fn() => Setting::get('footer_copyright', '© Copyright Photo It All Rights Reserved'))
                ->rows(2)
                ->maxLength(500)
                ->helperText('HTML diperbolehkan, contoh: © Copyright <strong>Photo It</strong> All Rights Reserved')
                ->columnSpanFull(),

            TextInput::make('footer_credits')
                ->label('Credits Text')
                ->default(fn() => Setting::get('footer_credits', 'Designed by BootstrapMade'))
                ->maxLength(255)
                ->helperText('Text untuk credits di footer'),

            TextInput::make('footer_credits_url')
                ->label('Credits URL')
                ->url()
                ->maxLength(255)
                ->placeholder('https://bootstrapmade.com/')
                ->helperText('URL untuk credits link'),

            TextInput::make('footer_facebook')
                ->label('Facebook URL (Footer)')
                ->url()
                ->maxLength(255)
                ->placeholder('https://facebook.com/yourpage'),
            TextInput::make('footer_twitter')
                ->label('Twitter/X URL (Footer)')
                ->url()
                ->maxLength(255)
                ->placeholder('https://twitter.com/yourhandle'),
            TextInput::make('footer_instagram')
                ->label('Instagram URL (Footer)')
                ->url()
                ->maxLength(255)
                ->placeholder('https://instagram.com/yourhandle'),
            TextInput::make('footer_linkedin')
                ->label('LinkedIn URL (Footer)')
                ->url()
                ->maxLength(255)
                ->placeholder('https://linkedin.com/in/yourprofile'),

            Fieldset::make('About Page')
                ->schema([
                    // Page Title Section
                    TextInput::make('about_page_title')
                        ->label('Page Title (Heading)')
                        ->default(fn() => Setting::get('about_page_title', 'About'))
                        ->required()
                        ->maxLength(255)
                        ->helperText('Judul utama halaman About'),

                    Textarea::make('about_page_subtitle')
                        ->label('Page Subtitle')
                        ->default(fn() => Setting::get('about_page_subtitle', 'Odio et unde deleniti. Deserunt numquam exercitationem. Officiis quo odio sint voluptas consequatur ut a odio voluptatem. Sit dolorum debitis veritatis natus dolores. Quasi ratione sint. Sit quaerat ipsum dolorem.'))
                        ->rows(3)
                        ->maxLength(500)
                        ->helperText('Subtitle yang muncul di bawah judul'),

                    TextInput::make('about_page_cta_text')
                        ->label('CTA Button Text')
                        ->default(fn() => Setting::get('about_page_cta_text', 'Available for Hire'))
                        ->maxLength(255)
                        ->helperText('Text untuk tombol CTA (kosongkan jika tidak ingin menampilkan tombol)'),

                    TextInput::make('about_page_cta_url')
                        ->label('CTA Button URL')
                        ->default(fn() => Setting::get('about_page_cta_url', '/contact'))
                        ->maxLength(255)
                        ->helperText('URL untuk tombol CTA'),

                    // About Section
                    FileUpload::make('about_company_image')
                        ->label('Company Image')
                        ->image()
                        ->disk('public')
                        ->directory('about')
                        ->visibility('public')
                        ->maxSize(2048)
                        ->helperText('Gambar perusahaan/perusahaan yang akan ditampilkan'),

                    TextInput::make('about_company_title')
                        ->label('Company Title')
                        ->default(fn() => Setting::get('about_company_title', 'Professional Photography Company'))
                        ->required()
                        ->maxLength(255)
                        ->helperText('Judul tentang perusahaan'),

                    Textarea::make('about_company_subtitle')
                        ->label('Company Subtitle')
                        ->default(fn() => Setting::get('about_company_subtitle', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.'))
                        ->rows(3)
                        ->maxLength(500)
                        ->helperText('Subtitle atau tagline perusahaan'),

                    // Company Info (Repeater untuk informasi perusahaan)
                    Repeater::make('about_company_info')
                        ->label('Company Information')
                        ->schema([
                            TextInput::make('label')
                                ->label('Label')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('Contoh: Established, Location, Team Size'),
                            TextInput::make('value')
                                ->label('Value')
                                ->required()
                                ->maxLength(255)
                                ->placeholder('Contoh: 2015, Jakarta, 50+ Members'),
                        ])
                        ->defaultItems(4)
                        ->itemLabel(fn(array $state): ?string => ($state['label'] ?? 'Info Item') . ': ' . ($state['value'] ?? ''))
                        ->addActionLabel('Tambah Info')
                        ->reorderableWithButtons()
                        ->columnSpanFull()
                        ->helperText('Informasi tentang perusahaan (Established, Location, dll)'),

                    // Company Description
                    Textarea::make('about_company_description_1')
                        ->label('Company Description (Paragraph 1)')
                        ->default(fn() => Setting::get('about_company_description_1', 'Officiis eligendi itaque labore et dolorum mollitia officiis optio vero. Quisquam sunt adipisci omnis et ut. Nulla accusantium dolor incidunt officia tempore. Et eius omnis. Cupiditate ut dicta maxime officiis quidem quia. Sed et consectetur qui quia repellendus itaque neque. Aliquid amet quidem ut quaerat cupiditate. Ab et eum qui repellendus omnis culpa magni laudantium dolores.'))
                        ->rows(5)
                        ->maxLength(1000)
                        ->helperText('Paragraf pertama deskripsi perusahaan'),

                    Textarea::make('about_company_description_2')
                        ->label('Company Description (Paragraph 2)')
                        ->default(fn() => Setting::get('about_company_description_2', 'Recusandae est praesentium consequatur eos voluptatem. Vitae dolores aliquam itaque odio nihil. Neque ut neque ut quae voluptas. Maxime corporis aut ut ipsum consequatur. Repudiandae sunt sequi minus qui et. Doloribus molestiae officiis. Soluta eligendi fugiat omnis enim. Numquam alias sint possimus eveniet ad. Ratione in earum eum magni totam.'))
                        ->rows(5)
                        ->maxLength(1000)
                        ->helperText('Paragraf kedua deskripsi perusahaan (opsional)'),

                    // Testimonials Section Title
                    TextInput::make('about_testimonials_title')
                        ->label('Testimonials Section Title')
                        ->default(fn() => Setting::get('about_testimonials_title', 'Testimonials'))
                        ->maxLength(255)
                        ->helperText('Judul section testimonials'),

                    TextInput::make('about_testimonials_subtitle')
                        ->label('Testimonials Section Subtitle')
                        ->default(fn() => Setting::get('about_testimonials_subtitle', 'What they are saying'))
                        ->maxLength(255)
                        ->helperText('Subtitle section testimonials'),
                ])
                ->columns(2)
        ];
    }

    public static function configure(Schema $schema): Schema
    {
        return $schema->components(self::getComponents());
    }
}
