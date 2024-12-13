<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Contributor extends Model
{
    /** @use HasFactory<\Database\Factories\ContributorFactory> */
    use HasFactory;
    use SoftDeletes;


    protected $fillable = [
        'name',
        'membership_id',
        'date_of_birth',
        'gender',
        'phone_number',
        'is_member',
        'suburb',
        'denomination',
        'picture_path',
        'user_id',
        'clan',
        'father',
        'mother',
        'hometown',
        'contact_person_name',
        'contact_person_number'
    ];

    public static function clans()
    {
        return [
            ['value' => 'OYOKO', 'name' => 'Oyoko'],
            ['value' => 'AGONA', 'name' => 'Agona'],
            ['value' => 'BRETUO', 'name' => 'Bretuo'],
            ['value' => 'ASOMAKOMA', 'name' => 'Asomakoma'],
            ['value' => 'ASONA', 'name' => 'Asona'],
            ['value' => 'ABRADE', 'name' => 'Abrade'],
            ['value' => 'EKUONA', 'name' => 'Ekuona'],
            ['value' => 'ADUANA', 'name' => 'Aduana']
        ];
    }



    protected $casts = ['date_of_birth' => 'date'];


    /**
     * payments
     *
     * @return HasMany
     */
    public function payments(): HasMany
    {
        return $this->hasMany(Payment::class, 'contributor_id');
    }



    /**
     * registered_by
     *
     * @return BelongsTo
     */
    public function registered_by(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public static function generate_membership_id($word)
    {
        $lastRecord = self::latest('id')->first();
        $lastId = $lastRecord ? $lastRecord->id : 0;

        do {
            // Step 1: Increment the ID for the new pattern
            $number = ($lastId + 1) % 10000; // 0-9999 range
            $formattedNumber = str_pad($number, 4, '0', STR_PAD_LEFT);

            // Step 2: Generate the abbreviation
            $abbreviation = Str::upper(Str::substr($word, 0, 2)); // First 4 letters

            // Step 3: Calculate the alphabet sequence
            $alphaSequence = self::getAlphaSequence((int)($lastId / 10000));

            // Combine parts to form the pattern
            $pattern = $abbreviation . $formattedNumber . $alphaSequence;

            // Increment the ID to check the next sequence if a conflict is found
            $lastId++;
        } while (self::where('membership_id', $pattern)->exists()); // Check for uniqueness

        return $pattern;
    }

    /**
     * Get the alphabet sequence based on the offset.
     *
     * @param int $offset Alphabet sequence index.
     * @return string
     */
    private static function getAlphaSequence($offset)
    {
        $alphabet = range('A', 'Z');
        $sequence = '';

        // Generate the alphabet sequence (e.g., A, B, ... Z, AA, AB, ... ZZ)
        do {
            $sequence = $alphabet[$offset % 26] . $sequence;
            $offset = intdiv($offset, 26) - 1;
        } while ($offset >= 0);

        return $sequence;
    }
}
