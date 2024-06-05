<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Shop;
use App\Http\Requests\CsvImportRequest;
use Illuminate\Support\Facades\Validator;

class ShopController extends Controller
{
    public function importPage()
    {
        return view('admin/import');
    }

    public function csvImport(CsvImportRequest $request)
    {
        $file = $request->file('csvFile');
        $path = $file->getRealPath();
        $fp = fopen($path, 'r');
        fgetcsv($fp);

        while (($csvData = fgetcsv($fp)) !== FALSE) {
            $this->validateCsvRow($csvData);
            $this->insertCsvData($csvData);
        }
        fclose($fp);
        return redirect('admin/import')->with('flash-message', '店舗を作成しました');
    }

    protected function validateCsvRow($csvData)
    {
        $validator = Validator::make([
            'shop_area_id' => $csvData[0],
            'shop_genre_id' => $csvData[1],
            'manager_id' => $csvData[2],
            'shop_name' => $csvData[3],
            'image_path' => $csvData[4],
            'shop_description' => $csvData[5],
        ], [
            'shop_area_id' => 'required',
            'shop_genre_id' => 'required',
            'manager_id' => 'required',
            'shop_name' => 'required|string|max:50',
            'image_path' => 'required|url|ends_with:jpeg,jpg,png',
            'shop_description' => 'required|string|max:400',
        ], [
            'shop_area_id.required' => 'エリアを入力してください',
            'shop_genre_id.required' => 'ジャンルを入力してください',
            'manager_id.required' => '店舗代表者IDを入力してください',
            'shop_name.required' => '店名を入力してください',
            'shop_name.string' => '店名を文字列で入力してください',
            'shop_name.max' => '店名を50文字以下で入力してください',
            'image_path.required' => '画像URLを入力してください',
            'image_path.url' => '画像URLを入力してください',
            'image_path.ends_with' => 'jpegまたはpng形式の画像URLを入力してください',
            'shop_description.required' => '説明を入力してください',
            'shop_description.string' => '説明を文字列で入力してください',
            'shop_description.max' => '説明を400文字以下で入力してください',
        ]);

        if ($validator->fails()) {
            throw new \Illuminate\Validation\ValidationException($validator);
        }
    }

    public function insertCsvData($csvData)
    {
        $shop = new Shop;
        $shop->shop_area_id = $csvData[0];
        $shop->shop_genre_id = $csvData[1];
        $shop->manager_id = $csvData[2];
        $shop->shop_name = $csvData[3];
        $shop->image_path = $csvData[4];
        $shop->shop_description = $csvData[5];
        $shop->save();
    }
}
