<?php

namespace App\Livewire;

use App\Models\Contributor;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;
use Rappasoft\LaravelLivewireTables\Views\Columns\LinkColumn;
use Rappasoft\LaravelLivewireTables\Views\Columns\ButtonGroupColumn;

class MembersTable extends DataTableComponent
{
    protected $model = Contributor::class;

    public function builder(): Builder
    {
        // Filter the query to only include rows where `is_member` is 1
        return Contributor::query()
            ->where('is_member', 1);
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->deselected()
                ->searchable(),
            LinkColumn::make('Name', 'name') // make() has no effect in this case but needs to be set anyway
                ->title(fn($row) => $row->name)
                ->location(fn($row) => route('member.single', $row))
                ->attributes(function ($row) {
                    return [
                        'class' => 'font-bold text-blue-500 hover:no-underline',
                    ];
                })->sortable()
                ->searchable(),

            Column::make("Membership id", "membership_id")
                ->attributes(function ($row) {
                    return [
                        'class' => 'font-bold bg-blue-500 px-2 py-0.5 rounded-md text-white hover:no-underline',
                    ];
                })
                ->sortable()
                ->searchable(),
            Column::make("Gender", "gender")
                ->sortable(),
            Column::make("Phone number", "phone_number")
                ->sortable(),

            Column::make('Registered by', 'registered_by.name')

                ->attributes(function ($row) {
                    return [
                        'class' => 'font-bold text-blue-500 hover:no-underline',
                    ];
                })->sortable()
                ->searchable(),
            Column::make("Date Registered", "created_at")
                ->format(fn($value) => Carbon::parse($value)->toFormattedDateString())
                ->sortable(),
            ButtonGroupColumn::make('Actions')
                ->attributes(function ($row) {
                    return [
                        'class' => 'space-x-2',
                    ];
                })
                ->buttons([
                    LinkColumn::make('Edit')
                        ->title(fn($row) => 'Edit')
                        ->location(fn($row) => route('member.edit', $row))
                        ->attributes(function ($row) {
                            return [
                                'class' => ' text-red-500 hover:no-underline',
                            ];
                        }),
                ]),
        ];
    }
}
