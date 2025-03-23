@extends('layouts.app')

@section('title', '削除専用ページ')

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
        width: 100%;
        /* 表の幅を100%に設定 */
        font-size: 1rem;
        /* テキストの基本フォントサイズ */
        text-align: left;
        /* テキストを左揃え */
        background-color: #f9f9f9;
        /* 表の背景色（薄いグレー） */
        border-collapse: collapse;
        /* 格子線が重ならないように設定 */
        transform: scale(0.95);
        /* テーブルを80%のサイズに縮小 */

    }

    /* 表のセルスタイル */
    .simple-table th,
    .simple-table td {
        white-space: nowrap;
        /* テキストの折り返しを防ぐ */
        overflow: hidden;
        /* はみ出した部分を隠す */
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

    .title {
        background-color: #FFB6C1;
        width: 100%;
        height: auto;
        margin: 0 0 1.25rem 0;
        padding: 0.7rem 0rem 0.7rem 0rem;
        font-size: 2rem;
        text-align: center;
        border-radius: 0.5rem;
        /* 角を丸くする */
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

    .parent {
        display: flex;
        justify-content: center;
        /* 横方向の中央寄せ */
        align-items: center;
        /* 縦方向の中央寄せ */
        height: 100vh;
        /* 親要素の高さを画面全体に設定 */
    }

    .element {
        width: 100%;
        /* 100%幅 */
        height: auto;
        /* 高さは自動 */
        font-size: 1rem;
        /* フォントサイズ */
        text-align: center;
        /* テキストを中央に */
    }
</style>
@endsection

@section('content')

<div>
    <h1 class="title">削除専用</h1>
    <div class="element">
        <a href="{{ route('lendings.index') }}">TOPページ</a>
    </div>

    <div>
        <!-- フラッシュメッセージの表示 -->
        @include('includes.flash-message')
    </div>

    {{-- 登録済みデータの表示 --}}
    @if ($lendings->isNotEmpty())
    <div class="table-container">
        <table class="simple-table">
            <thead>
                <tr>
                    <th style="text-align: center;">ID</th>
                    <th style="text-align: center;">名前</th>
                    <th style="text-align: center;">品名</th>
                    <th style="text-align: center;">貸出日</th>
                    <th style="text-align: center; ">返却日</th>
                    <th style="text-align: center;">削除</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($lendings as $lending)
                {{-- 返却日がnullの時、cssで色付け --}}
                <tr {{ !$lending->return_date ? 'class=pending-return' : '' }}>
                    <td>{{ $lending->id }}</td>
                    <td>{{ $lending->name }}</td>
                    <td>{{ $lending->item_name }}</td>
                    <td>{{ $lending->lend_date }}</td>
                    @if($lending->return_date)
                    <td>
                        {{ $lending->return_date }}
                    </td>
                    @else
                    <td style="text-align: center;"></td>
                    @endif
                    <td style="text-align: center;">
                        @if($lending->return_date)
                        <button type="button" @click="showModal({{ $lending->id }})" class="btn btn-danger">削除</button>
                        @endif
                    </td>
                </tr>
                @endforeach
            <tfoot>
                <tr>
                    <td colspan="6">
                        <p>
                            {{ $lendings->links('vendor.pagination.bootstrap-5') }}
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
    @endif

    {{-- 削除確認モーダル --}}
    <div class="modal fade" id="showModal" tabindex="-1" aria-labelledby="showModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" style="max-width: 15cm;">
            <div class="modal-content" style="height: 10cm;">
                <div class="modal-header">
                    <h5 class="modal-title" id="showLabel">
                        <span style="color: #e74c3c;">
                        ID:
                        @{{ destroyLendingId }}
                        </span>
                        を削除すると復元できません。削除しますか？
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="show-today">
                        <div>
                            <span class="label">名前：</span>
                            <span class="value">@{{ LendingDestroy.name_destroy }}</span>
                        </div>
                        <div>
                            <span class="label">品名：</span>
                            <span class="value">@{{ LendingDestroy.item_name_destroy }}</span>
                        </div>
                        <div>
                            <span class="label">貸出日：</span>
                            <span class="value">@{{ LendingDestroy.lend_date_destroy }}</span>
                        </div>
                        <div>
                            <span class="label">返却日：</span>
                            <span class="value">@{{ LendingDestroy.return_date_destroy }}</span>
                        </div>
                    </div>

                    <form :action="`{{ route('lendings.destroy', ':id') }}`.replace(':id', destroyLendingId)"
                        method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">削除</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('scripts')
<script>
    const app = Vue.createApp({
        data() {
            return {
                lendings: @json($lendings),
                isMobile: window.matchMedia("(max-width: 768px)").matches,
                destroyLendingId: null,
                LendingDestroy: {
                    name_destroy: '',
                    item_name_destroy: '',
                    lend_date_destroy: null,
                    return_date_destroy: null,
                },
            };
        },
        mounted() {
            window.addEventListener("resize", this.updateMobileStatus); // 画面サイズ変更時に更新
        },
        beforeUnmount() { // 768px判定
            window.removeEventListener("resize", this.updateMobileStatus);
        },
        methods: {
            updateMobileStatus() { // 768px判定
                this.isMobile = window.matchMedia("(max-width: 768px)").matches;
            },
            showModal(id) { // モーダルで削除する情報を画面に表示
                this.destroyLendingId = id;
                this.destroyId(id);
                const modal = new bootstrap.Modal(document.getElementById('showModal'));
                modal.show();
            },
            destroyId(id) { // id=1の削除ボタンクリック時、id=1のレコードを取得
                const lending = this.lendings.data.find(lending => lending.id == id);
                this.LendingDestroy = {
                    name_destroy: lending.name,
                    item_name_destroy: lending.item_name,
                    lend_date_destroy: lending.lend_date,
                    return_date_destroy: lending.return_date,
                };
            },
        },
    }).mount('#app');
</script>
@endsection