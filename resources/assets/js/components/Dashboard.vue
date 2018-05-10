<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="jumbotron">
                <div style="display: flex">
                    <div>
                        "Whether you think you can or cannot, you're a cunt."   --Shafik
                        <br><br>
                        "You'd be amazed how much research you can get done when you have no life whatsoever."  --Ernes Cline
                        <br><br>
                        "Researchers surf the wave of human imagination." --Steven Magee
                        <br><br>
                        "Highly organized research is guaranteed to produce nothing new." --Frank Herbert
                    </div>
                    <div class="fill">
                        <img :src="require('../../images/flask.png')"/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6">
                    <!--<a href="crypto" class="btn btn-primary pull-right">-->
                        <!--Realtime Crypto price ticker-->
                    <!--</a>-->
                </div>
            </div>

        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            // console.log('Component mounted.')
        }
    }
</script>

<style>
    .fill {
        display: flex;
        justify-content: center;
        align-items: center;
        overflow: hidden
    }

    .fill img {
        object-fit: cover;
        width: 50%;
        /*height: auto;*/
    }
</style>