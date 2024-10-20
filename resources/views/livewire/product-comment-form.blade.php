<div>
    <form wire:submit.prevent="submit" id="new-review-form" class="new-review-form">
        @csrf
        <h3 class="spr-form-title">Viết bình luận</h3>

        <!-- Rating Field -->
        <fieldset class="spr-form-review">
            <div class="spr-form-review-rating">
                <label class="spr-form-label">Rating</label>
                <span class="star-rating">
                    @for ($i = 1; $i <= 5; $i++)
                        <label for="rate-{{ $i }}" style="--i:{{ $i }}">
                            <i class="fa fa-star"></i>
                        </label>
                        <input type="radio" name="rating" id="rate-{{ $i }}" wire:model="rating" value="{{ $i }}">
                    @endfor
                </span>

                <!-- Error Message for Rating -->
                @error('rating')
                    <br><span class="text-danger">{{ $message }}</span>
                @enderror
            </div>
        </fieldset>

        <!-- Comment Content Field -->
        <fieldset class="spr-form-review-body">
            <label class="spr-form-label" for="review_body">Nội dung</label>
            <div class="spr-form-input">
                <textarea wire:model="content" id="review_body" class="spr-form-input spr-form-input-textarea" rows="10" placeholder="Viết bình luận ở đây"></textarea>
            </div>

            <!-- Error Message for Content -->
            @error('content')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </fieldset>

        <!-- Submit Button -->
        <fieldset class="spr-form-actions">
            <input type="hidden" name="id_product" value="{{ $id_product }}">
            <input type="submit" class="spr-button spr-button-primary button button-primary btn btn-primary" value="Gửi bình luận">
        </fieldset>
    </form>
</div>
