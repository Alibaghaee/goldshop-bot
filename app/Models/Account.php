<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Account extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'username',
        'DataSignature',
        'EncryptionKeyId',
        'Iv',
        'SymmetricKey',
        'user_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'username',
        'DataSignature',
        'EncryptionKeyId',
        'Iv',
        'SymmetricKey',
    ];



    /**
     * Define an inverse one-to-one relationship to User.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }


    /**
     * Define a one-to-many relationship to InvoicePacket.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function invoicePackets()
    {
        return $this->hasMany(InvoicePacket::class);
    }
}
