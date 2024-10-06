<?php
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // Duplicate the files
        $this->duplicateFiles();

        // Check if the language already exists
        $languageCode = 'en-new';
        $existingLanguage = DB::table('languages')->where('code', $languageCode)->first();

        if ($existingLanguage) {
            // Update existing language record
            DB::table('languages')->where('code', $languageCode)->update([
                'name' => 'English',
                'file_name' => 'en-new.json',
                'status' => '1',
            ]);
        } else {
            // Insert new language record
            DB::table('languages')->insert([
                'name' => 'English',
                'code' => $languageCode,
                'file_name' => 'en-new.json',
                'status' => '1',
            ]);
        }

        // Insert settings
        $this->seedSettings();
    }

    private function duplicateFiles()
    {
        $sourceFile = resource_path('lang/en.json');
        $destinationFile = resource_path('lang/en-new.json');
        File::copy($sourceFile, $destinationFile);

        $sourceFile = public_path('languages/en.json');
        $destinationFile = public_path('languages/en-new.json');
        File::copy($sourceFile, $destinationFile);

        $sourceFile = public_path('web_languages/en.json');
        $destinationFile = public_path('web_languages/en-new.json');
        File::copy($sourceFile, $destinationFile);
    }

    private function seedSettings()
    {
        DB::table('settings')->insert([
            ['type' => 'company_name', 'data' => 'eBroker'],
            ['type' => 'currency_symbol', 'data' => '$'],
            ['type' => 'ios_version', 'data' => '1.0.0'],
            ['type' => 'default_language', 'data' => 'en-new'],
            ['type' => 'force_update', 'data' => '0'],
            ['type' => 'android_version', 'data' => '1.0.0'],
            ['type' => 'number_with_suffix', 'data' => '0'],
            ['type' => 'maintenance_mode', 'data' => 0],
            ['type' => 'privacy_policy', 'data' => ''],
            ['type' => 'terms_conditions', 'data' => ''],
            ['type' => 'company_tel1', 'data' => ''],
            ['type' => 'company_tel2', 'data' => ''],
            ['type' => 'razorpay_gateway', 'data' => '0'],
            ['type' => 'paystack_gateway', 'data' => '0'],
            ['type' => 'paypal_gateway', 'data' => '0'],
            ['type' => 'system_version', 'data' => '1.1.6'],
            ['type' => 'company_logo', 'data' => 'logo.png'],
            ['type' => 'web_logo', 'data' => 'web_logo.png'],
            ['type' => 'favicon_icon', 'data' => 'favicon.png'],
            ['type' => 'web_footer_logo', 'data' => 'Logo_white.svg'],
            ['type' => 'web_placeholder_logo', 'data' => 'placeholder.svg'],
            ['type' => 'splash_logo', 'data' => 'splash.svg'],
            ['type' => 'app_home_screen', 'data' => 'homeLogo.svg'],
            ['type' => 'placeholder_logo', 'data' => 'placeholder.svg'],
        ]);
    }
}