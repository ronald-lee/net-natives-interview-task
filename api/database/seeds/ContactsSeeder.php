<?php

use Illuminate\Database\Seeder;
use App\Contact;

/**
 * ContactsSeeder
 * Seeder Class for seeding the database with sample Contacts
 * @author Ronald Lee <ronald@ronaldlee.co.uk>
 */
class ContactsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('contacts')->delete();
        $json = file_get_contents(storage_path('data/contacts.json'));
        $data = json_decode($json);
        foreach ($data as $contact) {
            Contact::create([
                'name' => $contact->name,
                'email' => $contact->email,
                'location' => $contact->location,
                'primary' => $contact->primary
            ]);
        }
    }
}
