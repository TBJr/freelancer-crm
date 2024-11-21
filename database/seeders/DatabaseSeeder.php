<?php

namespace Database\Seeders;

use App\Models\CreditNote;
use App\Models\Customer;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Item;
use App\Models\Payment;
use App\Models\Project;
use App\Models\Timesheet;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        Customer::factory()->count(10)->create();
        Item::factory()->count(20)->create();
        Invoice::factory()->count(10)->create();
        InvoiceItem::factory()->count(30)->create();
        Expense::factory()->count(15)->create();
        Project::factory()->count(10)->create();
        Timesheet::factory()->count(20)->create();
        Payment::factory()->count(10)->create();
        CreditNote::factory()->count(5)->create();

        // User::factory(10)->create();
//        User::factory()->create([
//            'name' => 'Test User',
//            'email' => 'test@example.com',
//        ]);
    }
}
