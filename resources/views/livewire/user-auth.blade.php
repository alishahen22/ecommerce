<div>
    <div class="modal-header">
        <h5 wire:click='switchView("login")'  class="modal-title" id="exampleModalLongTitle" style=" cursor: pointer;">{{ __('front.login') }}</h5>
        <h5 wire:click='switchView("register")' class="modal-title" id="exampleModalLongTitle"  style=" cursor: pointer;">{{ __('front.register') }}</h5>

        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

         @if ($view == 'login')
         <div class="card-body">
            <h5 class="text-center">{{ __('front.login_page') }}</h5>
            <br>
            <div>
                @if (session()->has('error'))
                    <div class="alert alert-danger">
                        {{ session('error') }}
                    </div>
                @endif
            </div>
                <div class="form-group">
                  <label for="loginEmail">{{ __('front.email_address') }}</label>
                  <input wire:model='login_email' type="email" class="form-control" id="loginEmail" aria-describedby="emailHelp" placeholder="{{ __('front.enter_email') }}">
                  @error('login_email') <span class="error text-danger">{{ $message }}</span> @enderror

                </div>
                <div class="form-group">
                  <label for="loginPassword">{{ __('front.password') }}</label>
                  <input wire:model='login_password' type="password" class="form-control" id="loginPassword" placeholder="{{ __('front.enter_password') }}">
                  @error('login_password') <span class="error text-danger">{{ $message }}</span> @enderror

                </div>

                <button wire:click='login' type="button" class="btn btn-primary ">{{ __('front.login') }}</button>
          </div>

          @elseif($view == 'register')
          <div class="card-body">
            <h5>{{ __('front.register_page') }}</h5>
            <br>
            <div>
                @if (session()->has('message'))
                    <div class="alert alert-success">
                        {{ session('message') }}
                    </div>
                @endif
            </div>

                <div class="form-group">
                    <label for="exampleInputname">{{ __('front.name') }}</label>
                    <input wire:model='name' type="text" class="form-control" id="exampleInputname" placeholder="{{ __('front.enter_name') }}">
                    @error('name') <span class="error text-danger">{{ $message }}</span> @enderror
                  </div>
                <div class="form-group">
                  <label for="exampleInputEmail1">{{ __('front.email_address') }}</label>
                  <input wire:model='email' type="email" class="form-control" id="exampleInputEmail1"  placeholder="{{ __('front.enter_email') }}">
                  @error('email') <span class="error text-danger">{{ $message }}</span> @enderror
                  <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small>
                </div>
                <div class="form-group">
                    <label for="exampleInputphone">{{ __('front.phone') }}</label>
                    <input wire:model='phone' type="text" class="form-control" id="exampleInputphone" placeholder="{{ __('front.enter_phone') }}">
                    @error('phone') <span class="error text-danger">{{ $message }}</span> @enderror
                  </div>
                <div class="form-group">
                  <label for="exampleInputPassword1">{{ __('front.password') }}</label>
                  <input wire:model='password' type="password" class="form-control" id="exampleInputPassword1" placeholder="{{ __('front.enter_password') }}">
                  @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword">{{ __('front.confirm_password') }}</label>
                    <input wire:model='password_confirmation' type="password" class="form-control" id="exampleInputPassword" placeholder="{{ __('front.enter_confirm_password') }}">
                    @error('password') <span class="error text-danger">{{ $message }}</span> @enderror
                  </div>


                  <button wire:click='register' type="button" class="btn btn-primary ">{{ __('front.register') }}</button>

          </div>
         @endif
      </div>
      {{-- <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        @if ($view == 'login')
        <button wire:click='login' type="button" class="btn btn-primary">Login</button>
        @elseif($view == 'register')
        @endif
      </div> --}}
</div>

