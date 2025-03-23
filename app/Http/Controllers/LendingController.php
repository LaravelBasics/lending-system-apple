<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\StoreLendingRequest;
use App\Http\Requests\UpdateLendingRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Lending;
use Illuminate\Support\Facades\DB;
use Exception;

class LendingController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(SearchRequest $request)
    {
        $checkboxValue = $request->input('search_checkbox', 0); // デフォルトは 0

        // チェックボックスが選ばれている場合（値が1）
        if ($checkboxValue == 1) {
            session(['search_checkbox' => $checkboxValue]); // セッションに保存
        } else {
            session()->forget('search_checkbox'); // チェックボックスが未選択の場合、セッションの値を削除
        }

        // 検索条件のキーを定義
        $searchKey = ['name_search', 'item_name_search', 'lend_date_search', 'return_date_search'];

        // GET検索があればセッションに保存
        if ($request->hasAny($searchKey)) {
            $request->session()->put('search_condition', $request->only($searchKey));
        }

        // セッションに保存された検索条件を取得
        $searchCondition = $request->session()->get('search_condition', []);

        // クエリビルダーの基本設定
        $query = Lending::query();

        // セッションに値があれば検索条件を追加
        if ($searchCondition) {
            $query->when($searchCondition['name_search'] ?? null, function ($q, $name) {
                // 名前の部分一致検索
                $q->where('name', 'like', '%' . $name . '%');
            })
                ->when($searchCondition['item_name_search'] ?? null, function ($q, $item) {
                    // 品名の部分一致検索
                    $q->where('item_name', 'like', '%' . $item . '%');
                })
                ->when($searchCondition['lend_date_search'] ?? null, function ($q, $lendDate) {
                    // 年（YYYY）の場合
                    if (preg_match('/^\d{4}$/', $lendDate)) {
                        // 例: 2025 の場合
                        $q->whereBetween('lend_date', [$lendDate . '-01-01', $lendDate . '-12-31']);
                    }
                    // 年月（YYYY-MM）の場合
                    elseif (preg_match('/^\d{4}-\d{2}$/', $lendDate)) {
                        // 例: 2025-01 の場合
                        $startDate = $lendDate . '-01';
                        $endDate = date('Y-m-t', strtotime($startDate)); // 月末日を自動取得

                        $q->whereBetween('lend_date', [$startDate, $endDate]);
                    }
                    // 日付（YYYY-MM-DD）の場合
                    elseif (preg_match('/^\d{4}-\d{2}-\d{2}$/', $lendDate)) {
                        // 例: 2024-01-01 の場合
                        $q->where('lend_date', $lendDate);
                    }
                })
                // チェックボックスが選ばれている場合、返却日がnullの物を検索する
                ->when(session('search_checkbox') == 1, function ($q) {
                    // 未返却（return_date が NULL）を検索
                    $q->whereNull('return_date');
                })
                ->when($searchCondition['return_date_search'] ?? null, function ($q, $returnDate) {
                    // 年（YYYY）の場合
                    if (preg_match('/^\d{4}$/', $returnDate)) {
                        // 例: 2024 の場合
                        $q->whereBetween('return_date', [$returnDate . '-01-01', $returnDate . '-12-31']);
                    }
                    // 年月（YYYY-MM）の場合
                    elseif (preg_match('/^\d{4}-\d{2}$/', $returnDate)) {
                        // 例: 2024-01 の場合
                        $startDate = $returnDate . '-01';
                        $endDate = date('Y-m-t', strtotime($startDate)); // 月末日を自動取得
                    
                        $q->whereBetween('return_date', [$startDate, $endDate]);
                    }
                    // 日付（YYYY-MM-DD）の場合
                    elseif (preg_match('/^\d{4}-\d{2}-\d{2}$/', $returnDate)) {
                        // 例: 2024-01-01 の場合
                        $q->where('return_date', $returnDate);
                    }
                });
        }
        // 初回アクセス時（検索条件なし）は全件表示
        $query->orderBy('id', 'desc');

        // 検索結果を取得
        $lendings = $query->paginate(20);

        return view('lendings.index', compact('lendings'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreLendingRequest $request)
    {
        try {
            Lending::create([
                'name' => $request->input('name'),
                'item_name' => $request->input('item_name'),
                'lend_date' => $request->input('lend_date'),
                'return_date' => $request->input('return_date'),
            ]);
            return redirect()->route('lendings.index')
                ->with('flashMessage', '保存しました')
                ->with('flashStatus', 'success');
        } catch (Exception $e) {
            return redirect()->route('lendings.index')
                ->with('flashMessage', '保存に失敗しました')
                ->with('flashStatus', 'danger');
        }
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateLendingRequest $request, $id)
    {
        DB::beginTransaction();

        try {
            $lendings = Lending::findOrFail($id);

            $lendings->update([
                'name' => $request->input('name_update'),
                'item_name' => $request->input('item_name_update'),
                'lend_date' => $request->input('lend_date_update'),
                'return_date' => $request->input('return_date_update'),
            ]);
            DB::commit();
            return redirect()->route('lendings.index')
                ->with('flashMessage', '保存しました')
                ->with('flashStatus', 'success');
        } catch (Exception $e) {
            DB::rollBack();
            return redirect()->route('lendings.index')
                ->with('flashMessage', '保存に失敗しました')
                ->with('flashStatus', 'danger');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // 対象のレコードを取得
        $lending = Lending::findOrFail($id);

        // レコードを削除
        $lending->delete();

        return redirect()->route('lendings.confirm')
            ->with('flashMessage', '削除しました。')
            ->with('flashStatus', 'success');
    }

    public function confirm()
    {
        // 削除専用ページで表示するデータを全件取得
        $query = Lending::orderBy('id', 'desc');
        $lendings = $query->paginate(20);

        return view('lendings.confirm', compact('lendings'));
    }
}
