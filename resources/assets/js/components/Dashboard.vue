<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="jumbotron row justify-content-center">
                <img :src="require('../../images/flask.png')" style="width: 30%; height: 30%" />
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        mounted() {
            console.log('Component mounted.')
        }
    }
</script>
