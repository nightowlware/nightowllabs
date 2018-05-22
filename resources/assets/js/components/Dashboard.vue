<template>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="jumbotron">
                <div style="display: flex">
                    <div>
                        <!--Here is my static quote-->
                        <!--<br><br>-->

                        <!--Obtain custom quote from cgi Java program!-->
                        <span v-html="quoteWall"></span>

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
            // Retrieve quotes from external java program
            this.fetchQuotes(3);
        },

        methods: {
            fetchQuotes(num) {
                let promiseArray = Array(num).fill('/api/quote').map(url => axios.request(url));

                axios.all(promiseArray).then((responses) => {
                    let quotes = Array.from(new Set(responses.map(e => (e.data.quote + "&nbsp&nbsp--" + e.data.author))));
                    this.quoteWall = quotes.join('<br><br>');
                }).catch((error) => {
                    console.error(error);
                });
            },

            paddedQuote(q) {
                return "<br><br>" + q;
            }
        },

        data() {
            return {
                quoteWall: ""
            }
        },

        computed: {
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
