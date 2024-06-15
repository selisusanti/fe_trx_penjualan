<!--  This is used for loader -->

<section id="loader" class="d-none">
    <div class="overlay top"></div>
    <div class="spinner">
        <div class="cube1"></div>
        <div class="cube2"></div>
    </div>
</section>

<script type="text/javascript">
    let loader = $('#loader');

    // let to show loader
    function loaderOn(){
        loader.removeClass('d-none');
    }

    // let to hide loader
    function loaderOff(){
        loader.addClass('d-none');
    }
</script>