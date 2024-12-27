<?php

namespace App\Livewire;

use App\Models\Payment;
use App\Enums\UserRoleEnum;
use Illuminate\Support\Carbon;
use Illuminate\Support\Number;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Rappasoft\LaravelLivewireTables\Views\Column;
use Rappasoft\LaravelLivewireTables\DataTableComponent;

class ContributionsTable extends DataTableComponent
{
    protected $model = Payment::class;

    public function builder(): Builder
    {
        // Filter the query to only include rows where `payment_type  is CONTRIBUTION
        if (Auth::user()->role !== UserRoleEnum::Admin) {
            return Payment::query()
                ->where('payment_type', 'CONTRIBUTION')
                ->where('payments.user_id', Auth::user()->id);
        }
        return Payment::query()
            ->where('payment_type', 'CONTRIBUTION');
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
                ->deselected(),
            Column::make("Contributor name", "contributor.name")
                ->sortable()
                ->searchable(),
            Column::make("Amount", "amount")
                ->format(function ($value) {
                    return Number::currency($value, 'GHS');
                    // Converts numeric to GHS
                })
                ->sortable(),

            Column::make("Month", "month")
                ->sortable()
                ->format(function ($value) {
                    return \Carbon\Carbon::createFromDate(null, $value, 1)->format('F'); // Converts numeric month to full month name
                }),
            Column::make("Year", "year")
                ->sortable(),
            Column::make("Payment Made to", "payment_made_to.name")
                ->sortable(),

            Column::make("Date received", "created_at")
                ->format(fn($value) => Carbon::parse($value)->toFormattedDateString())
                ->sortable(),
        ];
    }
}
