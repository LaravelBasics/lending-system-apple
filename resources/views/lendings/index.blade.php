@extends('layouts.app')

@section('title', '備品管理')

@section('style')
<style>
    body {
        background-color: #F9F9F9;
        /* オフホワイト */
        color: #333;
        /* 暗めの文字色でコントラストを調整 */
    }

    p {
        font-size: 1rem;
        line-height: 1.6;
        /* 行間は1.6倍（読みやすさを重視） */
        letter-spacing: 0.05rem;
        /* 少し文字間を広げて視認性を向上 */
        word-spacing: 0.1rem;
        /* 単語間を少し広げて、段落をスッキリ見せる */
        margin-bottom: 1.2rem;
        /* 各段落の下に適度なスペースを追加 */
        font-weight: bold;
        /* 文字を太くする */
    }

    /* 表全体の配置 */
    .table-container {
        display: flex;
        /* 横並びに配置 */
        justify-content: center;
        /* 中央寄せ */
        width: 100%;
        /* 表全体の幅を100%に設定 */
        padding: 0.5rem;
        /* 表周りのパディング */
    }

    /* 表の基本スタイル */
    .simple-table {
        width: 95%;
        /* 表の幅を100%に設定 */
        font-size: 1rem;
        /* テキストの基本フォントサイズ */
        text-align: left;
        /* テキストを左揃え */
        background-color: #f9f9f9;
        /* 表の背景色（薄いグレー） */
        border-collapse: collapse;
        /* 格子線が重ならないように設定 */
        /* transform: scale(0.95); */
        /* テーブルを80%のサイズに縮小 */
        max-width: 90%;
    }

    /* 表のセルスタイル */
    .simple-table th,
    .simple-table td {
        white-space: nowrap;
        /* テキストの折り返しを防ぐ */
        text-overflow: ellipsis;
        /* 省略記号を表示 */
        max-width: 16rem;
        /* 約17文字分の幅 */
        padding: 0.5rem;
        /* セルの内側の余白 */
        font-size: 1.45rem;
        /* セル内のフォントサイズ */
        color: #333;
        /* セル内の文字色（暗い灰色） */
        border: 0.0625rem solid #4a4a4a;
        /* セルのボーダー（細いグレーの線） */
        transition: background-color 0.3s ease;
        /* 背景色の変化にスムーズなトランジションを追加 */
        text-align: left;
        /* 左揃えで読みやすく */
        line-height: 1.6;
        /* 行間は1.6倍（読みやすさを重視） */
        letter-spacing: 0.05rem;
        /* 少し文字間を広げて視認性を向上 */
        word-spacing: 0.1rem;
        /* 単語間を少し広げて、段落をスッキリ見せる */
        margin-bottom: 1.2rem;
        /* 各段落の下に適度なスペースを追加 */

    }

    /* 表のid行にホバー効果 */
    .simple-table tbody tr:hover td {
        background-color: #58ec64;
        /* 行全体がハイライトされる */
    }

    /* ページネーション用に<tfoot>内のセルのボーダーを外す */
    .simple-table tfoot td {
        border: none;
        /* <tfoot>内の<td>からボーダーを削除 */
    }

    .pending-return {
        background-color: #FFB6C1;
        /* ライトピンク */
        color: #333;
        /* 文字色は暗めに */
    }

    .show-today {
        font-size: 1.25rem;
        line-height: 1.6;
        /* 行間は1.6倍（読みやすさを重視） */
        letter-spacing: 0.05rem;
        /* 少し文字間を広げて視認性を向上 */
        word-spacing: 0.1rem;
        /* 単語間を少し広げて、段落をスッキリ見せる */
        margin-bottom: 1.2rem;
        /* 各段落の下に適度なスペースを追加 */
        display: flex;
        flex-direction: column;
    }

    .show-today div {
        display: flex;
        justify-content: space-between;
        /* ラベルと値を左右に配置 */
        margin-bottom: 1rem;
        /* 各項目間に少し間隔を設ける */
    }

    .label {
        flex-basis: 8rem;
        /* ラベル部分の幅を統一 */
        font-weight: bold;
        /* ラベルを強調 */
    }

    .value {
        flex-grow: 1;
        /* 値部分が残りのスペースを占める */
    }

    .custom-input {
        position: relative; /* これにより、サジェストリストの絶対位置の基準をこの要素にする */
        text-align: center;
        /* <th>内のコンテンツを中央揃えに */
    }

    /* inputのテキストボックスを中央に配置し、テキストは左揃え */
    /* 親要素の中にあるinputに適応 */
    .custom-input input {
        display: block;
        /* インライン要素をブロックに */
        margin: 0 auto;
        /* 自動的に左右中央寄せ */
        width: 90%;
        /* 幅を80%に設定（お好みで調整） */
        text-align: left;
        /* 入力されたテキストを左寄せ */

        /* 以下form-controlと似た設定 */
        height: calc(2.25rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 1.15rem;
        font-weight: 400;
        line-height: 1.5;
        color: #495057;
        background-color: #fff;
        background-clip: padding-box;
        border: 1px solid #ced4da;
        border-radius: 0.375rem;
        transition: border-color .15s ease-in-out, box-shadow .15s ease-in-out;
    }

    .custom-input small {
        display: block;
        /* インライン要素をブロックに */
        margin: 0 auto;
        /* 自動的に左右中央寄せ */
        width: 90%;
        /* 幅を80%に設定（お好みで調整）*/
        text-align: left;
        /* 入力されたテキストを左寄せ */
        height: calc(2.25rem + 2px);
        padding: 0.375rem 0.75rem;
        font-size: 1.15rem;
        font-weight: 400;
        line-height: 1.5;
        color: #6c757d;
    }

    .link-style {
        color: #007bff;
        /* リンクカラー */
        cursor: pointer;
        /* カーソルをポインターに変更 */
        text-decoration: underline;
    }

    .flex-container {
        display: flex;
        /* 横並びにする */
        justify-content: space-between;
        /* 左右の端に配置 */
        align-items: center;
        /* 縦方向の中央揃え */
        width: 100%;
        height: auto;
        margin: 0 0 1.25rem 0;
        padding: 0.7rem 0rem 0.7rem 0rem;
        background-color: #BCF4BC;
    }

    .elementleft,
    .elementright {
        font-size: 1rem;
    }

    .elementleft {
        text-align: left;
        padding-right: 0.5rem;
    }

    .elementright {
        text-align: right;
        padding-left: 0.5rem;
    }

    .title {
        width: 100%;
        height: auto;
        font-size: 2rem;
        text-align: center;
    }

    /* サジェストリストの位置と表示 */
    .suggestions-list {
        position: absolute;
        top: 100%;
        /* 入力フォームの真下に表示 */
        left: 0;
        width: 100%;
        /* テキストボックスと同じ幅 */
        background-color: #fff;
        border: 0.0625rem solid #ced4da;
        /* ボーダー色 */
        border-top: none;
        /* 入力フォームとリストの間のボーダーを非表示 */
        box-shadow: 0 0.25rem 0.375rem rgba(0, 0, 0, 0.1);
        /* 軽いシャドウを追加 */
        max-height: 12.5rem;
        /* 初期状態では非表示 */
        overflow-y: auto;
        /* スクロールを表示 */
        transition: max-height 0.3s ease, box-shadow 0.3s ease;
        /* アコーディオンの開閉アニメーション */
        /* z-index: 10; */
        /* リストが他の要素の上に表示されるように */
    }

    /* サジェストリストが表示されたときのスタイル */
    /* .suggestions-list.show { */
        /* max-height: 12.5rem; */
        /* 最大の表示高さ (200px = 12.5rem) */
        /* overflow-y: auto; */
        /* スクロールを表示 */
    /* } */

    /* サジェストリストのリスト項目 */
    .suggestions-list ul {
        padding: 0;
        margin: 0;
        list-style-type: none;
    }

    .suggestions-list li {
        padding: 0.5rem;
        /* 8px = 0.5rem */
        cursor: pointer;
        font-size: 1rem;
        /* フォントサイズ 16px = 1rem */
        color: #333;
    }

    .suggestions-list li:hover {
        background-color: #f1f1f1;
        /* ホバー時に背景色を変更 */
    }
</style>
@endsection

@section('content')

<div>
    <div class="flex-container">
        <div class="elementright">
            <a href="{{ route('export.csv') }}"><button type="button">CSVをダウンロード</button></a>
        </div>
        <div>
            <h1 class="title">備品管理</h1>
        </div>
        <div class="elementleft">
            <a href="{{ route('lendings.confirm') }}">削除専用ページに移動</a>
        </div>
    </div>

    <div>
        {{-- フラッシュメッセージの表示 --}}
        @include('includes.flash-message')
    </div>

    @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
            <strong>
                <li style="color: #dc3545;">{{ $error }}</li>
            </strong>
            @endforeach
        </ul>
    </div>
    @endif

    {{-- 登録フォーム --}}
    <form action="{{ route('lendings.store') }}" method="POST">
        @csrf
        <div class="table-container">
            <table class="simple-table">
                <thead>
                    <tr>
                        <th class="custom-input">
                            <input type="text" name="name" autocomplete="name" placeholder="(例) 山田太郎"
                                v-model="editLending.name">
                            {{-- <small>(例) 山田太郎</small> --}}
                            <div v-if="validationErrors">
                                @error('name')
                                <small style="color: #dc3545;">※ {{ $message }}</small>
                                @enderror
                            </div>
                        </th>
                        <th class="custom-input">
                            <input type="text" name="item_name" autocomplete="on" placeholder="(例) PC体験用No1"
                                v-model="editLending.item_name">
                            {{-- <small>(例) PC体験用No1</small> --}}
                            <div v-if="validationErrors">
                                @error('item_name')
                                <small style="color: #dc3545;">※ {{ $message }}</small>
                                @enderror
                            </div>
                        </th>
                        <th class="custom-input">
                            <input type="text" name="lend_date" id="datepicker" placeholder="※ 貸出日を選択"
                                v-model="editLending.lend_date">
                            {{-- <small>※ 貸出日を選択</small> --}}
                            <div v-if="validationErrors">
                                @error('lend_date')
                                <small style="color: #dc3545;">※ {{ $message }}</small>
                                @enderror
                            </div>
                        </th>
                        <th v-if="aaa" class="custom-input">
                            <input type="date" name="return_date" v-model="editLending.return_date">
                            <small>※返却済の場合選択</small>
                            <div v-if="validationErrors">
                                @error('return_date')
                                <small style="color: #dc3545;">※ {{ $message }}</small>
                                @enderror
                            </div>
                        </th>
                        <th style="text-align: center;">
                            <button type="submit" class="btn btn-success">登録</button>
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </form>

    {{-- 検索フォーム --}}
    <form action="{{ route('lendings.index') }}" method="GET">
        <div class="table-container">
            <table class="simple-table">
                <tr>
                    <th class="custom-input">
                        <input type="text" name="name_search" v-model="queryName" @blur="clearSuggestions('queryName')" @input="fetchSuggestions(queryName, 'name')" autocomplete="off" placeholder="名前を入力してください">
                        <div v-if="loadingName" class="suggestions-list" style="color: #dc3545; padding: 1rem; font-size: 1.15rem !important;">候補を検索中…</div>
                        <!-- サジェスト候補リスト -->
                        <div v-if="nameSuggestions.length" class="suggestions-list">
                            <ul>
                                <li v-for="suggestion in nameSuggestions" :key="suggestion.id" @mousedown.prevent="selectSuggestion(suggestion, 'queryName')">
                                    @{{ suggestion.name }}
                                </li>
                            </ul>
                        </div>
                       
                        <!-- <p v-if="!loading" style="color: #dc3545; padding-left: 1rem">予測変換結果がありません</p> -->
                    </th>
                    <th class="custom-input">
                        <input type="text" name="item_name_search" v-model="queryItem" @blur="clearSuggestions('queryItem')" @input="fetchSuggestions(queryItem, 'item_name')" autocomplete="off" placeholder="品名を入力してください">
                        <div v-if="loadingItem" class="suggestions-list" style="color: #dc3545; padding: 1rem; font-size: 1.15rem !important;">候補を検索中…</div>
                        <div v-if="itemSuggestions.length" class="suggestions-list">
                            <ul>
                                <li v-for="suggestion in itemSuggestions" :key="suggestion.id" @mousedown.prevent="selectSuggestion(suggestion, 'queryItem')">
                                    @{{ suggestion.item_name }}
                                </li>
                            </ul>
                        </div>
                    </th>
                    <th class="custom-input">
                        <input type="text" name="lend_date_search"
                            value="{{ old('lend_date_search', session('search_condition.lend_date_search')) }}"
                            placeholder="貸出日を入力してください">
                    </th>
                    <th class="custom-input">
                        <input type="text" name="return_date_search"
                            value="{{ old('return_date_search', session('search_condition.return_date_search')) }}"
                            placeholder="返却日を入力してください">
                    </th>
                    <th class="custom-input"
                        style="text-align: center; margin: 0; padding: 0rem 0rem 1rem 0rem; position: relative; top: -0.625rem;">
                        <label for="search_checkbox"
                            style="font-size: 0.75rem; display: inline-block; color: #dc3545;">未返却</label>
                        <input type="hidden" name="search_checkbox" value="0">
                        <input type="checkbox" name="search_checkbox" value="1" {{ session('search_checkbox') == '1'
                            ? 'checked' : '' }} id="search_checkbox">
                    </th>
                    <th style="text-align: center;">
                        <button type="submit" class="btn btn-info">検索</button>
                    </th>
                </tr>
            </table>
        </div>
    </form>

    {{-- 編集フォームと登録済みデータの表示 --}}
    @if ($lendings->isNotEmpty())
    <form :action="`{{ route('lendings.update', ':id') }}`.replace(':id', editLendingId)" method="POST">
        @csrf
        @method('PUT')
        <div class="table-container">
            <table class="simple-table">
                <thead>
                    <tr>
                        <th style="text-align: center;">ID</th>
                        <th style="text-align: center;">名前</th>
                        <th style="text-align: center;">品名</th>
                        <th style="text-align: center;">貸出日</th>
                        <th style="text-align: center; ">返却日</th>
                        <th style="text-align: center;">編集</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($lendings as $lending)
                    <tr v-if="editLendingId == {{ $lending->id }}">
                        <td>{{ $lending->id }}</td>
                        <td class="custom-input">
                            <input name="name_update" v-model="editLendingUpdate.name_update">
                            <div v-if="validationErrors">
                                @error('name_update')
                                <small style="color: #dc3545;">※{{ $message }}</small>
                                @enderror
                            </div>
                        </td>
                        <td class="custom-input">
                            <input name="item_name_update" v-model="editLendingUpdate.item_name_update">
                            <div v-if="validationErrors">
                                @error('item_name_update')
                                <small style="color: #dc3545;">※{{ $message }}</small>
                                @enderror
                            </div>
                        </td>
                        <td class="custom-input">
                            <input name="lend_date_update" v-model="editLendingUpdate.lend_date_update">
                            <div v-if="validationErrors">
                                @error('lend_date_update')
                                <small style="color: #dc3545;">※{{ $message }}</small>
                                @enderror
                            </div>
                        </td>
                        <td class="custom-input">
                            <input name="return_date_update" placeholder="未返却"
                                v-model="editLendingUpdate.return_date_update">
                            <div v-if="validationErrors">
                                @error('return_date_update')
                                <small style="color: #dc3545;">※{{ $message }}</small>
                                @enderror
                            </div>
                        </td>
                        <td style="text-align: center;">
                            <input type="hidden" name="id_update" :value="editLendingId">
                            <button type="submit" class="btn btn-success">登録</button>
                        </td>
                    </tr>
                    {{-- 返却日がnullの時、cssで色付け --}}
                    <tr {{ !$lending->return_date ? 'class=pending-return' : '' }} v-else>
                        <td>{{ $lending->id }}</td>
                        <td>{{ $lending->name }}</td>
                        <td>{{ $lending->item_name }}</td>
                        <td>{{ $lending->lend_date }}</td>
                        @if($lending->return_date)
                        <td>
                            {{ $lending->return_date }}
                        </td>
                        @else
                        <td style="text-align: center;">
                            <button type="button" @click="showEditModal({{ $lending->id }})"
                                class="btn btn-danger">即日返却</button>
                        </td>
                        @endif
                        <td style="text-align: center;">
                            <button type="button" @click="startEdit({{ $lending->id }})"
                                class="btn btn-primary">編集</button>
                        </td>
                    </tr>
                    @endforeach
                <tfoot>
                    <tr>
                        <td colspan="6">
                            <p>
                                {{ $lendings->appends(request()->except('page'))->links('vendor.pagination.bootstrap-5') }}
                            </p>
                            <p>
                                {{ $lendings->firstItem() }} - {{ $lendings->lastItem() }} / {{ $lendings->total() }} 件
                            </p>
                        </td>
                    </tr>
                </tfoot>
                </tbody>
            </table>
        </div>
    </form>
    @else
    <p style="color: #dc3545; padding-left: 1rem;">データが見つかりません</p>
    @endif

    {{-- モーダル --}}
    <div class="modal fade" id="showEditModal" tabindex="-1" aria-labelledby="showEditModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 15cm;">
            <div class="modal-content" style="height: 10cm;">
                <div class="modal-header">
                    <h5 class="modal-title" id="showEditLabel">
                        <sapn style="color: #e74c3c">
                            ID:
                            @{{ todayEditId }}
                        </sapn>
                        今日の日付で返却しますか？
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="show-today">
                        <div>
                            <span class="label">名前：</span>
                            <span class="value">@{{ editLendingUpdate.name_update }}</span>
                        </div>
                        <div>
                            <span class="label">品名：</span>
                            <span class="value">@{{ editLendingUpdate.item_name_update }}</span>
                        </div>
                        <div>
                            <span class="label">貸出日：</span>
                            <span class="value">@{{ editLendingUpdate.lend_date_update }}</span>
                        </div>
                        <div>
                            <span class="label">今日の日付：</span>
                            <span class="value" style="color: #e74c3c;">@{{ today }}</span>
                        </div>
                    </div>

                    <form :action="`{{ route('lendings.update', ':id') }}`.replace(':id', todayEditId)" method="POST">
                        @csrf
                        @method('PUT')
                        <input type="hidden" name="name_update" :value="editLendingUpdate.name_update">
                        <input type="hidden" name="item_name_update" :value="editLendingUpdate.item_name_update">
                        <input type="hidden" name="lend_date_update" :value="editLendingUpdate.lend_date_update">
                        <input type="hidden" name="return_date_update" :value="today">
                        <button type="submit" class="btn btn-danger">返却</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
    window.oldValues = @json(session()->getOldInput());

    const app = Vue.createApp({
        data() {
            return {
                lendings: @json($lendings),
                editLendingId: window.oldValues?.id_update || null,
                editLending: {
                    name: window.oldValues?.name || '',
                    item_name: window.oldValues?.item_name || '',
                    lend_date: window.oldValues?.lend_date || null,
                    return_date: window.oldValues?.return_date || null,
                },
                editLendingUpdate: {
                    name_update: window.oldValues?.name_update || '',
                    item_name_update: window.oldValues?.item_name_update || '',
                    lend_date_update: window.oldValues?.lend_date_update || null,
                    return_date_update: window.oldValues?.return_date_update || null,
                },
                validationErrors: true, // バリデーションメッセージを表示する
                today: null, // 今日の日付を取得
                todayEditId: null, // バリデーション時にIdを取得
                isMobile: window.matchMedia("(max-width: 768px)").matches,
                queryName: window.oldValues?.name_search || '{{ old('name_search', session('search_condition.name_search')) }}', // `oldValues`から検索の初期値を設定
                nameSuggestions: [], // 名前検索用のサジェスト
                itemSuggestions: [], // 品名検索用のサジェスト
                loadingName: false,
                loadingItem: false,
                queryItem: window.oldValues?.item_name_search || '{{ old('item_name_search', session('search_condition.item_name_search')) }}',
            };
        },
        mounted() {
            // 登録フォームで貸出日が未設定の場合、自動的に今日の日付をセット（通常は今日の日付）
            if (!this.editLending.lend_date) {
                this.getToday();
                this.editLending.lend_date = this.today;
            }
            // ライブラリ
            flatpickr("#datepicker", {
                dateFormat: "Y-m-d", // 日付のフォーマットを "YYYY-MM-DD" に設定
                locale: "ja", // 日本語ロケールを設定
                defaultDate: this.editLending.lend_date, // 初期値をv-modelでバインディングされた日付に設定
                onChange: (selectedDates) => {
                    this.editLending.lend_date = selectedDates[0]; // カレンダーで日付が選択されたとき、v-modelの値（editLending.lend_date）を更新
                },
            });
            window.addEventListener("resize", this.updateMobileStatus); // 画面サイズ変更時に更新

            // console.log("Vue instance mounted"); Vue.jsが動くか確認用
        },
        beforeUnmount() { // 768px判定
            window.removeEventListener("resize", this.updateMobileStatus);
        },
        methods: {
            clearSuggestions(target) {
                if (target === "queryName") {
                    this.nameSuggestions = [];
                } else {
                    this.itemSuggestions = [];
                }
            },
            // Lodash の debounce を使用して、入力の頻度を減らす
            debouncedFetchSuggestions: _.debounce(async function(queryKey, target) {
                // ローディングの状態を変更
                if (target === "name") {
                    this.loadingName = true;
                } else {
                    this.loadingItem = true;
                }
                if (!queryKey) { // 検索文字列が2文字未満の場合
                    if (target === "name") {
                        this.loadingName = false;
                    } else {
                        this.loadingItem = false;
                    }
                    return; // APIリクエストを実行しない
                }

                // サーバーへリクエストを送信し、検索結果を取得
                const response = await axios.get(`/search?q=${queryKey}&column=${target}`);
                // `target` が `nameSuggestions` の場合と `itemSuggestions` の場合で処理を分ける
                if (target === "name") {
                    this.nameSuggestions = response.data;  // nameSuggestions にセット
                    this.loadingName = false; // ローディング終了
                } else if (target === "item_name") {
                    this.itemSuggestions = response.data;  // itemSuggestions にセット
                    this.loadingItem = false; // ローディング終了
                }
            }, 300), // 300ms の遅延後に実行
            // ユーザーの入力が変わったらデバウンスされた関数を呼び出す
            fetchSuggestions(queryKey, target) {
                this.debouncedFetchSuggestions(queryKey, target);
            },
            selectSuggestion(suggestion, target) {
                // target の値が 'queryName' の場合
                if (target === 'queryName') {
                    this.queryName = suggestion.name; // 'queryName' に 'name' を設定
                }
                // target の値が 'queryItem' の場合
                else if (target === 'queryItem') {
                    this.queryItem = suggestion.item_name; // 'queryItem' に 'item_name' を設定
                }
                this.clearSuggestions(target);
            },
            updateMobileStatus() { // 768px判定
                this.isMobile = window.matchMedia("(max-width: 768px)").matches;
            },
            startEdit(id) { // id=1の編集ボタンクリックで、id=1登録済みデータの表示
                this.editLendingId = id;
                this.editId(id);
            },
            getToday() { // 今日の日付を2025-01-01形式で取得
                const now = new Date();
                const year = now.getFullYear();
                const month = (now.getMonth() + 1).toString().padStart(2, '0'); // ゼロ埋め
                const day = now.getDate().toString().padStart(2, '0'); // ゼロ埋め
                this.today = `${year}-${month}-${day}`;
            },
            showEditModal(id) { // モーダルで登録する情報を画面に表示
                this.getToday();
                this.todayEdit(id);
                const modal = new bootstrap.Modal(document.getElementById('showEditModal'));
                modal.show();
            },
            todayEdit(id) { // id=1の即日返却ボタンクリック時、返却日を今日の日付にする
                this.todayEditId = id;
                this.editId(id);
            },
            editId(id) { // id=1の編集ボタンクリック時、id=1のレコードを取得
                this.validationErrors = false; // バリデーションメッセージを非表示
                const lending = this.lendings.data.find(lending => lending.id == id);
                this.editLendingUpdate = {
                    name_update: lending.name,
                    item_name_update: lending.item_name,
                    lend_date_update: lending.lend_date,
                    return_date_update: lending.return_date,
                };
            },
        },
    }).mount('#app');
</script>
@endsection