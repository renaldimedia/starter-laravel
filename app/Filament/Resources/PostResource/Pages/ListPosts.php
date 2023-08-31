<?php

namespace App\Filament\Resources\PostResource\Pages;

use App\Filament\Resources\PostResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;
use BezhanSalleh\FilamentShield\Traits\HasPageShield;


class ListPosts extends ListRecords
{
    // use HasPageShield;

    protected static string $resource = PostResource::class;

    protected function getShieldRedirectPath(): string {
        return '/'; // redirect to the root index...
    }

    protected function getHeaderActions(): array
    {
        return [
            Actions\CreateAction::make(),
        ];
    }
}
