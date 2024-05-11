<?php

namespace App\Filament\Resources\CMS\ArticleResource\Pages;

use App\Filament\Resources\CMS\ArticleResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;

class CreateArticle extends CreateRecord
{
    protected static string $resource = ArticleResource::class;
}
