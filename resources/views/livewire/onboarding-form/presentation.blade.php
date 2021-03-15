<div>
    <h3 class="onboarding-form__heading">
        Let's get started!
    </h3>

    <form wire:submit.prevent="submit">
        <div class="onboarding-form__block-group">
            <input
                type="email"
                wire:model="attributes.email"
                class="onboarding-form__text-input @if(!empty($attributes['email'])) onboarding-form__text-input--filled @endif"
                autofocus
            />

            @error('attributes.email')
                <p class="onboarding-form__error">{{ $message }}</p>
            @enderror

            <label class="onboarding-form__label">Email</label>
        </div>

        <div class="onboarding-form__block-group">
            <input
                type="text"
                wire:model="attributes.business.name"
                class="onboarding-form__text-input @if(!empty($attributes['business.name'])) onboarding-form__text-input--filled @endif"
            />

            @error('attributes.business.name')
                <p class="onboarding-form__error">{{ $message }}</p>
            @enderror

            <label class="onboarding-form__label">Business name</label>
        </div>

        <button
            type="submit"
            class="onboarding-form__next-button"
        >
            Next
        </button>
    </form>
</div>
