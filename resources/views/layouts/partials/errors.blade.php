@if (count($errors) > 0)
    <div class="alert alert-danger errors">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    <?php //dd($errors); ?>
@endif