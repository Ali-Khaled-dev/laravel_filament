<?php

require 'vendor/autoload.php';

use Symfony\Component\Yaml\Yaml;

$yamlFile = 'resource.yaml';
$yamlContent = Yaml::parseFile($yamlFile);

function generateResource($resourceName, $resourceConfig)
{
    $model = $resourceConfig['model'];
    $navigationIcon = $resourceConfig['navigation_icon'];
    // $formSchema = $resourceConfig['form']['schema'];
    $tableColumns = $resourceConfig['table']['columns'];
    $pages = $resourceConfig['pages'];

    $resourceClassContent = "<?php


namespace App\Filament\Resources;

use App\Filament\Resources\\{$resourceName}Resource\Pages;
use App\Models\\{$model};
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Support\Str;


class {$resourceName}Resource extends Resource
{
    protected static ?string \$model = {$model}::class;

    protected static ?string \$navigationIcon = '{$navigationIcon}';

    public static function form(Form \$form): Form
    {
        return \$form
            ->schema([";
    $resourceClassContent .= "
            ]);
    }

    public static function table(Table \$table): Table
    {
        return \$table
            ->columns([";

    foreach ($tableColumns as $column) {
        $resourceClassContent .= "
                Tables\Columns\\{$column['type']}::make('{$column['name']}')
                    ->sortable({$column['sortable']})
                    ->searchable({$column['searchable']}),";
    }

    $resourceClassContent .= "
            ]);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\\List{$resourceName}::route('/'),
            'create' => Pages\\Create{$resourceName}::route('/create'),
            'edit' => Pages\\Edit{$resourceName}::route('/{record}/edit'),
        ];
    }
}";


    // namespace resource
    $resourceDir = __DIR__ . "/app/Filament/Resources";
    $pageDir = __DIR__ . "/app/Filament/Resources/{$resourceName}Resource";


    // create file resource

    mkdir("$resourceDir/{$resourceName}Resource");

    file_put_contents("{$resourceDir}/{$resourceName}Resource.php", $resourceClassContent);

    mkdir("$pageDir/Pages");


    foreach ($pages as $page) {
        $pageClassContent = "<?php

namespace App\Filament\Resources\\{$resourceName}Resource\Pages;

use App\Filament\Resources\\{$resourceName}Resource;

use Filament\Resources\Pages\\" . ucfirst($page['name']) . "Record;

class " . ucfirst($page['name']) . "{$resourceName} extends " . ucfirst($page['name']) . "Record
{
    protected static string \$resource = {$resourceName}Resource::class;
}
";



        file_put_contents("{$pageDir}/Pages/" . ucfirst($page['name']) . "{$model}.php", $pageClassContent);
    }
}

foreach ($yamlContent['resources'] as $resourceName => $resourceConfig) {
    generateResource($resourceName, $resourceConfig);
}

echo "Resources generated successfully.\n";
