<div>
    <div class="container flash">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="flash-message">
                    {{-- <div class="alert alert-primary" role="alert">
                        A simple primary alert—check it out!
                    </div> --}}
                    @foreach (['danger', 'warning', 'success', 'info'] as $key)
                        @if (Session::has($key))
                            <div class="alert alert-{{ $key }}">{{ Session::get($key) }}
                                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
