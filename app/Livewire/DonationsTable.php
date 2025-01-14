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

class DonationsTable extends DataTableComponent
{
    protected $model = Payment::class;

    public function builder(): Builder
    {
        // Filter the query to only include rows where `payment_type  is DONATION
        if (Auth::user()->role !== UserRoleEnum::Admin) {
            return Payment::query()
                ->where('payment_type', 'DONATION')
                ->where('payments.user_id', Auth::user()->id);
        }
        return Payment::query()
            ->where('payment_type', 'DONATION');
    }

    public function configure(): void
    {
        $this->setPrimaryKey('id');
        $this->setDefaultSort('created_at', 'desc');
    }

    public function columns(): array
    {
        return [
            Column::make("Id", "id")
                ->sortable()
                ->deselected(),
            Column::make("Donor", "contributor.name")
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
                ->deselected()
                ->format(function ($value) {
                    return \Carbon\Carbon::createFromDate(null, $value, 1)->format('F'); // Converts numeric month to full month name
                })
                ->sortable()
                ->searchable(),
            Column::make("Year", "year")
                ->deselected()
                ->sortable(),

            Column::make("Project", "project.name")
                ->sortable()
                ->searchable(),
            Column::make("Payment Made to", "payment_made_to.name")
                ->sortable()
                ->searchable(),

            Column::make("Date received", "created_at")
                ->format(fn($value) => Carbon::parse($value)->toFormattedDateString())
                ->sortable(),

        ];
    }
}

// Number::currency($donation->amount, 'GHS')
