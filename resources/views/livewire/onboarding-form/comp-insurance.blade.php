<div>
    <h3 class="onboarding-form__heading">
        Comp Insurance
    </h3>

    <form wire:submit.prevent="submit">
        <div class="onboarding-form__block-group">
            <input
                type="text"
                wire:model="attributes.current_plan_under_cancellation"
                class="onboarding-form__text-input @if(!empty($attributes['current_plan_under_cancellation'])) onboarding-form__text-input--filled @endif"
            />

            @error('attributes.current_plan_under_cancellation')
                <p class="onboarding-form__error">{{ $message }}</p>
            @enderror

            <label class="onboarding-form__label">Are you currently under cancellation for any reason?</label>
        </div>

        <div class="onboarding-form__block-group">
            <input
                type="text"
                wire:model="attributes.current_plan_expires_at"
                class="onboarding-form__text-input @if(!empty($attributes['current_plan_expires_at'])) onboarding-form__text-input--filled @endif"
            />

            @error('attributes.current_plan_expires_at')
                <p class="onboarding-form__error">{{ $message }}</p>
            @enderror

            <label class="onboarding-form__label">Current expiration date:</label>
        </div>

        <button
            type="submit"
            class="onboarding-form__next-button"
        >
            Next
        </button>
    </form>
</div>
