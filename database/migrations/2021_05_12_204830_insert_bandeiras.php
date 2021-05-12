<?php

use Carbon\Carbon;

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

function convert(string $file)
{
    $data = File::get(storage_path($file));
    return base64_encode($data);
}

class InsertBandeiras extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::table('bandeira')->insert([
            [
                'id' => 1,
                'nome' => 'Master Card',
                'imagem' => convert('images/logo-mastercard.png'),
                'created_at' => Carbon::now()
            ],
            [
                'id' => 2,
                'nome' => 'Visa',
                'imagem' => convert('images/logo-visa.png'),
                'created_at' => Carbon::now()
            ],
            [
                'id' => 3,
                'nome' => 'Elo',
                'imagem' => convert('images/logo-elo.png'),
                'created_at' => Carbon::now()
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::table('bandeira')->whereIn('id', [1, 2, 3])->delete();
    }
}
