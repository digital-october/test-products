<?php

namespace Database\Seeders;

use App\Models\Movement;
use DateTime;
use Illuminate\Database\Seeder;

class MovementSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $path = __DIR__ . '/../files/fertiliser_inventory_movements.csv';
        $csv = array_map('str_getcsv', file($path));

        $data = [];
        $keys = [];
        $now = now();

        /**
         * Since the source file is small, we can do everything at once in a loop and in one request.
         * When we increase the source file, we will need to break it into chunks.
         * With very large data, it will be possible to wrap this logic in a queue.
         */
        foreach ($csv as $index => $item) {
            if ($index === 0) {
                $keys = array_flip($item);
                continue;
            }

            $date = DateTime::createFromFormat('d/m/Y', $item[$keys['Date']]);
            $price = $item[$keys['Unit Price']];
            $price = ($price !== '') ? (float)$price : null;

            $tmp['date'] = $date;
            $tmp['type'] = $item[$keys['Type']];
            $tmp['quantity'] = (int)$item[$keys['Quantity']];
            $tmp['price'] = $price;
            $tmp['created_at'] = $now;
            $tmp['updated_at'] = $now;

            $data[] = $tmp;
        }

        Movement::insert($data);
    }
}
