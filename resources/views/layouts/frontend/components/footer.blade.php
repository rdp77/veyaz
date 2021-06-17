<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"
    integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"
    integrity="sha384-9/reFTGAW83EW2RDu2S0VKaIzap3H66lZH81PoYlFhbGU+6BZp6G7niu735Sk7lN" crossorigin="anonymous">
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"
    integrity="sha384-+YQ4JLhjyBLPDQt//I+STsc9iw4uQqACwlvpslubQzn4u2UU2UFM80nGisd026JF" crossorigin="anonymous">
</script>
<div class="trans mt-5">
    <div class="container-md mt-2">
        <div class="row">
            <div class="col-sm text-left">
                <img src="/images/melialogo.png" class="img-fluid" width="500px">
            </div>
            <div class="col-sm text-right">
                <p class="mt-3 font-weight-bold">{{ __('Kontak Kami') }}</p>
                <p>{{ __('Facebook : Melia Sarana Transport') }}</p>
                <p>{{ __('Instagram : meliasarana.transport') }}</p>
                <p>{{ __('Email : radenmasalit88@gmail.com') }}</p>
                <p>{{ __('No. Hp : 0821-3230-8686') }}</p>
            </div>
        </div>
    </div>
</div>
<div class="text-center p-3" style="background-color: #dddddd;">
    {{ __('© ') . date('Y') . __(' Copyright: ') }}
    <a class="text-dark" href="{{ route('home.index') }}">{{ __('Melia Sarana Transport') }}</a>
</div>