<div>
    <h3 class="onboarding-form__heading">
        Have you had any workers comp claims in the last 3 years?
    </h3>

    <form wire:submit.prevent="submit">
        <div class="onboarding-form__block-group">
            <div class="onboarding-form__radio">
                <input
                    type="radio"
                    wire:model="attributes.had_claims"
                    value="1"
                    name="had_claims"
                    id="yes"
                />

                <label class="onboarding-form__label" for="yes">
                    <i class="onboarding-form__radio-button"></i> Yes
                </label>
            </div>

            <div class="onboarding-form__radio">
                <input
                    type="radio"
                    wire:model="attributes.had_claims"
                    value="0"
                    name="had_claims"
                    id="no"
                />

                <label class="onboarding-form__label" for="no">
                    <i class="onboarding-form__radio-button"></i> No
                </label>
            </div>

            @error('attributes.had_claims')
                <p class="onboarding-form__error">{{ $message }}</p>
            @enderror
        </div>

        <button
            type="submit"
            class="onboarding-form__next-button"
        >
            Next
        </button>
    </form>
</div>
