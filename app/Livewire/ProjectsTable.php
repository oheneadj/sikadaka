<?php

namespace App\Livewire;

use App\Models\Project;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class ProjectsTable extends DataTableComponent
{
    protected $model = Project::class;

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable(),
            Column::make("Name", "name")
                ->sortable()
                ->searchable(),
            Column::make("Description", "description")
                ->sortable(),
            Column::make("Created at", "created_at")
                ->sortable(),
            LinkColumn::make('Action')
                ->title(fn($row) => 'Edit')

                ->location(fn($row) => route('project.edit', $row))
                ->attributes(fn($row) => [
                    'class' => 'rounded-full text-red-600',
                    'alt' => $row->name . ' Avatar',
                ]),

            ButtonGroupColumn::make('Actions')
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Edit')
                        ->title(fn($row) => 'Edit')
                        ->location(fn($row) => route('project.edit', $row))
                        ->attributes(function ($row) {
                            return [
                                'target' => '_blank',
                                'class' => 'text-red-500 hover:no-underline',
                            ];
                        }),
                ]),
        ];
    }
}
