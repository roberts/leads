<div>
    <h3 class="onboarding-form__heading">
        Comp Claims
    </h3>

    <form wire:submit.prevent="submit">
        <div class="onboarding-form__block-group">
            <textarea
                wire:model="attributes.past_comp_claims"
                class="onboarding-form__text-input @if(!empty($attributes['past_comp_claims'])) onboarding-form__text-input--filled @endif"
                autofocus
            ></textarea>

            @error('attributes.past_comp_claims')
                <p class="onboarding-form__error">{{ $message }}</p>
            @enderror

            <label class="onboarding-form__label">Worker comp claims for the last 3 years</label>
        </div>

        <button
            type="submit"
            class="onboarding-form__next-button"
        >
            Next
        </button>
    </form>
</div>
