<div>
    @if (!auth()->check())
    Vui lòng đăng nhập để bình luận!
    @else
    <div class="spr-form clearfix">
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
                            <input type="radio" name="rating" id="rate-{{ $i }}" wire:model.defer="rating" value="{{ $i }}">
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
                    <textarea wire:model.defer="content" id="review_body" class="spr-form-input spr-form-input-textarea" rows="10" placeholder="Viết bình luận ở đây"></textarea>
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
    @endif
    <div class="spr-reviews">
        @if ($comments && $comments->count() > 0)
        @foreach ($comments as $comment)
        <div class="spr-review">
            <div class="spr-review-header">
                <span class="product-review spr-starratings spr-review-header-starratings d-flex justify-content-between">
                    <span class="reviewLink">
                        @for ($i = 0; $i < $comment->rating; $i++)
                            <i class="fa fa-star"></i>
                            @endfor
                            @for ($i = $comment->rating; $i < 5; $i++)
                                <i class="fa fa-star-o"></i>
                                @endfor
                    </span>
                    @if (Auth::id() === $comment->id_user)
                    <div class="dropdown">
                        <button class="btn btn-sm btn-outline-secondary dropdown-toggle" type="button"
                            id="dropdownMenuButton-{{ $comment->id }}" data-bs-toggle="dropdown"
                            aria-expanded="false">
                        </button>
                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton-{{ $comment->id }}">
                            <li>
                                <a class="dropdown-item"
                                wire:click="deleteComment({{ $comment->id }})">Xóa</a>
                            </li>
                        </ul>
                    </div>
                    @endif
                </span></br>
                <span class="spr-review-header-byline">
                    <strong>{{ $comment->user->name }}</strong>
                    {{ $comment->created_at->format('d/m/Y') }}
                </span>
            </div>
            <div class="spr-review-content">
                <p class="spr-review-content-body">{{ $comment->content }}</p>
            </div>
        </div>
        @endforeach
        @else
        <p>Chưa có bình luận. Hãy là người đầu tiên bình luận về sách này nào!</p>
        @endif
    </div>
    @if (session()->has('comment_success'))
    <script>
        toastr.success("{{ session('comment_success') }}");
    </script>
    @endif
</div>