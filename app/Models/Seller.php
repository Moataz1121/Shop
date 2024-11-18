<?php

namespace App\Models;

use App\Notifications\SellerVerify;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\URL;
use Laravel\Sanctum\HasApiTokens;

class Seller extends Authenticatable implements MustVerifyEmail
{
    use HasFactory , Notifiable , HasApiTokens;
    protected $fillable = ['name' , 'email' , 'password' , 'gender' , 'phone' , 'image', 'provider_id' , 'email_verified_at'];

    public function sendEmailVerificationNotification(){
        $url = URL::temporarySignedRoute(
            'seller.verification.verify', 
            now()->addMinutes(30), 
            [
                'id' => $this->id, 
                'hash' => sha1($this->email)
            ]
        );
        
        if (filter_var($url, FILTER_VALIDATE_URL) === false) {
            throw new \Exception("Invalid URL format.");
        }
        
        $this->notify(new SellerVerify($url));
        
    }

    public function products(){
        return $this->hasMany(Product::class);
    }
    public function bookings(){
       return $this->hasMany(Booking::class);
    }
}
