<div>
    @if (Auth::user()->hasBook($book))
        <form action="{{ route('user.books.store', $book->id) }}" method="POST">
            @csrf
            <button class="btn my-btn my-btn-small my-btn-primary mt-4 w-100" name="remove" type="submit"><i
                    class="fas fa-minus-circle mr-2"></i>Remove book</button>
        </form>
    @else
        <div class="btn-group" role="group" style="display: flex">
            <button id="btnGroupDrop1" type="button"
                class="btn my-btn my-btn-primary my-btn-small mt-4 w-100 dropdown-toggle" data-toggle="dropdown"
                aria-haspopup="true" aria-expanded="false">
                <i class="fas fa-bookmark"></i> <span class="mx-2">Add to shelf</span>
            </button>
            <div class="dropdown-menu w-100" aria-labelledby="btnGroupDrop1"
                style="border: none; padding:none; margin:none">
                <form action="{{ route('user.books.store', $book->id) }}" method="POST">
                    @csrf
                    <input class="dropdown-item py-2 my-btn-light border w-100" name="later" value="Want to read"
                        type="submit" />
                    <input class="dropdown-item py-2 my-btn-light w-100" name="reading" value="Currently reading"
                        type="submit" />
                    <input class="dropdown-item py-2 my-btn-light border w-100" name="finished" value="Finished reading"
                        type="submit" />
                </form>
            </div>
        </div>
    @endif
</div>
