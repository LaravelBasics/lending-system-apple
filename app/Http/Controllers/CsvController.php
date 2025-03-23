<?php

namespace App\Http\Controllers;

use App\Models\Lending;
use Illuminate\Http\Request;
use App\Http\Requests\SearchRequest;
// use Symfony\Component\HttpFoundation\StreamedResponse; // データをストリームとして出力するために使用

class CsvController extends Controller
{
    public function export(SearchRequest $request)
    {
        $fileName = 'lendings.csv'; // ダウンロードされるCSVのファイル名；
        $headers = [
            "Content-Type" => "text/csv", // レスポンスのコンテンツタイプをCSVファイルに設定します。
            "Content-Disposition" => "attachment; filename=$fileName", // レスポンスをファイルとしてダウンロードさせる指示です。$fileNameはファイル名を指定します。
        ];

        // セッションから検索条件を取得
        $searchCondition = $request->session()->get('search_condition', []);
        $checkboxValue = session('search_checkbox', 0); // 未返却のチェックボックスの値

        // クエリの作成
        $query = Lending::query();

        if ($searchCondition) {
            $query->when($searchCondition['name_search'] ?? null, function ($q, $name) {
                $q->where('name', 'like', '%' . $name . '%');
            })
                ->when($searchCondition['item_name_search'] ?? null, function ($q, $item) {
                    $q->where('item_name', 'like', '%' . $item . '%');
                })
                ->when($searchCondition['lend_date_search'] ?? null, function ($q, $lendDate) {
                    if (preg_match('/^\d{4}$/', $lendDate)) {
                        $q->whereBetween('lend_date', [$lendDate . '-01-01', $lendDate . '-12-31']);
                    } elseif (preg_match('/^\d{4}-\d{2}$/', $lendDate)) {
                        $startDate = $lendDate . '-01';
                        $endDate = date('Y-m-t', strtotime($startDate));
                        $q->whereBetween('lend_date', [$startDate, $endDate]);
                    } elseif (preg_match('/^\d{4}-\d{2}-\d{2}$/', $lendDate)) {
                        $q->where('lend_date', $lendDate);
                    }
                })
                ->when($checkboxValue == 1, function ($q) {
                    $q->whereNull('return_date');
                })
                ->when($searchCondition['return_date_search'] ?? null, function ($q, $returnDate) {
                    if (preg_match('/^\d{4}$/', $returnDate)) {
                        $q->whereBetween('return_date', [$returnDate . '-01-01', $returnDate . '-12-31']);
                    } elseif (preg_match('/^\d{4}-\d{2}$/', $returnDate)) {
                        $startDate = $returnDate . '-01';
                        $endDate = date('Y-m-t', strtotime($startDate));
                        $q->whereBetween('return_date', [$startDate, $endDate]);
                    } elseif (preg_match('/^\d{4}-\d{2}-\d{2}$/', $returnDate)) {
                        $q->where('return_date', $returnDate);
                    }
                });
        }

        // 検索結果を取得
        $lendings = $query->orderBy('id', 'desc')->get();

        // CSVデータを出力するための無名関数（クロージャ）を作成しています。この関数内で、実際にCSVデータをファイルに書き込む処理を行います。
        $callback = function () use ($lendings) {
            $file = fopen('php://output', 'w'); //  PHPのストリームを使って直接ブラウザにデータを出力するために使用します。wは書き込みモードで開くことを意味

            // UTF-8のBOMを削除して、Shift_JISで出力
            fputcsv($file, [ // $fileにCSV形式でデータを書き込みます。最初にヘッダー行（カラム名）を出力
                mb_convert_encoding('ID', 'SJIS-WIN', 'UTF-8'), // mb_convert_encoding() は、文字列をUTF-8からShift_JIS（SJIS-WIN）に変換。Excel文字化け対策
                mb_convert_encoding('名前', 'SJIS-WIN', 'UTF-8'),
                mb_convert_encoding('品名', 'SJIS-WIN', 'UTF-8'),
                mb_convert_encoding('貸出日', 'SJIS-WIN', 'UTF-8'),
                mb_convert_encoding('返却日', 'SJIS-WIN', 'UTF-8'),
            ]);

            // ヘッダー行をShift_JISに変換して出力
            // fputcsv($file, ['ID', '名前', '品名', '貸出日', '返却日']);

            foreach ($lendings as $lending) {
                fputcsv($file, [
                    mb_convert_encoding($lending->id, 'SJIS-WIN', 'UTF-8'),
                    mb_convert_encoding($lending->name, 'SJIS-WIN', 'UTF-8'),
                    mb_convert_encoding($lending->item_name, 'SJIS-WIN', 'UTF-8'),
                    mb_convert_encoding($lending->lend_date, 'SJIS-WIN', 'UTF-8'),
                    mb_convert_encoding($lending->return_date, 'SJIS-WIN', 'UTF-8'),
                ]);
            }

            fclose($file); // ファイルの書き込みが終了した後、ファイルを閉じます。
        };

        // ストリームレスポンスとしてCSVファイルを出力します。$callbackを使ってCSVデータを出力し、
        // 200はHTTPステータスコード（正常なレスポンス）、$headersはファイルダウンロード用のヘッダーを設定
        return response()->stream($callback, 200, $headers);
    }
}
