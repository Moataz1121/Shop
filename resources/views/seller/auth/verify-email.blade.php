<!DOCTYPE html>
<html lang="en">
@include('seller.layouts.head')
<body>
    <div class="container" style="margin-top: 50px">
        <div class="mb-4 text-sm text-gray-600">
            {{ __('Thanks for signing up! Before getting started, could you verify your email address by clicking on the link we just emailed to you? If you didn\'t receive the email, we will gladly send you another.') }}
        </div>
    
        @if (session('status') == 'verification-link-sent')
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ __('A new verification link has been sent to the email address you provided during registration.') }}
            </div>
        @endif
    
        <div class="mt-4 flex items-center justify-between">
            <form method="POST" action="{{ route('seller.verification.send') }}">
                @csrf
    
                <div>
                    <x-primary-button>
                        {{ __('Resend Verification Email') }}
                    </x-primary-button>
                </div>
            </form>
    
            <form method="POST" action="{{ route('seller.logout') }}">
                @csrf
    
                <button type="submit" class="btn btn-danger mt-2">
                    {{ __('Log Out') }}
                </button>
            </form>
    </div>
    
    
</body>
</html>