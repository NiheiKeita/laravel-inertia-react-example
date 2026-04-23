# Laravel × Inertia × React Example

[![unitTest](https://github.com/NiheiKeita/laravel-inertia-react-example/actions/workflows/unitTest.yml/badge.svg)](https://github.com/NiheiKeita/laravel-inertia-react-example/actions/workflows/unitTest.yml)
[![CodeQL](https://github.com/NiheiKeita/laravel-inertia-react-example/actions/workflows/codeql.yml/badge.svg)](https://github.com/NiheiKeita/laravel-inertia-react-example/actions/workflows/codeql.yml)
[![Dependabot](https://img.shields.io/badge/Dependabot-enabled-025E8C?logo=dependabot)](./.github/dependabot.yml)
[![PHP](https://img.shields.io/badge/PHP-8.4-777BB4?logo=php&logoColor=white)](https://www.php.net/)
[![Laravel](https://img.shields.io/badge/Laravel-12-FF2D20?logo=laravel&logoColor=white)](https://laravel.com/)
[![React](https://img.shields.io/badge/React-18-61DAFB?logo=react&logoColor=white)](https://react.dev/)
[![TypeScript](https://img.shields.io/badge/TypeScript-5-3178C6?logo=typescript&logoColor=white)](https://www.typescriptlang.org/)
[![License: MIT](https://img.shields.io/badge/License-MIT-green.svg)](./LICENSE)

Laravel + Inertia.js + React + TypeScript のモノレポ構成サンプルです。Storybook / MSW / PHPStan / PHPCS / ESLint / Playwright など一通り揃っています。

## 🏗 構成

| レイヤ | 技術 |
|---|---|
| Backend | Laravel 12 / PHP 8.4 |
| Frontend | React 18 / TypeScript 5 / Inertia.js |
| ビルド | Vite |
| UI 開発 | Storybook 8 / Tailwind CSS |
| API モック | MSW |
| テスト | PHPUnit / Storybook Test Runner (Playwright) |
| 静的解析 | PHPStan (Larastan) / PHPCS / ESLint |
| API ドキュメント | Swagger (zircote/swagger-php) |
| Infra | Docker Compose (app / nginx / db / swagger) |

## 🚀 セットアップ

```bash
# 1. 起動
make up

# 2. コンテナに入る
make bash

# 3. Laravel 初期設定
composer install
cp .env.example .env
php artisan key:generate
touch database/database.sqlite
php artisan migrate

# 4. フロントエンド
npm ci
npm run dev
```

| URL | 内容 |
|---|---|
| http://localhost:8081 | アプリ本体 |
| http://localhost:8082 | Swagger UI |
| http://localhost:6006 | Storybook (`npm run storybook`) |

## 🧪 開発コマンド（`src/` 内）

```bash
# PHP
composer phpcs .                 # コードスタイルチェック
composer phpcs-fix               # 自動修正
vendor/bin/phpstan analyze       # 静的解析
vendor/bin/phpunit               # テスト

# Frontend
npm run lint                     # ESLint
npm run type-check               # tsc --noEmit
npm run build                    # 本番ビルド
npm run storybook                # Storybook 起動
npm run test-storybook           # Storybook テスト
```

## 🔧 Makefile ショートカット

| コマンド | 内容 |
|---|---|
| `make up` | `docker compose up -d` |
| `make bash` | app コンテナに入る |
| `make stop` | コンテナ停止 |
| `make ps` | 状態確認 |

## 🤖 自動化

- **Dependabot**: 毎週月曜 9:00 (JST) に npm / Composer / Docker / Actions を自動チェック → minor/patch は自動マージ
- **CI (unitTest)**: PR と main push で 3並列ジョブ（backend / frontend / storybook）を実行
- **CodeQL**: PHP / JavaScript のセキュリティスキャン
- **actionlint**: GitHub Actions の lint
- **commitlint**: Conventional Commits 準拠チェック

## 📁 ディレクトリ構成

```
.
├── docker/           # Docker イメージ定義 (app / nginx / db / swagger)
├── document/         # 設計ドキュメント
├── src/              # Laravel アプリケーション本体
│   ├── app/          # Laravel バックエンド
│   ├── resources/js/ # React + Inertia フロントエンド
│   ├── msw/          # MSW モック
│   └── tests/        # PHPUnit テスト
└── swagger/          # Swagger 定義
```

## 📝 License

MIT
