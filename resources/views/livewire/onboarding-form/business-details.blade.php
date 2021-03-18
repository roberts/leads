<div>
    <h3 class="onboarding-form__heading">
        Business Details
    </h3>

    <form wire:submit.prevent="submit">
        <form wire:submit.prevent="submit">
            <div class="onboarding-form__block-group">
                <input
                    type="text"
                    wire:model="attributes.nature"
                    class="onboarding-form__text-input @if(!empty($attributes['nature'])) onboarding-form__text-input--filled @endif"
                    autofocus
                />

                @error('attributes.nature')
                    <p class="onboarding-form__error">{{ $message }}</p>
                @enderror

                <label class="onboarding-form__label">What's your business nature?</label>
            </div>

            <div class="onboarding-form__block-group">
                <input
                    type="text"
                    wire:model="attributes.legal_entity_type"
                    class="onboarding-form__text-input @if(!empty($attributes['legal_entity_type'])) onboarding-form__text-input--filled @endif"
                />

                @error('attributes.legal_entity_type')
                    <p class="onboarding-form__error">{{ $message }}</p>
                @enderror

                <label class="onboarding-form__label">Legal entity type</label>
            </div>

            <div class="onboarding-form__block-group">
                <input
                    type="text"
                    wire:model="attributes.fein"
                    class="onboarding-form__text-input @if(!empty($attributes['fein'])) onboarding-form__text-input--filled @endif"
                />

                @error('attributes.fein')
                    <p class="onboarding-form__error">{{ $message }}</p>
                @enderror

                <label class="onboarding-form__label">Tax id number (FEIN)</label>
            </div>

            <div class="onboarding-form__block-group">
                <input
                    type="number"
                    wire:model="attributes.year_of_establishment"
                    class="onboarding-form__text-input @if(!empty($attributes['year_of_establishment'])) onboarding-form__text-input--filled @endif"
                />

                @error('attributes.year_of_establishment')
                    <p class="onboarding-form__error">{{ $message }}</p>
                @enderror

                <label class="onboarding-form__label">What year was your business established?</label>
            </div>

            <button
                type="submit"
                class="onboarding-form__next-button"
            >
                Next
            </button>
        </form>
    </form>
</div>
