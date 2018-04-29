<section class="opoveshenia">
    <div class="opoveshenia-container">
        <div class="opoveshenia-item">
            <div>
                @include('chunks.avatar',['user' => $profile, 'height' => 100])
            </div>
            <div class="opoveshenia-item__txt">
                <h6>
                    {{$profile->name}}
                </h6>
                <p class="opoveshenia-item__comment">
                </p>
            </div>
            <div class="opoveshenia-item__datetime">
            </div>
            <a class="opoveshenia-item__answer" href="/messages/{{$profile->id}}">Читать</a>
        </div>
    </div>
</section>