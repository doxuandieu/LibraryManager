<?php

namespace Database\Seeders;

use App\Models\BorrowBook;
use App\Models\Invoice;
use App\Models\Publisher;
use App\Models\Receipt;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            StudentSeeder::class,
            AuthorsSeeder::class,
            PublisherSeeder::class,
            CategorySeeder::class,
            BookSeeder::class,
            ReceiptSeeder::class,
            ReceiptDetailSeeder::class,
            AuthorBookSeeder::class,
            BorrowBookSeeder::class,
            BorrowBookDetailSeeder::class,
        ]);
    }
}
