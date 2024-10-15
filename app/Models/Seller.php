<?php

namespace App\Models;

use App\Notifications\SellerVerify;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\URL;
class Seller extends Authenticatable implements MustVerifyEmail
{
    use HasFactory , Notifiable;
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

    protected $fillable = ['name' , 'email' , 'password' , 'gender' , 'phone' , 'image'];
}
