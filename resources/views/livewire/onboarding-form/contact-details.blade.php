<div>
    <h3 class="onboarding-form__heading">
        Contact Details
    </h3>

    <form wire:submit.prevent="submit">
        <div class="onboarding-form__block-group">
            <input
                type="text"
                wire:model="attributes.first_name"
                class="onboarding-form__text-input @if(!empty($attributes['first_name'])) onboarding-form__text-input--filled @endif"
                autofocus
            />

            @error('attributes.first_name')
                <p class="onboarding-form__error">{{ $message }}</p>
            @enderror

            <label class="onboarding-form__label">First name</label>
        </div>

        <div class="onboarding-form__block-group">
            <input
                type="text"
                wire:model="attributes.last_name"
                class="onboarding-form__text-input @if(!empty($attributes['last_name'])) onboarding-form__text-input--filled @endif"
            />

            @error('attributes.last_name')
                <p class="onboarding-form__error">{{ $message }}</p>
            @enderror

            <label class="onboarding-form__label">Last name</label>
        </div>

        <div class="onboarding-form__block-group">
            <input
                type="text"
                wire:model="attributes.position"
                class="onboarding-form__text-input @if(!empty($attributes['position'])) onboarding-form__text-input--filled @endif"
            />

            @error('attributes.position')
                <p class="onboarding-form__error">{{ $message }}</p>
            @enderror

            <label class="onboarding-form__label">Position</label>
        </div>

        <div class="onboarding-form__block-group">
            <input
                type="text"
                wire:model="attributes.phone_number"
                class="onboarding-form__text-input @if(!empty($attributes['phone_number'])) onboarding-form__text-input--filled @endif"
            />

            @error('attributes.phone_number')
                <p class="onboarding-form__error">{{ $message }}</p>
            @enderror

            <label class="onboarding-form__label">Phone number</label>
        </div>

        <button
            type="submit"
            class="onboarding-form__next-button"
        >
            Next
        </button>
    </form>
</div>
