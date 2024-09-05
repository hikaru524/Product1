<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;


class Sales extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        //ここに配列で追加、編集するフィールドを入力する
        ]; //$fillable属性を追記

    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /*API-在庫更新 */
    public function updateStock($id)
    {
        $sales = DB::table('sales');
        $sales->insert([
            'product_id' => $id,
            'created_at' => now(),
            'updated_at' => now()
        ]);
    }
}

