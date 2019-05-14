<div class="category my-3">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <div class="d-flex bd-highlight">
                    @foreach ($categoryGlobals as $categoryGlobal)
                        <div class="p-2 flex-fill bd-highlight"><a href="{{ route('category-global', ['name' => $categoryGlobal->category_global_name_u]) }}">{{$categoryGlobal->category_global_name}}</a></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>