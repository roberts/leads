<div>
    <h3 class="onboarding-form__heading">
        Mailing Address
    </h3>

    <form wire:submit.prevent="submit">
        <div class="onboarding-form__block-group">
            <input
                type="text"
                wire:model="attributes.zip_code"
                class="onboarding-form__text-input @if(!empty($attributes['zip_code'])) onboarding-form__text-input--filled @endif"
                autofocus
            />

            @error('attributes.zip_code')
                <p class="onboarding-form__error">{{ $message }}</p>
            @enderror

            <label class="onboarding-form__label">Zip code</label>
        </div>

        <div class="onboarding-form__block-group">
            <input
                type="text"
                wire:model="attributes.mailing_address"
                class="onboarding-form__text-input @if(!empty($attributes['mailing_address'])) onboarding-form__text-input--filled @endif"
            />

            @error('attributes.mailing_address')
                <p class="onboarding-form__error">{{ $message }}</p>
            @enderror

            <label class="onboarding-form__label">Mailing address</label>
        </div>

        <div class="onboarding-form__block-group">
            <input
                type="text"
                wire:model="attributes.city"
                class="onboarding-form__text-input @if(!empty($attributes['city'])) onboarding-form__text-input--filled @endif"
            />

            @error('attributes.city')
                <p class="onboarding-form__error">{{ $message }}</p>
            @enderror

            <label class="onboarding-form__label">City</label>
        </div>

        <div class="onboarding-form__block-group">
            <input
                type="text"
                wire:model="attributes.state"
                class="onboarding-form__text-input @if(!empty($attributes['state'])) onboarding-form__text-input--filled @endif"
            />

            @error('attributes.state')
                <p class="onboarding-form__error">{{ $message }}</p>
            @enderror

            <label class="onboarding-form__label">State</label>
        </div>

        <button
            type="submit"
            class="onboarding-form__next-button"
        >
            Next
        </button>
    </form>
</div>
